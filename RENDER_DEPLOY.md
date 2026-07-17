# 🚀 دليل النشر على Render - مشروع Al-Fateeh

## المتطلبات قبل البدء

- [ ] حساب على [render.com](https://render.com)
- [ ] المشروع مرفوع على GitHub
- [ ] بيانات قاعدة البيانات (Neon PostgreSQL) جاهزة
- [ ] `APP_KEY` جاهز (من ملف `.env` المحلي)

---

## خطوات النشر

### 1. ارفع الكود إلى GitHub

```bash
git add .
git commit -m "chore: add Render deployment configuration"
git push origin main
```

### 2. أنشئ Service جديد في Render

1. اذهب إلى [dashboard.render.com](https://dashboard.render.com)
2. اضغط **New → Web Service**
3. اختر **"Build and deploy from a Git repository"**
4. اربط حساب GitHub وابحث عن مستودع `AL-fateeh`

### 3. إعدادات الـ Service

| الإعداد        | القيمة                  |
|----------------|-------------------------|
| **Name**       | `al-fateeh`             |
| **Region**     | Frankfurt (أقرب للعرب)  |
| **Branch**     | `main`                  |
| **Runtime**    | `Docker`                |
| **Dockerfile** | `./Dockerfile`          |
| **Plan**       | Free أو Starter         |

### 4. متغيرات البيئة (Environment Variables)

أضف هذه المتغيرات في قسم **"Environment"** داخل Render Dashboard:

| المتغير               | القيمة                          |
|----------------------|---------------------------------|
| `APP_KEY`            | `base64:XXXX` (من ملف .env)    |
| `APP_URL`            | `https://al-fateeh.onrender.com`|
| `DB_HOST`            | رابط Neon PostgreSQL            |
| `DB_DATABASE`        | اسم قاعدة البيانات              |
| `DB_USERNAME`        | اسم المستخدم                    |
| `DB_PASSWORD`        | كلمة المرور                     |
| `MAIL_HOST`          | smtp.mailgun.org (أو غيره)     |
| `MAIL_USERNAME`      | بريد SMTP                       |
| `MAIL_PASSWORD`      | كلمة مرور SMTP                  |
| `MAIL_FROM_ADDRESS`  | noreply@yourdomain.com          |

> ⚠️ **لا تضع** `APP_KEY` في `render.yaml` أو Git. أضفها يدوياً في Dashboard فقط.

### 5. Health Check

Render سيتحقق من `/up` — هذا المسار موجود مسبقاً في Nginx.
في إعدادات الـ Service:
- **Health Check Path**: `/up`

### 6. اضغط "Create Web Service"

Render سيبدأ بناء Docker image تلقائياً. البناء الأول يستغرق **5-10 دقائق**.

---

## بعد النشر

### التحقق من النجاح

```
https://al-fateeh.onrender.com/up
# يجب أن يرجع: OK
```

### مشاهدة اللوغز

في Render Dashboard:
- اذهب إلى Service → **Logs**
- ستجد سجلات entrypoint.sh و migrations و Nginx

### تشغيل أوامر Artisan

في Render Dashboard:
- اذهب إلى Service → **Shell**
- ```bash
  php artisan migrate:status
  php artisan cache:clear
  ```

---

## ملاحظات مهمة

### 🆓 الخطة المجانية (Free Tier)
- الحاوية **تتوقف** بعد 15 دقيقة من عدم الاستخدام
- البدء الأول بعد التوقف يستغرق ~30 ثانية (cold start)
- مناسب للتطوير والاختبار

### 💰 الخطة المدفوعة (Starter - $7/شهر)
- لا توقف — الحاوية تعمل دائماً
- مناسب للإنتاج

### 📁 التخزين الدائم (Persistent Storage)
> ⚠️ **هام**: Render Free لا يدعم Persistent Disks.
> الملفات المرفوعة في `storage/app` ستُحذف عند كل deploy.
> **الحل**: استخدم S3 أو Cloudflare R2 لتخزين الملفات.

---

## استكشاف الأخطاء

### خطأ: "Port not accessible"
- تأكد أن `$PORT` يُستبدل في Nginx config (يحدث تلقائياً عبر entrypoint.sh)

### خطأ: "Migration failed"
- تحقق من بيانات Neon PostgreSQL في Environment Variables
- تأكد أن DB_HOST صحيح

### خطأ: "APP_KEY not set"
- أضف `APP_KEY` في Render Dashboard → Environment

### بطء في الاستجابة
- الخطة المجانية تسبب cold start — انتقل للخطة المدفوعة
