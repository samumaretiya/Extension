<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */
namespace Dcs\Faq\Block\Adminhtml;

class Category extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'category';
        $this->_headerText = __('Category');
        $this->_addButtonLabel = __('Add New FAQ Category');
        parent::_construct();
    }
}
