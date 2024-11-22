<?php

defined('TYPO3') or die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$smartConsultSignature = ExtensionUtility::registerPlugin('SmartConsult', 'ConsultTool', 'Consult Tool');


$smartConsultFlexForm = 'FILE:EXT:smart_consult/Configuration/Flexforms/ConsultTool.xml';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($smartConsultSignature, $smartConsultFlexForm);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$smartConsultSignature] = 'pi_flexform';
