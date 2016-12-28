<?php
class ControllerMarketingRequestmerchants extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('marketing/merchantrequest');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/requestmerchants');

		$this->getList();
	}



	protected function getList() {
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
			'href' => $this->url->link('marketing/coupon', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('marketing/requestmerchants/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('marketing/requestmerchants/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['merchants'] = array();

		

		$coupon_total = $this->model_marketing_requestmerchants->getTotalMerchantRequests();

		$results = $this->model_marketing_requestmerchants->getAllMerchantRequests();

		foreach ($results as $result) {
			$data['merchants'][] = array(
				'merchant_request_id'  => $result['merchant_request_id'],
				'company'       => $result['company'],
				'street'       => $result['street'],
				'housenum'   => $result['housenum'],
				'city'		=> $result['city'],
				'phone'		=> $result['phone'],
				'type'		=> $result['request_type'], 
				
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'       => $this->url->link('marketing/requestmerchants/edit', 'token=' . $this->session->data['token'] . '&merchant_request_id=' . $result['merchant_request_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_street'] = $this->language->get('column_street');
		$data['column_house'] = $this->language->get('column_house');
		$data['column_city'] = $this->language->get('column_city');
		$data['column_phone'] = $this->language->get('column_phone');
		$data['column_type'] = $this->language->get('column_type');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		$data['sort_name'] = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_code'] = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . '&sort=code' . $url, true);
		$data['sort_discount'] = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . '&sort=discount' . $url, true);
		$data['sort_date_start'] = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . '&sort=date_start' . $url, true);
		$data['sort_date_end'] = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . '&sort=date_end' . $url, true);
		$data['sort_status'] = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . '&sort=status' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $coupon_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('marketing/requestmerchants', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($coupon_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($coupon_total - $this->config->get('config_limit_admin'))) ? $coupon_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $coupon_total, ceil($coupon_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/request_merchant_list', $data));
	}

	
}