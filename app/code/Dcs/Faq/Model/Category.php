<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Model;

class Category extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Dcs\Faq\Model\Resource\Category');
    }
}
