<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */
namespace Dcs\Contactus\Block\Adminhtml\Index;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize form
     * Add standard buttons
     * Add "Save and Continue" button
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'Dcs_Contactus';

        parent::_construct();

		$this->buttonList->remove('save');
		$this->buttonList->remove('delete');
		$this->buttonList->remove('reset');
    }

    /**
     * Getter for form header text
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $item = $this->_coreRegistry->registry('current_dcs_contactus_index');
        if ($item->getId()) {
            return __("Edit Contactus '%1'", $this->escapeHtml($item->getName()));
        } else {
            return __('New Contactus');
        }
    }
}
