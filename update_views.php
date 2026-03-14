<?php
/**
 * Script to replace hardcoded Turkish strings with __() helpers in Blade views.
 * Also adds language dropdown and dynamic lang attribute.
 */

$viewsDir = __DIR__ . '/resources/views';

// ======== LANDING.BLADE.PHP ========
$file = $viewsDir . '/landing.blade.php';
$c = file_get_contents($file);

// HTML lang
$c = str_replace('<html lang="tr"', '<html lang="{{ app()->getLocale() }}"', $c);
// Title
$c = str_replace('<title>Path-XAI - Histopatoloji Görüntülerinden Yapay Zeka İle Kanser Tespiti</title>', '<title>{{ __(\'page_title\') }}</title>', $c);
// Nav links
$c = str_replace('>YZ Teşhis Asistanı</a>', '>{{ __(\'nav_predict\') }}</a>', $c);
$c = str_replace('>Özet</a>', '>{{ __(\'nav_abstract\') }}</a>', $c);
$c = str_replace('>Takım</a>', '>{{ __(\'nav_team\') }}</a>', $c);
$c = str_replace('>Giriş/Kayıt</span></a', '>{{ __(\'nav_login\') }}</span></a', $c);

// Add language dropdown before login button
$c = str_replace('<!-- navbar button: Start -->', "@include('partials.lang-dropdown')\n            <!-- navbar button: Start -->", $c);

// Hero
$c = str_replace(
    "Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi\n                    </h1>",
    "{{ __('hero_title') }}\n                    </h1>",
    $c
);
$c = str_replace(
    "Bu proje, kanserli hücrelerin histopatolojik görüntüler üzerinden tespit ve sınıflandırılmasını sağlayarak, \n                       klinik karar sürecini desteklemeyi amaçlamaktadır.",
    "{{ __('hero_subtitle') }}",
    $c
);
$c = str_replace("TÜBİTAK 2204-A \n", "{{ __('hero_tubitak') }} \n", $c);
$c = str_replace(
    "kapsamında \n                         <br>Eskişehir Sabiha Gökçen M.T.A.L öğrencileri tarfından geliştirilmiştir.",
    "{{ __('hero_tubitak_suffix') }} \n                         <br>{{ __('hero_school') }}",
    $c
);
$c = str_replace("Teşhis Asistanı\n", "{{ __('hero_btn') }}\n", $c);

// Features
$c = str_replace("Projede Kullanılan  \n", "{{ __('features_title_prefix') }}  \n", $c);
$c = str_replace(">Teknikler\n", ">{{ __('features_title_highlight') }}\n", $c);
$c = str_replace("Yapay zekânın verdiği kararları görselleştirerek kara kutu olmasını engeller", "{{ __('feat_xai') }}", $c);
$c = str_replace("Modelin hangi dokulardan çıkarım yaptığını renkli ısı haritalarıyla gösterir", "{{ __('feat_gradcam') }}", $c);
$c = str_replace("Doku örnekleri dijital olarak incelenir ve çıkarım yapılır", "{{ __('feat_patch') }}", $c);
$c = str_replace("Modelin doğruluk ve performansını gösteren metrikler", "{{ __('feat_roc') }}", $c);
$c = str_replace(">Transfer Öğrenme</h5>", ">{{ __('Transfer Öğrenme') }}</h5>", $c);
$c = str_replace("Ağırlık aktarımı ile daha önce eğitilmiş modellerden faydalanmayı sağlayan derin öğrenme tekniği", "{{ __('feat_transfer') }}", $c);
$c = str_replace(">Data Augmentation</h5>", ">{{ __('Data Augmentation') }}</h5>", $c);
$c = str_replace("Modelin daha dayanıklı olması için görüntüleri döndürme, kırpma gibi işlemlerle çeşitlendirme tekniğidir", "{{ __('feat_augmentation') }}", $c);

// Facts
$c = str_replace(">Projenin Katkıları\n", ">{{ __('facts_title') }}\n", $c);
$c = str_replace("'den fazla histopatolojik görüntü", "{{ __('facts_images') }}", $c);
$c = str_replace("ile eğitilmiş modeller", "{{ __('facts_images_sub') }}", $c);
$c = str_replace("Farklı Kanser Türü", "{{ __('facts_cancer_types') }}", $c);
$c = str_replace("ve 1 Metastaz Kanser Türü", "{{ __('facts_cancer_types_sub') }}", $c);
$c = str_replace("Çıkarım Doğrulu", "{{ __('facts_accuracy') }}", $c);
$c = str_replace("Kanserli Hücre Yakalama Başarısı", "{{ __('facts_recall') }}", $c);

// Team
$c = str_replace(">Takım\n              <img", ">{{ __('team_title') }}\n              <img", $c);
$c = str_replace("Model Geliştirme, Yazılım Geliştirme, Tasarım ve Akademik süreçlere katkı sunan ekip üyeleri.", "{{ __('team_description') }}", $c);

// Footer
$c = str_replace(
    "Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi\n              </p>",
    "{{ __('footer_description') }}\n              </p>",
    $c
);
$c = str_replace(
    "Bu proje Eskişehir Sabiha Gökçen MTAL öğrencileri tarafından  <a",
    "{{ __('footer_project') }}  <a",
    $c
);
$c = str_replace(">TÜBİTAK 2204-A</a> Yarışması için geliştirilmiştir.", ">TÜBİTAK 2204-A</a> {{ __('footer_tubitak') }}", $c);

file_put_contents($file, $c);
echo "Updated landing.blade.php\n";


// ======== ABSTRACT.BLADE.PHP ========
$file = $viewsDir . '/abstract.blade.php';
$c = file_get_contents($file);

$c = str_replace('<html lang="tr"', '<html lang="{{ app()->getLocale() }}"', $c);
$c = str_replace('<title>Path-XAI - Histopatoloji Görüntülerinden Yapay Zeka İle Kanser Tespiti</title>', '<title>{{ __(\'page_title\') }}</title>', $c);
$c = str_replace('>YZ Teşhis Asistanı</a>', '>{{ __(\'nav_predict\') }}</a>', $c);
$c = str_replace('>Özet</a>', '>{{ __(\'nav_abstract\') }}</a>', $c);
$c = str_replace('>Takım</a>', '>{{ __(\'nav_team\') }}</a>', $c);
$c = str_replace('>Giriş/Kayıt</span></a', '>{{ __(\'nav_login\') }}</span></a', $c);
$c = str_replace('<!-- navbar button: Start -->', "@include('partials.lang-dropdown')\n            <!-- navbar button: Start -->", $c);

// Abstract content
$c = str_replace('>Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi</h4>', '>{{ __(\'abstract_title\') }}</h4>', $c);
$c = str_replace('>Yazılım</span>', '>{{ __(\'abstract_badge_software\') }}</span>', $c);
$c = str_replace('>Yapay Zekâ</span>', '>{{ __(\'abstract_badge_ai\') }}</span>', $c);

// Replace the long abstract text
$abstractTRText = "Kanser tanısında altın standart kabul edilen histopatolojik inceleme, manuel değerlendirmenin gözlemciye bağlı değişkenliği \n                    ve iş yükü sebebiyle bu alanda yapay zekâ entegrasyonunu zorunlu kılan bir dönüşüm sürecindedir. \n                    Bu proje, meme, akciğer ve kolon kanserlerine ait toplam 530.000'den fazla histopatolojik görüntü içeren beş açık veri seti kullanılarak çoklu \n                    kanser türlerini analiz edebilen açıklanabilir bir yapay zekâ sistemi geliştirmeyi amaçlamaktadır. \n                    Tüm modeller EfficientNet tabanlı transfer öğrenme yöntemiyle eğitilmiş, görüntüler standart bir ön işleme hattından geçirilmiştir.\n                    Meme kanseri modeli üç aşamalı transfer öğrenme stratejisiyle kademeli olarak uzmanlaştırılmıştır.\n                    IDC veri seti üzerinde %82, BACH veri setine transferiyle yapılan ikinci aşamada %94, üçüncü ve nihai BreakHis modelinde ise %87 doğruluk ve 0,90 ROC-AUC metriklerine ulaşılmıştır, özellikle malign dokularda kanser duyarlılığı 0,95 seviyesindedir. Meme kanserinin lenf nodu metastazı için geliştirilen modelde %95 doğruluk elde edilmiştir. Akciğer ve kolon modellerinde %100 doğruluk düzeyine erişilmiş olup, bu performansın genellenebilirliği yeni veri setleriyle doğrulanması literatürde önerilen bir yaklaşımdır. Grad-CAM tabanlı açıklanabilir yapay zekâ (XAI) yöntemi sistemin temel bileşeni olarak entegre edilmiş ve modelin hangi doku bölgelerine bakarak karar verdiği görsel ısı haritalarıyla sağlanmıştır. Bu yaklaşım, yalnızca yüksek doğruluk sağlamayı değil yapay zekâ model tahminlerini şeffaflaştırarak kara kutu olmaktan çıkarmayı ve uzman hekimlerin değerlendirmesine yardımcı olmayı amaçlamaktadır. Proje somut bir yazılım ürünü haline getirilerek görüntü yükleme, sınıflandırma ve Grad-CAM çıktılarını tek platformda sunan web uygulaması ile harici uygulamalara entegrasyonunu sağlamak amacıyla API ile tamamlanarak yayına alınmıştır. Sonuç olarak proje Ar-Ge niteliği taşıyan bilimsel bir yapay zekâ modeli ve klinik ön değerlendirme amacıyla kullanılabilir prototip yapay zekâ asistanı ortaya koymaktadır.";
$c = str_replace($abstractTRText, "{{ __('abstract_text') }}", $c);

$c = str_replace('>Anahtar Kelimeler: </span>', '>{{ __(\'abstract_keywords_title\') }} </span>', $c);
$c = str_replace('>Histopatoloji</span>', '>{{ __(\'abstract_kw_histopathology\') }}</span>', $c);
$c = str_replace('>Derin Öğrenme</span>', '>{{ __(\'abstract_kw_deep_learning\') }}</span>', $c);
$c = str_replace('>Açıklanabilir Yapay Zeka</span>', '>{{ __(\'abstract_kw_xai\') }}</span>', $c);

// Footer (same as landing)
$c = str_replace(
    "Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi\n              </p>",
    "{{ __('footer_description') }}\n              </p>",
    $c
);
$c = str_replace("Bu proje Eskişehir Sabiha Gökçen MTAL öğrencileri tarafından  <a", "{{ __('footer_project') }}  <a", $c);
$c = str_replace(">TÜBİTAK 2204-A</a> Yarışması için geliştirilmiştir.", ">TÜBİTAK 2204-A</a> {{ __('footer_tubitak') }}", $c);

file_put_contents($file, $c);
echo "Updated abstract.blade.php\n";


// ======== APIDOCS.BLADE.PHP ========
$file = $viewsDir . '/apiDocs.blade.php';
$c = file_get_contents($file);

$c = str_replace('<html lang="tr"', '<html lang="{{ app()->getLocale() }}"', $c);
$c = str_replace('<title>Path-XAI - Histopatoloji Görüntülerinden Yapay Zeka İle Kanser Tespiti</title>', '<title>{{ __(\'page_title\') }}</title>', $c);
$c = str_replace('>YZ Teşhis Asistanı</a>', '>{{ __(\'nav_predict\') }}</a>', $c);
$c = str_replace('>Özet</a>', '>{{ __(\'nav_abstract\') }}</a>', $c);
$c = str_replace('>Takım</a>', '>{{ __(\'nav_team\') }}</a>', $c);
$c = str_replace('>Giriş/Kayıt</span></a', '>{{ __(\'nav_login\') }}</span></a', $c);
$c = str_replace('<!-- navbar button: Start -->', "@include('partials.lang-dropdown')\n            <!-- navbar button: Start -->", $c);

// API content
$c = str_replace('>Predict — File Upload</h3>', '>{{ __(\'api_predict_file_title\') }}</h3>', $c);
$c = str_replace('Göğüs / Akciğer / Kolon / HCD modelleri için gönderilen resim dosyasına dair yüzdesel çıkarım sonucu döndürür.', '{{ __(\'api_predict_file_desc\') }}', $c);
$c = str_replace('>Örnek Response:</h6>', '>{{ __(\'api_example_response\') }}</h6>', $c);
$c = str_replace('>Predict — Base64</h3>', '>{{ __(\'api_predict_base64_title\') }}</h3>', $c);
$c = str_replace('Base64 ile encode edilmiş görsel dosyalarına dair yüzdesel çıkarım sonucu döner.', '{{ __(\'api_predict_base64_desc\') }}', $c);
$c = str_replace('>Login (Get Bearer Token)</h3>', '>{{ __(\'api_login_title\') }}</h3>', $c);
$c = str_replace('E-posta adresiniz ve parolanız ile API isteklerinde kullanabileceğiniz yetkilendirme tokenı döner.', '{{ __(\'api_login_desc\') }}', $c);
$c = str_replace('>Desteklenen Model Parametreleri (model)</h3>', '>{{ __(\'api_models_title\') }}</h3>', $c);
$c = str_replace('BreakHis + BACH + IDC Birleşik Göğüs Kanseri Modeli', '{{ __(\'api_model_breast\') }}', $c);
$c = str_replace('Göğüs Kanseri Lenf Nodu Metastazı', '{{ __(\'api_model_hcd\') }}', $c);
$c = str_replace('Akciğer Kanseri Modeli', '{{ __(\'api_model_lung\') }}', $c);
$c = str_replace('Kolon Kanseri Modeli', '{{ __(\'api_model_colon\') }}', $c);
$c = str_replace('>Hata Açıklamaları</h3>', '>{{ __(\'api_errors_title\') }}</h3>', $c);
$c = str_replace('>Authantication Hatası</h6>', '>{{ __(\'api_auth_error\') }}</h6>', $c);
$c = str_replace('>Parametre Hatası (model) (422)</h6>', '>{{ __(\'api_param_error\') }}</h6>', $c);

// Sidebar
$c = str_replace('>EndPoint Listesi</h5>', '>{{ __(\'api_endpoint_list\') }}</h5>', $c);
$c = str_replace('>Görsel Dosyası ile Tahmin</span>', '>{{ __(\'api_sidebar_file\') }}</span>', $c);
$c = str_replace('>Base64 ile Tahmin</span>', '>{{ __(\'api_sidebar_base64\') }}</span>', $c);
$c = str_replace('>Authantication</span>', '>{{ __(\'api_sidebar_auth\') }}</span>', $c);
$c = str_replace('>Desteklenen Parametreler</span>', '>{{ __(\'api_sidebar_params\') }}</span>', $c);
$c = str_replace('>Hata Açıklamaları</span>', '>{{ __(\'api_sidebar_errors\') }}</span>', $c);

// Footer
$c = str_replace(
    "Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi\n              </p>",
    "{{ __('footer_description') }}\n              </p>",
    $c
);
$c = str_replace("Bu proje Eskişehir Sabiha Gökçen MTAL öğrencileri tarafından  <a", "{{ __('footer_project') }}  <a", $c);
$c = str_replace(">TÜBİTAK 2204-A</a> Yarışması için geliştirilmiştir.", ">TÜBİTAK 2204-A</a> {{ __('footer_tubitak') }}", $c);

file_put_contents($file, $c);
echo "Updated apiDocs.blade.php\n";


// ======== PREDICTV2.BLADE.PHP ========
$file = $viewsDir . '/predictV2.blade.php';
$c = file_get_contents($file);

$c = str_replace('<html lang="tr"', '<html lang="{{ app()->getLocale() }}"', $c);
$c = str_replace('<title>Path-XAI - Histopatoloji Görüntülerinden Yapay Zeka İle Kanser Tespiti</title>', '<title>{{ __(\'page_title\') }}</title>', $c);
$c = str_replace('>YZ Teşhis Asistanı</a>', '>{{ __(\'nav_predict\') }}</a>', $c);
$c = str_replace('>Özet</a>', '>{{ __(\'nav_abstract\') }}</a>', $c);
$c = str_replace('>Takım</a>', '>{{ __(\'nav_team\') }}</a>', $c);
$c = str_replace('>Giriş/Kayıt</span></a', '>{{ __(\'nav_login\') }}</span></a', $c);
$c = str_replace('<!-- navbar button: Start -->', "@include('partials.lang-dropdown')\n            <!-- navbar button: Start -->", $c);

// Predict page specifics
$c = str_replace('>Histopatoloji Görüntüleri</span>', '>{{ __(\'predict_title\') }}</span>', $c);
$c = str_replace('>Üzerinden Kanser Tespiti</span>', '>{{ __(\'predict_title_suffix\') }}</span>', $c);
$c = str_replace('Görsel Yükleyin', '{{ __(\'predict_upload_label\') }}', $c);
$c = str_replace('>Göğüs Kanseri</span>', '>{{ __(\'predict_breast\') }}</span>', $c);
$c = str_replace('>Metastas Göğüs (Lenf)</span>', '>{{ __(\'predict_hcd\') }}</span>', $c);
$c = str_replace('>Akciğer Kanseri</span>', '>{{ __(\'predict_lung\') }}</span>', $c);
$c = str_replace('>Kolon Kanseri</span>', '>{{ __(\'predict_colon\') }}</span>', $c);
$c = str_replace('>İncele</span>', '>{{ __(\'predict_btn\') }}</span>', $c);

// File input area
$c = str_replace('Lütfen Yüklediğiniz Histopatoloji Görüntüsünün ait olduğu', '{{ __(\'predict_instruction\') }}', $c);
$c = str_replace('>doku tipinine ait modeli</b>', '>{{ __(\'predict_instruction_bold\') }}</b>', $c);
$c = str_replace(' seçiniz.', ' {{ __(\'predict_instruction_suffix\') }}', $c);
$c = str_replace('Görüntü hangi dokuya ait ise ilgili modeli seçmeniz gerekmektedir.', '{{ __(\'predict_model_instruction\') }}', $c);

// Result cards
$c = str_replace('>% Pozitif</span>', '>% {{ __(\'result_positive\') }}</span>', $c);
$c = str_replace('>% Negatif</span>', '>% {{ __(\'result_negative\') }}</span>', $c);

// Footer
$c = str_replace(
    "Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi\n              </p>",
    "{{ __('footer_description') }}\n              </p>",
    $c
);
$c = str_replace("Bu proje Eskişehir Sabiha Gökçen MTAL öğrencileri tarafından  <a", "{{ __('footer_project') }}  <a", $c);
$c = str_replace(">TÜBİTAK 2204-A</a> Yarışması için geliştirilmiştir.", ">TÜBİTAK 2204-A</a> {{ __('footer_tubitak') }}", $c);

// JavaScript translations - replace hardcoded Swal strings
// Add translation object before $(document).ready
$jsTranslations = <<<'BLADE'
<script>
const __translations = @json([
    'swal_image_selected' => __('swal_image_selected'),
    'swal_selected_image' => __('swal_selected_image'),
    'swal_model_not_selected' => __('swal_model_not_selected'),
    'swal_model_not_selected_text' => __('swal_model_not_selected_text'),
    'swal_image_missing' => __('swal_image_missing'),
    'swal_image_missing_text' => __('swal_image_missing_text'),
    'swal_analyzing' => __('swal_analyzing'),
    'swal_analysis_complete' => __('swal_analysis_complete'),
    'swal_ok' => __('swal_ok'),
    'result_positive' => __('result_positive'),
    'result_negative' => __('result_negative'),
    'result_contains_cancer' => __('result_contains_cancer'),
    'result_no_cancer' => __('result_no_cancer'),
    'result_normal_tissue' => __('result_normal_tissue'),
]);
</script>
BLADE;

// Insert translation object before the first <script> with $(document).ready
$c = str_replace("$(document).ready(function () {\n\n      let selectedImage", $jsTranslations . "\n<script>\n  $(document).ready(function () {\n\n      let selectedImage", $c);

// Replace JS Swal strings with translation references
$c = str_replace('title: "Görsel Seçildi"', 'title: __translations.swal_image_selected', $c);
$c = str_replace('imgMsg.removeClass("d-none").html(`Seçilen Görsel: <strong>${file.name}</strong>`)', 'imgMsg.removeClass("d-none").html(`${__translations.swal_selected_image}: <strong>${file.name}</strong>`)', $c);
$c = str_replace('title: "Model Seçilmedi"', 'title: __translations.swal_model_not_selected', $c);
$c = str_replace('text: "Lütfen bir model seçiniz."', 'text: __translations.swal_model_not_selected_text', $c);
$c = str_replace('title: "Görsel Eksik"', 'title: __translations.swal_image_missing', $c);
$c = str_replace('text: "Lütfen bir görsel yükleyiniz."', 'text: __translations.swal_image_missing_text', $c);
$c = str_replace('title: "İnceleme Tamamlandı"', 'title: __translations.swal_analysis_complete', $c);
$c = str_replace('confirmButtonText: "Tamam"', 'confirmButtonText: __translations.swal_ok', $c);
$c = str_replace('title: "🧬 İnceleme Yapılıyor"', 'title: __translations.swal_analyzing', $c);

// Result text in JS
$c = str_replace('"% Pozitif"', '`% ${__translations.result_positive}`', $c);
$c = str_replace('"% Negatif"', '`% ${__translations.result_negative}`', $c);
$c = str_replace('`(Kanser Dokusu İçerir)`', '`${__translations.result_contains_cancer}`', $c);
$c = str_replace('`(Kanser Dokusu İçermez)`', '`${__translations.result_no_cancer}`', $c);
$c = str_replace('`Normal Doku: ${normal.toFixed(2)}%`', '`${__translations.result_normal_tissue}: ${normal.toFixed(2)}%`', $c);

file_put_contents($file, $c);
echo "Updated predictV2.blade.php\n";

echo "\nAll views updated successfully!\n";
