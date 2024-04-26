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

namespace Imagineering\Core\Helper;

use Exception;
use Magento\Framework\App\Area;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\State;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Backend\App\ConfigInterface;

class Core extends AbstractHelper
{
    const CONFIG_MODULE_PATH = 'imagineering';

    /**
     * @type StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

    /**
     * @type ObjectManagerInterface
     */
    protected ObjectManagerInterface $objectManager;

    /**
     * @var ConfigInterface
     */
    protected ConfigInterface $backendConfig;

    /**
     * @var State
     */
    private State $state;

    /**
     * @var array
     */
    protected array $isArea = [];

    /**
     * @type array
     */
    protected array $_data = [];

    /**
     * AbstractData constructor.
     *
     * @param Context $context
     * @param ObjectManagerInterface $objectManager
     * @param StoreManagerInterface $storeManager
     * @param ConfigInterface $backendConfig
     * @param State $state
     */
    public function __construct(
        Context $context,
        ObjectManagerInterface $objectManager,
        StoreManagerInterface $storeManager,
        ConfigInterface $backendConfig,
        State $state
    ) {
        $this->objectManager = $objectManager;
        $this->storeManager  = $storeManager;
        parent::__construct($context);
        $this->backendConfig = $backendConfig;
        $this->state = $state;
    }

    /**
     * Get Config General
     *
     * @param string $code
     * @param null $storeId
     * @return mixed
     */
    public function getConfigGeneral(string $code = '', $storeId = null)
    {
        $code = ($code !== '') ? '/' . $code : '';

        return $this->getConfigValue(static::CONFIG_MODULE_PATH . '/general' . $code, $storeId);
    }

    /**
     * Get Config Value
     *
     * @param $field
     * @param null $scopeValue
     * @param string $scopeType
     * @return array|mixed
     */
    public function getConfigValue($field, $scopeValue = null, string $scopeType = ScopeInterface::SCOPE_STORE)
    {
        if ($scopeValue === null && !$this->isArea()) {
            return $this->backendConfig->getValue($field);
        }

        return $this->scopeConfig->getValue($field, $scopeType, $scopeValue);
    }

    /**
     * Is Area
     *
     * @param string $area
     * @return mixed
     */
    public function isArea(string $area = Area::AREA_FRONTEND)
    {
        if (!isset($this->isArea[$area])) {
            try {
                $this->isArea[$area] = ($this->state->getAreaCode() == $area);
            } catch (Exception $e) {
                $this->isArea[$area] = false;
            }
        }

        return $this->isArea[$area];
    }
}
