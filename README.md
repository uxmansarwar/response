# 📦 Response – Elegant PHP API Response Handler

[![Packagist](https://img.shields.io/packagist/v/uxmansarwar/response)](https://packagist.org/packages/uxmansarwar/response)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.0-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![GitHub Stars](https://img.shields.io/github/stars/uxmansarwar/response?style=social)](https://github.com/uxmansarwar/response)

## 🔍 Overview

**`uxmansarwar/response`** is a powerful yet lightweight PHP package that makes it easy to manage structured API responses. Built with modern PHP practices, it follows a clean singleton pattern and supports result grouping, TTL, debug queries, and more. Ideal for Laravel, Symfony, WordPress, CodeIgniter, or raw PHP projects.

Developed and maintained by [Uxman Sarwar](https://github.com/uxmansarwar), a senior PHP developer since 2013.

## ✅ Features

- Singleton-based fluent API
- Add results, errors, queries, TTL, and input metadata
- Auto-collects `$_GET`, `$_POST`, and raw JSON input
- Customizable result/error key groups with `key()` and `index()`
- Get structured responses as JSON or array
- Great for APIs, microservices, and AJAX handlers

---

## ⚙️ Installation

### Via Composer

```bash
composer require uxmansarwar/response
```

---

## 🚀 Quick Start

### Initialize

```php
use UxmanSarwar\Response;

Response::init();
```

### Add Result

```php
Response::result(['id' => 1, 'name' => 'Alice']);
```

### Add Error

```php
Response::error('Invalid request type');
```

### Grouped Result with Key/Index

```php
Response::key('user')->index('info')->result(['email' => 'user@example.com']);
```

### Set Time-To-Live (TTL)

```php
Response::ttl(60);
```

### Attach Debug Query

```php
Response::query('SELECT * FROM users WHERE id = 1');
```

### Include Input Data

```php
Response::input(true);
```

### Output as JSON

```php
echo Response::json();
```

### Output as Array

```php
print_r(Response::array());
```

---

## 💡 Example Use Case: API Endpoint

```php
Response::init();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error("Only POST requests are allowed");
} else {
    $data = Response::$_INPUT;
    if (empty($data['username'])) {
        Response::error("Username is required");
    } else {
        Response::result("User registered successfully");
    }
}

echo Response::json();
```

---

## 🧪 Testing

```bash
composer install
vendor/bin/phpstan analyse src --level=max
vendor/bin/pest
```

---

## 🌐 Use Cases

- Laravel: Replace default `response()->json()` with a fluent helper
- WordPress: Handle AJAX with structured output
- Symfony: Wrap controller responses with grouped structure
- REST APIs: Make consistent error/result formatting
- Microservices: Inject debug info and TTL for downstream caching

---

## 👨‍💻 About the Author

This package is created by [Uxman Sarwar](https://github.com/uxmansarwar), a full-stack PHP Laravel developer.

- GitHub: [@uxmansarwar](https://github.com/uxmansarwar)
- LinkedIn: [Uxman Sarwar](https://linkedin.com/in/uxmansarwar)
- Email: [uxmansrwr@gmail.com](mailto:uxmansrwr@gmail.com)

If you found this package useful, consider ⭐ starring the repo and sharing it with other developers.

---

## 🔗 SEO & GitHub Keywords

PHP API response library, structured API output PHP, response formatter, Laravel response helper, singleton response PHP, uxmansarwar response composer, REST API output PHP, error handler class PHP, api response json PHP, PHP response class Laravel

---

## 📥 Composer Install Reminder

```
composer require uxmansarwar/response
```

Happy coding! 🚀