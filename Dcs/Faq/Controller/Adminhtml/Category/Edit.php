<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Faq\Controller\Adminhtml\Category;

class Edit extends \Dcs\Faq\Controller\Adminhtml\Category
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Dcs\Faq\Model\Category');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('dcs_faq/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_dcs_faq_category', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('category_category_edit');
        $this->_view->renderLayout();
    }
}
