<?php
$files = array_diff(scandir(__DIR__), ['.', '..', 'logs']);
$files = array_reverse($files);

foreach ($files as $f) {
    if (strpos($f, 'tests') !== false) {
        $path = __DIR__ . '/' . $f;
        system(PHP_BINARY . ' -f ' . $path) . "\n";
    }
}