<?php
/**
 * 文章管理
 */
namespace Admin\Controller;
use Think\Controller;
class ContentController extends CommonController{
    /*
    文章管理首页
     */
    public function index(){
    	$data=array();
      $positionid = '';
      if(isset($_REQUEST['catid']) && ($_REQUEST['catid']))
      {
        $data['catid'] = $_REQUEST['catid'];
      }
      if(isset($_REQUEST['title']) && ($_REQUEST['title']))
      {
        $data['title'] = $_REQUEST['title'];
      }
      if(isset($_REQUEST['positionid']) && ($_REQUEST['positionid']))
      {
        $positionid = $_REQUEST['positionid'];
      }
    	$page=$_REQUEST['p']?$_REQUEST['p']:1;
    	$pageSize=$_REQUEST['pageSize']?$_REQUEST['pageSize']:C('MENU_PAGE_SIZE');
    	$data['status']=array('neq',-1);
      
    	$news = D('News')->getNews($data,$page,$pageSize);
    	$newsCount = D('News')->getNewsCount($data);

    	  $res = new \Think\Page($newsCount,$pageSize);   //分页网页
        $pageRes = $res->show();
        
        $menuCat = D('Menu')->getCat();
        $copyFrom = C('COPY_FROM');

        $positions = D('Position')->getPositions();

        $this->assign('menuCat',$menuCat);
        $this->assign('copyFrom',$copyFrom);
        $this->assign('pageRes',$pageRes);
        $this->assign('catid',$data['catid']);
        $this->assign('title',$data['title']);
        $this->assign('positionid',$positionid);
        $this->assign('news',$news);
        $this->assign('positions',$positions);
        $this->display();
    }

    public function add(){
    	if($_POST)
    	{
           if(!isset($_POST['title']) || !$_POST['title'])
           	return show(0,'标题');
           if(!isset($_POST['small_title']) || !$_POST['small_title'])
           	return show(0,'短标题');
           if(!isset($_POST['content']) || !$_POST['content'])
           	return show(0,'内容');
           
           if($_POST['newsId'])
           {
           $news_id = D('News')->save($_POST,$_POST['newsId']);
           if(!$news_id)
            return show(0,'更新失败');
          else
          {
             $data['content'] = htmlentities($_POST['content']);
             $data['update_time'] = time();
             $res = D('NewsContent')->save($data,$_POST['newsId']);
             if(!$res)
              return show(0,'更新失败');
            else
              return show(1,'更新成功');
          }
           
         }
           else
           {
            $data=$_POST;
            $data['create_time']=time();
            $news_id = D('News')->insert($data);
            if(!$news_id)
              return show(0,'添加失败');
            else
            {
              $data = array(
                'news_id'=>$news_id,
                'content'=>htmlentities($_POST['content']),
                'create_time'=>time());
              $news_id = D('NewsContent')->insert($data);
              return show(1,'添加成功');
            }
         }

    	}
    	else
      {
        $menuCat = D('Menu')->getCat();
        $fontColor = C('TITLE_FONT_COLOR');
        $copyFrom = C('COPY_FROM');
        $this->assign('menuCat',$menuCat);
        $this->assign('fontColor',$fontColor);
        $this->assign('copyFrom',$copyFrom);
    	  $this->display();
    }
    }

    public function edit(){
     if(!isset($_GET['id']) || !$_GET['id'])
        return show(0,'id不合法');
      $data['news_id'] = $_GET['id'];
      $res = D('News')->getNewById($data);
      //dump($res.news_id);exit;
      if(!$res)
        return show(0,'没有此文章');
      else
      {
      $newsContent = D('NewsContent')->getNewsContentById($data);

      $res['content'] = htmlspecialchars_decode($newsContent['content']);
      $menuCat = D('Menu')->getCat();
      $fontColor = C('TITLE_FONT_COLOR');
      $copyFrom = C('COPY_FROM');
      $this->assign('menuCat',$menuCat);
      $this->assign('fontColor',$fontColor);
      $this->assign('copyFrom',$copyFrom);
      $this->assign('news',$res);
      $this->display();
      }
      
    }

    /*
更新菜单状态
 */
    public function setStatus()
    {
      if($_POST)
      {
      $id=$_POST['id'];
      $status=$_POST['status'];
      if(!$id)
        return show(0,'ID不存在');
      try{
          $res = D('News')->setStatusById($id,$status);
          if($res)
            return show(1,'更新成功');
          else
            return show(0,'更新失败');
      }catch(Execption $e)
      {
        return show(0,$e->getMessage());
      }

    }
    else
      return show(0,'没有提交的内容');
  }

   public function listorder()
   {
      $listorder = $_POST['listorder'];
      $jumpUrl = $_SERVER['HTTP_REFERER'];
      return commonListorder('News',$listorder,$jumpUrl);
   }

   public function push()
   {
            $positionid = intval($_POST['positionid']);
            $newsIds = $_POST['push'];
            if(!$positionid)
              return show(0,'没有选择推荐位');
            if(!$newsIds || !is_array($newsIds))
              return show(0,'没有选择推荐的内容');
            
            $news = D('News')->getNewsByIdIn($newsIds);
            if(!news)
              return show(0,'找不到文章');
            else
            {
              foreach ($news as $new) {
                 $data = array(
                 'position_id' => $positionid,
                 'title' => $new['title'],
                 'thumb' => $new['thumb'],
                 'news_id' => $new['news_id'],
                 'create_time' => $new['create_time']
                  );
                 //dump($data);exit;
                 $id = D('PositionContent')->insert($data);
                 if(!$id)
                  return show(0,'推荐失败');
              }
                return show(1,'推荐成功'); 
            }
      }

}