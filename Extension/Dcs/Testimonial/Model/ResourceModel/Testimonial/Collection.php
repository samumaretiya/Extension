<?php
/**
 * @copyright Copyright (c) 2016 www.dcs.com
 */
namespace Dcs\Testimonial\Model\ResourceModel\Testimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'dcs_testimonial_id';

    /**
     * Define resources model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dcs\Testimonial\Model\Testimonial', 'Dcs\Testimonial\Model\ResourceModel\Testimonial');
    }

}