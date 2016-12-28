<?php
class ControllerWebserviceMerchant extends Controller {
	public function index() {
		
		$this->load->language('product/category');

		$this->load->model('catalog/merchant');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
		$json = array();
		$this->load->model('account/api'); 	
		
		if(isset($this->request->request['path'])){
		
		$category_id = $this->request->request['path'];
		
		}else{
			
			$category_id = '';	
		}
		
		if(isset($this->request->get['city_id'])){
			 $city_id = $this->request->get['city_id'];
		}else{
			$city_id = 10;
		}
		
		if(isset($this->request->get['sort'])){
			 $sort = $this->request->get['sort'];
		}else{
			$sort = 'AZ';
		}
		
		
		//print $city_id;
		
		// API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		if($api_info){ 
		
		
			if (isset($this->request->get['path'])) {
				$parts = explode('_', (string)$this->request->get['path']);
	
				$category_id = (int)array_pop($parts);
				
				//print_r($category_id);exit;
	
				//$json['categories']=$this->request->get['path'];
				}
			
				$filter_data = array(
					'filter_category_id'  => $category_id,
					'filter_city_id' => $city_id,
					'sort' => $sort				
				);

				$merchant_info = $this->model_catalog_merchant->getMerchantsByCategoryId($filter_data);
				
				if($merchant_info){
									
					
					
					$data['total_merchant'] = count($merchant_info);
					
					$json['total_merchants']= count($merchant_info);
				
					//print_r($merchant_info);exit;	
					
					$this->load->model('localisation/country');
					$this->load->model('localisation/zone');
					$this->load->model('localisation/city');
					$this->load->model('localisation/location');
	 
	
					foreach ($merchant_info as $result) {
						if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
								$image = $this->model_tool_image->resize($result['image'], 500,380);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', 500,380);
						}
		
						$discount = $this->model_catalog_merchant->getDiscounts($result['merchant_id'], date("Y-m-d"));
						
						$seconds = time();
						
						$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);		
						
						$json['merchants'][] = array(
							'merchant_id'  		=> $result['merchant_id'], 
							'name'        		=> (strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))),
							'viewed'       		=> $result['viewed'],
							'reserved'     		=> $result['reserved'],
							'price_level'     	=> ($result['price_level']),
							'rating'     		=> ($result['rating']),
							'thumb'				=> $image,
							'country'      		=> $this->model_localisation_country->getCountryName($result['country_id']),
							'zone'      		=> $this->model_localisation_zone->getZoneName($result['zone_id']),	
							'city'      		=> $this->model_localisation_city->getCityName($result['city_id']),
							'location'      	=> $this->model_localisation_location->getLocationName($result['location_id']),	
							'address'     		=> ($result['address']),
							'mobile'     		=> ($result['mobile']),
							'email'     		=> ($result['email']),
							'website'     		=> ($result['website']),
							'contact_person'    => ($result['contact_person']),
							'contact_person_position'=> ($result['contact_person_position']),
							'from_opeining_hours'=> ($result['from_opeining_hours']),
							'to_opening_hours'   => ($result['to_opening_hours']),
							'latitude'     		=> ($result['latitude']),
							'longitude'     	=> ($result['longitude']),
							'no_of_staff'     	=> ($result['no_of_staff']),
							'capacity'     		=> ($result['capacity']),
							'discount'    		=> $discount
						);
					}
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
