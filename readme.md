<p align="center">
  <a href="https://dd-developments.com" target="_blank">
  <img src=".github/assets/logo.png" width="180" alt="dd-developments Hawk Logo"> </a>
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
  <a href="https://github.com/dd-developments/laravel-dynamic-relations/actions">
    <img src="https://img.shields.io/github/actions/workflow/status/dd-developments/laravel-dynamic-relations/tests.yml?branch=main&label=tests&style=flat-square" alt="GitHub Tests">
  </a>
  <a href="https://packagist.org/packages/dd-developments/laravel-dynamic-relations">
    <img src="https://img.shields.io/packagist/dt/dd-developments/laravel-dynamic-relations.svg?style=flat-square" alt="Downloads">
  </a>
  <img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square" alt="License">
</p>

---

## 📚 Contents

| Section | Description |
|:--|:--|
| [🇬🇧 English](#-english) | Main documentation |
| [🇳🇱 Nederlands](#-nederlands) | Nederlandstalige uitleg |
| [🇫🇷 Français](#-français) | Documentation en français |
| [🇩🇪 Deutsch](#-deutsch) | Deutsche Dokumentation |
| [📜 License](#-license) | License information |
| [🧠 Author](#-author) | About dd-developments |

---

## 🇬🇧 English

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

⚙️ Installation

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Exemple (Trait)

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($m)
            => $m->morphMany(Image::class, 'imageable'));
    }
}

🇩🇪 Deutsch

Laravel Dynamic Relations ermöglicht es, Eloquent-Beziehungen dynamisch und modular zu definieren –
ohne dass du sie fest in deinen Models hinterlegen musst.
✨ Funktionen

    Deklarative Konfiguration (config/dynamic-relations.php)

    Wiederverwendbare Trait-basierte API

    Unterstützt alle Eloquent-Relationen (auch polymorph)

    Automatische Registrierung über Service Provider

    Kompatibel mit Laravel 12 & PHP 8.3+

⚙️ Installation

composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

🧬 Beispiel (Trait)

trait IsFromAuthor
{
    protected static function bootIsFromAuthor(): void
    {
        DynamicRelations::for(static::class, 'author', fn ($m)
            => $m->belongsTo(User::class, 'user_id'));
    }
}

📜 License

Licensed under MIT © 2025 dd-developments.com
🧠 Author

Developed with 💡 by Daniel Demesmaecker
for dd-developments.com

— Hosted in Belgium 🇧🇪

    Everything is hot-swappable.
    Built for the modular CMS architecture where every relation is replaceable, extendable, and reusable.


---

### 🔧 Tips


