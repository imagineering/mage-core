<?php

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

namespace Imagineering\Core\Block\Adminhtml\Config\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Information extends Field
{
    /**
     * Information constructor.
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate('information.phtml');
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();

        return parent::render($element);
    }

    /**
     * {@inheritdoc}
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }
}
