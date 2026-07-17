# ☕ Sistem Reservasi Meja Kafe

Sistem Reservasi Meja Kafe adalah aplikasi berbasis web yang dirancang untuk memudahkan pelanggan melakukan reservasi meja secara online tanpa harus datang langsung ke lokasi. Sistem ini juga membantu admin dalam mengelola meja, memverifikasi akun pelanggan, memproses reservasi, memverifikasi pembayaran, serta menyampaikan informasi kepada pelanggan melalui fitur pengumuman.

---

## 📸 Preview

| Halaman               | Preview                                    |
| --------------------- | ------------------------------------------ |
| Landing Page          | ![](docs/images/landing-page.png)          |
| Dashboard             | ![](docs/images/dashboard.png)             |
| Reservasi Meja        | ![](docs/images/buat-reservasi.png)        |
| Persetujuan Reservasi | ![](docs/images/persetujuan-reservasi.png) |
| Pembayaran            | ![](docs/images/konfirmasi-pembayaran.png) |
| Pengumuman            | ![](docs/images/pengumuman.png)            |

---

# ✨ Features

## 👤 Customer

- Registrasi akun
- Melihat status pendaftaran akun
- Login
- Melihat daftar meja
- Reservasi meja
- Melihat detail reservasi
- Melihat riwayat reservasi
- Konfirmasi pembayaran
- Mengubah profil
- Melihat pengumuman

---

## 👨‍💼 Admin

- Login
- Dashboard Admin
- Verifikasi akun pelanggan
- CRUD data meja
- Verifikasi reservasi
- Verifikasi pembayaran
- CRUD pengumuman

---

# 🛠 Tech Stack

### Backend

- Laravel 13
- PHP 8.4

### Frontend

- Blade
- Tailwind CSS
- JavaScript
- Vite

### Database

- MySQL 8.4

### Development Environment

- Laravel Sail
- Docker
- Docker Compose

### Database Management

- phpMyAdmin

---

# 🐳 Docker Services

| Service      | Description              |
| ------------ | ------------------------ |
| Laravel Sail | PHP Runtime & Web Server |
| MySQL 8.4    | Database                 |
| phpMyAdmin   | Database Management      |

---

# 📂 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
│
├── Models/
│
database/
├── migrations/
├── seeders/
│
public/
│
resources/
├── css/
├── js/
└── views/
│
routes/
├── web.php
└── auth.php
│
docker-compose.yml
│
README.md
```

---

# 🚀 Installation

Pilih salah satu metode berikut:

- **Option A** — Laravel Sail (Recommended)
- **Option B** — Local Development (Without Docker)

---

# Option A — Laravel Sail (Docker)

## 1. Clone Repository

```bash
git clone https://github.com/mseptiawan/reservasi-meja-kafe.git
cd reservasi-meja-kafe
```

## 2. Copy Environment File

```bash
cp .env.example .env
```

## 3. Install Dependencies

```bash
docker run --rm \
-u "$(id -u):$(id -g)" \
-v $(pwd):/opt \
-w /opt \
laravelsail/php85-composer:latest \
composer install
```

## 4. Generate Application Key

```bash
php artisan key:generate
```

## 5. Start Sail

```bash
./vendor/bin/sail up -d
```

## 6. Install Frontend Dependencies

```bash
./vendor/bin/sail npm install
```

## 7. Run Migration

```bash
./vendor/bin/sail artisan migrate --seed
```

## 8. Run Vite

```bash
./vendor/bin/sail npm run dev
```

Website:

```
http://localhost
```

phpMyAdmin:

```
http://localhost:8080
```

---

# Option B — Local Development (Without Docker)

## Requirements

- PHP 8.5+
- Composer
- Node.js
- MySQL 8.4+

## 1. Clone Repository

```bash
git clone https://github.com/USERNAME/REPOSITORY.git
cd REPOSITORY
```

## 2. Copy Environment File

```bash
cp .env.example .env
```

## 3. Install PHP Dependencies

```bash
composer install
```

## 4. Generate Application Key

```bash
php artisan key:generate
```

## 5. Configure Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservasi_meja_kafe
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 6. Install Node Modules

```bash
npm install
```

## 7. Run Database Migration

```bash
php artisan migrate --seed
```

## 8. Run Development Server

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

Website:

```
http://127.0.0.1:8000
```

---

## 9. Akses Aplikasi

| Service    | URL                   |
| ---------- | --------------------- |
| Website    | http://localhost      |
| phpMyAdmin | http://localhost:8080 |

---

# ⚙️ Environment Variables

Contoh konfigurasi `.env`

```env
APP_NAME="Reservasi Meja Kafe"

APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=reservasi_kafe
DB_USERNAME=sail
DB_PASSWORD=password

```

---

# 📌 Main Modules

| Module               | Description                    |
| -------------------- | ------------------------------ |
| Authentication       | Login, Register                |
| Dashboard            | Dashboard sesuai role pengguna |
| Account Approval     | Verifikasi akun pelanggan      |
| Customer Management  | Daftar pelanggan               |
| Table Management     | CRUD meja                      |
| Reservation          | Reservasi meja                 |
| Reservation History  | Riwayat reservasi              |
| Payment Confirmation | Upload bukti pembayaran        |
| Payment Verification | Verifikasi pembayaran          |
| Announcement         | CRUD pengumuman                |
| Profile              | Edit profil pengguna           |

---

# 🔄 Reservation Flow

```text
Register Account
        │
        ▼
Waiting Account Verification
        │
        ▼
Login
        │
        ▼
Choose Table
        │
        ▼
Create Reservation and Waiting Verification
        │
        ▼
Upload Payment Proof
        │
        ▼
Payment Verification
        │
        ▼
Reservation Completed
```

---

# 🗄 Database

Tabel utama pada sistem:

- users
- tables
- reservations
- payments
- announcements

---

# 📄 License

Project ini dibuat untuk keperluan sertifikasi

---

# 👨‍💻 Author

**Septiawan**

Entrepreneur

## 🤝 Let's Connect

- LinkedIn: https://www.linkedin.com/in/mseptiawan/
- Email: mseptiawan017@gmail.com
