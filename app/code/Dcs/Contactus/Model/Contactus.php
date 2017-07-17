<?php

namespace Dcs\Contactus\Model;


class Contactus extends \Magento\Framework\Model\AbstractModel
{
   
    protected function _construct()
    {
		parent::_construct();
        $this->_init('Dcs\Contactus\Model\ResourceModel\Contactus');
    }

}
