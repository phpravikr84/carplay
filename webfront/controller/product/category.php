<?php
class ControllerProductCategory extends Controller {
	public function index() {
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		$this->load->model('catalog/merchant');

		$this->load->model('tool/image');

		$text_bookingtime_slot = $this->language->get('text_bookingtime_slot');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = '';
		}

		$category_info = $this->model_catalog_category->getCategory($category_id);
		
		//print_r($category_info);exit;	
		
		$data['category_id'] = $category_id;

		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$data['heading_title'] = $category_info['name'];
			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = $this->url->link('product/compare');

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();

			$categories = $this->model_catalog_category->getCategories();
		
			//print "<pre>"; print_r($results); print "</pre>";
                        
			foreach ($categories as $category) {
			$children_data = array();
			
				 	
			
			//if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
					
					 

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'],
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}
			//}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'total_sub_categories' => count($children),
				'name'        => $category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
		}
                        
           // print "<pre>"; print_r($data['categories']); print "</pre>";

			$data['products'] = array();

			if(isset($this->request->get['filter_locationDate'])){
				$filter_locationDate = $this->request->get['filter_locationDate'];	
			}else{
				$filter_locationDate = date('Y-m-d');	
			}
			
			
			if(isset($this->session->data['city_id'])){
				$city_id = $this->session->data['city_id'];	
			}elseif(isset($this->request->get['city_id'])){
				$city_id = $this->request->get['city_id'];	
			}else{
				$city_id = 10;	
			} 
			
			if(isset($this->request->get['filter_peoples'])){
				$filter_peoples = $this->request->get['filter_peoples'];	
			}else{
				$filter_peoples = 1;	
			}
			
			if(isset($this->request->get['filter_locationTimeslot'])){
				$filter_locationTimeslot = $this->request->get['filter_locationTimeslot'];	
			}else{
				$filter_locationTimeslot = '';	
			}
			
			
			if(isset($this->request->get['filter_location_id'])){
				$filter_location_id = (int)$this->request->get['filter_location_id'];	
			} else{
				$filter_location_id = 0;
			}
			 
			
			if(isset($this->request->get['filter_atmoshhpier'])){
				$filter_atmoshhpier = $this->request->get['filter_atmoshhpier'];	
			} else{
				$filter_atmoshhpier = '';
			}
			
			if(isset($this->request->get['filter_spokenlanguage'])){
				$filter_spokenlanguage = $this->request->get['filter_spokenlanguage'];	
			} else{
				$filter_spokenlanguage = '';
			}
			
			if(isset($this->request->get['filter_facilities'])){
				$filter_facilities = $this->request->get['filter_facilities'];	
			} else{
				$filter_facilities = '';
			}

			if(isset($this->request->get['filter_rating'])){
				$filter_rating = $this->request->get['filter_rating'];	
			} else{
				$filter_rating = '';
			}
			
			/* $filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
               */         
			// if(isset($this->request->get['sort'])){
			// 	$sort = $this->request->get['sort'];
			// }else{
			// 	$sort = 'AZ';
			// }

			if(isset($this->request->get['sort'])){
				$sort = $this->request->get['sort'];
			}else{
				$sort = '';
			}
			
			$filter_data = array(
				'filter_category_id'  	=> $category_id,
				'filter_city_id' 		=> $city_id,
				'filter_atmoshhpier' 	=> $filter_atmoshhpier,
				'filter_spokenlanguage' => $filter_spokenlanguage,
				'filter_facilities' 		=> $filter_facilities,
				'filter_location_id' 	=> $filter_location_id,
				'filter_peoples' 		=> $filter_peoples,
				'filter_rating'			=> $filter_rating,
				'sort' 					=> $sort				
			);

			//$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$results = $this->model_catalog_merchant->getMerchantsByCategoryId($filter_data);
			
			// print '<pre>'.$category_id;; print_r($results);exit;
			
			$this->load->model('localisation/country');
			$this->load->model('localisation/zone');
			$this->load->model('localisation/city');
			$this->load->model('localisation/location');
			
			
			$data['merchants'] = array();	
			
			//print $filter_locationTimeslot;exit;
			
			$seconds = time();
						
			$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);
			
			//print date('h:i A', $rounded_seconds) ;exit;
			
			$count = 1;
					
			foreach ($results as $result) { //print DIR_IMAGE.$result['image'];
				
				// if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
				// 	$image = $this->model_tool_image->resize($result['image'], 500,380);
				// } else {
				// 	$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				// }

			if ($result['image']) {
					$image = $result['image'];
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				}
				
				 
				
				
				if($filter_locationDate== date('Y-m-d')){
			
					$discount = $this->model_catalog_merchant->getDiscounts($result['merchant_id'], date("Y-m-d H:i:s",strtotime($filter_locationDate." ".date('H:i:s')." +30 minutes")),200, $filter_peoples);
					
				}else{
					
					if($filter_locationTimeslot && $filter_locationTimeslot !='Time'){
						$date = $filter_locationDate .' '. $filter_locationTimeslot;
					}else{
					
						$date = $filter_locationDate. " 00:00";
					}
					
					//print $date;exit;
					
					$discount = $this->model_catalog_merchant->getDiscounts($result['merchant_id'], date("Y-m-d H:i:s",strtotime($date)),200, $filter_peoples);
				}
				
				//print date("Y-m-d h:i:s");print '<pre>'; print_r($discount);exit;
				
				 
				
				$recomonded_info = $this->model_catalog_merchant->getRecomondedProducts($result['merchant_id']);
					
					//print_r($recomonded_info);exit;
					
					$recomonded = array();
					if($recomonded_info){
						foreach ($recomonded_info as $recomond) {
							$recomonded[] = array(
								'name' 				=> $recomond['name'],
								'product_id' 		=> $recomond['product_id'],
								'duration'  		=> $recomond['duration'],
								// 'price'     		=> $this->currency->format(round($recomond['price']), $this->session->data['currency'])
								'price'     		=> $this->currency->getSymbolLeft($this->session->data['currency']).''.$this->currency->newformat(round($recomond['price']), $this->session->data['currency'])
							);
						}
					}
				
				//print_r($recomonded);exit;
				
				// if(count($discount) > 0){
				
					$data['merchants'][] = array(
						'merchant_id' 	=> $result['merchant_id'],
						'product_id'  	=> $result['product_id'],
						'thumb'       	=> $image,
						'name'        	=> $result['name'],
						'country'     	=> $this->model_localisation_country->getCountryName($result['country_id']),
						'zone'      	=> $this->model_localisation_zone->getZoneName($result['zone_id']),	
						'city'      	=> $this->model_localisation_city->getCityName($result['city_id']),	
						'location'      => $this->model_localisation_location->getLocationName($result['location_id']),	
						'rating'      	=> ($result['rating']+$result['rating'])*10,
						'reserved'    	=> $result['reserved'],
						'price_level' 	=> ($result['price_level']+$result['price_level'])*10,
						'rounded_seconds'=>date('h:i A', $rounded_seconds),
						'recomonded' 	=> $recomonded, 
						'discounts' 	=> $discount,
						'href'        	=> $this->url->link('product/merchantdetail', 'merchant_id=' . $result['merchant_id'] . $url)
					);
					
					$count = $count++;
					
				// }
				
			}
			
			$data['total_merchants'] =  $count;
			
			//print '<pre>'; print_r($data['merchants']);exit;

			//Location

			$this->load->model('catalog/category');
		
			$this->load->model('catalog/merchant');
		
			$this->load->model('localisation/location');

			if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
			}else{
			$city_id = 10;	
			}
        
			$locations =  $this->model_localisation_location->getLocationsByCityId($city_id);
			$data['locations'] = $locations;
			//print_r($locations);
			
			
			//Atmoshhpier
			$this->load->model('catalog/atmosphere');
			
			$atmoshhpier = $this->model_catalog_atmosphere->getAtmospheres();
			
			$data['atmoshhpiers'] = $atmoshhpier;
			
			//print '<pre>'.$category_id;; print_r($atmoshhpier);exit;
			
			//Spokenlanguage 
			$this->load->model('catalog/spokenlanguage ');
			
			$spokenlanguage = $this->model_catalog_spokenlanguage ->getSpokenlanguages();
			
			$data['spokenlanguages'] = $spokenlanguage;
			
			//Facilities 
			$this->load->model('catalog/facilities ');
			
			$facilities = $this->model_catalog_facilities->getFacilitiess();
			
			$data['facilities'] = $facilities;
			
			//print '<pre>'.$category_id;; print_r($facilities);exit;
			
			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			/*$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));
                        */    
			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			/*if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page + 1), true), 'next');
			}*/

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;
			$data['filter_atmoshhpier'] 		=$filter_atmoshhpier;
			$data['filter_location_id'] 	= $filter_location_id;
			$data['filter_spokenlanguage'] 		= $filter_spokenlanguage;
			$data['filter_facilities'] 		= $filter_facilities;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/category', $data));
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
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
				'href' => $this->url->link('product/category', $url)
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

			//$this->response->setOutput($this->load->view('error/not_found', $data));
            $this->response->setOutput($this->load->view('product/category', $data));
		}
	}

	 

	/* Home Search Begin */


	public function getMerchantByCategory(){

		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		$this->load->model('catalog/merchant');

		$this->load->model('tool/image');

		$merchant =  array();

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->config->get($this->config->get('config_theme') . '_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$category_id = 0;
		}

		$category_info = $this->model_catalog_category->getCategory($category_id);
		
		//print $category_id;exit;	
		
		$data['category_id'] = $category_id;

		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$data['heading_title'] = $category_info['name'];
			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
			} else {
				$data['thumb'] = '';
			}

			//$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			
			//$data['description'] = strip_tags($category_info['description']);

			$data['description'] = 'Riwigo';
			$data['compare'] = $this->url->link('product/compare');

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();

			$categories = $this->model_catalog_category->getCategories();
		
			//print "<pre>"; print_r($results); print "</pre>";
                        
			foreach ($categories as $category) {
			$children_data = array();
			
				 	
			
			//if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
					
					 

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' =>  html_entity_decode($child['name']),
						'href' =>  html_entity_decode($this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']))
					);
				}
			//}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'total_sub_categories' => count($children),
				'name'        =>  html_entity_decode($category['name']),
				'children'    => $children_data,
				'href'        =>  html_entity_decode($this->url->link('product/category', 'path=' . $category['category_id']))
			);
		}
                        
           // print "<pre>"; print_r($data['categories']); print "</pre>";

			$data['products'] = array();

			$filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
			
			if(isset($this->session->data['city_id'])){
				$city_id = $this->session->data['city_id'];	
			}elseif(isset($this->request->get['city_id'])){
				$city_id = $this->request->get['city_id'];	
			}else{
				$city_id = 10;	
			}
			
			if(isset($this->session->data['city_id'])){
				$city_id = $this->session->data['city_id'];	
			}elseif(isset($this->request->get['city_id'])){
				$city_id = $this->request->get['city_id'];	
			}else{
				$city_id = 10;	
			}
			
			if(isset($this->request->get['peoples'])){
				$peoples = $this->request->get['peoples'];	
			}else{
				$peoples = 2;	
			}
			
			if(isset($this->request->get['location_id'])){
				$filter_location_id = $this->request->get['location_id'];	
			} else{
				$filter_location_id = '';
			}
			
			 
			
			if(isset($this->request->get['filter_atmoshhpier'])){
				$filter_atmoshhpier = $this->request->get['filter_atmoshhpier'];	
			} else{
				$filter_atmoshhpier = '';
			}
			
			if(isset($this->request->get['filter_spokenlanguage'])){
				$filter_spokenlanguage = $this->request->get['filter_spokenlanguage'];	
			} else{
				$filter_spokenlanguage = '';
			}
			
			if(isset($this->request->get['filter_facilities'])){
				$filter_facilities = $this->request->get['filter_facilities'];	
			} else{
				$filter_facilities = '';
			}
			
			 
                        
			if(isset($this->request->get['sort'])){
				$sort = $this->request->get['sort'];
			}else{
				$sort = 'AZ';
			}
			
			$filter_data = array(
				'filter_category_id'  	=> $category_id,
				'filter_city_id' 		=> $city_id,
				'filter_atmoshhpier' 		=> $filter_atmoshhpier,
				'filter_spokenlanguage' 		=> $filter_spokenlanguage,
				'filter_facilities' 		=> $filter_facilities,
				'filter_location_id' 	=> $filter_location_id,
				'filter_peoples' 		=> $peoples,
				'sort' 					=> $sort				
			);

			//$product_total = $this->model_catalog_product->getTotalProducts($filter_data);

			$results = $this->model_catalog_merchant->getMerchantsByCategoryId($filter_data);
			
			//print '<pre>'.$category_id;; print_r($results);exit;
			
			$this->load->model('localisation/country');
			$this->load->model('localisation/zone');
			$this->load->model('localisation/city');
			$this->load->model('localisation/location');
			
			$data['total_merchants'] =  count($results);
			$data['merchants'] = array();	
			
		  
					
			foreach ($results as $result) { //print DIR_IMAGE.$result['image'];
				
				// if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
				// 	$image = $this->model_tool_image->resize($result['image'], 500,380);
				// } else {
				// 	$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				// }

			if ($result['image']) {
					$image = $result['image'];
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				}
				
				// $discount = $this->model_catalog_merchant->getDiscounts($result['merchant_id'], date("Y-m-d"));
				$discount = $this->model_catalog_merchant->getDiscounts($result['merchant_id'], date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +30 minutes")), 200);
				
				//q22print '<pre>'; print_r($discount);exit;
				
				$data['merchants'][] = array(
					'merchant_id' => $result['merchant_id'],
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'country'     => $this->model_localisation_country->getCountryName($result['country_id']),
					'zone'      	=> $this->model_localisation_zone->getZoneName($result['zone_id']),	
					'city'      	=> $this->model_localisation_city->getCityName($result['city_id']),	
					'location'      => $this->model_localisation_location->getLocationName($result['location_id']),	
					'rating'      	=> ($result['rating']+$result['rating'])*10,
					'reserved'    	=> $result['reserved'],
					'price_level' 	=> ($result['price_level']+$result['price_level'])*10,
					 
					'booktimenow' => $booktimenow,
					'discounts' 	=> $discount,
					'href'        	=>  html_entity_decode($this->url->link('product/merchantdetail', 'merchant_id=' . $result['merchant_id'] . $url))
				);
				
			}
			
			//print '<pre>'; print_r($data['merchants']);exit;


			$this->load->model('localisation/location');

			if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
			}else{
			$city_id = 10;	
			}
        
			$locations =  $this->model_localisation_location->getLocationsByCityId($city_id);
			$data['locations'] = $locations;
			
			
			//Atmoshhpier
			$this->load->model('catalog/atmosphere');
			
			$atmoshhpier = $this->model_catalog_atmosphere->getAtmospheres();
			
			$data['atmoshhpiers'] = $atmoshhpier;
			
			//print '<pre>'.$category_id;; print_r($atmoshhpier);exit;
			
			//Spokenlanguage 
			$this->load->model('catalog/spokenlanguage ');
			
			$spokenlanguage = $this->model_catalog_spokenlanguage ->getSpokenlanguages();
			
			$data['spokenlanguages'] = $spokenlanguage;
			
			//Facilities 
			$this->load->model('catalog/facilities ');
			
			$facilities = $this->model_catalog_facilities->getFacilitiess();
			
			$data['facilities'] = $facilities;
			
			//print '<pre>'.$category_id;; print_r($facilities);exit;
			
			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get($this->config->get('config_theme') . '_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			/*$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));
                        */    
			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'], true), 'prev');
			} else {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page - 1), true), 'prev');
			}

			/*if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/category', 'path=' . $category_info['category_id'] . '&page='. ($page + 1), true), 'next');
			}*/

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;
			$data['filter_atmoshhpier'] 		=$filter_atmoshhpier;
			$data['filter_spokenlanguage'] 		= $filter_spokenlanguage;
			$data['filter_facilities'] 		= $filter_facilities;

			

		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
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
				'href' => $this->url->link('product/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');


			
			
		}


		
			echo json_encode($data);

	}



}
