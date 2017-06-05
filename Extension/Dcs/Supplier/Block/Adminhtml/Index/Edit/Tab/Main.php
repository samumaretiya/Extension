<?php

namespace Dcs\Supplier\Block\Adminhtml\Index\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
//use Dcs\Supplier\Model\Grid\Status;



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
        return __('Supplier Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Supplier Information');
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
        $model = $this->_coreRegistry->registry('current_dcs_supplier_index');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Supplier Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
		$fieldset->addField(
            'contact_person',
            'label',
            ['name' => 'contact_person',
            'label' => __('Contact Person'),
            'title' => __('Contact Person'),
            'required' => true
            ]
        );		
        $fieldset->addField(
            'company_name',
            'label',
            ['name' => 'company_name',
            'label' => __('Company Name'),
            'title' => __('Company Name'),
            'required' => true,
            'class' => 'required-entry'
            ]
        );

		$fieldset->addField(
			'address',
			'label',
			['name' => 'address',
			'label' => __('Address'),
			'title' => __('Address'),
			'required' => false,
			'class' => ''
			]
		);
		
		$fieldset->addField(
			'website',
			'label',
			['name' => 'website',
			'label' => __('Website'),
			'title' => __('Website'),
			'required' => false,
			'class' => ''
			]
		);
		$fieldset->addField(
			'email',
			'label',
			['name' => 'email',
			'label' => __('Email'),
			'title' => __('Email'),
			'required' => true,
            'class' => 'required-entry'
			]
		);
		$fieldset->addField(
			'contactno',
			'label',
			['name' => 'contactno',
			'label' => __('Phone No'),
			'title' => __('Email'),
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
			'required' => true,
            'class' => 'required-entry'
			]
		);	

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
