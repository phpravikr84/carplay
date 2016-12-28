<?php
class ControllerCheckoutConfirm extends Controller {
	public function index() {
		
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', true);
			$this->response->redirect($this->url->link('account/login', '', true));
		}else if (!isset($this->session->data['confirmOrder'])) {
			$this->response->redirect($this->url->link('common/home', '', true));	
		}
		
		///print '<pre>'; print_R($this->session->data);exit;
		
		$redirect = '';
		$this->load->model('catalog/merchant');
		//print_r($this->session->data['confirmOrder']);exit;
		$this->document->setTitle('Confirm Reservation');
	
		$data['editReservation'] = $this->url->link('product/merchantdetail','merchant_id=' . $this->session->data['confirmOrder']['bookingMerchantId']);
		
		$merchant_info = $this->model_catalog_merchant->getMerchant($this->session->data['confirmOrder']['bookingMerchantId']);
		
		//print '<pre>'; print_r($merchant_info);exit;

		$servicerate = str_replace(',','',$this->session->data['confirmOrder']['bookingActualPrice']);
		
		$data['bookingDate']= $this->session->data['confirmOrder']['bookingDate'];
		$data['checkinDate']=  date('l M d Y',strtotime($data['bookingDate']));
		$data['product_id']= $this->session->data['confirmOrder']['product_id'];
		$data['bookingPerson']= $this->session->data['confirmOrder']['bookingPerson'];
		$data['bookingServices']= $this->session->data['confirmOrder']['bookingServices'];
		$data['bookingDiscount']= $this->session->data['confirmOrder']['bookingDiscount'];
		$data['bookingMerchantId']= $this->session->data['confirmOrder']['bookingMerchantId'];
		$data['bookingMerchantName']= $this->session->data['confirmOrder']['bookingMerchantName']; 
		$data['bookingDiscountTime']= $this->session->data['confirmOrder']['bookingDiscountTime'];
		$data['bookingServices']= $this->session->data['confirmOrder']['bookingServices'];
		$data['bookingDuration']= $this->session->data['confirmOrder']['bookingDuration'];
		$data['servicerate'] = $servicerate;
		
		
		$data['currency_symbal'] = $this->currency->getSymbolLeft($this->session->data['currency']);
		$data['bookingDiscountAmount']= ($this->session->data['confirmOrder']['bookingDiscountAmount']);
		$data['bookingSubTotal']= 	 ($this->session->data['confirmOrder']['subtotal']);	
		$data['bookingPrice']=  ($this->session->data['confirmOrder']['bookingPrice']); 
		$data['bookingCurrency']=  $this->session->data['currency']; 
		
		$data['bookingTerms']= html_entity_decode($merchant_info['terms'], ENT_QUOTES, 'UTF-8'); 
		$data['image'] = $merchant_info['image'];
		$data['address'] = $merchant_info['address'];

		$data['currencyname'] = $this->session->data['currency'];
		
		
		$data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		if($this->customer->isLogged()) {  
			$data['customerName'] = $this->customer->getFirstName().' '.$this->customer->getLastName();
			$data['customerEmail'] = $this->customer->getEmail();
			$data['customerMobile'] = $this->customer->getMobile();
		}else{
			$data['customerName'] = '';
			$data['customerEmail'] = '';
			$data['customerMobile'] = '';
		}

		if (!$redirect) {
			$order_data = array();

			$totals = array();
			$taxes = '';
			$total = 0;

			 

			$order_data['totals'] = '';

			$this->load->language('checkout/checkout');

			$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			$order_data['store_id'] = $this->config->get('config_store_id');
			$order_data['store_name'] = $this->config->get('config_name');

			if ($order_data['store_id']) {
				$order_data['store_url'] = $this->config->get('config_url');
			} else {
				$order_data['store_url'] = HTTP_SERVER;
			}

			if ($this->customer->isLogged()) {
				$this->load->model('account/customer');

				$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());

				$order_data['customer_id'] = $this->customer->getId();
				$order_data['booking_date'] = $this->customer->getId();
				$order_data['customer_group_id'] = $customer_info['customer_group_id'];
				$order_data['firstname'] = $customer_info['firstname'];
				$order_data['lastname'] = $customer_info['lastname'];
				$order_data['email'] = $customer_info['email'];
				$order_data['telephone'] = $customer_info['telephone'];
				$order_data['fax'] = $customer_info['fax'];
				$order_data['custom_field'] = json_decode($customer_info['custom_field'], true);
			} elseif (isset($this->session->data['guest'])) {
				$order_data['customer_id'] = 0;
				$order_data['booking_date'] = $this->session->data['guest']['booking_date'];
				$order_data['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
				$order_data['firstname'] = $this->session->data['guest']['firstname'];
				$order_data['lastname'] = $this->session->data['guest']['lastname'];
				$order_data['email'] = $this->session->data['guest']['email'];
				$order_data['telephone'] = $this->session->data['guest']['telephone'];
				$order_data['fax'] = $this->session->data['guest']['fax'];
				$order_data['custom_field'] = $this->session->data['guest']['custom_field'];
			}

			 
			if (isset($this->session->data['payment_method']['title'])) {
				$order_data['payment_method'] = $this->session->data['payment_method']['title'];
			} else {
				$order_data['payment_method'] = '';
			}

			if (isset($this->session->data['payment_method']['code'])) {
				$order_data['payment_code'] = $this->session->data['payment_method']['code'];
			} else {
				$order_data['payment_code'] = '';
			}

			$order_data['products'] = array();

			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();

				foreach ($product['option'] as $option) {
					$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'option_id'               => $option['option_id'],
						'option_value_id'         => $option['option_value_id'],
						'name'                    => $option['name'],
						'value'                   => $option['value'],
						'type'                    => $option['type']
					);
				}

				$order_data['products'][] = array(
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'download'   => $product['download'],
					'quantity'   => $product['quantity'],
					'subtract'   => $product['subtract'],
					'price'      => $product['price'],
					'total'      => $product['total'],
					'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
					'reward'     => $product['reward']
				);
			}

			// Gift Voucher
			$order_data['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $voucher) {
					$order_data['vouchers'][] = array(
						'description'      => $voucher['description'],
						'code'             => token(10),
						'to_name'          => $voucher['to_name'],
						'to_email'         => $voucher['to_email'],
						'from_name'        => $voucher['from_name'],
						'from_email'       => $voucher['from_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'],
						'message'          => $voucher['message'],
						'amount'           => $voucher['amount']
					);
				}
			}

			//$order_data['comment'] = $this->session->data['comment'];
			$order_data['total'] = '';

			 

			$order_data['language_id'] = $this->config->get('config_language_id');
			$order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
			$order_data['currency_code'] = $this->session->data['currency'];
			$order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
			$order_data['ip'] = $this->request->server['REMOTE_ADDR'];

			if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
				$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
			} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
				$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
			} else {
				$order_data['forwarded_ip'] = '';
			}

			if (isset($this->request->server['HTTP_USER_AGENT'])) {
				$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
			} else {
				$order_data['user_agent'] = '';
			}

			if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
				$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
			} else {
				$order_data['accept_language'] = '';
			}

			$this->load->model('checkout/order');

			//$this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);

			$data['text_recurring_item'] = $this->language->get('text_recurring_item');
			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');

			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');

			$this->load->model('tool/upload');

			$data['products'] = array();

			

			// Gift Voucher
			$data['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $voucher) {
					$data['vouchers'][] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $this->session->data['currency'])
					);
				}
			}

			$data['totals'] = array();

			$this->session->data['payment_method']['code'] = 'cod';
			$data['payment'] = $this->load->controller('payment/' . $this->session->data['payment_method']['code']);
		} else {
			$data['redirect'] = $redirect;
		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('checkout/confirm', $data));
	}
	
	public function confirmOrder(){
		
		//print_r($this->session->data['confirmOrder']);
		//exit;
		
		$this->load->model('account/customer');
		$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		$order_data['bookingDisocuntId'] = $this->session->data['confirmOrder']['bookingDisocuntId'];
		$order_data['customer_id'] = $this->customer->getId();
		$order_data['merchant_id'] = $this->session->data['confirmOrder']['bookingMerchantId'];
		$order_data['booking_date'] = $this->session->data['confirmOrder']['bookingDate'];
		$order_data['customer_group_id'] = $customer_info['customer_group_id'];
		$order_data['firstname'] = $customer_info['firstname'];
		$order_data['lastname'] = $customer_info['lastname'];
		$order_data['email'] = $customer_info['email'];
		$order_data['telephone'] = $customer_info['telephone'];
		$order_data['comment'] = '';
		$order_data['total'] = $this->session->data['confirmOrder']['bookingPrice'];
		$order_data['payment_country_id'] = $this->session->data['confirmOrder']['bookingCountryId'];
		$order_data['mobile'] = $customer_info['mobile'];
		$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		$order_data['store_id'] = $this->config->get('config_store_id');
		$order_data['store_name'] = $this->config->get('config_name');


				/* Get Margins from Merchant Begin */

		$this->load->model('catalog/merchant');

		$merchantMargins = $this->model_catalog_merchant->getMerchantMargin($this->session->data['confirmOrder']['bookingMerchantId']);

				//print_r($merchantMargins);
				//exit;
		foreach($merchantMargins as $marginsData)
				{
					
				if($marginsData['margine_type']!=0 || $marginsData['margine_type']!=""){

					$marginType = $marginsData['margine_type'];
				}

				else{

					$marginType ='';
				}

				if($marginsData['margin_value']!=0 || $marginsData['margin_value']!=""){

					$marginValue = $marginsData['margin_value'];
				}

				else{

					$marginValue =0;
				}
					$order_data['margin_type'] = $marginType;
					$order_data['margin_value'] = $marginValue;

						
				}

		/*End */
		
		

		if ($order_data['store_id']) {
			$order_data['store_url'] = $this->config->get('config_url');
		} else {
			$order_data['store_url'] = HTTP_SERVER;
		}
		
		if (isset($this->session->data['payment_method']['title'])) {
				$order_data['payment_method'] = $this->session->data['payment_method']['title'];
		} else {
			$order_data['payment_method'] = '';
		}

		if (isset($this->session->data['payment_method']['code'])) {
			$order_data['payment_code'] = $this->session->data['payment_method']['code'];
		} else {
			$order_data['payment_code'] = '';
		}
		
		//print '<pre>';print_r( $this->session->data['confirmOrder']);exit;

		// DUE to comman in amount the calculation goes wrong

		$bookingActualPrice = str_replace(',','',$this->session->data['confirmOrder']['bookingActualPrice']);
		$bookingDiscountPercentage = str_replace('%','',$this->session->data['confirmOrder']['bookingDiscount']);

		$bookingpurchaseDate = date("d-m-Y", strtotime($this->session->data['confirmOrder']['bookingDate']));

		$sub_total = (int)($this->session->data['confirmOrder']['bookingPrice']*$this->session->data['confirmOrder']['bookingPerson'])- (int)$this->session->data['confirmOrder']['bookingDiscountAmount'];

		$total = (int)($this->session->data['confirmOrder']['bookingPrice']*$this->session->data['confirmOrder']['bookingPerson'])- (int)$this->session->data['confirmOrder']['bookingDiscountAmount'];

		
		
		$order_data['products'][] = array(
			'purchaseDate'	=>	$bookingpurchaseDate,
			
			'product_id' 	=> $this->session->data['confirmOrder']['product_id'],
			'merchant_id' 	=> $this->session->data['confirmOrder']['bookingMerchantId'],
			'name'       	=> $this->session->data['confirmOrder']['bookingServices'],
			'persons'    	=> $this->session->data['confirmOrder']['bookingPerson'],
			'bookingDiscountTime'   => $this->session->data['confirmOrder']['bookingDiscountTime'],
			'duration'   	=> $this->session->data['confirmOrder']['bookingDuration'],
			'discount'   	=> (int)$bookingDiscountPercentage,
			'disc_amount'   => $this->session->data['confirmOrder']['bookingDiscountAmount'],
			//'sub_total'   	=> $this->session->data['confirmOrder']['subtotal'],
			'sub_total'   	=> (int)$sub_total,
			// 'bookingActualPrice'=> $this->session->data['confirmOrder']['bookingActualPrice'],
			'bookingActualPrice' => (int)$bookingActualPrice,
			'price'      	=> (int)$this->session->data['confirmOrder']['bookingPrice'],
			//'total'      	=> $this->session->data['confirmOrder']['bookingPrice'],
			'total'      	=> (float)$total,
			'tax'        	=> '',//$this->tax->getTax($this->session->data['confirmOrder']['bookingPrice'], $product['tax_class_id']),
			'reward'     	=> 1
		);
		
		$order_data['language_id'] = $this->config->get('config_language_id');
		$order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
		$order_data['currency_code'] = $this->session->data['currency'];
		$order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
		$order_data['ip'] = $this->request->server['REMOTE_ADDR'];

		if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
		} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
		} else {
			$order_data['forwarded_ip'] = '';
		}

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
		} else {
			$order_data['user_agent'] = '';
		}

		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$order_data['accept_language'] = '';
		}
		
		$data['totals'] = array();
		
		
		$order_data['totals'][] = array(
			'code' => 'sub_total',
			'title' => 'Sub-Total',
			'value' =>  $this->session->data['confirmOrder']['subtotal'],
			'sort_order'    => 1		
		);
		
		$order_data['totals'][] = array(
			'code' => 'disc',
			//'title' => 'Disc-Amount',
			'title' => 'Discount'.$this->session->data['confirmOrder']['bookingDiscount'],
			'value' =>  $this->session->data['confirmOrder']['bookingDiscountAmount'],
			'sort_order'    => 2	
		);
		
		
		$order_data['totals'][] = array(
			'code' => 'total',
			'title' => 'Total',
			'value' =>  $this->session->data['confirmOrder']['bookingPrice'],
			'sort_order'    => 3
		);
		
		$this->load->model('checkout/order');
		$this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);  
		
		
		
		if ($this->session->data['payment_method']['code'] == 'cod') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], 5);//$this->config->get('cod_order_status_id'));
			
			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'order_id' => $this->session->data['order_id'],
				'status'        => 'Add Order Hsitory Success'
			);

			$this->model_account_activity->addActivity('Order', $activity_data);
        
		
			$json['success'] = 'Confrim Order Success';
		}
		
		
		
		 $json['redirect'] = $this->url->link('checkout/success');;
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}


	public function _GET($label='',$default='',$set_default=false){
		
		$value=$default;
		
		if(isset($this->request->get[$label])&&!empty($this->request->get[$label])){
			
			$value=$this->request->get[$label];
		}
		
		if($set_default===true&&(!isset($this->request->get[$label])||$this->request->get[$label]=='')){
			
			$this->request->get[$label]=$default;
		}

		return $value;		
	}

	public function _POST($label='',$default='',$set_default=false){
		
		$value=$default;
		
		if(isset($this->request->post[$label])&&!empty($this->request->post[$label])){
			
			$value=$this->request->post[$label];
		}

		if($set_default===true&&(!isset($this->request->post[$label]) || $this->request->post[$label]=='')){
			
			$this->request->post[$label]=$default;
		}		
		
		return $value;		
	}	
	
	public function _SESSION($label='',$default='',$set_default=false){
		
		$value=$default;
		
		if(isset($this->request->session[$label])&&!empty($this->request->session[$label])){
			
			$value=$this->request->session[$label];
		}
		
		if($set_default===true&&(!isset($this->request->session[$label])||$this->request->session[$label]=='')){
			
			$this->request->session[$label]=$default;
		}	

		return $value;		
	}


	public function confirmOrderPaypalExpress(){
		
		///print_r($this->session->data['confirmOrder']);
		//exit;
		
		$this->load->model('account/customer');
		$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		$order_data['bookingDisocuntId'] = $this->session->data['confirmOrder']['bookingDisocuntId'];
		$order_data['customer_id'] = $this->customer->getId();
		$order_data['merchant_id'] = $this->session->data['confirmOrder']['bookingMerchantId'];
		$order_data['booking_date'] = $this->session->data['confirmOrder']['bookingDate'];
		$order_data['customer_group_id'] = $customer_info['customer_group_id'];
		$order_data['firstname'] = $customer_info['firstname'];
		$order_data['lastname'] = $customer_info['lastname'];
		$order_data['email'] = $customer_info['email'];
		$order_data['telephone'] = $customer_info['telephone'];
		$order_data['comment'] = '';
		$order_data['total'] = $this->session->data['confirmOrder']['bookingPrice'];
		$order_data['payment_country_id'] = $this->session->data['confirmOrder']['bookingCountryId'];
		$order_data['mobile'] = $customer_info['mobile'];
		$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		$order_data['store_id'] = $this->config->get('config_store_id');
		$order_data['store_name'] = $this->config->get('config_name');


				/* Get Margins from Merchant Begin */

		$this->load->model('catalog/merchant');

		$merchantMargins = $this->model_catalog_merchant->getMerchantMargin($this->session->data['confirmOrder']['bookingMerchantId']);

				//print_r($merchantMargins);
				//exit;
		foreach($merchantMargins as $marginsData)
				{
					
				if($marginsData['margine_type']!=0 || $marginsData['margine_type']!=""){

					$marginType = $marginsData['margine_type'];
				}

				else{

					$marginType ='';
				}

				if($marginsData['margin_value']!=0 || $marginsData['margin_value']!=""){

					$marginValue = $marginsData['margin_value'];
				}

				else{

					$marginValue =0;
				}
					$order_data['margin_type'] = $marginType;
					$order_data['margin_value'] = $marginValue;

						
				}

		/*End */


		
		

		if ($order_data['store_id']) {
			$order_data['store_url'] = $this->config->get('config_url');
		} else {
			$order_data['store_url'] = HTTP_SERVER;
		}
		
		if (isset($this->session->data['payment_method']['title'])) {
				$order_data['payment_method'] = $this->session->data['payment_method']['title'];
		} else {
			$order_data['payment_method'] = '';
		}

		// if (isset($this->session->data['payment_method']['code'])) {
		// 	$order_data['payment_code'] = $this->session->data['payment_method']['code'];
		// } else {
		// 	$order_data['payment_code'] = '';
		// }
		
		//print '<pre>';print_r( $this->session->data['confirmOrder']);exit;

		// DUE to comman in amount the calculation goes wrong

		$bookingActualPrice = str_replace(',','',$this->session->data['confirmOrder']['bookingActualPrice']);
		$bookingDiscountPercentage = str_replace('%','',$this->session->data['confirmOrder']['bookingDiscount']);

		$bookingpurchaseDate = date("d-m-Y", strtotime($this->session->data['confirmOrder']['bookingDate']));
		
		
		$order_data['products'][] = array(
			'purchaseDate'	=>	$bookingpurchaseDate,
			
			'product_id' 	=> $this->session->data['confirmOrder']['product_id'],
			'merchant_id' 	=> $this->session->data['confirmOrder']['bookingMerchantId'],
			'name'       	=> $this->session->data['confirmOrder']['bookingServices'],
			'persons'    	=> $this->session->data['confirmOrder']['bookingPerson'],
			'bookingDiscountTime'   => $this->session->data['confirmOrder']['bookingDiscountTime'],
			'duration'   	=> $this->session->data['confirmOrder']['bookingDuration'],
			'discount'   	=> (int)$bookingDiscountPercentage,
			'disc_amount'   => $this->session->data['confirmOrder']['bookingDiscountAmount'],
			'sub_total'   	=> $this->session->data['confirmOrder']['subtotal'],
			// 'bookingActualPrice'=> $this->session->data['confirmOrder']['bookingActualPrice'],
			'bookingActualPrice' => (int)$bookingActualPrice,
			'price'      	=> $this->session->data['confirmOrder']['bookingPrice'],
			'total'      	=> $this->session->data['confirmOrder']['bookingPrice'],
			'tax'        	=> '',//$this->tax->getTax($this->session->data['confirmOrder']['bookingPrice'], $product['tax_class_id']),
			'reward'     	=> 1
		);
		
		$order_data['language_id'] = $this->config->get('config_language_id');
		$order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
		$order_data['currency_code'] = $this->session->data['currency'];
		$order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
		$order_data['ip'] = $this->request->server['REMOTE_ADDR'];

		if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
		} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
		} else {
			$order_data['forwarded_ip'] = '';
		}

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
		} else {
			$order_data['user_agent'] = '';
		}

		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$order_data['accept_language'] = '';
		}
		
		$data['totals'] = array();
		
		
		$order_data['totals'][] = array(
			'code' => 'sub_total',
			'title' => 'Sub-Total',
			'value' =>  $this->session->data['confirmOrder']['subtotal'],
			'sort_order'    => 1		
		);
		
		$order_data['totals'][] = array(
			'code' => 'disc',
			//'title' => 'Disc-Amount',
			'title' => 'Discount'.$this->session->data['confirmOrder']['bookingDiscount'],
			'value' =>  $this->session->data['confirmOrder']['bookingDiscountAmount'],
			'sort_order'    => 2	
		);
		
		
		$order_data['totals'][] = array(
			'code' => 'total',
			'title' => 'Total',
			'value' =>  $this->session->data['confirmOrder']['bookingPrice'],
			'sort_order'    => 3
		);


		if($this->_GET('token')!='' && $this->_GET('PayerID')!=''){
		// elseif($this->_GET('token')!='' && $this->_GET('PayerID')!=''){
		
		//------------------DoExpressCheckoutPayment-------------------		
		
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
		//we will be using these two variables to execute the "DoExpressCheckoutPayment"
		//Note: we haven't received any payment yet.

			$order_data['payment_method'] = 'paypalexpress';

			$order_data['payment_code'] = $this->_GET('token');

		$this->load->model('payment/paypalexpress');		
		$this->model_payment_paypalexpress->DoExpressCheckoutPayment();
		$this->load->model('checkout/order');
		$this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data); 
		$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], 5);//$this->config->get('cod_order_status_id'));
			
			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'order_id' => $this->session->data['order_id'],
				'status'        => 'Add Order Hsitory Success'
			);

			$this->model_account_activity->addActivity('Order', $activity_data);

			$this->response->redirect($this->url->link('checkout/success'));
        
		
		// 	$json['success'] = 'Confrim Order Success';
		// 	$json['redirect'] = $this->url->link('checkout/success');;
		
		// $this->response->addHeader('Content-Type: application/json');
		// $this->response->setOutput(json_encode($json));

		}
		else{

			$order_data['payment_code'] = $this->session->data['payment_method']['code'];

		}
	
	}

}
