<?php
class ControllerWebserviceLogin extends Controller {
	private $error = array();
     
	public function index() {  
		$this->load->model('account/customer');
		$this->load->language('account/login');
		$json = array();
		
		$this->load->model('account/api');
		
		$rest_json = file_get_contents("php://input");
		$rest_vars = json_decode($rest_json, true);
		 
		// Login with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) { 
			if($api_info){
				// Check how many login attempts have been made.
				$login_info = $this->model_account_customer->getLoginAttempts($rest_vars['email']);
	
				if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
					$this->load->model('account/activity');
			
					$activity_data = array(
						'customer_id' 		=> $this->customer->getId(),
						'name'        		=> $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
						'login_attempt'		=> $login_info['total']

					);
			
					$this->model_account_activity->addActivity('login attemp', $activity_data);
					$json['status'] = '0';
					$json['message'] = $this->language->get('error_attempts');
				}
	
				// Check if customer has been approved.
				$customer_info = $this->model_account_customer->getCustomerByEmail($rest_vars['email']);
	
				if ($customer_info && !$customer_info['approved']) {
						$json['status'] = '0';
						$json['message'] = $this->language->get('error_approved');
				}
	
				if (!$json) { 
                                    
                                    if($rest_vars['type']=='social'){
                                    
                                        if (!$this->customer->login($rest_vars['email'], '',true)) {   
                                            $json['status'] = '0';
                                            $json['message'] = $this->language->get('error_login');
                                            $this->model_account_customer->addLoginAttempt($rest_vars['email']);
                                        } else {
                                            $this->model_account_customer->deleteLoginAttempts($rest_vars['email']); 
                                            $this->load->model('account/activity');

                                            $activity_data = array(
                                                'customer_id' => $this->customer->getId(),
                                                'name' => $this->customer->getFirstName()	 
                                            );

                                            $this->model_account_activity->addActivity('login', $activity_data); 
                                            $session_name = 'temp_login_session_' . uniqid();
                                            $session = new Session();
                                            $session->start($this->session->getId(), $session_name);

                                            // Set API ID
                                            $session->data['api_id'] = $api_info['api_id']; 

                                            // Create Token
                                            $json['token'] = $this->model_account_api->addApiSession($api_info['api_id'], $session_name, $session->getId(), $this->request->server['REMOTE_ADDR']);
                                            $json['customer_id'] =  $this->customer->getId(); 
											$json['name'] =  $this->customer->getFirstName(); 
                                            $json['status'] = '1'; 
											$json['message'] = $this->language->get('success_login');

                                        }
                                    }else{
                                        if (!$this->customer->login($rest_vars['email'], $rest_vars['password'])) {   
                                            $json['status'] = '0';
                                            $json['message'] = $this->language->get('error_login');
                                            $this->model_account_customer->addLoginAttempt($rest_vars['email']);
                                        } else {
                                            $this->model_account_customer->deleteLoginAttempts($rest_vars['email']); 
                                            $this->load->model('account/activity');

                                            $activity_data = array(
                                                'customer_id' => $this->customer->getId(),
                                                'name' => $this->customer->getFirstName()	 
                                            );

                                            $this->model_account_activity->addActivity('login', $activity_data); 
                                            $session_name = 'temp_login_session_' . uniqid();
                                            $session = new Session();
                                            $session->start($this->session->getId(), $session_name);

                                            // Set API ID
                                            $session->data['api_id'] = $api_info['api_id']; 

                                            // Create Token
                                            $json['token'] = $this->model_account_api->addApiSession($api_info['api_id'], $session_name, $session->getId(), $this->request->server['REMOTE_ADDR']);
                                            $json['customer_id'] =  $this->customer->getId(); 
											$json['name'] =  $this->customer->getFirstName(); 
                                            $json['status'] = '1'; 
											$json['message'] = $this->language->get('success_login');

                                        }
                                    }
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
		$this->response->addHeader('key: Y0ZfLUllmxEYZujBr5OW7ApP6I55aJyweClgTX8xrITnzhkwLSHM3GKSum34ANUeDfbN5u57TnNoarmDOmoy8P9EmaSRN7fOSeoOda8FW85sJHzbuSJ0TBD85INTNTCAjE6OxfV1AsjTQy9JYBlBM5v76QFOa59MsRpExAhtquhtpGCVwP9LrVL2wrgGnm9sxEKxSJNlFjB6MC2IRlrDwrWXO50f5IlcbzGqq0IjJMXMQA9Am90GZsqvff9v70FB');
		
		$this->response->setOutput(json_encode($json));
		
		
	}
}