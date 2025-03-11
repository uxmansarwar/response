<?php
/**
 * ----------------------------------------------------------------------
 * ----------------------------------------------------------------------
 *
 * @author   UxmanSarwar
 * @github   https://github.com/uxmansarwar
 * @linkedin https://www.linkedin.com/in/uxmansarwar
 * @email    uxmansrwr@gmail.com
 * @since    Uxman is full-stack(PHP, Laravel, Tailwind, JavaScript, VueJs, More...) developer since 2013
 * @version  3.0.0
 *
 * ----------------------------------------------------------------------
 * 
 * ----------------------------------------------------------------------
 */
namespace UxmanSarwar;
/**
 * Final class Response
 * 
 * A singleton class for handling API responses, including results, errors, and user inputs.
 * It provides structured response formats in JSON and array formats.
 */
final class Response
{
    /** @var string Key name for results in response */
    private static string $result_key_text = 'result';

    
    /** @var string Key name for errors in response */
    private static string $error_key_text = 'error';

    
    /** @var string Key name for user input in response */
    private static string $input_key_text = 'input';


    /** @var self|null Singleton instance of the Response class */
    private static ?self $instance = null;

    
    /** @var bool|null Flag to determine if user input should be returned in the response */
    private static ?bool $returnUserInputInResponse = null;

    
    /** @var string|null Key for grouping results and errors */
    private static ?string $key = null;

    
    /** @var array<string, mixed> Array to store result data */
    private static array $results = [];

    
    /** @var array<string, string> Array to store error messages */
    private static array $errors = [];

    
    /** @var array<string, mixed> Stores user input (GET, POST, JSON) */
    public static array $_INPUT = [];

    /**
     * Private constructor to enforce singleton pattern
     * Initializes user input data from GET, POST, and JSON request body
     */
    private function __construct()
    {
        self::$instance = null;
        self::$returnUserInputInResponse = null;
        self::$key = null;
        self::$results = [];
        self::$errors = [];
        self::$_INPUT = array_merge($_GET, $_POST);

        // Decode JSON input
        $jsonInput = json_decode(trim((string) file_get_contents('php://input')), true);
        if (!empty($jsonInput) && json_last_error() === JSON_ERROR_NONE) {
            self::$_INPUT = array_merge(self::$_INPUT, $jsonInput);
        }
    }

    /**
     * Returns the singleton instance of the Response class
     * 
     * @return self
     */
    public static function singleton(): self
    {
        return isset(self::$instance) ? self::$instance : self::init();
    }

    /**
     * Initializes and returns a new instance of the Response class
     * 
     * @return self
     */
    public static function init(): self
    {
        self::$instance = new self();
        return self::$instance;
    }

    /**
     * Enables or disables returning user input in the response
     * 
     * @param bool $input Whether to return user input
     * @return self
     */
    public static function input(bool $input = false): self
    {
        self::$returnUserInputInResponse = $input;
        return self::singleton();
    }

    /**
     * Sets a key to group results and errors
     * 
     * @param string $key Key name for grouping
     * @return self
     */
    public static function key(string $key = ''): self
    {
        self::$key = empty($key) ? null : $key;
        return self::singleton();
    }

    /**
     * Adds a result value to the response
     * 
     * @param mixed $value Result data
     * @return self
     */
    public static function result(mixed $value = ''): self
    {
        if (self::$key) {
            self::$results[self::$key][] = $value;
        } else {
            self::$results[] = $value;
        }
        return self::singleton();
    }

    /**
     * Adds an error message to the response
     * 
     * @param string $message Error message
     * @return self
     */
    public static function error(string $message): self
    {
        if (self::$key) {
            self::$errors[self::$key][] = $message;
        } else {
            self::$errors[] = $message;
        }
        return self::singleton();
    }

    /**
     * Retrieves the response data as an associative array
     * 
     * @return array<string, mixed> Response array containing results, errors, and optionally user input
     */
    public static function collection(): array
    {
        $response = [
            self::$result_key_text => self::$results,
            self::$error_key_text => self::$errors
        ];
        if (self::$returnUserInputInResponse) {
            $response[self::$input_key_text] = self::$_INPUT;
        }
        return $response;
    }

    /**
     * Retrieves the response data as a JSON string
     * 
     * @return string JSON encoded response data
     */
    public static function json(): string
    {
        return json_encode(self::collection(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * Retrieves the response data as an associative array
     * 
     * @return array<string, mixed> Response array
     */
    public static function array(): array
    {
        return self::collection();
    }

    
    public function __toString() {
        return json_encode(self::collection(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
