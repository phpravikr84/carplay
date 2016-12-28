<?php
class ControllerWebserviceMyreservation extends Controller {
	public function index() {
		
		$data['orders'] = array();

		$this->load->model('account/order');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		$customer_id = $this->request->get['customer_id'];
		
		 // print_r($this->request->post);exit;
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if($api_info){ 
		
		
			if (isset($customer_id) && $customer_id != '') { 
			
				 $results = $this->model_account_order->getOrdersMobile($customer_id);
				
				if(count($results) > 0){

					$results = $this->model_account_order->getOrdersMobile($customer_id);
			
					foreach ($results as $result) {
						$product_total = $this->model_account_order->getTotalOrderProductsByOrderId($result['order_id']);
						$voucher_total = $this->model_account_order->getTotalOrderVouchersByOrderId($result['order_id']);
						
						$OrderP = $this->model_account_order->getOrderProductsMobile($result['order_id']); 
						
						//print_R($OrderP);exit;
						
						$OrderService = array(); 
							
						$OrderService[] = array(
							'name'   => $OrderP['name'],
							'bookingDiscountTime'     => trim(str_replace(" ","",$OrderP['bookingDiscountTime'])),
							'persons'     => $OrderP['persons'],
							'duration'     => (int)$OrderP['duration'],
							'discount'     => (int)$OrderP['discount'],
							'price'     => (int)$OrderP['price'],
							'disc_amount'   => (int)$OrderP['disc_amount'],
							'total'   => (int)$OrderP['total'],
						); 
						
						$json['reservations'][] = array(
							'reservation_id'  	=> (int)$result['order_id'],
							 
							'name'       	=> $result['firstname'] . ' ' . $result['lastname'],
							'status'     	=> $result['status'],
							'currency'      => $result['currency_code'],
							'date_added' 	=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
							'booking_date' 	=> date($this->language->get('date_format_short'), strtotime($result['booking_date'])),
							'service_detail'   => $OrderService
						);
					}
					
					$json['status'] = '1';
					$json['message'] = 'Success';
				
				}else{
					$json['status'] = '0';
					$json['message'] = 'No Order Found'; 
				}
			}else{
			
				$json['status'] = '0';
				$json['message'] = 'Csutomer Id not exist';
			
			}
			
			
			
		}else{
			$json['status']   = '0';
            $json['message']  = 'Invalid API Key';
		}
		//print '<pre>'; print_r($json);
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->addHeader('Api-Key: Y0ZfLUllmxEYZujBr5OW7ApP6I55aJyweClgTX8xrITnzhkwLSHM3GKSum34ANUeDfbN5u57TnNoarmDOmoy8P9EmaSRN7fOSeoOda8FW85sJHzbuSJ0TBD85INTNTCAjE6OxfV1AsjTQy9JYBlBM5v76QFOa59MsRpExAhtquhtpGCVwP9LrVL2wrgGnm9sxEKxSJNlFjB6MC2IRlrDwrWXO50f5IlcbzGqq0IjJMXMQA9Am90GZsqvff9v70FB');
		$this->response->setOutput(json_encode($json));
		
		
	}
}