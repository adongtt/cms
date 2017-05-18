<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index($type=''){
    	$topNews = D('PositionContent')->select(array('status'=>1,'position_id'=>2),1);
    	//dump($topNews);exit;
    	$smallNews = D('PositionContent')->select(array('status'=>1,'position_id'=>3),3);
        
        $listNews = D('News')->select(array('status'=>1,'thumb'=>array('neq','')),30);
        $rankNews = D('News')->getRank();
        $advNews = D('PositionContent')->select(array('status'=>1,'position_id'=>5),3);
    	$this->assign('topNews',$topNews);
    	$this->assign('smallNews',$smallNews);
    	$this->assign('listNews',$listNews);
    	$this->assign('rankNews',$rankNews);
    	$this->assign('advNews',$advNews);
    	$this->assign('cat_id',0);
    	if($type=='build_html')
    		$this->buildHtml('index',HTML_PATH,"Index/index");
    	else
        $this->display();
    }

    public function build_html()
    {
    	$this->index('build_html');
        return show(1,'首页缓存更新成功');
    }

    public function getCount()
   {
        if(!$_POST)
            return show(0,'没有提交内容');
        $newsIds=array_unique($_POST);

        $list=D('News')->getNewsByIdIn($newsIds);

        if(!$list)
            return show(0,'没有数据');

        foreach($list as $key=>$v)
        {
            $data[$v['news_id']]=$v['count'];
        }
        return show(1,'查找成功',$data);
    }


}