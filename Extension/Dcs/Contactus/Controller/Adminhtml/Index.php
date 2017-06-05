<?php


namespace Dcs\Contactus\Controller\Adminhtml;

abstract class Index extends \Dcs\Contactus\Controller\Adminhtml\AbstractAction
{
    const PARAM_CRUD_ID = 'id';

	protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Dcs_Contactus::contactus_contact')->_addBreadcrumb(__('Contactus'), __('Contactus'));
        return $this;
    }
	
	
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dcs_Contactus::contactus_contact');
    }
}
