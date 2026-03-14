from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
from tensorflow.keras.preprocessing.image import load_img, img_to_array
import numpy as np

# XAI Bağımlılıkları
import os
import cv2
from PIL import Image
from datetime import datetime

# CPU-only (CUDA uyarılarını kesmek için)
os.environ["CUDA_VISIBLE_DEVICES"] = "-1"

app = Flask(__name__)
CORS(app)

# --------------------------
# XAI 
# --------------------------
XAI_DIR = "/var/www/pathxai/public/img/preds/xai"
os.makedirs(XAI_DIR, exist_ok=True)

# Test Route endpoint
@app.route("/")
def home():
    return jsonify({"status": "ok", "service": "PathXAI API"})


# MODELLER
MODEL_PATH_HCD = "models/hcd_model.keras"
MODEL_PATH_BREAST = "models/breast_final_model.keras"
MODEL_PATH_LUNG = "models/lung_model.keras"
MODEL_PATH_COLON = "models/colon_model.keras"

print("HCD modeli yükleniyor...")
hcd_model = tf.keras.models.load_model(MODEL_PATH_HCD, compile=False)
print("HCD modeli yüklendi.")
print("BREAST modeli yükleniyor...")
breast_model = tf.keras.models.load_model(MODEL_PATH_BREAST, compile=False)
print("BREAST modeli yüklendi.")
print("LUNG modeli yükleniyor...")
lung_model = tf.keras.models.load_model(MODEL_PATH_LUNG, compile=False)
print("LUNG modeli yüklendi.")
print("COLON modeli yükleniyor...")
colon_model = tf.keras.models.load_model(MODEL_PATH_COLON, compile=False)
print("COLON modeli yüklendi.")

# XAI: Grad-CAM (HCD) FONKSİYONLARI
def generate_hcd_gradcam(img_array, model, layer_name="top_conv", out_size=(224, 224)):
    """
    img_array: (1,224,224,3)
    returns heatmap: (224,224) in [0,1]
    """
    base = model.get_layer("efficientnetb7")
    target_layer = base.get_layer(layer_name)

    grad_model = tf.keras.models.Model(
        inputs=base.input,
        outputs=[target_layer.output, base.output]
    )

    with tf.GradientTape() as tape:
        conv_out, preds = grad_model(img_array)
        loss = preds[:, 0]   # binary: class 0

    grads = tape.gradient(loss, conv_out)
    pooled = tf.reduce_mean(grads, axis=(0, 1, 2))

    conv_out = conv_out[0]
    heatmap = tf.reduce_sum(conv_out * pooled, axis=-1)

    heatmap = tf.maximum(heatmap, 0)
    heatmap /= tf.reduce_max(heatmap) + 1e-8

    heatmap = tf.image.resize(heatmap[..., None], out_size)
    return tf.squeeze(heatmap).numpy()


def save_hcd_gradcam_overlay(img_path, img_array, heatmap, alpha=0.4):
    """
    Saves overlay to public/img/preds/xai and returns public url path.
    """
    orig = load_img(img_path).resize((224, 224)).convert("RGB")
    orig_np = np.array(orig)

    heatmap_uint8 = np.uint8(255 * heatmap)
    jet = cv2.applyColorMap(heatmap_uint8, cv2.COLORMAP_JET)
    jet = cv2.cvtColor(jet, cv2.COLOR_BGR2RGB)

    overlay = cv2.addWeighted(orig_np, 1.0 - alpha, jet, alpha, 0)

    filename = f"hcd_gradcam_{datetime.now().strftime('%Y%m%d_%H%M%S_%f')}.png"
    out_path = os.path.join(XAI_DIR, filename)
    Image.fromarray(overlay).save(out_path)

    return f"/img/preds/xai/{filename}"


@app.route("/predict/hcd", methods=["POST"])
def predict_hcd():
    try:
        img_path = request.form.get("input_data")
        if img_path is None:
            return jsonify({"success": False, "error": "input_data missing"}), 400

        # preprocess
        img = load_img(img_path, target_size=(224, 224))
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, axis=0)

        # prediction
        preds = hcd_model.predict(img_array)
        malignant_prob = float(preds[0][0])
        benign_prob = 1.0 - malignant_prob

        # XAI default: generate + save Grad-CAM
        heatmap = generate_hcd_gradcam(img_array, hcd_model, layer_name="top_conv")
        xai_url = save_hcd_gradcam_overlay(img_path, img_array, heatmap, alpha=0.4)

        print("RAW PRED:", preds[0][0], "| file:", img_path, "| xai:", xai_url)

        return jsonify({
            "success": True,
            "positive": round(malignant_prob * 100, 2),
            "negative": round(benign_prob * 100, 2),
            "xai_image_url": xai_url
        })

    except Exception as e:
        return jsonify({
            "success": False,
            "error": str(e)
        }), 500

@app.route("/predict/breast", methods=["POST"])
def predict_breast():
    try:
        # 1) Laravel'den gelen input_data (path)
        img_path = request.form.get("input_data")

        if img_path is None:
            return jsonify({"success": False, "error": "input_data missing"}), 400

        # 2) Görseli yükle + preprocess
        img = load_img(img_path, target_size=(600, 600))
        img_array = img_to_array(img)          # 0–255
        img_array = np.expand_dims(img_array, axis=0)

        # 3) Tahmin
        preds = breast_model.predict(img_array)

        # Binary
        malignant_prob = float(preds[0][0])
        benign_prob = 1.0 - malignant_prob

        print("RAW PRED:", preds[0][0], " | file:", img_path)

        # 4) JSON döndür
        return jsonify({
            "success": True,
            "positive": round(malignant_prob * 100, 2),
            "negative": round(benign_prob * 100, 2),
            "image_url": img_path  # Laravel isterse bunu kullanır
        })

    except Exception as e:
        return jsonify({
            "success": False,
            "error": str(e)
        }), 500

# XAI: Grad-CAM (COLON) FONKSİYONLARI

def generate_colon_gradcam(img_array, model, layer_name="top_conv", out_size=(300, 300)):
    """
    img_array: (1,300,300,3)
    returns heatmap: (300,300) in [0,1]
    """
    base = model.get_layer("efficientnetb7")
    target_layer = base.get_layer(layer_name)

    grad_model = tf.keras.models.Model(
        inputs=base.input,
        outputs=[target_layer.output, base.output]
    )

    with tf.GradientTape() as tape:
        conv_out, preds = grad_model(img_array)
        loss = preds[:, 0]   # binary sigmoid aktivasyon fonksiyonu son katman

    grads = tape.gradient(loss, conv_out)
    pooled = tf.reduce_mean(grads, axis=(0, 1, 2))

    conv_out = conv_out[0]
    heatmap = tf.reduce_sum(conv_out * pooled, axis=-1)

    heatmap = tf.maximum(heatmap, 0)
    heatmap /= tf.reduce_max(heatmap) + 1e-8

    heatmap = tf.image.resize(heatmap[..., None], out_size)
    return tf.squeeze(heatmap).numpy()

def save_colon_gradcam_overlay(img_path, img_array, heatmap, alpha=0.4):
    """
    Saves overlay to public/img/preds/xai and returns public url path.
    """
    orig = load_img(img_path).resize((300, 300)).convert("RGB")
    orig_np = np.array(orig)

    heatmap_uint8 = np.uint8(255 * heatmap)
    jet = cv2.applyColorMap(heatmap_uint8, cv2.COLORMAP_JET)
    jet = cv2.cvtColor(jet, cv2.COLOR_BGR2RGB)

    overlay = cv2.addWeighted(orig_np, 1.0 - alpha, jet, alpha, 0)

    filename = f"colon_gradcam_{datetime.now().strftime('%Y%m%d_%H%M%S_%f')}.png"
    out_path = os.path.join(XAI_DIR, filename)
    Image.fromarray(overlay).save(out_path)

    return f"/img/preds/xai/{filename}"

@app.route("/predict/colon", methods=["POST"])
def predict_colon():
    try:
        # 1) Laravel'den gelen input_data (path)
        img_path = request.form.get("input_data")
        if img_path is None:
            return jsonify({
                "success": False,
                "error": "input_data missing"
            }), 400

        # 2) Görseli yükle + preprocess
        img = load_img(img_path, target_size=(300, 300))
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, axis=0)

        # 3) Tahmin
        preds = colon_model.predict(img_array, verbose=0)
        malignant_prob = float(preds[0][0])
        benign_prob = 1.0 - malignant_prob

        # 4) XAI: Grad-CAM üret
        heatmap = generate_colon_gradcam(
            img_array,
            colon_model,
            layer_name="top_conv"
        )

        xai_url = save_colon_gradcam_overlay(
            img_path,
            img_array,
            heatmap,
            alpha=0.4
        )

        # 5) JSON: orijinal + gradcam birlikte
        return jsonify({
            "success": True,
            "positive": round(malignant_prob * 100, 2),
            "negative": round(benign_prob * 100, 2),
            "image_url": img_path,          # orijinal görsel
            "xai_image_url": xai_url        # Grad-CAM görseli
        })

    except Exception as e:
        return jsonify({
            "success": False,
            "error": str(e)
        }), 500

# XAI: Grad-CAM (LUNG) FONKSİYONLARI

def generate_lung_gradcam_safe(img_array, model, class_index=None, out_size=(300, 300)):
    """
    img_array: (1,300,300,3)
    returns:
        heatmap (300,300)
        class_index
        probs (3,)
    """

    # --- EfficientNet  ---
    base = model.get_layer("efficientnetb7")
    target_layer = base.get_layer("top_conv")

    # --- Full model tahmini (graph-safe) ---
    probs = model.predict(img_array, verbose=0)[0]
    if class_index is None:
        class_index = int(np.argmax(probs))

    # --- Grad model ---
    grad_model = tf.keras.models.Model(
        inputs=base.input,
        outputs=[target_layer.output, base.output]
    )

    # --- sınıflama ---
    gap = model.get_layer("global_average_pooling2d")
    dense1 = model.get_layer("dense")
    act = model.get_layer("leaky_re_lu")
    drop = model.get_layer("dropout")
    dense2 = model.get_layer("dense_1")

    with tf.GradientTape() as tape:
        conv_out, base_feat = grad_model(img_array)

        x = gap(base_feat)
        x = dense1(x)
        x = act(x)
        x = drop(x, training=False)
        preds = dense2(x)

        loss = preds[:, class_index]

    grads = tape.gradient(loss, conv_out)
    pooled_grads = tf.reduce_mean(grads, axis=(0, 1, 2))

    conv_out = conv_out[0]
    heatmap = tf.reduce_sum(conv_out * pooled_grads, axis=-1)

    heatmap = tf.maximum(heatmap, 0)
    heatmap /= tf.reduce_max(heatmap) + 1e-8

    heatmap = tf.image.resize(heatmap[..., None], out_size)
    heatmap = tf.squeeze(heatmap).numpy()

    return heatmap, class_index, probs

def save_lung_gradcam_overlay(img_path, heatmap, alpha=0.4):
    orig = load_img(img_path).resize((300, 300)).convert("RGB")
    orig_np = np.array(orig)

    heatmap_uint8 = np.uint8(255 * heatmap)
    jet = cv2.applyColorMap(heatmap_uint8, cv2.COLORMAP_JET)
    jet = cv2.cvtColor(jet, cv2.COLOR_BGR2RGB)

    overlay = cv2.addWeighted(orig_np, 1.0 - alpha, jet, alpha, 0)

    filename = f"lung_gradcam_{datetime.now().strftime('%Y%m%d_%H%M%S_%f')}.png"
    out_path = os.path.join(XAI_DIR, filename)
    Image.fromarray(overlay).save(out_path)

    return f"/img/preds/xai/{filename}"


@app.route("/predict/lung", methods=["POST"])
def predict_lung():
    try:
        img_path = request.form.get("input_data")
        if img_path is None:
            return jsonify({"success": False, "error": "input_data missing"}), 400

        # --- Görsel yükleme ---
        img = load_img(img_path, target_size=(300, 300))
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, axis=0)

        # --- XAI + prediction  ---
        heatmap, class_index, probs = generate_lung_gradcam_safe(
            img_array,
            lung_model
        )

        # MODEL GERÇEK SINIF SIRASI
        CLASS_NAMES = ["ACA", "NORMAL", "SCC"]

        predicted_label = CLASS_NAMES[class_index]

        xai_url = save_lung_gradcam_overlay(
            img_path,
            heatmap,
            alpha=0.4
        )

        return jsonify({
            "success": True,
            "prediction": predicted_label,
            "confidence": round(float(probs[class_index]) * 100, 2),
            "probabilities": {
                "ACA": round(float(probs[0]) * 100, 2),
                "NORMAL": round(float(probs[1]) * 100, 2),
                "SCC": round(float(probs[2]) * 100, 2)
            },
            "image_url": img_path,
            "xai_image_url": xai_url
        })

    except Exception as e:
        return jsonify({
            "success": False,
            "error": str(e)
        }), 500

if __name__ == "__main__":
    app.run(
        host="127.0.0.1",
        port=5005,
        debug=False,
        use_reloader=False
    )
