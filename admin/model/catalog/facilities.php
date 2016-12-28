<?php
class ModelCatalogFacilities extends Model {
	public function addFacilities($data) { 
		foreach ($data['facilities'] as $language_id => $value) {
			if (isset($facilities_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "facilities SET facilities_id = '" . (int)$facilities_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "facilities SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$facilities_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('facilities');
		
		return $facilities_id;
	}

	public function editFacilities($facilities_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "facilities WHERE facilities_id = '" . (int)$facilities_id . "'");

		foreach ($data['facilities'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "facilities SET facilities_id = '" . (int)$facilities_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('facilities');
	}

	public function deleteFacilities($facilities_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "facilities WHERE facilities_id = '" . (int)$facilities_id . "'");

		$this->cache->delete('facilities');
	}

	public function getFacilities($facilities_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "facilities WHERE facilities_id = '" . (int)$facilities_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getFacilitiess($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "facilities WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sql .= " ORDER BY name";

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
			$facilities_data = $this->cache->get('facilities.' . (int)$this->config->get('config_language_id'));

			if (!$facilities_data) {
				$query = $this->db->query("SELECT facilities_id, name FROM " . DB_PREFIX . "facilities WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$facilities_data = $query->rows;

				$this->cache->set('facilities.' . (int)$this->config->get('config_language_id'), $facilities_data);
			}

			return $facilities_data;
		}
	}

	public function getFacilitiesDescriptions($facilities_id) {
		$facilities_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "facilities WHERE facilities_id = '" . (int)$facilities_id . "'");

		foreach ($query->rows as $result) {
			$facilities_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $facilities_data;
	}

	public function getTotalFacilitiess() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "facilities WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}