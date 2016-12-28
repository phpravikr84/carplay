<?php
class ModeluserTicketing extends Model {
	public function addTicketing($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "ticketing SET  subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape(strip_tags($data['message'])) . "',   user_id = '" . (int)$data['user_id'] . "',status = 'Open', date_added = NOW()");

		$ticketing_id = $this->db->getLastId();

		$this->cache->delete('ticketing');

		return $ticketing_id;
	}

	public function editTicketing($ticketing_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "ticketing SET subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape(strip_tags($data['message'])) . "',   user_id = '" . (int)$data['user_id'] . "',status = '" .  $data['status'] . "', date_modified = NOW() WHERE ticketing_id = '" . (int)$ticketing_id . "'");

		$this->cache->delete('product');
	}
	
	public function addTicketingComent( $data) {
		$this->db->query("Insert " . DB_PREFIX . "ticketing_comment SET subject = '" . $this->db->escape($data['subject']) . "', message = '" . $this->db->escape(strip_tags($data['comment'])) . "',   user_id = '" . (int)$data['user_id'] . "',status = '" .  $data['status'] . "', date_added = NOW(), ticketing_id = '" . (int)$data['ticketing_id'] . "'");
		
		$this->db->query("UPDATE " . DB_PREFIX . "ticketing SET  status = '" .  $data['status'] . "', date_modified = NOW() WHERE ticketing_id = '" . (int)$data['ticketing_id'] . "'");

		$this->cache->delete('ticketing_comment');
	}

	public function deleteReview($ticketing_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "ticketing WHERE ticketing_id = '" . (int)$ticketing_id . "'");

		$this->cache->delete('ticketing');
	}

	public function getReview($ticketing_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "ticketing r WHERE r.ticketing_id = '" . (int)$ticketing_id . "'");

		return $query->row;
	}

	public function getTicketings($data = array()) {
		$sql = "SELECT r.ticketing_id,   r.subject, r.message, r.status, r.date_added FROM " . DB_PREFIX . "ticketing r   WHERE r.ticketing_id != ''";

		if (!empty($data['filter_subject'])) {
			$sql .= " AND r.subject LIKE '" . $this->db->escape($data['filter_subject']) . "%'";
		}
		
		if (!empty($data['filter_user_id'])) {
			$sql .= " AND r.user_id = '" . $this->db->escape($data['filter_user_id']) . "'";
		}

		if (!empty($data['filter_message'])) {
			$sql .= " AND r.message LIKE '" . $this->db->escape($data['filter_message']) . "%'";
		}


		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'pd.name',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
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
		
		//print $sql;

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalTicketings($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ticketing r  where r.ticketing_id !='' ";

		if (!empty($data['filter_subject'])) {
			$sql .= " AND r.subject LIKE '" . $this->db->escape($data['filter_subject']) . "%'";
		}
		
		if (!empty($data['filter_user_id'])) {
			$sql .= " AND r.user_id = '" . $this->db->escape($data['filter_user_id']) . "'";
		}

		if (!empty($data['filter_message'])) {
			$sql .= " AND r.message LIKE '" . $this->db->escape($data['filter_message']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalReviewsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ticketing WHERE status = '0'");

		return $query->row['total'];
	}
	
	public function getTicketingHistories($ticketing_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ticketing_comment oh  WHERE oh.ticketing_id = '" . (int)$ticketing_id . "'  ORDER BY oh.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	public function getTotalTicketingHistories($ticketing_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "ticketing_comment WHERE ticketing_id = '" . (int)$ticketing_id . "'");

		return $query->row['total'];
	}

}