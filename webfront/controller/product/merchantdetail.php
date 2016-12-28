<?php
class ControllerProductMerchantdetail extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('product/merchant');
		$this->load->language('account/login');
		$this->load->model('catalog/category');
		$this->load->model('catalog/manufacturer');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('localisation/city');
		$this->load->model('localisation/location');
		
		if (isset($this->request->get['merchant_id'])) {
			$merchant_id = (int)$this->request->get['merchant_id'];
		} else {
			$merchant_id = 0;
		}
		 
		$data['bookingPerson'] = '1';
		$data['bookingProductId'] = '';
		$data['bookingDate'] = '';
		$data['bookingServices'] = '';
		$data['bookingDuration'] = '';
		$data['bookingPrice'] = '';
		$data['bookingDiscount'] = '';
		$data['bookingMerchantId'] = '';
		$data['bookingMerchantName'] = '';
		$data['bookingDiscountTime'] = '';
		
		
		$data['text_booktime_slot'] = $this->language->get('text_booktime_slot');
		$data['text_new_customer'] = $this->language->get('text_new_customer');
		$data['text_register'] = sprintf($this->language->get('text_register'), $this->url->link('account/register', '', true));        
        $data['text_dont_register'] = sprintf($this->language->get('text_dont_register'), $this->url->link('account/register', '', true));
                
		$data['text_register_account'] = $this->language->get('text_register_account');
		$data['text_returning_customer'] = $this->language->get('text_returning_customer');
		$data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
		$data['text_forgotten'] = sprintf($this->language->get('text_forgotten'), $this->url->link('account/forgotten', '', true));
		$data['text_login'] = $this->language->get('text_login');
		$data['text_login_fb'] = $this->language->get('text_login_fb');
		$data['text_login_gplus'] = $this->language->get('text_login_gplus');
		
		
		$data['text_login_head'] = $this->language->get('text_login_head');
                

		$data['entry_email'] = $this->language->get('entry_email');
		$data['redirect'] = $this->url->link('product/merchantdetail', 'merchant_id=' . $merchant_id);
		$data['entry_password'] = $this->language->get('entry_password');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_login'] = $this->language->get('button_login');

		 
		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}
		
		
			if(isset($this->request->get['filter_date'])){
				$filter_date = $this->request->get['filter_date'];	
			}else{
				$filter_date = date('Y-m-d');	
			}
			
			
		 
			if(isset($this->request->get['filter_peoples'])){
				$filter_peoples = $this->request->get['filter_peoples'];	
			}else{
				$filter_peoples = 1;	
			}
			
			if(isset($this->request->get['filter_time_slot'])){
				$filter_time_slot = $this->request->get['filter_time_slot'];	
			}else{
				$filter_time_slot = '';	
			} 
			
		$date['merchant_id']=$merchant_id;

		$this->load->model('catalog/merchant');
		
		//Service Related
		$filter_data = array(
			'filter_merchant_id'  => $merchant_id,
			'start'        => 0,
			'limit'        => 50
		);
		
		$data['merchant_recomanded'] = $this->model_catalog_merchant->getServiceRecomanded($filter_data);

		$merchant_services = $this->model_catalog_merchant->getAllProductsByMerchantId($merchant_id); //print_R($data['merchant_services']);exit;
		
		$data['merchant_services'] = array();
		if($merchant_services){
			foreach ($merchant_services as $recomond) {
				$data['merchant_services'][] = array(
					'merchant_id'		=> $merchant_id,
					'name' 				=> $recomond['name'],
					'product_id' 		=> $recomond['product_id'],
					'duration'  		=> $recomond['duration'],
					'price'  			=> $recomond['price'],
					// 'amount'     		=> $this->currency->format(round($recomond['price']), $this->session->data['currency'])
					'amount'     		=> $this->currency->getSymbolLeft($this->session->data['currency']).''.$this->currency->newformat(round($recomond['price']), $this->session->data['currency'])
				);
			}
		}
		
		
		if($filter_date== date('Y-m-d')){
			
			$discount = $this->model_catalog_merchant->getDiscounts($merchant_id, date("Y-m-d H:i:s",strtotime($filter_date." ".date('H:i:s')." +30 minutes")),200, $filter_peoples);
					
					
			//print date("Y-m-d h:i:s");print '<pre>'; print_r($discount);exit;
		}else{
					
			if($filter_time_slot && $filter_time_slot !='Time'){
				$date = $filter_date .' '. $filter_time_slot;
			}else{
			
				$date = $filter_date. " 00:00";
			}
			
			//print $date;exit;
			
			$discount = $this->model_catalog_merchant->getDiscounts($merchant_id, date("Y-m-d H:i:s",strtotime($date)),200, $filter_peoples);
		}
				
				//print date("Y-m-d h:i:s");print '<pre>'; print_r($discount);exit;
				
		

		$data['discounts'] = $discount;
		//print_r($data['discounts']);exit;		
		//print  strtolower(date('D')) .'<pre>'; print_r($data['discounts']);exit;
		//date_default_timezone_set("Asia/Kolkata"); 
		
		$seconds = time();
		
		$data['rounded_seconds'] =date('h:i A', round($seconds / (30 * 60)) * (30 * 60));
		 
		$merchant_info = $this->model_catalog_merchant->getMerchant($merchant_id);
		
		//print '<pre>'; print_r($data['discounts']);exit;

		if ($merchant_info) {
			$url = '';
			$this->document->setTitle($merchant_info['meta_title']);
			$this->document->setDescription($merchant_info['meta_description']);
			$this->document->setKeywords($merchant_info['meta_keyword']);
		 

			$data['heading_title'] = $merchant_info['name'];

			$data['text_select'] = $this->language->get('text_select');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_stock'] = $this->language->get('text_stock');
			$data['text_discount'] = $this->language->get('text_discount');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_option'] = $this->language->get('text_option');
			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $merchant_info['minimum']);
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_tags'] = $this->language->get('text_tags');
			$data['text_related'] = $this->language->get('text_related');
			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_qty'] = $this->language->get('entry_qty');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_review'] = $this->language->get('entry_review');
			$data['entry_rating'] = $this->language->get('entry_rating');
			$data['entry_good'] = $this->language->get('entry_good');
			$data['entry_bad'] = $this->language->get('entry_bad');
			$data['entry_about'] = $this->language->get('entry_about');
			$data['entry_address'] = $this->language->get('entry_address');
			$data['entry_atmosphere'] = $this->language->get('entry_atmosphere');
			
			$data['entry_facilities'] = $this->language->get('entry_facilities');
			$data['entry_spoken_language'] = $this->language->get('entry_spoken_language');
			$data['entry_opening_time'] = $this->language->get('entry_opening_time');
			

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_upload'] = $this->language->get('button_upload');
			$data['button_continue'] = $this->language->get('button_continue');

			$this->load->model('catalog/review');

			$data['tab_detail'] = $this->language->get('tab_detail');
			$data['tab_attribute'] = $this->language->get('tab_attribute');
			$data['tab_recommanded'] = $this->language->get('tab_recommanded'); 
			
			//$data['tab_review'] = sprintf($this->language->get('tab_review'), $merchant_info['reviews']);
			
			

			$data['merchant_id'] = (int)$this->request->get['merchant_id'];
			
			$data['name'] = $merchant_info['name'];
			$data['address'] = $merchant_info['address'];
			$data['loged'] = $this->customer->isLogged();
			
			
			$symbal = $this->currency->getSymbolLeft($this->session->data['currency']);
			
			
			if($this->customer->isLogged()) {  
				$data['customerName'] = $this->customer->getFirstName();
				$data['customerEmail'] = $this->customer->getEmail();
				$data['customerMobile'] = $this->customer->getMobile();
				
				if(isset($this->session->data['confirmOrder']['bookingMerchantId']) && $this->session->data['confirmOrder']['bookingMerchantId'] == $merchant_id){
					$data['bookingPerson'] = $this->session->data['confirmOrder']['bookingPerson'];
					$data['bookingProductId'] = $this->session->data['confirmOrder']['product_id'];
					$data['bookingDate'] = $this->session->data['confirmOrder']['bookingDate'];
					$data['bookingServices'] = $this->session->data['confirmOrder']['bookingServices'];
					$data['bookingDuration'] = $this->session->data['confirmOrder']['bookingDuration'];
					
					$data['bookingPrice'] = str_replace($symbal, '',$this->currency->format(round($this->session->data['confirmOrder']['bookingPrice']), $this->session->data['currency']));
					
					$data['bookingDiscount'] = $this->session->data['confirmOrder']['bookingDiscount'];
					$data['bookingMerchantId'] = $this->session->data['confirmOrder']['bookingMerchantId'];
					$data['bookingMerchantName'] = $this->session->data['confirmOrder']['bookingMerchantName'];
					$data['bookingDiscountTime'] = $this->session->data['confirmOrder']['bookingDiscountTime'];
				
				}else{
					$data['bookingPerson'] = '1';
					$data['bookingProductId'] = '';
					$data['bookingDate'] = '';
					$data['bookingServices'] = '';
					$data['bookingDuration'] = '';
					$data['bookingPrice'] = '';
					$data['bookingDiscount'] = '';
					$data['bookingMerchantId'] = '';
					$data['bookingMerchantName'] = '';
					$data['bookingDiscountTime'] = '';
				
				}
				
				//print $data['bookingPerson'];exit;
				
			}else{
				$data['customerName'] = '';
				$data['customerEmail'] = '';
				$data['customerMobile'] = '';
			}
			
			if(isset($this->request->get['product_id'])){
				$product_info = $this->model_catalog_merchant->getProductByMerchantID($this->request->get['merchant_id'],$this->request->get['product_id']);
				//print '<pre>';print_r($product_info); 
				$data['bookingProductId'] = $this->request->get['product_id']; 
				$data['bookingServices'] = $product_info['name'];
				$data['bookingDuration'] = $product_info['duration']; 
				$data['bookingMerchantId'] = $this->request->get['merchant_id'];
				$data['bookingPrice'] = str_replace($symbal, '',$this->currency->format(round($product_info['price']), $this->session->data['currency']));
			
			}
			
			if(isset($this->request->get['filter_peoples'])){
				$data['bookingPerson'] = $this->request->get['filter_peoples'];
			}
			if(isset($this->request->get['filter_date'])){
				$data['bookingDate'] = date('Y-m-d',strtotime($this->request->get['filter_date']));
			}
			
			 
						
			$data['location'] =  $this->model_localisation_location->getLocationName($merchant_info['location_id']);
			$data['city'] = $this->model_localisation_city->getCityName($merchant_info['city_id']);
			$data['zone'] = $this->model_localisation_zone->getZoneName($merchant_info['zone_id']);
			$data['country'] = $this->model_localisation_country->getCountryName($merchant_info['country_id']);
			$data['zip'] = $merchant_info['zip'];
			$data['phone'] = $merchant_info['phone'];
			$data['mobile'] = $merchant_info['mobile'];
			$data['email'] = $merchant_info['email'];
			$data['website'] = $merchant_info['website'];
			$data['contact_person'] = $merchant_info['contact_person'];
			$data['contact_person_position'] = $merchant_info['contact_person_position'];
			$data['viewed'] = $merchant_info['viewed'];
			$data['reserved'] = $merchant_info['reserved'];
			$data['price_level'] = ($merchant_info['price_level']+$merchant_info['price_level'])*10;
			$data['from_opeining_hours'] = $merchant_info['from_opeining_hours'];
			$data['to_opening_hours'] = $merchant_info['to_opening_hours'];
			$data['latitude'] = $merchant_info['latitude'];
			$data['longitude'] = $merchant_info['longitude'];
			$data['no_of_staff'] = $merchant_info['no_of_staff'];
			$data['capacity'] = $merchant_info['capacity'];
			$data['rating'] = ($merchant_info['rating']+$merchant_info['rating'])*10; 
			$data['arating'] = $merchant_info['rating']; 
			$data['reserved'] = $merchant_info['reserved']; 
			$data['description'] = html_entity_decode($merchant_info['description'], ENT_QUOTES, 'UTF-8');
			$data['terms'] = html_entity_decode($merchant_info['terms'], ENT_QUOTES, 'UTF-8');
			
			$data['atmosphere'] =$this->model_catalog_merchant->getMerchantAtmosphere($this->request->get['merchant_id']);
			
			$data['facilities'] =$this->model_catalog_merchant->getMerchantFacilities($this->request->get['merchant_id']);
			
			$data['spoken_language'] =$this->model_catalog_merchant->getMerchantSpokenLangauge($this->request->get['merchant_id']);
			
			//print_r($data['facilities']);exit;
			 
			$this->load->model('tool/image');

			// if ($merchant_info['image'] && file_exists(DIR_IMAGE.$merchant_info['image'])) {
			// 	$data['popup'] = $this->model_tool_image->resize($merchant_info['image'],500,380);
			// } else {
			// 	$data['popup'] = $this->model_tool_image->resize('placeholder.png', 500,380);;
			// }

			// if ($merchant_info['image'] && file_exists(DIR_IMAGE.$merchant_info['image'])) {
			// 	$data['firstImage'] = $this->model_tool_image->resize($merchant_info['image'],1024,750);
			// } else {
			// 	$data['firstImage'] = $this->model_tool_image->resize('placeholder.png', 500,380);;
			// }

			if (isset($merchant_info['image'])) {
				$data['popup'] = $merchant_info['image'];
			} else {
				$data['popup'] = 'http://qa.riwigo.com/image/cache/placeholder-500x380.png';
			}

			if (isset($merchant_info['image'])) {
				$data['firstImage'] = $merchant_info['image'];
			} else {
				$data['firstImage'] = 'http://qa.riwigo.com/image/cache/placeholder-500x380.png';
			}

			$data['images'] = array();

			$results = $this->model_catalog_merchant->getMerchantImages($this->request->get['merchant_id']);

			foreach ($results as $result) {
				if (isset($result['image'])) {
					
					$data['images'][] = array(
						// 'popup' => $result['image'],
						// 'thumb' => $result['image'],
						'popup' => $result['image'],
						'thumb' => $result['image']
					);
				}else{
					$data['images'][] = array(
						'popup' => 'http://qa.riwigo.com/image/cache/placeholder-500x380.png',
						'thumb' => 'http://qa.riwigo.com/image/cache/placeholder-500x380.png'
					);
				
				}
			}

			$data['images'] = array();

			$results = $this->model_catalog_merchant->getMerchantImages($this->request->get['merchant_id']);

			foreach ($results as $result) {
				// if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
				// 	$data['images'][] = array(
				// 		'popup' => $this->model_tool_image->resize($result['image'], 500,380),
				// 		'thumb' => $this->model_tool_image->resize($result['image'], 1024,750)
				// 	);
				// }else{
				// 	$data['images'][] = array(
				// 		'popup' => $this->model_tool_image->resize('placeholder.png', 500,380),
				// 		'thumb' => $this->model_tool_image->resize('placeholder.png', 1024,750)
				// 	);
				
				// }


				if (isset($result['image'])) {

					
					$data['images'][] = array(
						'popup' => $result['image'],
						'thumb' => $result['image']
					);
				}else{
					$data['images'][] = array(
						'popup' => 'http://qa.riwigo.com/image/cache/placeholder-500x380.png',
						'thumb' => 'http://qa.riwigo.com/image/cache/placeholder-500x380.png'
					);
				
				}

			}
			
			$product_info = $this->model_catalog_merchant->getAllProductsByMerchantId($merchant_id);
			
			
			foreach ($product_info as $result) {
						// if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
						// 		$image = $this->model_tool_image->resize($result['image'], 500, 308);
						// 	} else {
						// 		$image = $this->model_tool_image->resize('placeholder.png', 500, 308);
						// }

							if (isset($result['image'])) {
								$image = $result['image'];
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', 500, 308);
						}
		
						$discount = $this->model_catalog_merchant->getDiscountsByProduct_id($result['product_id'], $merchant_id);
						
						$seconds = time();
						
						$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);						
						 
						$json['services'][] = array(
							'service_id'  		=> $result['product_id'], 
							'name'  		    => $result['name'],
							'thumb'       		=> $image,
							'price'       		=> $result['price'],
							'duration'          => $result['duration'],
							'name'        		=> $result['name'],
							'product_desc'      => $result['product_desc'],
							'description' 		=> strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')) ,
							'viewed'       		=> $result['viewed']
							//'discount'    		=> $discount
						);
					}
			
			//print '<pre>'; print_r($product_info);exit;
			
			//print $data['bookingPrice'];exit;
			 

			$this->model_catalog_merchant->updateViewed($this->request->get['merchant_id']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/merchantdetail', $data));
			
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');



			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		$data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		$this->response->setOutput($this->load->view('product/review', $data));
	}

	 public function disc() {
		
		$this->load->model('catalog/merchant');
		//print '<pre>'; print_r($this->request->post);exit;	 
		//Service Related
		$filter_data = array(
			'filter_merchant_id'  => $this->request->post['merchant_id'],
			'start'        => 0,
			'limit'        => 50
		);
		
		$results = $this->model_catalog_merchant->getServiceRecomanded($filter_data);	
		
		//print '<pre>'; print_r($results); exit;
		
		$html ='';
		foreach ($results as $result) {
			
			$discount = $result["price"]-(($result["price"] * $this->request->post['recService'])/100);
			
			 $html .= '<tr><td>'.$result["name"].'</td><td>'.round($result["duration"]).'</td><td>'.round($result["price"]).'</td><td>'.round($discount).'</td></tr>';
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($html));
		
		 
	 }
	 
	 public function order() {
		
		$this->load->language('extension/total/coupon');
		$this->load->language('product/merchant');
		$this->load->model('localisation/city');
		$this->load->model('account/customer');
		//print '<pre>'; print_r($this->request->post);exit;
		
		$json = array();

		if ((utf8_strlen(trim($this->request->post['bookingDate'])) ==0) || (utf8_strlen(trim($this->request->post['bookingDate'])) > 11)) {
        	$json['bookingDate'] = $this->language->get('error_bookingDate');
        }
		
		if ((utf8_strlen(trim($this->request->post['bookingPerson'])) == 0)) {
        	$json['bookingPerson'] = $this->language->get('error_bookingPerson');
        }
		
		if ((utf8_strlen(trim($this->request->post['bookingServices'])) == 0)) {
        	$json['bookingServices'] = $this->language->get('error_bookingServices');
        }
		
		if ((utf8_strlen(trim($this->request->post['customerName'])) == 0)) {
        	$json['customerName'] = $this->language->get('error_customerName');
        }
		
		if((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$json['email'] = $this->language->get('error_email');
		}elseif($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])==1) {
			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

			$this->customer->login($this->request->post['email'], '', true);

			unset($this->session->data['guest']);

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->request->post['customerName']
			);

			$this->model_account_activity->addActivity('register', $activity_data);
			
		}elseif($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])==0) {
			
			$customer_name = explode(" ", $this->request->post['customerName']);
			
			$data['firstname'] = isset($customer_name[0]) ? $customer_name[0] : '';
			$data['lastname'] = isset($customer_name[1]) ? $customer_name[1] : '';
			$data['password'] = 'reset123';
			$data['email'] = $this->request->post['email'];
			$data['mobile'] = $this->request->post['mobile'];
			$data['telephone'] = $this->request->post['mobile'];
			$data['mobile'] = $this->request->post['mobile'];
			       
			$customer_id = $this->model_account_customer->addCustomer($data);
			
			$this->customer->login($this->request->post['email'], '', true);

			unset($this->session->data['guest']);

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->request->post['customerName']
			);

			$this->model_account_activity->addActivity('register', $activity_data);
		
		}
		
		//print '<pre>'; print_r($json); exit;
		
		if ((utf8_strlen(trim($this->request->post['mobile'])) == 0) || $this->request->post['mobile'] == 0 || $this->request->post['mobile'] == '') {
        	
			$json['mobile'] = $this->language->get('error_mobile');
        
		}elseif ($this->model_account_customer->getTotalCustomersByMobile($this->request->post['mobile'])==0 ) {
		
				if($this->request->post['mobile'] != $this->customer->getMobile()){
			
					$mobile = $this->model_account_customer->editMobile($this->request->post['mobile']);
					 
		
					unset($this->session->data['guest']);
		
					// Add to activity log
					$this->load->model('account/activity');
		
					$activity_data = array(
						'customer_id' =>  $this->customer->getId(),
						'mobile'        => $this->request->post['mobile'] 
					);
		
					$this->model_account_activity->addActivity('update mobile', $activity_data);	
			
				}else{
					
					$json['mobile'] = 'This mobile already used by another user123';
				
				}
				
		}
			
		
		if ((utf8_strlen(trim($this->request->post['bookingDiscount'])) == 0)) {
        	$json['bookingDiscount'] = $this->language->get('error_bookingDiscount');
        }
		
		
		if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email']) == 0) {
            
			$customer_name = explode(" ", $this->request->post['customerName']);
			
			$data['firstname'] = $customer_name[0];
			$data['lastname'] = $customer_name[1];
			$data['password'] = 'reset123';
			$data['email'] = $this->request->post['email'];
			$data['mobile'] = $this->request->post['mobile'];
			$data['telephone'] = $this->request->post['mobile'];
			$data['mobile'] = $this->request->post['mobile'];
			
			        
			$customer_id = $this->model_account_customer->addCustomer($data);
			

			// Clear any previous login attempts for unregistered accounts.
			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

			$this->customer->login($this->request->post['email'], '', true);

			unset($this->session->data['guest']);

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $customer_id,
				'name'        => $this->request->post['firstname'] . ' ' . $this->request->post['lastname']
			);

			$this->model_account_activity->addActivity('register', $activity_data);
        
		}
		
		
		
		
		
		if(!$json){
			
			$this->session->data['confirmOrder']['bookingDate']=$this->request->post['bookingDate'];
			$this->session->data['confirmOrder']['product_id']=$this->request->post['bookingProductId'];
			$this->session->data['confirmOrder']['bookingPerson']=$this->request->post['bookingPerson'];
			$this->session->data['confirmOrder']['bookingServices']=$this->request->post['bookingServices'];
			$this->session->data['confirmOrder']['bookingDuration']=$this->request->post['bookingDuration'];
			$this->session->data['confirmOrder']['bookingDiscount']=$this->request->post['bookingDiscount'];
			$this->session->data['confirmOrder']['bookingDisocuntId']=$this->request->post['bookingDisocuntId'];
			
			$this->session->data['confirmOrder']['bookingDiscountAmount']=(($this->request->post['bookingVlaue']*$this->request->post['bookingDiscount'])/100);
			$this->session->data['confirmOrder']['subtotal']=$this->request->post['bookingVlaue'];
			$this->session->data['confirmOrder']['bookingPrice']= ($this->request->post['bookingVlaue']-(($this->request->post['bookingVlaue']*$this->request->post['bookingDiscount'])/100));
			$this->session->data['confirmOrder']['bookingMerchantId']=$this->request->post['bookingMerchantId'];
			$this->session->data['confirmOrder']['bookingMerchantName']=$this->request->post['bookingMerchantName']; 
			$this->session->data['confirmOrder']['bookingDiscountTime']=$this->request->post['bookingDiscountTime'];
			$this->session->data['confirmOrder']['bookingCountryId']=$this->model_localisation_city->getCountryByCityId($this->session->data['city_id']);  			$this->session->data['confirmOrder']['bookingActualPrice']= $this->request->post['bookingPrice'];
			
			//$this->session->data['payment_method']['code'] == 'cod';
			$json['redirect'] = $this->url->link('checkout/confirm');
		}
		
		//======================== Coupan ===============================================

		/*$this->load->model('total/coupon');
		
		if (isset($this->request->post['coupon'])) {
			$coupon = $this->request->post['coupon'];
		} else {
			$coupon = '';
		}

		$coupon_info = $this->model_total_coupon->getCoupon($coupon);

		if (empty($this->request->post['coupon'])) {
			$json['error'] = $this->language->get('error_empty');

			unset($this->session->data['coupon']);
		} elseif ($coupon_info) {
			$this->session->data['coupon'] = $this->request->post['coupon'];

			$this->session->data['success'] = $this->language->get('text_success');

			$json['redirect'] = $this->url->link('checkout/cart');
		} else {
			$json['error'] = $this->language->get('error_coupon');
		}*/

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	/*Ge Discont Wise*/
	
	public function getDisocunt(){
		
		$this->load->model('catalog/merchant');
		//print_r($this->request->post);exit;
		//print date("Y-m-d H:i:s",strtotime($this->request->post['bookingDate']." ".date('H:i:s')." +30 minutes"));
		
		$json['success'] = 'Success'; 
		
		if($this->request->post['bookingDate'] == date('Y-m-d')){
			
			$discounts = $this->model_catalog_merchant->getDiscounts($this->request->get['merchant_id'], date("Y-m-d H:i:s",strtotime($this->request->post['bookingDate']." ".date('H:i:s')." +30 minutes")),200, $this->request->post['bookingPerson']);
			
		}else{
			
			$discounts = $this->model_catalog_merchant->getDiscounts($this->request->get['merchant_id'], date("Y-m-d H:i:s",strtotime($this->request->post['bookingDate'])),200, $this->request->post['bookingPerson']);
		}
		//print '<pre>'; print_r($data['discounts'] );exit;	
		$disc='';
		$disc = '<div class="swiper-wrapper column">';
		foreach ($discounts as $discount){
			
			if($this->request->post['bookingPerson'] <= ($discount['seats'] - $discount['used_seats'])){	
				$disc.=" <a href='javascript:void(0)' id='slottoday".$discount['merchant_disc_id']."' title='offer' class='swiper-slide red-slide' onClick='selectDiscountToday(".$discount['merchant_disc_id'].")'><p id='todaydiscT".$discount['merchant_disc_id']."'>".$discount['start_time']."</p><b id='todaydiscP".$discount['merchant_disc_id']."'>".$discount['discount']."%</b><p>off</p></a>";
			}
		}
		$disc.= '</div>';
		
		$json['discountdata'] = $disc;
		
		$bookPrice = str_replace(',', '', $this->request->post['bookingPrice']);
		
		$json['price'] = (int)$this->request->post['bookingPerson'] * (int)$bookPrice;
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
