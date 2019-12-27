<?php
declare(strict_types = 1);
namespace TRITUM\StaticInfoTablesFormelements\Hooks;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use SJBR\StaticInfoTables\Domain\Repository\CountryRepository;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Form\Domain\Model\Renderable\RenderableInterface;

/*
 * @author Ralf Zimmermann TRITUM GmbH <ralf.zimmermann@tritum.de>
 */
class FormHooks
{

    /**
     * @param RenderableInterface $renderable
     */
    public function afterBuildingFinished(RenderableInterface $renderable)
    {
        if ($renderable->getType() !== 'StaticInfoTablesCountrySelect') {
            return;
        }

        $iso2Key = $GLOBALS['TSFE']->lang;
        
        if (isset($GLOBALS['TSFE']->config['config']['tx_staticinfotablesformelements.']['languageOverwrite'])) {
            $iso2Key = $GLOBALS['TSFE']->config['config']['tx_staticinfotablesformelements.']['languageOverwrite'];
        }

        $countries = $this->getObjectManager()->get(CountryRepository::class)->findAll();

        if ($iso2Key === 'en' || $this->isLoadedLanguageVersion($iso2Key)) {
            $getterMethodName = 'getShortName' . ucfirst($iso2Key);
        } else {
            $getterMethodName = 'getOfficialNameLocal';
        }

        $options = [];
        foreach ($countries as $country) {
            $options[$country->getIsoCodeA2()] = $country->{$getterMethodName}();
        }
        uasort($options, 'strcoll');
        $renderable->setProperty('options', $options);
    }

    /**
     * check if static_info_tables_LANGUAGE is loaded
     *
     * @param string $langKey
     *
     * @return boolean
     */
    protected function isLoadedLanguageVersion($langKey)
    {
        return ExtensionManagementUtility::isLoaded('static_info_tables_' . $langKey);
    }

    /**
     * @return ObjectManager
     */
    protected function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }
}
