<?php
declare(strict_types = 1);
namespace TRITUM\StaticInfoTablesFormelements\ViewHelpers\FormEditor;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\ViewHelpers\Form\SelectViewHelper;

/*
 * @author Ralf Zimmermann TRITUM GmbH <ralf.zimmermann@tritum.de>
 */
class StaticInfoTablesCountriesViewHelper extends SelectViewHelper
{

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        $options = parent::getOptions();

        $countries = $this->getObjectManager()->get(CountryRepository::class)->findAll();
        foreach ($countries as $country) {
            $options[$country->getUid()] = $country->getOfficialNameLocal();
        }
        sort($options);

        return $options;
    }

    /**
     * @return ObjectManager
     */
    protected function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }
}
