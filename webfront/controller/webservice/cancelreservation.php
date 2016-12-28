<?php
class ControllerWebserviceCancelreservation extends Controller {
	public function index() {
		$this->load->language('api/order');

		$json = array();
		$this->load->model('account/api');
		 
		$rest_json = file_get_contents("php://input");
		$rest_vars = json_decode($rest_json, true);
		
		$this->request->post['comment']= '';
		
		 $this->request->post['notify'] = '';
		 
		 $this->request->post['override'] = '';
		 
		// Login with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		 
		if($api_info){ 
			 

			$this->load->model('checkout/order');

			if (isset($this->request->request['reservation_id'])) {
				$order_id = $this->request->request['reservation_id'];
			} else {
				$order_id = 0;
			}

			$order_info = $this->model_checkout_order->getOrder($order_id);

			if ($order_info) {
				$this->model_checkout_order->addOrderHistory($order_id, 4, 'Canceled By Cusotmer', '', '');

				$json['success'] = 1;
				$json['message'] = 'cancel order successfully';
			} else {
				$json['success'] = 0;
				$json['message'] = $this->language->get('error_not_found');
			}
		}else{
			$json['success'] = 0;
			$json['message'] = 'Invalid Api Key....';
		}

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
