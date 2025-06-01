<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '../src/Response.php';

use UxmanSarwar\Response as res;


// ------------------------------------------------------v4.0.0


res::init();

res::index('i-1')->result('res 1');
res::index('i-2')->result('res 2');

res::index('i-1')->error('res 1');
res::index('i-2')->error('res 2');

res::ttl(4343);
res::query(['rec' => 'a', 'ip' => '82.53.64.4']);

echo res::json() . PHP_EOL;




// --------------------------------------

// res::init();

// res::result('res 1');
// res::result('res 2');

// res::key('testing');

// res::result('res 1');
// res::result('res 2');

// res::index('index-1')->result('res 1');
// res::index('index-2')->result('res 2');

// res::key();


// res::index('index-1')->result('res 1');
// res::index('index-2')->result('res 2');

// echo res::json() . PHP_EOL;



exit;
// ------------------------------------------------------v4.0.0


// ------------------------------------------------------v3.0.0







// ------------------------------------------------------v3.0.0


echo res::init();


// ------------------------------------------------------
// res::init()->input(true);
// res::key('mysql')->result(['sql' => 'this is value related to upcoming sorting thing']);
// res::result('this is value 2');

// res::key('mysql-2')->result(['sql' => 'this is value related to upcoming sorting thing']);
// res::result('this is value 2');
// res::result('this is value 2');
// res::result('this is value 2');

// res::key();

// res::error('MySql got error');

// echo res::json();



// ------------------------------------------------------
// res::init()->input(true);
// res::result(['sql' => 'this is value related to upcoming sorting thing']);
// res::result('this is value 2');
// res::error('MySql got error');

// echo res::json();