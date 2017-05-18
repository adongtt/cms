<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller{

    public function index(){

    	return $this->display();
    }
    
    public function check(){
       $username = I('post.username');
       $password = I('post.password');
       
       //dump(C('DB_NAME'));exit;
       
       if(!trim($username))
       return show(0,'用户名不能为空');
       if(!trim($password))
       return show(0,'密码不能为空');
       try{
       $ret = D('Admin')->getAdminByUsername($username);
       if(!$ret || $ret['status']==-1){
        return show(0,'该用户不存在');
       }
       if($ret['password']!=getMd5ByPassword($password))
         return show(0,'密码错误');
       $data = array(
        'lastloginip'=>$_SERVER['REMOTE_ADDR'],
        'lastlogintime'=>time());
       D('Admin')->updateAdminById($ret['admin_id'],$data);
      //print_r($_SERVER);exit;
      session('adminUser', $ret);
      return show(1,'登录成功');
    }
    catch(Execption $e){
    return show(0,$e->getMessage());
    }
  }

    public function loginout(){
        session('adminUser',' ');
        $this->redirect('/admin.php?c=login');
    }

}