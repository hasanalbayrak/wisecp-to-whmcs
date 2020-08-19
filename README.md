# wisecp-to-whmcs
WiseCP'den WHMCS'e ücretsiz geçiş sistemi

## Aktarılan İşlemler
- Satın Alınan Alan Adları
- Satın Alınan Ürün Hizmetler
- Müşteriler ( Random şifre ve birçok bilgisini ekler)
- Para birimleri
- Faturalar
- Faturalandırılan ürünler
- Ürünler
- Sunucular
- Destek bileti departmanları
- Destek biletleri
- Alan Adı Uzantıları
- Destek bileti cevapları

## Hatalar
- Satın alınan alan adları aktarmada order_id problemi bulunuyor.
- Satın alınan ürün ve hizmetleri aktarmada order_id problemi bulunuyor.
- Faturalandırılan ürünlerde duedate alanındaki tarihde problem bulunuyor.

Ürün fiyatlarının, ürün konfigürasyonlarının tekrar tanımlanması gerekir.

Birebir ID'lerine kadar aktardığı için aktarma yaptıktan sonra bu tablolarda AUTO_INCREMENT değerini son eklenen ID'nin bir üstünü yapmanız gerekiyor.

** Henüz Canlı WHMCS sistemlerde denemeniz önerilmez.

config.php üzerinden
whmcs ve wisecp veritabanı bilgileriniz ile aktarabilirsiniz.
