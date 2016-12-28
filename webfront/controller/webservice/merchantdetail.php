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
				$fav_info = false;
				
				if(isset($this->request->request['customer_id'])){ 
					if($this->model_catalog_merchant->getMerchantFavorite($this->request->get['merchant_id'], $this->request->get['customer_id']) > 0){
						$fav_info =true;
					}
					
				}
									
				$merchant_info = $this->model_catalog_merchant->getMerchant($this->request->get['merchant_id']);
				
				$data['total_merchant'] = count($merchant_info);
			
				//print_r($merchant_info);exit;	
				
				$this->load->model('localisation/country');
				$this->load->model('localisation/zone');
					
				 if ($merchant_info['image'] && file_exists(DIR_IMAGE.$merchant_info['image'])) {
					$image = $this->model_tool_image->resize($merchant_info['image'], 500,380);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				}

				$data['images'] = array();

			$results = $this->model_catalog_merchant->getMerchantImages($this->request->get['merchant_id']);

			foreach ($results as $result) {
				 if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
				 	$data['images'][] = array(
				 		 
				 		'thumb' => $this->model_tool_image->resize($result['image'], 1024,750)
				 	);
				 }else{
				 	$data['images'][] = array(
				 		 
				 		'thumb' => $this->model_tool_image->resize('placeholder.png', 1024,750)
				 	);
				 }
			}


				$discounts = $this->model_catalog_merchant->getDiscounts($merchant_info['merchant_id'], date("Y-m-d"));
				
				//$services = $this->model_catalog_merchant->getServicesByMerchantId($merchant_info['merchant_id']);
				
				$seconds = time();
				
				$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);	
				
				$timeSlot = false;
				
				$i=1;
				
				$disc= array();
				
				foreach ($discounts as $discount) {
					//if(date('h:i A', $rounded_seconds) == ($discount['merchant_time']) || $timeSlot == true){ $timeSlot = true;
						$disc[] = array(
							'merchant_discount_id'  		=> (int)$discount['merchant_discount_id'], 
							'merchant_time'        		=> ($discount['merchant_time']),
							'seats'       		=> (int)$discount['seats'],
							'percentage'     		=> (int)$discount['percentage'],
							'sort_order'     	=> (int)$discount['sort_order'] 
						);
						
						$i++;
						
						//if($i==3){ $timeSlot=false;}
					//}
				}					
				 
				$json['merchant'][] = array(
					'merchant_id'  		=> (int)$merchant_info['merchant_id'], 
					'name'        		=> $this->db->escape($merchant_info['name']),
					'description' 		=> strip_tags(html_entity_decode($merchant_info['description'], ENT_QUOTES, 'UTF-8')),
					'viewed'       		=> (int)$merchant_info['viewed'],
					'thumb'				=> $image,
					'extra_thumb'		=> $data['images'],
					'reserved'     		=> (int)$merchant_info['reserved'],
					'price_level'     	=> (int)($merchant_info['price_level']),
					'rating'     		=> (int)($merchant_info['rating']),
					'mobile'     		=> $this->db->escape($merchant_info['mobile']),
					'email'     		=> $this->db->escape($merchant_info['email']),
					'website'     		=> $this->db->escape($merchant_info['website']),
					'contact_person'    => $this->db->escape($merchant_info['contact_person']),
					'contact_person_position'=> $this->db->escape($merchant_info['contact_person_position']),
					'from_opeining_hours'=> $this->db->escape($merchant_info['from_opeining_hours']),
					'to_opening_hours'   => $this->db->escape($merchant_info['to_opening_hours']),
					'latitude'     		=> $this->db->escape($merchant_info['latitude']),
					'longitude'     	=> $this->db->escape($merchant_info['longitude']),
					'no_of_staff'     	=> (int)($merchant_info['no_of_staff']),
					'capacity'     		=> (int)($merchant_info['capacity']),
					'address'     		=> $this->db->escape($merchant_info['address']),
					'city'     		    => $this->db->escape($merchant_info['city']),
					'favorite'				=> $fav_info,
					'country'      		=> $this->model_localisation_country->getCountryName($merchant_info['country_id']),
					'zone'      		=> $this->model_localisation_zone->getZoneName($merchant_info['zone_id']),					 
					'atmosphere'  		=> $this->model_catalog_merchant->getMerchantAtmosphere($merchant_info['merchant_id']),
					'facilities' 		=> $this->model_catalog_merchant->getMerchantFacilities($merchant_info['merchant_id']),
					'spoken_language' 	=> $this->model_catalog_merchant->getMerchantSpokenLangauge($merchant_info['merchant_id']),
					'discount'    		=> $disc
				);
				
				
			
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
