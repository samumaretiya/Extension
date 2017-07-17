<?php
namespace Dcs\Reseller\Controller\Adminhtml;

abstract class Index extends \Dcs\Reseller\Controller\Adminhtml\AbstractAction
{
    const PARAM_CRUD_ID = 'id';
	
	protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Dcs_Reseller::reseller_resellers')->_addBreadcrumb(__('Reselle'), __('Reselle'));
        return $this;
    }
	
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dcs_Reseller::reseller_resellers');
    }
}
