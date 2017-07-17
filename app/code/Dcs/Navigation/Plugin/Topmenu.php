<?php

namespace Dcs\Navigation\Plugin;

class Topmenu
{
    public function afterGetHtml(\Magento\Theme\Block\Html\Topmenu $topmenu, $html)
    {
		$_objectManager = \Magento\Framework\App\ObjectManager::getInstance(); //instance of\Magento\Framework\App\ObjectManager
		$storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface'); 
		$currentStore = $storeManager->getStore();
		$baseUrl = $currentStore->getBaseUrl();
		
		$html .= "<li class=\"level0 nav-4 level-top menu-contact-us\">";
        $html .= "<a href=\"" . $baseUrl."contacts" . "\" class=\"level-top ui-corner-all\" aria-haspopup=\"true\" tabindex=\"-1\" role=\"menuitem\"><span class=\"ui-menu-icon ui-icon ui-icon-carat-1-e\"></span><span>" . __("Contact Us") . "</span></a>";        
        $html .= "</li>";
		
		$html .= "<li class=\"level0 nav-5 level-top menu-help\">";
        $html .= "<a href=\"" . $baseUrl."help-centre" . "\" class=\"level-top ui-corner-all\" aria-haspopup=\"true\" tabindex=\"-1\" role=\"menuitem\"><span class=\"ui-menu-icon ui-icon ui-icon-carat-1-e\"></span><span>" . __("Help") . "</span></a>";        
        $html .= "</li>";
		return $html;
		
		/*
        $html .= "<li class=\"level0 nav-4 level-top parent ui-menu-item\">";
        $html .= "<a href=\"" . "EXTERNAL_URL" . "\" class=\"level-top ui-corner-all\" aria-haspopup=\"true\" tabindex=\"-1\" role=\"menuitem\"><span class=\"ui-menu-icon ui-icon ui-icon-carat-1-e\"></span><span>" . __("EXTERNAL_URL_TITLE") . "</span></a>";
        $html .= "<ul class=\"level0 submenu ui-menu ui-widget ui-widget-content ui-corner-all\" role=\"menu\" aria-expanded=\"false\" style=\"display: none; top: 47px; left: -0.4375px;\" aria-hidden=\"true\">";

        $html .= "<li class=\"level1 nav-5-1 first ui-menu-item\" role=\"presentation\">";
        $html .= "<a href=\"" . "EXTERNAL_URL_A" . "\" class=\"ui-corner-all\" tabindex=\"-1\" role=\"menuitem\"><span>" . __("EXTERNAL_URL_TITLE_A") . "</span></a>";
        $html .= "</li>";

        $html .= "<li class=\"level1 nav-5-1 first ui-menu-item\" role=\"presentation\">";
        $html .= "<a href=\"" . "EXTERNAL_URL_B" . "\" class=\"ui-corner-all\" tabindex=\"-1\" role=\"menuitem\"><span>" . __("EXTERNAL_URL_TITLE_B") . "</span></a>";
        $html .= "</li>";

        $html .= "<li class=\"level1 nav-5-1 first ui-menu-item\" role=\"presentation\">";
        $html .= "<a href=\"" . "EXTERNAL_URL_C" . "\" class=\"ui-corner-all\" tabindex=\"-1\" role=\"menuitem\"><span>" . __("EXTERNAL_URL_TITLE_C") . "</span></a>";
        $html .= "</li>";

        $html .= "</ul>";
        $html .= "</li>";
		return $html;
		*/
        
    }
}