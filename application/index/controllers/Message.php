<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
    public  $totol =null;


    public function __construct()
    {
        parent::__construct();

        header('Content-Type:text/html; charset=utf-8');

        $this->load->helper(array('url'));
        $this->load->model('Message_model');
        $this->load->database();
        $this->load->library('table');
    }
    public  function index()
    {
        // $this->output->cache(5);
        $total = $this->Message_model->get_total_rows();
        $this->total  = $total[0]['num'];
        // var_dump($this->total);die;
        //使用分页类
        $this->load->library('pagination');

        $config['base_url'] = site_url('/message/index').'/page/';
        
        $config['total_rows'] = $this->total;
        $config['per_page'] = 100;
        // var_dump($config);die;
        $this->pagination->initialize($config);
        // echo $this->pagination->create_links();die;
        //引入模板
        $this->load->view('header');
        $this->load->view('index');
        $this->load->view('footer');
        
        
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
            'name'=>$this->input->post('name',TRUE),
            'url'=>$this->input->post('url'),
            'title'=>$this->input->post('title'),
            'content'=>$this->input->post('content'),
        );

        $this->Message_model->update($data,$this->uri->segment(4));
        $this->output->delete_cache('message/index');
        redirect(site_url('/message/index'));
    }
    public function add()
    {
        $data = $this->input->post(array('title','content','name'));
        $this->datacheck($data);
        $data['url']='http://blog.phchng.com';
        $data['date']=date('Y-m-d',time());
        $res = $this->Message_model->insert($data);
        //判断是否插入成功
       if($res!=0){
        $this->output->delete_cache('message/index');
         exit(json_encode(['error'=>'0','info'=>'添加成功']));    
       }else{
            exit(json_encode(['error'=>'1','info'=>'添加失败']));
           
       }
    }
    private function datacheck($data)
    {
        if(empty($data['name'])){
            exit(json_encode(['error'=>'1','info'=>'请填写名字']));
        }
        if(empty($data['title'])){
            exit(json_encode(['error'=>'1','info'=>'请填写标题']));
        }
        if(empty($data['content'])){
            exit(json_encode(['error'=>'1','info'=>'请填写内容']));
        }
        return $data;
    }

}