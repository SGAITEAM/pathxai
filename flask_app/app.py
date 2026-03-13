from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
from tensorflow.keras.preprocessing.image import load_img, img_to_array
import numpy as np

app = Flask(__name__)
CORS(app)

# Test Route endpoint
@app.route("/")
def home():
    return jsonify({"status": "ok", "service": "PathXAI API"})

# ==========================
# Test HCD endpoint
# ==========================
# IMG_SIZE = (600, 600)
MODEL_PATH_HCD = "models/hcd_model.keras"
MODEL_PATH_BREAST = "models/breast_final_model.keras"
MODEL_PATH_LUNG = "models/lung_model.keras"
MODEL_PATH_COLON = "models/colon_model.keras"

print("🔄 HCD modeli yükleniyor...")
hcd_model = tf.keras.models.load_model(MODEL_PATH_HCD, compile=False)
print("✅ HCD modeli yüklendi.")
print("🔄 BREAST modeli yükleniyor...")
breast_model = tf.keras.models.load_model(MODEL_PATH_BREAST, compile=False)
print("✅ BREAST modeli yüklendi.")
print("🔄 LUNG modeli yükleniyor...")
lung_model = tf.keras.models.load_model(MODEL_PATH_LUNG, compile=False)
print("✅ LUNG modeli yüklendi.")
print("🔄 COLON modeli yükleniyor...")
colon_model = tf.keras.models.load_model(MODEL_PATH_COLON, compile=False)
print("✅ COLON modeli yüklendi.")


@app.route("/predict/hcd", methods=["POST"])
def predict_hcd():
    try:
        # 1) Laravel'den gelen input_data (path)
        img_path = request.form.get("input_data")

        if img_path is None:
            return jsonify({"success": False, "error": "input_data missing"}), 400

        # 2) Görseli yükle + preprocess
        img = load_img(img_path, target_size=(224,224))
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, axis=0)

        # 3) Tahmin
        preds = hcd_model.predict(img_array)

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

@app.route("/predict/colon", methods=["POST"])
def predict_colon():
    try:
        # 1) Laravel'den gelen input_data (path)
        img_path = request.form.get("input_data")

        if img_path is None:
            return jsonify({"success": False, "error": "input_data missing"}), 400

        # 2) Görseli yükle + preprocess
        img = load_img(img_path, target_size=(300,300))
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, axis=0)

        # 3) Tahmin
        preds = colon_model.predict(img_array)

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

@app.route("/predict/lung", methods=["POST"])
def predict_lung():
    try:
        img_path = request.form.get("input_data")
        if img_path is None:
            return jsonify({"success": False, "error": "input_data missing"}), 400

        # Görsel yükleme
        img = load_img(img_path, target_size=(300, 300))
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, axis=0)

        # 🔥 Doğru modeli kullandığından emin ol
        preds = lung_model.predict(img_array)

        # Çok sınıflı tahmin: softmax → 3 değer
        probs = preds[0]  # örn: [0.81, 0.12, 0.07]

        CLASS_NAMES = ["ACA", "NORMAL", "SCC"]

        # En yüksek olasılığa sahip sınıf
        top_idx = int(np.argmax(probs))
        final_label = CLASS_NAMES[top_idx]
        final_prob = float(probs[top_idx])

        # JSON response
        return jsonify({
            "success": True,
            "prediction": final_label,
            "confidence": round(final_prob * 100, 2),
            "probabilities": {
                "ACA": round(float(probs[0]) * 100, 2),
                "SCC": round(float(probs[1]) * 100, 2),
                "NORMAL": round(float(probs[2]) * 100, 2)
            },
            "image_url": img_path
        })

    except Exception as e:
        return jsonify({
            "success": False,
            "error": str(e)
        }), 500

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5005, debug=True)
