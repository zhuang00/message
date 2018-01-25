<?php

 class Message_model extends CI_Model
 {
     public function __construct()
     {
         parent::__construct();
     }
     //查询数据表
     public function show($table = 'message')
     {
         return $this->db->get($table);
     }
     //插入数据
     public function insert($data, $table = 'message')
     {
         $this->db->insert($table, $data);
         return $this->db->insert_id();
     }
     //  条件查询
     public function show_where($id, $table = 'message')
     {
         $this->db->where('id', $id);
         return $this->db->get($table);
     }
     //删除
     public function delete($id, $table = 'message')
     {
         //  echo '111';
         //  var_dump($id);die;
         $this->db->where('id', $id);
         $this->db->delete($table);
     }
     public function edit($data, $id, $table = 'message')
     {
         $this->db->update(data);
     }


     //更新id为$id 的记录
     public function update($data, $id, $table = 'message')
     {
         $data['date']=date('Y-m-d', time());
         // var_dump($data);die;
         $this->db->where('id', $id);
         $this->db->update($table, $data);
     }
     //获取数据总条数
     public function get_total_rows($table = 'message')
     {
         return $this->db->count_all_results($table);
     }
     //处理分页数据model
     public function page_data($page_size, $offset, $table = 'message')
     {
         //  var_dump($page_size, $offset);die;
         $this->db->order_by('Id', 'DESC');
         $this->db->limit($page_size, intval(($offset-1)*$page_size)); // limit(每页显示数量，偏移量)
         return $this->db->get($table)->result_array(); // 根据分页获取数据库里的数据
     }


     //登陆处理
     public function checkuser($data,$table='blog_user')
     {
        $this->db->where('email', $data['email']);
        return  $this->db->get($table)->row_array();
       
     }
 }
