# Enhanced Laravel Installer
Enhanced Laravel Installer is based off of [Laravel Installer by rashidlaasri](https://github.com/rashidlaasri/LaravelInstaller).

## Enhancements

 * Customizable environment options

## Requirements

 * Laravel v5.7+

## Installation

1. In the root folder of your Laravel installation, open a terminal and run:

```bash
composer require little-apps/enhanced-laravel-installer
```

2. Publish the files provided with Laravel Installer  

```bash
php artisan vendor:publish --tag=laravelinstaller
```

3. Publish the files provided with this package and overwrite existing files from Laravel Installer

```bash
php artisan vendor:publish --tag=enhanced-laravel-installer --force
```
