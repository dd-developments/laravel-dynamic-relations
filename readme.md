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
  <a href="https://github.com/dd-developments/laravel-dynamic-relations/actions/workflows/tests.yml?branch=main">
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

## 🌍 Languages  
[🇬🇧 English](#english) • [🇳🇱 Nederlands](#nederlands) • [🇫🇷 Français](#français) • [🇩🇪 Deutsch](#deutsch)  
[🧩 Why this package?](#why-this-package) • [📜 License](#license) • [🧠 Author](#author)

---

## English

### 💡 What is this?
**Laravel Dynamic Relations** lets you define **Eloquent relationships dynamically** —  
no hardcoded `hasMany()` or `belongsTo()` methods.  
This makes traits modular and reusable across projects.

### ✨ Features
- Declarative config (`config/dynamic-relations.php`)
- Reusable trait-based API (`HasManyImages`, `IsFromAuthor`, …)
- Supports all relation types (`hasOne`, `hasMany`, `belongsTo`, `morph*`)
- Auto-registered via Service Provider
- Laravel 12 + PHP 8.3 compatible

### ⚙️ Installation
```bash
composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Example

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($m)
            => $m->morphMany(Image::class, 'imageable'));
    }
}

Nederlands
💡 Wat is dit?

Laravel Dynamic Relations maakt het mogelijk om Eloquent-relaties dynamisch te definiëren
zonder vaste hasMany() of belongsTo()-methodes.
Traits worden daardoor echt herbruikbaar in elk project.
✨ Functies

    Declaratieve configuratie (config/dynamic-relations.php)

    Trait-gebaseerde API (HasManyImages, IsFromAuthor, …)

    Ondersteunt alle Eloquent-relaties, inclusief polymorfische

    Automatisch geladen via ServiceProvider

    Compatibel met Laravel 12 + PHP 8.3

⚙️ Installatie

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Voorbeeld

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', fn ($m)
            => $m->belongsTo(User::class, 'user_id'));
    }
}

Français
💡 Qu'est-ce que c'est ?

Laravel Dynamic Relations permet de définir vos relations Eloquent de façon dynamique et déclarative,
sans les coder directement dans vos modèles.
✨ Fonctionnalités

    Configuration déclarative (config/dynamic-relations.php)

    API basée sur des traits réutilisables

    Support complet de toutes les relations Eloquent (polymorphes inclus)

    Fournisseur de service automatique

    Compatible Laravel 12 / PHP 8.3 +

⚙️ Installation

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Exemple

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($m)
            => $m->morphMany(Image::class, 'imageable'));
    }
}

Deutsch
💡 Was ist das?

Laravel Dynamic Relations ermöglicht es, Eloquent-Beziehungen dynamisch und deklarativ zu definieren,
ohne sie fest in deinen Models zu codieren.
✨ Funktionen

    Deklarative Konfiguration (config/dynamic-relations.php)

    Wiederverwendbare Trait-API (HasManyImages, IsFromAuthor, …)

    Unterstützung aller Eloquent-Relationen (auch polymorph)

    Automatische Registrierung via Service Provider

    Kompatibel mit Laravel 12 & PHP 8.3 +

⚙️ Installation

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Beispiel

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', fn ($m)
            => $m->belongsTo(User::class, 'user_id'));
    }
}

Why this package?
Feature	This package	Typical alternatives
Trait-first design	✅	❌
Config-driven maps	✅	⚠️
Runtime registration (DynamicRelations::for)	✅	❌
Full morph coverage	✅	⚠️
Laravel 12 + Pest v4 support	✅	⚠️
Hot-swappable relations	✅	❌
License

MIT © 2025 dd-developments.com
Author

Developed with 💡 by Daniel Demesmaecker
for dd-developments.com

— Hosted in Belgium 🇧🇪

    Everything is hot-swappable.
    Built for a modular CMS architecture where every relation is replaceable, extendable & reusable.
