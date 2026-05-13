
# 🛒 Laravel E-Commerce Project

A full-featured e-commerce web application built with Laravel.  
It provides a complete online shopping experience including products, cart, orders, and admin management.

---

## ✨ Features

 Products  
- Add / Edit / Delete products  
- Upload product images  
- Product listing page  
- Product details page  

 Cart System  
- Add products to cart  
- Update quantity  
- Remove items  
- Session-based cart storage  

 Orders  
- Create order from cart  
- Store order in database  
- View user orders  

 Admin Panel  
- Manage products  
- Manage categories  
- View all orders  

 Authentication  
- Register / Login / Logout  
- Middleware protection  
- Secure password hashing  

---

##  Tech Stack

- Laravel  
- PHP 8+  
- MySQL  
- Blade Templates  
- Bootstrap  
- Eloquent ORM  

---
## Admin Credentials  
Email: admin@gmail.com  
Password: 123456789


##  Installation Steps
```bash
Clone repository:
git clone https://github.com/AhmedKhaled858/e-commerce.git
cd e-commerce
 ```
---

Install dependencies:
```bash
composer install
npm install
npm run dev
 ```
---

Setup environment:
```bash
cp .env.example .env
php artisan key:generate
```
---

Configure database in .env:
```
DB_DATABASE=e-commerce
DB_USERNAME=root
DB_PASSWORD=
```
---

Run migrations:
```bash
php artisan migrate

(Optional)
php artisan db:seed
```
---

Start project:
php artisan serve

Open in browser:
http://127.0.0.1:8000

---
## Project Structure
```
root/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Application logic (Products, Cart, Orders)
│   │   └── Middleware/        # Auth & role-based access control
│   └── Models/                # Database models (Eloquent ORM)
├── database/
│   ├── migrations/            # Database schema structure
│   └── seeders/               # Seed test data
├── resources/
│   └── views/
│       ├── layouts/           # Main layout templates
│       ├── products/          # Product pages
│       ├── cart/              # Cart pages
│       ├── admin/             # Admin dashboard
│       └── auth/              # Authentication pages
└── routes/
    └── web.php                # Main application routes
```
##  What I Learned

- Laravel MVC architecture  
- Eloquent ORM relationships  
- Session-based cart system  
- Authentication system  
- CRUD operations in real-world apps  

---

##  Future Improvements

- Payment gateway integration (Stripe / PayPal)  
- Product search & filtering  
- Wishlist system  
- REST API for frontend (React / Vue)  
- Email notifications  

---

## Author

Ahmed Khaled  
[![GitHub](https://img.shields.io/badge/GitHub-AhmedKhaled858-black?style=for-the-badge&logo=github)](https://github.com/AhmedKhaled858)

