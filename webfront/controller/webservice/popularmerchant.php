<?php
class ControllerWebservicePopularmerchant extends Controller {
	public function index() {

		$this->load->model('catalog/merchant');

		$this->load->model('tool/image');
		
		$this->load->model('extension/module');
                
		$module_id = 34;
		
		$setting = $this->model_extension_module->getModule($module_id);
		
		$json = array();
		$this->load->model('account/api'); 	
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		//print_r($setting['merchant']);exit;
		
		if($api_info){ 
		
			if (!empty($setting['merchant'])) {
				 
				$merchants = array_slice($setting['merchant'], 0, (int)$setting['limit']);
				
				foreach ($merchants as $merchant_id) {
					
					$merchant_info = $this->model_catalog_merchant->getMerchant($merchant_id);
					
					//print_r($merchant_info);exit;
					
					if ($merchant_info) {
						
						if ($merchant_info['image'] && file_exists(DIR_IMAGE.$merchant_info['image'])) {
							$image = $this->model_tool_image->resize($merchant_info['image'], $setting['width'], $setting['height']);
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
						} 
	
						if ($this->config->get('config_review_status')) {
							$rating = $merchant_info['rating'];
						} else {
							$rating = false;
						}
						
						$discount = $this->model_catalog_merchant->getDiscounts($merchant_info['merchant_id'], date("Y-m-d"));
	
						$json['merchants'][] = array(
							'merchant_id'  		=> $merchant_info['merchant_id'],
							'thumb'       		=> $image,
							'name'        		=> $merchant_info['name'],
							
							'description' 		=> utf8_substr(strip_tags(html_entity_decode($merchant_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
							
							'terms' 		=> utf8_substr(strip_tags(html_entity_decode($merchant_info['terms'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
							
							'no_of_staff'      	=> $merchant_info['no_of_staff'], 
							'capacity'      	=> $merchant_info['capacity'], 
							'latitude'      	=> $merchant_info['latitude'], 
							'longitude'      	=> $merchant_info['longitude'], 
							'from_opeining_hours'=> $merchant_info['from_opeining_hours'], 
							'to_opening_hours'  => $merchant_info['to_opening_hours'], 
							'rating'      		=> $merchant_info['rating'],
							'reserved'      	=> $merchant_info['reserved'], 
							'price_level'      	=> $merchant_info['price_level'],
							'address'      		=> $merchant_info['address'], 
							'city'      		=> $merchant_info['city'], 
							'zone'      		=> $merchant_info['zone_id'], 
							'country'      		=> $merchant_info['country_id'], 
							'zip'      			=> $merchant_info['zip'], 
							'phone'      		=> $merchant_info['phone'], 
							'mobile'      		=> $merchant_info['mobile'], 
							'email'      		=> $merchant_info['email'], 
							'website'      		=> $merchant_info['website'], 
							'contact_person'    => $merchant_info['contact_person'],
							'contact_person_position'=> $merchant_info['contact_person_position'], 
							'viewed'      		=> $merchant_info['viewed'], 
							'discount'        	=> $discount
						);
					}
					
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
