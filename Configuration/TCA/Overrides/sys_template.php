<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'static_info_tables_formelements',
        'Configuration/TypoScript',
        'EXT:form configuration'
    );
});
