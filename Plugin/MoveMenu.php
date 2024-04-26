<?php
declare(strict_types=1);

/**
 * Imagineering
 *
 * This source file is subject to the Imagineering License, which is available at https://www.imagineering.rs/.
 * Do not edit or add to this file if you wish to upgrade to the newer versions in the future.
 * If you wish to customize this module for your needs,
 * Please refer to https://business.adobe.com/products/magento/magento-commerce.html for more information.
 *
 * @category    Imagineering
 * @package     Imagineering_Core
 * @copyright   Copyright (c) Imagineering (https://www.imagineering.rs/)
 * @link        https://www.imagineering.rs/
 */

namespace Imagineering\Core\Plugin;

use Magento\Backend\Model\Menu\Builder\AbstractCommand;
use Imagineering\Core\Helper\Core;

class MoveMenu
{
    const IMAGINEERIN_CORE = 'Imagineering_Core::imagineering';

    /**
     * @var Core
     */
    protected Core $coreHelper;

    /**
     * MoveMenu constructor.
     *
     * @param Core $coreHelper
     */
    public function __construct(Core $coreHelper)
    {
        $this->coreHelper = $coreHelper;
    }

    /**
     * Plugin After Execute
     *
     * @param AbstractCommand $subject
     * @param $itemParams
     * @return mixed
     */
    public function afterExecute(AbstractCommand $subject, $itemParams)
    {
        if ($this->coreHelper->getConfigGeneral('menu')) {
            if (strpos($itemParams['id'], 'Imagineering_') !== false
                && isset($itemParams['parent'])
                && strpos($itemParams['parent'], 'Imagineering_') === false) {
                $itemParams['parent'] = self::IMAGINEERIN_CORE;
            }
        } elseif ((isset($itemParams['id']) && $itemParams['id'] === self::IMAGINEERIN_CORE)
                || (isset($itemParams['parent']) && $itemParams['parent'] === self::IMAGINEERIN_CORE)) {
            $itemParams['removed'] = true;
        }

        return $itemParams;
    }
}
