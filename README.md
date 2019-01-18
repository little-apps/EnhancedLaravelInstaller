# Enhanced Laravel Installer
Enhanced Laravel Installer is based off of [Laravel Installer by rashidlaasri](https://github.com/rashidlaasri/LaravelInstaller).

## Enhancements

 * Customizable environment options

## Requirements

 * Laravel v5.7+

## License

Enhanced Laravel Installer is licensed under the MIT License.

    Copyright (c) 2019 Little Apps

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.

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
