<?php

namespace Dcs\Faq\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
 
class Search extends Action
{
    protected $resultPageFactory;
    protected $_items;    

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Dcs\Faq\Model\Items $items,
        array $data = []
    )
    {
        $this->_items = $items;
        parent::__construct($context , $data);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
		ob_start();
        $keyword = $this->getRequest()->getParam('keyword');
        
        $faqCollection = $this->_items->getCollection()
                ->addFieldToSelect('*')
                ->addFieldToFilter(array('question','answer'),
                    array(
                    array('question' , array('like' => '%'.$keyword.'%')),
                    array('answer' , array('like' => '%'.$keyword.'%')),
                    ))
                 ->addFieldToFilter('status' , 1)                  
                ->setOrder('rank' , 'ASC');
            $filter = \Magento\Framework\App\ObjectManager::getInstance();
            echo "<div id='faq'>";
            echo '<span class="no-record">'.__("Search for ").'"'.$keyword.'"'.'</span>';
            if(count($faqCollection) > 0)
            {
                foreach ($faqCollection as $faq)
                {
					$faqAnswer = $faq->getAnswer();					
					$filterAnswer = $filter->get('Magento\Cms\Model\Template\FilterProvider')->getPageFilter()->filter($faqAnswer);
                       echo "<div class='faqBox'><dt class='faqQuestion'>".$faq->getQuestion()."</dt>";
                       echo "<dd class='faqAnswer'>".$filterAnswer."</dd></div>";
                }  
                  
            }        
            else
            {
                  echo "<br /><span class='no-record'>". __("No Record Found")."</span>";
            }
            echo "</div>";    	  
     }        
}
