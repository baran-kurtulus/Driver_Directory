# Driver Directory

Basit bir surucu yonetim uygulamasi. Kullanici kaydi ve giris mevcut. Admin kullanici suruculeri ekleyebilir, duzenleyebilir ve silebilir.

## Ozellikler

- Surucu listeleme, filtreleme (durum ve arac tipi) ve sayfalama
- Admin icin surucu ekleme, duzenleme ve silme
- Giris ve kayit ekranlari
- Admin bayragi (is_admin) ile yetki kontrolu

## Gereksinimler

- PHP 8.4+
- Composer
- Node.js ve npm

## Kurulum

```bash
git clone <repo-url>
cd driver-directory
composer install
```

Ornek .env olustur ve uygulama anahtarini uret:

```bash
cp .env.example .env
php artisan key:generate
```

SQLite kullanimi icin veritabani dosyasini olustur ve `.env` icinde `DB_CONNECTION=sqlite` degerini kontrol et:

```bash
touch database/database.sqlite
```

Migrasyon ve seed islemlerini calistir:

```bash
php artisan migrate --seed
```

Frontend assets:

```bash
npm install
npm run dev
```

## Varsayilan Admin Bilgileri (Sadece Local)

- E-posta: `admin@example.com`
- Sifre: `admin`

Giris ekraninda sadece e-posta ile giris yapabilirsiniz.

## Yetkilendirme Davranisi

- Admin kullanicilar: surucu ekleme, duzenleme ve silme yapabilir.
- Admin olmayanlar: listeyi gorur, ekle/duzenle/sil butonlarini goremez.

## Notlar

- Surucu kaydi icin form dogrulamalari Form Request siniflariyla yapilir.
- Seed islemi local ortamda admin kullanici ve ornek surucu kayitlarini olusturur.
