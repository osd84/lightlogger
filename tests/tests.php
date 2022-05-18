<?php

use petitcitron\lightLogger\Logger;
use petitcitron\lightLogger\NoLogger;


define('ROOT', dirname(__FILE__, 2));

// import test tool
require_once(ROOT .  '/tests/brutaltestrunner/BrutalTestRunner.php');
$GLOBALS['debug'] = true; // default
btrHeader(__FILE__);

// oldschool bootstrap
require_once(ROOT . '/src/bootstrap.php');



function clearLogFile() {
    // clearing old tests session
    if(file_exists(ROOT . '/tests/logs/test.log')) {
        unlink(ROOT . '/tests/logs/test.log');
    }
    if(file_exists(ROOT . '/tests/logs')) {
        rmdir(ROOT . '/tests/logs');
    }
}

clearLogFile();
// if want log
$log = new Logger(ROOT . '/tests/logs', 'test.log');
$log->info('an Info'); // May-13-2022 10:34:57 | Info: an Info
$log->error('an Err'); // May-13-2022 10:34:57 | Error: an Err
$log->beer('an Beer'); // May-13-2022 10:34:57 | Beer: an Beer
unset($log);
$content = file_get_contents(ROOT . '/tests/logs/test.log');
$content = explode("\n", $content);
btrAssertEq(4, count($content), 'Checking write log');

// if want silent Log
clearLogFile();
$log = new NoLogger();
$log->info('an Info'); // null
$log->error('an Err'); // null
$log->beer('an Beer'); // null
btrAssertEq(false, file_exists(ROOT . '/tests/logs/test.log'), 'Checking NO write logs');