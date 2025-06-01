<?php

declare(strict_types=1);

namespace UxmanSarwar;
/**
 * ==========================================================================
 *  UxmanSarwar - PHP Response Package
 * ==========================================================================
 *
 * @package     uxmansarwar/response
 * @author      Uxman Sarwar <uxmansrwr@gmail.com>
 * @license     MIT License
 * @version     4.0.0
 * @since       1.0.0
 *
 * @github      https://github.com/uxmansarwar
 * @linkedin    https://www.linkedin.com/in/uxmansarwar
 * @email       uxmansrwr@gmail.com
 * @bio         Uxman is a professional full-stack developer since 2013,
 *              specializing in PHP, Laravel, Tailwind CSS, JavaScript,
 *              Vue.js, REST APIs, and scalable SaaS architectures.
 *
 * @see         https://github.com/uxmansarwar/response
 *
 * 
 * ==========================================================================
 *  Class: Response
 * ==========================================================================
 * A centralized response handler for API output formatting in PHP-based web
 * applications. Designed to be used within a Composer package, it manages
 * structured JSON or array-based responses while encapsulating results,
 * errors, ttl, query, and optional input reflection.
 * 
 * 
 * ==========================================================================
 *  Purpose:
 * ==========================================================================
 * Enhances API response consistency, debugging, and testing by offering a
 * fluent and clean interface to populate, shape, and return structured data.
 * 
 * 
 * ==========================================================================
 *  Responsibilities:
 * ==========================================================================
 * • Singleton instantiation and lifecycle control  
 * • Standardized result, ttl, query and error message handling/encapsulating  
 * • Input retrieval (GET, POST, JSON) and parsing  
 * • Response serialization to JSON and array formats  
 */
final class Response
{
    /**
     * Result key name in the final response array.
     * Used to separate successful data entries from other response components.
     *
     * @var string
     */
    private const RESULT_KEY_TXT = 'result';

    /**
     * Error key name in the final response array.
     * Holds all error messages reported by the application.
     *
     * @var string
     */
    private const ERROR_KEY_TXT = 'error';

    /**
     * Input key name used when returning user input data with the response.
     * Holds all input like ($_GET, $_POST or php://input) application.
     *
     * @var string
     */
    private const INPUT_KEY_TXT = 'input'; // Suggestion: Update this to 'input' for clarity.

    private const TTL_KEY_TXT = 'ttl';
    private const QUERY_KEY_TXT = 'query';

    /**
     * Singleton instance of the class.
     * Ensures consistent and memory-safe usage across multiple invocations.
     *
     * @var self|null
     */
    private static ?self $instance = NULL;

    /**
     * Toggle to include request input in the response.
     *
     * @var bool|null
     */
    private static ?bool $returnUserInputInResponse = NULL;

    /**
     * Optional grouping key used to index results or errors.
     *
     * @var string|null
     */
    private static ?string $key = NULL;

    /**
     * Optional nested index used under the current `$key` for sub-grouping.
     *
     * @var string|null
     */
    private static ?string $index = NULL;

    /**
     * Holds all result data pushed through the `result()` method.
     *
     * @var array
     */
    private static array $results = [];

    /**
     * Stores all error messages pushed through the `error()` method.
     *
     * @var array
     */
    private static array $errors = [];

    public static ?int $TTL;
    public static mixed $QUERY;

    /**
     * Holds merged input data from `$_GET`, `$_POST`, and JSON payload.
     *
     * @var array
     */
    public static array $_INPUT = [];

    /**
     * Private constructor to enforce singleton pattern.
     * Initializes state, merges traditional form data and JSON body input,
     * and clears all previous data containers.
     */
    private function __construct()
    {
        // Reset all internals on construction
        self::$instance = NULL;
        self::$returnUserInputInResponse = NULL;
        self::$key = NULL;
        self::$index = NULL;
        self::$results = [];
        self::$errors = [];
        self::$TTL = NULL;
        self::$QUERY = NULL;

        // Merge GET and POST data into the $_INPUT array
        self::$_INPUT = array_merge($_GET, $_POST);

        // Additionally capture and merge raw JSON input, if valid
        $jsonInput = json_decode(trim((string) file_get_contents('php://input')), true);
        if (!empty($jsonInput) && json_last_error() === JSON_ERROR_NONE) {
            self::$_INPUT = array_merge(self::$_INPUT, $jsonInput);
        }
    }

    /**
     * Get the singleton instance.
     * If not yet initialized, it will call `init()` to construct the class.
     *
     * @return self
     */
    public static function singleton(): self
    {
        self::$index = NULL; // Reset nested index on new chain
        return isset(self::$instance) ? self::$instance : self::init();
    }

    /**
     * Initialize and return a new instance of the class.
     * This method explicitly resets all internals and input parsing.
     *
     * @return self
     */
    public static function init(): self
    {
        self::$instance = new self();
        return self::$instance;
    }

    /**
     * Enable or disable returning request input data with the response.
     * This is especially useful for debugging, echoing back the user's request input.
     *
     * @param bool $input Whether to include user input in the response.
     * @return self
     */
    public static function input(bool $input = false): self
    {
        self::$returnUserInputInResponse = $input;
        return self::singleton();
    }

    /**
     * Define a primary key for grouping results and errors.
     * Useful when handling multiple entities or modules in a single response.
     *
     * @param string $key
     * @return self
     */
    public static function key(string $key = ''): self
    {
        self::$key = empty($key) ? NULL : $key;
        return self::singleton();
    }

    /**
     * Define a secondary index for finer grouping under the main key.
     * Allows hierarchical organization of response data.
     *
     * @param string $index
     * @return self
     */
    public static function index(string $index = ''): self
    {
        self::$index = empty($index) ? NULL : $index;
        return isset(self::$instance) ? self::$instance : self::init();
    }

    /**
     * Push a result value into the response array.
     * Supports plain, keyed, and indexed formats depending on current key/index state.
     *
     * @param mixed $value
     * @return self
     */
    public static function result(mixed $value = ''): self
    {
        if (self::$key) {
            if (self::$index)
                self::$results[self::$key][self::$index] = $value;
            else
                self::$results[self::$key][] = $value;
        } else {
            if (self::$index)
                self::$results[self::$index] = $value;
            else
                self::$results[] = $value;
        }
        return self::singleton();
    }

    /**
     * Push an error message into the error collection.
     * Supports plain, keyed, and indexed formats just like `result()`.
     *
     * @param string $message
     * @return self
     */
    public static function error(string $message): self
    {
        if (self::$key) {
            if (self::$index)
                self::$errors[self::$key][self::$index] = $message;
            else
                self::$errors[self::$key][] = $message;
        } else {
            if (self::$index)
                self::$errors[self::$index] = $message;
            else
                self::$errors[] = $message;
        }
        return self::singleton();
    }

    public static function ttl(int $ttl = 30): self
    {
        self::$TTL = $ttl;
        return self::singleton();
    }

    public static function query(mixed $query = ''): self
    {
        self::$QUERY = $query;
        return self::singleton();
    }

    /**
     * Compile the complete response data structure as an associative array.
     * Includes results, errors, and optionally input values.
     *
     * @return array
     */
    public static function collection(): array
    {
        $response = [
            self::RESULT_KEY_TXT => self::$results,
            self::ERROR_KEY_TXT => self::$errors
        ];

        if (self::$returnUserInputInResponse) {
            $response[self::INPUT_KEY_TXT] = self::$_INPUT;
        }

        if (self::$TTL)
            $response[self::TTL_KEY_TXT] = self::$TTL;

        if (self::$QUERY)
            $response[self::QUERY_KEY_TXT] = self::$QUERY;

        return $response;
    }

    /**
     * Return the entire response as a formatted JSON string.
     *
     * @return string
     */
    public static function json(): string
    {
        return json_encode(self::collection(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * Return the entire response as a PHP array.
     *
     * @return array
     */
    public static function array(): array
    {
        return self::collection();
    }

    /**
     * Magic method that allows the object to be cast to a string (e.g., echo $response).
     * Automatically returns the JSON representation of the response.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(self::collection(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
