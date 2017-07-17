<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Model\Resource\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dcs\Faq\Model\Category', 'Dcs\Faq\Model\Resource\Category');
    }
}
