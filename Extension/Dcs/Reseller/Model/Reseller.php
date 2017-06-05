<?php

namespace Dcs\Reseller\Model;

class Reseller extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Dcs\Reseller\Model\ResourceModel\Reseller');
    }
}
