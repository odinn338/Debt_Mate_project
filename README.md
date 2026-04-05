# 💰 Debt Mate

A smart debt and payment management system built with Laravel, designed to help users track their debts and payments efficiently.

---

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Database Schema](#database-schema)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Screenshots](#screenshots)

---

## 📌 About

Debt Mate is a web application that allows users to register as either a **Creditor** (one who lends) or a **Debtor** (one who borrows), and manage all their financial obligations in one place.

---

## ✨ Features

- 🔐 Authentication (Register / Login / Logout)
- 👤 Two account types: **Creditor** and **Debtor**
- 📊 Dashboard with real-time financial statistics
- 📈 Monthly payment analysis charts (Chart.js)
- 💸 Debt management (Add / View / Delete)
- ✅ Payment tracking with full history
- 🔔 Overdue debt notifications
- 👁️ Personal profile with financial summary
- 📱 Responsive Arabic RTL UI

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12 |
| Frontend | Blade Templates |
| Styling | Custom CSS |
| Charts | Chart.js |
| Icons | Font Awesome 6 |
| Font | Cairo (Google Fonts) |
| Database | MySQL |

---

## 🗄 Database Schema
Table creditors {
id bigint [pk, increment]
name varchar
email varchar [unique]
phone varchar
password varchar
created_at timestamp
updated_at timestamp
}
Table debtors {
id bigint [pk, increment]
name varchar
email varchar [unique]
phone varchar
password varchar
created_at timestamp
updated_at timestamp
}
Table debts {
id bigint [pk, increment]
creditor_id bigint [ref: > creditors.id]
debtor_id bigint [ref: > debtors.id]
title varchar
description text
amount decimal
paid_amount decimal
due_date date
status enum('pending', 'partial', 'paid', 'overdue')
type enum('owed_by_me', 'owed_to_me')
created_at timestamp
updated_at timestamp
}
Table payments {
id bigint [pk, increment]
debt_id bigint [ref: > debts.id]
debtor_id bigint [ref: > debtors.id]
amount decimal
payment_date date
note varchar
created_at timestamp
updated_at timestamp
}

---

## ⚙️ Installation
```bash
# 1. Clone the repository
git clone https://github.com/odinn338/Debt_Mate_project.git
cd Debt_Mate_project

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure your database in .env
DB_DATABASE=debt_mate
DB_USERNAME=root
DB_PASSWORD=

# 5. Run migrations
php artisan migrate:fresh

# 6. Start the server
php artisan serve
```

---

## 🚀 Usage

1. Go to `http://127.0.0.1:8000/register`
2. Create an account and select your account type (**Creditor** or **Debtor**)
3. Login and access your dashboard
4. Add debts, track payments, and monitor your financial status

---

## 📁 Project Structure
app/
├── Http/
│   └── Controllers/
│       ├── AuthController.php
│       ├── DashboardController.php
│       ├── DebtController.php
│       └── PaymentController.php
├── Models/
│   ├── User.php
│   ├── Debt.php
│   └── Payment.php
resources/
└── views/
├── layout/
│   ├── sidebar.blade.php
│   └── footer.blade.php
├── pages/
│   ├── index.blade.php
│   ├── debts.blade.php
│   ├── payments.blade.php
│   └── Auth/
│       ├── login.blade.php
│       └── register.blade.php
└── users/
└── profile.blade.php
routes/
└── web.php
database/
└── migrations/

---

## 👨‍💻 Author

**Ahmed** — [@odinn338](https://github.com/odinn338)

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).