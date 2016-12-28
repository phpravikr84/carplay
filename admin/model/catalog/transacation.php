<?php
class ModelCatalogTransacation extends Model {
	public function addTransacation($data) {
		
		//print $data['transacation_type']. "INSERT INTO " . DB_PREFIX . "transacation SET merchant_id = '" . $this->db->escape($data['merchant_id']) . "', dr_amount = '" . (int)($data['transacation_amt']) . "', remarks = '" . $this->db->escape($data['remarks']) . "', date_added='".$data['transacation_date']."', status=1";exit;
		
		if($data['transacation_type'] =='dr'){
			$this->db->query("INSERT INTO " . DB_PREFIX . "transacation SET merchant_id = '" . $this->db->escape($data['merchant_id']) . "', dr_amount = '" . (int)($data['transacation_amt']) . "', remarks = '" . $this->db->escape($data['remarks']) . "', date_added='".$data['transacation_date']."' ,status=1");

		}elseif($data['transacation_type'] =='cr'){
			$this->db->query("INSERT INTO " . DB_PREFIX . "transacation SET merchant_id = '" . $this->db->escape($data['merchant_id']) . "', cr_amount = '" . (int)($data['transacation_amt']) . "', remarks = '" . $this->db->escape($data['remarks']) . "', date_added='".$data['transacation_date']."',status=1");
		
		}
		
		$this->cache->delete('transacation');

		$transacation_id = $this->db->getLastId();

		 
	}

	public function editTransacation($transacation_id, $data) {
		if($data['transacation_type'] =='dr'){
			$this->db->query("UPDATE " . DB_PREFIX . "transacation SET merchant_id = '" . $this->db->escape($data['merchant_id']) . "', dr_amount = '" . (int)($data['transacation_amt']) . "', remarks = '" . $this->db->escape($data['remarks']) . "', date_added='".$data['transacation_date']."',status=1 WHERE transacation_id = '" . (int)$transacation_id . "'");
		
		}elseif($data['transacation_type'] =='cr'){
		
			$this->db->query("UPDATE " . DB_PREFIX . "transacation SET merchant_id = '" . $this->db->escape($data['merchant_id']) . "', cr_amount = '" . (int)($data['transacation_amt']) . "', remarks = '" . $this->db->escape($data['remarks']) . "', date_added='".$data['transacation_date']."',status=1 WHERE transacation_id = '" . (int)$transacation_id . "'");
		
		}
		
		$this->cache->delete('transacation');
	}

	public function deleteTransacation($transacation_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "transacation WHERE transacation_id = '" . (int)$transacation_id . "'");

		$this->cache->delete('transacation');

		 
	}
	
	public function getMerchantNameByMerchantId($merchant_id) {
		$sql = "SELECT DISTINCT *, "
                        . "(SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'merchant_id=" . (int)$merchant_id . "') AS keyword FROM " . DB_PREFIX . "merchant p "
                        . "LEFT JOIN " . DB_PREFIX . "merchant_description pd ON (p.merchant_id = pd.merchant_id) "
                        . "WHERE p.merchant_id = '" . (int)$merchant_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
                
		$query = $this->db->query($sql);
		if(isset($query->row['name'])){
			return $query->row['name'];
		}else{
			return '';
		}
	} 
	public function getTransacation($transacation_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "transacation WHERE transacation_id = '" . (int)$transacation_id . "'");

		return $query->row;
	}

	public function getTransacations($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "transacation WHERE status=1";
			
			if (!empty($data['filter_merchant']) && $data['filter_merchant']!=0) {
				$sql .= " AND merchant_id = '" . $this->db->escape($data['filter_merchant']) . "'";
			}
			
			if (!empty($data['filter_remarks'])) {
				$sql .= " AND remarks LIKE '%" . $this->db->escape($data['filter_remarks']) . "%'";
			}
			
			if (!empty($data['filter_date']) && !empty($data['filter_todate'])) {
				//$sql .= " AND date_added = '" . $this->db->escape($data['filter_date']) . "'";
				
				$sql .= " AND date_added   BETWEEN '" . $data['filter_date'] . "' AND  '" . $data['filter_todate'] . "'";
				
				 
			}

			$sort_data = array(
				'name',
				'code',
				'sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY sort_order, name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$language_data = $this->cache->get('language');

			if (!$language_data) {
				$language_data = array();

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "transacation ORDER BY sort_order, name");

				foreach ($query->rows as $result) {
					$language_data[$result['code']] = array(
						'transacation_id' => $result['transacation_id'],
						'name'        => $result['name'],
						'code'        => $result['code'],
						'sort_order'  => $result['sort_order'],
						'status'      => $result['status']
					);
				}

				$this->cache->set('language', $language_data);
			}

			return $language_data;
		}
	}

	public function getTransacationByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE code = '" . $this->db->escape($code) . "'");

		return $query->row;
	}

	public function getTotalTransacations($data) {
		
		
		$sql = "SELECT  COUNT(*) AS total FROM " . DB_PREFIX . "transacation WHERE status=1";
			
			if (!empty($data['filter_merchant']) && $data['filter_merchant']!=0) {
				$sql .= " AND merchant_id = '" . $this->db->escape($data['filter_merchant']) . "'";
			}
			
			if (!empty($data['filter_remarks'])) {
				$sql .= " AND remarks LIKE '%" . $this->db->escape($data['filter_remarks']) . "%'";
			}
			
			if (!empty($data['filter_date']) && !empty($data['filter_todate'])) {
				//$sql .= " AND date_added = '" . $this->db->escape($data['filter_date']) . "'";
				
				$sql .= " AND date_added   BETWEEN '" . $data['filter_date'] . "' AND  '" . $data['filter_todate'] . "'";
				
				 
			}
			
			$query = $this->db->query($sql);
		

		return $query->row['total'];
	}
}
