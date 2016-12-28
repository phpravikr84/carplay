<?php
class ControllerWebserviceUpdateprofile extends Controller {
	public function index() {
		
		$this->load->language('account/account'); 
		
		$this->load->model('account/customer');

		$this->load->model('tool/image');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		$customer_id = $this->request->post['customer_id'];
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->post['key']);
		
		if($api_info){ 
		
		
			if (isset($customer_id)) {
				
				$customer_info = $this->model_account_customer->getCustomer($customer_id);
				
				$email = $customer_info['email'];
				$mobile = $customer_info['mobile'];
				 
				if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
					$json['firstname'] = $this->language->get('error_firstname');
				}
				
				if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
					$json['lastname'] = $this->language->get('error_lastname');
				}
				
				if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
					$json['email'] = $this->language->get('error_email');
				}else if (($email != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$json['email'] = $this->language->get('error_exists');
		}
				
				if ((utf8_strlen($this->request->post['mobile']) == 0) || (utf8_strlen($this->request->post['mobile']) > 20)) {
					$json['mobile'] = 'Invalid Mobile No';
				}else if (($mobile != $this->request->post['mobile']) && $this->model_account_customer->getTotalCustomersByMobile($this->request->post['mobile'])) {
					$json['mobile'] = $this->language->get('error_exists');
		}
					
				if(!$json){
					$this->model_account_customer->editCustomerMobile($this->request->post, $customer_id);
				
					
				
					// Add to activity log
					$this->load->model('account/activity');
					
					$activity_data = array(
						'customer_id' => $this->customer->getId(),
						'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
					);
					
					$this->model_account_activity->addActivity('edit profile', $activity_data);
					$json['success'] = 1;
   				    $json['message']='Profile Update Success';
							//$json['redirect_url']=$this->url->link('account/account', '', true);
					}
				 	
		}else{
			$json['status'] = '0';
			$json['message'] = $this->language->get['error_invalidapikey'];
		}
	
		//print '<pre>'; print_r($json);
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Api-Key: Y0ZfLUllmxEYZujBr5OW7ApP6I55aJyweClgTX8xrITnzhkwLSHM3GKSum34ANUeDfbN5u57TnNoarmDOmoy8P9EmaSRN7fOSeoOda8FW85sJHzbuSJ0TBD85INTNTCAjE6OxfV1AsjTQy9JYBlBM5v76QFOa59MsRpExAhtquhtpGCVwP9LrVL2wrgGnm9sxEKxSJNlFjB6MC2IRlrDwrWXO50f5IlcbzGqq0IjJMXMQA9Am90GZsqvff9v70FB');
		$this->response->setOutput(json_encode($json));
		
		}
	}
}