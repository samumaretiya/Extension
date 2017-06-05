<?php
namespace Dcs\Supplier\Controller\Index;
use Magento\Framework\App\Filesystem\DirectoryList;
use Dcs\Supplier\Controller\AbstractAction;
//use Magento\Store\Model\ScopeInterface;

class Post extends \Dcs\Supplier\Controller\AbstractAction
{
	
		public function execute()
		{
		 
			$post 			= $this->getRequest()->getPostValue();
			$contact_person	= $this->getRequest()->getPost('contact_person');
			$company_name 	= $this->getRequest()->getPost('company_name');
			$address 		= $this->getRequest()->getPost('address');
			$website 		= $this->getRequest()->getPost('website');
			$email 			= $this->getRequest()->getPost('email');
			$phone_no 		= $this->getRequest()->getPost('phone_no');
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
				$model = $this->_objectManager->create('Dcs\Supplier\Model\Supplier');
				$model->setData('contact_person',$contact_person);
				$model->setData('company_name',$company_name);
				$model->setData('address',$address);
				$model->setData('website',$website);
				$model->setData('email',$email);
				$model->setData('contactno',$phone_no);
				$model->setData('message',$message);

				if (!\Zend_Validate::is(trim($post['company_name']), 'NotEmpty')) {
					$error = true;
				}
				if (!\Zend_Validate::is(trim($post['contact_person']), 'NotEmpty')) {
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
						'contact_person'	=> $contact_person,
						'company_name' 		=> $company_name,
						'address'   		=> $address,
						'website'			=> $website,
						'email'				=> $email,
						'phone_no'			=> $phone_no,
						'message'   		=> $message
					);
					/* call send mail method from helper or where you define it*/ 
					$this->_objectManager->get('Dcs\Supplier\Helper\Email')->supplierEnquiryMailSendMethod($emailTemplateVariables,$senderInfo,$receiverInfo);
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
		$this->_redirect('supplier');
		return;
    }
}