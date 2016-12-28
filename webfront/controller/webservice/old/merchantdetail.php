<?php
class ControllerWebserviceMerchantdetail extends Controller {
	public function index() {
		
		$this->load->language('product/category');

		$this->load->model('catalog/merchant');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if($api_info){ 
		
		
			if (isset($this->request->get['merchant_id'])) {
				
				//print_r($category_id);exit;
	
				//$json['categories']=$this->request->get['path'];
									
					$merchant_info = $this->model_catalog_merchant->getMerchant($this->request->get['merchant_id']);
					
					$data['total_merchant'] = count($merchant_info);
					
					
				
					//print_r($merchant_info);exit;	
					
					$this->load->model('localisation/country');
					$this->load->model('localisation/zone');
	 
	
					
						if ($merchant_info['image']) {
								$image = $this->model_tool_image->resize($merchant_info['image'], 500,380);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', 500,380);
						}
		
						$discount = $this->model_catalog_merchant->getDiscounts($merchant_info['merchant_id'], date("Y-m-d"));
						
						//$services = $this->model_catalog_merchant->getServicesByMerchantId($merchant_info['merchant_id']);
						
						$seconds = time();
						
						$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);						
						 
						$json['merchant'][] = array(
							'merchant_id'  		=> $merchant_info['merchant_id'], 
							'name'        		=> $merchant_info['name'],
							'description' 		=> strip_tags(html_entity_decode($merchant_info['description'], ENT_QUOTES, 'UTF-8')),
							'viewed'       		=> $merchant_info['viewed'],
							'thumb'				=> $image,
							'reserved'     		=> $merchant_info['reserved'],
							'price_level'     	=> ($merchant_info['price_level']),
							'rating'     		=> ($merchant_info['rating']),
							'mobile'     		=> ($merchant_info['mobile']),
							'email'     		=> ($merchant_info['email']),
							'website'     		=> ($merchant_info['website']),
							'contact_person'    => ($merchant_info['contact_person']),
							'contact_person_position'=> ($merchant_info['contact_person_position']),
							'from_opeining_hours'=> ($merchant_info['from_opeining_hours']),
							'to_opening_hours'   => ($merchant_info['to_opening_hours']),
							'latitude'     		=> ($merchant_info['latitude']),
							'longitude'     	=> ($merchant_info['longitude']),
							'no_of_staff'     	=> ($merchant_info['no_of_staff']),
							'capacity'     		=> ($merchant_info['capacity']),
							'address'     		=> ($merchant_info['address']),
							'city'     		    => ($merchant_info['city']),
							'country'      		=> $this->model_localisation_country->getCountryName($merchant_info['country_id']),
							'zone'      		=> $this->model_localisation_zone->getZoneName($merchant_info['zone_id']),					 
							'atmosphere'  		=> $this->model_catalog_merchant->getMerchantAtmosphere($merchant_info['merchant_id']),
							'facilities' 		=> $this->model_catalog_merchant->getMerchantFacilities($merchant_info['merchant_id']),
							'spoken_language' 	=> $this->model_catalog_merchant->getMerchantSpokenLangauge($merchant_info['merchant_id']),
							
							'discount'    		=> $discount
						);
						
						
					
					//print_r($json['merchants']);exit;	
					$json['status'] = '1';
				
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
