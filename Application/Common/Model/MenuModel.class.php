<?php
namespace Common\Model;
use Think\Model;

class MenuModel extends Model{
    private $_db;
    public function __construct(){
        $this->_db = M('menu');
    }
    public function insert($data = array()){
       
       if(!$data || !is_array($data))
       	return 0;
       else
       	return $this->_db->add($data);
    }
/*
获取分页的数据
 */
    public function getMenus($data , $page ,$pageSize)
    {
       $data['status']=array('neq',-1);
       $offset = ($page-1)*$pageSize;
       
       return $this->_db->where($data)
       ->order('listorder desc,menu_id desc')
       ->limit($offset,$pageSize)
       ->select();
    }
/*
获取数据总的条数
 */
    public function getMenuCount($data = array())
    {
    	$data['status']=array('neq',-1);
    	return  $this->_db->where($data)->count();
    }
 /*
 获取某条的数据
  */
   public function getMenuById($data)
   {
   	return $this->_db->where($data)->find();
   }
 /*
 更新菜单内容
  */
   public function updateMenuById($menuId,$data)
   {
   	if(!isset($menuId) || !is_numeric($menuId)){
   		throw_exception('ID不合法');
   	}
   	if(!isset($data) || !is_array($data)){

   		throw_exception('数据不合法');   	}

   		return $this->_db->where('menu_id='.$menuId)->save($data);

   }
 /*
 删除菜单
  */
   public function setStatusById($menuId,$status){
   		if(!isset($menuId) || !is_numeric($menuId)){
   		throw_exception("ID不合法");
   	}
   	$data['status'] = $status;
   	  return $this->_db->where('menu_id='.$menuId)->save($data);
}
 /*
 菜单排序
  */
  public function setListOrderById($menuId,$listOrder)
  {
  	$data['listorder']=$listOrder;
  	return $this->_db->where('menu_id='.$menuId)->save($data);
  } 
  /**
   * 产生菜单内容
   */
  public function getAdminMenu()
  {
  	$where['type'] = 1;
  	$where['status'] = 1;
  	return $this->_db->order('listorder desc,menu_id desc')->where($where)->select();

  }
  /*
  获取栏目
   */
  public function getCat()
  {
    $where['status']=array('eq',1);
    $where['type']=0;
    return $this->_db->order('listorder desc,menu_id desc')->where($where)->select();
  }

}