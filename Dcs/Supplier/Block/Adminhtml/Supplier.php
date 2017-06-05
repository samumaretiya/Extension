<?php
namespace Dcs\Supplier\Block\Adminhtml;

class Supplier extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'Dcs_Supplier';
        $this->_headerText = __('Supplier');
        parent::_construct();
		$this->removeButton('add');
    }
	protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
