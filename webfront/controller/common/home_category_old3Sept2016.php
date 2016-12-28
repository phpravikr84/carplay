<?php
class ControllerCommonHomecategory extends Controller {
	public function index() {
		$this->load->model('design/layout');

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}
		
		if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
		}else{
			$city_id = 10;	
		}
		
                
		$this->load->language('common/header');
		
		$data['text_bylocation'] = $this->language->get('text_bylocation');
		$data['text_byshop'] = $this->language->get('text_byshop');
		$data['text_time_slot'] = $this->language->get('text_time_slot');
		$data['text_peoples'] = $this->language->get('text_peoples');
		
		$this->load->model('catalog/category');

		$this->load->model('tool/image');
                
		$categories= $this->model_catalog_category->getCategories(); 
                
        //print '<pre>';  print_r($categories);exit;
                
        $data['category_id'] =0; 
				
		foreach ($categories as $category) {
			$children_data = array();
			
				if ($category['image'] && file_exists(DIR_IMAGE.$category['image'])) {
						$image = $this->model_tool_image->resize($category['image'], 500,380);
				} else {
						$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				}		
			
			//if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
					
					if ($child['image'] && file_exists(DIR_IMAGE.$child['image'])) {
						$thumb = $this->model_tool_image->resize($child['image'], 500,380);
					} else {
						$thumb = $this->model_tool_image->resize('placeholder.png',  500,380);
					}	

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'thumb' => $thumb,
						'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($child['category_id'], $city_id),
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
				'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($category['category_id'],$city_id),
				'thumb'		  => $image,
				'name'        => $category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
		}
				
		//print '<pre>'; print_r($data['categories']);exit;

		return $this->load->view('common/home_category', $data);
	}
}