<?php
class ModelCatalogAtmosphere extends Model {
	public function addAtmosphere($data) { 
		foreach ($data['atmosphere'] as $language_id => $value) {
			if (isset($atmosphere_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "atmosphere SET atmosphere_id = '" . (int)$atmosphere_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "atmosphere SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$atmosphere_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('atmosphere');
		
		return $atmosphere_id;
	}

	public function editAtmosphere($atmosphere_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "atmosphere WHERE atmosphere_id = '" . (int)$atmosphere_id . "'");

		foreach ($data['atmosphere'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "atmosphere SET atmosphere_id = '" . (int)$atmosphere_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('atmosphere');
	}

	public function deleteAtmosphere($atmosphere_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "atmosphere WHERE atmosphere_id = '" . (int)$atmosphere_id . "'");

		$this->cache->delete('atmosphere');
	}

	public function getAtmosphere($atmosphere_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "atmosphere WHERE atmosphere_id = '" . (int)$atmosphere_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getAtmospheres($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "atmosphere WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
			$atmosphere_data = $this->cache->get('atmosphere.' . (int)$this->config->get('config_language_id'));

			if (!$atmosphere_data) {
				$query = $this->db->query("SELECT atmosphere_id, name FROM " . DB_PREFIX . "atmosphere WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$atmosphere_data = $query->rows;

				$this->cache->set('atmosphere.' . (int)$this->config->get('config_language_id'), $atmosphere_data);
			}

			return $atmosphere_data;
		}
	}

	public function getAtmosphereDescriptions($atmosphere_id) {
		$atmosphere_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "atmosphere WHERE atmosphere_id = '" . (int)$atmosphere_id . "'");

		foreach ($query->rows as $result) {
			$atmosphere_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $atmosphere_data;
	}

	public function getTotalAtmospheres() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "atmosphere WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}