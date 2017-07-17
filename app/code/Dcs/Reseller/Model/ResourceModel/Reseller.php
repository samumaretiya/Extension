<?php

namespace Dcs\Reseller\Model\ResourceModel;

class Reseller extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('dcs_reseller', 'id');
    }
}
