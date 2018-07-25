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

        $countries = $this->getObjectManager()->get(CountryRepository::class)->findAll();

        $options = [];
        foreach ($countries as $country) {
            $options[$country->getShortNameEn()] = $country->getShortNameEn();
        }
        sort($options);
        $renderable->setProperty('options', $options);
    }

    /**
     * @return ObjectManager
     */
    protected function getObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }
}
