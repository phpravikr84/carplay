<?php
class ControllerWebserviceUpdateprofile extends Controller {
	public function index() {
		
		$this->load->language('account/register'); 
		
		$this->load->model('account/customer');

		$this->load->model('tool/image');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		$customer_id = $this->request->get['customer_id'];
		
		$rest_json = file_get_contents("php://input");
		$rest_var = json_decode($rest_json, true);
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->get['key']);
		
		if($api_info){ 
		
		
			if (isset($customer_id)) {
				
				$customer_info = $this->model_account_customer->getCustomer($customer_id);
				
				$email = $customer_info['email'];
				$mobile = $customer_info['mobile'];
				 
				if ((utf8_strlen(trim($rest_var['name'])) < 1) || (utf8_strlen(trim($rest_var['name'])) > 32)) {
					$json['name'] = $this->language->get('error_firstname');
				}
				
				if ((utf8_strlen($rest_var['mobile']) == 0) || (utf8_strlen($rest_var['mobile']) > 20)) {
					$json['mobile'] = 'Invalid Mobile No';
				} 
				
					
			if(!$json){
				$this->model_account_customer->editCustomerApi($rest_var, $customer_id);
			
				// Add to activity log
				$this->load->model('account/activity');
				
				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
				);
				
				$this->model_account_activity->addActivity('edit profile', $activity_data);
				$json['status'] = "1";
				$json['message']='Profile Update Successfully';
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