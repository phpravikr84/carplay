<?php
class ControllerAccountEdit extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', true);

			//$this->response->redirect($this->url->link('account/login', '', true));
			$this->response->redirect($this->url->link('common/home', '', true));
		}

		$this->load->language('account/edit');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['customer_name'] = ucfirst($this->customer->getFirstName());
		$data['customer_email'] = $this->customer->getEmail();
		
		$url='';
		$data['order_history'] = $this->url->link('account/order', $url, true);
		$data['profile'] = $this->url->link('account/account', $url, true);
		$data['password'] = $this->url->link('account/password', $url, true);
		$data['signout'] = $this->url->link('account/logout', $url, true);
		 
		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_account_customer->editCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$this->model_account_activity->addActivity('edit', $activity_data);

			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_edit'),
			'href'      => $this->url->link('account/edit', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_additional'] = $this->language->get('text_additional');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['custom_field'])) {
			$data['error_custom_field'] = $this->error['custom_field'];
		} else {
			$data['error_custom_field'] = array();
		}

		$data['action'] = $this->url->link('account/edit', '', true);

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($customer_info)) {
			$data['firstname'] = $customer_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($customer_info)) {
			$data['lastname'] = $customer_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$data['email'] = $customer_info['email'];
		} else {
			$data['email'] = '';
		}
                
                if (isset($this->request->post['gender'])) {
			$data['gender'] = $this->request->post['gender'];
		} elseif (!empty($customer_info)) {
			$data['gender'] = $customer_info['gender'];
		} else {
			$data['gender'] = '';
		}
                
               // print_r($customer_info);exit;
                
                if (isset($this->request->post['mobile'])) {
			$data['mobile'] = $this->request->post['mobile'];
		} elseif (!empty($customer_info)) {
			$data['mobile'] = $customer_info['mobile'];
		} else {
			$data['mobile'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$data['telephone'] = $customer_info['telephone'];
		} else {
			$data['telephone'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} elseif (!empty($customer_info)) {
			$data['newsletter'] = $customer_info['newsletter'];
		} else {
			$data['newsletter'] = '';
		}
                
               if (isset($this->request->post['countrycode'])) {
			$data['countrycode'] = $this->request->post['countrycode'];
		} elseif (!empty($customer_info)) {
			$data['countrycode'] = $customer_info['countrycode'];
		} else {
			$data['countrycode'] = '';
		}
                
                if (isset($this->request->post['nationality'])) {
			$data['nationality'] = $this->request->post['nationality'];
		} elseif (!empty($customer_info)) {
			$data['nationality'] = $customer_info['nationality'];
		} else {
			$data['nationality'] = '';
		}
                
                if (isset($this->request->post['displang'])) {
			$data['displang'] = $this->request->post['displang'];
		} elseif (!empty($customer_info)) {
			$data['displang'] = $customer_info['displang'];
		} else {
			$data['displang'] = '';
		}
		 
                
		$data['mobile'] = $customer_info['mobile'];
                $data['gender'] = $customer_info['gender'];
                $data['newsletter'] = $customer_info['newsletter'];
                $data['date_added'] = date_format(date_create($customer_info['date_added']), "d M Y");
                
                $data['edit'] = $this->url->link('account/edit', '', true);
		$data['password'] = $this->url->link('account/password', '', true);
		$data['address'] = $this->url->link('account/address', '', true);
                $data['logout'] = $this->url->link('account/logout', '', true);

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		if (isset($this->request->post['custom_field'])) {
			$data['account_custom_field'] = $this->request->post['custom_field'];
		} elseif (isset($customer_info)) {
			$data['account_custom_field'] = json_decode($customer_info['custom_field'], true);
		} else {
			$data['account_custom_field'] = array();
		}

		$data['back'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/edit', $data));
	}

	public function validate() {
                
                $this->load->model('account/customer');
                
                $this->load->language('account/edit');
                
                $json = array();
                
                //print_r($this->request->post);exit;
            
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$json['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$json['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$json['email'] = $this->language->get('error_email');
		}

		if (($this->customer->getEmail() != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$json['warning'] = $this->language->get('error_exists');
		}

		// if ((utf8_strlen($this->request->post['mobile']) >= 10) || (utf8_strlen($this->request->post['mobile']) < 20)) {
		// 	//$json['mobile'] = $this->language->get('error_telephone');
		// }

		if ((utf8_strlen($this->request->post['mobile'])>9)) {
			$json['mobile'] = $this->language->get('error_telephone');
		}
                
                if(!$json){
                    $this->model_account_customer->editCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$this->model_account_activity->addActivity('edit', $activity_data);
                    $json['success']='Success';
                    $this->model_account_customer->editCustomer($this->request->post);
                    $json['redirect_url']=$this->url->link('account/account', '', true);
                }

		$this->response->addHeader('Content-Type: application/json');
                $this->response->setOutput(json_encode($json)); 
	}
}