# Tes WEB PROGRAMMER (PHP) PT. Transindo Data Perkasa

## Deskripsi

Aplikasi Tes WEB PROGRAMMER (PHP) untuk PT. Transindo Data Perkasa. Detail soal tes di [soal.pdf](soal.pdf).

## Setup Lingkungan Pengembangan

Pastikan Anda menggunakan bundle pack Laragon versi Full 6.0 dengan persyaratan berikut:

- **Maria DB** versi 10.5
- **PHP** versi 8.2.16
- **Node.js** versi 18.8.0
- **NPM** versi 8.18.0

## Instruksi Instalasi

1. Clone repositori ini ke dalam direktori lokal Anda:

    ```bash
    git clone 
    copy .env.example .env
    php artinan migrate --seed
    npm run dev 
    php artisan serve
    ```