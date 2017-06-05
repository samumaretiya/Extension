<?php

namespace  Dcs\Contactus\Model\ResourceModel;

class Contactus extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('dcs_contactus', 'id');
    }
}
