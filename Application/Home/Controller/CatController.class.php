<?php
namespace Home\Controller;
use Think\Controller;
class CatController extends CommonController {
    public function index(){
    	$catId = $_GET['id'];        
        $page=$_REQUEST['p']?$_REQUEST['p']:1;
    	$pageSize=$_REQUEST['pageSize']?$_REQUEST['pageSize']:C('MENU_PAGE_SIZE');
    	$data['status']=array('eq',1);
        $data['catid']=$catId;
    	$news = D('News')->getNews($data,$page,$pageSize);
    	if(!$news)
    		return $this->error("栏目不存在");
    	$newsCount = D('News')->getNewsCount($data);

    	$res = new \Think\Page($newsCount,$pageSize);   //分页网页
        $pageRes = $res->show();

        $rankNews = D('News')->getRank();
        $advNews = D('PositionContent')->select(array('status'=>1,'position_id'=>5),3);
    	$this->assign('smallNews',$smallNews);
    	$this->assign('listNews',$news);
    	$this->assign('rankNews',$rankNews);
    	$this->assign('advNews',$advNews);
    	$this->assign('cat_id',$catId);
        $this->display();
    }
}