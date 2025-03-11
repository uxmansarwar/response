# Response - PHP API Response Handler

[![Packagist](https://img.shields.io/packagist/v/uxmansarwar/response)](https://packagist.org/packages/uxmansarwar/response)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.2-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

## Overview

`Response` is a **lightweight PHP library** designed to streamline **API response handling**. It follows a **singleton-based pattern** to store and retrieve results, errors, and user input efficiently. The package is **PSR-4 compliant** and fully compatible with **PHP 7.2+ and PHP 8.2**.

### **Key Features**
- ✅ **Singleton pattern** to prevent redundant object creation.
- ✅ **Structured response handling** for JSON and array outputs.
- ✅ **Collect API results & errors dynamically**.
- ✅ **Retrieve user input** from `$_GET`, `$_POST`, and JSON payloads.
- ✅ **Flexible data retrieval** (JSON, array, collection format).
- ✅ **Works with Laravel, Symfony, CodeIgniter, WordPress, and Core PHP**.

---

## Installation

### **Install via Composer**
You can install this package using Composer:
```sh
composer require uxmansarwar/response
```

### **Manual Installation**
Alternatively, clone this repository and include it in your project:
```sh
git clone https://github.com/uxmansarwar/Response.git
```
Then, include the autoloader:
```php
require 'vendor/autoload.php';
```

---

## **Usage Examples**

### **1. Initializing the Response Handler**
```php
use UxmanSarwar\Response;

Response::init();
```

### **2. Storing Results**
```php
Response::result("User created successfully");
Response::result(["id" => 1, "name" => "John Doe"]);
```

### **3. Handling Errors**
```php
Response::error("Invalid API request");
Response::error("Failed to connect to the database");
```

### **4. Retrieving Response Data**
#### JSON Output:
```php
echo Response::json();
```
**Example Output:**
```json
{
    "result": [
        "User created successfully",
        { "id": 1, "name": "John Doe" }
    ],
    "error": [
        "Invalid API request",
        "Failed to connect to the database"
    ]
}
```

#### Array Output:
```php
$response_array = Response::collection();
print_r($response_array);
```

---

## **Advanced Features**

### **5. Grouping Responses with a Key**
```php
Response::key("user")->result(["id" => 2, "name" => "Jane Doe"]);
echo Response::json();
```

### **6. Include User Input in Response**
```php
Response::input(true);
echo Response::json();
```
If a request is made with:
```sh
GET /api.php?id=10&name=Alice
```
The output will include:
```json
"input": {
    "id": "10",
    "name": "Alice"
}
```

### **7. Custom Error & Result Keys**
You can define custom keys for results and errors:
```php
Response::key("dns");
```

---

## **Use Case Example: API Response Handling**
```php
Response::init();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error("Only POST requests are allowed");
} else {
    $data = Response::$_INPUT;
    if (!isset($data['username']) || empty($data['username'])) {
        Response::error("Username is required");
    } else {
        Response::result("User registered successfully");
    }
}

echo Response::json();
```

---

## **Why Use This Package?**
### ✅ **For Laravel & Symfony Developers**: Use it as a service-based response handler.
### ✅ **For WordPress Developers**: Improve structured AJAX responses.
### ✅ **For REST API Development**: Optimize API response handling with minimal effort.
### ✅ **For Microservices**: Centralize error handling and response formatting.

---

## **Testing the Package**
To install and run tests:
```sh
composer install
vendor/bin/phpstan analyse src --level=max
vendor/bin/pest
```


