<?php
namespace Home\Controller;
use Think\Controller;
class DetailController extends CommonController {
	public function index()
	{
		$id=intval($_GET['id']);
        if(!$id || $id<0)
        	return $this->error('ID不合法');

        $news=D('News')->find($id);
        if(!$news)
        	return $this->error('没有这篇文章');
        $count=intval($news['count'])+1;
        $data = array('count'=>$count);
        D('News')->updateCountById($id,$data);
        $data['news_id']=$news['news_id'];
        $content=D('NewsContent')->getNewsContentById($data);
        if(!$content)
        	return $this->error('文章内容为空');
        $news['content']=htmlspecialchars_decode($content['content']);
        $rankNews = D('News')->getRank();
        $advNews = D('PositionContent')->select(array('status'=>1,'position_id'=>5),3);
        $this->assign('cat_id',$news['catid']);
        $this->assign('news',$news);
        $this->assign('advNews',$advNews);
        $this->assign('rankNews',$rankNews);
		$this->display();
	}
}