<?php
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);
		
		if(isset($data['telephone'])){
			$data['mobile'] = $data['telephone'];
		}
		
		$sql = "INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', countrycode = '" . $this->db->escape($data['countrycode']) . "', mobile = '" . $this->db->escape($data['mobile']) . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()";
	
		//print $sql;exit;
	
		$this->db->query($sql);

		$customer_id = $this->db->getLastId();
 
		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', true) . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		return $customer_id;
	}
	
	public function addNewCustomer($data) {
		 $customer_group_id = $this->config->get('config_customer_group_id');

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "',   
		firstname = '" . $this->db->escape($data['name']) . "',  
		email = '" . $this->db->escape($data['email']) . "', 
		mobile = '" . $this->db->escape($data['mobile']) . "',  
		country_id = '" . (int)($data['country_id']) . "',  
		salt = '" . $this->db->escape($salt = token(9)) . "', 
		password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', 
		newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', 
		ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', 
		status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', 
		date_added = NOW()");

		$customer_id = $this->db->getLastId(); 
 
		
		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', true) . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();
		
		//mail($data['email'],html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'),$message);

		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['name'] . "\n"; 
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['mobile'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();
			
			

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}
		
		return $customer_id;
	}
        
        public function addNewCustomerSocial($data) {
		 $customer_group_id = $this->config->get('config_customer_group_id');

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "',   
		firstname = '" . $this->db->escape($data['name']) . "',  
		email = '" . $this->db->escape($data['email']) . "',  
		newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', 
		ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', 
		status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', 
		date_added = NOW()");

		$customer_id = $this->db->getLastId(); 
 
		
		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', true) . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();
		
		//mail($data['email'],html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'),$message);

		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['name'] . "\n"; 
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			 

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();
			
			

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}
		
		return $customer_id;
	}

        
	public function editCustomer($data) {
		$customer_id = $this->customer->getId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET "
                        . "firstname = '" . $this->db->escape($data['firstname']) . "', "
                        . "lastname = '" . $this->db->escape($data['lastname']) . "', "
                        . "email = '" . $this->db->escape($data['email']) . "', "
                        . "gender = '" . $this->db->escape($data['gender']) . "', "
                        . "displang = '" . $this->db->escape($data['displang']) . "', "
                        . "nationality = '" . $this->db->escape($data['nationality']) . "', "
                        
                        . "newsletter = '0',"
                        . "mobile = '" . $this->db->escape($data['mobile']) . "',"
                        . "countrycode = '" . $this->db->escape($data['countrycode']) . "'"
                        . " WHERE customer_id = '" . (int)$customer_id . "'");
           
            if(isset($data['newsletter'])){
                 $this->db->query("UPDATE " . DB_PREFIX . "customer SET "
                        . "newsletter = '" . $this->db->escape($data['newsletter']) . "'"
                        . " WHERE customer_id = '" . (int)$customer_id . "'");
            }
                
	}
	
	public function editCustomerApi($data, $customer_id) {
		
		if(!isset($data['name'])){$data['name']='';}
		if(!isset($data['email'])){$data['email']='';}
		if(!isset($data['gender'])){$data['gender']='';}
		if(!isset($data['mobile'])){$data['mobile']='';}
		if(!isset($data['nationality'])){$data['nationality']='';}
		if(!isset($data['country_id'])){$data['country_id']='';}
		if(!isset($data['newsletter'])){$data['newsletter']=0;}

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET "
                        . "firstname = '" . $this->db->escape($data['name']) . "', "
                        
						. "gender = '" . $this->db->escape($data['gender']) . "', " 
                        
						. "nationality = '" . $this->db->escape($data['nationality']) . "', "
                        
                        . "newsletter = '0',"
                        
						. "mobile = '" . $this->db->escape($data['mobile']) . "',"
                        
						. "country_id = '" . $this->db->escape($data['country_id']) . "'"
                        
						. " WHERE customer_id = '" . (int)$customer_id . "'");
           
            if(isset($data['newsletter'])){
                 $this->db->query("UPDATE " . DB_PREFIX . "customer SET "
				. "newsletter = '" . $this->db->escape($data['newsletter']) . "'"
				. " WHERE customer_id = '" . (int)$customer_id . "'");
            }
                
	}

	public function editPassword($email, $password) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function editNewsletter($newsletter) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	}
	
	public function editMobile($mobile) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET mobile = '" . $this->db->escape($mobile) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomerByCode($code) {
		$query = $this->db->query("SELECT customer_id, firstname, lastname FROM `" . DB_PREFIX . "customer` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");

		return $query->row;
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
	
	public function getTotalCustomersByMobile($mobile) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE mobile = '" . $this->db->escape($mobile) . "'");

		return $query->row['total'];
	}

	public function getRewardTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_login WHERE email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_login SET email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "customer_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE customer_login_id = '" . (int)$query->row['customer_login_id'] . "'");
		}
	}

	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function existMailSubscription($data){

		$this->load->language('mail/customer');
		$this->load->model('account/customer_group');
		$sql = "SELECT * FROM " . DB_PREFIX . "customer WHERE email='".$data."'";

		//echo $sql;
		$query = $this->db->query($sql);
		$results = $query->rows;
			foreach($results as $result){
					if($result['newsletter']==0){
						$this->mailSubscribe($data);
								


								$subject = sprintf($this->language->get('text_subject_subscription'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

								$message = sprintf($this->language->get('text_welcome_subscription'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		

								
								$mail = new Mail();
								$mail->protocol = $this->config->get('config_mail_protocol');
								$mail->parameter = $this->config->get('config_mail_parameter');
								$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
								$mail->smtp_username = $this->config->get('config_mail_smtp_username');
								$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
								$mail->smtp_port = $this->config->get('config_mail_smtp_port');
								$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

								$mail->setTo($data);
								$mail->setFrom($this->config->get('config_email'));
								$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
								$mail->setSubject($subject);
								$mail->setText($message);
								$mail->send();
						return 1;
					}

					if($result['newsletter'] > 0){
						return 2;
					}
				
			}

	}

	public function mailSubscribe($data){
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter='1' WHERE email='".$data."'");
	}

	public function mailSubscribeNew($data){
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer (newsletter, status, approved, safe, date_added) VALUES('1', '1', '1', '1', '".date('Y-m-d h:i:s')."') ");
		$subject = sprintf($this->language->get('text_subject_subscription'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

								$message = sprintf($this->language->get('text_welcome_subscription'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		

								
								$mail = new Mail();
								$mail->protocol = $this->config->get('config_mail_protocol');
								$mail->parameter = $this->config->get('config_mail_parameter');
								$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
								$mail->smtp_username = $this->config->get('config_mail_smtp_username');
								$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
								$mail->smtp_port = $this->config->get('config_mail_smtp_port');
								$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

								$mail->setTo($data);
								$mail->setFrom($this->config->get('config_email'));
								$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
								$mail->setSubject($subject);
								$mail->setText($message);
								$mail->send();
	}
}
