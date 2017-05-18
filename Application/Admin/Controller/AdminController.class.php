<?php
/**
 * 用户管理
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController{
    
    /**
     * 用户管理首页
     */
    public function index()
    {
    	$users = D('Admin')->select(array('status'=>array('neq',-1)));
    	$this->assign('users',$users);
    	$this->display();
    }

    public function add()
    {
    	if($_POST)  //新增或者编辑修改
    	{
            if(!$_POST['realname'] || !isset($_POST['realname']))
            	return show(0,'真实姓名不能为空');
            if(!$_POST['password'] || !isset($_POST['password']))
            	return show(0,'密码不能为空');
            if(!$_POST['username'] || !isset($_POST['username']))
            	return show(0,'用户名不能为空');

            if($_POST['admin_id']) //edit
            {

            }
            else
            {
                $data = $_POST;
            	$data['password'] = getMd5ByPassword($_POST['password']);
            	$res = D('Admin')->insert($data);
            	if($res)
            		return show(1,'新增成功');
            	else
            		return show(0,'新增失败');
            }
    	}
    	$this->display();
    }

    public function setStatus()
    {
    	if(!$_POST['id'])
    		return show(0,'ID不合法');

    	$id = $_POST['id'];
    	$data = array('status'=>$_POST['status']);
    	try{
    	$res = D('Admin')->updateAdminById($id,$data);
    	if($res)
    		return show(1,'删除成功');
    	else
    		return show(0,'删除失败');
    }catch(Exception $e)
    {
    	return show(0,$e->getMessage());
    }
    }

    public function personal()
    {
    	if(!isset($_GET['id']) || !$_GET['id'])
    		return show(0,'ID不合法');
        $id = $_GET['id'];
    	$user = D('Admin')->getAdminById($id);
    	$this->assign('user',$user);
    	$this->display();
    }

    public function save()
    {
    	if(!$_POST)
    		return show(0,'没有提交的内容');
    	else
    	{
    		if(!$_POST['admin_id'])
    			return show(0,'ID不合法');
    		if(!$_POST['realname'])
    			return show(0,'真实姓名不能为空');
    		$data['realname']=$_POST['realname'];
    		$data['email']=$_POST['email']?$_POST['email']:'';
    		$res = D('Admin')->updateAdminById($_POST['admin_id'],$data);
    		if($res)
    			return show(1,'更新成功');
    		else
    			return show(1,'更新失败');
    	}
    }
}