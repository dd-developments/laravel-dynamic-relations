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

# Table of Contents

## 🇬🇧 English
- 💡 What is this?
- ✨ Features
- ⚙️ Installation
- 🧬 Example
- 🧩 Why this package?
- 🧠 Author
- 📜 License

## 🇳🇱 Nederlands
- 💡 Wat is dit?
- ✨ Functies
- ⚙️ Installatie
- 🧬 Voorbeeld
- 🧩 Waarom dit package?
- 🧠 Auteur
- 📜 Licentie

## 🇫🇷 Français
- 💡 Qu'est-ce que c'est ?
- ✨ Fonctionnalités
- ⚙️ Installation
- 🧬 Exemple
- 🧩 Pourquoi ce package ?
- 🧠 Auteur
- 📜 Licence

## 🇩🇪 Deutsch
- 💡 Was ist das?
- ✨ Funktionen
- ⚙️ Installation
- 🧬 Beispiel
- 🧩 Warum dieses Paket?
- 🧠 Autor
- 📜 Lizenz

---

## 🇬🇧 English

### 💡 What is this?

**Laravel Dynamic Relations** lets you define **Eloquent relationships dynamically** —  
no hardcoded `hasMany()` or `belongsTo()` methods needed.  
This makes traits modular and reusable across projects and entities.

### ✨ Features
- Declarative config (`config/dynamic-relations.php`)
- Reusable trait-based API (`HasManyImages`, `IsFromAuthor`, …)
- Supports `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`, and all `morph*`
- Auto-registered via Service Provider
- Laravel 12 & PHP 8.3+ compatible

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

🧩 Why this package?

There are other relation-mapping tools,
but none combine config + traits + runtime registration in one unified system.
Feature	This package	Typical alternatives
Trait-first design	✅	❌
Config-driven maps	✅	⚠️ Partial
Runtime registration (DynamicRelations::for)	✅	❌
Full morph coverage	✅	⚠️
Laravel 12 + Pest v4 support	✅	⚠️
Hot-swappable (replaceable relations)	✅	❌
🧠 Author

Developed with 💡 by Daniel Demesmaecker
for dd-developments.com

— Hosted in Belgium 🇧🇪

    Everything is hot-swappable.
    Built for modular CMS architecture where every relation is replaceable, extendable, and reusable.

📜 License

MIT © 2025 dd-developments.com
🇳🇱 Nederlands
💡 Wat is dit?

Laravel Dynamic Relations laat je Eloquent-relaties dynamisch definiëren,
zonder vaste hasMany() of belongsTo()-methodes in je models.
Hiermee worden traits echt herbruikbaar in al je projecten.
✨ Functies

    Declaratieve configuratie (config/dynamic-relations.php)

    Herbruikbare trait-gebaseerde relaties (HasManyImages, IsFromAuthor, …)

    Ondersteunt alle Eloquent-relaties (ook polymorfische)

    Automatisch geladen via ServiceProvider

    Compatibel met Laravel 12 & PHP 8.3+

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

🧩 Waarom dit package?

Geen enkel alternatief combineert config + traits + runtime-registratie in één oplossing.
Kenmerk	Dit package	Alternatieven
Trait-first ontwerp	✅	❌
Config-gedreven maps	✅	⚠️
Runtime registratie (DynamicRelations::for)	✅	❌
Volledige morph-ondersteuning	✅	⚠️
Laravel 12 + Pest v4 support	✅	⚠️
Hot-swappable architectuur	✅	❌
🧠 Auteur

Ontwikkeld met 💡 door Daniel Demesmaecker
voor dd-developments.com

— Gehost in België 🇧🇪

    Everything is hot-swappable.
    Gebouwd voor een modulaire CMS-architectuur waar elke relatie vervangbaar, uitbreidbaar en herbruikbaar is.

📜 Licentie

MIT © 2025 dd-developments.com
🇫🇷 Français
💡 Qu'est-ce que c'est ?

Laravel Dynamic Relations permet de définir vos relations Eloquent de manière dynamique et déclarative,
sans les coder directement dans vos modèles.
Les traits deviennent ainsi réutilisables et modulaires.
✨ Fonctionnalités

    Configuration déclarative (config/dynamic-relations.php)

    API basée sur des traits réutilisables (HasManyImages, IsFromAuthor, …)

    Support complet de toutes les relations Eloquent, y compris polymorphes

    Fournisseur de service automatique

    Compatible avec Laravel 12 et PHP 8.3+

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

🧩 Pourquoi ce package ?

Aucun autre package ne combine configuration + traits + enregistrement dynamique dans un seul système.
Fonction	Ce package	Alternatives
Conception basée sur les traits	✅	❌
Configuration déclarative	✅	⚠️
Enregistrement dynamique (DynamicRelations::for)	✅	❌
Support complet des relations morphiques	✅	⚠️
Support Laravel 12 + Pest v4	✅	⚠️
Architecture modulaire et échangeable	✅	❌
🧠 Auteur

Développé avec 💡 par Daniel Demesmaecker
pour dd-developments.com

— Hébergé en Belgique 🇧🇪

    Everything is hot-swappable.
    Construit pour une architecture CMS modulaire où chaque relation est remplaçable et extensible.

📜 Licence

MIT © 2025 dd-developments.com
🇩🇪 Deutsch
💡 Was ist das?

Laravel Dynamic Relations ermöglicht es, Eloquent-Beziehungen dynamisch und deklarativ zu definieren –
ohne sie fest in deinen Models zu codieren.
So werden Traits wirklich wiederverwendbar und modular.
✨ Funktionen

    Deklarative Konfiguration (config/dynamic-relations.php)

    Wiederverwendbare Trait-basierte API (HasManyImages, IsFromAuthor, …)

    Unterstützung aller Eloquent-Relationen (auch polymorph)

    Automatische Registrierung über Service Provider

    Kompatibel mit Laravel 12 und PHP 8.3+

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

🧩 Warum dieses Paket?

Kein anderes Paket kombiniert Konfiguration + Traits + Laufzeit-Registrierung in einem System.
Merkmal	Dieses Paket	Alternativen
Trait-first Design	✅	❌
Konfigurationsgetriebene Zuordnung	✅	⚠️
Laufzeitregistrierung (DynamicRelations::for)	✅	❌
Volle Morph-Unterstützung	✅	⚠️
Laravel 12 + Pest v4 Support	✅	⚠️
Hot-swappable Architektur	✅	❌
🧠 Autor

Entwickelt mit 💡 von Daniel Demesmaecker
für dd-developments.com

— Gehostet in Belgien 🇧🇪

    Everything is hot-swappable.
    Entwickelt für eine modulare CMS-Architektur, in der jede Beziehung austauschbar und erweiterbar ist.

📜 Lizenz

MIT © 2025 dd-developments.com
