<?php
class ModelCatalogOffer extends Model {
	public function addOffer($data) {
		$sql = "INSERT INTO " . DB_PREFIX . "offer SET 
		 minute = '" . $this->db->escape($data['minute']) . "',  
		 merchant_id = '" . (int)$data['merchant_id'] . "',
		 price = '" . (float)$data['price'] . "', 
		 points = '" . (int)$data['points'] . "',  
		 status = '" . (int)$data['status'] . "', 
		 tax_class_id = '" . (int)$data['tax_class_id'] . "', 
		 sort_order = '" . (int)$data['sort_order'] . "', 
		 date_added = NOW()";
		
		$this->db->query($sql);

		$offer_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "offer SET image = '" . $this->db->escape($data['image']) . "' WHERE offer_id = '" . (int)$offer_id . "'");
		}

		foreach ($data['offer_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "offer_description SET offer_id = '" . (int)$offer_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}  

		if (isset($data['offer_image'])) {
			foreach ($data['offer_image'] as $offer_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_image SET offer_id = '" . (int)$offer_id . "', image = '" . $this->db->escape($offer_image['image']) . "', sort_order = '" . (int)$offer_image['sort_order'] . "'");
			}
		}
		
		//Merchant Discount
		//print_r($data['merchant_discount']); 
		 
		if (isset($data['offer_discount'])) {
			foreach ($data['offer_discount'] as $offer_discount) {
				
				$sql = "INSERT INTO " . DB_PREFIX . "offer_discount SET 
					offer_id = '" . (int)$offer_id . "',
					offer_time = '" . $this->db->escape($offer_discount['offer_time']) . "',
					mon_percentage = '" . (int)$offer_discount['mon_percentage']. "' , 
					mon_packs = '" . (int)$offer_discount['mon_packs'] . "', 
					tue_percentage = '" . (int)$offer_discount['tue_percentage'] . "' , 
					tue_packs = '" . (int)$offer_discount['tue_packs'] . "', 
					wed_percentage = '" . (int)$offer_discount['wed_percentage'] . "', 
					wed_packs = '" . (int)$offer_discount['wed_packs'] . "', 
					thu_percentage = '" . (int)$offer_discount['thu_percentage'] . "', 
					thu_packs = '" . (int)$offer_discount['thu_packs'] . "',
					fri_percentage = '" . (int)$offer_discount['fri_percentage'] . "', 
					fri_packs = '" . (int)$offer_discount['fri_packs'] . "', 
					sat_percentage = '" . (int)$offer_discount['sat_percentage'] . "', 
					sat_packs = '" . (int)$offer_discount['sat_packs'] . "', 
					sun_percentage = '" . (int)$offer_discount['sun_percentage'] . "', 
					sun_packs = '" . (int)$offer_discount['sun_packs'] . "', 
					date_modified = NOW()";
				
				$this->db->query($sql);
				
				//print $sql;exit;
			}
		}    

		if (isset($data['offer_category'])) {
			foreach ($data['offer_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_category SET offer_id = '" . (int)$offer_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		 
		if (isset($data['offer_related'])) {
			foreach ($data['offer_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$offer_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$offer_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$related_id . "' AND related_id = '" . (int)$offer_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$related_id . "', related_id = '" . (int)$offer_id . "'");
			}
		}

		if (isset($data['offer_reward'])) {
			foreach ($data['offer_reward'] as $customer_group_id => $offer_reward) {
				if ((int)$offer_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "offer_reward SET offer_id = '" . (int)$offer_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$offer_reward['points'] . "'");
				}
			}
		} 
		 

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'offer_id=" . (int)$offer_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} 

		$this->cache->delete('offer');

		return $offer_id;
	}

	public function editOffer($offer_id, $data) {
		 
		$sql = "UPDATE " . DB_PREFIX . "offer SET 
		 minute = '" . $this->db->escape($data['minute']) . "',  
		  merchant_id = '" . (int)$data['merchant_id'] . "',
		 price = '" . (float)$data['price'] . "', 
		 points = '" . (int)$data['points'] . "',  
		 status = '" . (int)$data['status'] . "', 
		 tax_class_id = '" . (int)$data['tax_class_id'] . "', 
		 sort_order = '" . (int)$data['sort_order'] . "', 
		 date_modified = NOW() WHERE offer_id='".$offer_id."'";
		$this->db->query($sql);
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "offer SET image = '" . $this->db->escape($data['image']) . "' WHERE offer_id = '" . (int)$offer_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_description WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($data['offer_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "offer_description SET offer_id = '" . (int)$offer_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_store WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_store'])) {
			foreach ($data['offer_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_store SET offer_id = '" . (int)$offer_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		//Merchant Discount
		//print '<pre>'; print_r($data); exit;
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_discount WHERE offer_id = '" . (int)$offer_id . "'");
		if (isset($data['offer_discount'])) {
			foreach ($data['offer_discount'] as $offer_discount) {
				
				$sql = "INSERT INTO " . DB_PREFIX . "offer_discount SET 
					offer_id = '" . (int)$offer_id . "',
					offer_time = '" . $this->db->escape($offer_discount['offer_time']) . "',
					mon_percentage = '" . (int)$offer_discount['mon_percentage']. "' , 
					mon_packs = '" . (int)$offer_discount['mon_packs'] . "', 
					tue_percentage = '" . (int)$offer_discount['tue_percentage'] . "' , 
					tue_packs = '" . (int)$offer_discount['tue_packs'] . "', 
					wed_percentage = '" . (int)$offer_discount['wed_percentage'] . "', 
					wed_packs = '" . (int)$offer_discount['wed_packs'] . "', 
					thu_percentage = '" . (int)$offer_discount['thu_percentage'] . "', 
					thu_packs = '" . (int)$offer_discount['thu_packs'] . "',
					fri_percentage = '" . (int)$offer_discount['fri_percentage'] . "', 
					fri_packs = '" . (int)$offer_discount['fri_packs'] . "', 
					sat_percentage = '" . (int)$offer_discount['sat_percentage'] . "', 
					sat_packs = '" . (int)$offer_discount['sat_packs'] . "', 
					sun_percentage = '" . (int)$offer_discount['sun_percentage'] . "', 
					sun_packs = '" . (int)$offer_discount['sun_packs'] . "', 
					date_modified = NOW()";
				
				$this->db->query($sql);
				
				//print $sql;exit;
			}
		}   

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_special WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_special'])) {
			foreach ($data['offer_special'] as $offer_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_special SET offer_id = '" . (int)$offer_id . "', customer_group_id = '" . (int)$offer_special['customer_group_id'] . "', priority = '" . (int)$offer_special['priority'] . "', price = '" . (float)$offer_special['price'] . "', date_start = '" . $this->db->escape($offer_special['date_start']) . "', date_end = '" . $this->db->escape($offer_special['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_image WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_image'])) {
			foreach ($data['offer_image'] as $offer_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_image SET offer_id = '" . (int)$offer_id . "', image = '" . $this->db->escape($offer_image['image']) . "', sort_order = '" . (int)$offer_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_download WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_download'])) {
			foreach ($data['offer_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_download SET offer_id = '" . (int)$offer_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_category'])) {
			foreach ($data['offer_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_category SET offer_id = '" . (int)$offer_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_filter WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_filter'])) {
			foreach ($data['offer_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_filter SET offer_id = '" . (int)$offer_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE related_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_related'])) {
			foreach ($data['offer_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$offer_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$offer_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$related_id . "' AND related_id = '" . (int)$offer_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$related_id . "', related_id = '" . (int)$offer_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_reward WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_reward'])) {
			foreach ($data['offer_reward'] as $customer_group_id => $value) {
				if ((int)$value['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "offer_reward SET offer_id = '" . (int)$offer_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_layout WHERE offer_id = '" . (int)$offer_id . "'");

		if (isset($data['offer_layout'])) {
			foreach ($data['offer_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_layout SET offer_id = '" . (int)$offer_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'offer_id=" . (int)$offer_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'offer_id=" . (int)$offer_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "offer_recurring` WHERE offer_id = " . (int)$offer_id);

		if (isset($data['offer_recurring'])) {
			foreach ($data['offer_recurring'] as $offer_recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "offer_recurring` SET `offer_id` = " . (int)$offer_id . ", customer_group_id = " . (int)$offer_recurring['customer_group_id'] . ", `recurring_id` = " . (int)$offer_recurring['recurring_id']);
			}
		}

		$this->cache->delete('offer');
	}

	public function copyOffer($offer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "offer p WHERE p.offer_id = '" . (int)$offer_id . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0';

			$data['offer_attribute'] = $this->getOfferAttributes($offer_id);
			$data['offer_description'] = $this->getOfferDescriptions($offer_id);
			$data['offer_discount'] = $this->getOfferDiscounts($offer_id);
			$data['offer_filter'] = $this->getOfferFilters($offer_id);
			$data['offer_image'] = $this->getOfferImages($offer_id);
			$data['offer_option'] = $this->getOfferOptions($offer_id);
			$data['offer_related'] = $this->getOfferRelated($offer_id);
			$data['offer_reward'] = $this->getOfferRewards($offer_id);
			$data['offer_special'] = $this->getOfferSpecials($offer_id);
			$data['offer_category'] = $this->getOfferCategories($offer_id);
			$data['offer_download'] = $this->getOfferDownloads($offer_id);
			$data['offer_layout'] = $this->getOfferLayouts($offer_id);
			$data['offer_store'] = $this->getOfferStores($offer_id);
			$data['offer_recurrings'] = $this->getRecurrings($offer_id);

			$this->addOffer($data);
		}
	}

	public function deleteOffer($offer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_description WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_discount WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_filter WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_image WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_option WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_option_value WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE related_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_reward WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_special WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_download WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_layout WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_store WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_recurring WHERE offer_id = " . (int)$offer_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE offer_id = '" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'offer_id=" . (int)$offer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_offer WHERE offer_id = '" . (int)$offer_id . "'");

		$this->cache->delete('offer');
	}

	public function getOffer($offer_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'offer_id=" . (int)$offer_id . "') AS keyword FROM " . DB_PREFIX . "offer p LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) WHERE p.offer_id = '" . (int)$offer_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getOffers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "offer p LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_minute'])) {
			$sql .= " AND p.minute LIKE '" . $this->db->escape($data['filter_minute']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_merchant_id']) && !is_null($data['filter_merchant_id'])) {
			$sql .= " AND p.merchant_id = '" . (int)($data['filter_merchant_id']) . "'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$sql .= " GROUP BY p.offer_id";

		$sort_data = array(
			'pd.name',
			'p.minute',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
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
	}

	public function getOffersByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer p LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id) LEFT JOIN " . DB_PREFIX . "offer_to_category p2c ON (p.offer_id = p2c.offer_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getOfferDescriptions($offer_id) {
		$offer_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_description WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $offer_description_data;
	}

	public function getOfferCategories($offer_id) {
		$offer_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_category_data[] = $result['category_id'];
		}

		return $offer_category_data;
	}

	public function getOfferFilters($offer_id) {
		$offer_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_filter WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_filter_data[] = $result['filter_id'];
		}

		return $offer_filter_data;
	}

	public function getOfferAttributes($offer_id) {
		$offer_attribute_data = array();

		$offer_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$offer_id . "' GROUP BY attribute_id");

		foreach ($offer_attribute_query->rows as $offer_attribute) {
			$offer_attribute_description_data = array();

			$offer_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$offer_id . "' AND attribute_id = '" . (int)$offer_attribute['attribute_id'] . "'");

			foreach ($offer_attribute_description_query->rows as $offer_attribute_description) {
				$offer_attribute_description_data[$offer_attribute_description['language_id']] = array('text' => $offer_attribute_description['text']);
			}

			$offer_attribute_data[] = array(
				'attribute_id'                  => $offer_attribute['attribute_id'],
				'offer_attribute_description' => $offer_attribute_description_data
			);
		}

		return $offer_attribute_data;
	}

	public function getOfferOptions($offer_id) {
		$offer_option_data = array();

		$offer_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.offer_id = '" . (int)$offer_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		foreach ($offer_option_query->rows as $offer_option) {
			$offer_option_value_data = array();

			$offer_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_option_value WHERE offer_option_id = '" . (int)$offer_option['offer_option_id'] . "'");

			foreach ($offer_option_value_query->rows as $offer_option_value) {
				$offer_option_value_data[] = array(
					'offer_option_value_id' => $offer_option_value['offer_option_value_id'],
					'option_value_id'         => $offer_option_value['option_value_id'],
					'quantity'                => $offer_option_value['quantity'],
					'subtract'                => $offer_option_value['subtract'],
					'price'                   => $offer_option_value['price'],
					'price_prefix'            => $offer_option_value['price_prefix'],
					'points'                  => $offer_option_value['points'],
					'points_prefix'           => $offer_option_value['points_prefix'],
					'weight'                  => $offer_option_value['weight'],
					'weight_prefix'           => $offer_option_value['weight_prefix']
				);
			}

			$offer_option_data[] = array(
				'offer_option_id'    => $offer_option['offer_option_id'],
				'offer_option_value' => $offer_option_value_data,
				'option_id'            => $offer_option['option_id'],
				'name'                 => $offer_option['name'],
				'type'                 => $offer_option['type'],
				'value'                => $offer_option['value'],
				'required'             => $offer_option['required']
			);
		}

		return $offer_option_data;
	}

	public function getOfferOptionValue($offer_id, $offer_option_value_id) {
		$query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "offer_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.offer_id = '" . (int)$offer_id . "' AND pov.offer_option_value_id = '" . (int)$offer_option_value_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getOfferImages($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_image WHERE offer_id = '" . (int)$offer_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getOfferDiscounts($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_discount WHERE offer_id = '" . (int)$offer_id . "'");

		return $query->rows;
	}

	public function getOfferSpecials($offer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_special WHERE offer_id = '" . (int)$offer_id . "' ORDER BY priority, price");

		return $query->rows;
	}

	public function getOfferRewards($offer_id) {
		$offer_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_reward WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $offer_reward_data;
	}

	public function getOfferDownloads($offer_id) {
		$offer_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_to_download WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_download_data[] = $result['download_id'];
		}

		return $offer_download_data;
	}

	public function getOfferStores($offer_id) {
		$offer_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_to_store WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_store_data[] = $result['store_id'];
		}

		return $offer_store_data;
	}

	public function getOfferLayouts($offer_id) {
		$offer_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_to_layout WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $offer_layout_data;
	}

	public function getOfferRelated($offer_id) {
		$offer_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$offer_id . "'");

		foreach ($query->rows as $result) {
			$offer_related_data[] = $result['related_id'];
		}

		return $offer_related_data;
	}

	public function getRecurrings($offer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "offer_recurring` WHERE offer_id = '" . (int)$offer_id . "'");

		return $query->rows;
	}

	public function getTotalOffers($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.offer_id) AS total FROM " . DB_PREFIX . "offer p LEFT JOIN " . DB_PREFIX . "offer_description pd ON (p.offer_id = pd.offer_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_minute'])) {
			$sql .= " AND p.minute LIKE '" . $this->db->escape($data['filter_minute']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalOffersByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByProfileId($recurring_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer_recurring WHERE recurring_id = '" . (int)$recurring_id . "'");

		return $query->row['total'];
	}

	public function getTotalOffersByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "offer_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
