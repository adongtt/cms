<?php
/**
 * 推荐位内容管理
 */
namespace Admin\Controller;
use Think\Controller;
class PositionContentController extends CommonController{

	public function index()
	{
		$data = array(
			'status'=>array('neq',-1));
		if($_GET['position_id'])
    {
			$data['position_id']=$_GET['position_id'];
      
    }
		if($_GET['title'])
    {
			$data['title']=array('like','%'.trim($_GET['title']).'%');
      $this->assign('title',trim($_GET['title']));
      //dump($data);exit;
    }
    $position_id = $data['position_id']?$data['position_id']:'0';
    $this->assign('position_id',$position_id);
		$positionContents = D('PositionContent')->select($data);
		$positionIds = D('Position')->getPositions();
		//dump($positionContents);exit;
		$this->assign('positionContents',$positionContents);
		$this->assign('positionIds',$positionIds);
		$this->display();
	}

	public function add()
	{
		if($_POST)
		{
			$jumpUrl = $_SERVER['HTTP_REFERER'];
            if(!isset($_POST['title']) || !$_POST['title'])
            	return show(0,'没有标题');
            if(!isset($_POST['thumb']) || !$_POST['thumb'])
            	return show(0,'没有缩略图');
            if(!$_POST['url'] && !$_POST['news_id'])
            	return show(0,'没有设置url或者文章ID');

            $data['title']=$_POST['title'];
            $data['thumb']=$_POST['thumb'];
            $data['status']=$_POST['status'];
            if($_POST['url'])
            	$data['url']=$_POST['url'];
            if($_POST['news_id'])
            	$data['news_id']=$_POST['news_id'];
             $data['carete_time']=time();
           //dump($_POST);exit;
           if(!$_POST['id'])
           {
             $data['position_id']=$_POST['position_id'];
             $res = D('PositionContent')->insert($data);
             if($res)
             	return show(1,'添加成功');
             else
             	return show(0,'添加失败');
         }
          else
          {
             $data['id']=$_POST['id'];
             $res = D('PositionContent')->save($data);
             if($res)
             	return show(1,'更新成功');
             else
             	return show(0,'更新失败');
          }
		}
		$positionIds = D('Position')->getPositions();
		$this->assign('positionIds',$positionIds);
		$this->display();
	}

public function setStatus()
	 {
    	$id=$_POST['id'];
    	$status=$_POST['status'];
    	//dump($id);exit;
    	if(!$id)
    		return show(0,'ID不存在');
    	try{
          $res = D('PositionContent')->setStatusById($id,$status);
          if($res)
          	return show(1,'更新成功');
          else
          	return show(0,'更新失败');
    	}catch(Execption $e)
    	{
    		return show(0,$e->getMessage());
    	}

    }

 public function edit()
 {
 	$id=$_GET['id'];
 	$data=array('id'=>$id);
 	$positionContent = D('PositionContent')->find($data);
    //dump($positionContent);exit;
 	$positionIds = D('Position')->getPositions();
 	
 	$this->assign('positionContent',$positionContent);
		$this->assign('positionIds',$positionIds);
 	$this->display();
 }
}