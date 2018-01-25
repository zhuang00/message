<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Message extends CI_Controller
{
    public $totol =null;


    public function __construct()
    {
        parent::__construct();

        header('Content-Type:text/html; charset=utf-8');

        $this->load->helper(array('url'));
        $this->load->model('Message_model');
        $this->load->database();
        $this->load->library('table');
    }
    public function index()
    {
        // $this->output->cache(5);
        $this->total = $this->Message_model->get_total_rows();

        $page_size = 2;


        $data = $this->page($page_size);

        //引入模板
        $this->load->view('header');
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
    private function page($page_size)
    {
        // $config['per_page'] =$page_size;
        $this->load->library('pagination');
        $config['base_url'] = site_url('/message/index/page');
        $config['total_rows'] = $this->total;
        $config['per_page'] = $page_size;
        // $config['uri_segment'] = 4;
        $config['use_page_numbers'] = true;

        //自定义分页标签样式
        $config['num_links'] =2;
        $config['first_link'] ='&laquo;';
        $config['last_link'] ='&raquo;';
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

        $this->pagination->initialize($config);

        $offset =intval($this->uri->segment(4));

        if ($offset<=0) {
            $data['res'] = $this->Message_model->page_data($page_size, 1);
        } else {
            if ($offset>=ceil($this->total/$page_size)) {
                $data['res'] = $this->Message_model->page_data($page_size, ceil($this->total/$page_size));
            } else {
                $data['res'] = $this->Message_model->page_data($page_size, $offset);
            }
        }
        

        $data['links']  = $this->pagination->create_links();
        
        return $data;
    }

    public function delete()
    {
        $this->Message_model->delete($this->uri->segment(4));
        
        redirect(site_url('/message/index'));
    }
    //载入编辑视图
    public function edit()
    {
        $this->load->view('header');
        $this->load->view('edit');
        $this->load->view('footer');
    }


    //更新id为$id 的记录
    public function update()
    {
        $data = array(
            'name'=>$this->input->post('name', true),
            'url'=>$this->input->post('url'),
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
        );

        $this->Message_model->update($data, $this->uri->segment(4));
        $this->output->delete_cache('message/index');
        redirect(site_url('/message/index'));
    }
    public function add()
    {
        $data = $this->input->post(array('title','content','name'));
        $this->datacheck($data);
        $data['url']='http://blog.phchng.com';
        $data['date']=date('Y-m-d', time());
        $res = $this->Message_model->insert($data);
        //判断是否插入成功
        if ($res!=0) {
            $this->output->delete_cache('message/index');
            exit(json_encode(['error'=>'0','info'=>'添加成功']));
        } else {
            exit(json_encode(['error'=>'1','info'=>'添加失败']));
        }
    }
    private function datacheck($data)
    {
        if (empty($data['name'])) {
            exit(json_encode(['error'=>'1','info'=>'请填写名字']));
        }
        if (empty($data['title'])) {
            exit(json_encode(['error'=>'1','info'=>'请填写标题']));
        }
        if (empty($data['content'])) {
            exit(json_encode(['error'=>'1','info'=>'请填写内容']));
        }
        return $data;
    }
}
