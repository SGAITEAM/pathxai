<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DiagnoseController extends Controller
{

    public function diagnose(Request $request)
    {
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'model' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:7300'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // 2. Alt klasör seçimi modele göre
        $folderMap = [
            'hcd'       => 'hcd',
            'breast'    => 'breast',
            'lung'      => 'lung',
            'colon'     => 'colon',
        ];

        if (!isset($folderMap[$request->model])) {
            return response()->json([
                'success' => false,
                'message' => 'Unknown model type'
            ], 400);
        }

        $subFolder = $folderMap[$request->model];

        // 3. Dosya kaydetme
        $file = $request->image;
        $newName = 'api_' . Carbon::now()->format('d-m-Y_H-i-s_') . rand() . '.' . $file->getClientOriginalExtension();

        // FE’nin göreceği URL
        $fileUrl = '/img/preds/' . $subFolder . '/' . $newName;

        // Laravel’in dosyayı kaydedeceği disk path
        $savePath = public_path('img/preds/' . $subFolder . '/');

        // Fiziksel dosyayı kaydet
        $file->move($savePath, $newName);

        // Flask’ın okuyacağı path (DR–Skin’de olduğu gibi)
        $fileUrlFlask = '../public/img/preds/' . $subFolder . '/' . $newName;

        // 4. Flask endpoint yönlendirme
        $endpointMap = [
            'hcd'       => 'http://127.0.0.1:5005/predict/hcd',
            'breast'    => 'http://127.0.0.1:5005/predict/breast',
            'lung'      => 'http://127.0.0.1:5005/predict/lung',
            'colon'     => 'http://127.0.0.1:5005/predict/colon',
        ];

        $endpoint = $endpointMap[$request->model];

        // 5. Flask’a gönder
        $response = Http::asForm()->timeout(90)->post($endpoint, [
            'input_data' => $fileUrlFlask
        ]);

        $pred = $response->json();

        // Gereksiz alanları temizle
        unset($pred['image_url']);
        unset($pred['success']);

        // Flask success kontrolü
        $flaskSuccess = $response->json()['success'] ?? false;
        if ($flaskSuccess) {
            return response()->json([
                'success'      => true,
                'image_url'    => $fileUrl,
                'model'        => $request->model,
                'prediction'   => $pred
            ]);
        }
        // Flask başarısız ise:
        return response()->json([
            'success' => false,
            'error'   => $response->json()['error'] ?? 'Yapay Zeka modeli çalıştırılamadı, daha sonra tekrar deneyin',
            'model'   => $request->model
        ], 500);

    }

    public function diagnoseBase64(Request $request)
    {
        // ================================
        // 1) Validasyon
        // ================================
        $validator = Validator::make($request->all(), [
            'model' => 'required|string',
            'image_base64' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // ================================
        // 2) Model klasörü
        // ================================
        $folderMap = [
            'hcd'    => 'hcd',
            'breast' => 'breast',
            'lung'   => 'lung',
            'colon'  => 'colon',
        ];

        if (!isset($folderMap[$request->model])) {
            return response()->json([
                'success' => false,
                'message' => 'Unknown model type'
            ], 400);
        }

        $subFolder = $folderMap[$request->model];

        // ================================
        // 3) Görseli base64 olarak kaydet
        // ================================
        $newName = 'api_' . now()->format('d-m-Y_H-i-s_') . rand() . '.jpg';
        $saveDir = public_path("img/preds/{$subFolder}/");
        $savePath = $saveDir . $newName;

        if (!is_dir($saveDir)) {
            mkdir($saveDir, 0777, true);
        }

        // base64 temizleme
        $base64 = $request->image_base64;
        if (str_contains($base64, 'base64,')) {
            $base64 = explode('base64,', $base64)[1];
        }

        $decoded = base64_decode($base64);

        if (!$decoded) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid base64 image'
            ], 422);
        }

        file_put_contents($savePath, $decoded);

        // FE tarafının göreceği URL
        $fileUrl = "/img/preds/{$subFolder}/{$newName}";

        // Flask’ın okuyacağı path
        $fileUrlFlask = "../public/img/preds/{$subFolder}/{$newName}";

        // ================================
        // 4) Flask endpoint seçimi
        // ================================
        $endpointMap = [
            'hcd'    => 'http://127.0.0.1:5005/predict/hcd',
            'breast' => 'http://127.0.0.1:5005/predict/breast',
            'lung'   => 'http://127.0.0.1:5005/predict/lung',
            'colon'  => 'http://127.0.0.1:5005/predict/colon',
        ];

        $endpoint = $endpointMap[$request->model];

        // ================================
        // 5) Flask’a POST et
        // ================================
        $response = Http::asForm()->timeout(90)->post($endpoint, [
            'input_data' => $fileUrlFlask
        ]);

        $pred = $response->json();
        unset($pred['image_url']);
        unset($pred['success']);

        $flaskSuccess = $response->json()['success'] ?? false;

        if ($flaskSuccess) {
            return response()->json([
                'success'    => true,
                'image_url'  => $fileUrl,
                'model'      => $request->model,
                'prediction' => $pred
            ]);
        }

        return response()->json([
            'success' => false,
            'error'   => $response->json()['error'] ?? 'Model çalıştırılamadı',
            'model'   => $request->model
        ], 500);
    }


}
