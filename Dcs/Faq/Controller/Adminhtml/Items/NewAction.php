<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Controller\Adminhtml\Items;

class NewAction extends \Dcs\Faq\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
