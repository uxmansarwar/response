<?php

namespace UxmanSarwar;

final class Response
{

    private static ?self $instance = null;
    private static ?bool $returnUserInputInResponse = null;
    private static array $results = [];
    private static array $errors = [];
    private static array $_INPUT = [];

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
        self::$_INPUT = array_merge($_GET, $_POST);
        $jsonInput = json_decode(trim((string)file_get_contents('php://input')), true);
        if (!empty($jsonInput) && json_last_error() === JSON_ERROR_NONE) {
            self::$_INPUT = array_merge(self::$_INPUT, $jsonInput);
        }
    }

    /**
     * Enables or disables including user input in the response.
     * 
     * @param bool $input If true, user input will be included in the response.
     */
    public static function input(bool $input = false): void
    {
        self::$returnUserInputInResponse = $input;
    }

    /**
     * Singleton pattern: Initializes or returns the existing instance.
     * 
     * @return self
     */
    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Stores a result.
     * 
     * @param mixed $value The result to store.
     */
    public static function result(mixed $value): void
    {
        self::$results[] = $value;
    }

    /**
     * Stores an error message.
     * 
     * @param string $message The error message to store.
     */
    public static function error(string $message): void
    {
        self::$errors[] = $message;
    }

    /**
     * Returns stored results and errors as a JSON-encoded string.
     * 
     * @return string JSON representation of stored data.
     */
    public static function json(): string
    {
        $response = [
            'result' => self::$results,
            'error'  => self::$errors
        ];
        if (self::$returnUserInputInResponse) {
            $response['input'] = self::$_INPUT;
        }
        return json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * Returns stored results and errors as an associative array.
     * 
     * @return array The stored data as an array.
     */
    public static function array(): array
    {
        $response = [
            'result' => self::$results,
            'error'  => self::$errors
        ];
        if (self::$returnUserInputInResponse) {
            $response['input'] = self::$_INPUT;
        }
        return $response;
    }
}
