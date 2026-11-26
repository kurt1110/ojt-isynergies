# Plano ng Proyekto: Modular Loan Management System

Batay sa [LMS Accounting System Requirements Document](C:/Users/PC/Downloads/LMS_Accounting_System_Requirements_Document%20(2).docx). Sundin ang itinakdang saklaw; huwag magdagdag ng feature nang walang pahintulot.

## Hiwalay na frontend at backend

| Bahagi | Teknolohiya | Responsibilidad |
|---|---|---|
| Frontend (`frontend/`) | Next.js, React | Mga pahina, forms, navigation, at pagpapakita ng data mula sa API |
| Backend (`backend/`) | PHP REST API, Composer, PDO | Authentication, authorization, validation, business rules, audit, at reports |
| Database | MySQL 8 | Normalized na application data, settings, at audit trail |

Magkaiba ang frontend at backend processes. Nakikipag-ugnayan ang Next.js UI sa PHP API sa pamamagitan ng HTTP requests; ang PHP API lamang ang direktang kumokonekta sa MySQL.

## Paglalaan ng 500 oras (tantya)

| Phase | Oras | Kinalabasan |
|---|---:|---|
| 1. Foundation & Security | 100 | Secure na login, roles, settings, audit, at reusable project foundation |
| 2. Accounting Core | 110 | Chart of Accounts, journals, ledger, trial balance, at financial statements |
| 3. Loan Management | 130 | Clients, loan products, applications, schedules, at payments |
| 4. Integration Layer | 70 | Configurable account mappings at journal posting/queue mula sa LMS events |
| 5. Reports, BIR Support & Polish | 90 | LMS at accounting reports, BIR-supporting summaries, tests, at handoff |

Oras ay gabay lamang; unahin ang acceptance criteria at kumpletuhin/test ang bawat phase bago lumipat.

## Phase 1 — Foundation & Security (100 oras)

1. **Pagpapatibay ng setup at scope (6 oras):** tiyakin ang PHP/MySQL environment, API/Next.js configuration, deployment setup, registration policy, trial rules, at role permissions.
2. **Project at Composer foundation (10 oras):** panatilihin ang magkahiwalay na `backend/` at `frontend/`; ayusin ang backend config/routes/process/pages/includes/assets ayon sa pangangailangan; pamahalaan ang PHP dependencies sa Composer at secrets sa `.env`.
3. **Database foundation (12 oras):** schema at setup/seed scripts para sa users, roles, permissions, settings, audit logs, at rate-limit data; gumamit ng PDO at indexes/constraints.
4. **Authentication at sessions (18 oras):** registration/login/logout gamit ang `password_hash()` at `password_verify()`, session ID rotation, idle timeout, at central trial-expiration check.
5. **Authorization (14 oras):** server-side permission checks para sa Super Admin, Administrator, Loan Officer, Accountant, at Viewer, sa bawat protektadong page/action.
6. **Settings UI/API (12 oras):** i-save ang company details at independent LMS/Accounting enable switches; itago ang UI para sa disabled module at i-enforce rin ito sa backend.
7. **Audit at rate limiting (12 oras):** itala ang login at create/update/delete events; limitahan ang requests batay sa user account at IP; protektahan ang audit logs laban sa pagbabago ng normal users.
8. **Security verification at dokumentasyon (16 oras):** CSRF, input validation, output escaping, prepared statements, CORS/session behavior, unauthorized access, trial expiry, at malinis na install walkthrough.

**Phase 1 acceptance checks:** gumagana ang install mula sa setup instructions; hindi naa-access ang protected API nang walang login/permission; nare-regenerate at nag-e-expire ang session; naitatala at napoprotektahan ang audit logs; gumagana ang role permissions, trial expiry, module switches, CSRF, validation, prepared queries, at user/IP rate limits.

**Mga desisyong kailangan kumpirmahin bago itakda sa production:** kung bukas sa publiko ang registration o administrator-managed; detalyadong permission matrix; at eksaktong simula/tagal ng trial. Hindi tinutukoy nang buo ng requirements ang mga ito.

## Phase 2 — Accounting Core (110 oras)

- Chart of Accounts CRUD na may parent-child hierarchy at limang account types.
- Manual journal entries na hindi maipapasa kung hindi balanse ang debit at credit.
- General Ledger at Trial Balance; patunayan ang totals sa sample data.
- Statement of Financial Position at Statement of Comprehensive Income.

## Phase 3 — Loan Management (130 oras)

- Borrower CRUD at basic KYC fields: pangalan, address, contact, at optional TIN.
- Configurable loan products, rates, interest methods, terms, fees, at penalty rates.
- Application, approval/rejection, disbursement, amortization schedule, payment collection, at allocation rules.
- Ihambing ang computed schedule sa sample amortization na nasa requirements.

## Phase 4 — Integration Layer (70 oras)

- UI para sa mapping ng LMS events sa Chart of Accounts.
- Journal generation para sa disbursement, payment, interest accrual, at penalty.
- Patunayan ang LMS-only mode at pag-queue ng accounting entries kapag naka-off ang Accounting.

## Phase 5 — Reports, BIR Support & Polish (90 oras)

- Loan aging, portfolio, collections, at accounting reports na hinihingi ng requirements.
- BIR-supporting books/summaries; walang full BIR registration o tax-filing forms.
- Security/regression checks, sample data, README/install guide, at demo ng LMS-only, Accounting-only, at integrated modes.

## Sample amortization acceptance case

₱100,000 principal · 12% kada taon · 12 buwan · declining balance/equal principal: unang buwan ay ₱8,333.33 principal, ₱1,000 interest, at ₱9,333.33 total; ikalawang buwan ay humigit-kumulang ₱916.67 interest at ₱9,250 total.
