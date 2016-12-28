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

				$merchant_info = $this->model_catalog_merchant->getMerchantsApi($filter_data);
				
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
		
						$discounts = $this->model_catalog_merchant->getDiscounts($result['merchant_id'], date("Y-m-d"));
						
						$seconds = time();
						
						$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);	
						
						$timeSlot = false;
						
						$i=1;
						
						$disc= array();
						
						foreach ($discounts as $discount) {
							if(date('h:i A', $rounded_seconds) == ($discount['merchant_time']) || $timeSlot == true){ $timeSlot = true;
								$disc[] = array(
									'merchant_discount_id'  		=> (int)$discount['merchant_discount_id'], 
									'merchant_time'        		=> ($discount['merchant_time']),
									'seats'       		=> (int)$discount['seats'],
									'percentage'     		=> (int)$discount['percentage'],
									'sort_order'     	=> (int)$discount['sort_order'] 
								);
								
								$i++;
								
								if($i==3){ $timeSlot=false;}
							}
						}
						
							
						
						$json['merchants'][] = array(
							'merchant_id'  		=> (int)$result['merchant_id'], 
							'name'        		=> (strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))),
							'viewed'       		=> (int)$result['viewed'],
							'reserved'     		=> (int)$result['reserved'],
							'price_level'     	=> (int)$result['price_level'],
							'rating'     		=> (int)$result['rating'],
							'thumb'				=> $image,
							'country'      		=> $this->model_localisation_country->getCountryName($result['country_id']),
							'zone'      		=> $this->model_localisation_zone->getZoneName($result['zone_id']),	
							'city'      		=> $this->model_localisation_city->getCityName($result['city_id']),
							'location'      	=> $this->model_localisation_location->getLocationName($result['location_id']),	
							'address'     		=> $this->db->escape($result['address']),
							'mobile'     		=> $this->db->escape($result['mobile']),
							'email'     		=> $this->db->escape($result['email']),
							'website'     		=> $this->db->escape($result['website']),
							'contact_person'    => $this->db->escape($result['contact_person']),
							'contact_person_position'=> $this->db->escape($result['contact_person_position']),
							'from_opeining_hours'=> $this->db->escape($result['from_opeining_hours']),
							'to_opening_hours'   => $this->db->escape($result['to_opening_hours']),
							'latitude'     		=> ($result['latitude']),
							'longitude'     	=> ($result['longitude']),
							'no_of_staff'     	=> (int)($result['no_of_staff']),
							'capacity'     		=> (int)($result['capacity']),
							'discount'    		=> $disc
						);
					}
					//print_r($json['merchants']);exit;	
					$json['status'] = '1';
					$json['message'] = 'Success';
				}
		
			
		}else{
			$json['status'] = '0';
			$json['message'] = 'Invalid API Key';
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
