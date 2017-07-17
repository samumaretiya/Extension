<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Model\Resource;

class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dcs_faq_category', 'id');
    }
}
