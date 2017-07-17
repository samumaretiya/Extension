<?php

namespace Dcs\Supplier\Model\ResourceModel\Supplier;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Dcs\Supplier\Model\Supplier', 'Dcs\Supplier\Model\ResourceModel\Supplier');		
    }
}
