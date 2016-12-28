<?php
class ModelMarketingRequestmerchants extends Model {

	public function getTotalMerchantRequests() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "merchant_request");

		return $query->row['total'];
	}

	public function getAllMerchantRequests() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_request");

		return $query->rows;
	}

	
}