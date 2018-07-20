<?php
defined('TYPO3_MODE') or die();

/*
 * @author Ralf Zimmermann TRITUM GmbH <ralf.zimmermann@tritum.de>
 */
call_user_func(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('
        module.tx_form {
            settings {
                yamlConfigurations {
                    1532099326 = EXT:static_info_tables_formelements/Configuration/Yaml/FormSetup.yaml
                    1532099327 = EXT:static_info_tables_formelements/Configuration/Yaml/FormSetupBackend.yaml
                }
            }
        }
    ');

    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        't3-form-icon-staticinfotablesformelements-country',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:static_info_tables_formelements/Resources/Public/Icons/t3-form-icon-staticinfotablesformelements-country.svg']
    );

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/form']['afterBuildingFinished'][1532099326]
        = \TRITUM\StaticInfoTablesFormelements\Hooks\FormHooks::class;
});
