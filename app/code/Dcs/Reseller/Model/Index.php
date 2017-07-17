<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Reseller\Model;

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
        //$this->_init('Dcs\Reseller\Model\Resource\Index');
		 $this->_init('Dcs\Reseller\Model\ResourceModel\Index');
		//exit;
    }
}
