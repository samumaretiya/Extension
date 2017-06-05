<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Contactus\Model;

class Index extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Dcs\Contactus\Model\ResourceModel\Index');
    }
}
