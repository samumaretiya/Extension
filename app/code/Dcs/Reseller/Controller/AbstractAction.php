<?php

namespace Dcs\Reseller\Controller;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\ScopeInterface;

abstract class AbstractAction extends \Magento\Framework\App\Action\Action
{
    
    const XML_PATH_ENABLED = 'reseller/general/enable_frontend';
    const XML_PATH_EMAIL_RECIPIENT = 'reseller/email/recipient_email';
    const XML_PATH_GENERAL_NAME = 'trans_email/ident_general/name';
    const XML_PATH_GENERAL_EMAIL = 'trans_email/ident_general/email';
	const XML_PATH_SECRET = 'reseller/general/recapcha_secretkey';
    
    protected $scopeConfig;

    protected $storeManager;
	
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    public function dispatch(RequestInterface $request)
    {
	    if (!$this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE)) {
            throw new NotFoundException(__('Page not found.'));
        }
        return parent::dispatch($request);
    }
	
	public function getReceipentEmail()
	{
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
 		return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope);
    }
	
	public function getGeneralName()
	{
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
 		return $this->scopeConfig->getValue(self::XML_PATH_GENERAL_NAME, $storeScope);
    }
	
	public function getGeneralEmail()
	{
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
 		return $this->scopeConfig->getValue(self::XML_PATH_GENERAL_EMAIL, $storeScope);
    }
	
	public function getGooglesecretKey()
	{
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
 		return $this->scopeConfig->getValue(self::XML_PATH_SECRET, $storeScope);
    }
	
}
