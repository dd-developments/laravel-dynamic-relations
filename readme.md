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
[🇬🇧 English](#english) • [🇳🇱 Nederlands](#nederlands) • [🇫🇷 Français](#francais) • [🇩🇪 Deutsch](#deutsch)  
[🧩 Why this package?](#why-this-package) • [📜 License](#license) • [🧠 Author](#author)

---

<!-- ANCHORS -->
<a id="english"></a>

## English

### What is this?
**Laravel Dynamic Relations** lets you define **Eloquent relationships dynamically** — no hardcoded `hasMany()` or `belongsTo()` methods. Traits become fully reusable across projects.

### Features
- Declarative config (`config/dynamic-relations.php`)
- Reusable trait-based API (`HasManyImages`, `IsFromAuthor`, …)
- Supports `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`, and all `morph*`
- Auto-registered via Service Provider
- Laravel 12 & PHP 8.3+

### Installation
```bash
composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

Example

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($m)
            => $m->morphMany(Image::class, 'imageable'));
    }
}

<a id="nederlands"></a>
Nederlands
Wat is dit?

Laravel Dynamic Relations laat je Eloquent-relaties dynamisch en modulair definiëren — zonder vaste hasMany() of belongsTo() in je models. Traits zijn zo écht herbruikbaar.
Functies

    Declaratieve configuratie (config/dynamic-relations.php)

    Herbruikbare trait-gebaseerde API (HasManyImages, IsFromAuthor, …)

    Ondersteunt alle Eloquent-relaties (ook polymorfische)

    Automatisch geladen via ServiceProvider

    Compatibel met Laravel 12 & PHP 8.3+

Installatie

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

Voorbeeld

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', fn ($m)
            => $m->belongsTo(User::class, 'user_id'));
    }
}

<a id="francais"></a>
Francais
Qu'est-ce que c'est ?

Laravel Dynamic Relations permet de définir des relations Eloquent de manière dynamique et déclarative, sans les coder dans vos modèles. Les traits deviennent vraiment réutilisables.
Fonctionnalites

    Configuration déclarative (config/dynamic-relations.php)

    API réutilisable basée sur des traits (HasManyImages, IsFromAuthor, …)

    Support complet de toutes les relations Eloquent, y compris polymorphes

    Service Provider automatique

    Compatible Laravel 12 & PHP 8.3+

Installation

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

Exemple

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($m)
            => $m->morphMany(Image::class, 'imageable'));
    }
}

<a id="deutsch"></a>
Deutsch
Was ist das?

Laravel Dynamic Relations ermöglicht es, Eloquent-Beziehungen dynamisch und deklarativ zu definieren, ohne sie fest in Models zu codieren. Traits werden wirklich wiederverwendbar.
Funktionen

    Deklarative Konfiguration (config/dynamic-relations.php)

    Wiederverwendbare Trait-API (HasManyImages, IsFromAuthor, …)

    Unterstützung aller Eloquent-Relationen (auch polymorph)

    Automatische Registrierung via Service Provider

    Kompatibel mit Laravel 12 & PHP 8.3+

Installation

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

Beispiel

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', fn ($m)
            => $m->belongsTo(User::class, 'user_id'));
    }
}

Why this package?

There are similar tools, but none combine config + traits + runtime registration in one clean package.
Feature	This package	Alternatives
Trait-first design	✅	❌
Config-driven maps	✅	⚠️
Runtime registration (DynamicRelations::for)	✅	❌
Full morph coverage	✅	⚠️
Laravel 12 + Pest v4 support	✅	⚠️
Hot-swappable relations	✅	❌

<a id="license"></a>
License

MIT © 2025 dd-developments.com

<a id="author"></a>
Author

Developed with 💡 by Daniel Demesmaecker for dd-developments.com

— Hosted in Belgium 🇧🇪

    Everything is hot-swappable — built for a modular CMS where every relation is replaceable, extendable & reusable.
