<p align="center">
  <a href="https://dd-developments.com" target="_blank" rel="noopener">
<img src=".github/assets/logo.png" width="180" alt="dd-developments Hawk Logo">
</a>
</p>

<h1 align="center">🧩 Laravel Dynamic Relations</h1>
<p align="center">
  <strong>Dynamic, declarative & trait-driven Eloquent relations</strong><br>
  by <a href="https://dd-developments.com">dd-developments</a> — Hosted in Belgium 🇧🇪
</p>

<p align="center">
  <a href="https://packagist.org/packages/dd-developments/laravel-dynamic-relations">
    <img src="https://img.shields.io/packagist/v/dd-developments/laravel-dynamic-relations.svg?style=flat-square" alt="Latest Version">
  </a>
  <a href="https://github.com/dd-developments/laravel-dynamic-relations/actions/workflows/tests.yml">
    <img src="https://img.shields.io/github/actions/workflow/status/dd-developments/laravel-dynamic-relations/tests.yml?branch=main&label=tests&style=flat-square" alt="GitHub Tests">
  </a>
  <a href="https://packagist.org/packages/dd-developments/laravel-dynamic-relations">
    <img src="https://img.shields.io/packagist/dt/dd-developments/laravel-dynamic-relations.svg?style=flat-square" alt="Downloads">
  </a>
  <img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square" alt="License">
  <img src="https://img.shields.io/badge/Laravel-12.x-ff2d20?style=flat-square&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-777bb4?style=flat-square&logo=php" alt="PHP 8.3+">
</p>

---

## 📚 Contents

| Section | Description |
|:--|:--|
| [🇬🇧 English](#english) | Main documentation |
| [🇳🇱 Nederlands](#nederlands) | Nederlandstalige uitleg |
| [🇫🇷 Français](#français) | Documentation en français |
| [🇩🇪 Deutsch](#deutsch) | Deutsche Dokumentation |
| [🧩 Why this package?](#why-this-package) | What makes this unique |
| [🧬 Compatibility](#compatibility) | Laravel / PHP versions |
| [🚀 Roadmap](#roadmap) | Upcoming versions |
| [📜 License](#license) | License info |
| [🧠 Author](#author) | About dd-developments |

---

## 🇬🇧 English {#english}

**Laravel Dynamic Relations** lets you define **Eloquent relationships dynamically**, without hardcoding them in your models.

### ✨ Features
- Declarative config (`config/dynamic-relations.php`)
- Reusable trait-based API (`HasManyImages`, `IsFromAuthor`, …)
- Supports `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`, all `morph*`
- Auto-registered via Service Provider
- Laravel 12 & PHP 8.3+ compatible

### ⚙️ Installation
```bash
composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config
