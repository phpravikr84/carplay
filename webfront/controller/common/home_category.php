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
		$data['text_categories'] = $this->language->get('text_categories');
		$data['text_byshop'] = $this->language->get('text_byshop');
		$data['text_time_slot'] = $this->language->get('text_time_slot');
		$data['text_peoples'] = $this->language->get('text_peoples');
		$data['text_more'] = $this->language->get('text_more');	
		
		
		$this->load->model('catalog/category');

		$this->load->model('tool/image');
                
		$categories= $this->model_catalog_category->getCategories(); 
                
        //print '<pre>';  print_r($categories);exit;
                
        $data['category_id'] =0; 
				
		foreach ($categories as $category) {
			$children_data = array();
			
				// if ($category['image'] && file_exists(DIR_IMAGE.$category['image'])) {
				// 		$image = $this->model_tool_image->resize($category['image'], 500,380);
				// } else {
				// 		$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				// }

				if ($category['image']) {
						$image = $category['image'];
				} else {
						$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				}	
			
			//if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
					
					// if ($child['image'] && file_exists(DIR_IMAGE.$child['image'])) {
					// 	$thumb = $this->model_tool_image->resize($child['image'], 500,380);
					// } else {
					// 	$thumb = $this->model_tool_image->resize('placeholder.png',  500,380);
					// }	


					if ($child['image']) {
						$thumb = $child['image'];
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

	public function get_list() {
        $this->load->model('catalog/category');    
		$categories= $this->model_catalog_category->getAllCategories();
        //$this->output->set_content_type('application/json')->set_output(json_encode($categories));
        $data=array();
        if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
		}else{
			$city_id = 10;	
		}
        foreach($categories as $category)
        {
        	$data[]=array(
        	'category_id' => $category['category_id'],
        	'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($category['category_id'],$city_id),
        	'image'		  => $category['image'],
			'name'        => html_entity_decode($category['name']),
			'href'        => html_entity_decode($this->url->link('product/category', 'path=' . $category['category_id']))
			);

        }
        echo json_encode($data);
    }

    public function get_sublist() {
        $this->load->model('catalog/category');
		$this->load->model('tool/image');
		$categories= $this->model_catalog_category->getCategories(); 
        $data['category_id'] =0; 
        $sublist = array();
         if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
		}else{
			$city_id = 10;	
		}
		foreach ($categories as $category) {
			$children_data = array();
				if ($category['image']) {
						$image = $category['image'];
				} else {
						$image = $this->model_tool_image->resize('placeholder.png', 500,380);
				}	
			
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);


					if ($child['image']) {
						$thumb = $child['image'];
					} else {
						$thumb = $this->model_tool_image->resize('placeholder.png',  500,380);
					}	

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'thumb' => $thumb,
						'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($child['category_id'], $city_id),
						'name' => html_entity_decode($child['name']),
						'href' => html_entity_decode($this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']))
					);
				}
			
			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);
			
			if(count($children_data)>0){

				$sublist[] = array(
					'category_id' => $category['category_id'],
					'total_sub_categories' => count($children),
					'total_merchants'=>$this->model_catalog_category->getTotalMerchantsByCategoryId($category['category_id'],$city_id),
					'thumb'		  => $image,
					'name'        => html_entity_decode($category['name']),
					'children'    => $children_data,
					'href'        => html_entity_decode($this->url->link('product/category', 'path=' . $category['category_id']))
				);
			}
		}

		echo json_encode($sublist);
    }
}