<?php

const YESNO_VALID_INPUTS = ['y', 'n'];

function output($data, $eol = true)
{
    echo !$eol ? $data : $data.PHP_EOL;
}

function input($message)
{
    output($message);
    $handle = fopen ('php://stdin', 'rb');
    return trim(fgets($handle));
}

function closedQuestion($question, $validInputs = YESNO_VALID_INPUTS)
{
    $input = false;
    $validInputString = implode('/',$validInputs);
    while (!isValidInput($input, $validInputs)) {
        $input = input("$question ($validInputString)");
    }
    return $input;
}

function isValidInput($response, $validInputs, $caseSensitive = false)
{
    if (!$caseSensitive) {
        $response = strtolower($response);
    }

    return in_array($response, $validInputs, true);
}

function emptyFolder($path)
{
    $path = rtrim($path, '/');
    $files = glob("$path/*");
    foreach ($files as $file) {
        if(is_file($file)) {
            unlink($file);
        }
    }
}

/**
 * @TODO Refactor away from a shell execute function
 * @TODO: Could be cleaned up a lot
 *
 * @param $path
 */
function archiveFolder($path)
{
    $fileFriendlyPath = str_replace('/.', '_', $path);
    $archiveName = $fileFriendlyPath.'_'.time(). '.tar.gz';
    $archiveFullPath = "$archiveName";
    $archiveFullPath = str_replace(APP_BASE, '', $archiveFullPath);
    $archiveFullPath = ARCHIVE_FOLDER.$archiveFullPath;
    shell_exec("tar -zcvpf \"$archiveFullPath\" \"$path\"");
}