<?php
class ControllerCommonQuickSignup extends Controller {
	public function index() {
		$this->load->language('account/register');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['redirect']=  HTTP_SERVER.'index.php?'.$_SERVER['QUERY_STRING'];
		
		// Title Of register		
		$accounttitles =$this->config->get('quicklogin_register')['accounttitle'][$this->config->get('config_language_id')];
		if(!empty($accounttitles)){		
		$data['entry_accounttitle'] = $accounttitles;		
		}else{
		$data['entry_accounttitle'] = $this->language->get('heading_title');
		}
		
		// Button Of register
		$submitbuttons =$this->config->get('quicklogin_register')['submitbutton'][$this->config->get('config_language_id')];
		if(!empty($submitbuttons)){		
		$data['button_submitbutton'] = $submitbuttons;		
		}else{
		$data['button_submitbutton'] = $this->language->get('button_submit');
		}
		// ForgetTitle 

		$text_emails =$this->config->get('quicklogin_register')['forgottitle'][$this->config->get('config_language_id')];
		if(!empty($text_emails)){		
		$data['text_email'] = $text_emails;		
		}else{
		$data['text_email'] = $this->language->get('text_emails');
		}
		
		$button_continues =$this->config->get('quicklogin_register')['forgotsubmitbtn'][$this->config->get('config_language_id')];
		if(!empty($button_continues)){		
		$data['button_continue'] = $button_continues;		
		}else{
		$data['button_continue'] = $this->language->get('button_continue');
		}		
		$data['foregetstatus'] =$this->config->get('quicklogin_forgotstatus');
		$data['redirectsuccesstatus'] = $this->config->get('quicklogin_rsucess');
		$data['text_agree'] = $this->language->get('text_agree');
		$data['text_account_alrdy'] = $this->language->get('text_account_alrdy');
		$data['text_loginpage'] = $this->language->get('text_loginpage');
		$data['text_forgotten'] = $this->language->get('text_forgotten');		
		$data['button_back'] = $this->language->get('button_back');
		
		$data['text_noaccount'] = $this->language->get('text_noaccount');
		$data['text_regpage'] = $this->language->get('text_regpage');
		$data['back'] = $this->url->link('account/login', '', 'SSL');
		$data['home'] = $this->url->link('common/home');
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		$data['name'] = $this->config->get('config_name');
		$data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
		
		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}
	
	/* Login Form */
		
		$text_loginforms =$this->config->get('quicklogin_register')['logintitle'][$this->config->get('config_language_id')];
		if(!empty($text_loginforms)){		
		$data['text_loginform'] = $text_loginforms;		
		}else{
		$data['text_loginform'] = $this->language->get('text_loginform');
		}
		
		$button_logins =$this->config->get('quicklogin_register')['loginsubmitbtn'][$this->config->get('config_language_id')];
		if(!empty($button_logins)){		
		$data['button_login'] = $button_logins;		
		}else{
		$data['button_login'] = $this->language->get('button_login');
		}
		
		$data['loginstatus'] = $this->config->get('quicklogin_loginstatus');
		
	/* Login Form */
	
	
	/* Register Form */
				
		$data['button_submit'] = $this->language->get('button_submit');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['telephone_errorss'] =$this->config->get('quicklogin_register')['phonerror'][$this->config->get('config_language_id')];
		// Firstname Lable		
		$firstname_lables =$this->config->get('quicklogin_register')['firstnamelabel'][$this->config->get('config_language_id')];
		if(!empty($firstname_lables)){		
		$data['firstname_lable'] = $firstname_lables;		
		}else{
		$data['firstname_lable'] = $this->language->get('entry_firstname');
		}
		
		// Lastname Lable		
		$lastname_lables =$this->config->get('quicklogin_register')['lastnamelabel'][$this->config->get('config_language_id')];
		if(!empty($lastname_lables)){		
		$data['lastname_lable'] = $lastname_lables;		
		}else{
		$data['lastname_lable'] = $this->language->get('entry_lastname');
		}
		
		// Email Lable		
		$email_lables =$this->config->get('quicklogin_register')['emaillabel'][$this->config->get('config_language_id')];
		if(!empty($email_lables)){		
		$data['email_lable'] = $email_lables;		
		}else{
		$data['email_lable'] = $this->language->get('entry_email');
		}
		
		// Telephone Lable		
		$telephone_lables =$this->config->get('quicklogin_register')['phonelabel'][$this->config->get('config_language_id')];
		if(!empty($telephone_lables)){		
		$data['telephone_lable'] = $telephone_lables;		
		}else{
		$data['telephone_lable'] = $this->language->get('entry_telephone');
		}
		
		// Fax Lable		
		$fax_lables =$this->config->get('quicklogin_register')['faxlabel'][$this->config->get('config_language_id')];
		if(!empty($fax_lables)){		
		$data['fax_lable'] = $fax_lables;		
		}else{
		$data['fax_lable'] = $this->language->get('entry_fax');
		}
		
		// Company Lable		
		$company_lables =$this->config->get('quicklogin_register')['companylabel'][$this->config->get('config_language_id')];
		if(!empty($company_lables)){		
		$data['company_lable'] = $company_lables;		
		}else{
		$data['company_lable'] = $this->language->get('entry_company');
		}
		
		// Address_1 Lable		
		$address_1_lables =$this->config->get('quicklogin_register')['add1label'][$this->config->get('config_language_id')];
		if(!empty($address_1_lables)){		
		$data['address_1_lable'] = $address_1_lables;		
		}else{
		$data['address_1_lable'] = $this->language->get('entry_address_1');
		}
		
		// Address 2 Lable		
		$address_2_lables =$this->config->get('quicklogin_register')['add2label'][$this->config->get('config_language_id')];
		if(!empty($address_2_lables)){		
		$data['address_2_lable'] = $address_2_lables;		
		}else{
		$data['address_2_lable'] = $this->language->get('entry_address_2');
		}
		
		// City Lable		
		$city_lables =$this->config->get('quicklogin_register')['citylabel'][$this->config->get('config_language_id')];
		if(!empty($city_lables)){		
		$data['city_lable'] = $city_lables;		
		}else{
		$data['city_lable'] = $this->language->get('entry_city');
		}
		
		// City Lable		
		$postcode_lables =$this->config->get('quicklogin_register')['postcodelabel'][$this->config->get('config_language_id')];
		if(!empty($postcode_lables)){		
		$data['postcode_lable'] = $postcode_lables;		
		}else{
		$data['postcode_lable'] = $this->language->get('entry_postcode');
		}
		
		// Country Lable		
		$country_lables =$this->config->get('quicklogin_register')['countrylabel'][$this->config->get('config_language_id')];
		if(!empty($country_lables)){		
		$data['country_lable'] = $country_lables;		
		}else{
		$data['country_lable'] = $this->language->get('entry_country');
		}
		
		// Zone Lable		
		$zone_lables =$this->config->get('quicklogin_register')['zonelabel'][$this->config->get('config_language_id')];
		if(!empty($zone_lables)){		
		$data['zone_lable'] = $zone_lables;		
		}else{
		$data['zone_lable'] = $this->language->get('entry_zone');
		}
		
		// Pwd Lable		
		$pwd_lables =$this->config->get('quicklogin_register')['pwdlabel'][$this->config->get('config_language_id')];
		if(!empty($pwd_lables)){		
		$data['pwd_lable'] = $pwd_lables;		
		}else{
		$data['pwd_lable'] = $this->language->get('entry_password');
		}
		
		// CnfrmPwd Lable		
		$cpwd_lables =$this->config->get('quicklogin_register')['cpwdlabel'][$this->config->get('config_language_id')];
		if(!empty($cpwd_lables)){		
		$data['cpwd_lable'] = $cpwd_lables;		
		}else{
		$data['cpwd_lable'] = $this->language->get('entry_confirm');
		}
		
		// Privacy Lable		
		$privacy_lables =$this->config->get('quicklogin_register')['privacylabel'][$this->config->get('config_language_id')];
		if(!empty($privacy_lables)){		
		$data['privacy_lable'] = $privacy_lables;		
		}else{
		$data['privacy_lable'] = $this->language->get('text_agree');
		}
		// Socila Title
		$sgeneraltitles =$this->config->get('quicklogin_register')['sgeneraltitle'][$this->config->get('config_language_id')];
		if(!empty($sgeneraltitles)){		
		$data['socialtitle'] = $sgeneraltitles;		
		}else{
		$data['socialtitle'] = $this->language->get('text_socialtitle');
		}
		
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		
		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} else {
			$data['lastname'] = '';
		}
		
		
		
		if (isset($this->request->post['telephone'])) {
			$data['telephone'] = $this->request->post['telephone'];
		} else {
			$data['telephone'] = '';
		}
	
		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} else {
			$data['fax'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
			
		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} else {
			$data['fax'] = '';
		}
			
		if (isset($this->request->post['address_1'])) {
			$data['address_1'] = $this->request->post['address_1'];
		} else {
			$data['address_1'] = '';
		}
			
		if (isset($this->request->post['address_2'])) {
			$data['address_2'] = $this->request->post['address_2'];
		} else {
			$data['address_2'] = '';
		}
			
		if (isset($this->request->post['company'])) {
			$data['company'] = $this->request->post['company'];
		} else {
			$data['company'] = '';
		}
			
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} else {
			$data['city'] = '';
		}
			
		if (isset($this->request->post['postcode'])) {
			$data['postcode'] = $this->request->post['postcode'];
		} else {
			$data['postcode'] = '';
		}
		
		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$data['zone_id'] = '';
		}
		
		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}
		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		$this->load->model('tool/image');
		
		 if (is_file(DIR_IMAGE . $this->config->get('quicklogin_image'))) {
			$data['rlogo'] = $server . 'image/' . $this->config->get('quicklogin_image');
		} else {
			$data['rlogo'] = '';
		} 
		
		
		if ($this->config->get('quicklogin_status')) {
			$data['quicklogin_status'] = $this->config->get('quicklogin_status');
		} else {
			$data['quicklogin_status'] = '';
		}
		
		if ($this->config->get('quicklogin_cgrequired')) {
			$data['quicklogin_cgrequired'] = $this->config->get('quicklogin_cgrequired');
		} else {
			$data['quicklogin_cgrequired'] = '';
		}
		
		
		//Registration Status
		
		$data['custgrp_status'] = $this->config->get('quicklogin_cgstatus');
		$data['firstname_status'] = $this->config->get('quicklogin_fnamestatus');
		$data['lastname_status'] = $this->config->get('quicklogin_lastnamestatus');
		$data['telephone_status'] = $this->config->get('quicklogin_phonestatus');
		$data['fax_status'] = $this->config->get('quicklogin_faxstatus');
		$data['company_status'] = $this->config->get('quicklogin_compstatus');		
		$data['address_1_status'] = $this->config->get('quicklogin_add1status');
		$data['address_2_status'] = $this->config->get('quicklogin_add2status');		
		$data['city_status'] = $this->config->get('quicklogin_citystatus');
		$data['country_status'] = $this->config->get('quicklogin_countrystatus');
		$data['zone_status'] = $this->config->get('quicklogin_zonestatus');
		$data['privacy_status'] = $this->config->get('quicklogin_privacystatus');		
		$data['postcode_status'] = $this->config->get('quicklogin_postcodstatus');
		$data['contanercolor'] = $this->config->get('quicklogin_contanercolor');
		$data['headingcolor'] = $this->config->get('quicklogin_headingcolor');
		$data['inputbordercolor'] = $this->config->get('quicklogin_inputbordercolor');
		$data['textcolor'] = $this->config->get('quicklogin_textcolor');
		$data['btnbgcolor'] = $this->config->get('quicklogin_butonbgcolor');
		$data['btncolor'] = $this->config->get('quicklogin_bottoncolor');
		$data['scfontcolor'] = $this->config->get('quicklogin_sgfontcolor');
		$data['customcss'] = $this->config->get('quicklogin_customcss');
		$data['socialarea'] = $this->config->get('quicklogin_socialarea');
		$data['socialstatus'] = $this->config->get('quicklogin_sgeneralstatus');
		$this->request->get['route']='common/quicklogin';
		$data['privacyautochk'] = $this->config->get('quicklogin_privacyautochk');	
		$data['sociallogin'] = $this->load->controller('common/content_top');
		
		
		
		
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}
		
		/* Extra code Register Form */
	
	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/quicksignup')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/quicksignup', $data);
		} else {
			return $this->load->view('common/quicksignup', $data);
		}
	}
}