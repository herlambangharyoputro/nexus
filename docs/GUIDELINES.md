# Nexus Admin → Composer Package — GUIDELINES

Keputusan terkunci (locked decisions) + kontrak boundary package ↔ consumer.
Dokumen ini = single source of truth keputusan. Kode = single source of truth di repo package.

Status tiap keputusan: `LOCKED` (sudah final) · `PENDING` (perlu diputuskan di Phase 0).
Jangan eksekusi fase yang bergantung pada item `PENDING` sebelum item itu jadi `LOCKED`.

---

## 1. View Namespace
Status: LOCKED

- Final: `nexus` → dipakai sebagai `nexus::layouts.app`, `nexus::partials.sidebar`,
  `nexus::icons.home`, dst.
- Consumer akses layout via `@extends('nexus::layouts.app')`.
- Konsekuensi kalau berubah setelah rilis = breaking change (MAJOR).

---

## 2. Asset Path Convention
Status: LOCKED (mengikuti template saat ini)

- Source di package: `resources/assets/css/`, `resources/assets/js/`
- Target publish di consumer: `public/nexus/assets/...`
- Layout me-refer asset via `asset('nexus/assets/css/app.css')` (dipertahankan,
  supaya layout tidak perlu diubah saat masuk package).
- CSS master `app.css` import order (TIDAK boleh diubah urutannya):
  `tokens → base → utilities → layout → components`
- JS: `app.js` + `vendor/jquery-3.7.1.min.js`

---

## 3. Publish Tags
Status: LOCKED

- `nexus-assets` → publish CSS/JS ke `public/nexus/assets`
- `nexus-views`  → publish views ke `resources/views/vendor/nexus` (untuk override)
- `nexus-config` → DIBATALKAN untuk v0.1. Sidebar pakai override-via-view (lihat #6),
  jadi tidak ada config file yang di-publish. Tag ini tidak dikunci sekarang;
  ditambahkan nanti (MINOR, additive) kalau config-driven jadi dibuat.
- Nama tag = bagian boundary. Ganti nama setelah rilis = breaking change (MAJOR).

---

## 4. ServiceProvider Public API
Status: LOCKED (class + namespace) · detail implementasi di Phase 4

- Class name: `NexusServiceProvider`
- PSR-4 namespace: `Nexus\Admin\`
- Tugas resmi:
  - `loadViewsFrom(resources/views, 'nexus')` → otomatis mengaktifkan view namespace
    `nexus::` DAN anonymous component `<x-nexus::...>` (lihat #5). Tidak ada
    registrasi component per-item.
  - `publishes(asset → public/nexus/assets, tag 'nexus-assets')`
  - `publishes(views → resources/views/vendor/nexus, tag 'nexus-views')`
  - TIDAK ada `mergeConfigFrom` di v0.1 (tidak ada config; lihat #3 & #6).

---

## 5. Component API (kontrak props/slots)
Status: LOCKED

Penamaan component (boundary): LOCKED
- Bentuk final: `<x-nexus::card>` (titik dua) — anonymous component via view namespace.
  Prefix `nexus::` mencegah bentrok dengan component milik consumer (mis. `x-card`
  consumer sendiri). Didapat otomatis dari `loadViewsFrom(..., 'nexus')`, tanpa
  registrasi per-component, tanpa rename file.
- BUKAN `<x-nexus-card>` (tanda hubung) — itu butuh registrasi eksplisit / class-based,
  fungsi sama, kerja lebih banyak. Ditolak.
- Catatan Phase 2: contoh usage di docblock tiap file component saat ini masih nulis
  `<x-card>`, `<x-button>`, dst (non-prefixed) + `@include('icons.*')` non-namespaced.
  WAJIB diubah ke `<x-nexus::...>` dan `nexus::icons.*` saat Views Migration.

Kontrak per component (rename/remove props atau slot = breaking change MAJOR):

### x-nexus::card — LOCKED
- props: `title` (string|null, default null), `noBody` (bool, default false)
- slots: default (`$slot`), `header` (full custom header), `headerAction`
- presedensi header: slot `header` menang atas `title`+`headerAction`
- attributes: di-merge ke `.card`

### x-nexus::stat-card — LOCKED
- props: `label` (string), `value` (string), `iconColor` (primary|amber|green|red|purple,
  default primary), `change` (string|null), `changeDirection` (up|down|null)
- slots: `icon`
- attributes: di-merge ke `.stat-card`

### x-nexus::button — LOCKED
- props: `variant` (primary|outline|ghost|danger|success|warning, default primary),
  `size` (md|sm|lg, default md), `icon` (bool, default false),
  `fullWidth` (bool, default false), `type` (button|submit|reset, default button),
  `href` (string|null → kalau diisi render `<a>`, kalau null render `<button>`)
- slots: default (`$slot`)
- attributes: di-merge ke `<button>` atau `<a>`

### x-nexus::avatar — LOCKED
- props: `size` (md|sm|lg, default md), `initials` (string|null),
  `name` (string|null → auto-generate initials kalau `initials` kosong),
  `src` (string|null → kalau diisi render `<img>`)
- slots: tidak ada (konten dari props)
- attributes: di-merge ke `.avatar`

### x-nexus::modal — LOCKED
- props: `id` (string, REQUIRED → target `data-modal-open` / JS `Modal.open(id)`),
  `title` (string|null), `noClose` (bool, default false → sembunyikan tombol X)
- slots: default (`$slot`), `footer` (dirender di dalam `.modal-body`, bukan
  `.modal-footer` terpisah — tidak ada `.modal-footer` di CSS, by design)
- attributes: di-merge ke inner `.modal` (raw `$attributes`, untuk override width via style)

### x-nexus::alert — LOCKED
- props: `type` (info|success|warning|error, default info),
  `dismissible` (bool, default false → tampilkan tombol close)
- slots: default (`$slot`)
- attributes: di-merge ke `.alert`

### x-nexus::badge — LOCKED
- props: `color` (blue|green|amber|red|purple, default blue)
- slots: default (`$slot`)
- attributes: di-merge ke `.badge`

---

## 6. Sidebar Navigation (`url()` hardcoded)
Status: LOCKED

Final: opsi 2 — dibiarkan hardcoded, consumer override lewat published view
(`vendor:publish --tag=nexus-views` → edit `resources/views/vendor/nexus/partials/sidebar`).

Kondisi saat ini (dipertahankan apa adanya di package):
- nav pakai `url('/dashboard')`, `url('/pengguna')`, `url('/pesanan')`, `url('/produk')`,
  `url('/pengaturan')` hardcoded; active state via `request()->is('path*')`.
- `nav-badge` angka (`3`) hardcoded → bagian dari view, consumer ubah via override.

Alasan:
- Sidebar nav = kustomisasi utama tiap consumer; override view memberi kontrol penuh
  (struktur, submenu, ikon di luar set package).
- Hindari beban config + `mergeConfigFrom` + render ikon dinamis di v0.1.
- Config-driven bisa ditambahkan nanti tanpa memecah override (MINOR, additive).

Trade-off diterima: untuk ubah 1 item menu, consumer publish seluruh partial sidebar
lalu edit; setelah publish, partial itu terputus dari update versi package.

---

## 7. Topbar User Data
Status: LOCKED (mengikuti template saat ini)

- Default dummy via `@php`: `$userName`, `$userRole`, `$userInitials` (auto dari nama).
- Consumer override dengan passing variable dari controller atau `auth()->user()`.
- Dropdown link (`/profile`, `/pengaturan`, `/logout`) hardcoded `url()` → consumer
  override via published view (sama mekanisme dgn sidebar #6).
- Tidak ada dependency auth di package (package presentation-only).

---

## 8. Override Mechanism (aturan resmi)
Status: LOCKED

- Consumer customize view HANYA via `vendor:publish --tag=nexus-views` lalu edit
  hasil publish di `resources/views/vendor/nexus`.
- Hasil publish = customization lokal consumer, BUKAN update template.
- Update template selalu di repo package → naik versi → consumer `composer update`.
- `composer update` TIDAK menimpa view yang sudah di-publish (publish = sekali salin).
- Jangan duplikasi view antara package & consumer secara manual.

---

## 9. Scope Package (pagar tegas)
Status: LOCKED

- Package = presentation layer only: views (layout, partials, components, icons) +
  assets pre-compiled + ServiceProvider + composer.json.
- TIDAK ADA: controller, model, routes, migration, business logic.
- `pages/demo.blade.php` = milik source app (preview), TIDAK ikut ke package.

---

## 10. Versioning (ringkas — detail di SYSTEM_PROMPT)
Status: LOCKED

- MAJOR: breaking di view namespace / publish tag / ServiceProvider API / component API.
- MINOR: component/partial baru, fitur backward-compatible.
- PATCH: CSS fix, bug fix, dokumentasi, refactor internal non-breaking.

---

## Catatan
- Semua item boundary sudah `LOCKED`. Phase 0 (penetapan boundary) selesai.
- Phase 2 (Views Migration) WAJIB: ubah semua `@include('partials.*')`,
  `@include('icons.*')` jadi `nexus::...`; ubah contoh docblock component ke
  `<x-nexus::...>`; verifikasi anonymous component terakses sebagai `<x-nexus::name>`.
- Selain 7 component ber-API di atas, package juga membawa CSS classes (data-table,
  pagination, form-*, toggle, dll) yang dipakai consumer langsung via markup —
  ini BUKAN component API, tidak terikat kontrak props/slots.