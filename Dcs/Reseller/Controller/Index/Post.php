<?php
namespace Dcs\Reseller\Controller\Index;
use Magento\Framework\App\Filesystem\DirectoryList;
use Dcs\Supplier\Controller\AbstractAction;
//use Magento\Store\Model\ScopeInterface;

class Post extends \Dcs\Supplier\Controller\AbstractAction
{
	
		public function execute()
		{
		 
			$post 			= $this->getRequest()->getPostValue();
			$name			= $this->getRequest()->getPost('name');
			$email 			= $this->getRequest()->getPost('email');
			$contactno 		= $this->getRequest()->getPost('contactno');
			$enquiry 		= $this->getRequest()->getPost('enquiry');
			$postcode 		= $this->getRequest()->getPost('postcode');
			$message 		= $this->getRequest()->getPost('message');
			
			if (!$post) {
				$this->_redirect('*/*/');
				return;
			}
			try
			{
				$error = false;
				$secret = $this->getGooglesecretKey(); 
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$post['g-recaptcha-response']);
				$responseData = json_decode($verifyResponse);
				if($responseData->success)
				{
					$error = false;
				}
				else
				{
					$error = true;
				}
				/*$postObject = new \Magento\Framework\DataObject();
				$postObject->setData($post);*/
				$model = $this->_objectManager->create('Dcs\Reseller\Model\Reseller');
				$model->setData('name',$name);
				$model->setData('email',$email);
				$model->setData('contactno',$contactno);
				$model->setData('enquiry',$enquiry);
				$model->setData('postcode',$postcode);
				$model->setData('message',$message);

				if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
					$error = true;
				}
				if (!\Zend_Validate::is(trim($post['enquiry']), 'NotEmpty')) {
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
				try
				{
					/****************************************************************/
					/* Receiver Detail  */
					$receiveremail = $this->getReceipentEmail();
					$receiverInfo = [
						'name' => 'Real Smart',
						'email' => $receiveremail,
					];
					$sendername = $this->getGeneralName();
					$senderemail = $this->getGeneralEmail();
					$senderInfo = [
						'name' => $sendername,
						'email' => $senderemail,
					];
					 /*Assign values for your template variables  */
					$emailTemplateVariables = array();
					$emailTemplateVariables = array(
						'name'			=> $name,
						'email' 		=> $email,
						'contactno'		=> $contactno,
						'enquiry'		=> $enquiry,
						'postcode'		=> $postcode,
						'message'   	=> $message
					);
					/* call send mail method from helper or where you define it*/ 
					$this->_objectManager->get('Dcs\Reseller\Helper\Email')->resellerEnquiryMailSendMethod($emailTemplateVariables,$senderInfo,$receiverInfo);
					/***********************************************************************/
					$model->save();
					$this->messageManager->addSuccess(
						__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
					);
				}
				catch (\Exception $e)
				{	
					$this->messageManager->addError(
						__('We can\'t process your request right now. Sorry, that\'s all we know.')
					);
				}
		}
		catch (\Exception $e)
		{
			$this->messageManager->addError(
				__('We can\'t process your request right now. Sorry, that\'s all we know.')
			);
		}
		$this->_redirect('reseller');
		return;
    }
}