<?php
class ControllerAccountLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->model('account/customer');
		
                $this->document->addScript('webfront/view/javascript/js/angular.min.js');
		// Login override for admin users
		if (!empty($this->request->get['token'])) {
			$this->customer->logout();
			$this->cart->clear();

			unset($this->session->data['order_id']);
			unset($this->session->data['payment_address']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['shipping_address']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);

			$customer_info = $this->model_account_customer->getCustomerByToken($this->request->get['token']);

			if ($customer_info && $this->customer->login($customer_info['email'], '', true)) {
				// Default Addresses
				$this->load->model('account/address');

				if ($this->config->get('config_tax_customer') == 'payment') {
					$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				if ($this->config->get('config_tax_customer') == 'shipping') {
					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				$this->response->redirect($this->url->link('account/account', '', true));
			}
		}

		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$this->load->language('account/login');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			// Unset guest
			unset($this->session->data['guest']);
 

			// Wishlist
			if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
				$this->load->model('account/wishlist');

				foreach ($this->session->data['wishlist'] as $key => $product_id) {
					$this->model_account_wishlist->addWishlist($product_id);

					unset($this->session->data['wishlist'][$key]);
				}
			}

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$this->model_account_activity->addActivity('login', $activity_data);

			// Added strpos check to pass McAfee PCI compliance test
			//if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {
			//	$this->response->redirect(str_replace('&amp;', '&', $this->request->post['redirect']));
			//} else {
			//	$this->response->redirect($this->url->link('account/account', '', true));
			//}
                        
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_new_customer'] = $this->language->get('text_new_customer');
		$data['text_register'] = sprintf($this->language->get('text_register'), $this->url->link('account/register', '', true));        
                $data['text_dont_register'] = sprintf($this->language->get('text_dont_register'), $this->url->link('account/register', '', true));
                
		$data['text_register_account'] = $this->language->get('text_register_account');
		$data['text_returning_customer'] = $this->language->get('text_returning_customer');
		$data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
                $data['text_forgotten'] = sprintf($this->language->get('text_forgotten'), $this->url->link('account/forgotten', '', true));
                $data['text_login'] = $this->language->get('text_login');
                $data['text_login_fb'] = $this->language->get('text_login_fb');
                $data['text_login_gplus'] = $this->language->get('text_login_gplus');
                
                
                $data['text_login_head'] = $this->language->get('text_login_head');
                

		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_login'] = $this->language->get('button_login');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['action'] = $this->url->link('account/login', '', true);
                $data['fblogin'] = $this->url->link('account/fblogin', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['forgotten'] = $this->url->link('account/forgotten', '', true);

		// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
		if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {
			$data['redirect'] = $this->request->post['redirect'];
		} elseif (isset($this->session->data['redirect'])) {
			$data['redirect'] = $this->session->data['redirect'];

			unset($this->session->data['redirect']);
		} else {
			$data['redirect'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('account/login', $data));
	}

	public function validate() {  //print_r($this->request->post);exit;
            $this->load->model('account/customer');
            $this->load->language('account/login');

            $json = array();
            
            if ((utf8_strlen($this->request->post['frmUserEmail']) > 96) || utf8_strlen($this->request->post['frmUserEmail']) ==0) {
                $json['error']['email'] = $this->language->get('error_emailrequired');
            }elseif(!filter_var($this->request->post['frmUserEmail'], FILTER_VALIDATE_EMAIL)){
                $json['error']['email'] = $this->language->get('error_emailinvalid');
            }
            
            if ((utf8_strlen($this->request->post['frmUserPassword']) == 0)) {
                $json['error']['password'] = $this->language->get('error_passwordrequired');
            }
            
            if (!$json) {
                // Check how many login attempts have been made.
                $login_info = $this->model_account_customer->getLoginAttempts($this->request->post['frmUserEmail']);

                if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
                    $json['warning'] = $this->language->get('error_attempts');
                }

                // Check if customer has been approved.
                $customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['frmUserEmail']);

                if ($customer_info && !$customer_info['approved']) {
                    $json['warning'] = $this->language->get('error_approved');
                }

                if (!$json) {
                    if (!$this->customer->login($this->request->post['frmUserEmail'], $this->request->post['frmUserPassword'])) {
                        $json['warning'] = $this->language->get('error_login');

                        $this->model_account_customer->addLoginAttempt($this->request->post['frmUserEmail']);
                    } else {
                        $this->model_account_customer->deleteLoginAttempts($this->request->post['frmUserEmail']);
                    }
                }

                if(!$json){
                    $json['success']='Success';
                    $json['redirect_url']=$this->url->link('account/account', '', true);
                }
            }
            
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json)); 
	}
	
	public function validatePopup() {  //print_r($this->request->post);exit;
            $this->load->model('account/customer');
            $this->load->language('account/login');

            $json = array();
            
            if ((utf8_strlen($this->request->post['frmUserEmail']) > 96) || utf8_strlen($this->request->post['frmUserEmail']) ==0) {
                $json['error']['email'] = $this->language->get('error_emailrequired');
            }elseif(!filter_var($this->request->post['frmUserEmail'], FILTER_VALIDATE_EMAIL)){
                $json['error']['email'] = $this->language->get('error_emailinvalid');
            }
            
            if ((utf8_strlen($this->request->post['frmUserPassword']) == 0)) {
                $json['error']['password'] = $this->language->get('error_passwordrequired');
            }
            
            if (!$json) {
                // Check how many login attempts have been made.
                $login_info = $this->model_account_customer->getLoginAttempts($this->request->post['frmUserEmail']);

                if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
                    $json['warning'] = $this->language->get('error_attempts');
                }

                // Check if customer has been approved.
                $customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['frmUserEmail']);

                if ($customer_info && !$customer_info['approved']) {
                    $json['warning'] = $this->language->get('error_approved');
                }

                if (!$json) {
                    if (!$this->customer->login($this->request->post['frmUserEmail'], $this->request->post['frmUserPassword'])) {
                        $json['warning'] = $this->language->get('error_login');

                        $this->model_account_customer->addLoginAttempt($this->request->post['frmUserEmail']);
                    } else {
                        $this->model_account_customer->deleteLoginAttempts($this->request->post['frmUserEmail']);
                    }
                }

                if(!$json){
                    $json['success']='Success';
					$json['customerName'] = $this->customer->getFirstName();
					$json['customerEmail'] = $this->customer->getEmail();
					$json['customerMobile'] = $this->customer->getMobile();
                    $json['redirect_url']=$this->request->post['frmUserRedirect'];
                }
            }
            
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json)); 
	}
}
