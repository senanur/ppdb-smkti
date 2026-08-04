# PPDB SMK TI Airlangga

A student-admission (PPDB — *Penerimaan Peserta Didik Baru*) web application for **SMK TI Airlangga**, built on Laravel. It handles the school's new-student registration flow, from the public application form through admin review and re-registration, including Excel import/export of registrant data.

## What it does

- **Public registration form** (`/`) — prospective students submit their name, previous school, contact numbers, address, and choice of *jurusan* (major/department): DKV, Broadcasting (BDP), TJKT, PPLG, MPLB, or Digital Marketing (DM).
- **Admin panel** (session-based login, `/manajemen/login`) — staff review and manage submitted registrations at `/manajemen/daftar-awal`: edit, delete, generate a registration ID, change status, and flag follow-ups.
- **Re-registration (*daftar ulang*)** — a separate list (`/manajemen/daftar-ulang`) for students who have been accepted and are completing re-registration.
- **Excel import/export** — registrant data can be exported to `.xlsx` (`/export-excel`) or bulk-imported from a spreadsheet (`/import-excel`), via `maatwebsite/excel`.
- **Prospective-student login** — a separate login form (`/siswa-login`) for students to check their own registration status.

## Tech stack

- Laravel 8 (this branch is mid-upgrade from Laravel 7; see `UPGRADE_PLAN.md` for the staged path toward Laravel 12)
- MySQL
- Server-rendered Blade views styled with AdminLTE / Bootstrap, jQuery, and Laravel Mix for asset building
- `laravel/ui` for the built-in auth scaffolding (login/register/password-reset)
- `maatwebsite/excel` (PhpSpreadsheet) for the import/export feature

## Getting started

```bash
composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
```

Set your database credentials in `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), then:

```bash
php artisan migrate
php artisan serve
```

## Project status

This repository is being incrementally upgraded from Laravel 7 toward Laravel 12 — see `UPGRADE_PLAN.md` for the phase-by-phase plan and current progress.

## License

Not specified.
