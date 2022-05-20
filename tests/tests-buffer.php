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
// if want log
$log = new Logger(ROOT2 . '/tests/logs', 'test.log', true);
$log->info('an Info'); // May-13-2022 10:34:57 | Info: an Info
$log->error('an Err'); // May-13-2022 10:34:57 | Error: an Err
$log->beer('an Beer'); // May-13-2022 10:34:57 | Beer: an Beer
$btr->assertEqual(file_exists(ROOT2 . '/tests/logs/test.log'), false, 'Log file doesn\'t exit yet');
unset($log);
$content = file_get_contents(ROOT2 . '/tests/logs/test.log');
$content = explode("\n", $content);
$btr->assertEqual(4, count($content), 'Checking write log after object destruct');