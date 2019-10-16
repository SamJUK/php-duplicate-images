<?php

function getImageHash($imagePath)
{
    return md5_file($imagePath);
}

function fileExists($filePath)
{
    return file_exists($filePath);
}

function isFileImage($path)
{
    return getimagesize($path) ? true : false;
}

/** @TODO: Hook up to work with relative paths */
function getAbsolutePath($path)
{
    return $path;
}

function moveToSrcFolder($path)
{
    $src = $path;
    $dst = getFileNameInFolder(IMAGE_SRC_FOLDER, $src);
    copy($src, $dst);
}

function moveToDupFolder($path)
{
    $src = $path;
    $dst = getFileNameInFolder(IMAGE_DUPS_FOLDER, $src);
    copy($src, $dst);
}

function moveToUniqueFolder($path)
{
    $src = $path;
    $dst = getFileNameInFolder(IMAGE_UNIQUE_FOLDER, $src);
    copy($src, $dst);
}

function getFileNameInFolder($folder, $path)
{
    $fileName = basename($path);
    $folderPath = rtrim($folder, '/');
    return "$folderPath/$fileName";
}