<?php

namespace Dcs\Contactus\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

	const XML_PATH_CONTACT_ENABLED 	  = "contactsus/contactsus/enable_frontend";
    
    protected $_storeManager;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context
		
    )
	{
    	$this->scopeConfig = $context->getScopeConfig();
		//$this->_storeManager = $context->getStoreManager();
		parent::__construct($context);
    }
    
	public function isEnabled()
    {
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
		return $this->scopeConfig->getValue(self::XML_PATH_CONTACT_ENABLED,$storeScope);
    }
	
}