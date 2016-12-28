<?php
class ModelCatalogSpokenlanguage extends Model {
	public function addSpokenlanguage($data) { 
		foreach ($data['spokenlanguage'] as $language_id => $value) {
			if (isset($spokenlanguage_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "spokenlanguage SET spokenlanguage_id = '" . (int)$spokenlanguage_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "spokenlanguage SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$spokenlanguage_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('spokenlanguage');
		
		return $spokenlanguage_id;
	}

	public function editSpokenlanguage($spokenlanguage_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "spokenlanguage WHERE spokenlanguage_id = '" . (int)$spokenlanguage_id . "'");

		foreach ($data['spokenlanguage'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "spokenlanguage SET spokenlanguage_id = '" . (int)$spokenlanguage_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('spokenlanguage');
	}

	public function deleteSpokenlanguage($spokenlanguage_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "spokenlanguage WHERE spokenlanguage_id = '" . (int)$spokenlanguage_id . "'");

		$this->cache->delete('spokenlanguage');
	}

	public function getSpokenlanguage($spokenlanguage_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "spokenlanguage WHERE spokenlanguage_id = '" . (int)$spokenlanguage_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getSpokenlanguages($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "spokenlanguage WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
			$spokenlanguage_data = $this->cache->get('spokenlanguage.' . (int)$this->config->get('config_language_id'));

			if (!$spokenlanguage_data) {
				$query = $this->db->query("SELECT spokenlanguage_id, name FROM " . DB_PREFIX . "spokenlanguage WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$spokenlanguage_data = $query->rows;

				$this->cache->set('spokenlanguage.' . (int)$this->config->get('config_language_id'), $spokenlanguage_data);
			}

			return $spokenlanguage_data;
		}
	}

	public function getSpokenlanguageDescriptions($spokenlanguage_id) {
		$spokenlanguage_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "spokenlanguage WHERE spokenlanguage_id = '" . (int)$spokenlanguage_id . "'");

		foreach ($query->rows as $result) {
			$spokenlanguage_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $spokenlanguage_data;
	}

	public function getTotalSpokenlanguages() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "spokenlanguage WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}