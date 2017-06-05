<?php

namespace Dcs\Reseller\Block;

 
use Magento\Framework\View\Element\Template;

class Reseller extends Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }   

    protected $_items;    
 
    protected $_resource;
 
    //protected $_faqCollection = null;
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,        
        \Magento\Framework\App\ResourceConnection $resource,
        
        array $data = []
    ) {
        $this->_resource = $resource;
        
 
        parent::__construct(
            $context,
            $data
        );
    }
    
    public function isEnabled()
    {
        // return $this->_faqHelper->isEnabled();
    }     
}
