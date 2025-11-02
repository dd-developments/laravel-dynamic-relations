<p align="center">
  <a href="https://dd-developments.com" target="_blank">
<img src=".github/assets/logo.png" width="180" alt="dd-developments Hawk Logo">  </a>
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
| [🇬🇧 English](#-english) | Main documentation |
| [🇳🇱 Nederlands](#-nederlands) | Nederlandstalige uitleg |
| [🇫🇷 Français](#-français) | Documentation en français |
| [🇩🇪 Deutsch](#-deutsch) | Deutsche Dokumentation |
| [🧩 Why this package?](#-why-this-package) | What makes this unique |
| [🧬 Compatibility](#-compatibility) | Laravel / PHP versions |
| [🚀 Roadmap](#-roadmap) | Upcoming versions |
| [📜 License](#-license) | License info |
| [🧠 Author](#-author) | About dd-developments |

---

## 🇬🇧 English

**Laravel Dynamic Relations** lets you define **Eloquent relationships dynamically**,  
without hardcoding them in your models.

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

🧬 Example (Trait-based)

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($m)
            => $m->morphMany(Image::class, 'imageable'));
    }
}

🇳🇱 Nederlands

Laravel Dynamic Relations maakt het mogelijk om Eloquent-relaties dynamisch en modulair te definiëren —
zonder vaste hasMany() of belongsTo() in je models.
✨ Functies

    Declaratieve configuratie (config/dynamic-relations.php)

    Herbruikbare trait-gebaseerde relaties

    Ondersteunt alle Eloquent-relaties, incl. polymorfische

    Automatisch geladen via ServiceProvider

    Compatibel met Laravel 12 & PHP 8.3+

⚙️ Installatie

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Voorbeeld (Trait)

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', fn ($m)
            => $m->belongsTo(User::class, 'user_id'));
    }
}

🇫🇷 Français

Laravel Dynamic Relations permet de définir vos relations Eloquent de manière dynamique,
sans les coder directement dans vos modèles.
✨ Points forts

    Configuration déclarative (config/dynamic-relations.php)

    API basée sur des traits réutilisables

    Compatible avec toutes les relations Eloquent, y compris polymorphes

    Service Provider prêt à l’emploi

    Compatible Laravel 12 / PHP 8.3+

🇩🇪 Deutsch

Laravel Dynamic Relations ermöglicht es, Eloquent-Beziehungen dynamisch und modular zu definieren –
ohne dass du sie fest in deinen Models hinterlegen musst.
✨ Funktionen

    Deklarative Konfiguration (config/dynamic-relations.php)

    Wiederverwendbare Trait-basierte API

    Unterstützt alle Eloquent-Relationen (auch polymorph)

    Automatische Registrierung über Service Provider

    Kompatibel mit Laravel 12 & PHP 8.3+

🧩 Why this package?

There are other relation-mapping packages, but none combine config + traits + runtime registration in one system.
Feature	This package	Typical alternatives
Trait-first design	✅	❌
Config-driven maps	✅	⚠️ Partial
Runtime registration (DynamicRelations::for)	✅	❌
Full morph coverage (morphTo)	✅	⚠️
Laravel 12 + Pest v4 support	✅	⚠️
Hot-swappable (“everything replaceable”)	✅	❌
🧬 Compatibility
Laravel	PHP	Pest	Testbench	Status
12.x	8.3–8.4	4.x	10.x	✅ Stable
🚀 Roadmap
Version	Planned features
v0.2	Attribute-based declaration (#[Relation(...)])
v0.3	Larastan / PHPStan rules + stubs
v0.4	Multi-tenant resolvers
v1.0	Stable API & documentation
📜 License

Licensed under MIT © 2025 dd-developments.com
🧠 Author

Developed with 💡 by Daniel Demesmaecker
for dd-developments.com

— Hosted in Belgium 🇧🇪

    Everything is hot-swappable.
    Built for the modular CMS architecture where every relation is replaceable, extendable, and reusable.

