<?php
class ControllerWebserviceMerchant extends Controller {
	public function index() {
		
		$this->load->language('product/category');

		$this->load->model('catalog/merchant');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		$product_id = $this->request->request['product_id'];
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if($api_info){ 
			
			$merchant_info = $this->model_catalog_merchant->getMerchants($product_id);

			//print '<pre>'; print_r($merchant_info);exit;
		
			$data['total_merchant'] = count($merchant_info);
			
			if ($merchant_info) {
	
				$this->load->model('localisation/country');
				$this->load->model('localisation/zone');
	 
	
				foreach ($merchant_info as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
					}
	
					$discount = $this->model_catalog_merchant->getDiscounts($result['merchant_id']);
					
					$seconds = time();
					$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);
					
					 
					$json['merchants'][] = array(
						'merchant_id'  		=> $result['merchant_id'],
						'thumb'       		=> $image,
						'round_time'    	=> date('h:i A', $rounded_seconds),
						'discount'    		=> $discount,
						'day'    			=> strtolower(date('D')).'_percentage',
						'name'        		=> $result['name'],
						'description' 		=> utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
						'viewed'       		=> $result['viewed'],
						'reserved'     		=> $result['reserved'],
						'price_level'     	=> ($result['price_level']+$result['price_level'])*10,
						'rating'     		=> ($result['rating']+$result['rating'])*10,
						'country'      		=> $this->model_localisation_country->getCountryName($result['country_id']),
						'zone'      		=> $this->model_localisation_zone->getZoneName($result['zone_id']),					 
						'href'         		=> $this->url->link('product/merchantdetail',   '&merchant_id=' . $result['merchant_id'] )
					);
				}
	
				 $json['status'] = '1';
				
				
			}else { 
				
				
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
