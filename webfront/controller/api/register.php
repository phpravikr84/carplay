<?php
class ControllerApiRegister extends Controller {
	private $error = array();

	public function index() {
		$json = array();
		$this->load->language('account/register');  
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {  $json['data'] = ($this->request->post);
			
			$this->load->model('account/customer');
			
			if (!isset($_POST['name']) || (utf8_strlen(trim($_POST['name'])) < 1) || (utf8_strlen(trim($_POST['name'])) > 32)) {
				$json['name'] = $this->language->get('error_name');
			}
			
			if ( !isset($this->request->post['mobile']) ||(utf8_strlen($this->request->post['mobile']) < 3) || (utf8_strlen($this->request->post['mobile']) > 32)) {
				$json['mobile'] = $this->language->get('error_mobile');
			}else if ($this->model_account_customer->getTotalCustomersByMobile($this->request->post['mobile'])) {
				$json['mobile'] = $this->language->get('error_mobile_exists');
			} 
	
			if ( !isset($this->request->post['email']) ||(utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
				$json['email'] = $this->language->get('error_email');
			}else if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
				$json['email'] = $this->language->get('error_exists');
			} 
			
			if ( !isset($this->request->post['password']) ||(utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$json['password'] = $this->language->get('error_password');
			}
	
			if (!isset($this->request->post['confirm']) || $this->request->post['confirm'] != $this->request->post['password']) {
				$json['confirm'] = $this->language->get('error_confirm');
			}
			
			/*if (!isset($this->request->post['country_id']) || $this->request->post['country_id'] == '') {
				$json['country'] = $this->language->get('error_country');
			}
	
			if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
				$json['zone'] = $this->language->get('error_zone');
			}
			
			if (!isset($this->request->post['city']) || $this->request->post['city'] == '') {
				$json['city'] = $this->language->get('error_city');
			}*/
			
			if ($json){$json['status'] = '0';}
			
			if (!$json) { 
			
				$customer_id = $this->model_account_customer->addNewCustomer($this->request->post);
				 
				// Clear any previous login attempts for unregistered accounts.
				$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
	
				$this->customer->login($this->request->post['email'], $this->request->post['password']); 
	
				// Add to activity log
				$this->load->model('account/activity');
				
				if(isset($this->request->post['device_imei'])){
					$device_imei = $this->request->post['device_imei'];
				}else{
					$device_imei = '';
				}
				
				if(isset($this->request->post['device_token'])){
					$device_token = $this->request->post['device_token'];
				}else{
					$device_token = '';
				}
				
				if(isset($this->request->post['device_lat'])){
					$device_lat = $this->request->post['device_lat'];
				}else{
					$device_lat = '';
				}
				
				if(isset($this->request->post['device_lng'])){
					$device_lng = $this->request->post['device_lng'];
				}else{
					$device_lng = '';
				}
				
				if(isset($this->request->post['device_network'])){
					$device_network = $this->request->post['device_network'];
				}else{
					$device_network = '';
				}
				
				if(isset($this->request->post['device_model'])){
					$device_model = $this->request->post['device_model'];
				}else{
					$device_model = '';
				}
				
				if(isset($this->request->post['device_os'])){
					$device_os = $this->request->post['device_os'];
				}else{
					$device_os = '';
				}
				
				if(isset($this->request->post['add_versoin'])){
					$add_versoin = $this->request->post['add_versoin'];
				}else{
					$add_versoin = '';
				}
				
				if(isset($this->request->post['source_type'])){
					$source_type = $this->request->post['source_type'];
				}else{
					$source_type = '';
				}
				
				if(isset($this->request->post['national_code'])){
					$national_code = $this->request->post['national_code'];
				}else{
					$national_code = '';
				}
				
				if(isset($this->request->post['sim_name'])){
					$sim_name = $this->request->post['sim_name'];
				}else{
					$sim_name = '';
				}
	
				$activity_data = array(
					'customer_id' 		=> $customer_id,
					'name'        		=> $this->request->post['name'] ,
					'device_imei' 		=> $device_imei,
					'device_token'		=> $device_token,
					'device_lat'		=> $device_lat,
					'device_lng'		=> $device_lng,
					'device_network'	=> $device_network,
					'device_model'		=> $device_model,
					'device_os'			=> $device_os,
					'add_versoin'		=> $add_versoin,
					'source_type'		=> $source_type,
					'national_code'		=> $national_code,
					'sim_name'			=> $sim_name
				);
	
				$this->model_account_activity->addActivity('register', $activity_data); 
				$json['status'] = '1';
				$json['message'] = $this->language->get('success_registration');
			}
		} else{
			$json['status'] = '0';
			$json['message'] = $this->language->get('error_method');
		}
		
		//print '<pre>'; print_r($json);
		$this->response->addHeader('Content-Type: application/json'); 
		$this->response->setOutput(json_encode($json));
	} 
}