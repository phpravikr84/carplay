<?php
class ControllerAccountPassword extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/password', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('account/password');
                
                $this->load->model('account/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('account/customer');

			$this->model_account_customer->editPassword($this->customer->getEmail(), $this->request->post['password']);

			$this->session->data['success'] = $this->language->get('text_success');

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$this->model_account_activity->addActivity('password', $activity_data);

			$this->response->redirect($this->url->link('account/account', '', true));
		}
		
		$data['customer_name'] = ucfirst($this->customer->getFirstName());
		$data['customer_email'] = $this->customer->getEmail(); 
		$url='';
		$data['order_history'] = $this->url->link('account/order', $url, true);
		$data['profile'] = $this->url->link('account/account', $url, true);
		$data['password'] = $this->url->link('account/password', $url, true);
		$data['signout'] = $this->url->link('account/logout', $url, true);
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('account/password', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_password'] = $this->language->get('text_password');

		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}

		$data['action'] = $this->url->link('account/password', '', true);

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
                
                $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		
                //print_r($customer_info);exit;
                
		$data['firstname'] = $customer_info['firstname'];
		$data['lastname'] = $customer_info['lastname'];
                $data['email'] = $customer_info['email'];
		$data['mobile'] = $customer_info['mobile'];
                $data['gender'] = $customer_info['gender'];
                
                $data['date_added'] = date_format(date_create($customer_info['date_added']), "d M Y");
                $data['nationality'] = $customer_info['nationality'];
                $data['displang'] = $customer_info['displang'];
                $data['newsletters'] = $customer_info['newsletter'];
                
		

		$data['edit'] = $this->url->link('account/edit', '', true);
		$data['password'] = $this->url->link('account/password', '', true);
		$data['address'] = $this->url->link('account/address', '', true);
                $data['logout'] = $this->url->link('account/logout', '', true);

		$data['back'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/password', $data));
	}

	public function validate() {
                
                $this->load->language('account/password');
                
                $this->load->model('account/customer');
                
                $json = array();
            
		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$json['error_password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$json['error_confirm'] = $this->language->get('error_confirm');
		}

                if (!$json) {
                    $this->model_account_customer->editPassword($this->customer->getEmail(), $this->request->post['password']);

                    $this->session->data['success'] = $this->language->get('text_success');

                    // Add to activity log
                    $this->load->model('account/activity');

                    $activity_data = array(
                            'customer_id' => $this->customer->getId(),
                            'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
                    );

                    $this->model_account_activity->addActivity('reset-password', $activity_data);
                    $json['success'] = $this->language->get('text_success');
                }
                
                $this->response->addHeader('Content-Type: application/json');
                $this->response->setOutput(json_encode($json)); 
	}
}