<?php
class ModelCatalogMerchant extends Model {
	public function addMerchant($data) {
                
       $sql = "INSERT INTO " . DB_PREFIX . "merchant SET "
			. "date_available = '" . $this->db->escape($data['date_available']) . "', " 
			. "capacity = '" . (int)$data['capacity'] . "', " 
			. "no_of_staff = '" . (int)$data['no_of_staff'] . "', " 
			. "from_opeining_hours = '" . $this->db->escape($data['from_opeining_hours']) . "', " 
			. "to_opening_hours = '" . $this->db->escape($data['to_opening_hours']) . "', " 
			. "latitude = '" . $this->db->escape($data['latitude']) . "', " 
			. "longitude = '" . $this->db->escape($data['longitude']) . "', " 
			. "status = '" . (int)$data['status'] . "', " 
			. "sort_order = '" . (int)$data['sort_order'] . "', "
			. "date_added = NOW()";
            
		$this->db->query($sql);

		$merchant_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "merchant SET image = '" . $this->db->escape($data['image']) . "' WHERE merchant_id = '" . (int)$merchant_id . "'");
		}

		foreach ($data['merchant_description'] as $language_id => $value) {
                    $sqlDesc = "INSERT INTO " . DB_PREFIX . "merchant_description SET "
                            . "merchant_id = '" . (int)$merchant_id . "', "
                            . "language_id = '" . (int)$language_id . "', "
                            . "name = '" . $this->db->escape($value['name']) . "', " 
                            . "contact_person = '" . $this->db->escape($value['contact_person']) . "', "
                            . "email = '" . $this->db->escape($value['email']) . "', "
                            . "phone = '" . $this->db->escape($value['phone']) . "', "
                            . "mobile = '" . $this->db->escape($value['mobile']) . "', "
                            . "address = '" . $this->db->escape($value['address']) . "', "
                            . "city = '" . $this->db->escape($value['city']) . "', "
                            . "country_id = '" . $this->db->escape($value['country_id']) . "', "
                            . "zone_id = '" . $this->db->escape($value['zone_id']) . "', "
							. "city_id = '" . $this->db->escape($value['city_id']) . "', "
							. "location_id = '" . $this->db->escape($value['location_id']) . "', "
                            . "zip = '" . $this->db->escape($value['zip']) . "', "
                            . "website = '" . $this->db->escape($value['website']) . "', "
                            . "description = '" . $this->db->escape($value['description']) . "', "
							  . "terms = '" . $this->db->escape($value['terms']) . "', "
                            . "tag = '" . $this->db->escape($value['tag']) . "', "
                            . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                            . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                            . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'";
                     
			$this->db->query($sqlDesc);
		} 
		
		//Merchant Discount
		if (isset($data['merchant_discount'])){
			foreach ($data['merchant_discount'] as $merchant_discount) { 
				$sql = "INSERT INTO " . DB_PREFIX . "merchant_discount SET 
					merchant_id = '" . (int)$merchant_id . "',
					merchant_time = '" . $this->db->escape($merchant_discount['merchant_time']) . "',
                                        sort_order = '" . $this->db->escape($merchant_discount['sort_order']) . "', 
					mon_percentage = '" . (int)$merchant_discount['mon_percentage']. "' , 
					mon_packs = '" . (int)$merchant_discount['mon_packs'] . "', 
					tue_percentage = '" . (int)$merchant_discount['tue_percentage'] . "' , 
					tue_packs = '" . (int)$merchant_discount['tue_packs'] . "', 
					wed_percentage = '" . (int)$merchant_discount['wed_percentage'] . "', 
					wed_packs = '" . (int)$merchant_discount['wed_packs'] . "', 
					thu_percentage = '" . (int)$merchant_discount['thu_percentage'] . "', 
					thu_packs = '" . (int)$merchant_discount['thu_packs'] . "',
					fri_percentage = '" . (int)$merchant_discount['fri_percentage'] . "', 
					fri_packs = '" . (int)$merchant_discount['fri_packs'] . "', 
					sat_percentage = '" . (int)$merchant_discount['sat_percentage'] . "', 
					sat_packs = '" . (int)$merchant_discount['sat_packs'] . "', 
					sun_percentage = '" . (int)$merchant_discount['sun_percentage'] . "', 
					sun_packs = '" . (int)$merchant_discount['sun_packs'] . "', 
					date_modified = NOW()";
				$this->db->query($sql);
			}
		} 
		
		//Merchant Atmosphere 
		if (isset($data['merchant_atmosphere'])) {
			foreach ($data['merchant_atmosphere'] as $atmosphere_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_to_atmosphere SET merchant_id = '" . (int)$merchant_id . "',   atmosphere_id = '" . (int)$atmosphere_id . "'");
			}
		} 
		
		//Merchant Facilities 
		if (isset($data['merchant_facilities'])) {
			foreach ($data['merchant_facilities'] as $facilities_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_to_facilities SET merchant_id = '" . (int)$merchant_id . "',   facilities_id = '" . (int)$facilities_id . "'");
			}
		} 
		
		//Merchant Spoken Languages 
		if (isset($data['merchant_spokenlanguage'])) {
			foreach ($data['merchant_spokenlanguage'] as $spokenlanguage_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_to_spokenlanguage SET merchant_id = '" . (int)$merchant_id . "',   spokenlanguage_id = '" . (int)$spokenlanguage_id . "'");
			}
		} 
		//Merchant Image
		if (isset($data['merchant_image'])) {
			foreach ($data['merchant_image'] as $merchant_image) {
				$sql = "INSERT INTO " . DB_PREFIX . "merchant_image SET "
						. "merchant_id = '" . (int)$merchant_id . "', "
						. "image = '" . $this->db->escape($merchant_image['image']) . "', "
						. "sort_order = '" . (int)$merchant_image['sort_order'] . "'";
				$this->db->query($sql);
			}
		}  

		if (isset($data['merchant_reward'])) {
			foreach ($data['merchant_reward'] as $customer_group_id => $merchant_reward) {
				if ((int)$merchant_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_reward SET merchant_id = '" . (int)$merchant_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$merchant_reward['points'] . "'");
				}
			}
		} 
                
                 //Merchant Services
		//print_r($data['merchant_discount']); 
		 
		if (isset($data['merchant_service'])) {
			foreach ($data['merchant_service'] as $merchant_service) {
				
				$sql = "INSERT INTO " . DB_PREFIX . "merchant_products SET 
					merchant_id = '" . (int)$merchant_id . "',
					product_id = '" . (int)($merchant_service['service_id']) . "',
                                        product_desc = '".$merchant_service['product_desc']."',
					duration = '" . (int)$merchant_service['duration']. "' , 
					price = '" . (int)$merchant_service['price'] . "', 
					date_modified = NOW()";
				
				$this->db->query($sql);
				
				//print $sql;exit;
			}
		} 

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'merchant_id=" . (int)$merchant_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} 

		$this->cache->delete('merchant');

		return $merchant_id;
	}

	public function editMerchant($merchant_id, $data) {
	 
		$sql = "UPDATE " . DB_PREFIX . "merchant SET "
			. "date_available = '" . $this->db->escape($data['date_available']) . "', " 
			. "capacity = '" . (int)$data['capacity'] . "', " 
			. "no_of_staff = '" . (int)$data['no_of_staff'] . "', " 
			. "from_opeining_hours = '" . $this->db->escape($data['from_opeining_hours']) . "', " 
			. "to_opening_hours = '" . $this->db->escape($data['to_opening_hours']) . "', " 
			. "latitude = '" . $this->db->escape($data['latitude']) . "', " 
			. "longitude = '" . $this->db->escape($data['longitude']) . "', " 
			. "status = '" . (int)$data['status'] . "', " 
			. "sort_order = '" . (int)$data['sort_order'] . "', "
			. "date_modified = NOW() WHERE merchant_id = '" . (int)$merchant_id . "'";
			
		$this->db->query($sql);
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "merchant SET image = '" . $this->db->escape($data['image']) . "' WHERE merchant_id = '" . (int)$merchant_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_description WHERE merchant_id = '" . (int)$merchant_id . "'");
		
		//print '<pre>'; print_r($data['merchant_description'] );exit;
		
		foreach ($data['merchant_description'] as $language_id => $value) {
			
                     $sqlDesc = "INSERT INTO " . DB_PREFIX . "merchant_description SET "
                            . "merchant_id = '" . (int)$merchant_id . "', "                           
                            . "language_id = '" . (int)$language_id . "', "
                            . "name = '" . $this->db->escape($value['name']) . "', " 
                            . "contact_person = '" . $this->db->escape($value['contact_person']) . "', "
                            . "email = '" . $this->db->escape($value['email']) . "', "
                            . "phone = '" . $this->db->escape($value['phone']) . "', "
                            . "mobile = '" . $this->db->escape($value['mobile']) . "', "
                            . "address = '" . $this->db->escape($value['address']) . "', "
							. "location_id = '" . $this->db->escape($value['location_id']) . "', "
							. "city_id = '" . $this->db->escape($value['city_id']) . "', "
                            . "country_id = '" . $this->db->escape($value['country_id']) . "', "
                            . "zone_id = '" . $this->db->escape($value['zone_id']) . "', "
                            . "zip = '" . $this->db->escape($value['zip']) . "', "
                            . "website = '" . $this->db->escape($value['website']) . "', "
                            . "description = '" . $this->db->escape($value['description']) . "', "
                            . "terms = '" . $this->db->escape($value['terms']) . "', "
                            . "tag = '" . $this->db->escape($value['tag']) . "', "
                            . "meta_title = '" . $this->db->escape($value['meta_title']) . "', "
                            . "meta_description = '" . $this->db->escape($value['meta_description']) . "', "
                            . "meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'";
                     
			$this->db->query($sqlDesc);
        }  
		//Merchant Discount
		//print '<pre>';print_r($data['merchant_discount']); exit;
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_discount1 WHERE merchant_id = '" . (int)$merchant_id . "'");
		if (isset($data['merchant_discount'])) {
			foreach ($data['merchant_discount'] as $merchant_discount) {
				foreach ($merchant_discount['disc_data'] as $merchant_disc) {
                            $sql = "INSERT INTO " . DB_PREFIX . "merchant_discount1 SET 
                                    merchant_id = '" . (int)$merchant_id . "',
                                    sort_order = '" . $this->db->escape($merchant_discount['sort_order']) . "',
                                    discount_date = '" . $this->db->escape($merchant_disc['discount_date']) . "',
                                    discount_time = '" . (int)$merchant_discount['discount_time']. "' , 
                                    seats = '" . (int)$merchant_disc['seats'] . "', 
                                    date_modified = NOW()";
				
						$this->db->query($sql);
						//print $sql;exit;
				}
				
			}
		} 
                
                //Merchant Related Product
                $this->db->query("DELETE FROM " . DB_PREFIX . "merchant_product_related WHERE merchant_id = '" . (int)$merchant_id . "'");
		 

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_product_id) {
			
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_product_related SET merchant_id = '" . (int)$merchant_id . "', related_product_id = '" . (int)$related_product_id . "'");
				
			}
		}
                
                
                //Merchant Services
		//print '<pre>'; print_r($data); exit;
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_products WHERE merchant_id = '" . (int)$merchant_id . "'");
		if (isset($data['merchant_service'])) {
			foreach ($data['merchant_service'] as $merchant_service) {
				
				$sql = "INSERT INTO " . DB_PREFIX . "merchant_products SET 
					merchant_id = '" . (int)$merchant_id . "',
					product_id = '" . (int)($merchant_service['service_id']) . "',
                                        product_desc = '".$merchant_service['product_desc']."',
					duration = '" . (int)$merchant_service['duration']. "' , 
					price = '" . (int)$merchant_service['price'] . "', 
					date_modified = NOW()";
				
				$this->db->query($sql);
                                
                                $merchant_discount = $this->getTotalMerchantServiceWiseDiscount($merchant_id,$merchant_service['service_id']);
                                
                                //Print $merchant_discount;exit;
                                
                                if( $merchant_discount == 0){
                                
                                        foreach ($data['merchant_discount'] as $merchant_discount) {

                                            $sql = "INSERT INTO " . DB_PREFIX . "merchant_service_wise_discount SET 
                                                    merchant_id = '" . (int)$merchant_id . "',
                                                    service_id = '" . (int)($merchant_service['service_id']) . "',
                                                    sort_order = '" . $this->db->escape($merchant_discount['sort_order']) . "',
                                                    merchant_time = '" . $this->db->escape($merchant_discount['merchant_time']) . "',
                                                    mon_percentage = '" . (int)$merchant_discount['mon_percentage']. "' , 
                                                    mon_packs = '" . (int)$merchant_discount['mon_packs'] . "', 
                                                    tue_percentage = '" . (int)$merchant_discount['tue_percentage'] . "' , 
                                                    tue_packs = '" . (int)$merchant_discount['tue_packs'] . "', 
                                                    wed_percentage = '" . (int)$merchant_discount['wed_percentage'] . "', 
                                                    wed_packs = '" . (int)$merchant_discount['wed_packs'] . "', 
                                                    thu_percentage = '" . (int)$merchant_discount['thu_percentage'] . "', 
                                                    thu_packs = '" . (int)$merchant_discount['thu_packs'] . "',
                                                    fri_percentage = '" . (int)$merchant_discount['fri_percentage'] . "', 
                                                    fri_packs = '" . (int)$merchant_discount['fri_packs'] . "', 
                                                    sat_percentage = '" . (int)$merchant_discount['sat_percentage'] . "', 
                                                    sat_packs = '" . (int)$merchant_discount['sat_packs'] . "', 
                                                    sun_percentage = '" . (int)$merchant_discount['sun_percentage'] . "', 
                                                    sun_packs = '" . (int)$merchant_discount['sun_packs'] . "', 
                                                    date_modified = NOW()";

                                            $this->db->query($sql);

                                            //print $sql;exit;
                                    }
                                }else{
                                    
                                   // print "else";exit;
                                    
                                    //print '<pre>'; print_r($data['merchant_service_wise_discount']);exit;
                                    
                                    $this->db->query("DELETE FROM " . DB_PREFIX . "merchant_service_wise_discount WHERE merchant_id = '" . (int)$merchant_id . "' AND service_id = '".$merchant_service['service_id']."'");
                                    foreach ($data['merchant_service_wise_discount'][$merchant_service['service_id']] as $merchant_discount) {

                                            $sql = "INSERT INTO " . DB_PREFIX . "merchant_service_wise_discount SET 
                                                    merchant_id = '" . (int)$merchant_id . "',
                                                    service_id = '" . (int)($merchant_service['service_id']) . "',
                                                    sort_order = '" . $this->db->escape($merchant_discount['sort_order']) . "',
                                                    merchant_time = '" . $this->db->escape($merchant_discount['merchant_time']) . "',
                                                    mon_percentage = '" . (int)$merchant_discount['mon_percentage']. "' , 
                                                    mon_packs = '" . (int)$merchant_discount['mon_packs'] . "', 
                                                    tue_percentage = '" . (int)$merchant_discount['tue_percentage'] . "' , 
                                                    tue_packs = '" . (int)$merchant_discount['tue_packs'] . "', 
                                                    wed_percentage = '" . (int)$merchant_discount['wed_percentage'] . "', 
                                                    wed_packs = '" . (int)$merchant_discount['wed_packs'] . "', 
                                                    thu_percentage = '" . (int)$merchant_discount['thu_percentage'] . "', 
                                                    thu_packs = '" . (int)$merchant_discount['thu_packs'] . "',
                                                    fri_percentage = '" . (int)$merchant_discount['fri_percentage'] . "', 
                                                    fri_packs = '" . (int)$merchant_discount['fri_packs'] . "', 
                                                    sat_percentage = '" . (int)$merchant_discount['sat_percentage'] . "', 
                                                    sat_packs = '" . (int)$merchant_discount['sat_packs'] . "', 
                                                    sun_percentage = '" . (int)$merchant_discount['sun_percentage'] . "', 
                                                    sun_packs = '" . (int)$merchant_discount['sun_packs'] . "', 
                                                    date_modified = NOW()";

                                            $this->db->query($sql);

                                            //print $sql;exit;
                                    }
                                }
				
				//print $sql;exit;
			}
		} 
                
		//Merchant Atmosphere
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_to_atmosphere WHERE merchant_id = '" . (int)$merchant_id . "'");
		 
		if (isset($data['merchant_atmosphere'])) {
			foreach ($data['merchant_atmosphere'] as $atmosphere_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_to_atmosphere SET merchant_id = '" . (int)$merchant_id . "',   atmosphere_id = '" . (int)$atmosphere_id . "'");
			}
		} 
		
		//Merchant Facilities
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_to_facilities WHERE merchant_id = '" . (int)$merchant_id . "'");
		 
		if (isset($data['merchant_facilities'])) {
			foreach ($data['merchant_facilities'] as $facilities_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_to_facilities SET merchant_id = '" . (int)$merchant_id . "',   facilities_id = '" . (int)$facilities_id . "'");
			}
		} 
		
		//Merchant Spoken Languages
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_to_spokenlanguage WHERE merchant_id = '" . (int)$merchant_id . "'");
		 
		if (isset($data['merchant_spokenlanguage'])) {
			foreach ($data['merchant_spokenlanguage'] as $spokenlanguage_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_to_spokenlanguage SET merchant_id = '" . (int)$merchant_id . "',   spokenlanguage_id = '" . (int)$spokenlanguage_id . "'");
			}
		} 
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_image WHERE merchant_id = '" . (int)$merchant_id . "'");

		if (isset($data['merchant_image'])) {
			foreach ($data['merchant_image'] as $merchant_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "merchant_image SET merchant_id = '" . (int)$merchant_id . "', image = '" . $this->db->escape($merchant_image['image']) . "', sort_order = '" . (int)$merchant_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'merchant_id=" . (int)$merchant_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'merchant_id=" . (int)$merchant_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} 

		$this->cache->delete('merchant');
	}

	public function copyMerchant($merchant_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "merchant p WHERE p.merchant_id = '" . (int)$merchant_id . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0'; 
			 
			$data['merchant_description'] = $this->getMerchantDescriptions($merchant_id); 
			$data['merchant_image'] = $this->getMerchantImages($merchant_id); 
			$data['merchant_services'] = $this->getMerchantServices($merchant_id); 

			$this->addMerchant($data);
		}
	}

	public function deleteMerchant($merchant_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant WHERE merchant_id = '" . (int)$merchant_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_description WHERE merchant_id = '" . (int)$merchant_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_image WHERE merchant_id = '" . (int)$merchant_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_reward WHERE merchant_id = '" . (int)$merchant_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "merchant_review WHERE merchant_id = '" . (int)$merchant_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'merchant_id=" . (int)$merchant_id . "'"); 
		$this->cache->delete('merchant');
	}

	public function getMerchant($merchant_id) {
                $sql = "SELECT DISTINCT *, "
                        . "(SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'merchant_id=" . (int)$merchant_id . "') AS keyword FROM " . DB_PREFIX . "merchant p "
                        . "LEFT JOIN " . DB_PREFIX . "merchant_description pd ON (p.merchant_id = pd.merchant_id) "
                        . "WHERE p.merchant_id = '" . (int)$merchant_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
                
		$query = $this->db->query($sql);

		return $query->row;
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
	
	
	public function getMerchantProducts($data = array()) {
		
		$sql = "SELECT * FROM " . DB_PREFIX . "merchant_products mp
		LEFT JOIN " . DB_PREFIX . "product p ON (mp.product_id = p.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
		WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_merchant_id'])) {
			$sql .= " AND mp.merchant_id = '" . (int) $data['filter_merchant_id'] . "'";
		}

		
			//$sql .= " AND p.status = '1'";
		

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			
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
               // print $sql; exit;
		return $query->rows;
	}
	
	public function getServiceRecomanded($data = array()) {
		
		$sql = "SELECT * FROM " . DB_PREFIX . "merchant_product_related mp
		LEFT JOIN " . DB_PREFIX . "product p ON (mp.related_product_id = p.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
		WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_merchant_id'])) {
			$sql .= " AND mp.merchant_id = '" . (int) $data['filter_merchant_id'] . "'";
		}

		
			$sql .= " AND p.status = '1'";
		

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			
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
        // print $sql; exit;
		return $query->rows;
	}


	public function getMerchants($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "merchant p LEFT JOIN " . DB_PREFIX . "merchant_description pd ON (p.merchant_id = pd.merchant_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_contact_person'])) {
			$sql .= " AND pd.contact_person LIKE '" . $this->db->escape($data['filter_contact_person']) . "%'";
		} 

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$sql .= " GROUP BY p.merchant_id";

		$sort_data = array(
			'pd.name',
			'p.model',
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
                //print $sql; exit;
		return $query->rows;
	}
	
	public function getAtmospheres($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "atmosphere WHERE status = '1'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND  name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		} 
		 
		 
		$sql .= " GROUP BY  atmosphere_id";

		$sort_data = array(
			'name', 
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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
                //print $sql; exit;
		return $query->rows;
	}
	public function getAtmosphere($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "atmosphere WHERE status = '1'";

		if (!empty($data['filter_atmosphere_id'])) {
			$sql .= " AND  atmosphere_id  = '" . (int)($data['filter_atmosphere_id']) . "'";
		} 
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND  name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		 
		$query = $this->db->query($sql);
        //print $sql;
		return $query->row;
	}
	public function getFacilities($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "facilities WHERE status = '1'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND  name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		} 
		
		if (!empty($data['filter_facilities_id'])) {
			$sql .= " AND  facilities_id  = '" .  (int) $data['filter_facilities_id'] . "'";
		} 
		 
		$sql .= " GROUP BY  facilities_id";

		$sort_data = array(
			'name', 
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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
                //print $sql; exit;
		return $query->rows;
	}
	
	public function getFacilitie($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "facilities WHERE status = '1'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND  name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		} 
		
		if (!empty($data['filter_facilities_id'])) {
			$sql .= " AND  facilities_id  = '" .  (int) $data['filter_facilities_id'] . "'";
		} 
		 

		$query = $this->db->query($sql);
       // print $sql;  
		return $query->row;
	}
	
	public function getSpokenlanguages($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "spokenlanguage WHERE status = '1'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND  name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		} 
		
		if (!empty($data['filter_spokenlanguage_id'])) {
			$sql .= " AND  spokenlanguage_id  = '" .  (int) $data['filter_spokenlanguage_id'] . "'";
		} 
		 
		$sql .= " GROUP BY  spokenlanguage_id";

		$sort_data = array(
			'name', 
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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
                //print $sql; exit;
		return $query->rows;
	}
	
	public function getSpokenlanguage($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "spokenlanguage WHERE status = '1'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND  name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		} 
		
		if (!empty($data['filter_spokenlanguage_id'])) {
			$sql .= " AND  spokenlanguage_id  = '" .  (int) $data['filter_spokenlanguage_id'] . "'";
		} 
		 

		$query = $this->db->query($sql);
       // print $sql;  
		return $query->row;
	}
		 
	public function getMerchantsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant p LEFT JOIN " . DB_PREFIX . "merchant_description pd ON (p.merchant_id = pd.merchant_id) LEFT JOIN " . DB_PREFIX . "merchant_to_category p2c ON (p.merchant_id = p2c.merchant_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getMerchantDescriptions($merchant_id) {
		$merchant_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_description WHERE merchant_id = '" . (int)$merchant_id . "'");

		foreach ($query->rows as $result) {
			$merchant_description_data[$result['language_id']] = array(
                            'name'                  => $result['name'],
                            'description'           => $result['description'],
                            'terms'          		 => $result['terms'],
                            'contact_person'        => $result['contact_person'],
                            'email'                 => $result['email'],
                            'phone'                 => $result['phone'],
                            'mobile'                => $result['mobile'],
                            'address'               => $result['address'],
                            'city'                  => $result['city'],
							'location_id'			=> $result['location_id'],
							'city_id'               => $result['city_id'],
                            'country_id'            => $result['country_id'],
                            'zone_id'               => $result['zone_id'],
                            'zip'                   => $result['zip'],
                            'website'               => $result['website'],
                            'description'           => $result['description'],
                            'meta_title'            => $result['meta_title'],
                            'meta_description'      => $result['meta_description'],
                            'meta_keyword'          => $result['meta_keyword'],
                            'tag'                   => $result['tag']
			);
		}

		return $merchant_description_data;
	}

	public function getMerchantImages($merchant_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_image WHERE merchant_id = '" . (int)$merchant_id . "' ORDER BY sort_order ASC"); 
		return $query->rows;
	} 
	
	public function getMerchantDiscounts($merchant_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_discount WHERE merchant_id = '" . (int)$merchant_id . "' ORDER BY sort_order ASC"); 
		return $query->rows;
	} 
	
	public function getMerchantServices($merchant_id=0) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_products mp "
                    . "LEFT JOIN " . DB_PREFIX . "product_description pd ON (mp.product_id = pd.product_id) " 
                    . "WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
                    . "AND mp.merchant_id = '" . (int)$merchant_id . "' ORDER BY pd.name ASC");
            return $query->rows;
	}
        
        public function getMerchantAllServices() {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p "
                    . "LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) " 
                    . "WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' "
                    . "ORDER BY pd.name ASC");
            return $query->rows;
	}

	public function getMerchantRewards($merchant_id) {
		$merchant_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_reward WHERE merchant_id = '" . (int)$merchant_id . "'");

		foreach ($query->rows as $result) {
			$merchant_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $merchant_reward_data;
	} 

	public function getTotalMerchants($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.merchant_id) AS total FROM " . DB_PREFIX . "merchant p LEFT JOIN " . DB_PREFIX . "merchant_description pd ON (p.merchant_id = pd.merchant_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
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
        
        
        
        public function getMerchantServiceWiseDiscount($merchant_id, $product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_service_wise_discount WHERE merchant_id = '" . (int)$merchant_id . "' and service_id = '".$product_id."'". " ORDER BY sort_order ASC");

		return $query->rows;
	}
        
        public function getTotalMerchantServiceWiseDiscount($merchant_id, $product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "merchant_service_wise_discount WHERE merchant_id = '" . (int)$merchant_id . "' and service_id = '".$product_id."'");

		return $query->row['total'];
	}

	public function getTotalMerchantsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "merchant WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}
	
	public function getFacilitiesByMerchantId($merchant_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_to_facilities WHERE merchant_id = '" . (int)$merchant_id . "'");

		return $query->rows;
	}  
	
	public function getAtmosphereByMerchantId($merchant_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_to_atmosphere WHERE merchant_id = '" . (int)$merchant_id . "'");

		return $query->rows;
	}
	public function getSpokenlanguageByMerchantId($merchant_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_to_spokenlanguage WHERE merchant_id = '" . (int)$merchant_id . "'");

		return $query->rows;
	}
        public function getProductRelated($merchant_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "merchant_product_related WHERE merchant_id = '" . (int)$merchant_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_product_id'];
		}

		return $product_related_data;
	}
	 
}
