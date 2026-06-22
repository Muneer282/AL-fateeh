# 🏍️ Al-Fateeh Motorcycle Showroom | معرض الفتيح للدرجات النارية

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

## 📝 Description | الوصف

### [Arabic]
**معرض الفتيح للدرجات النارية** هو تطبيق ويب متكامل مبني باستخدام إطار العمل Laravel. يهدف المشروع إلى توفير منصة عرض حديثة وجذابة للدرجات النارية المتوفرة في المعرض، مع واجهة إدارة سهلة الاستخدام للتحكم في المخزون. يتميز النظام بتصميم عصري (Dark Orange Theme) وتوافق تام مع الأجهزة المحمولة.

### [English]
**Al-Fateeh Motorcycle Showroom** is a comprehensive web application built with Laravel. This project provides a modern and attractive platform to showcase motorcycles available in the showroom, featuring an intuitive admin dashboard for inventory management. The system boasts a sleek dark orange design and is fully responsive for mobile devices.

---

## ✨ Features | المميزات

- 🎨 **Modern UI/UX**: Premium design using a Black & Orange theme with elegant gradients and glassmorphism.
- 📱 **Mobile First**: Fully responsive layout optimized for all screen sizes.
- 🛒 **Product Catalog**: Dynamic list of motorcycles with filtering capabilities.
- 💬 **WhatsApp Integration**: Direct "Buy Now" or "Inquire" buttons that link users directly to WhatsApp.
- 🔐 **Authentication**: Complete user registration and login system.
- 🌐 **Social Login**: Integration with Google Socialite for easy access.
- 🛠️ **Admin Dashboard**: Secure area for administrators to manage (Add/Edit/Delete) products.
- 📍 **Location Integration**: Section for showroom location and contact details.

---

## 🚀 Tech Stack | التقنيات المستخدمة

- **Backend**: [Laravel 11.x](https://laravel.com)
- **Database**: [MySQL](https://www.mysql.com/)
- **Frontend**: [Vite](https://vitejs.dev/) + Vanilla CSS (No bulky frameworks)
- **Authentication**: Laravel Socialite (Google Auth)
- **Icons**: SVG & Custom fonts (Cairo & Outfit)

---

## 🛠️ Installation | التثبيت

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL Server

### Quick Setup
The project includes a built-in setup script. Simply run:
```bash
composer run setup
```

### Manual Installation
1. **Clone the repository:**
   ```bash
   git clone https://github.com/YOUR_USERNAME/Al-Fateeh.git
   cd Al-Fateeh
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Environment Configuration:**
   Copy the example environment file and update your database & Google credentials:
   ```bash
   cp .env.example .env
   ```
   *Edit `.env` and set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and Google Socialite keys.*

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

7. **Compile Assets:**
   ```bash
   npm run build # For production
   # OR
   npm run dev # For development
   ```

---

## 📸 Screenshots | لقطات الشاشة

*(Please add your project screenshots here)*

| Home Page | Product List | Admin Dashboard |
| :---: | :---: | :---: |
| ![Home Placeholder](https://via.placeholder.com/300x200?text=Home+Page) | ![Products Placeholder](https://via.placeholder.com/300x200?text=Product+List) | ![Admin Placeholder](https://via.placeholder.com/300x200?text=Admin+Dashboard) |

---

## 👨‍💻 Contributing | المساهمة

Contributions are welcome! If you find any bugs or have feature suggestions, please open an issue or submit a pull request.

---

## 📞 Contact | التواصل

- **Name**: [Your Name Here]
- **Email**: [Your Email Here]
- **WhatsApp**: [Your Phone Here]
- **GitHub**: [@YourGitHubUsername]

---

## 📄 License | الترخيص

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
