<?php
class ModelTotalDisc extends Model {
	public function getTotal($total) {
		$this->load->language('total/total');

		$total['totals'][] = array(
			'code'       => 'disc',
			'title'      => 'Discount Amount',
			'value'      => max(0, $total['total']),
			'sort_order' => $this->config->get('total_sort_order')
		);
	}
}