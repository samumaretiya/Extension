<?php

namespace Dcs\Bestseller\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    
    protected $_storeManager;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,        
		\Magento\Store\Model\StoreManagerInterface $storeManager
    )
	{
    	$this->scopeConfig = $context->getScopeConfig();
		$this->_storeManager = $storeManager;
		parent::__construct($context);
    }
    
	public function isNewProductLogo($_product)
    {
		$now = date("Y-m-d");
		$newsFrom = $_product->getNewFromDate();								
		$newsTo =  $_product->getNewsToDate();					

		if(($now >= $newsFrom) && ($now <= $newsTo)){
			//echo '<div class="label new-label">New</div>';
			return true;
		} else {
			return false;
		}
		
    }
	
}