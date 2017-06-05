<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Controller\Adminhtml\Category;

class NewAction extends \Dcs\Faq\Controller\Adminhtml\Category
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
