<?php
/**
 * 基本配置
 */
namespace Admin\Controller;
use Think\Controller;
class BasicController extends CommonController{

	public function index()
	{
		$config = F('WEB_CONFIG');
		//print_r($config);exit;
		$this->assign('config',$config);
		$this->display();
	}

	public function add()
	{
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        if($_POST)
        {
           F('WEB_CONFIG',$_POST);
           return show(1,'缓存成功',$jumpUrl);
        }
	}
}