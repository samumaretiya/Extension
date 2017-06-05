<?php

namespace Dcs\Contactus\Controller\Index;
use Magento\Framework\App\Filesystem\DirectoryList;
use Dcs\Contactus\Controller\AbstractAction;
use Magento\Store\Model\ScopeInterface;

class Post extends \Dcs\Contactus\Controller\AbstractAction
{
	
		public function execute()
		{
		 
		$post 			= $this->getRequest()->getPostValue();
		$name 			= $this->getRequest()->getPost('name');
		$email 			= $this->getRequest()->getPost('email');
		$subject 		= $this->getRequest()->getPost('subject');
		$ordernumber 	= $this->getRequest()->getPost('ordernumber');
		$message 		= $this->getRequest()->getPost('message');
			
		if (!$post) {
			$this->_redirect('*/*/');
			return;
		}
		try {
			//$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE; 
			$error = false;
			
			//$secret = '6LcHtBwUAAAAAPFX8pIgolqZ6Vx_JqGeGGRVmxZF';
			$secret = $this->getGooglesecretKey(); 
			
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$post['g-recaptcha-response']);

			$responseData = json_decode($verifyResponse);
			
			
			 if($responseData->success){
				$error = false;
			}
			else{
				$error = true;
			}
			
			/*$postObject = new \Magento\Framework\DataObject();
           	$postObject->setData($post);*/
	
			$model = $this->_objectManager->create('Dcs\Contactus\Model\Contactus');
			$model->setData('name',$name);
			$model->setData('email',$email);
			$model->setData('subject',$subject);
			$model->setData('ordernumber',$ordernumber);
			$model->setData('message',$message);

			if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
				$error = true;
			}
			if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
				$error = true;
			}
			if (!\Zend_Validate::is(trim($post['message']), 'NotEmpty')) {
				$error = true;
			}
			 
			if($post['g-recaptcha-response'] == ''){
				$error = true;
			}

			if ($error) {
				throw new \Exception();
			}


			try {
				
				/****************************************************************/
				
				/* Receiver Detail  */
				
				/*$emailTemplateVariables['name'] = $name;
				$emailTemplateVariables['email'] = $email;
				$emailTemplateVariables['subject'] = $subject;
				$emailTemplateVariables['ordernumber'] = $ordernumber;
				$emailTemplateVariables['message'] = $message;*/
				
				/* call send mail method from helper or where you define it*/ 
				/***********************************************************************/
				/*$templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId());
				
				$tempId = 2;     
				
				  $transport = $this->_transportBuilder
                ->setTemplateIdentifier($tempId)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars(['data' => $postObject])
                ->setFrom($senderemail)
                ->addTo($receiveremail)
                ->setReplyTo($post['email'])
                ->getTransport();

            	$transport->sendMessage();
				
				$this->inlineTranslation->resume();*/
				$model->save();
				
				$this->messageManager->addSuccess(
					__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
				);

			}catch (\Exception $e) {
					
					$this->inlineTranslation->resume();
					$this->messageManager->addError(
						__('We can\'t process your request right now. Sorry, that\'s all we know.')
					);
			}

		} catch (\Exception $e) {
			
			$this->inlineTranslation->resume();
			$this->messageManager->addError(
				__('We can\'t process your request right now. Sorry, that\'s all we know.')
			);
		}
		$this->_redirect('contacts');
		return;
    }
}
