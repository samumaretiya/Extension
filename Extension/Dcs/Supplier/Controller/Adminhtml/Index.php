<?php

namespace Dcs\Supplier\Controller\Adminhtml;

abstract class Index extends \Dcs\Supplier\Controller\Adminhtml\AbstractAction
{
    const PARAM_CRUD_ID = 'id';
	
	protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Dcs_Supplier::supplier_suppliers')->_addBreadcrumb(__('Supplier'), __('Supplier'));
        return $this;
    }
	
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dcs_Supplier::supplier_suppliers');
    }
}
