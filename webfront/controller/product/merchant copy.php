<?php
class ControllerProductMerchant extends Controller {
	public function index() {
		
		//$this->document->setTitle($merchant_info['meta_title']);
		//$this->document->setDescription($merchant_info['meta_description']);
		//$this->document->setKeywords($merchant_info['meta_keyword']);
		//$data['heading_title'] = $merchant_info['name'];
		
		$this->load->language('product/category');

		$this->load->model('catalog/merchant');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		
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
		
		$data['allService'] = $this->model_catalog_merchant->getServicesMerchantWise();
		
		//print '<pre>'; print_r($allService);exit;
		
		//$data['allService'] = count($allService);
		if(isset($this->request->get['product_id'])){
			$product_id = $this->request->get['product_id'];
		}else{
			$product_id = 0;
		}
		
		$data['product_id'] = $product_id;
		
		$data['merchants'] = array();	
		$filter_data = array(
				'filter_product_id' => $product_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
		 
		$merchant_info = $this->model_catalog_merchant->getMerchantsByProuctId($product_id);	
		
		$data['total_merchant'] = count($merchant_info);
		
		if ($merchant_info) {
			
            
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

			$this->load->model('localisation/country');
			$this->load->model('localisation/zone');
 			//print '<pre>'; print_r($merchant_info);exit;
			
			date_default_timezone_set("Asia/Kolkata"); 
			
			foreach ($merchant_info as $merchant) {
				
				if ($merchant['image']) {
					$image = $this->model_tool_image->resize($merchant['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));
				}

				$discount = $this->model_catalog_merchant->getDiscounts($merchant['merchant_id'], date('Y-m-d'),3);
				
				//print  strtolower(date('D')) .'<pre>'; print_r($discount);exit;
				
				$seconds = time();
				$rounded_seconds = round($seconds / (30 * 60)) * (30 * 60);
				
				//echo "Original: " . date('h:i', $seconds) . "\n";
				//echo "Rounded: " . date('h:i A', $rounded_seconds) . "\n";
				
				//$rounded_seconds = strtotime($rounded_seconds);
				
				$data['merchants'][] = array(
					'merchant_id'  		=> $merchant['merchant_id'],
					'thumb'       		=> $image,
					'round_time'    	=> date('h:i A', $rounded_seconds),
					'discount'    		=> $discount,
					'day'    			=> strtolower(date('D')).'_percentage',
					'name'        		=> $merchant['name'],
					'description' 		=> utf8_substr(strip_tags(html_entity_decode($merchant['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'viewed'       		=> $merchant['viewed'],
					'reserved'     		=> $merchant['reserved'],
					'price_level'     	=> ($merchant['price_level']+$merchant['price_level'])*10,
					'rating'     		=> ($merchant['rating']+$merchant['rating'])*10,
					'country'      		=> $this->model_localisation_country->getCountryName($merchant['country_id']),
					'zone'      		=> $this->model_localisation_zone->getZoneName($merchant['zone_id']),					 
					'href'         		=> $this->url->link('product/merchantdetail',   '&merchant_id=' . $merchant['merchant_id'] . $url)
				);
			}
			
			//print '<pre>'; print_r($data['merchants']);exit;

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
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . '&sort=p.model&order=DESC' . $url)
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
					'href'  => $this->url->link('product/merchant', 'product_id=' . $this->request->get['product_id'] . $url . '&limit=' . $value)
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
			$pagination->url = $this->url->link('product/category', 'product_id=' . $this->request->get['product_id'] . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));
                        */    
			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			   // $this->document->addLink($this->url->link('product/merchant', 'product_id=' . $merchant_info['product_id'], true), 'canonical');
			} elseif ($page == 2) {
			    //$this->document->addLink($this->url->link('product/merchant', 'product_id=' . $merchant_info['product_id'], true), 'prev');
			} else {
			    //$this->document->addLink($this->url->link('product/merchant', 'product_id=' . $merchant_info['product_id'] . '&page='. ($page - 1), true), 'prev');
			}

			/*if ($limit && ceil($product_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('product/category', 'product_id=' . $merchant_info['category_id'] . '&page='. ($page + 1), true), 'next');
			}*/

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/merchant', $data));
		} else {
			$url = '';

			if (isset($this->request->get['product_id'])) {
				$url .= '&product_id=' . $this->request->get['product_id'];
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
            $this->response->setOutput($this->load->view('product/merchant', $data));
		}
	}
}
