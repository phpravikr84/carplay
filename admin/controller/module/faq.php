<?php
class ControllerModuleFaq extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/faq');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('faq', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/faq', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/faq', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['faq_status'])) {
			$data['faq_status'] = $this->request->post['faq_status'];
		} else {
			$data['faq_status'] = $this->config->get('faq_status');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/faq.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/faq')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq` (
		  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
		  `date_added` datetime NOT NULL,
		  `status` tinyint(1) NOT NULL,
		  PRIMARY KEY (`faq_id`)
		)");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq_description` (
		  `faq_description_id` int(11) NOT NULL AUTO_INCREMENT,
		  `faq_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `question` varchar(255) COLLATE utf8_bin NOT NULL,
		  `answer` text COLLATE utf8_bin NOT NULL,
		   PRIMARY KEY (`faq_description_id`)
		)");
		
		$this->load->model('user/user_group');

		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'extension/faq');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'extension/faq');
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "faq`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "faq_description`");
	}
}