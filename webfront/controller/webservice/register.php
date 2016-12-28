<?php
class ControllerWebserviceRegister extends Controller {
	private $error = array();

	public function index() {
		 $json = array();
		$this->load->language('account/register');  
		
		$this->load->model('account/api');
		//$json['key']= $rest_var['key'];
		// Register with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		$rest_json = file_get_contents("php://input");
		$rest_var = json_decode($rest_json, true);
		
		//print_r($rest_var);  
		
		
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {  //$json['data'] = ($_GET);
			
			if($api_info){ //print_r();exit;
				
							$this->load->model('account/customer');
							
							if($rest_var['type']=='social'){ //print 'santanu';
	
								if (!isset($rest_var['name']) || (strlen(utf8_decode(($rest_var['name']))) < 1) || (strlen(utf8_decode(($rest_var['name']))) > 32)) {
									$json['message'] = $this->language->get('error_name');
								}elseif ( !isset($rest_var['email']) ||(strlen(utf8_decode($rest_var['email'])) > 96) || !filter_var($rest_var['email'], FILTER_VALIDATE_EMAIL)) {
									$json['message'] = $this->language->get('error_email');
								}else if ($this->model_account_customer->getTotalCustomersByEmail($rest_var['email'])) {
									$json['message'] = $this->language->get('error_exists');
								}
								
								//$json['json'] = $json;
	
								if ($json){$json['status'] = '0';}
	
								if (!$json) { 
	
									$customer_id = $this->model_account_customer->addNewCustomerSocial($rest_var);
	
									// Clear any previous login attempts for unregistered accounts.
									$this->model_account_customer->deleteLoginAttempts($rest_var['email']);
	
									$this->customer->login($rest_var['email'], '',true); 
	
									// Add to activity log
									$this->load->model('account/activity');
	
									$activity_data = array(
										'customer_id' 		=> $customer_id,
										'name'        		=> $rest_var['name'] 
	
									);
	
									$this->model_account_activity->addActivity('register', $activity_data); 
									$session_name = 'temp_session_' . uniqid();
	
									$session = new Session();
									$session->start($this->session->getId(), $session_name);
	
									// Set API ID
									$session->data['api_id'] = $api_info['api_id'];
	
									// Create Token
									$json['token'] = $this->model_account_api->addApiSession($api_info['api_id'], $session_name, $session->getId(), $this->request->server['REMOTE_ADDR']);
									$json['status'] = '1';
									$json['message'] = $this->language->get('success_registration');
								}
							}else{
								if (!isset($rest_var['name']) || (strlen(utf8_decode(($rest_var['name']))) < 1) || (strlen(utf8_decode(($rest_var['name']))) > 32)) {
										$json['message'] = $this->language->get('error_name');
								}elseif ( !isset($rest_var['mobile']) ||(strlen(utf8_decode($rest_var['mobile'])) < 10) || (strlen(utf8_decode($rest_var['mobile'])) > 20)) {
										$json['message'] = $this->language->get('error_mobile');
								}elseif ($this->model_account_customer->getTotalCustomersByMobile($rest_var['mobile'])) {
										$json['message'] = $this->language->get('error_mobile_exists');
								} elseif ( !isset($rest_var['email']) ||(strlen(utf8_decode($rest_var['email'])) > 96) || !filter_var($rest_var['email'], FILTER_VALIDATE_EMAIL)) {
										$json['message'] = $this->language->get('error_email');
								}elseif ($this->model_account_customer->getTotalCustomersByEmail($rest_var['email'])) {
										$json['message'] = $this->language->get('error_exists');
								} elseif ( !isset($rest_var['password']) ||(strlen(utf8_decode($rest_var['password'])) < 4) || (strlen(utf8_decode($rest_var['password'])) > 20)) {
										$json['message'] = $this->language->get('error_password');
								}
	
								//if (!isset($rest_var['confirm']) || $rest_var['confirm'] != $rest_var['password']) {
								//        $json['confirm'] = $this->language->get('error_confirm');
								//}
								//$json['json'] = $json;
	
								if ($json){$json['status'] = '0';}
	
								if (!$json) { 
	
									$customer_id = $this->model_account_customer->addNewCustomer($rest_var);
	
									// Clear any previous login attempts for unregistered accounts.
									$this->model_account_customer->deleteLoginAttempts($rest_var['email']);
	
									$this->customer->login($rest_var['email'], $rest_var['password']); 
	
									// Add to activity log
									$this->load->model('account/activity');
	
	
	
									$activity_data = array(
										'customer_id' 		=> $customer_id,
										'name'        		=> $rest_var['name'] 
	
									);
	
									$this->model_account_activity->addActivity('register', $activity_data); 
									$session_name = 'temp_session_' . uniqid();
	
									$session = new Session();
									$session->start($this->session->getId(), $session_name);
	
									// Set API ID
									$session->data['api_id'] = $api_info['api_id'];
	
									// Create Token
									$json['token'] = $this->model_account_api->addApiSession($api_info['api_id'], $session_name, $session->getId(), $this->request->server['REMOTE_ADDR']);
									$json['status'] = '1';
									$json['message'] = 'Registration Successfully';
								}
							}
			}else{
                            $json['status'] = '0';
                            $json['message'] = 'Invalid API Key';
			}
		} else{
                    $json['status'] = '0';
                    $json['message'] = "Invalid Method, use only post method....";
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