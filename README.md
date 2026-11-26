# Modular Loan Management System

Web application para sa Philippine setting, batay sa requirements document. Magkahiwalay ang PHP backend at Next.js frontend; suportado ang LMS-only, Accounting-only, at integrated modes.

## Project structure

- `backend/` — PHP REST API, PDO/MySQL, Composer-managed dependencies, authentication, permissions, audit, and business logic
- `frontend/` — Next.js interface na kumokonekta sa PHP API
- `PLAN.md` — phased project plan at oras/acceptance criteria

## Requirements

- PHP 8.0.25+ at Composer
- MySQL 8 / MariaDB
- Node.js 20.9+ (para sa kasalukuyang Next.js release)

## Local setup (Windows / XAMPP)

1. I-start ang MySQL sa XAMPP.
2. I-import ang schema at sample data:

```bat
C:\xampp\mysql\bin\mysql.exe -u root < backend\sql\schema.sql
C:\xampp\mysql\bin\mysql.exe -u root lms_accounting < backend\sql\seed.sql
C:\xampp\php\php.exe backend\seed.php
```

3. Kopyahin ang `backend\.env.example` bilang `backend\.env` kung wala pang local configuration. Itakda ang database credentials at `FRONTEND_URL=http://localhost:3000`. Huwag i-commit ang `.env`.
4. I-install ang PHP dependencies at patakbuhin ang API:

```bat
cd backend
composer install
C:\xampp\php\php.exe -S localhost:8080 router.php
```

5. Sa hiwalay na terminal, i-install at patakbuhin ang Next.js frontend:

```bat
cd frontend
npm install
npm run dev
```

Buksan ang http://localhost:3000. Kung iba ang API address, gumawa ng `frontend\.env.local` na may `NEXT_PUBLIC_API_URL=http://localhost:8080`, at itugma ang `FRONTEND_URL` sa backend `.env`.

## Demo accounts

| Role | Email | Password |
|---|---|---|
| Super Admin | admin@lms.local | Admin@123 |
| Loan Officer | officer@lms.local | Officer@123 |
| Accountant | accountant@lms.local | Accountant@123 |
| Viewer | viewer@lms.local | Viewer@123 |

Ang self-registration ay gumagawa ng 30-araw na trial Viewer account.

## Mahalagang verification

- I-toggle ang LMS at Accounting sa Settings; dapat naaayon dito ang menu at API access.
- Gumawa ng loan na ₱100,000, 12% declining balance, 12 buwan; unang hulog ay ₱9,333.33 (₱1,000 interest + ₱8,333.33 principal).
- Tingnan kung naitatala ang audit events at naaangkop ang role permissions.
- Patunayan ang LMS-only, Accounting-only, at integrated modes.
