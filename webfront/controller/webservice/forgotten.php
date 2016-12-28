<?php
class ControllerWebserviceForgotten extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('account/forgotten'); 

		$this->load->model('account/customer');
		
		$json = array();
		$this->load->model('account/api');
		//$json['key']= $this->request->post['key'];
		// Forget with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		 
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')  ) {
			if($api_info){
				$this->load->language('mail/forgotten');
				
				if (!isset($this->request->post['email'])) {
					$json['message'] = $this->language->get('error_invalid_email');
				}elseif ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
					$json['message'] = $this->language->get('error_invalid_email');
				} elseif (!$this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
					$json['message'] = $this->language->get('error_email');
				}
				 
		
				$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);
		
				if ($customer_info && !$customer_info['approved']) {
					$json['message'] = $this->language->get('error_approved');
				} 
				
				if ($json){$json['status'] = '0';}
				
				if (!$json) {  
				
					$code = token(40);
		
					$this->model_account_customer->editCode($this->request->post['email'], $code);
		
					$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		
					$message  = sprintf($this->language->get('text_greeting'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";
					$message .= $this->language->get('text_change') . "\n\n";
					$message .= $this->url->link('account/reset', 'code=' . $code, true) . "\n\n";
					$message .= sprintf($this->language->get('text_ip'), $this->request->server['REMOTE_ADDR']) . "\n\n";
		
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
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
					$mail->send();
		
					$this->session->data['success'] = $this->language->get('text_success');
		
					// Add to activity log
					$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);
		
					if ($customer_info) {
						$this->load->model('account/activity');
		
						$activity_data = array(
							'customer_id' => $customer_info['customer_id'],
							'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname']
						);
		
						$this->model_account_activity->addActivity('forgotten', $activity_data);
					}
					$session_name = 'temp_forget_session_' . uniqid();
		
					$session = new Session();
					$session->start($this->session->getId(), $session_name);
	
					// Set API ID
					$session->data['api_id'] = $api_info['api_id'];
	
					// Create Token
					//$json['token'] = $this->model_account_api->addApiSession($api_info['api_id'], $session_name, $session->getId(), $this->request->server['REMOTE_ADDR']);	
					
					$json['status'] = '1';
					
					$json['message'] = 'Password Reset Sccessfully!!!';
	
				}
				
			}else{
				$json['status'] = '0';
				 $json['message'] = 'Invalid API Key';
			}
		}else{
			$json['status'] = '0';
			$json['message'] = 'Invalid Method, use only post method....';
		}
		
		//print '<pre>'; print_r($json);
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json)); 
	} 
}
