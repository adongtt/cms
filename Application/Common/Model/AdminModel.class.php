<?php
namespace Common\Model;
use Think\Model;

class AdminModel extends Model{
    private $_db;
    public function __construct(){
        $this->_db = M('admin');
    }
    public function getAdminByUsername($username){
        $ret = $this->_db->where('username="'.$username.'"')->find();
        return $ret;
    }

/**
 * 通过admin_id更新admin表
 * @param  [type] $id   [description]
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
    public function updateAdminById($id,$data)
    {
    	if(!$id || !is_numeric($id))
    		throw_exception('ID不合法');
    	return $this->_db->where('admin_id='.$id)->save($data);
    }
/*
查找admin表
 */
    public function select($data=array())
    {
    	return $this->_db->order('lastlogintime desc')->where($data)->select();
    }

    public function insert($data)
    {
    	return $this->_db->add($data);
    }

    public function getAdminById($id)
    {
        return $this->_db->where('admin_id='.$id)->find();
    }

    public function getTodayLoginCount($data)
    {
        return $this->_db->where($data)->count();
    }
}