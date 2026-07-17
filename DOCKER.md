# 🐳 دليل Docker - مشروع Al-Fateeh

## هيكل ملفات Docker

```
Al-Fateeh/
├── Dockerfile                    # صورة الإنتاج
├── docker-compose.yml            # تشغيل الحاويات
├── .dockerignore                 # ملفات مستبعدة من البناء
├── .env.production.example       # مثال متغيرات الإنتاج
└── docker/
    ├── nginx/
    │   └── default.conf          # إعدادات Nginx
    ├── php/
    │   ├── php.ini               # إعدادات PHP
    │   └── php-fpm.conf          # إعدادات PHP-FPM
    ├── supervisor/
    │   └── supervisord.conf      # إدارة العمليات
    └── entrypoint.sh             # سكريبت بدء التشغيل
```

---

## 🖥️ التشغيل المحلي (للاختبار)

```bash
# 1. بناء الصورة
docker build -t al-fateeh .

# 2. تشغيل الحاوية
docker run -d \
  --env-file .env \
  -p 8000:80 \
  --name al-fateeh-app \
  al-fateeh

# 3. افتح المتصفح على
http://localhost:8000
```

---

## 🚀 الرفع إلى الاستضافة

### الطريقة 1: Docker Hub (الأسهل)

```bash
# على جهازك المحلي - بناء ورفع الصورة
docker login
docker build -t yourusername/al-fateeh:latest .
docker push yourusername/al-fateeh:latest

# على الاستضافة - تشغيل الصورة
docker pull yourusername/al-fateeh:latest
docker run -d \
  --env-file .env \
  -p 80:80 \
  --name al-fateeh \
  yourusername/al-fateeh:latest
```

### الطريقة 2: نسخ الملفات إلى الاستضافة

```bash
# 1. انسخ الملفات للاستضافة عبر SCP
scp -r . user@yourserver:/var/www/al-fateeh

# 2. على الاستضافة - أنشئ .env من المثال
cp .env.production.example .env
nano .env  # عدّل القيم

# 3. ابنِ وشغّل
docker compose up -d --build
```

---

## ⚙️ أوامر مفيدة

```bash
# عرض الـ logs
docker compose logs -f

# الدخول للحاوية
docker compose exec app sh

# تشغيل artisan commands
docker compose exec app php artisan migrate
docker compose exec app php artisan cache:clear

# إعادة البناء بعد تعديلات
docker compose up -d --build

# إيقاف كل شيء
docker compose down
```

---

## 📝 ملاحظات مهمة

- قاعدة البيانات (Neon PostgreSQL) خارجية، لا تحتاج إلى حاوية database منفصلة
- ملف `.env` لا يُرفع إلى Git لأنه يحتوي على بيانات حساسة
- يتم تشغيل Nginx + PHP-FPM + Queue Worker داخل حاوية واحدة عبر Supervisor
