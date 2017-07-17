<?php

namespace Dcs\Reseller\Controller\Adminhtml\Index;

class Index extends \Dcs\Reseller\Controller\Adminhtml\Index
{
    public function execute()
    {
       /* if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');

            return $resultForward;
        }*/

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
