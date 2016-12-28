<?php
class ControllerDashboardOrder extends Controller {
	public function index() { 
		$this->load->language('dashboard/order');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('sale/order');
		
		if(isset($this->session->data['merchant_id'])){
			$filter_merchatn_id = $this->session->data['merchant_id'];
		}else{
			$filter_merchatn_id = '';
		}
		
		//print $filter_merchatn_id;
		

		$today = $this->model_sale_order->getTotalOrders(array('filter_date_added' => date('Y-m-d', strtotime('-1 day')), 'filter_merchatn_id'=>$filter_merchatn_id));

		$yesterday = $this->model_sale_order->getTotalOrders(array('filter_date_added' => date('Y-m-d', strtotime('-2 day')), 'filter_merchatn_id'=>$filter_merchatn_id));

		$difference = $today - $yesterday;

		if ($difference && $today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$order_total = $this->model_sale_order->getTotalOrderes(array('filter_merchant_id' => $filter_merchatn_id));

		if ($order_total > 1000000000000) {
			$data['total'] = round($order_total / 1000000000000, 1) . 'T';
		} elseif ($order_total > 1000000000) {
			$data['total'] = round($order_total / 1000000000, 1) . 'B';
		} elseif ($order_total > 1000000) {
			$data['total'] = round($order_total / 1000000, 1) . 'M';
		} elseif ($order_total > 1000) {
			$data['total'] = round($order_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $order_total;
		}
		
		//$data['total'] = 3;

		$data['order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], true);

		return $this->load->view('dashboard/order', $data);
	}
}