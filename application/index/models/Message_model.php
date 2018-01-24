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
     public function update($data,$id,$table = 'message')
     {
         $data['date']=date('Y-m-d', time());
         // var_dump($data);die;
         $this->db->where('id', $id);
         $this->db->update($table, $data);
     }
     public function get_total_rows($table = 'message')
     {
         // print_r(query('select * form '.$table));die;
         $total = $this->db->query('select count(Id) as num from '.$table)->result_array();
         // echo $this->db->last_query();
         // $error = $this->db->last_query();
         return $total;
     }
 }
