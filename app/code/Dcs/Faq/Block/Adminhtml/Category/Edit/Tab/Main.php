<?php
 

namespace Dcs\Faq\Block\Adminhtml\Category\Edit\Tab;


use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Dcs\Faq\Model\Grid\Status;



class Main extends Generic implements TabInterface
{
    protected $_systemStore;
     

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        Status $options,         
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
          
         $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Category Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Category Information');
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
        $model = $this->_coreRegistry->registry('current_dcs_faq_category');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Category Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name',
             'label' => __('Category Name'),
              'title' => __('Category Name'),
               'required' => true
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            ['name' => 'sort_order',
             'label' => __('Rank'),
              'title' => __('Rank'),
               'required' => true,
                'class' => 'required-entry validate-number validate-greater-than-zero'
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status',
             'label' => __('Publish'),
              'title' => __('Publish'),
               'options' => $this->_options->getOptionArray()
            ]
        );

        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
