# ☕ Sistem Reservasi Meja Kafe

Sistem Reservasi Meja Kafe adalah aplikasi berbasis web yang memudahkan pelanggan melakukan reservasi meja secara online, melakukan konfirmasi pembayaran, serta memantau status reservasi. Di sisi lain, admin dapat mengelola data meja, memverifikasi akun pelanggan, memverifikasi reservasi dan pembayaran, serta mengelola pengumuman.

---

## 📸 Preview

> Tambahkan screenshot aplikasi di sini.

| Halaman         | Screenshot                   |
| --------------- | ---------------------------- |
| Landing Page    | `images/home.png`            |
| Dashboard       | `images/dashboard.png`       |
| Reservasi       | `images/reservation.png`     |
| Pembayaran      | `images/payment.png`         |
| Admin Dashboard | `images/admin-dashboard.png` |

---

# ✨ Features

## 👤 Customer

- Registrasi akun
- Melihat status pendaftaran akun
- Login
- Melihat daftar meja
- Reservasi meja
- Melihat detail reservasi
- Riwayat reservasi
- Konfirmasi pembayaran
- Mengubah profil
- Melihat pengumuman terbaru

---

## 👨‍💼 Admin

- Login
- Dashboard
- Verifikasi akun pelanggan
- Manajemen pelanggan
- CRUD meja
- Verifikasi reservasi
- Verifikasi pembayaran
- CRUD pengumuman

---

# 🏗️ Tech Stack

### Backend

- Laravel 12
- PHP 8.3

### Frontend

- Blade
- Tailwind CSS
- JavaScript

### Database

- MySQL

### Authentication

- Laravel Breeze

### Development Tools

- Composer
- NPM
- Vite

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
resources/
├── views/
├── css/
└── js/
│
routes/
├── web.php
└── auth.php
```

---

# ⚙️ Installation

Clone repository

```bash
git clone https://github.com/USERNAME/REPOSITORY.git
```

Masuk ke folder project

```bash
cd REPOSITORY
```

Install dependency

```bash
composer install

npm install
```

Copy file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Konfigurasi database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservasi_kafe
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration

```bash
php artisan migrate
```

Jalankan Vite

```bash
npm run dev
```

Jalankan aplikasi

```bash
php artisan serve
```

---

# 🚀 Main Modules

| Module               | Description               |
| -------------------- | ------------------------- |
| Authentication       | Login, Register, Logout   |
| Account Approval     | Verifikasi akun pelanggan |
| Table Management     | CRUD meja                 |
| Reservation          | Reservasi meja            |
| Reservation History  | Riwayat reservasi         |
| Payment Confirmation | Upload bukti pembayaran   |
| Payment Verification | Verifikasi pembayaran     |
| Announcement         | CRUD pengumuman           |
| Profile              | Edit profil pengguna      |

---

# 👥 User Roles

## Customer

- Register account
- Check account registration status
- Login
- Make table reservations
- View reservation history
- Confirm payment
- View announcements

## Admin

- Login
- Verify customer accounts
- Manage customers
- Manage tables
- Verify reservations
- Verify payments
- Manage announcements

---

# 📋 Reservation Flow

```text
Register Account
        │
        ▼
Waiting Account Approval
        │
        ▼
Login
        │
        ▼
Choose Table
        │
        ▼
Create Reservation
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

# 🗄️ Database

Beberapa tabel utama:

- users
- tables
- reservations
- payments
- announcements

---

# 📌 Future Improvements

- Email notification
- WhatsApp notification
- QR Code reservation
- Online payment gateway
- Reservation cancellation
- Reservation report
- Dashboard analytics

---

# 📄 License

Project ini dibuat untuk keperluan akademik dan pengembangan portofolio.

---

# 👨‍💻 Author

**Septiawan**

Backend Developer

## 🤝 Let's Connect

- LinkedIn: https://www.linkedin.com/in/mseptiawan/
- Email: mseptiawan017@gmail.com
