<?php


namespace Dcs\Contactus\Controller\Adminhtml\Index;

class Index extends \Dcs\Contactus\Controller\Adminhtml\Index
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
