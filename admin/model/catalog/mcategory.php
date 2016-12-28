<?php
class ModelCatalogMcategory extends Model {
	public function addMcategory($data) {
		foreach ($data['mcategory'] as $language_id => $value) {
			if (isset($mcategory_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "mcategory SET mcategory_id = '" . (int)$mcategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "mcategory SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$mcategory_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('mcategory');
		
		return $mcategory_id;
	}

	public function editMcategory($mcategory_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "mcategory WHERE mcategory_id = '" . (int)$mcategory_id . "'");

		foreach ($data['mcategory'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "mcategory SET mcategory_id = '" . (int)$mcategory_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('mcategory');
	}

	public function deleteMcategory($mcategory_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "mcategory WHERE mcategory_id = '" . (int)$mcategory_id . "'");

		$this->cache->delete('mcategory');
	}

	public function getMcategory($mcategory_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mcategory WHERE mcategory_id = '" . (int)$mcategory_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getMcategories($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "mcategory WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
			$mcategory_data = $this->cache->get('mcategory.' . (int)$this->config->get('config_language_id'));

			if (!$mcategory_data) {
				$query = $this->db->query("SELECT mcategory_id, name FROM " . DB_PREFIX . "mcategory WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$mcategory_data = $query->rows;

				$this->cache->set('mcategory.' . (int)$this->config->get('config_language_id'), $mcategory_data);
			}

			return $mcategory_data;
		}
	}

	public function getMcategoryDescriptions($mcategory_id) {
		$mcategory_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "mcategory WHERE mcategory_id = '" . (int)$mcategory_id . "'");

		foreach ($query->rows as $result) {
			$mcategory_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $mcategory_data;
	}

	public function getTotalMcategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "mcategory WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}