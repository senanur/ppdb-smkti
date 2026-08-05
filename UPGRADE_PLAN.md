# Laravel 7 → 12 Upgrade Plan

## Current state

- Laravel Framework `^7.29`, PHP requirement `^7.2.5|^8.0` (PHP 8.3 is already installed locally — good, no interpreter upgrade needed at any step)
- `laravel/ui: 2.x` — Bootstrap-based auth scaffolding (`resources/views/auth/*`), `Auth::routes()` in `routes/web.php`
- `fideloper/proxy` + `fruitcake/laravel-cors` — both later folded into Laravel core
- `doctrine/dbal: ^3.2` — no `renameColumn`/`->change()` calls found in migrations, so likely droppable later, but confirm before removing
- `maatwebsite/excel: ^3.1` (`app/Exports/RegistrantExport.php`, `app/Imports/RegistrantImport.php`)
- Old-style global model factory (`database/factories/UserFactory.php` using `$factory->define(...)`)
- `database/seeds/DatabaseSeeder.php` (pre-L8 folder name/namespace)
- `routes/web.php` uses **string controller actions** (`'EarlyRegisterController@index'`) resolved via `RouteServiceProvider::$namespace = 'App\Http\Controllers'` — this pattern is removed from the default skeleton in L8/L9 and has no equivalent in the L11+ skeleton, so it needs converting to array callable syntax (`[Controller::class, 'method']`) at some point before L11
- Frontend build: Laravel Mix 5 + Bootstrap 4/jQuery (no SPA framework) — can stay on Mix through L10 if desired, but Mix is unmaintained and dropped from the default skeleton starting L9.19/L10
- `App\User` model still at `app/User.php` (pre-L8 location) — fine to leave as-is, `app/Models/` is only a convention, not required

## Strategy

Upgrade **one major version at a time** (7→8→9→10→11→12), not directly to 12. Each hop:

1. Create a branch (e.g. `upgrade/laravel-8`)
2. Bump `laravel/framework` and related packages in `composer.json` to that version's constraint
3. Work through that version's breaking changes below
4. `composer update`, fix fatal errors, run through `php artisan` commands (`route:list`, `migrate:status`, `config:cache`) and manually smoke-test the app in a browser (login, registration flow, Excel import/export — the two most fragile third-party integrations)
5. Commit, merge to main, tag (e.g. `v-laravel-8`) before moving to the next hop
6. Only after all 5 hops land, do the final cleanup pass (Phase 6)

Rollback is just `git checkout` the previous tag — this is why each hop must be a clean, working commit before starting the next.

---

## Phase 1 — Laravel 7 → 8

**Requires PHP ^7.3 (have 8.3, fine).**

- `composer.json`: `"laravel/framework": "^8.0"`, `"laravel/tinker": "^2.5"` (unchanged), `"laravel/ui": "^3.0"` (2.x is incompatible)
- **Model factories**: rewrite `database/factories/UserFactory.php` from `$factory->define()` closure style to a class-based factory extending `Illuminate\Database\Eloquent\Factories\Factory`. Add `use HasFactory;` to `App\User`.
- **Seeders**: move `database/seeds/DatabaseSeeder.php` → `database/seeders/DatabaseSeeder.php`, change namespace to `Database\Seeders`, update `composer.json` classmap (`database/seeds` → `database/seeders`), re-run `composer dump-autoload`.
- **Queued jobs**: `philo`/serialization changes — not used here (no `app/Jobs`), skip.
- Confirm `fideloper/proxy` still resolves (it does through L8) — no change needed yet.
- `maatwebsite/excel` 3.1 supports L8, no bump needed.
- Run `composer require laravel/ui:^3.0` and re-check the auth views still compile (L8's `ui` package regenerates scaffolding via `artisan ui bootstrap --auth`, but since you have custom auth views/controllers already, do **not** re-run the generator — just confirm the package version bump alone doesn't break anything).

## Phase 2 — Laravel 8 → 9

**Requires PHP ^8.0 (have 8.3, fine).**

- `composer.json`: `"laravel/framework": "^9.0"`, `"laravel/ui": "^4.0"`, drop `"fruitcake/laravel-cors"` and `"fideloper/proxy"` — both are merged into the framework itself in L9:
  - CORS: `Illuminate\Http\Middleware\HandleCors` replaces `Fruitcake\Cors\HandleCors` in `app/Http/Kernel.php`'s `$middleware` array. `config/cors.php` format is compatible, just update the FQCN.
  - Trust proxies: `App\Http\Middleware\TrustProxies` now extends `Illuminate\Http\Middleware\TrustProxies` (framework-provided) instead of the `fideloper/proxy` package — update the `use` statement.
- **PHPUnit**: bump to `^9.5.10` (dev only).
- Symfony components bump to 6.x under the hood — no direct code changes expected given this app's simplicity, but re-check `maatwebsite/excel` version constraints (3.1.x supports L9; if `composer update` complains, bump to the latest 3.1 tag).
- Flysystem v3 change (S3/local disk driver signature changes) — check `config/filesystems.php` if any custom disks were added; default `local`/`public` disks are unaffected.
- Confirm `str_replace()` calls in `EarlyRegisterController.php` and Blade files are untouched — these are native PHP functions, not Laravel helpers, so no risk here despite the `Str`/`Arr` global-helper deprecation talk elsewhere in the ecosystem.

## Phase 3 — Laravel 9 → 10

**Requires PHP ^8.1 (have 8.3, fine).**

- `composer.json`: `"laravel/framework": "^10.0"`, `"laravel/ui": "^4.2"` (still compatible), PHPUnit `^10.0`.
- Native return types were added throughout the framework's own classes — only matters if any app class extends a framework class and overrides a method without matching the new signature. Worth a quick check of `app/Http/Middleware/*` (mostly default skeleton files here, should be fine).
- `doctrine/dbal` becomes fully optional (Laravel's own schema builder covers renames/changes without it in most cases) — since no migration in this repo uses `renameColumn`/`->change()`, this is a candidate for removal now or in the final cleanup phase. Leave it in for now to avoid an unrelated fix mid-hop; revisit in Phase 6.
- Laravel Mix is no longer the default frontend tool as of ~9.19/10, but existing Mix configs keep working — no forced change. Optional: migrate to Vite later (not required for functionality).

## Phase 4 — Laravel 10 → 11

**Requires PHP ^8.2 (have 8.3, fine). This is the biggest structural jump.**

- `composer.json`: `"laravel/framework": "^11.0"`. Laravel 11 introduced a slimmed-down app skeleton (single `bootstrap/app.php` replacing `app/Http/Kernel.php`, `app/Console/Kernel.php`, several provider registrations, and `config/cors.php`/`config/logging.php` defaults are inlined). **Important: this restructuring is optional for upgrading apps** — the Laravel 11 upgrade guide explicitly supports keeping `app/Http/Kernel.php`, `app/Exceptions/Handler.php`, and the existing `app/Providers/*` files as-is. Do **not** attempt the full skeleton migration in the same hop as the version bump; keep the old structure working first, then decide separately whether to adopt the new style.
- **Route action syntax**: this is the one change that *does* force a fix in this repo. If you haven't already converted the string-based controller actions in `routes/web.php` (e.g. `'EarlyRegisterController@index'`) to array callables (`[EarlyRegisterController::class, 'index']`), do it now — add `use App\Http\Controllers\EarlyRegisterController;` (and the other controllers used) at the top of `routes/web.php`, and remove reliance on `RouteServiceProvider::$namespace` for route resolution.
- `laravel/ui` — confirm a version compatible with L11 (`^4.3`+); if the custom auth controllers/views were built off `laravel/ui`'s scaffolding, spot-check password reset/verification flows since the underlying notification classes changed slightly.
- Sanctum/Passport: not used here, skip.
- PHPUnit 10/11 — confirm `tests/` (if any exist) still run; add `tests/TestCase.php` compatibility checks.
- `maatwebsite/excel` — verify current tag supports L11 (check the package's compatibility table); if not, bump to the latest 3.1.x release.

## Phase 5 — Laravel 11 → 12

**Requires PHP ^8.2 (have 8.3, fine).**

- `composer.json`: `"laravel/framework": "^12.0"`. L12 is a comparatively light release — mostly dependency bumps (Carbon 3 default, updated `nunomaduro/collision`) and default-skeleton polish (starter kits, Pennant, no forced structural change beyond L11's).
- Confirm Carbon 3 is in use if any code does date math that depends on Carbon 2-specific method behavior (diffInX rounding changed in Carbon 3) — worth grepping `app/` for `diffIn`, `->add(`, `->sub(` calls and spot-checking date logic in `EarlyRegisterController.php` (registration date filtering, `searchDate`).
- Final `composer update`, `composer.json` `"require": {"php": "^8.2"}`.

---

## Phase 6 — Post-upgrade cleanup (after reaching 12)

- Remove `doctrine/dbal` if nothing in the app actually needs it (confirmed no `renameColumn`/`->change()` in migrations)
- Decide whether to adopt the Laravel 11+ streamlined skeleton (`bootstrap/app.php`) — optional, not required for the app to function
- Consider moving `App\User` → `App\Models\User` and other future models into `app/Models/` for convention alignment (not required)
- Consider migrating Laravel Mix → Vite (optional, only matters if frontend build tooling becomes a maintenance pain)
- Re-run full manual smoke test: login (`Auth::routes()` flows), student registration form, registrant list/edit/delete, Excel import/export, `searchDate`/`changeStatus`/`followUp` endpoints
- Update `README`/deployment docs for the new PHP/Laravel version baseline

## Testing checklist per hop

- [ ] `composer update` completes without conflicts
- [ ] `php artisan route:list` succeeds (catches route-registration breakage early)
- [ ] `php artisan migrate:status` succeeds
- [ ] App boots locally, `/` (public form) and `/manajemen/login` render
- [ ] Login as admin, hit `/manajemen/daftar-awal`
- [ ] Excel export/import round-trip
- [ ] No new deprecation warnings in `storage/logs/laravel.log` under `APP_DEBUG=true`
