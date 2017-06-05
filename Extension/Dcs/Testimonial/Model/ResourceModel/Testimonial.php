<?php
/**
 * @copyright Copyright (c) 2016 www.dcs.com
 */
namespace Dcs\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Testimonial extends AbstractDb{
    /**
     * @return mixed
     */
    protected function _construct()
    {
        $this->_init('dcs_testimonial', 'dcs_testimonial_id');
    }

}