<?php


use PetitCitron\BrutalTestRunner\BrutalTestRunner;
use PetitCitron\LightLogger\Logger;
use PetitCitron\LightLogger\NoLogger;

require dirname(__DIR__) . '/vendor/autoload.php';
define('ROOT2', dirname(__FILE__, 2));

// import test tool
$btr = new BrutalTestRunner(true);
$btr->header(__FILE__);


function clearLogFile() {
    // clearing old tests session
    if(file_exists(ROOT2 . '/tests/logs/test.log')) {
        unlink(ROOT2 . '/tests/logs/test.log');
    }
    if(file_exists(ROOT2 . '/tests/logs')) {
        rmdir(ROOT2 . '/tests/logs');
    }
}

clearLogFile();
// if want silent Log
$log = new NoLogger();
$log->info('an Info'); // null
$log->error('an Err'); // null
$log->beer('an Beer'); // null
$btr->assertEqual(false, file_exists(ROOT2 . '/tests/logs/test.log'), 'Checking NO write logs');