<?php

CONST APP_BASE = __DIR__;

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once 'config.php';
require_once 'functions.php';

$files = array_slice($argv,1);

$fail = [];
$dict = [];

foreach ($files as $file)
{
    $path = getAbsolutePath($file);

    // Not relevant for us
    if (!fileExists($path) || !isFileImage($path)) {
        $fail[] = [
            'path' => $path,
            'reason' => 'The file path either does not exist or is not an image'
        ];
        continue;
    }

    moveToSrcFolder($path);
    $hash = getImageHash($path);
    if (isset($dict[$hash])) {
        $dict[$hash]++;
        moveToDupFolder($path);
    } else {
        $dict[$hash] = 1;
        moveToUniqueFolder($path);
    }
}

// Success
$uniqueImageCount = count($dict);
$totalImages = array_sum($dict);
echo "$uniqueImageCount unique images of $totalImages total.", PHP_EOL;

// Errors
$totalErrors = count($fail);
echo "$totalErrors total fails", PHP_EOL;
foreach ($fail as $f) {
    echo "{$f['path']}: {$f['reason']}", PHP_EOL;
}