<?php
namespace Dcs\Reseller\Block\Adminhtml;

class Reseller extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'Dcs_Reseller';
        $this->_headerText = __('Resellers');
        parent::_construct();
		$this->removeButton('add');
    }
	protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
