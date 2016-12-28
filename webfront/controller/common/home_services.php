<?php
class ControllerCommonHomeservices extends Controller {
	public function index($setting) {
		$this->load->language('module/featured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_featured_services'] = $this->language->get('text_featured_services');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

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

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);
			
			//print_r($products);exit;
			
			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);
                                
                //print_r($product_info);exit;
                                
				if ($product_info) {
					// if ($product_info['image'] && file_exists(DIR_IMAGE.$product_info['image'])) {
					// 	$image = $this->model_tool_image->resize($product_info['image'], 500,380);
					// } else {
					// 	$image = $this->model_tool_image->resize('placeholder.png', 550,350);
					// }

					if ($product_info['image']) {
						$image = $product_info['image'];
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', 550,350);
					}

					 $price=false;
                                        
					$merchants = $this->model_catalog_product->getMerchantsByProductsId($product_id, $city_id);
					
					//print '<pre>'; print_r($merchants);exit;
 
					$special = false;
					 

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					$data['products'][] = array(
						'product_id'  => $product_id,
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
						'price'       => $price,
						'rating'      => $rating, 
						'merchants'      => $merchants, 
						'booked'      => $product_info['booked'], 
						'viewed'      => $product_info['viewed'], 
						'href'        => $this->url->link('product/merchant', 'product_id=' . $product_id)
					);
				}
			}
		}

		if ($data['products']) {
			return $this->load->view('common/home_services', $data);
		}
	}

	public function get_services(){

		$this->load->model('extension/module');
                
        $module_id = 28;
                
        $setting= $this->model_extension_module->getModule($module_id);

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();
		
		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		

		$featuredservices = array();
		if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
		}else{
			$city_id = 10;	
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);
			
			//print_r($products);exit;
			
			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					
					if ($product_info['image']) {
						$image = $product_info['image'];
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', 550,350);
					}

					 $price=false;
                    $merchants = $this->model_catalog_product->getMerchantsByProductsId($product_id, $city_id);
 
					$special = false;
					 

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					$featuredservices[]=array(
						'product_id'  => $product_id,
						'thumb'       => $image,
						'name'        => html_entity_decode($product_info['name']),
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
						'price'       => $price,
						'rating'      => $rating, 
						'merchants'      => $merchants, 
						'booked'      => $product_info['booked'], 
						'viewed'      => $product_info['viewed'], 
						'href'        => html_entity_decode($this->url->link('product/merchant', 'product_id=' . $product_id))
					);
				}
			}
		}

			
			echo json_encode($featuredservices);
		

	}
}
