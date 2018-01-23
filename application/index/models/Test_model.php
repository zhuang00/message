<?php

 class Test_model extends CI_Model{
     function __construct()
     {
         parent::__construct();
     
    }
    public function count_table($table='message')
    {
        $total = $this->db->count_all_results($table);
        return $total;
    }
    public function page($limit,$offset, $table = 'message')
    {
        $this->db->limit($limit, $offset); // limit(每页显示数量，偏移量)
        $data['list'] = $this->db->get($table)->result_array(); // 获取数据库里的数据
        $data['page_list'] = $this->pagination->create_links();
        
        return $data;
    }
}