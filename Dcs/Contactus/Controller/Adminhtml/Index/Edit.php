<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

namespace Dcs\Contactus\Controller\Adminhtml\Index;

class Edit extends \Dcs\Contactus\Controller\Adminhtml\Index
{

    public function execute()
    {
	    $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Dcs\Contactus\Model\Index');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('dcs_contactus/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_dcs_contactus_index', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('index_index_edit');
        $this->_view->renderLayout();
    }
}
