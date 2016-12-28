<?php
class ControllerWebserviceServices extends Controller {
	public function index() {
		
		$this->load->language('product/category');

		$this->load->model('catalog/merchant');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		$merchant_id = $this->request->request['merchant_id'];
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if($api_info){ 
		
			if (isset($this->request->get['merchant_id'])) {
						
					$product_info = $this->model_catalog_merchant->getAllProductsByMerchantId($merchant_id);
					
					$data['total_services'] = count($product_info);
					
					//print_r($product_info);exit;	
					
					$this->load->model('localisation/country');
					$this->load->model('localisation/zone');
	 				
					if($data['total_services'] > 0){
						foreach ($product_info as $result) {
							if ($result['image']) {
									$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
								} else {
									$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
							}
			
							$discount = $this->model_catalog_merchant->getDiscountsByProduct_id($result['product_id'], $merchant_id);
							
							$seconds = time();
							
							$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);						
							 
							$json['services'][] = array(
								'service_id'  		=> $result['product_id'], 
								'name'  		    => $result['name'],
								'thumb'       		=> $image,
								'name'        		=> $result['name'],
								'duration'			=> (int) $result['duration'],
								'price'			    => (int) $result['price'],
								'product_desc'      => $result['product_desc'],
								'description' 		=> strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')) ,
								'viewed'       		=> $result['viewed'],
								'discount'    		=> $discount
							);
						}
						//print_r($json['merchants']);exit;	
						$json['status'] = '1';
						$json['message'] = 'Success';
						
					}else {
						$json['status'] = '0';
						$json['message'] = 'No Service Found';
					}
				
			}
			
			 
			
		}else{
			$json['status'] = '0';
			$json['message'] = $this->language->get['error_invalidapikey'];
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
