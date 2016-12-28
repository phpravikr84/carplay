<?php
class ControllerWebserviceRegister extends Controller {
	private $error = array();

	public function index() {
		 $json = array();
		$this->load->language('account/register');  
		
		$this->load->model('account/api');
		//$json['key']= $this->request->post['key'];
		// Register with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		//$rest_json = file_get_contents("php://input");
		//$rest_var = json_decode($rest_json, true);
		
		//print_r($rest_var);  
		
		
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {  //$json['data'] = ($_GET);
			
			if($api_info){ //print_r();exit;
				
							$this->load->model('account/customer');
							
							if($this->request->post['type']=='social'){ //print 'santanu';
	
								if (!isset($this->request->post['name']) || (strlen(utf8_decode(($this->request->post['name']))) < 1) || (strlen(utf8_decode(($this->request->post['name']))) > 32)) {
									$json['name'] = $this->language->get('error_name');
								}
	
								if ( !isset($this->request->post['email']) ||(strlen(utf8_decode($this->request->post['email'])) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
									$json['email'] = $this->language->get('error_email');
								}else if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
									$json['email'] = $this->language->get('error_exists');
								}
								
								//$json['json'] = $json;
	
								if ($json){$json['status'] = '0';}
	
								if (!$json) { 
	
									$customer_id = $this->model_account_customer->addNewCustomerSocial($this->request->post);
	
									// Clear any previous login attempts for unregistered accounts.
									$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
	
									$this->customer->login($this->request->post['email'], '',true); 
	
									// Add to activity log
									$this->load->model('account/activity');
	
									$activity_data = array(
										'customer_id' 		=> $customer_id,
										'name'        		=> $this->request->post['name'] 
	
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
								if (!isset($this->request->post['name']) || (strlen(utf8_decode(($this->request->post['name']))) < 1) || (strlen(utf8_decode(($this->request->post['name']))) > 32)) {
										$json['name'] = $this->language->get('error_name');
								}
	
								if ( !isset($this->request->post['mobile']) ||(strlen(utf8_decode($this->request->post['mobile'])) < 10) || (strlen(utf8_decode($this->request->post['mobile'])) > 20)) {
										$json['mobile'] = $this->language->get('error_mobile');
								}else if ($this->model_account_customer->getTotalCustomersByMobile($this->request->post['mobile'])) {
										$json['mobile'] = $this->language->get('error_mobile_exists');
								} 
	
								if ( !isset($this->request->post['email']) ||(strlen(utf8_decode($this->request->post['email'])) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
										$json['email'] = $this->language->get('error_email');
								}else if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
										$json['email'] = $this->language->get('error_exists');
								} 
	
								if ( !isset($this->request->post['password']) ||(strlen(utf8_decode($this->request->post['password'])) < 4) || (strlen(utf8_decode($this->request->post['password'])) > 20)) {
										$json['password'] = $this->language->get('error_password');
								}
	
								//if (!isset($this->request->post['confirm']) || $this->request->post['confirm'] != $this->request->post['password']) {
								//        $json['confirm'] = $this->language->get('error_confirm');
								//}
								//$json['json'] = $json;
	
								if ($json){$json['status'] = '0';}
	
								if (!$json) { 
	
									$customer_id = $this->model_account_customer->addNewCustomer($this->request->post);
	
									// Clear any previous login attempts for unregistered accounts.
									$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
	
									$this->customer->login($this->request->post['email'], $this->request->post['password']); 
	
									// Add to activity log
									$this->load->model('account/activity');
	
	
	
									$activity_data = array(
										'customer_id' 		=> $customer_id,
										'name'        		=> $this->request->post['name'] 
	
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