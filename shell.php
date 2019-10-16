<?php
// Shell interface for the program
const APP_BASE = __DIR__;
require_once 'config.php';
require_once 'shell_functions.php';

// Intro text
output('Duplicate image processing fixes');

// Initial application run guard
if (closedQuestion('Do you want to run the application?') === 'n') {
    output('Application run canceled by user.');
    exit(1);
}

// What to do with old media
output('How should we handle old media?');
output('1: Leave it');
output('2: Delete it');
output('3: Archive it');
$oldMediaValidValues = ['1','2','3'];
$oldMediaQuestion = closedQuestion('What shall we do?', $oldMediaValidValues);
switch ($oldMediaQuestion) {
    case '2':
        emptyFolder(IMAGE_UNIQUE_FOLDER);
        emptyFolder(IMAGE_DUPS_FOLDER);
        emptyFolder(IMAGE_SRC_FOLDER);
        break;
    case '3':
        archiveFolder(IMAGE_BASE_FOLDER);
        break;
}

// Handle checking our images
require_once 'index.php';