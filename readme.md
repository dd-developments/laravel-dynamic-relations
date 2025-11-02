<p align="center">
  <a href="https://dd-developments.com" target="_blank" rel="noopener">
    <img src=".github/assets/logo.png" width="180" alt="dd-developments Hawk Logo">
  </a>
</p>

<h1 align="center">🧩 Laravel Dynamic Relations</h1>

<p align="center">
  <strong>Dynamic, declarative & trait-driven Eloquent relations.</strong><br>
  Developed by <a href="https://dd-developments.com">dd-developments</a> — Hosted in Belgium 🇧🇪
</p>

<p align="center">
  <a href="https://packagist.org/packages/dd-developments/laravel-dynamic-relations">
    <img src="https://img.shields.io/packagist/v/dd-developments/laravel-dynamic-relations.svg?style=flat-square" alt="Version">
  </a>
  <a href="https://github.com/dd-developments/laravel-dynamic-relations/actions/workflows/tests.yml">
    <img src="https://img.shields.io/github/actions/workflow/status/dd-developments/laravel-dynamic-relations/tests.yml?branch=main&label=tests&style=flat-square" alt="Tests">
  </a>
  <img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square" alt="License">
  <img src="https://img.shields.io/badge/Laravel-12.x-ff2d20?style=flat-square&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-777bb4?style=flat-square&logo=php" alt="PHP">
</p>

---

## Overview

**Laravel Dynamic Relations** provides a clean way to define and register **Eloquent relationships dynamically** —  
no need to hardcode `hasMany()`, `belongsTo()`, or `morph*()` inside your models.

Perfect for modular or package-based Laravel ecosystems where traits and relationships should remain fully reusable.

---

## Features

- Declarative config via `config/dynamic-relations.php`
- Trait-based registration (`HasManyImages`, `IsFromAuthor`, …)
- Supports `hasOne`, `hasMany`, `belongsTo`, `belongsToMany`, and all morph types
- Auto-registered through the Service Provider
- Compatible with **Laravel 12** and **PHP 8.3 +**

---

## Installation

```bash
composer require dd-developments/laravel-dynamic-relations
php artisan vendor:publish --tag=dynamic-relations-config

Quick Example

use DdDevelopments\DynamicRelations\Facades\DynamicRelations;

trait HasManyImages
{
    protected static function bootHasManyImages(): void
    {
        DynamicRelations::for(static::class, 'images', fn ($model) =>
            $model->morphMany(Image::class, 'imageable'));
    }
}

Why this package?
Feature	This Package	Alternatives
Trait-first design	✅	❌
Config-driven	✅	⚠️ Partial
Runtime registration (DynamicRelations::for)	✅	❌
Full morph support	✅	⚠️
Laravel 12 + Pest v4 ready	✅	⚠️
Hot-swappable architecture	✅	❌
License

MIT © 2025 dd-developments.com
Author

Developed with 💡 by Daniel Demesmaecker
for dd-developments.com

— Hosted in Belgium 🇧🇪

    Everything is hot-swappable.
    Built for modular CMS architectures where every relation is replaceable, extendable & reusable.
