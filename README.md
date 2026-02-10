# StockMaster-Pro 📦

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-00000f?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-8993be?style=for-the-badge&logo=phpunit&logoColor=white)](https://phpunit.de/)

**StockMaster-Pro** is a professional-grade Inventory Management System (IMS) engineered for high-performance stock tracking and warehouse optimization. Built on the **TALL stack**, it offers a seamless, reactive user experience combined with enterprise-level security and modular architecture.

---

## 🚀 Technical Stack

* **TALL Stack:** Laravel, Alpine.js, Livewire, and Tailwind CSS.
* **UI Framework:** [Preline UI](https://preline.co/) for advanced, accessible dashboard components.
* **Authentication:** [Laravel Breeze](https://laravel.com/docs/billing) for secure, streamlined login flows.
* **Authorization:** [Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission/v6/introduction) for granular Role-Based Access Control (RBAC).
* **Database:** MySQL with optimized relational schema for inventory integrity.

---

## 🛠 Engineering Workflow

This project is developed using industry-standard DevOps and Agile practices:

* **Agile/Scrum:** Development managed through structured **Sprints**, tracking tasks via **GitHub Issues**.
* **Git Workflow:** Strict branching strategy (e.g., `feature/`, `bugfix/`, `hotfix/`) to maintain a stable `main` branch.
* **Testing:** Robust **Unit Testing** via **PHPUnit** to ensure business logic accuracy and prevent regressions during stock calculations.

---

## ✨ Key Features

* **Real-time Inventory Management:** Reactive updates for stock movements using Laravel Livewire.
* **Advanced RBAC:** Defined user roles (Admin, Manager, Staff) powered by Spatie.
* **Responsive Dashboard:** Optimized for both desktop and mobile warehouse use via Preline & Tailwind.
* **Transaction Auditing:** Detailed history of inventory adjustments, additions, and deletions.
* **Stock Alerts:** Visual indicators and notifications for low-stock items.

---

## 🔧 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/BenTaleb-Mehdi/StockMaster-Pro.git](https://github.com/BenTaleb-Mehdi/StockMaster-Pro.git)
   cd StockMaster-Pro

   ```

2. **Install PHP & JS dependencies:**
   ```bash
    composer install
    npm install && npm run build

   ```

3. **Environment Configuration:**
   ```bash
    cp .env.example .env
    php artisan key:generate

   ```

4. **Database Migration & Seeding:**
   ```bash
    php artisan migrate --seed

   ```

5. **Run the application:**
   ```bash
   php artisan serve

   ```

   ## **Testing**
   ### Execute the test suite to ensure the system logic is functioning correctly:
   ```bash
    php artisan test

   ```

   ## Contact
   ### BenTaleb Mehdi [kedin.com/in/mehdi-bentaleb](https://www.linkedin.com/in/mehdi-bentaleb/)
    **Would you like me to generate a specific "Roadmap" section for your upcoming sprints or perhaps a detailed "Permissions" table for the Spatie roles?**


   
