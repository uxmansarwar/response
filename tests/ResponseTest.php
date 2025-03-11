<?php

declare(strict_types=1);
require_once __DIR__ . DIRECTORY_SEPARATOR . './../src/Response.php';

use UxmanSarwar\Response;


/**
 * Class ResponseTest
 * A basic testing script to check the correctness of the Response class using PHPStan.
 */
final class ResponseTest
{
    public static function run(): void
    {
        // Initialize response singleton
        $response = Response::init();

        // Test adding a result
        $response->result('Test Result 1');
        assert(isset($response->array()['result']), 'Result key should be set');
        assert(in_array('Test Result 1', $response->array()['result'], true), 'Result should contain "Test Result 1"');

        // Test adding an error
        $response->error('Test Error 1');
        assert(isset($response->array()['error']), 'Error key should be set');
        assert(in_array('Test Error 1', $response->array()['error'], true), 'Error should contain "Test Error 1"');

        // Test input inclusion
        $response->input(true);
        assert(isset($response->array()['input']), 'Input key should be set when enabled');

        echo "All assertions passed.\n";
    }
}

// Run the test
ResponseTest::run();
