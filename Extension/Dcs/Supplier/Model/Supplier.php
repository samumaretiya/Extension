<?php

namespace Dcs\Supplier\Model;

class Supplier extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Dcs\Supplier\Model\ResourceModel\Supplier');
    }
}
