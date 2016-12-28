<?php
class ControllerCatalogTransacation extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/transacation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/transacation');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/transacation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/transacation');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_transacation->addTransacation($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/transacation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/transacation');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_transacation->editTransacation($this->request->get['transacation_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/transacation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/transacation');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $transacation_id) {
				$this->model_catalog_transacation->deleteTransacation($transacation_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		
		if (isset($this->request->get['filter_merchant'])) {
			$filter_merchant = $this->request->get['filter_merchant'];
		} else {
			$filter_merchant = '';
		}

		if (isset($this->request->get['filter_remarks'])) {
			$filter_remarks = $this->request->get['filter_remarks'];
		} else {
			$filter_remarks = '';
		}

		if (isset($this->request->get['filter_date'])) {
			$filter_date = $this->request->get['filter_date'];
		} else {
			$filter_date = '';
		}
		
		if (isset($this->request->get['filter_todate'])) {
			$filter_todate = $this->request->get['filter_todate'];
		} else {
			$filter_todate = '';
		}
		
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
		
		if (isset($this->request->get['filter_merchant'])) {
			$url .= '&filter_merchant=' . urlencode(html_entity_decode($this->request->get['filter_merchant'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_remarks'])) {
			$url .= '&filter_remarks=' . urlencode(html_entity_decode($this->request->get['filter_remarks'], ENT_QUOTES, 'UTF-8'));
		} 
		
		if (isset($this->request->get['filter_todate'])) {
			$url .= '&filter_todate=' . urlencode(html_entity_decode($this->request->get['filter_todate'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
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
			'href' => $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/transacation/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/transacation/delete', 'token=' . $this->session->data['token'] . $url, true);

		$this->load->model('catalog/merchant');
		
		$data['transacations'] = array();
		
		$language_total =0;
		
		//print $filter_merchant;exit;
		
		
		$filter_data = array(
			'filter_merchant' 	=> $filter_merchant,
			'filter_remarks' 	=> $filter_remarks,
			'filter_date' 		=> $filter_date, 
			'filter_todate' 		=> $filter_todate, 	
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		
		
		if($filter_merchant !='' and $filter_merchant!=0){


		$language_total = $this->model_catalog_transacation->getTotalTransacations($filter_data);

		$results = $this->model_catalog_transacation->getTransacations($filter_data);
		
		$total_amt =0;

		foreach ($results as $result) {
			$total_amt = ($total_amt + $result['cr_amount'])- $result['dr_amount'];
			
			if($result['dr_amount'] == 0){
				$result['dr_amount'] ='';
			}else{
				$result['dr_amount']= $this->currency->format($result['dr_amount'],'THB',1);
			}
			
			if($result['cr_amount'] == 0){
				$result['cr_amount'] ='';
			}else{
				$result['cr_amount'] = $this->currency->format($result['cr_amount'],'THB',1);
			}
			
			$data['transacations'][] = array(
				'date_added' 			=> date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'transacation_id' 		=> $result['transacation_id'],
				'merchant_name'        	=> $this->model_catalog_transacation->getMerchantNameByMerchantId($result['merchant_id']),
				'dr_amount'  			=> $result['dr_amount'],
				'cr_amount'  			=> $result['cr_amount'],
				'total_amt'  			=> $this->currency->format($total_amt,'THB',1),
				'remarks'  				=> $result['remarks'],
				'edit'        => $this->url->link('catalog/transacation/edit', 'token=' . $this->session->data['token'] . '&transacation_id=' . $result['transacation_id'] . $url, true)
			);
		}
		}
		
		//$this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
		
		$results = $this->model_catalog_merchant->getMerchants($filter_data);
			$data['merchants'] = array();
			foreach ($results as $result) { 
				$data['merchants'][] = array(
					'merchant_id' => $result['merchant_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				
				);
			}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_code'] = $this->language->get('column_code');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		
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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_code'] = $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . '&sort=code' . $url, true);
		$data['sort_sort_order'] = $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $language_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($language_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($language_total - $this->config->get('config_limit_admin'))) ? $language_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $language_total, ceil($language_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['filter_merchant'] = $filter_merchant;
		$data['filter_date'] = $filter_date;
		$data['filter_todate'] = $filter_todate;
		
		$data['filter_remarks'] = $filter_remarks;
		 

		$this->response->setOutput($this->load->view('catalog/transacation_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['transacation_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_status'] = $this->language->get('help_status');
		$data['help_transacation'] = $this->language->get('help_transacation');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['transacation_date'])) {
			$data['error_transacation_date'] = $this->error['transacation_date'];
		} else {
			$data['error_transacation_date'] = '';
		}

		if (isset($this->error['merchant_id'])) {
			$data['error_merchant_id'] = $this->error['merchant_id'];
		} else {
			$data['error_merchant_id'] = '';
		}
		
		if (isset($this->error['transacation_amt'])) {
			$data['error_transacation_amt'] = $this->error['transacation_amt'];
		} else {
			$data['error_transacation_amt'] = '';
		}
		
		

		$url = '';

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
			'href' => $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['transacation_id'])) {
			$data['action'] = $this->url->link('catalog/transacation/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/transacation/edit', 'token=' . $this->session->data['token'] . '&transacation_id=' . $this->request->get['transacation_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/transacation', 'token=' . $this->session->data['token'] . $url, true);
		
		$this->load->model('catalog/merchant'); 

			 

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => '',
				'filter_minute' => '',
				'start'        => 0,
				'limit'        => 500
			);

			$results = $this->model_catalog_merchant->getMerchants($filter_data);
			$data['merchants'] = array();
			foreach ($results as $result) { 
				$data['merchants'][] = array(
					'merchant_id' => $result['merchant_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				
				);
			}

		if (isset($this->request->get['transacation_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$transacation_info = $this->model_catalog_transacation->getTransacation($this->request->get['transacation_id']);
		}

		if (isset($this->request->post['transacation_date'])) {
			$data['transacation_date'] = $this->request->post['transacation_date'];
		} elseif (!empty($transacation_info)) {
			$data['transacation_date'] = $transacation_info['date_added'];
		} else {
			$data['transacation_date'] = date('Y-m-d');
		}

		if (isset($this->request->post['transacation_amt'])) {
			$data['transacation_amt'] = $this->request->post['transacation_amt'];
			
		} elseif (!empty($transacation_info)) {
			
			if($transacation_info['dr_amount']!=0){
			
				$data['transacation_amt'] = $transacation_info['dr_amount'];
				
				$data['transacation_type'] = 'dr';
				
			}elseif ($transacation_info['cr_amount']!=0){
			
				$data['transacation_amt'] = $transacation_info['cr_amount'];
				
				$data['transacation_type'] = 'cr';
			}
			
		} else {
			$data['transacation_amt'] = '';
			$data['transacation_type'] = 'dr';
		}
		
		if (isset($this->request->post['merchant_id'])) {
			$data['merchant_id'] = $this->request->post['merchant_id'];
		} elseif (!empty($transacation_info)) {
			$data['merchant_id'] = $transacation_info['merchant_id'];
		} else {
			$data['merchant_id'] = '';
		}
		
		if (isset($this->request->post['remarks'])) {
			$data['remarks'] = $this->request->post['remarks'];
		} elseif (!empty($transacation_info)) {
			$data['remarks'] = $transacation_info['remarks'];
		} else {
			$data['remarks'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/transacation_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/transacation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['transacation_date']) == 0)) {
			$this->error['transacation_date'] = 'Date is required';
		}

		if (utf8_strlen($this->request->post['merchant_id']) =='0') {
			$this->error['merchant_id'] = 'Merchant is required';
		}
		
		if (utf8_strlen($this->request->post['transacation_amt']) =='0' && $this->request->post['transacation_amt']=='') {
			$this->error['transacation_amt'] = 'Transacation Amount is required';
		}
		
		

		 

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/transacation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');
		$this->load->model('sale/order');

		foreach ($this->request->post['selected'] as $transacation_id) {
			$transacation_info = $this->model_catalog_transacation->getTransacation($transacation_id);

			if ($transacation_info) {
				if ($this->config->get('config_language') == $transacation_info['code']) {
					$this->error['warning'] = $this->language->get('error_default');
				}

				if ($this->config->get('config_admin_language') == $transacation_info['code']) {
					$this->error['warning'] = $this->language->get('error_admin');
				}

				$store_total = $this->model_setting_store->getTotalStoresByTransacation($transacation_info['code']);

				if ($store_total) {
					$this->error['warning'] = sprintf($this->language->get('error_store'), $store_total);
				}
			}

			$order_total = $this->model_sale_order->getTotalOrdersByTransacationId($transacation_id);

			if ($order_total) {
				$this->error['warning'] = sprintf($this->language->get('error_order'), $order_total);
			}
		}

		return !$this->error;
	}
}
