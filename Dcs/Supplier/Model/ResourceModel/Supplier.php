<?php

namespace Dcs\Supplier\Model\ResourceModel;

class Supplier extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('dcs_supplier', 'id');
    }
}
