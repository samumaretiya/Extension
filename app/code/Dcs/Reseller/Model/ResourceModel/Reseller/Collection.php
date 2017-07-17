<?php

namespace Dcs\Reseller\Model\ResourceModel\Reseller;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Dcs\Reseller\Model\Reseller', 'Dcs\Reseller\Model\ResourceModel\Reseller');
    }
}
