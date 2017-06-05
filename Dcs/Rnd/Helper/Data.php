<?php

namespace Dcs\Rnd\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_storeManager;
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Store\Model\StoreManagerInterface $storeManager
    )
	{
    	$this->scopeConfig = $scopeConfig;
		$this->_storeManager = $storeManager;
		parent::__construct($context);
    }
    
}