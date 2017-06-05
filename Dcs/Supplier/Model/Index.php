<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Supplier\Model;

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
        //$this->_init('Dcs\Supplier\Model\Resource\Index');
		 $this->_init('Dcs\Supplier\Model\ResourceModel\Index');
		//exit;
    }
}
