<?php

namespace Dcs\Reseller\Block\Adminhtml\Index\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
//use Dcs\Reseller\Model\Grid\Status;



class Main extends Generic implements TabInterface
{
    protected $_systemStore;    

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        //Status $options,         
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
          
         //$this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Reseller Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Reseller Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {		
        $model = $this->_coreRegistry->registry('current_dcs_reseller_index');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Reseller Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
		$fieldset->addField(
            'name',
            'label',
            ['name' => 'name',
            'label' => __('Name'),
            'title' => __('Name'),
           // 'required' => true
            ]
        );		
        $fieldset->addField(
            'email',
            'label',
            ['name' => 'email',
            'label' => __('Email'),
            'title' => __('Email'),
            //'required' => true,
            'class' => 'required-entry'
            ]
        );

		$fieldset->addField(
			'contactno',
			'label',
			['name' => 'contactno',
			'label' => __('Contact Number'),
			'title' => __('Contact Number'),
			'required' => false,
			'class' => ''
			]
		);
		
		$fieldset->addField(
			'enquiry',
			'label',
			['name' => 'enquiry',
			'label' => __('Enquiry'),
			'title' => __('Enquiry'),
			//'required' => true,
			'class' => 'required-entry'
			]
		);
		$fieldset->addField(
			'postcode',
			'label',
			['name' => 'postcode',
			'label' => __('Postcode'),
			'title' => __('Postcode'),
			'required' => false,
			'class' => ''
			]
		);
		
		$fieldset->addField(
			'message',
			'label',
			['name' => 'message',
			'label' => __('Message'),
			'title' => __('Message'),
			'required' => false,
			'class' => ''
			]
		);	

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
