<?php
namespace Common\Model;
use Think\Model;

class PositionContentModel extends Model{
    private $_db;
    public function __construct(){
        $this->_db = M('position_content');
    }


    public function insert($data)
    {
        $data['create_time']=time();
        return $this->_db->add($data);
    }

    public function save($data)
    {
         $data['update_time']=time();
         return $this->_db->save($data);
    }

    public function select($data,$limit=0)
    {
        if($limit>0)
            return $this->_db->order('create_time desc')->limit($limit)->where($data)->select(); 
        return $this->_db->order('create_time desc')->where($data)->select();
    }

        public function find($data)
    {

        return $this->_db->where($data)->find();
    }

    public function setStatusById($id,$status){
    if(!isset($id) || !is_numeric($id))
    {
        throw_exception("ID不合法");
    }
    $data['status'] = $status;
      return $this->_db->where('id='.$id)->save($data);
    }
}