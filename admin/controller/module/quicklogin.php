<?php
class ControllerModuleQuickLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/quicklogin');

		$this->document->setTitle($this->language->get('heading_title1'));

		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('quicklogin', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		

		$data['heading_title1'] = $this->language->get('heading_title1');
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_create_account'] = $this->language->get('text_create_account');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_forgot'] = $this->language->get('text_forgot');
		$data['text_submit'] = $this->language->get('text_submit');
		$data['text_joinus'] = $this->language->get('text_joinus');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_logo'] = $this->language->get('entry_logo');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_close'] = $this->language->get('entry_close');
		$data['entry_openpopup'] = $this->language->get('entry_openpopup');
		$data['entry_session'] = $this->language->get('entry_session');
		$data['entry_fieldname'] = $this->language->get('entry_fieldname');
		$data['entry_label'] = $this->language->get('entry_label');
		$data['entry_error'] = $this->language->get('entry_error');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_firstname_missing'] = $this->language->get('entry_firstname_missing');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_lastname_missing'] = $this->language->get('entry_lastname_missing');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_email_missing'] = $this->language->get('entry_email_missing');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address1'] = $this->language->get('entry_address1');
		$data['entry_address2'] = $this->language->get('entry_address2');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_password_error'] = $this->language->get('entry_password_error');
		$data['entry_confirm_password'] = $this->language->get('entry_confirm_password');
		$data['entry_privacy'] = $this->language->get('entry_privacy');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_submit_button'] = $this->language->get('entry_submit_button');
		$data['entry_email_warning'] = $this->language->get('entry_email_warning');
		$data['entry_email_exists'] = $this->language->get('entry_email_exists');
		$data['entry_clientid'] = $this->language->get('entry_clientid');
		$data['entry_csecret'] = $this->language->get('entry_csecret');
		$data['entry_callback'] = $this->language->get('entry_callback');
		$data['entry_useimage'] = $this->language->get('entry_useimage');
		$data['entry_fontcolor'] = $this->language->get('entry_fontcolor');
		$data['entry_socialarea'] = $this->language->get('entry_socialarea');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['entry_buttontext'] = $this->language->get('entry_buttontext');
		$data['entry_customcss'] = $this->language->get('entry_customcss');
		$data['entry_headtitle'] = $this->language->get('entry_headtitle');
		$data['entry_rsucess'] = $this->language->get('entry_rsucess');
		$data['entry_contanercolor'] = $this->language->get('entry_contanercolor');
		$data['entry_headingcolor'] = $this->language->get('entry_headingcolor');
		$data['entry_inputbordercolor'] = $this->language->get('entry_inputbordercolor');
		$data['entry_textcolor'] = $this->language->get('entry_textcolor');
		$data['entry_butonbgcolor'] = $this->language->get('entry_butonbgcolor');
		$data['entry_bottoncolor'] = $this->language->get('entry_bottoncolor');
		$data['entry_privacyautochk'] = $this->language->get('entry_privacyautochk');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_register'] = $this->language->get('tab_register');
		$data['tab_login'] = $this->language->get('tab_login');
		$data['tab_forgot'] = $this->language->get('tab_forgot');
		$data['tab_social'] = $this->language->get('tab_social');
		$data['tab_sucess'] = $this->language->get('tab_sucess');
		$data['tab_custom'] = $this->language->get('tab_custom');
		$data['tab_adjustcolor'] = $this->language->get('tab_adjustcolor');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/quicklogin', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/quicklogin', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/quicklogin', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/quicklogin', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
	//logo
		
		if (isset($this->request->post['quicklogin_image'])) {
			$data['quicklogin_image'] = $this->request->post['quicklogin_image'];
		} else {
			$data['quicklogin_image'] = $this->config->get('quicklogin_image');
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['quicklogin_image']) && is_file(DIR_IMAGE . $this->request->post['quicklogin_image'])) {
			$data['quicklogin_logo'] = $this->model_tool_image->resize($this->request->post['quicklogin_image'], 100, 100);
		} elseif ($this->config->get('quicklogin_image') && is_file(DIR_IMAGE . $this->config->get('quicklogin_image'))) {
			$data['quicklogin_logo'] = $this->model_tool_image->resize($this->config->get('quicklogin_image'), 100, 100);
		} else {
			$data['quicklogin_logo'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		//quicklogin_logo
		
		
		//$data['socialloginlink'] = $this->url->link('module/tmdsociallogin', 'token=' . $this->session->data['token'], 'SSL');
		
		if(isset($this->request->post['quicklogin_status'])){
			$data['quicklogin_status'] = $this->request->post['quicklogin_status'];
		}else{
			$data['quicklogin_status'] = $this->config->get('quicklogin_status');
		}
		
		if(isset($this->request->post['quicklogin_openpopup'])){
			$data['quicklogin_openpopup'] = $this->request->post['quicklogin_openpopup'];
		}else{
			$data['quicklogin_openpopup'] = $this->config->get('quicklogin_openpopup');
		}
		
		if(isset($this->request->post['quicklogin_session'])){
			$data['quicklogin_session'] = $this->request->post['quicklogin_session'];
		}else{
			$data['quicklogin_session'] = $this->config->get('quicklogin_session');
		}
		
		if(isset($this->request->post['quicklogin_registerstatus'])){
			$data['quicklogin_registerstatus'] = $this->request->post['quicklogin_registerstatus'];
		}else{
			$data['quicklogin_registerstatus'] = $this->config->get('quicklogin_registerstatus');
		}
		
		
		
		//Register Customer Group
		if(isset($this->request->post['quicklogin_register'])){
			$data['quicklogin_register'] = $this->request->post['quicklogin_register'];
		}else{
			$data['quicklogin_register'] = $this->config->get('quicklogin_register');
		}
		
		if(isset($this->request->post['quicklogin_cgrequired'])){
			$data['quicklogin_cgrequired'] = $this->request->post['quicklogin_cgrequired'];
		}else{
			$data['quicklogin_cgrequired'] = $this->config->get('quicklogin_cgrequired');
		}
		
		if(isset($this->request->post['quicklogin_cgsortorder'])){
			$data['quicklogin_cgsortorder'] = $this->request->post['quicklogin_cgsortorder'];
		}else{
			$data['quicklogin_cgsortorder'] = $this->config->get('quicklogin_cgsortorder');
		}
		
		if(isset($this->request->post['quicklogin_cgstatus'])){
			$data['quicklogin_cgstatus'] = $this->request->post['quicklogin_cgstatus'];
		}else{
			$data['quicklogin_cgstatus'] = $this->config->get('quicklogin_cgstatus');
		}
		
		//login status
		
		if(isset($this->request->post['quicklogin_loginstatus'])){
			$data['quicklogin_loginstatus'] = $this->request->post['quicklogin_loginstatus'];
		}else{
			$data['quicklogin_loginstatus'] = $this->config->get('quicklogin_loginstatus');
		}
		
		//forgot status
		
		if(isset($this->request->post['quicklogin_forgotstatus'])){
			$data['quicklogin_forgotstatus'] = $this->request->post['quicklogin_forgotstatus'];
		}else{
			$data['quicklogin_forgotstatus'] = $this->config->get('quicklogin_forgotstatus');
		}
		
		
		//social media
		
		if(isset($this->request->post['quicklogin_sgeneralstatus'])){
			$data['quicklogin_sgeneralstatus'] = $this->request->post['quicklogin_sgeneralstatus'];
		}else{
			$data['quicklogin_sgeneralstatus'] = $this->config->get('quicklogin_sgeneralstatus');
		}
		
		// social google
		if(isset($this->request->post['quicklogin_sgooglestatus'])){
			$data['quicklogin_sgooglestatus'] = $this->request->post['quicklogin_sgooglestatus'];
		}else{
			$data['quicklogin_sgooglestatus'] = $this->config->get('quicklogin_sgooglestatus');
		}
		
		if(isset($this->request->post['quicklogin_sgoogle'])){
			$data['quicklogin_sgoogle'] = $this->request->post['quicklogin_sgoogle'];
		}else{
			$data['quicklogin_sgoogle'] = $this->config->get('quicklogin_sgoogle');
		}
		
		
		if(isset($this->request->post['quicklogin_sgfontcolor'])){
			$data['quicklogin_sgfontcolor'] = $this->request->post['quicklogin_sgfontcolor'];
		}else{
			$data['quicklogin_sgfontcolor'] = $this->config->get('quicklogin_sgfontcolor');
		}
		if(isset($this->request->post['quicklogin_socialarea'])){
			$data['quicklogin_socialarea'] = $this->request->post['quicklogin_socialarea'];
		}else{
			$data['quicklogin_socialarea'] = $this->config->get('quicklogin_socialarea');
		}
		
	
		//Register Success
		
		if(isset($this->request->post['quicklogin_rsbuttontext'])){
			$data['quicklogin_rsbuttontext'] = $this->request->post['quicklogin_rsbuttontext'];
		}else{
			$data['quicklogin_rsbuttontext'] = $this->config->get('quicklogin_rsbuttontext');
		}
		
		//custon css
		if(isset($this->request->post['quicklogin_customcss'])){
			$data['quicklogin_customcss'] = $this->request->post['quicklogin_customcss'];
		}else{
			$data['quicklogin_customcss'] = $this->config->get('quicklogin_customcss');
		}
		
		//adjustcolor start
		
		if(isset($this->request->post['quicklogin_contanercolor'])){
			$data['quicklogin_contanercolor'] = $this->request->post['quicklogin_contanercolor'];
		}else{
			$data['quicklogin_contanercolor'] = $this->config->get('quicklogin_contanercolor');
		}
		
		if(isset($this->request->post['quicklogin_headingcolor'])){
			$data['quicklogin_headingcolor'] = $this->request->post['quicklogin_headingcolor'];
		}else{
			$data['quicklogin_headingcolor'] = $this->config->get('quicklogin_headingcolor');
		}
		
		if(isset($this->request->post['quicklogin_inputbordercolor'])){
			$data['quicklogin_inputbordercolor'] = $this->request->post['quicklogin_inputbordercolor'];
		}else{
			$data['quicklogin_inputbordercolor'] = $this->config->get('quicklogin_inputbordercolor');
		}
		
		if(isset($this->request->post['quicklogin_butonbgcolor'])){
			$data['quicklogin_butonbgcolor'] = $this->request->post['quicklogin_butonbgcolor'];
		}else{
			$data['quicklogin_butonbgcolor'] = $this->config->get('quicklogin_butonbgcolor');
		}		
		
		if(isset($this->request->post['quicklogin_textcolor'])){
			$data['quicklogin_textcolor'] = $this->request->post['quicklogin_textcolor'];
		}else{
			$data['quicklogin_textcolor'] = $this->config->get('quicklogin_textcolor');
		}		
		
		if(isset($this->request->post['quicklogin_bottoncolor'])){
			$data['quicklogin_bottoncolor'] = $this->request->post['quicklogin_bottoncolor'];
		}else{
			$data['quicklogin_bottoncolor'] = $this->config->get('quicklogin_bottoncolor');
		}
		
		
		
		//adjustcolor end
		
		if(isset($this->request->post['quicklogin_successtatus'])){
			$data['quicklogin_successtatus'] = $this->request->post['quicklogin_successtatus'];
		}else{
			$data['quicklogin_successtatus'] = $this->config->get('quicklogin_successtatus');
		}
		
		if(isset($this->request->post['quicklogin_rsucess'])){
			$data['quicklogin_rsucess'] = $this->request->post['quicklogin_rsucess'];
		}else{
			$data['quicklogin_rsucess'] = $this->config->get('quicklogin_rsucess');
		}
		
		//Register Firstname
		
		
		if(isset($this->request->post['quicklogin_fnamerequired'])){
			$data['quicklogin_fnamerequired'] = $this->request->post['quicklogin_fnamerequired'];
		}else{
			$data['quicklogin_fnamerequired'] = $this->config->get('quicklogin_fnamerequired');
		}
		
		if(isset($this->request->post['quicklogin_fnamesortorder'])){
			$data['quicklogin_fnamesortorder'] = $this->request->post['quicklogin_fnamesortorder'];
		}else{
			$data['quicklogin_fnamesortorder'] = $this->config->get('quicklogin_fnamesortorder');
		}
		
		if(isset($this->request->post['quicklogin_fnamestatus'])){
			$data['quicklogin_fnamestatus'] = $this->request->post['quicklogin_fnamestatus'];
		}else{
			$data['quicklogin_fnamestatus'] = $this->config->get('quicklogin_fnamestatus');
		}
		
		
		//Register LastName
		
				
		if(isset($this->request->post['quicklogin_lastnamerequired'])){
			$data['quicklogin_lastnamerequired'] = $this->request->post['quicklogin_lastnamerequired'];
		}else{
			$data['quicklogin_lastnamerequired'] = $this->config->get('quicklogin_lastnamerequired');
		}
		
		if(isset($this->request->post['quicklogin_lastnamesortorder'])){
			$data['quicklogin_lastnamesortorder'] = $this->request->post['quicklogin_lastnamesortorder'];
		}else{
			$data['quicklogin_lastnamesortorder'] = $this->config->get('quicklogin_lastnamesortorder');
		}
		
		if(isset($this->request->post['quicklogin_lastnamestatus'])){
			$data['quicklogin_lastnamestatus'] = $this->request->post['quicklogin_lastnamestatus'];
		}else{
			$data['quicklogin_lastnamestatus'] = $this->config->get('quicklogin_lastnamestatus');
		}
		
		//Register E-mail Address
		
		
		if(isset($this->request->post['quicklogin_emailrequired'])){
			$data['quicklogin_emailrequired'] = $this->request->post['quicklogin_emailrequired'];
		}else{
			$data['quicklogin_emailrequired'] = $this->config->get('quicklogin_emailrequired');
		}
		
		if(isset($this->request->post['quicklogin_emailsortorder'])){
			$data['quicklogin_emailsortorder'] = $this->request->post['quicklogin_emailsortorder'];
		}else{
			$data['quicklogin_emailsortorder'] = $this->config->get('quicklogin_emailsortorder');
		}
		
		if(isset($this->request->post['quicklogin_emailstatus'])){
			$data['quicklogin_emailstatus'] = $this->request->post['quicklogin_emailstatus'];
		}else{
			$data['quicklogin_emailstatus'] = $this->config->get('quicklogin_emailstatus');
		}
		
		//Register Telephone
		
		
		if(isset($this->request->post['quicklogin_phonerequired'])){
			$data['quicklogin_phonerequired'] = $this->request->post['quicklogin_phonerequired'];
		}else{
			$data['quicklogin_phonerequired'] = $this->config->get('quicklogin_phonerequired');
		}
		
		if(isset($this->request->post['quicklogin_phonesortorder'])){
			$data['quicklogin_phonesortorder'] = $this->request->post['quicklogin_phonesortorder'];
		}else{
			$data['quicklogin_phonesortorder'] = $this->config->get('quicklogin_phonesortorder');
		}
		
		if(isset($this->request->post['quicklogin_phonestatus'])){
			$data['quicklogin_phonestatus'] = $this->request->post['quicklogin_phonestatus'];
		}else{
			$data['quicklogin_phonestatus'] = $this->config->get('quicklogin_phonestatus');
		}
		
		//Register Fax
		
		
		if(isset($this->request->post['quicklogin_faxrequired'])){
			$data['quicklogin_faxrequired'] = $this->request->post['quicklogin_faxrequired'];
		}else{
			$data['quicklogin_faxrequired'] = $this->config->get('quicklogin_faxrequired');
		}
		
		if(isset($this->request->post['quicklogin_faxsortorder'])){
			$data['quicklogin_faxsortorder'] = $this->request->post['quicklogin_faxsortorder'];
		}else{
			$data['quicklogin_faxsortorder'] = $this->config->get('quicklogin_faxsortorder');
		}
		
		if(isset($this->request->post['quicklogin_faxstatus'])){
			$data['quicklogin_faxstatus'] = $this->request->post['quicklogin_faxstatus'];
		}else{
			$data['quicklogin_faxstatus'] = $this->config->get('quicklogin_faxstatus');
		}
		
		//Register Company
		
		
		if(isset($this->request->post['quicklogin_compquired'])){
			$data['quicklogin_compquired'] = $this->request->post['quicklogin_compquired'];
		}else{
			$data['quicklogin_compquired'] = $this->config->get('quicklogin_compquired');
		}
		
		if(isset($this->request->post['quicklogin_compsortorder'])){
			$data['quicklogin_compsortorder'] = $this->request->post['quicklogin_compsortorder'];
		}else{
			$data['quicklogin_compsortorder'] = $this->config->get('quicklogin_compsortorder');
		}
		
		if(isset($this->request->post['quicklogin_compstatus'])){
			$data['quicklogin_compstatus'] = $this->request->post['quicklogin_compstatus'];
		}else{
			$data['quicklogin_compstatus'] = $this->config->get('quicklogin_compstatus');
		}
		
		//Register Address 1
		
		
		
		if(isset($this->request->post['quicklogin_add1required'])){
			$data['quicklogin_add1required'] = $this->request->post['quicklogin_add1required'];
		}else{
			$data['quicklogin_add1required'] = $this->config->get('quicklogin_add1required');
		}
		
		if(isset($this->request->post['quicklogin_add1sortorder'])){
			$data['quicklogin_add1sortorder'] = $this->request->post['quicklogin_add1sortorder'];
		}else{
			$data['quicklogin_add1sortorder'] = $this->config->get('quicklogin_add1sortorder');
		}
		
		if(isset($this->request->post['quicklogin_add1status'])){
			$data['quicklogin_add1status'] = $this->request->post['quicklogin_add1status'];
		}else{
			$data['quicklogin_add1status'] = $this->config->get('quicklogin_add1status');
		}
		
		//Register Address 2
		
		
		if(isset($this->request->post['quicklogin_add2required'])){
			$data['quicklogin_add2required'] = $this->request->post['quicklogin_add2required'];
		}else{
			$data['quicklogin_add2required'] = $this->config->get('quicklogin_add2required');
		}
		
		if(isset($this->request->post['quicklogin_add2sortorder'])){
			$data['quicklogin_add2sortorder'] = $this->request->post['quicklogin_add2sortorder'];
		}else{
			$data['quicklogin_add2sortorder'] = $this->config->get('quicklogin_add2sortorder');
		}
		
		if(isset($this->request->post['quicklogin_add2status'])){
			$data['quicklogin_add2status'] = $this->request->post['quicklogin_add2status'];
		}else{
			$data['quicklogin_add2status'] = $this->config->get('quicklogin_add2status');
		}
		
		//Register City
		
		
		if(isset($this->request->post['quicklogin_cityrequired'])){
			$data['quicklogin_cityrequired'] = $this->request->post['quicklogin_cityrequired'];
		}else{
			$data['quicklogin_cityrequired'] = $this->config->get('quicklogin_cityrequired');
		}
		
		if(isset($this->request->post['quicklogin_citysortorder'])){
			$data['quicklogin_citysortorder'] = $this->request->post['quicklogin_citysortorder'];
		}else{
			$data['quicklogin_citysortorder'] = $this->config->get('quicklogin_citysortorder');
		}
		
		if(isset($this->request->post['quicklogin_citystatus'])){
			$data['quicklogin_citystatus'] = $this->request->post['quicklogin_citystatus'];
		}else{
			$data['quicklogin_citystatus'] = $this->config->get('quicklogin_citystatus');
		}
		
		//Register Postcode
		
		if(isset($this->request->post['quicklogin_postcodrequired'])){
			$data['quicklogin_postcodrequired'] = $this->request->post['quicklogin_postcodrequired'];
		}else{
			$data['quicklogin_postcodrequired'] = $this->config->get('quicklogin_postcodrequired');
		}
		
		if(isset($this->request->post['quicklogin_postcodsortorder'])){
			$data['quicklogin_postcodsortorder'] = $this->request->post['quicklogin_postcodsortorder'];
		}else{
			$data['quicklogin_postcodsortorder'] = $this->config->get('quicklogin_postcodsortorder');
		}
		
		if(isset($this->request->post['quicklogin_postcodstatus'])){
			$data['quicklogin_postcodstatus'] = $this->request->post['quicklogin_postcodstatus'];
		}else{
			$data['quicklogin_postcodstatus'] = $this->config->get('quicklogin_postcodstatus');
		}
		
		//Register Country
		
		if(isset($this->request->post['quicklogin_countryrequired'])){
			$data['quicklogin_countryrequired'] = $this->request->post['quicklogin_countryrequired'];
		}else{
			$data['quicklogin_countryrequired'] = $this->config->get('quicklogin_countryrequired');
		}
		
		if(isset($this->request->post['quicklogin_countrysortorder'])){
			$data['quicklogin_countrysortorder'] = $this->request->post['quicklogin_countrysortorder'];
		}else{
			$data['quicklogin_countrysortorder'] = $this->config->get('quicklogin_countrysortorder');
		}
		
		if(isset($this->request->post['quicklogin_countrystatus'])){
			$data['quicklogin_countrystatus'] = $this->request->post['quicklogin_countrystatus'];
		}else{
			$data['quicklogin_countrystatus'] = $this->config->get('quicklogin_countrystatus');
		}
		
		//Register Zone
		
		
		if(isset($this->request->post['quicklogin_zonerequired'])){
			$data['quicklogin_zonerequired'] = $this->request->post['quicklogin_zonerequired'];
		}else{
			$data['quicklogin_zonerequired'] = $this->config->get('quicklogin_zonerequired');
		}
		
		if(isset($this->request->post['quicklogin_zonesortorder'])){
			$data['quicklogin_zonesortorder'] = $this->request->post['quicklogin_zonesortorder'];
		}else{
			$data['quicklogin_zonesortorder'] = $this->config->get('quicklogin_zonesortorder');
		}
		
		if(isset($this->request->post['quicklogin_zonestatus'])){
			$data['quicklogin_zonestatus'] = $this->request->post['quicklogin_zonestatus'];
		}else{
			$data['quicklogin_zonestatus'] = $this->config->get('quicklogin_zonestatus');
		}
		
		//Register Password
		
		
		if(isset($this->request->post['quicklogin_pwdrequired'])){
			$data['quicklogin_pwdrequired'] = $this->request->post['quicklogin_pwdrequired'];
		}else{
			$data['quicklogin_pwdrequired'] = $this->config->get('quicklogin_pwdrequired');
		}
		
		if(isset($this->request->post['quicklogin_pwdsortorder'])){
			$data['quicklogin_pwdsortorder'] = $this->request->post['quicklogin_pwdsortorder'];
		}else{
			$data['quicklogin_pwdsortorder'] = $this->config->get('quicklogin_pwdsortorder');
		}
		
		if(isset($this->request->post['quicklogin_pwdstatus'])){
			$data['quicklogin_pwdstatus'] = $this->request->post['quicklogin_pwdstatus'];
		}else{
			$data['quicklogin_pwdstatus'] = $this->config->get('quicklogin_pwdstatus');
		}
		
		//Register Confirm Password
		
		if(isset($this->request->post['quicklogin_cpwdrequired'])){
			$data['quicklogin_cpwdrequired'] = $this->request->post['quicklogin_cpwdrequired'];
		}else{
			$data['quicklogin_cpwdrequired'] = $this->config->get('quicklogin_cpwdrequired');
		}
		
		if(isset($this->request->post['quicklogin_cpwdsortorder'])){
			$data['quicklogin_cpwdsortorder'] = $this->request->post['quicklogin_cpwdsortorder'];
		}else{
			$data['quicklogin_cpwdsortorder'] = $this->config->get('quicklogin_cpwdsortorder');
		}
		
		if(isset($this->request->post['quicklogin_cpwdstatus'])){
			$data['quicklogin_cpwdstatus'] = $this->request->post['quicklogin_cpwdstatus'];
		}else{
			$data['quicklogin_cpwdstatus'] = $this->config->get('quicklogin_cpwdstatus');
		}
		
		//Register Privacy Policy
		
		
		if(isset($this->request->post['quicklogin_privacyautochk'])){
			$data['quicklogin_privacyautochk'] = $this->request->post['quicklogin_privacyautochk'];
		}else{
			$data['quicklogin_privacyautochk'] = $this->config->get('quicklogin_privacyautochk');
		}
		
		if(isset($this->request->post['quicklogin_privacyrequired'])){
			$data['quicklogin_privacyrequired'] = $this->request->post['quicklogin_privacyrequired'];
		}else{
			$data['quicklogin_privacyrequired'] = $this->config->get('quicklogin_privacyrequired');
		}
		
		if(isset($this->request->post['quicklogin_privacysortorder'])){
			$data['quicklogin_privacysortorder'] = $this->request->post['quicklogin_privacysortorder'];
		}else{
			$data['quicklogin_privacysortorder'] = $this->config->get('quicklogin_privacysortorder');
		}
		
		if(isset($this->request->post['quicklogin_privacystatus'])){
			$data['quicklogin_privacystatus'] = $this->request->post['quicklogin_privacystatus'];
		}else{
			$data['quicklogin_privacystatus'] = $this->config->get('quicklogin_privacystatus');
		}
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/quicklogin', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/quicklogin')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}