<?php
class ControllerCommonHomeSearch extends Controller {
	public function index() {  
		$this->load->model('design/layout');

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}
                
		$this->load->language('common/header');
		
		$data['text_bylocation'] = $this->language->get('text_bylocation');
		$data['text_byshop'] = $this->language->get('text_byshop');
		$data['text_time_slot'] = $this->language->get('text_time_slot');
		$data['text_peoples'] = $this->language->get('text_peoples');
                
                
        $this->document->addScript('webfront/view/javascript/js/jquery.multiselect.js');
		$this->document->addScript('webfront/view/javascript/js/jquery.flexslider-min.js');
		$this->document->addScript('webfront/view/javascript/js/bootstrap-suggest.js');
		$this->document->addScript('webfront/view/javascript/js/jquery.flexisel.js');
		
		//$this->document->addScript('webfront/view/javascript/js/jquery.bxslider.js');
		$this->document->addScript('webfront/view/javascript/js/jquery.datetimepicker.full.min.js'); 
		$this->document->addScript('webfront/view/javascript/js/master.js');
		
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/merchant');
		
		$this->load->model('localisation/location');

		$this->load->model('tool/image');
		
		if(isset($this->session->data['city_id'])){
			$city_id = $this->session->data['city_id'];	
		}else{
			$city_id = 10;	
		}
        
		$data['locations'] =  $this->model_localisation_location->getLocationsByCityId($city_id); 
		
		$filter_data = array('filter_city_id'=>$city_id);
		
		$data['merchants'] =  $this->model_catalog_merchant->getAllMerchants($filter_data);       
		
		$categories = $this->model_catalog_category->getCategories(); 
		
                
       /// print '<pre>';  print_r($data['merchants']);exit;
	   
	   
                
        $data['category_id'] =0; 
				
		foreach ($categories as $category) {
			$children_data = array();
			$children = $this->model_catalog_category->getCategories($category['category_id']);
			foreach($children as $child) {
				$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);
				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name' => $child['name']
				);
			}
			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'children'    => $children_data
			);
		}
				
		//print '<pre>'; print_r($data['categories']);exit;
		
		
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
	 
		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner(7);

		foreach ($results as $result) {
			// if (is_file(DIR_IMAGE . $result['image'])) {
			// 	$data['banners'][] = array(
			// 		'title' => $result['title'],
			// 		'link'  => $result['link'],
			// 		'image' => $this->model_tool_image->resize($result['image'],1920, 600)
			// 	);
			// }


			if (isset($result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $result['image'],
				);
			}
		}

		        
		$layout_id = 0;

		if ($route == 'product/category' && isset($this->request->get['path'])) {
			$this->load->model('catalog/category');

			$path = explode('_', (string)$this->request->get['path']);

			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
		}

		if ($route == 'product/product' && isset($this->request->get['product_id'])) {
			$this->load->model('catalog/product');

			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
		}

		if ($route == 'information/information' && isset($this->request->get['information_id'])) {
			$this->load->model('catalog/information');

			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
		}

		if (!$layout_id) {
			$layout_id = $this->model_design_layout->getLayout($route);
		}

		if (!$layout_id) {
			$layout_id = $this->config->get('config_layout_id');
		}

		$this->load->model('extension/module');

		$data['modules'] = array();

		$modules = $this->model_design_layout->getLayoutModules($layout_id, 'content_top');

		foreach ($modules as $module) {
			$part = explode('.', $module['code']);

			if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
				$module_data = $this->load->controller('module/' . $part[0]);

				if ($module_data) {
					$data['modules'][] = $module_data;
				}
			}

			if (isset($part[1])) {
				$setting_info = $this->model_extension_module->getModule($part[1]);

				if ($setting_info && $setting_info['status']) {
					$module_data = $this->load->controller('module/' . $part[0], $setting_info);

					if ($module_data) {
						$data['modules'][] = $module_data;
					}
				}
			}
		}

		return $this->load->view('common/home_search', $data);
	}
}
