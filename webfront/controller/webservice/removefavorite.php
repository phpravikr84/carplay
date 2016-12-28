<?php
class ControllerWebserviceRemovefavorite extends Controller {
	public function index() {
		 
		$this->load->language('account/wishlist');

		$this->load->model('account/wishlist');

		$this->load->model('catalog/merchant');

		$this->load->model('tool/image'); 

		 
		$json['merchants'] = array();
		
		
	 
		
		if (isset($this->request->get['customer_id'])) {
			$customer_id = $this->request->get['customer_id'];
		} else {
			$customer_id = 0;
		}
		
		if (isset($this->request->get['merchant_id'])) {
			$merchant_id = $this->request->get['merchant_id'];
		} else {
			$merchant_id = 0;
		}
		
		$json = array();
		$this->load->model('account/api'); 	
		
		 
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if($api_info){  
			if( $customer_id !=0 && $customer_id !=''){  
				$this->model_account_wishlist->deleteWishlistApi($customer_id,$merchant_id);
				$json['status'] = '1';
				$json['message'] = 'Success';
			}else{
				$json['status'] = '0';
				$json['message'] = 'Customer Id not exist...!';
			}
		}else{
			$json['status'] = '0';
			$json['message'] = 'Invalid API Key..!';
		}

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
