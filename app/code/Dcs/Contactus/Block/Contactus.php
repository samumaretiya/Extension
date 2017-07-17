<?php

namespace Dcs\Contactus\Block;
 
use Magento\Framework\View\Element\Template;

class Contactus extends Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }   

    protected $_items;    
 
    protected $_resource;
    protected $contactHelper;
 
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,        
        \Magento\Framework\App\ResourceConnection $resource,
        \Dcs\Contactus\Helper\Data $contactHelper,
        array $data = []
    ) {
        $this->_resource = $resource;
        $this->contactHelper = $contactHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    public function isEnabledModule()
    {
		 return $this->contactHelper->isEnabled();
    }
	
}
