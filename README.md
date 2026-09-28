# ClickCodex Technologies

A high-performance, modular PHP (MVC) web application and enterprise administration console engineered for digital agency operations, client solutions, architecture advisor, portfolio showcase, blogs, and CRM lead capture.

---

## 🔐 Administrative Access Credentials

The administrative control center can be accessed locally or in production via the administrative route:

| Attribute | Details |
| :--- | :--- |
| **Admin Portal URL** | [http://localhost/clickcodex/admin/login](http://localhost/clickcodex/admin/login) or `/admin/login` |
| **Login ID / Email** | `admin@clickcodex.com` |
| **Password** | `admin123` |
| **Role** | `super_admin` |
| **Quick Action** | 1-Click **"Auto-Fill"** button available on the sign-in screen |

> **Note:** For security in production deployments, make sure to change the default super admin password via the **Users & Access Control** panel (`/admin/users`) or the password reset modal.

---

## 🚀 Key Features & Modules

### 🌐 Public Portal
- **Hero & Services Showroom**: Interactive digital craftsmanship showcase with responsive UI/UX.
- **Solution Advisor & Architecture Finder**: Guided questionnaire helping prospects identify architectural fit and project estimates.
- **Portfolio & Case Studies**: Filterable project showroom showcasing technology stacks and measurable outcomes.
- **Insights & Engineering Blog**: Searchable and categorized technical articles with read-time calculations and rich metadata.
- **Lead Capture & Inquiries**: Real-time validated contact and inquiry submissions.
- **SEO & Social Optimization**: Dynamic Schema.org structured data (Organization, WebSite, Service, BlogPosting), Open Graph tags, XML Sitemap (`/sitemap.xml`), and robots exclusion (`/robots.txt`).

### ⚙️ Administrative Console (`/admin`)
- **Dashboard & Analytics**: Live KPI counters, recent lead activity, and system health status.
- **Lead & CRM Management**: Review, filter, status-toggle, export, and respond to incoming customer inquiries.
- **Solution Advisor Matrix**: Dynamic administration of questions, archetypes, and service mappings.
- **Portfolio Showroom Manager**: Case study CRUD, gallery uploads, tech stack badges, and featured toggles.
- **Blog & Article CMS**: Rich article drafting, categories, slug generation, and SEO tag management.
- **RBAC & User Management**: Role-based access control (`super_admin`, `admin`, `editor`, `seo_specialist`) with instant password reset tools.
- **Site Settings & Studio Configuration Engine (`/admin/settings`)**: Tabbed administrative control for Company Profile, Contact/Campuses, Branding & Theme Colors (with live preview and bidirectional color picker), SEO default OpenGraph cards with Google SERP simulation, Social Channels, Analytics & Pixels (GA4, GTM, Meta Pixel), Custom Code Injections (`<head>` & `<body>`), Legal Compliance & Maintenance toggles, JSON backup export/import, and cache flushing.
- **Audit Logs & Security**: Comprehensive event tracking for user authentications, data modifications, and privilege adjustments.

---

## 💻 Tech Stack & Architecture

- **Backend Architecture**: Custom PHP 8.1+ MVC (Model-View-Controller) structure.
- **Routing Engine**: Custom lightweight regex router (`app/routes.php`) supporting RESTful endpoints and clean URLs.
- **Database Layer**: MySQL / MariaDB via MySQLi with prepared statements and parameter binding.
- **Environment Management**: `vlucas/phpdotenv` with `.env` configuration.
- **Frontend & Styling**: Semantic HTML5, Vanilla CSS3 with custom design tokens, modern glassmorphism, responsive CSS Grid / Flexbox, and vanilla JavaScript (no heavy third-party dependencies).

---

## 🛠️ Local Development & Setup

### 1. Prerequisites
- **Web Server**: Apache (e.g. XAMPP, WAMP, or standalone Apache) with `mod_rewrite` enabled.
- **PHP**: PHP 8.1 or higher.
- **Database**: MySQL 5.7+ or MariaDB 10.4+.
- **Composer**: PHP Dependency Manager.

### 2. Installation Steps
1. Place or clone the repository inside your web server directory (e.g. `C:\xampp\htdocs\clickcodex`).
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Configure environment settings in `.env`:
   ```ini
   APP_NAME="Click Codex"
   APP_ENV=development
   APP_DEBUG=true
   APP_URL=http://localhost/clickcodex

   DB_HOST=localhost
   DB_NAME=clickcodex_db
   DB_USER=root
   DB_PASS=
   ```
4. Initialize and seed the database:
   - Import `database/seed.sql` into MySQL, OR
   - Run the automated reset & population script:
     ```bash
     php database/reset_and_populate_clickcodex.php
     ```

### 3. Verify Production Readiness
Execute the automated test suite to verify routes, HTTP status codes, SEO headers, and sitemap:
```bash
php tests/verify_production_readiness.php
```

---

## 📁 Directory Structure

```plaintext
clickcodex/
├── app/
│   ├── Config/              # Database connection & configurations
│   ├── Controllers/         # Public & Admin controllers
│   │   ├── Admin/           # Dashboard, Auth, CRM, Blogs, Portfolio, etc.
│   │   └── Public/          # Home, Services, Solution Advisor, etc.
│   ├── Middleware/          # Auth & Role verification middleware
│   ├── Models/              # Data models and database queries
│   └── Views/               # HTML/PHP Templates & UI Components
│       ├── admin/           # Administrative portal views
│       ├── errors/          # Custom 404 & 500 error pages
│       ├── layout/          # Header, footer, and navigation partials
│       └── public/          # Public page templates
├── assets/                  # CSS styles, JS scripts, icons, brand assets
├── database/                # Schema definitions, seed data, and migration scripts
├── tests/                   # Verification and test suites
├── .env                     # Environment variables configuration
├── .htaccess                # Apache URL rewriting rules
├── index.php                # Front controller entry point
└── README.md                # Project documentation & credentials
```