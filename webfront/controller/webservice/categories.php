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
		
		$rest_json = file_get_contents("php://input");
		$rest_var = json_decode($rest_json, true);
                
		//$headers = apache_request_headers();
		//print_r($headers);
		
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('catalog/merchant');
		$this->load->model('tool/image');
         
		if(isset($this->request->get['city_id'])){
			 $city_id = $this->request->get['city_id'];
		}else{
			$city_id = 10;
		}
		            
                
		if($api_info){ 
			
		  
			if (isset($this->request->get['path'])) { 
				$parts = explode('_', (string)$this->request->get['path']);
	
				$category_id = (int)array_pop($parts);
	
				//$json['categories']=$this->request->get['path'];
				
				if($category_id){
					 
					$data['categories'] = array();
	
					$results = $this->model_catalog_category->getCategories($category_id);
					
					foreach ($results as $result) { 
						$filter_data = array(
							'filter_category_id'  => $result['category_id'],
							'filter_sub_category' => true
						);
						if ($result['image']) {
								$image = $this->model_tool_image->resize($result['image'], 500,380);
						} else {
								$image = $this->model_tool_image->resize('placeholder.png', 500,380);
						}
	
						$data['categories'][] = array(
							'category_id'  => $result['category_id'],
							'name' => (strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))),
							'description' 		=> strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')),
							'thumb'       => $image,
							'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($result['category_id'],$city_id),
							'path' => $this->request->get['path'] . '_' . $result['category_id'],
						);
										
						 
					}
				} 
				
			}else{

				$categories= $this->model_catalog_category->getCategories(); 

				//print '<pre>';  print_r($categories);exit;

				foreach ($categories as $result) { 
				
						$results = $this->model_catalog_category->getCategories($result['category_id']);
						
						$parent_category_id = $result['category_id'];
						
						if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
								$image = $this->model_tool_image->resize($result['image'], 500,380);
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', 500,380);
							}
		
						
						$data['categoriesp'][] = array(
								'category_id'  => $result['category_id'],
								'name' => (strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))),
								'description' 		=> strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')),
								'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($result['category_id'], $city_id),
								'thumb'       => $image,
								'path'        => $result['category_id'] ,
								'description' => (strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')))
							);
								
					
						foreach ($results as $result) {
							$filter_data = array(
								'filter_category_id'  => $result['category_id'],
								'filter_sub_category' => true
							);
							if ($result['image']) {
									$image = $this->model_tool_image->resize($result['image'], 500,380);
							} else {
									$image = $this->model_tool_image->resize('placeholder.png', 500,380);
							}
		
							$data['categories'][] = array(
								'category_id'  => $result['category_id'],
								'name' => (strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))),
								'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($result['category_id'],$city_id),
								'thumb'       => $image,
								'path'       => $parent_category_id . '_' . $result['category_id'] ,
								'description' => (strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')))
							);
											
							 
						}
						
						 
					}                   
			}
			$json['categories'] = $data['categoriesp'];
			$json['subcategories'] = $data['categories'];
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
