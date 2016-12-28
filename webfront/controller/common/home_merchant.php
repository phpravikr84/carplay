<?php
class ControllerCommonHomeMerchant extends Controller {
	public function index($setting) {
		$this->load->language('module/featured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_featured_services'] = $this->language->get('text_featured_services');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/merchant');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('localisation/city');
		$this->load->model('localisation/location');
		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		
		if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
		}else{
			$city_id = 10;	
		}
		
		//print '<pre>'; print_r($setting);exit;
		$data['merchants'] = array();
		if (!empty($setting['merchant'])) {
			//$merchants = array_slice($setting['merchant'], 0, (int)$setting['limit']);
			
			//print_r($merchants);exit;
			
			foreach ($setting['merchant'] as $merchant_id) { //print $merchant_id;
				
				$filter_data = array('filter_merchant_id' => $merchant_id, 'filter_city_id' => $city_id);
				
				$merchant_info = $this->model_catalog_merchant->getPopularMerchant($filter_data);
                                
              //print "<pre>"; print_r($merchant_info);
                                
				if ($merchant_info) {
					// if ($merchant_info['image'] && file_exists(DIR_IMAGE.$merchant_info['image'])) {
					// 	$image = $this->model_tool_image->resize($merchant_info['image'], 500,380);
					// } else {
					// 	$image = $this->model_tool_image->resize('placeholder.png', 550,350);
					// }

					if ($merchant_info['image']) {
						$image = $merchant_info['image'];
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', 550,350);
					}

					 $price=false;
                                        
					//$merchants = $this->model_catalog_product->getMerchantsByProductsId($product_id, $city_id);
					
					///print '<pre>'; print_r($merchants);exit;
					 
					//print date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes"));
 
					$special = false;
					
					$discount = $this->model_catalog_merchant->getDiscounts($merchant_info['merchant_id'], date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes")), 200);
				
					$recomonded_info = $this->model_catalog_merchant->getRecomondedProducts($merchant_info['merchant_id']);
					
					//print_r($discount);exit;
					
					$recomonded = array();
					if($recomonded_info){
						foreach ($recomonded_info as $recomond) {
							$recomonded[] = array(
								'name' 				=> $recomond['name'],
								'product_id' 		=> $recomond['product_id'],
								'duration'  		=> $recomond['duration'],
								'price'     		=> $this->currency->getSymbolLeft($this->session->data['currency']).''.$this->currency->newformat(round($recomond['price']), $this->session->data['currency'])
							);
						}
					}
					
					//print '<pre>'; print_r($discount);exit;

					if ($this->config->get('config_review_status')) {
						$rating = $merchant_info['rating'];
					} else {
						$rating = false;
					}

					$data['merchants'][] = array(
					'merchant_id' 	=> $merchant_info['merchant_id'],
					'thumb'       	=> $image,
					'name'        	=> $merchant_info['name'],
					'country'     	=> $this->model_localisation_country->getCountryName($merchant_info['country_id']),
					'zone'      	=> $this->model_localisation_zone->getZoneName($merchant_info['zone_id']),	
					'city'      	=> $this->model_localisation_city->getCityName($merchant_info['city_id']),	
					'location'      => $this->model_localisation_location->getLocationName($merchant_info['location_id']),	
					'rating'      	=> ($merchant_info['rating']+$merchant_info['rating'])*10,
					'reserved'    	=> $merchant_info['reserved'],
					'price_level' 	=> ($merchant_info['price_level']+$merchant_info['price_level'])*10, 
					'recomonded' 	=> $recomonded, 
					'discounts' 	=> $discount,
					'href'        	=> $this->url->link('product/merchantdetail', 'merchant_id=' . $merchant_info['merchant_id'] )
				);
				}
			}
		}
		
		//print_r($data['merchants']);
 
		if ($data['merchants']) {
			return $this->load->view('common/home_merchant', $data);
		}
	}
}
