<?php
class ControllerAccountFblogin extends Controller
{
	private $error = array(); 
	
	public function index() { 
            
		
		$this->load->language('account/fblogin');  
		
		 
		
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		
		 
 	
		$data['text_signin'] = $this->language->get('text_signin');
		$data['text_signintext'] = $this->language->get('text_signintext');
		$data['text_signingup'] = $this->language->get('text_signingup');
		$data['text_signupnow'] = $this->language->get('text_signupnow');
		$data['text_signinnow'] = $this->language->get('text_signinnow');
		$data['text_signupme'] = $this->language->get('text_signupme');
		$data['text_fill'] = $this->language->get('text_fill');
		$data['text_cancel'] = $this->language->get('text_cancel');
		$data['text_about'] = $this->language->get('text_about');
		$data['text_about_des'] = $this->language->get('text_about_des');
		$data['text_more'] = $this->language->get('text_more');
		$data['action'] = $this->url->link('common/home/register', '', 'SSL');
		$data['text_your_email'] = $this->language->get('text_your_email');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_submit'] = $this->language->get('text_submit');			
		$data['text_forgotten'] = $this->language->get('text_forgotten');			
		$data['success'] = $this->language->get('text_success'); 

		
	 
		$data['fblogin'] =$this->url->link('account/fblogin', '');
		
		if (isset($this->request->get['route'])) {
                    $this->document->addLink(HTTP_SERVER, 'canonical');
		}
		
		if(isset($_COOKIE['cookieuse_email'])) {
			$data['cookieuse_email']=$_COOKIE['cookieuse_email'];
		}else{
			$data['cookieuse_email']="";
		}
		
		//Facebook login 
		require_once(DIR_SYSTEM . 'vendor/facebook-sdk/facebook.php');
		$facebook = new Facebook(array(
			'appId' => $this->config->get('config_fb_app_id'),
			'secret' => $this->config->get('config_fb_sec'),
			));

		$user = $facebook->getUser();
                //print DIR_SYSTEM.'vendor/facebook-sdk/facebook.php';
		$user_profile ='';
                
		if ($user) { print "santanu";print_r($user);exit;
			try {
			// Proceed knowing you have a logged in user who's authenticated.
                            $user_profile = $facebook->api('/me?fields=id,name,email,gender,birthday');
			} catch (FacebookApiException $e) {
                            error_log($e);
                            $user = null;
			}
			
			if (!empty($user_profile )) {
                            # User info ok? Let's print it (Here we will be adding the login and registering routines)
				
                            if(isset($user_profile['name'])){
                                    $data['username'] =  $user_profile['name'];
                            } 

                            if(isset($user_profile['gender'])){
                                    $data['gender'] =  $user_profile['gender'];
                            }

                            if(isset($user_profile['email'])){
                                    $data['fbemail'] =  $user_profile['email'];
                            } 
				 
			}
			//Print_r($user_profile);  
		}
		
		else {
			# There's no active session, let's generate one
			$login_url = $facebook->getLoginUrl(array( 'scope' => 'email,'));
			//header("Location: " . $login_url);
		} 
		
		 
		
		
	} 
	
	public function validateForm(){
		
		$this->load->language('account/fblogin');
		$this->load->model('account/customer');
		
		$data = array();
		
		if ((utf8_strlen(trim($this->request->post['dispname'])) < 5) || (utf8_strlen(trim($this->request->post['dispname'])) > 10)) {
			$data['dispname'] = $this->language->get('error_dispname');
		}else if (!ctype_alnum($this->request->post['dispname'])) { //Not Special character
			$data['dispname'] = $this->language->get('error_dispname_alfa_numeric');
		}else if ($this->countDigits($this->request->post['dispname']) > 4) { //Check Numeric
			$data['dispname'] = $this->language->get('error_dispname_invlaid_numeric');
		} else if ($this->model_account_customer->getTotalCustomersByDisplayName($this->request->post['dispname'])) {
			$data['dispname'] = $this->language->get('error_dispname_exist');
		}  

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$data['email'] = $this->language->get('error_email');
		}else if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$data['email'] = $this->language->get('error_email_exists');
		} 
		
		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 10)) {
			$data['password'] = $this->language->get('error_password');
		}
		
		if ((utf8_strlen($this->request->post['dob']) < 9) || (utf8_strlen($this->request->post['dob']) > 11)) {
			$data['dob'] = $this->language->get('error_dob');
		}elseif(time() < strtotime('+18 years', strtotime($this->request->post['dob']))) {
			$data['dob'] = $this->language->get('error_invlaid_dob');
		}
		
		//$this->customer->login($this->request->post['email'], $this->request->post['password']);
		//print_r($data);exit; print count($data);exit;
		
		if(count($data)=== 0){
			
			$customer_id = $this->model_account_customer->addCustomer($this->request->post);
			$data['success'] ='success';
			$data['redirect'] =$this->url->link('account/account','');
			$this->customer->login($this->request->post['email'], $this->request->post['password']);
		}

		//print_r($data);exit;
		 
		$this->response->setOutput(json_encode($data));
	} 
	
	public function countDigits($str) {
		$noDigits=0;
		for ($i=0;$i<strlen($str);$i++) {
			if (is_numeric($str{$i})) $noDigits++;
		}
		return $noDigits;
	}
}