<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '../src/Response.php';

use UxmanSarwar\Response as res;

res::init()->input(true);
res::key('mysql')->result(['sql' => 'this is value related to upcoming sorting thing']);
res::result('this is value 2');

res::key('mysql-2')->result(['sql' => 'this is value related to upcoming sorting thing']);
res::result('this is value 2');
res::result('this is value 2');
res::result('this is value 2');

res::key();

res::error('MySql got error');

echo res::json();



// ------------------------------------------------------
// res::init()->input(true);
// res::result(['sql' => 'this is value related to upcoming sorting thing']);
// res::result('this is value 2');
// res::error('MySql got error');

// echo res::json();