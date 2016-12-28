<?php
class ControllerDashboardSale extends Controller {
	public function index() { //print 'santanu';
		$this->load->language('dashboard/sale');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];
		
		if(isset($this->session->data['merchant_id']) && $this->session->data['merchant_id'] !=0){
			$filter_merchant_id = $this->session->data['merchant_id'];
		}else{
			$filter_merchant_id = '';
		}

		$this->load->model('report/sale');

		$today = $this->model_report_sale->getTotalSales(array('filter_date_added' => date('Y-m-d', strtotime('-1 day')), 'filter_merchant_id'=> $filter_merchant_id ));

		$yesterday = $this->model_report_sale->getTotalSales(array('filter_date_added' => date('Y-m-d', strtotime('-2 day')), 'filter_merchant_id'=> $filter_merchant_id ));

		$difference = $today - $yesterday;

		if ($difference && (int)$today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$sale_total = $this->model_report_sale->getTotalSaless(array('filter_merchant_id'=> $filter_merchant_id));

		if ($sale_total > 1000000000000) {
			$data['total'] = round($sale_total / 1000000000000, 1) . 'T';
		} elseif ($sale_total > 1000000000) {
			$data['total'] = round($sale_total / 1000000000, 1) . 'B';
		} elseif ($sale_total > 1000000) {
			$data['total'] = round($sale_total / 1000000, 1) . 'M';
		} elseif ($sale_total > 1000) {
			$data['total'] = round($sale_total / 1000, 1) . 'K';
		} else {
			$data['total'] = round($sale_total);
		}

		$data['sale'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], true);

		return $this->load->view('dashboard/sale', $data);
	}
}
