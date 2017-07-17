<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */
namespace Dcs\Faq\Block\Adminhtml;

class Items extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'items';
        $this->_headerText = __('FAQs');
        $this->_addButtonLabel = __('Add New FAQ');
        parent::_construct();
    }
}
