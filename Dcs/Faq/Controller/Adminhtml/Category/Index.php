<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Controller\Adminhtml\Category;

class Index extends \Dcs\Faq\Controller\Adminhtml\Category
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
        $resultPage->setActiveMenu('Dcs_Faq::category');
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ Category Manager'));
        $resultPage->addBreadcrumb(__('Home'), __('Home'));
        $resultPage->addBreadcrumb(__('FAQ Category'), __('FAQ Category'));
        return $resultPage;
    }
}
