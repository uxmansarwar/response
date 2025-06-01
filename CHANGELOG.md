# 📦 CHANGELOG for uxmansarwar/response

This is the official changelog for the `uxmansarwar/response` Composer package.  
This PHP package helps developers return structured API responses in a simple, clean, and fluent way.  
Maintained by [Uxman Sarwar](https://github.com/uxmansarwar) — a professional full-stack PHP developer since 2013.

> Install via Composer:  
> `composer require uxmansarwar/response`

---

## 📌 Version 4.0.0 – Major Rewrite & Powerful Improvements (May 2025)

This version is a **major upgrade** from `v3.x` to `v4.0.0`.  
It is a complete rewrite with **new features**, **cleaner code**, and **more flexibility** for real-world APIs and production apps.

### ✅ What's New

- 🔁 **Total Refactor to Singleton-based Fluent Class**
  - Keeps only one instance in memory. Cleaner, faster, and easier to use.

- 🗂️ **New `index()` Method**
  - Add secondary keys under each primary `key()`. Useful for nesting grouped data.

- 🧠 **New `ttl()` Support**
  - You can now attach a **TTL (time to live)** value in the response. Useful for cache-aware APIs or auto-expiring resources.

- 🔍 **New `query()` Method**
  - Attach queries(Like what this response about), filter info, or any debug context directly to the response.

- 🧩 **Clearer Constants**
  - All internal keys are now constants like `RESULT_KEY_TXT`, `ERROR_KEY_TXT`, `INPUT_KEY_TXT`, etc.
  - Easier to maintain and debug in large apps.

- 🔒 **Private Constructor with Auto Reset**
  - Every call to `init()` fully resets internal states (`results`, `errors`, `keys`, `ttl`, etc.).

- 🌐 **Smarter Input Collection**
  - Automatically merges `$_GET`, `$_POST`, and raw JSON from `php://input`.
  - No need to manually parse input again.

- 🧪 **Fluent Interface**
  - You can now write responses like:
    ```php
    Response::key('user')->index('profile')->result(['name' => 'John']);
    ```

- 🧼 **Improved Readability and Simplicity**
  - All methods return `$this` or `self::singleton()` for smooth chaining.
  - Code is clean, short, and easy for junior and senior developers to follow.

---

## 🧯 Version 3.0.0 – Stable & Basic (Early 2024)

This was the original **stable release** of the Response class.  
It provided basic JSON response handling in a singleton-style package.

### Features Included:
- ✅ Add results via `result($value)`
- ❌ Add errors via `error($message)`
- 🔁 Group responses using `key($name)`
- 📥 Optionally include user input with `input(true)`
- 🧾 Response as `array()` or `json()`
- 🔄 Automatic input parsing from `$_GET`, `$_POST`, and `php://input`
- 🧼 Singleton structure with private constructor and `init()` method

---

## 💡 Why Use This PHP Package?

- Built by a real-world **senior PHP developer** with over **12 years of experience**
- Ideal for **Laravel**, **RESTful APIs**, **microservices**, **modular monoliths**, and more
- Easy to use, even for beginners
- Clean output format for **mobile apps**, **front-end frameworks**, and **automated testing**

---

## 🔍 SEO & GitHub Keywords

> _To help other developers find this package, the following terms are relevant:_

- PHP JSON Response Composer Package
- Laravel API Response Helper
- PHP Singleton Response Class
- Return structured JSON response in PHP
- Fluent PHP API response builder
- Composer PHP package by [Uxman Sarwar](https://github.com/uxmansarwar)
- PHP developer tools 2025
- PHP API response formatter
- Best Composer packages for Laravel APIs

---

## 🧑‍💻 About the Author

This package is built and maintained by [Uxman Sarwar](https://github.com/uxmansarwar),  
a **senior PHP developer since 2013**, with deep experience in:

- Laravel | PHP 8+ | Tailwind CSS  
- JavaScript | Vue.js | REST APIs  
- SaaS Architecture | DevOps | Clean Code  

📧 Reach me: [uxmansrwr@gmail.com](mailto:uxmansrwr@gmail.com)  
🔗 Connect on [LinkedIn](https://www.linkedin.com/in/uxmansarwar)  
🐙 Star & follow my work on [GitHub](https://github.com/uxmansarwar)

---

## ⬇️ Install This Package

composer require uxmansarwar/response

Then use it like this:

```php
use UxmanSarwar\Response;

echo Response::key('user')->result(['name' => 'John'])->json();
```
