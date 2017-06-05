<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */
namespace Dcs\Faq\Block\Adminhtml\Items\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('dcs_faq_items_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('FAQ'));
    }
}
