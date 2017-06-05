<?php
namespace Dcs\Contactus\Block\Adminhtml;

class Contactus extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'Dcs_Contactus';
        $this->_headerText = __('Contact Enquiry');
        parent::_construct();
		$this->removeButton('add');
    }
	protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
