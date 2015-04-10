<?php
namespace SvenJuergens\Searchbar\Utility;
/**
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

class AdditionalFunctionsField {

    public function main(&$params, &$pObj) {
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions'])) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['searchbar']['additionalFunctions'] as $class => $registrationInformation) {
                $title = isset($registrationInformation['title']) ? htmlspecialchars($registrationInformation['title']) : $class;
                $params['items'][] = array($title, $class, '');
            }
        }
    }
}