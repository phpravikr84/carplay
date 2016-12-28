<?php
class ControllerWebserviceCategories extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('account/forgotten'); 

		$this->load->model('catalog/category');
		
		$json = array();
		$this->load->model('account/api');
		//$json['key']= $rest_var['key'];
                
                // Forget with API Key
		$api_info = $this->model_account_api->getApiByKey($this->request->request['key']);
		
		 
                
		//$headers = apache_request_headers();
		
		//print_r($headers);
		
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
                    
                
		if($api_info){ 
			
		  
			if (isset($this->request->get['path'])) {
				$parts = explode('_', (string)$this->request->get['path']);
	
				$category_id = (int)array_pop($parts);
	
				$json['categories']=$this->request->get['path'];
				
				if($category_id){
					 
					$data['categories'] = array();
	
					$results = $this->model_catalog_category->getCategories($category_id);
					
					foreach ($results as $result) {
		$filter_data = array(
			'filter_category_id'  => $result['category_id'],
			'filter_sub_category' => true
		);
						if ($result['image']) {
								$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
						} else {
								$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
						}
	
		$data['categories'][] = array(
			'name' => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
								'thumb'       => $image,
								'href' => $this->url->link('webservice/categories', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] )
		);
						
						 
					}
				} 
				
			}else{

				$categories= $this->model_catalog_category->getCategories(); 

				//print '<pre>';  print_r($categories);exit;

				foreach ($categories as $result) {
						if ($result['image']) {
								$image = $this->model_tool_image->resize($result['image'], $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
						} else {
								$image = $this->model_tool_image->resize('placeholder.png', $this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height'));
						}

						$data['categories'][] = array(
							'category_id'  => $result['category_id'],
							'thumb'       => $image,
							'name'        => $result['name'],
							'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
							'href'        => $this->url->link('webservice/category', '&path=' . $result['category_id'] )
						);
				}                   
			}
			
			$json['categories'] = $data['categories'];
			$json['status'] = '1';
			
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
