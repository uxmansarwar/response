# Response

Response is a PHP class designed to manage API responses efficiently. It provides a singleton-based approach to storing and retrieving results, errors, and user input data in multiple formats (JSON, array). This class ensures proper handling of API responses while maintaining PHP 7+ compatibility.

## Features
- Singleton pattern ensures a single instance.
- Store results and errors dynamically.
- Capture user input from `$_GET`, `$_POST`, and JSON payloads.
- Retrieve stored data in JSON, array, format.
- Support for enabling/disabling user input inclusion in responses.
- Works on PHP 7 and above.

## Installation
Clone the repository into your project directory:

```sh
$ git clone https://github.com/yourusername/Response.git
```

Include the `Response.php` file in your project:

```php
require_once 'Response.php';
```

## Usage
### Initializing the Response
Since `Response` follows the singleton pattern, you do not instantiate it directly. Instead, use the `init()` method:

```php
Response::init();
```

### Storing Results
You can store multiple results dynamically using the `result()` method:

```php
Response::result("Operation successful");
Response::result(["id" => 1, "name" => "John Doe"]);
```

### Storing Errors
Similarly, errors can be stored using the `error()` method:

```php
Response::error("Invalid request");
Response::error("Database connection failed");
```

### Retrieving Data
You can retrieve the stored results and errors in different formats:

#### JSON Format
```php
echo Response::json();
```
**Output:**
```json
{
    "result": [
        "Operation successful",
        { "id": 1, "name": "John Doe" }
    ],
    "error": [
        "Invalid request",
        "Database connection failed"
    ]
}
```

#### Array Format
```php
$response_array = Response::array();
print_r($response_array);
```
**Output:**
```php
Array (
    [result] => Array (
        [0] => Operation successful
        [1] => Array ([id] => 1, [name] => John Doe)
    )
    [error] => Array (
        [0] => Invalid request
        [1] => Database connection failed
    )
)
```

### Handling User Input
User input (from `$_GET`, `$_POST`, or JSON requests) is captured automatically. You can include it in the response using:

```php
Response::input(true);
echo Response::json();
```
If a request is made with:
```sh
GET /api.php?id=5&name=John
```
The output will be:
```json
{
    "result": [],
    "error": [],
    "input": {
        "id": "5",
        "name": "John"
    }
}
```

### Example Use Case
#### API Response Handling
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

### Contributing
Feel free to fork this repository, make enhancements, and submit pull requests. Suggestions and issues are welcome!

### License
This project is licensed under the MIT License.

