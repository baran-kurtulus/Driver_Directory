# Driver Directory

Basit bir surucu yonetim uygulamasi. Kullanici kaydi ve giris mevcut. Admin kullanici suruculeri duzenleyebilir ve silebilir.

## Ozellikler

- Surucu listeleme, filtreleme (durum ve arac tipi) ve sayfalama
- Surucu ekleme formu
- Admin icin surucu duzenleme ve silme
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

## Varsayilan Admin Bilgileri

- Kullanici adi: `admin`
- E-posta: `admin@example.com`
- Sifre: `admin`

Giris ekraninda kullanici adi veya e-posta ile giris yapabilirsiniz.

## Yetkilendirme Davranisi

- Admin kullanicilar: surucu duzenleme ve silme yapabilir.
- Admin olmayanlar: listeyi gorur, duzenle/sil butonlarini goremez.

## Notlar

- Surucu kaydi icin form dogrulamalari Form Request siniflariyla yapilir.
- Seed islemi admin kullanici ve ornek surucu kayitlarini olusturur.
