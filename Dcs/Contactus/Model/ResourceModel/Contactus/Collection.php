<?php

namespace Dcs\Contactus\Model\ResourceModel\Contactus;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
 
    protected function _construct()
    {
        $this->_init('Dcs\Contactus\Model\Contactus', 'Dcs\Contactus\Model\ResourceModel\Contactus');
    }
}
