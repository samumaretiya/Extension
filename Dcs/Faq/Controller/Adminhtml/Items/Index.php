<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Controller\Adminhtml\Items;

class Index extends \Dcs\Faq\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dcs_Faq::faq');
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ manager'));
        $resultPage->addBreadcrumb(__('Dcs'), __('Dcs'));
        $resultPage->addBreadcrumb(__('Items'), __('FAQ'));
        return $resultPage;
    }
}
