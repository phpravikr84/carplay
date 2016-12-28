<?php
class ControllerWebserviceProfile extends Controller {
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
					
					$json['firstname'] = $customer_info['firstname'];
					$json['lastname'] = $customer_info['lastname'];
					$json['email'] = $customer_info['email'];
					$json['mobile'] = $customer_info['mobile'];
					$json['gender'] = $customer_info['gender'];
					$json['nationality'] = $customer_info['nationality'];
					$json['displang'] = $customer_info['displang'];
					$json['newsletters'] = $customer_info['newsletter'];
					
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