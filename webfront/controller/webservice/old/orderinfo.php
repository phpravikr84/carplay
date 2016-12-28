<?php
class ControllerWebserviceOrderinfo extends Controller {
	public function index() {
		$this->load->language('api/order');

		$json = array();

		$json = array();
		$this->load->model('account/api');
		 
		$rest_json = file_get_contents("php://input");
		$rest_vars = json_decode($rest_json, true);
		 
		// Login with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->post['key']);
		 
		if($api_info){
			$this->load->model('checkout/order');

			if (isset($this->request->post['order_id'])) {
				$order_id = $this->request->post['order_id'];
			} else {
				$order_id = 0;
			}

			$json = $this->model_checkout_order->getOrderWebservice($order_id);
			
			$services = $this->db->query("SELECT name,bookingDiscountTime,persons,duration,sub_total,discount,disc_amount,total FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "'");


			$json['services'] = $services->row;
			
			 

				$json['success'] = '1';
			 
		}else{
			$json['error'] = 'Invalid Api Key....';
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
