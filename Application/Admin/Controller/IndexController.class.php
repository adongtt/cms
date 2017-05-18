<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController{
    
    public function index(){

    	//获取今天登陆的用户数
    	$today = strtotime(date('Y-m-d', time()));
    	$userCount = D('Admin')->getTodayLoginCount('lastlogintime >='.$today);
    	//获取文章总数
    	$data = array('status'=>1);
    	$newsCount = D('News')->countNews($data);
    	//获取最大阅读数的文章
    	$news = D('News')->getCountMax();
    	$newsMax = $news['count'];
    	//获取推荐位数据
    	$result = array(
           'userCount'=>$userCount,
           'newsCount'=>$newsCount,
           'newsMax'=>$newsMax,
    		);

    	//print_r($result);exit;
    	$this->assign('result',$result);
    	$this->display();
    }

    public function main() {
    	$this->display();
    }
}