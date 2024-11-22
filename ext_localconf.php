<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::configurePlugin(
    'SmartConsult',
    'ConsultTool',
    [\Tyrone\SmartConsult\Controller\ConsultToolController::class => 'show'],
);
