<?php
class ControllerCatalogMerchant extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/merchant');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/merchant'); 

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/merchant');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/merchant');
		
		 $this->model_catalog_merchant->removeCalender();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_merchant->addMerchant($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_contact_person'])) {
				$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
			} 

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/merchant');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/merchant');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_merchant->editMerchant($this->request->get['merchant_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_contact_person'])) {
				$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
			}

			 

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function getGoogleMap(){
		
		$data = array();
		$lat = $this->request->get['lat'];
		$long = $this->request->get['long'];
		$data['latitude'] = $lat;
		$data['longitude'] = $long;
		$this->response->setOutput($this->load->view('catalog/merchant_map', $data));
	}

	public function delete() {
		$this->load->language('catalog/merchant');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/merchant');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $merchant_id) {
				$this->model_catalog_merchant->deleteMerchant($merchant_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_contact_person'])) {
				$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
			}

			 
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function copy() {
		$this->load->language('catalog/merchant');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/merchant');

		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $merchant_id) {
				$this->model_catalog_merchant->copyMerchant($merchant_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_contact_person'])) {
				$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
			}  

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		} 

		if (isset($this->request->get['filter_contact_person'])) {
			$filter_contact_person = $this->request->get['filter_contact_person'];
		} else {
			$filter_contact_person = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_countryname'])) {
			$filter_countryname = $this->request->get['filter_countryname'];
		} else {
			$filter_countryname = null;
		}

		if (isset($this->request->get['filter_cityname'])) {
			$filter_cityname = $this->request->get['filter_cityname'];
		} else {
			$filter_cityname = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
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

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_contact_person'])) {
			$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
		}


		if (isset($this->request->get['filter_countryname'])) {
			$url .= '&filter_countryname=' . urlencode(html_entity_decode($this->request->get['filter_countryname'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_cityname'])) {
			$url .= '&filter_cityname=' . urlencode(html_entity_decode($this->request->get['filter_cityname'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/merchant/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['copy'] = $this->url->link('catalog/merchant/copy', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/merchant/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['merchants'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_contact_person'	  => $filter_contact_person,
			'filter_countryname' => $filter_countryname,
			'filter_cityname' => $filter_cityname, 
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);
		
		//filter data

		$this->load->model('tool/image');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('localisation/city');

		$merchant_total = $this->model_catalog_merchant->getTotalMerchants($filter_data);

		$results = $this->model_catalog_merchant->getMerchants($filter_data);

		
		
		
		$imgthumb =  array();

		foreach ($results as $result) {
			// if (is_file(DIR_IMAGE . $result['image'])) {
			// 	$image = $this->model_tool_image->resize($result['image'], 40, 40);
			// } else {
			// 	$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			// }



		if(isset($result['image']))
			{

				$split = explode('_', $result['image']);
				$func = $split[0];
				if(count($split) > 1)
  				$image = 'https://s3.amazonaws.com/riwigo-storage/images/img-thumb/'.$split[1];
				else
  				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
				
			}
			else{
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$data['merchants'][] = array(
				'merchant_id'           => $result['merchant_id'],
				'image'                 => $image,
				'name'                  => $result['name'],
				'contact_person'        => $result['contact_person'],
				'email'                 => $result['email'],  
				'phone'                 => $result['phone'],
				'mobile'                => $result['mobile'],
				'address'               => $result['address'],
				'city'                  => $result['city'],
				'country'            => $this->model_localisation_country->getCountryName($result['country_id']),
				'zone'               => $this->model_localisation_zone->getZoneName($result['zone_id']),
				'zip'                   => $result['zip'],
				'website'               => $result['website'],
				'status'                => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'                  => $this->url->link('catalog/merchant/edit', 'token=' . $this->session->data['token'] . '&merchant_id=' . $result['merchant_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_contact_person'] = $this->language->get('column_contact_person');
		$data['column_contact_detail'] = $this->language->get('column_contact_detail');
		$data['column_location'] = $this->language->get('column_location');
        $data['column_website'] = $this->language->get('column_website');
                
        $data['column_country'] = $this->language->get('column_country');
        $data['column_city'] = $this->language->get('column_city');

		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
                $data['entry_disc'] = $this->language->get('entry_disc');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_contact_person'])) {
			$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
		} 


		if (isset($this->request->get['filter_countryname'])) {
			$url .= '&filter_countryname=' . urlencode(html_entity_decode($this->request->get['filter_countryname'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_cityname'])) {
			$url .= '&filter_cityname=' . urlencode(html_entity_decode($this->request->get['filter_cityname'], ENT_QUOTES, 'UTF-8'));
		}

	 
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);
		$data['sort_model'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, true);
		$data['sort_price'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, true);
		$data['sort_quantity'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, true);
		$data['sort_status'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true);
		$data['sort_order'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_contact_person'])) {
			$url .= '&filter_contact_person=' . urlencode(html_entity_decode($this->request->get['filter_contact_person'], ENT_QUOTES, 'UTF-8'));
		} 

		if (isset($this->request->get['filter_countryname'])) {
			$url .= '&filter_countryname=' . urlencode(html_entity_decode($this->request->get['filter_countryname'], ENT_QUOTES, 'UTF-8'));
		} 


		if (isset($this->request->get['filter_cityname'])) {
			$url .= '&filter_cityname=' . urlencode(html_entity_decode($this->request->get['filter_cityname'], ENT_QUOTES, 'UTF-8'));
		} 

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $merchant_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($merchant_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($merchant_total - $this->config->get('config_limit_admin'))) ? $merchant_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $merchant_total, ceil($merchant_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_contact_person'] = $filter_contact_person; 
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['citieslist'] = $this->model_localisation_city->getAllCities();
		$data['countrieslist']=$this->model_localisation_country->getAllCountries();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/merchant_list', $data));
	}

	protected function getForm() {  
		$data['heading_title'] = $this->language->get('heading_title');
		
		//--Scripts and Styles 
		//$this->document->addScript('https://code.jquery.com/jquery-1.10.2.min.js');
		//$this->document->addScript('http://maps.google.com/maps/api/js?sensor=false&libraries=places');
		$this->document->addScript('view/javascript/map/locationpicker.jquery.min.js');
		 
		$data['text_form'] = !isset($this->request->get['merchant_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name'); 
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_mobile'] = $this->language->get('entry_mobile');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_contact_person'] = $this->language->get('entry_contact_person');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title'); 
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_zip'] = $this->language->get('entry_zip'); 
		$data['entry_website'] = $this->language->get('entry_website');
		$data['entry_latitude'] = $this->language->get('entry_latitude');
		$data['entry_longitude'] = $this->language->get('entry_longitude'); 
		$data['entry_disc_per'] = $this->language->get('entry_disc_per'); 
		$data['entry_terms'] = $this->language->get('entry_terms'); 
		 
		
		$data['entry_location_map'] = $this->language->get('entry_location_map');
		$data['entry_atmosphere'] = $this->language->get('entry_atmosphere');
		$data['entry_facilities'] = $this->language->get('entry_facilities');
		$data['entry_spokenlanguage'] = $this->language->get('entry_spokenlanguage');
		$data['entry_opening_hours'] = $this->language->get('entry_opening_hours');  
		$data['entry_tag'] = $this->language->get('entry_tag'); 
		 
		$data['entry_date_available'] = $this->language->get('entry_date_available'); 
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_additional_image'] = $this->language->get('entry_additional_image');
		
		 
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
                $data['entry_disc'] = $this->language->get('entry_disc');
                
                
		 
		$data['entry_service_name'] = $this->language->get('entry_service_name');
		$data['entry_service_duration'] = $this->language->get('entry_service_duration'); 
		$data['entry_service_disc_percentage'] = $this->language->get('entry_service_disc_percentage');
		$data['entry_service_disc_amt'] = $this->language->get('entry_service_disc_amt');
		$data['entry_service_disc_price'] = $this->language->get('entry_service_disc_price'); 
		$data['entry_capacity'] = $this->language->get('entry_capacity'); 
		$data['entry_no_of_staff'] = $this->language->get('entry_no_of_staff'); 
		$data['entry_services'] = $this->language->get('entry_services'); 
		$data['entry_duration'] = $this->language->get('entry_duration'); 
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_merchnt_desc'] = $this->language->get('entry_merchnt_desc');
                
		$data['help_keyword'] = $this->language->get('help_keyword'); 
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_category'] = $this->language->get('help_category');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');
		
		$data['entry_name'] = $this->language->get('entry_name'); 
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_service_duration'] = $this->language->get('entry_service_duration'); 
		$data['entry_service_disc_percentage'] = $this->language->get('entry_service_disc_percentage');
		$data['entry_service_disc_amt'] = $this->language->get('entry_service_disc_amt');
		$data['entry_service_discounted_amt'] = $this->language->get('entry_service_discounted_amt');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');
                $data['button_discount'] = $this->language->get('button_discount');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data'); 
		$data['tab_services'] = $this->language->get('tab_services');
		$data['tab_image'] = $this->language->get('tab_image'); 
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_openbay'] = $this->language->get('tab_openbay');
        $data['tab_links'] = $this->language->get('tab_links');
		
		$data['entry_merchant_type'] = $this->language->get('entry_merchant_type');
		$data['entry_margin'] = $this->language->get('entry_margin');
		
		

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = array();
		}
		if (isset($this->error['phone'])) {
			$data['error_phone'] = $this->error['phone'];
		} else {
			$data['error_phone'] = array();
		}
		if (isset($this->error['mobile'])) {
			$data['error_mobile'] = $this->error['mobile'];
		} else {
			$data['error_mobile'] = array();
		}
		
		if (isset($this->error['contact_person'])) {
			$data['error_contact_person'] = $this->error['contact_person'];
		} else {
			$data['error_contact_person'] = array();
		}
		
		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = array();
		}
		
		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = array();
		}
		
		if (isset($this->error['zip'])) {
			$data['error_zip'] = $this->error['zip'];
		} else {
			$data['error_zip'] = array();
		}
		
		if (isset($this->error['website'])) {
			$data['error_website'] = $this->error['website'];
		} else {
			$data['error_website'] = array();
		}
                
		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = array();
		} 

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		} 

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}
		

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}  
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['merchant_id'])) {
			$data['action'] = $this->url->link('catalog/merchant/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/merchant/edit', 'token=' . $this->session->data['token'] . '&merchant_id=' . $this->request->get['merchant_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true);
		
		$this->load->model('catalog/product');
		$merchant_products = '';
		
		if (isset($this->request->get['merchant_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$filter_data = array('filter_merchant_id'	  => $this->request->get['merchant_id']);
			$merchant_info = $this->model_catalog_merchant->getMerchant($this->request->get['merchant_id']);
			$merchant_products = $this->model_catalog_product->getProducts($filter_data);
			$this->model_catalog_merchant->updateCalender($this->request->get['merchant_id']);
		}
		
		//print '<pre>'; print_r($merchant_info);exit;
		
		$data['merchant_products'] = array();
		
		if (!empty($merchant_products)) {
			$data['merchant_products'] = $merchant_products;
		}
		
		//print_r($merchant_products);

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['merchant_description'])) {
			$data['merchant_description'] = $this->request->post['merchant_description'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$data['merchant_description'] = $this->model_catalog_merchant->getMerchantDescriptions($this->request->get['merchant_id']);
		} else {
			$data['merchant_description'] = array();
		} 
		
		if (isset($this->request->get['merchant_id'])) {
			$data['merchant_id'] = $this->request->get['merchant_id'];
		} elseif (!empty($merchant_info)) {
			$data['merchant_id'] = $merchant_info['merchant_id'];
		} else {
			$data['merchant_id'] = '';
		}  
		
		//print '<pre>'; print_r($data['merchant_description']);exit;
		
		if (isset($this->request->post['booking_start_date'])) {
			$data['booking_start_date'] = $this->request->post['booking_start_date'];
		} elseif (!empty($merchant_info)) {
			$data['booking_start_date'] = $merchant_info['booking_start_date'];
		} else {
			$data['booking_start_date'] = date('Y-m-d');
		}
		
		if (isset($this->request->post['booking_end_date'])) {
			$data['booking_end_date'] = $this->request->post['booking_end_date'];
		} elseif (!empty($merchant_info)) {
			$data['booking_end_date'] = $merchant_info['booking_end_date'];
		} else {
			$data['booking_end_date'] = date('Y-m-d', strtotime("+90 days"));
		}
		
		if (isset($this->request->post['avg_discount'])) {
			$data['avg_discount'] = $this->request->post['avg_discount'];
		} elseif (!empty($merchant_info)) {
			$data['avg_discount'] = $merchant_info['avg_discount'];
		} else {
			$data['avg_discount'] = 30;
		}
		
		
		if (isset($this->request->post['avg_seats'])) {
			$data['avg_seats'] = $this->request->post['avg_seats'];
		} elseif (!empty($merchant_info)) {
			$data['avg_seats'] = $merchant_info['avg_seats'];
		} else {
			$data['avg_seats'] = 10;
		} 
		
		
		if (isset($this->request->post['merchant_type'])) {
			$data['merchant_type'] = $this->request->post['merchant_type'];
		} elseif (!empty($merchant_info)) {
			$data['merchant_type'] = $merchant_info['merchant_type'];
		} else {
			$data['merchant_type'] = '';
		} 
		
		if (isset($this->request->post['margine_type'])) {
			$data['margine_type'] = $this->request->post['margine_type'];
		} elseif (!empty($merchant_info)) {
			$data['margine_type'] = $merchant_info['margine_type'];
		} else {
			$data['margine_type'] = '';
		} 
		
		//print $data['margine_type'];exit;
		
		if (isset($this->request->post['margin_value'])) {
			$data['margin_value'] = $this->request->post['margin_value'];
		} elseif (!empty($merchant_info)) {
			$data['margin_value'] = $merchant_info['margin_value'];
		} else {
			$data['margin_value'] = '';
		}  
		
		
		if (isset($this->request->post['capacity'])) {
			$data['capacity'] = $this->request->post['capacity'];
		} elseif (!empty($merchant_info)) {
			$data['capacity'] = $merchant_info['capacity'];
		} else {
			$data['capacity'] = '';
		}
		
		if (isset($this->request->post['price_level'])) {
			$data['price_level'] = $this->request->post['price_level'];
		} elseif (!empty($merchant_info)) {
			$data['price_level'] = $merchant_info['price_level'];
		} else {
			$data['price_level'] = '';
		}
		
		if (isset($this->request->post['rating'])) {
			$data['rating'] = $this->request->post['rating'];
		} elseif (!empty($merchant_info)) {
			$data['rating'] = $merchant_info['rating'];
		} else {
			$data['rating'] = '';
		}
		
		if (isset($this->request->post['no_of_staff'])) {
			$data['no_of_staff'] = $this->request->post['no_of_staff'];
		} elseif (!empty($merchant_info)) {
			$data['no_of_staff'] = $merchant_info['no_of_staff'];
		} else {
			$data['no_of_staff'] = '';
		} 

		if (isset($this->request->post['location_map'])) {
			$data['location_map'] = $this->request->post['location_map'];
		} elseif (!empty($merchant_info)) {
			$data['location_map'] = $merchant_info['location_map'];
		} else {
			$data['location_map'] = '';
		}
		
		if (isset($this->request->post['latitude'])) {
			$data['latitude'] = $this->request->post['latitude'];
		} elseif (!empty($merchant_info)) {
			$data['latitude'] = $merchant_info['latitude'];
		} else {
			$data['latitude'] = '';
		}
		
		if (isset($this->request->post['longitude'])) {
			$data['longitude'] = $this->request->post['longitude'];
		} elseif (!empty($merchant_info)) {
			$data['longitude'] = $merchant_info['longitude'];
		} else {
			$data['longitude'] = '';
		} 

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($merchant_info)) {
			$data['keyword'] = $merchant_info['keyword'];
		} else {
			$data['keyword'] = '';
		}  
		 
		
		// Image
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($merchant_info)) {
			$data['image'] = $merchant_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		// if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
		// 	$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		// } elseif (!empty($merchant_info) && is_file(DIR_IMAGE . $merchant_info['image'])) {
		// 	$data['thumb'] = $this->model_tool_image->resize($merchant_info['image'], 100, 100);
		// } else {
		// 	$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		// }


		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($merchant_info) && is_file(DIR_IMAGE . $merchant_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($merchant_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}


		// if (isset($this->request->post['image'])) {

		// 	$s3img = explode('_', $this->request->post['image']);

		// 	$data['thumb'] = isset($s3img[1]) ? $s3img[1] : '';
		// } elseif (!empty($merchant_info)) {
		// 	$s3imgmerchant = explode('_', $this->request->post['image']);
		// 	$data['thumb'] = isset($s3imgmerchant[1]) ? $s3imgmerchant[1] : '';
		// } else {
		// 	$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		// }



		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		// Images
		if (isset($this->request->post['merchant_image'])) {
			$merchant_images = $this->request->post['merchant_image'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$merchant_images = $this->model_catalog_merchant->getMerchantImages($this->request->get['merchant_id']);
		} else {
			$merchant_images = array();
		}

		$data['merchant_images'] = array();

		foreach ($merchant_images as $merchant_image) {
			if (isset($merchant_image['image'])) {
				$image = $merchant_image['image'];

				$splitimg = explode('_', $merchant_image['image']);
				$funcimg = $splitimg[0];
				if(count($splitimg) > 1)
  				$thumb = "https://s3.amazonaws.com/riwigo-storage/images/img-thumb/".$splitimg[1];
				else
  				$thumb = 'no_image.png';

			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['merchant_images'][] = array(
				'image'      => $image,
				'thumb'      => $thumb,
				'sort_order' => $merchant_image['sort_order']
			);
		}
                
                //Service Related
                
                if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$products = $this->model_catalog_merchant->getProductRelated($this->request->get['merchant_id']);
		} else {
			$products = array();
		}

		// print_r($products);
		// exit;

		$data['product_relateds'] = array();

		foreach ($products as $merchant_id) {
			$related_info = $this->model_catalog_product->getProduct($merchant_id);

			if ($related_info) {
				$data['product_relateds'][] = array(
					//'product_id' => $related_info['merchant_id'],
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}

		// 	print_r($data['product_relateds']);
		// exit;
                
		//Get All Services or Products
		
	    $data['merchant_all_services']  = $this->model_catalog_merchant->getMerchantAllServices();
                
                // Services
		if (isset($this->request->post['merchant_service'])) {
			$merchant_services = $this->request->post['merchant_service'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$merchant_services = $this->model_catalog_merchant->getMerchantServices($this->request->get['merchant_id']);
		} else {
			$merchant_services = array();
		}

                 
		if(isset($this->request->get['merchant_id'])){ 
        //print '<pre>'; print_r($data['merchant_all_services']);exit;
		foreach ($merchant_services as $merchant_service) { 
                    
                    $service_wise_discsoutns = $this->model_catalog_merchant->getMerchantServiceWiseDiscount($this->request->get['merchant_id'],$merchant_service['product_id']);
                    
                    /*print $this->request->get['merchant_id'].'--';
                    print  $merchant_service['product_id'];
                    print '<pre>'; print_r($service_wise_discsoutns );*/
                    
                    $data['merchant_services'][] = array(
                        'merchant_id'       => $merchant_service['merchant_id'],
                        'product_name'      => $merchant_service['name'],
                        'product_id'        => $merchant_service['product_id'],
                        'product_desc'     => $merchant_service['product_desc'],
                        'duration'          => $merchant_service['duration'],
                        'price'             => $merchant_service['price'],
                        'discounts'         => $service_wise_discsoutns
                    );
                }
               // exit;
              // print '<pre>'; print_r($data['merchant_services']); print '</pre>';
		}
		   
                
		//exit;      
		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['tax_class_id'])) {
			$data['tax_class_id'] = $this->request->post['tax_class_id'];
		} elseif (!empty($merchant_info)) {
			$data['tax_class_id'] = $merchant_info['tax_class_id'];
		} else {
			$data['tax_class_id'] = 0;
		}

		if (isset($this->request->post['from_opeining_hours'])) {
			$data['from_opeining_hours'] = $this->request->post['from_opeining_hours'];
		} elseif (!empty($merchant_info)) {
			$data['from_opeining_hours'] = $merchant_info['from_opeining_hours'];
		} else {
			$data['from_opeining_hours'] = date('HH:MM');
		} 
		
		if (isset($this->request->post['to_opening_hours'])) {
			$data['to_opening_hours'] = $this->request->post['to_opening_hours'];
		} elseif (!empty($merchant_info)) {
			$data['to_opening_hours'] =  $merchant_info['to_opening_hours'] ;
		} else {
			$data['to_opening_hours'] = date('HH:MM');
		} 
		
		if (isset($this->request->post['date_available'])) {
			$data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($merchant_info)) {
			$data['date_available'] = ($merchant_info['date_available'] != '0000-00-00') ? $merchant_info['date_available'] : '';
		} else {
			$data['date_available'] = date('Y-m-d');
		} 

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($merchant_info)) {
			$data['sort_order'] = $merchant_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		} 

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($merchant_info)) {
			$data['status'] = $merchant_info['status'];
		} else {
			$data['status'] = true;
		} 
		
		if (isset($this->request->post['merchant_facilities'])) {
			$facilities = $this->request->post['merchant_facilities'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$facilities = $this->model_catalog_merchant->getFacilitiesByMerchantId($this->request->get['merchant_id']);
		} else {
			$facilities = array();
		}
		
		$this->load->model('catalog/merchant');
		
		$data['merchant_facilitiess'] = array();
		
		//print '<pre>'; print_r($facilities);exit;

		foreach ($facilities as $facilities) {
			
			if(isset($facilities['facilities_id'])){
				$filter_data = array(
					'filter_facilities_id'	  => $facilities['facilities_id']
				);
			}else{
				$filter_data = array(
					'filter_facilities_id'	  => $facilities
				);
			
			}
			
			$facilities_info = $this->model_catalog_merchant->getFacilitie($filter_data);
			
			//print '<pre>'; print_r($facilities_info);exit;

			if ($facilities_info) {
				$data['merchant_facilitiess'][] = array(
					'facilities_id' => $facilities_info['facilities_id'],
					'name'       => $facilities_info['name']						
				);
			}
		}
		
		if (isset($this->request->post['merchant_spokenlanguage'])) {
			$spokenlanguages = $this->request->post['merchant_spokenlanguage'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$spokenlanguages = $this->model_catalog_merchant->getSpokenlanguageByMerchantId($this->request->get['merchant_id']);
		} else {
			$spokenlanguages = array();
		}
		
		$this->load->model('sale/order');
		
	if(isset($this->request->get['merchant_id'])){
		$filter_data = array(
			'filter_merchant_id'	  => $this->request->get['merchant_id']
		);
		
		
		$merchant_orders = $this->model_sale_order->getOrders($filter_data);
		$data['merchant_orders'] = array();
		foreach ($merchant_orders as $merchant_order){
			$margin_amt =0;
			$margin_value='';
			if($merchant_order['margin_type']=='Fixed'){
				$margin_amt = (((int)$merchant_order['total'] * (int) $merchant_order['margin_value']) / 100);
				$margin_value= $merchant_order['margin_value'] .' %';
			}elseif($merchant_order['margin_type']=='Flat'){
				$margin_amt = (((int)$merchant_order['total'] * (int) $merchant_order['margin_value']) / 100);
				$margin_value= $merchant_order['margin_value'];
			}
			
			$data['merchant_orders'][] = array(
					'order_id' 		=> $merchant_order['order_id'],
					'booking_date' 	=> $merchant_order['booking_date'],
					'margin_value' 	=> $margin_value,
					'margin_amt' 	=> $margin_amt,
					'margin_type' 	=> $merchant_order['margin_type'],
					'customer' 		=> $merchant_order['customer'],
					'order_status' 	=> $merchant_order['order_status'],
					'product_name' 	=> $merchant_order['product_name'],
					'discount' 		=> $merchant_order['discount'],
					'order_status'	=> $merchant_order['order_status'],
					'persons' 		=> $merchant_order['persons'],
					'disocuntTime' 	=> $merchant_order['disocuntTime'],
					'duration' 		=> $merchant_order['duration'],
					'total'       	=> $merchant_order['total']						
				);
		
		}

	}
		
		
		//print '<pre>'; print_r($data['merchant_orders']);exit;
		
		$this->load->model('catalog/merchant');
		
		$data['merchant_spokenlanguages'] = array();
		
		//print '<pre>'; print_r($spokenlanguages);exit;

		foreach ($spokenlanguages as $spokenlanguage) {
			if(isset($spokenlanguage['spokenlanguage_id'])){
				$filter_data = array(
					'filter_spokenlanguage_id'	  => $spokenlanguage['spokenlanguage_id']
				);
			}else{
				$filter_data = array(
					'filter_spokenlanguage_id'	  => $spokenlanguage
				);					
			}
			
			$spokenlanguage_info = $this->model_catalog_merchant->getSpokenlanguage($filter_data);
			
			//print '<pre>'; print_r($spokenlanguage_info);exit;

			if ($spokenlanguage_info) {
				$data['merchant_spokenlanguages'][] = array(
					'spokenlanguage_id' => $spokenlanguage_info['spokenlanguage_id'],
					'name'       => $spokenlanguage_info['name']						
				);
			}
		}
		
		if (isset($this->request->post['merchant_mcategories'])) {
			$merchant_mcategories = $this->request->post['merchant_mcategories'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$merchant_mcategories = $this->model_catalog_merchant->getMcategoriesByMerchantId($this->request->get['merchant_id']);
		} else {
			$merchant_mcategories = array();
		}
		
		$data['merchant_mcategories'] = array();
		
		//print '<pre>'; print_r($merchant_mcategories);exit;

		foreach ($merchant_mcategories as $merchant_mcategory) {
			if(isset($merchant_mcategory['mcategory_id'])){
				$filter_data = array(
					'filter_mcategory_id'	  => $merchant_mcategory['mcategory_id']
				);
			}else{
				$filter_data = array(
					'filter_mcategory_id'	  => $merchant_mcategory
				);					
			}
			
			$mcategory_info = $this->model_catalog_merchant->getMcategories($filter_data);
			
			//print '<pre>'; print_r($mcategory_info);exit;

			if ($mcategory_info) {
				$data['merchant_mcategories'][] = array(
					'mcategory_id' => $mcategory_info['mcategory_id'],
					'name'       => $mcategory_info['name']						
				);
			}
		}
		
		
		if (isset($this->request->post['merchant_atmosphere'])) {
			$atmospheres = $this->request->post['merchant_atmosphere'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$atmospheres = $this->model_catalog_merchant->getAtmosphereByMerchantId($this->request->get['merchant_id']);
		} else {
			$atmospheres = array();
		}
		
		$this->load->model('catalog/merchant');
		
		$data['merchant_atmospheres'] = array();
		
		//print '<pre>'; print_r($atmospheres);exit;

		foreach ($atmospheres as $atmospheres) {
			if(isset($atmospheres['atmosphere_id'])){
				$filter_data = array(
					'filter_atmosphere_id'	  => $atmospheres['atmosphere_id']
				);
			}else{
				$filter_data = array(
					'filter_atmosphere_id'	  => $atmospheres
				);
			}
			
			$atmospheres_info = $this->model_catalog_merchant->getAtmosphere($filter_data);

			if ($atmospheres_info) {
				$data['merchant_atmospheres'][] = array(
					'atmosphere_id' => $atmospheres_info['atmosphere_id'],
					'name'       => $atmospheres_info['name']						
				);
			}
		}
	 	//print '<pre>'; print_r($data['merchant_atmospheres']);exit;
		
		
		
		
		$this->load->model('customer/customer_group');
		

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();  
		
		// Image
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($merchant_info)) {
			$data['image'] = $merchant_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		// if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
		// 	$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		// } elseif (!empty($merchant_info) && is_file(DIR_IMAGE . $merchant_info['image'])) {
		// 	$data['thumb'] = $this->model_tool_image->resize($merchant_info['image'], 100, 100);
		// } else {
		// 	$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		// }
		$s3imgthumb=array();

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($merchant_info) && !empty($merchant_info['image'])) {
			
			
			$splitthumb = explode('_',$merchant_info['image']);
			$functhumb = $splitthumb[0];
			if(count($splitthumb) > 1)
  			$data['thumb'] = "https://s3.amazonaws.com/riwigo-storage/images/img-thumb/".$splitthumb[1];
			else
  			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		// Images
		if (isset($this->request->post['merchant_image'])) {
			$merchant_images = $this->request->post['merchant_image'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$merchant_images = $this->model_catalog_merchant->getMerchantImages($this->request->get['merchant_id']);
		} else {
			$merchant_images = array();
		}

		$data['merchant_images'] = array();

		foreach ($merchant_images as $merchant_image) {
			// if (is_file(DIR_IMAGE . $merchant_image['image'])) {
			// 	$image = $merchant_image['image'];
			// 	$thumb = $merchant_image['image'];
			// }
			if (!empty($merchant_image['image'])) {
				$image = $merchant_image['image'];

				$splitm = explode('_', $merchant_image['image']);
				$funcm = $splitm[0];
				if(count($splitm) > 1)
  				$thumb = "https://s3.amazonaws.com/riwigo-storage/images/img-thumb/".$splitm[1];
				else
  				$thumb = 'no_image.png';
			}
			else {
				$image = '';
				$thumb = 'no_image.png';
			}

			// $data['merchant_images'][] = array(
			// 	'image'      => $image,
			// 	'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
			// 	'sort_order' => $merchant_image['sort_order']
			// );
			$merchant_thumbs=explode('_', $thumb);
			$data['merchant_images'][] = array(
				'image'      => $image,
				'thumb'      => $thumb,
				'sort_order' => $merchant_image['sort_order']
			);
		} 
 

		if (isset($this->request->post['points'])) {
			$data['points'] = $this->request->post['points'];
		} elseif (!empty($merchant_info)) {
			$data['points'] = $merchant_info['points'];
		} else {
			$data['points'] = '';
		}

		if (isset($this->request->post['merchant_reward'])) {
			$data['merchant_reward'] = $this->request->post['merchant_reward'];
		} elseif (isset($this->request->get['merchant_id'])) {
			$data['merchant_reward'] = $this->model_catalog_merchant->getMerchantRewards($this->request->get['merchant_id']);
		} else {
			$data['merchant_reward'] = array();
		} 
		
		if(isset($this->request->get['merchant_id'])){
		$data['breadcrumbs'][] = array(
			'text' => $this->model_catalog_merchant->getMerchantNameByMerchantId($this->request->get['merchant_id']),
			'href' => $this->url->link('catalog/merchant', 'token=' . $this->session->data['token'] . $url, true)
		);
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/merchant_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/merchant')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('customer/customer');

		foreach ($this->request->post['merchant_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
			
			if ((utf8_strlen($value['contact_person']) < 3) || (utf8_strlen($value['contact_person']) > 100)) {
				$this->error['contact_person'][$language_id] = $this->language->get('error_contact_person');
			}
			
			$customer_info = $this->model_customer_customer->getCustomerByEmail($value['email']);
			
			if ((utf8_strlen($value['email']) > 96) || !filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
				$this->error['email'][$language_id] = $this->language->get('error_email');
			}elseif ($customer_info) {
				$this->error['email'] = $this->language->get('error_exists');
			}
			
			if ((utf8_strlen($value['phone']) < 5)) {
				$this->error['phone'][$language_id] = $this->language->get('error_phone');
			}
			
			if ((utf8_strlen($value['mobile']) < 10)) {
				$this->error['mobile'][$language_id] = $this->language->get('error_mobile');
			}
			
			if ((($value['country_id']) =='')) {
				$this->error['country'][$language_id] = $this->language->get('error_country');
			}
			
			if ((($value['zone_id']) =='')) {
				$this->error['zone'][$language_id] = $this->language->get('error_zone');
			}
			
			if ((($value['zip']) =='')) {
				$this->error['zip'][$language_id] = $this->language->get('error_zip');
			}
			
			if ((($value['website']) =='')) {
				$this->error['website'][$language_id] = $this->language->get('error_website');
			}
			
			if ((($value['zone_id']) =='')) {
				$this->error['zone'][$language_id] = $this->language->get('error_zone');
			}
                        
            if ((utf8_strlen($value['address']) < 3) || (utf8_strlen($value['address']) > 255)) {
				$this->error['address'][$language_id] = $this->language->get('error_address');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		} 

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['merchant_id']) && $url_alias_info['query'] != 'merchant_id=' . $this->request->get['merchant_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['merchant_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/merchant')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateCopy() {
		if (!$this->user->hasPermission('modify', 'catalog/merchant')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_minute'])) {
			$this->load->model('catalog/merchant'); 

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_minute'])) {
				$filter_minute = $this->request->get['filter_minute'];
			} else {
				$filter_minute = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_minute' => $filter_minute,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_merchant->getMerchants($filter_data);

			foreach ($results as $result) { 
				$json[] = array(
					'merchant_id' => $result['merchant_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteServices() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_minute'])) {
			$this->load->model('catalog/merchant'); 

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}
			
			if (isset($this->request->get['filter_merchant_id'])) {
				$filter_merchant_id = $this->request->get['filter_merchant_id'];
			} else {
				$filter_merchant_id = '';
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_merchant_id'  => $filter_merchant_id,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_merchant->autocompleteRecomondedProducts($filter_data);
			
			//print_r($results);exit;

			foreach ($results as $result) { 
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'minute'      => $result['duration'], 
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteSpokenlanguage() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/merchant'); 

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			} 

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name, 
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_merchant->getSpokenlanguages($filter_data);

			foreach ($results as $result) { 

				$json[] = array(
					'spokenlanguage_id' => $result['spokenlanguage_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	 public function autocompleteFacilities() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/merchant'); 

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			} 

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name, 
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_merchant->getFacilities($filter_data);

			foreach ($results as $result) { 

				$json[] = array(
					'facilities_id' => $result['facilities_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function nextCalender(){
		$this->load->model('catalog/merchant'); 
		//print_r($this->request->get['merchant_id']);exit;
		//print_r($this->request->post['next_date']);
		//$merchant_discounts = $this->model_catalog_merchant->getMerchantDiscounts($this->request->get['merchant_id'], $this->request->post['next_date']);
		
		///print_r($merchant_discounts);exit;
		
		$json['success']=true;
		$json['end_date']=$this->request->post['next_date'];
		$json['next_date']= date('Y-m-d', strtotime($this->request->post['next_date']. ' + 7 days'));;
		$json['prev_date']= date('Y-m-d', strtotime($this->request->post['next_date']. ' - 7 days'));;
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}
	
	public function discountGenerate(){
		
		
	//print '<pre>'; print_r($this->request->post);
			$selectedTime = "8:00"; 
			
			$i=0;
			
			// Start date
			 $date = date('Y-m-d');
			 
			 if(isset($this->request->post['booking_start_date'])){
				$json['booking_start_date'] =$this->request->post['booking_start_date'];
			 } 
			 
			 // End date
			 //$end_date = date('Y-m-d', strtotime("+6 days"));
			 if(isset($this->request->post['booking_end_date'])){
				$json['booking_end_date'] =  $this->request->post['booking_end_date'];
			} 
			 
		    $json['success'] = true;
		   	$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		   
			 
		   
		
	}
	
	public function prevCalender(){
		$this->load->model('catalog/merchant'); 
		//print_r($this->request->get['merchant_id']);exit;
		//print_r($this->request->post['next_date']);
		//$merchant_discounts = $this->model_catalog_merchant->getMerchantDiscounts($this->request->get['merchant_id'], $this->request->post['next_date']);
		
		///print_r($merchant_discounts);exit;
		
		$json['success']=true;
		$json['end_date']=$this->request->post['prev_date'];
		$json['next_date']= date('Y-m-d', strtotime($this->request->post['prev_date']. ' + 7 days'));;
		$json['prev_date']= date('Y-m-d', strtotime($this->request->post['prev_date']. ' - 7 days'));;
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}
	
	public function autocompleteMcategory() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/merchant'); 

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			} 

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name, 
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_merchant->getMcategories($filter_data);

			foreach ($results as $result) { 

				$json[] = array(
					'mcategory_id' => $result['mcategory_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function autocompleteAtmosphere() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/merchant'); 

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			} 

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name, 
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_merchant->getAtmospheres($filter_data);

			foreach ($results as $result) { 

				$json[] = array(
					'atmosphere_id' => $result['atmosphere_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
