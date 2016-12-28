<?php
class ControllerCommonLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('account/customer');
		
	}
	
	public function addlogin() {			
		$json=array();
				$this->load->model('catalog/login');
				
				if (empty($this->request->post['email']) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])))
				{
					$json['error']['email']='Enter valid email';
				}
					
				elseif (empty($this->request->post['password']))
				{
					$json['error']['password']='Password must enter';
				}
					
				else
				{
				if(!$this->customer->login($this->request->post['email'], $this->request->post['password']))
				{
				$json['error']['email']='Email Address not match';
				}
				else
				{
				$json['success']='Success';
				$json['redirect']=  $this->request->post['redirect'];
				}
				}
				
				$this->response->setOutput(json_encode($json));
		}
	
	public function addregister() {			
		$json=array();
		
		$this->load->language('account/register');
		$this->load->model('account/customer');
		
		// Register Required Start 	
			$register_fstnamerequire = $this->config->get('quicklogin_fnamerequired');
			$register_lstnarequire = $this->config->get('quicklogin_lastnamerequired');
			$register_phonrequire = $this->config->get('quicklogin_phonerequired');
			$register_faxrequire = $this->config->get('quicklogin_faxrequired');
			$register_comprequire = $this->config->get('quicklogin_compquired');
			$register_add1require = $this->config->get('quicklogin_add1required');
			$register_add2require = $this->config->get('quicklogin_add2required');
			$register_cityrequire = $this->config->get('quicklogin_cityrequired');
			$register_postcrequire = $this->config->get('quicklogin_postcodrequired');
			$register_contryrequire = $this->config->get('quicklogin_countryrequired');
			$register_zonrequire = $this->config->get('quicklogin_zonerequired');
			$register_privrequire = $this->config->get('quicklogin_privacyrequired');
			
			// Register Required End
			
			// Register Required Status
			
			$register_fstnastatus = $this->config->get('quicklogin_fnamestatus');
			$register_lastnastatus = $this->config->get('quicklogin_lastnamestatus');
			$register_phonstatus = $this->config->get('quicklogin_phonestatus');
			$register_faxnastatus = $this->config->get('quicklogin_faxstatus');
			$register_compstatus = $this->config->get('quicklogin_compstatus');		
			$register_add1status = $this->config->get('quicklogin_add1status');
			$register_add2status = $this->config->get('quicklogin_add2status');		
			$register_citystatus = $this->config->get('quicklogin_citystatus');
			$register_countstatus = $this->config->get('quicklogin_countrystatus');
			$register_zonestatus = $this->config->get('quicklogin_zonestatus');
			$register_privstatus = $this->config->get('quicklogin_privacystatus');		
			$register_postcstatus = $this->config->get('quicklogin_postcodstatus');
			
			
			//Registration Error Start
		
//		$data['custgrp_error'] = $this->config->get('quicklogin_register')['customgrouperror'];
		
		// Firstname Errors
		
		$firstname_errors =$this->config->get('quicklogin_register')['firstnamerror'][$this->config->get('config_language_id')];
		if(!empty($firstname_errors)){		
		$firstname_error = $firstname_errors;		
		}else{
		$firstname_error = $this->language->get('error_firstname');
		}
		
		// Lastname Errors
		$lastnamerrors =$this->config->get('quicklogin_register')['lastnamerror'][$this->config->get('config_language_id')];
		if(!empty($lastnamerrors)){		
		$lastname_error = $lastnamerrors;		
		}else{
		$lastname_error = $this->language->get('error_lastname');;
		}
		
		// Email Errors
		$email_errors =$this->config->get('quicklogin_register')['emailerror'][$this->config->get('config_language_id')];
		if(!empty($email_errors)){		
		$email_error = $email_errors;		
		}else{
		$email_error = $this->language->get('error_email');
		}
		
		$emailalrdy_errorss =$this->config->get('quicklogin_register')['emailexist'][$this->config->get('config_language_id')];
		if(!empty($emailalrdy_errorss)){		
		$emailalrdy_errors = $emailalrdy_errorss;		
		}else{
		$emailalrdy_errors = $this->language->get('text_emailalrady');
		}
		
		// Telephone Errors
		$data['telephone_errorss'] =$this->config->get('quicklogin_register')['phonerror'][$this->config->get('config_language_id')];
		$telephone_errors =$this->config->get('quicklogin_register')['phonerror'][$this->config->get('config_language_id')];
		if(!empty($telephone_errors)){		
		$telephone_error = $telephone_errors;		
		}else{
		$telephone_error = $this->language->get('error_telephone');
		}
				
		// Fax Errors
		$data['fax_errorss'] =$this->config->get('quicklogin_register')['faxerror'][$this->config->get('config_language_id')];
		$fax_errors =$this->config->get('quicklogin_register')['faxerror'][$this->config->get('config_language_id')];
		if(!empty($fax_errors)){		
		$fax_error = $fax_errors;		
		}else{
		$fax_error = $this->language->get('error_fax');;
		}
				
		// Company Errors
		$data['company_errorss'] =$this->config->get('quicklogin_register')['companyerror'][$this->config->get('config_language_id')];
		$company_errors =$this->config->get('quicklogin_register')['companyerror'][$this->config->get('config_language_id')];
		if(!empty($company_errors)){		
		$company_error = $company_errors;		
		}else{
		$company_error = $this->language->get('error_company');
		}
				
		// Address_1 Errors
		$data['address_1_errorss'] =$this->config->get('quicklogin_register')['add1error'][$this->config->get('config_language_id')];
		$address_1_errors =$this->config->get('quicklogin_register')['add1error'][$this->config->get('config_language_id')];
		if(!empty($address_1_errors)){		
		$address_1_error = $address_1_errors;		
		}else{
		$address_1_error = $this->language->get('error_address_1');
		}
		
		// Address_2 Errors
		$data['address_2_errorss'] =$this->config->get('quicklogin_register')['add2error'][$this->config->get('config_language_id')];
		$address_2_errors =$this->config->get('quicklogin_register')['add2error'][$this->config->get('config_language_id')];
		if(!empty($address_2_errors)){		
		$address_2_error = $address_2_errors;		
		}else{
		$address_2_error = $this->language->get('error_address_2');
		}
		
		// City Errors
		
		$data['city_errorss'] =$this->config->get('quicklogin_register')['cityerror'][$this->config->get('config_language_id')];
		
		$city_errors =$this->config->get('quicklogin_register')['cityerror'][$this->config->get('config_language_id')];
		if(!empty($city_errors)){		
		$city_error = $city_errors;		
		}else{
		$city_error = $this->language->get('error_city');
		}
		
		
		// Postcode Errors
		$data['postcode_errorss'] =$this->config->get('quicklogin_register')['postcoderror'][$this->config->get('config_language_id')];
		
		$postcode_errors =$this->config->get('quicklogin_register')['postcoderror'][$this->config->get('config_language_id')];
		
		if(!empty($postcode_errors)){		
		$postcode_error = $postcode_errors;		
		}else{
		$postcode_error = $this->language->get('error_postcode');
		}
		
		// Country Errors
		$country_errors =$this->config->get('quicklogin_register')['countryerror'][$this->config->get('config_language_id')];
		if(!empty($country_errors)){		
		$country_error = $country_errors;		
		}else{
		$country_error = $this->language->get('error_country');
		}
		
		// Zone Errors
		$zone_errors =$this->config->get('quicklogin_register')['zonerror'][$this->config->get('config_language_id')];
		if(!empty($zone_errors)){		
		$zone_error = $zone_errors;		
		}else{
		$zone_error = $this->language->get('error_zone');
		}
		
		// Pwd Errors
		$pwd_errors =$this->config->get('quicklogin_register')['pwderror'][$this->config->get('config_language_id')];
		if(!empty($pwd_errors)){		
		$pwd_error = $pwd_errors;		
		}else{
		$pwd_error = $this->language->get('error_password');
		}
		
		// Cpwd Errors
		$cpwd_errors =$this->config->get('quicklogin_register')['cpwderror'][$this->config->get('config_language_id')];
		if(!empty($cpwd_errors)){		
		$cpwd_error = $cpwd_errors;		
		}else{
		$cpwd_error = $this->language->get('error_confirm');
		}
		
		// Privacy Errors
		$privacy_errors =$this->config->get('quicklogin_register')['privacyerror'][$this->config->get('config_language_id')];
		if(!empty($privacy_errors)){		
		$privacy_error = $privacy_errors;		
		}else{
		$privacy_error = $this->language->get('error_agree');
		}
		
		
		//Registration Error End
		
		//Registration Lable
//		$data['custgrp_lable'] = $this->config->get('quicklogin_register')['customgrouplabel'];
		
		
		//Registration Lable 
		
			// Register Required Status
			
			if(!empty($register_fstnamerequire) && !empty($register_fstnastatus)) {
			
			if ((utf8_strlen(trim($this->request->post['firstname'])) < 3) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			
				$json['error']['firstname']= $firstname_error;
			}
			} 
			
			if(!empty($register_lstnarequire) && !empty($register_lastnastatus)) {		
			if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			
				$json['error']['lastname']=$lastname_error;
			}
			} 
			if (empty($this->request->post['email']) || (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])))
			{
				$json['error']['email']= $email_error;				
			}
			else
			{
				$status=$this->model_account_customer->getCustomerByEmail($this->request->post['email']);			 
				if($status)	{
				$json['error']['email']= $emailalrdy_errors;
				}
			}
			
			if(!empty($register_phonrequire) && !empty($register_phonstatus)) {	
			if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			
				$json['error']['telephone']= $telephone_error;
			}
			} 
			
			if(!empty($register_faxrequire) && !empty($register_faxnastatus)) {	
			if ((utf8_strlen(trim($this->request->post['fax'])) < 1) || (utf8_strlen(trim($this->request->post['fax'])) > 32)) {
			
				$json['error']['fax']= $fax_error;
			}
			} 
			if(!empty($register_comprequire) && !empty($register_compstatus)) {
			if ((utf8_strlen(trim($this->request->post['company'])) < 1) || (utf8_strlen(trim($this->request->post['company'])) > 32)) {
			
				$json['error']['company']= $company_error;
			}
			}
			
			if(!empty($register_add1require) && !empty($register_add1status)) {
			if ((utf8_strlen(trim($this->request->post['address_1'])) < 1) || (utf8_strlen(trim($this->request->post['address_1'])) > 32)) {
			
				$json['error']['address_1']= $address_1_error;
			}
			}
			if(!empty($register_add2require) && !empty($register_add2status)) {
			if ((utf8_strlen(trim($this->request->post['address_2'])) < 1) || (utf8_strlen(trim($this->request->post['address_2'])) > 32)) {
			
				$json['error']['address_2']= $address_2_error;
			}
			} 
			
			 
			
			if(!empty($register_cityrequire) && !empty($register_citystatus)) {
			if ((utf8_strlen(trim($this->request->post['city'])) < 1) || (utf8_strlen(trim($this->request->post['city'])) > 32)) {
			
				$json['error']['city']= $city_error;
			}
			} 
			
			
			if(!empty($register_postcrequire) && !empty($register_postcstatus)) {
			if ((utf8_strlen(trim($this->request->post['postcode'])) < 1) || (utf8_strlen(trim($this->request->post['postcode'])) > 32)) {
			
				$json['error']['postcode']= $postcode_error;
			}
			} 
			
			if(!empty($register_contryrequire) && !empty($register_countstatus)) {
			$this->load->model('localisation/country');
			if ($this->request->post['country_id'] == '') {
				$json['error']['country_id'] = $country_error;
			}
			} 
			
			
			if(!empty($register_zonrequire) && !empty($register_zonestatus)) {
			if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
				$json['error']['zone_id'] = $zone_error;
			}
			} 
			
			
			
			
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) 
			{
				$json['error']['password']= $pwd_error;
			}
			else
			{
			
			if ($this->request->post['confirm'] != $this->request->post['password']) {
				$json['error']['confirm'] = $cpwd_error;
			}
			
			}				
			if (!empty($register_privrequire) && empty($this->request->post['agree']))
				{
				$json['error']['agree']= $privacy_errors;
			}
			
			if(empty($json['error']))
			{
			$data=array(
			'firstname'=>isset($this->request->post['firstname'])?$this->request->post['firstname']:'',
			'lastname'=>isset($this->request->post['lastname'])?$this->request->post['lastname']:'',
			'email'=>isset($this->request->post['email'])?$this->request->post['email']:'',
			'countrycode'=>isset($this->request->post['countrycode'])?$this->request->post['countrycode']:'',
			'telephone'=>isset($this->request->post['telephone'])?$this->request->post['telephone']:'',
			'password'=>isset($this->request->post['password'])?$this->request->post['password']:'',
			'company'=>isset($this->request->post['company'])?$this->request->post['company']:'',
			'address_1'=>isset($this->request->post['address_1'])?$this->request->post['address_1']:'',
			'address_2'=>isset($this->request->post['address_2'])?$this->request->post['address_2']:'',
			'city'=>isset($this->request->post['city'])?$this->request->post['city']:'',
			'postcode'=>isset($this->request->post['postcode'])?$this->request->post['postcode']:'',
			'country_id'=>isset($this->request->post['country_id'])?$this->request->post['country_id']:'',
			'zone_id'=>isset($this->request->post['zone_id'])?$this->request->post['zone_id']:'',
			'fax'=>isset($this->request->post['fax'])?$this->request->post['fax']:'',
			'newsletter'=>isset($this->request->post['newsletter'])?$this->request->post['newsletter']:'',
			'ip'=>isset($this->request->post['ip'])?$this->request->post['ip']:'',
			'status'=>isset($this->request->post['status'])?$this->request->post['status']:''
			);
			
			$customer_id = $this->model_account_customer->addCustomer($data);
			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
			
			$this->customer->login($this->request->post['email'], $this->request->post['password']);

			unset($this->session->data['guest']);

			// Add to activity log
			$this->load->model('account/activity');
			if(!empty($register_fstnamerequire) && !empty($register_fstnastatus)) {
			$activity_data = array(
				'customer_id' => $customer_id,
				'name'        => $this->request->post['firstname'] 
			);
			}
			
			if(!empty($register_fstnamerequire) && !empty($register_fstnastatus)) {
				$json['redirect']=  $this->request->post['redirect'];
				$this->model_account_activity->addActivity('register', $activity_data);
				$json['success']=$this->url->link('account/success');
			}else{
			$json['redirect']=  $this->request->post['redirect'];
				$json['success']=$this->url->link('account/success');
			}
				
			}
		
		
		$this->response->setOutput(json_encode($json));
		
	}
	
	public function forgetpwd() {			
		$json=array();
				$this->load->language('account/forgotten');
				$this->load->model('account/customer');
				$this->load->model('catalog/login');
				
				if (!isset($this->request->post['email'])) {
				$json['error']['forgetemail'] = $this->language->get('error_email');
				}
				elseif (!$this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
				$json['error']['forgetemail'] = $this->language->get('error_email');
				}				
				else
				{
				$this->load->language('mail/forgotten');
				$password = substr(sha1(uniqid(mt_rand(), true)), 0, 10);

				$this->model_account_customer->editPassword($this->request->post['email'], $password);
				
				$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

				$message  = sprintf($this->language->get('text_greeting'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";
				$message .= $this->language->get('text_password') . "\n\n";
				$message .= $password;

				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
				$mail->smtp_username = $this->config->get('config_mail_smtp_username');
				$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail->smtp_port = $this->config->get('config_mail_smtp_port');
				$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

				$mail->setTo($this->request->post['email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
				$mail->setSubject($subject);
				$mail->setText($message);
				$mail->send();

				$json['success'] = $this->language->get('text_success');
				
				$json['redirect']=  $this->request->post['redirect'];
				}
				$this->response->setOutput(json_encode($json));
				
		}
	
}	
			
