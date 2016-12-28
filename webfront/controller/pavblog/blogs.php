<?php 
/******************************************************
 * @package Pav blog module for Opencart 1.5.x
 * @version 1.0
 * @author http://www.pavothemes.com
 * @copyright	Copyright (C) Feb 2013 PavoThemes.com <@emai:pavothemes@gmail.com>.All rights reserved.
 * @license		GNU General Public License version 2
*******************************************************/

/**
 * class ControllerpavblogBlog 
 */
class ControllerPavblogBlogs extends Controller {
	
		private $mparams = '';

		private $mdata = array();
		
		/**
		 * index action
	     *
		 */
		public function index() {  
			 
			$this->preload();
			
			if (isset($this->request->get['filter'])) {
				$filter = $this->request->get['filter'];
			} else {
				$filter = '';
			}
					
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'b.sort_order';
			}

			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'DESC';
			}
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else { 
				$page = 1;
			}	
								
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit =  (int)$this->mparams->get( 'cat_limit_leading_blog' ) +  (int)$this->mparams->get( 'cat_limit_secondary_blog' );
			}
		

			$this->load->model("pavblog/category");
			$users = $this->getModel('category')->getUsers();

			if( isset($this->request->get['tag']) ){
				$filter_tag = $this->request->get['tag'];
			}else {
				$filter_tag = '';
			}
			
			$fileterData = array(
				'filter_category_id' => '',
				'filter_filter'      => $filter, 
				'filter_tag'  		 => $filter_tag,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
			
			if( $filter || $filter_tag ){
				$data['heading_title'] = $this->language->get('filter_blog_header_title');
			} else {
				$data['heading_title'] = $this->language->get('blogs_latest_header_title');
				$data['sort'] = 'b.created';
				$order = 'DESC';
			}
			
		
			$blogs = $this->getModel( 'blog' )->getListBlogs(  $fileterData );
			
			//print '<pre>'; print_r($blogs);exit;
			
			if ($blogs) {
				
				
				$total = $this->getModel( 'blog' )->getTotal( $fileterData );
				
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}	

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}	
				
				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
				
				if (isset($this->request->get['tag'])) {
					$url .= '&tag=' . $this->request->get['tag'];
					$data['heading_title'] = sprintf($data['heading_title'] , "tag: ".$this->request->get['tag']);
				}
				$this->document->setTitle( $data['heading_title'] );
				
				
				$limit_leading_blogs = (int)$this->mparams->get( 'cat_limit_leading_blog' );
				$type = array('l'=>'thumb_large','s'=>'thumb_small');
				$limageType = isset($type[$this->mparams->get('cat_leading_image_type')])?$type[$this->mparams->get('cat_leading_image_type')]:'thumb_xsmall';
				$simageType = isset($type[$this->mparams->get('cat_secondary_image_type')])?$type[$this->mparams->get('cat_secondary_image_type')]:'thumb_xsmall';
				
	//print '<pre>'; print_r($blogs);exit;
				foreach( $blogs as   $blog ){
					 
					
					// if ($blog['image'] && file_exists(DIR_IMAGE.$blog['image'])) {
					// 	$thumb = $this->model_tool_image->resize($blog['image'], $this->mparams->get('general_lwidth'), $this->mparams->get('general_lheight'),'w');
					// } else {
					// 	$thumb = $this->model_tool_image->resize('placeholder.png', $this->mparams->get('general_lwidth'), $this->mparams->get('general_lheight'),'w');
					// }


					if (!empty($blog['image'])) {
						$thumb = $blog['image'];
					} else {
						$thumb = HTTP_IMAGE.'placeholder.png';
					}

						
					$data['allBlogs'][] = array(
					'blog_id' 			=> $blog['blog_id'],
					'title' 				=>  utf8_substr(strip_tags(html_entity_decode($blog['title'], ENT_QUOTES, 'UTF-8')), 0, 40) . '..',
					'date'				=> date('d M Y', strtotime($blog['created'])),
					'description'  		=> utf8_substr(strip_tags(html_entity_decode($blog['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'thumb'       		=> $thumb,
					 
					'author'      		=> isset($users[$blog['user_id']])?$users[$blog['user_id']]:$this->language->get('text_none_author'),	
					'category_link'     => $this->url->link( 'pavblog/category', "blogcategory_id=".$blog['category_id'] ),	
					'comment_count'     => $this->getModel('comment')->countComment( $blog['blog_id'] ),	
					'link'      		=> $this->url->link( 'pavblog/blog','blog_id='.$blog['blog_id'] )
				);
					
				}
				
				$leading_blogs 		 = array_slice( $blogs,0, $limit_leading_blogs );
				$secondary_blogs 	 = array_splice( $blogs, $limit_leading_blogs, count($blogs) );
		
				 
				
				//print '<pre>'; print_r($data['blogs']);exit;

			 	if (version_compare(VERSION, '2.1.0.1') >= 0) {
				 	$config	 = $this->mparams;
					$data['cat_columns_leading_blogs'] = $config->get('cat_columns_leading_blogs');
					$data['cat_columns_secondary_blogs'] = $config->get('cat_columns_secondary_blogs');
					$data['blog_show_author'] = $config->get('blog_show_author');
					$data['blog_show_category'] = $config->get('blog_show_category');
					$data['blog_show_category'] = $config->get('blog_show_category');
					$data['blog_show_created'] = $config->get('blog_show_created');
					$data['blog_show_hits'] = $config->get('blog_show_hits');
					$data['blog_show_comment_counter'] = $config->get('blog_show_comment_counter');
					$data['cat_show_title'] = $config->get('cat_show_title');
					$data['cat_show_created'] = $config->get('cat_show_created');
					$data['cat_show_description'] = $config->get('cat_show_description');
					$data['cat_show_readmore'] = $config->get('cat_show_readmore');
					$data['cat_show_image'] =  $config->get('cat_show_image');


					$data['cat_show_author'] =  $config->get('cat_show_author');
					$data['cat_show_category'] =  $config->get('cat_show_category');
					$data['cat_show_hits'] =  $config->get('cat_show_hits');
					$data['cat_show_comment_counter'] =  $config->get('cat_show_comment_counter');
					 
					
				} else {
					$data['config'] = $this->mparams;
				}
				
				$data['leading_blogs'] = $leading_blogs;
				$data['secondary_blogs'] = $secondary_blogs;
				$data['latest_rss'] =  $this->url->link( 'pavblog/blogs/rss' );


				$pagination = new Pagination();
				$pagination->total = $total;
				$pagination->page = $page;
				$pagination->limit =  $limit;
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->url->link('pavblog/blogs',  $url . '&page={page}');

				$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

				$data['pagination'] = $pagination->render();

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');
				
				 
				$data['objlang'] = $this->language;
				$data['objurl'] = $this->url;
				
				//print '<pre>'; print_r($data['allBlogs']);exit;
				 
				$this->response->setOutput($this->load->view('pavblog/blogs',$data));

				/*if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/pavblog/blogs.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/pavblog/blogs.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/pavblog/blogs.tpl', $data));
				}*/
				

			} else {
				$category_id = isset($this->request->get["id"])?$this->request->get["id"]:0;
				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_error'),
					'href'      => $this->url->link('information/information', 'category_id=' . $category_id),
					'separator' => $this->language->get('text_separator')
				);
					
				$this->document->setTitle($this->language->get('text_error'));
				
				$data['heading_title'] = $this->language->get('text_error');

				$data['text_error'] = $this->language->get('text_error');

				$data['button_continue'] = $this->language->get('button_continue');
				
				$data['continue'] = $this->url->link('common/home');

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

				$data['objlang'] = $this->language;
				$data['objurl'] = $this->url;

				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_home'),
					'href'      => $this->url->link('common/home'),
				);
				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_blogs'),
					'href'      => $this->url->link('pavblog/blogs'),
				);
				
				
				 
				 
				/*if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
				}*/
			}
		}
		
		public function preload(){
		
			$data['objlang'] = $this->language;
			$data['objurl'] = $this->url;

			$this->load->model('tool/image'); 			
			$this->load->language('module/pavblog');
			$this->load->model("pavblog/blog");
			$this->load->model("pavblog/comment");

			$mparams = $this->config->get( 'pavblog' );
			$default = $this->model_pavblog_blog->getDefaultConfig();
			
			$mparams = !empty($mparams)?$mparams:array();

			if( $mparams ){
				$mparams =  array_merge( $default,$mparams);
			}else{
				$mparams = $default;
			}
			$config = new Config();
			if( $mparams ){
				foreach( $mparams as $key => $value ){
					$config->set( $key, $value );
				}
			}
			$this->mparams = $config; 
			
	
			if( !defined("_PAVBLOG_MEDIA_") ){
				if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pavblog.css')) {
					$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pavblog.css');
				} else {
					$this->document->addStyle('catalog/view/theme/default/stylesheet/pavblog.css');
				}
				define("_PAVBLOG_MEDIA_",true);
			}
		}
		
		public function getParam( $key, $value='' ){
			return  $this->mparams->get( $key, $value );
		}
		
		/**
		 * get model object
		 */
		public function getModel( $model='blog' ){
			return $this->{"model_pavblog_{$model}"};
		}
		
		/**
		 * get rss feed by category id 
		 */
		public function rss(){
			
			$this->preload();
			if( isset($this->request->get['id']) ){
				$id = (int)$this->request->get['id'];
			} else {
				$id = 0;
			}
			
			$category_info = $this->getModel()->getInfo( $id );	
			
			$output = '<?xml version="1.0" encoding="UTF-8" ?>';
			$output .= '<rss version="2.0">';
			$output .= '<channel>';

			$output .= '<title><![CDATA[' . $this->language->get('blogs_latest_header_title'). ' - ' . $this->config->get('config_name') . ']]></title>';
			$output .= '<description><![CDATA[' . $this->config->get('config_meta_description') . ']]></description>';
			$output .= '<link><![CDATA[' . HTTP_SERVER . ']]></link>';
			
			$page = 1;
			$limit = (int)$this->mparams->get('rss_limit_item')?(int)$this->mparams->get('rss_limit_item'):100;
			
			$data = array(
				'filter_category_id' => '',
				'sort'               => 'b.created',
				'order'              => 'ASC',
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$blogs = $this->getModel('blog')->getListBlogs(  $data );
			

			foreach( $blogs as $blog ){
				$link =  str_replace("&amp;","&",$this->url->link( 'pavblog/blog','id='.$blog['blog_id'] ));
				if( $blog['image'] ){
					$image = $this->model_tool_image->resize($blog['image'], $this->mparams->get('general_swidth'), $this->mparams->get('general_sheight') ,'w' );
					$description = '<a href="'.$link.'"><img class="rss_blog_image" src="'.$image.'"/></a>'.  html_entity_decode($blog['description'], ENT_QUOTES, 'UTF-8'); 
				}else {
					$description =  html_entity_decode($blog['description'], ENT_QUOTES, 'UTF-8');
				} 
			
				$output .= '<item>';
				$output .= '<title><![CDATA[' . $blog['title'] . ']]></title>';
				$output .= '<link><![CDATA[' .$link. ']]></link>';
				$output .= '<description><![CDATA[' . $description . ']]></description>';
				$output .= '<guid>' . $blog['blog_id'] . '</guid>';
				$output .= '<pubDate>' . date('D, j F Y H:i:s e', strtotime($blog['created'])) . '</pubDate>';
				$output .= '</item>';
			}
			$output .= '</channel>';
			$output .= '</rss>';
			$this->response->addHeader('Content-Type: application/rss+xml');
			$this->response->setOutput($output);
		
		}
		
		
	}	
	?>