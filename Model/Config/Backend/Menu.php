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

namespace Imagineering\Core\Model\Config\Backend;

use Magento\Config\Model\ResourceModel\Config\Data;
use Magento\Framework\App\Cache\Type\Block;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Framework\App\Config\Value;

class Menu extends Value
{
    protected $_resourceName = Data::class;

    /**
     * {@inheritdoc}
     */
    public function afterSave()
    {
        if ($this->isValueChanged()) {
            $this->cacheTypeList->cleanType(Block::TYPE_IDENTIFIER);
            $this->cacheTypeList->cleanType(Config::TYPE_IDENTIFIER);
        }

        return parent::afterSave();
    }
}
