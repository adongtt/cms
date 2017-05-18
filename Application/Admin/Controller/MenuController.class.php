<?php
namespace Admin\Controller;
use Think\Controller;
class MenuController extends Controller{
    
    public function index(){
    	$data=array();
    	if(isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0,1)))
    	{
    		$data['type'] = $_REQUEST['type'];
    	}
    	else
    		$_REQUEST['type'] = -100;
    	$page=$_REQUEST['p']?$_REQUEST['p']:1;
    	$pageSize=$_REQUEST['pageSize']?$_REQUEST['pageSize']:C('MENU_PAGE_SIZE');
    	$menus = D('Menu')->getMenus($data,$page,$pageSize);
    	$menuCount = D('Menu')->getMenuCount($data);

    	$res = new \Think\Page($menuCount,$pageSize);   //分页网页
        $pageRes = $res->show();
        $this->assign('type',$_REQUEST['type']);
        $this->assign('pageRes',$pageRes);
        $this->assign('menus',$menus);
        $this->display();
    }
    
    public function add(){
        if($_POST)
        {
          if(!isset($_POST['name']) || !$_POST['name'])
        		return show(0,'菜单名不能为空');
        	if(!isset($_POST['m']) || !$_POST['m'])
        		return show(0,'模块名不能为空');
        	if(!isset($_POST['c']) || !$_POST['c'])
        		return show(0,'控制器不能为空');
        	if(!isset($_POST['f']) || !$_POST['f'])
        		return show(0,'方法名不能为空');
            if($_POST['menu_id'])
            {
            	return $this->save($_POST);
            }
          if(!$_POST['menu_id']){
                    $menuId = D('Menu')->insert($_POST);
          if($menuId)
          	return show(1,'插入成功');
          else
          	return show(0,'插入失败');
        }
        }
        else
        $this->display();
    }

    public function edit()
    {
    	if(!isset($_GET['id']) || !$_GET['id'])
    		return show(0,'id不合法');
    	$data['menu_id'] = $_GET['id'];

    	$res = D('Menu')->getMenuById($data);
      
      //dump($res['name']);exit;
    	if(!$res)
    		return show(0,'没有此菜单');

    	$this->assign('menu',$res);
    	$this->display();
    }

    public function save($data)
    {
    	$id = $data['menu_id'];
    	unset($data['menu_id']);
    	try
    	{
          //dump($data);exit;
          $res = D('Menu')->updateMenuById($id,$data);
          //print_r($res);
          if(!$res)
          	return show(0,'更新失败');
          else
          	return show(1,'更新成功');
    	}catch(Execption $e)
    	{
    		return show(0,$e->getMessage());
    	}
    }

/*
更新菜单状态
 */
    public function setStatus()
    {
    	$id=$_POST['id'];
    	$status=$_POST['status'];
    	if(!$id)
    		return show(0,'ID不存在');
    	try{
          $res = D('Menu')->setStatusById($id,$status);
          if($res)
          	return show(1,'删除成功');
          else
          	return show(0,'删除失败');
    	}catch(Execption $e)
    	{
    		return show(0,$e->getMessage());
    	}

    }
/*
菜单排序功能
 */
   public function listorder()
   {
      $listorder = $_POST['listorder'];
      $jumpUrl = $_SERVER['HTTP_REFERER'];
      return commonListorder('Menu',$listorder,$jumpUrl);
   }
}