<?php
class ControllerWebserviceConfirmorder extends Controller {
	public function index() {  
	
		$this->load->model('account/customer');
		
		$customer_id = $this->request->post['customer_id'];
		$merchant_id = $this->request->post['merchant_id'];
		$service_id = $this->request->post['service_id'];
		$booking_date = $this->request->post['booking_date'];
		$bookingPersons = $this->request->post['bookingPersons'];
		$bookingDuration = $this->request->post['bookingDuration'];
		$bookingServices = $this->request->post['bookingServices'];
		$bookingDiscountTime =$this->request->post['bookingDiscountTime'];
		$bookingDiscount =$this->request->post['bookingDiscount'];
		$bookingPrice = $this->request->post['bookingPrice'];
		$bookingCountryId = $this->request->post['bookingCountryId'];
		$payment_method = $this->request->post['payment_method'];
		
		$json = array();
		
		$this->load->model('account/api');
		 
		$rest_json = file_get_contents("php://input");
		$rest_vars = json_decode($rest_json, true);
		 
		// Login with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		 
		if($api_info){
		//print_r($this->request->post);exit;
		
		$customer_info = $this->model_account_customer->getCustomer($customer_id);
		
		//print_r($customer_info);exit;

		$order_data['customer_id'] = $customer_id;
		$order_data['merchant_id'] = $merchant_id;
		$order_data['booking_date'] = $booking_date;
		$order_data['customer_group_id'] = $customer_info['customer_group_id'];
		$order_data['firstname'] = $customer_info['firstname'];
		$order_data['lastname'] = $customer_info['lastname'];
		$order_data['email'] = $customer_info['email'];
		$order_data['telephone'] = $customer_info['telephone'];
		$order_data['mobile'] = $customer_info['mobile'];
		$order_data['comment'] = '';
		$order_data['total'] = $bookingPrice;
		$order_data['payment_country_id'] = $bookingCountryId;
		
		$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		$order_data['store_id'] = $this->config->get('config_store_id');
		$order_data['store_name'] = $this->config->get('config_name');
		

		if ($order_data['store_id']) {
			$order_data['store_url'] = $this->config->get('config_url');
		} else {
			$order_data['store_url'] = HTTP_SERVER;
		}
		
		if (isset($payment_method)) {
				$order_data['payment_method'] = $payment_method;
				$order_data['payment_code'] = $payment_method;
		} else {
			$order_data['payment_method'] = '';
			$order_data['payment_code'] = '';
		}

		
		$order_data['products'][] = array(
			'product_id' 	=> $service_id,
			'merchant_id' 	=> $merchant_id,
			'service_id'		=> $service_id,
			'name'       	=> $bookingServices,
			'persons'    	=> $bookingPersons,
			'bookingDiscountTime'   => $bookingDiscountTime,
			'duration'   	=> $bookingDuration,
			'discount'   	=> $bookingDiscount,
			'disc_amount'   => (($bookingPrice * $bookingDiscount)/100),
			'sub_total'   	=> $bookingPrice,
			'price'      	=> $bookingPrice,
			'total'      	=> $bookingPrice - (($bookingPrice * $bookingDiscount)/100),
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
			'value' =>  $bookingPrice,
			'sort_order'    => 1		
		);
		
		$order_data['totals'][] = array(
			'code' => 'disc',
			'title' => 'Disc-Amount',
			'value' =>  (($bookingPrice * $bookingDiscount)/100),
			'sort_order'    => 2	
		);
		
		
		$order_data['totals'][] = array(
			'code' => 'total',
			'title' => 'Total',
			'value' =>  $bookingPrice -(($bookingPrice * $bookingDiscount)/100),
			'sort_order'    => 3
		);
		
		//print '<pre>'; print_r($order_data);exit;
		
		 
		
		if ($payment_method == 'cod') {
			
			$this->load->model('checkout/order');
			
			$order_id = $this->model_checkout_order->addOrder($order_data); 
		
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($order_id, 5);//$this->config->get('cod_order_status_id'));
			
			$json['success'] = '1';
			$json['message'] = 'Order process Successfully';
			
		}else{
		
			$json['error'] = 'Some thing wrong....';
		
		}
		}else{
		
			$json['error'] = 'Invalid Api Key....';
			
		}
		  
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}
}
