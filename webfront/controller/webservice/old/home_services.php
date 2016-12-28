<?php
class ControllerWebserviceHomeservices extends Controller {
	public function index() {
		$this->load->language('module/featured');
		$json = array();
		$this->load->model('account/api');
		$this->load->model('extension/module');
                
		$module_id = 28;
		
		$setting = $this->model_extension_module->getModule($module_id);
    
       // API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		$rest_json = file_get_contents("php://input");
		$rest_var = json_decode($rest_json, true);
		
		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$json['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		
		if($api_info){ 

			if (!empty($setting['product'])) {
				 
				$products = array_slice($setting['product'], 0, (int)$setting['limit']);
				
				//print_r($products);exit;
				
				foreach ($products as $product_id) {
					$product_info = $this->model_catalog_product->getProduct($product_id);
									
					//print_r($product_info);exit;
									
					if ($product_info) {
						if ($product_info['image']) {
							$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
						}
	
						if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$price = false;
						}
											
						$merchants = $this->model_catalog_product->getMerchantsByProductsId($product_id);
						
						//print '<pre>'; print_r($merchants);exit;
	 
						$special = false;
						 
	
						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}
	
						$json['products'][] = array(
							'product_id'  => $product_id,
							'thumb'       => $image,
							'name'        => $product_info['name'],
							'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
							'price'       => $price,
							'rating'      => $rating, 
							'merchants'      => $merchants, 
							'booked'      => $product_info['booked'], 
							'viewed'      => $product_info['viewed'], 
							'href'        => $this->url->link('webservice/merchant', 'product_id=' . $product_id)
						);
					}
				}
			}
			$json['status'] = '1';
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
