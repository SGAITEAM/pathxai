<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class PredictController extends Controller
{
    //
    public function predictHCD(Request $request)
    {
        // Gelen isteği işleyin, dosyayı alın ve modeli kullanarak tahmin yapın
        // istek ajax mı kotrol edilmeli sonrasında request içinde image olmalı max 5MB olmalı vb.
        if($request->ajax()){ 
            if($request->hasFile('image') == 1){
                $validation = Validator::make($request->all(), [
                    'image' => 'required|image|max:5120', // Maksimum 5MB 
                ]);
                if($validation->passes()){
                    $file = $request->file('image');
                    $new_name = 'date_' . Carbon::now()->format('d-m-Y_H-i-s-') . rand() . '.' . $file->getClientOriginalExtension();
                    $fileStatus = $file->move(public_path('img/preds/hcd/'), $new_name);
                    // file kaydedildi mi kontrolü yapılmalı
                    $fileUrl = '../img/preds/hcd/'. $new_name;

                    // Burada makine öğrenimi modeli ile tahmin yapılmalı
                    // Örnek olarak rastgele bir sonuç döndürüyoruz
                    // Bu örnekte, sabit bir yanıt döndürüyoruz
                    sleep(3); // 3 saniye bekletir
                    return response()->json([
                        'positive' => 86,
                        'negative' => 14,
                        'image_url' => $fileUrl
                    ]);
                }
                else{
                    return 301; // dosya uygun değil
                }
            }
            else{
                $fileUrl = NULL;
                return 302; // image yüklenmemiş
            }
            
          
        }
    }
}
