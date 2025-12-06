<p align="center">
   <img src="public/assets/img/logo.png" alt="App Logo" width="200"/>
</p>

<h1 align="center">Histopatolojik Görüntülerde Kanser Tespiti ve Açıklanabilir Yapay Zekâ (XAI) Destekli Karar Sistemi</h1>

<p align="center">
  Bu proje Tübitak 2204-A yarışması için <u>Eskişehir Sabiha Gökçen M.T.A.L</u> öğrencileri tarafından hazırlanmıştır.<br>
  <strong>Esila Tuğba Giderbaş • Sude Tekinkoca • Berkay Karaman</strong> <br>
  <i>2025-2026</i>
</p>

---

## ⚡️ Hedef

**PathAI**, 
Göğüs, akciğer ve kolon kanserlerine ait toplam 530.000’den fazla histopatolojik görüntü içeren beş açık veri seti (IDC, HCD/PCam, BACH, BreakHis, LC25000) kullanılarak çoklu kanser türlerini analiz edebilen açıklanabilir bir yapay zekâ sistemi geliştirmeyi amaçlamaktadır
---

## 🚀 Özellikler

- ✅ Çoklu Kanser Tespit Platformu
- ✅ EfficientNet tabanlı yapay zeka modelleri
- ✅ Göğüs Kanseri %87, Göğüs Kanserinin Lenf Nodu Metastazı %95, Akciğer ve Kolon Kanserinde %99 Doğruluk (Accuracy)
- ✅ Malign Doku Yakalamada %95 recall
- ✅ Meme kanseri modeli üç aşamalı transfer öğrenme stratejisi (IDC → BACH → BreakHis) 
- ✅ Patch (yama) ve Whole Slide Image (WSI) ile tahmin üretme
- ✅ Explainable AI ile tahminin hangi bölgeden çıkarıldığının açıklanması
- ✅ Web Uygulaması
- ✅ API ile farklı platformlara entegre edilebilme

---

## ⚙️ Kurulum

### Gereksinimler

- PHP >= 8.2
- Python >= 3.9
- Flask
- Composer
- MySQL

### Kurulum Adımları

```bash
git clone https://github.com/SGAITEAM/pathai.git
cd pathai

composer install
cp .env.example .env
php artisan key:generate

# Veritabanı ayarlarını .env içinde yapın
php artisan migrate --seed
php artisan serve

# !Önemli: Flask App için Model Dosyalarının İndirilerek flask dizinine kooyalanması gerekir
cd flask
python index.py
```

### Model Dosyaları
- [Göğüs Kanseri Modeli (IDC)](https://www.kaggle.com/#)
- [Göğüs Kanseri Modeli (BACH)](https://www.kaggle.com/#)
- [Göğüs Kanseri Modeli (BReakHis - Final Model)](https://www.kaggle.com/#)
- [Göğüs Kanseri Lenf Nodu Metastazı Modeli (HCD)](https://www.kaggle.com/#)
- [Akciğer Kanseri Modeli (IDC)](https://www.kaggle.com/#)
- [Kolon Kanseri Modeli (IDC)](https://www.kaggle.com/#)

