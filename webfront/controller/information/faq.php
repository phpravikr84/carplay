<?php
class ControllerInformationFaq extends Controller {
	public function index() {
		$this->language->load('information/faq');
		
		$this->load->model('extension/faq');
	 
		$this->document->setTitle($this->language->get('heading_title')); 
	 
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' 		=> $this->language->get('text_home'),
			'href' 		=> $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' 		=> $this->language->get('heading_title'),
			'href' 		=> $this->url->link('information/faq')
		);
                
                $data['href'] = $this->url->link('information/information');
		  
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}	

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		
		$filter_data = array(
			'page' 	=> $page,
			'limit' => 10,
			'start' => 10 * ($page - 1),
		);
		
		$total = $this->model_extension_faq->getTotalFaq();
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('information/faq', 'page={page}');
		
		$data['pagination'] = $pagination->render();
	 
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($total - 10)) ? $total : ((($page - 1) * 10) + 10), $total, ceil($total / 10));

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_question'] = $this->language->get('text_question');
		$data['text_answer'] = $this->language->get('text_answer');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_view'] = $this->language->get('text_view');
	 
		$all_faq = $this->model_extension_faq->getAllFaq($filter_data);
	 
		$data['all_faq'] = array();
		
		
	 
		foreach ($all_faq as $faq) {
			$data['all_faq'][] = array (
				'question' 		=> html_entity_decode($faq['question'], ENT_QUOTES),
				
				'answer' 	=> (strip_tags(html_entity_decode($faq['answer'], ENT_QUOTES))) ,
				'view' 			=> $this->url->link('information/faq/faq', 'faq_id=' . $faq['faq_id']),
				'date_added' 	=> date($this->language->get('date_format_short'), strtotime($faq['date_added']))
			);
		}
	 
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
                
                $this->response->setOutput($this->load->view('information/faq', $data)); 

		 
	}
 
	
	
}