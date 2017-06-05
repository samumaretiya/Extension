<?php
/**
 * Copyright © 2015 Dcs. All rights reserved.
 */

// @codingStandardsIgnoreFile

namespace Dcs\Faq\Block\Adminhtml\Items\Edit\Tab;


use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
//use Magestore\Bannerslider\Model\Status;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Dcs\Faq\Model\Resource\Visible;
use Dcs\Faq\Model\Grid\Status;

class Main extends Generic implements TabInterface
{
    protected $_systemStore;
    
    protected $_wysiwygConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        Config $wysiwygConfig,
        \Dcs\Faq\Block\Category $catData,
        Status $options,
        array $data = []
    ) {
		$this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        $this->_options = $options;
        $this->_catData =$catData;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('FAQ Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('FAQ Information');
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
        $model = $this->_coreRegistry->registry('current_dcs_faq_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('FAQ Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        $fieldset->addField(
            'question',
            'text',
            ['name' => 'question', 'label' => __('Question'), 'title' => __('Question'), 'required' => true]
        );
        
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'answer',
            'editor',
            [
                'name' => 'answer',
                'label' => __('Answer'), 
                'title' => __('Answer'), 
                'required' => true ,
                'config'    => $wysiwygConfig 
            ]
        );

        $fieldset->addField(
            'category',
            'select',
            ['name' => 'category',
             'label' => __('Select Category'),
              'title' => __('Select Category'),
              'required' => false ,
              'options' => $this->_catData->getLoadedFaqCategoryCollection()
            ]
        );
        
        /*$fieldset->addField(
            'Answer',
            'editor',
            ['name' => 'answer', 'label' => __('Answer'), 'title' => __('Answer'), 'required' => true, 'style' => 'height:36em',
                'required' => true]
        );*/
        
        $fieldset->addField(
            'rank',
            'text',
            ['name' => 'rank', 'label' => __('Rank'), 'title' => __('Rank'), 'required' => true,  'class' => 'required-entry validate-number validate-greater-than-zero']
        );
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Publish'), 'title' => __('Publish'), 'required' => true, 'options' => $this->_options->getOptionArray()]
        );
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
