<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        header('Content-Type:text/html; charset=utf-8');

        $this->load->helper(array('url'));
        $this->load->model('Message_model');
        $this->load->model('Test_model');
        $this->load->database();
        $this->load->library('table');
    }

	public function page($page='')
	{
        echo $page;
        // echo site_url('/message/index');die;
        $limit = 1;
        $this->load->library('pagination');
        $total = $this->Test_model->count_table('message');
        $config['base_url'] = site_url('/test/page');
        $config['first_url'] = site_url('test/page');
        //这几行为可选设置
        $config['first_link'] ='首页';
        $config['last_link'] ='尾页';
        $config['num_links'] =1;//放在你当前页码的前面和后面的“数字”链接的数量
        /****************************** */

        $config['suffix'] = '.html';
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;

        //自定义标签样式
        $config['full_tag_open'] = '<ul class="pagination">';  
        $config['full_tag_close'] = '</ul>';  
        $config['first_tag_open'] = '<li>';  
        $config['first_tag_close'] = '</li>';  
        $config['prev_tag_open'] = '<li>';  
        $config['prev_tag_close'] = '</li>';  
        $config['next_tag_open'] = '<li>';  
        $config['next_tag_close'] = '</li>';  
        $config['cur_tag_open'] = '<li class="active"><a>';  
        $config['cur_tag_close'] = '</a></li>';  
        $config['last_tag_open'] = '<li>';  
        $config['last_tag_close'] = '</li>';  
        $config['num_tag_open'] = '<li>';  
        $config['num_tag_close'] = '</li>';  
        
        // $page = (int)$this->uri->segment(3);
        $offset = $page == false?0:($config['per_page'] * ($page - 1));
        
        $this->pagination->initialize($config);

        $data = $this->Test_model->page($limit,$offset);
    
        $this->load->view('header');
        $this->load->view('page',$data);
        $this->load->view('footer');

        
       
    }
}