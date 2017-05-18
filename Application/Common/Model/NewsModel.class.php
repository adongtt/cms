<?php
namespace Common\Model;
use Think\Model;

class NewsModel extends Model{
    private $_db;
    public function __construct(){
        $this->_db = M('news');
    }

    /*
    获取文章分页
    */
    public function getNews($data,$page,$pageSize){
      if($data['title'])
        $data['title'] = array('like','%'.$data['title'].'%');
      $data['status'] = array('neq',-1);
      $offset = ($page-1)*$pageSize;
      return $this->_db->limit($offset,$pageSize)->order('listorder desc,news_id desc')->where($data)->select();
    }
    public function getNewsCount($data=array()){
      if($data['title'])
        $data['title'] = array('like','%'.$data['title'].'%');
      $data['status'] = array('neq',-1);
      return  $this->_db->where($data)->count();
    }

    /*
    插入文章
     */
    public function insert($data=array())
    {
      $data['create_time']=time();
      $data['username']=getLoginUsername();
      return $this->_db->add($data);
    }
    /*
    更新文章
     */
    public function save($data=array(),$id)
    {
      $data['update_time']=time();
      $data['username']=getLoginUsername();
      return $this->_db->where('news_id='.$id)->save($data);
    }
    /*
    更改文章状态
     */
    public function setStatusById($id,$status)
    {
      if(!isset($id) || !is_numeric($id)){
      throw_exception("ID不合法");
    }
    $data['status'] = $status;
    $data['update_time'] = time();
    return $this->_db->where('news_id='.$id)->save($data);
    }
/*
通过id获取文章内容
 */
    public function getNewById($id)
    {
      return $this->_db->where($id)->find();
    }
 /*
 文章排序
  */
  public function setListOrderById($id,$listOrder)
  {
    $data['listorder']=$listOrder;
    return $this->_db->where('news_id='.$id)->save($data);
  } 
  
  public function getNewsByIdIn($newsIds)
  {
    //dump(explode(',',$newsIds));
      $where = array(
        'news_id' => array('in',$newsIds),
              );

      //dump($where);
      return $this->_db->where($where)->select();
  }

  public function select($data=array(),$limit=0)
  {
    if($limit==0)
      return $this->_db->where($data)->select();
    return $this->_db->limit($limit)->where($data)->select();
  }

  public function getRank()
  {
    $data=array(
      'status'=>array('eq',1),
      );
      return $this->_db->limit(10)->order('count desc,news_id desc')->where($data)->select();
  }

  public function find($id)
  {
    return $this->_db->where('news_id='.$id)->find();
  }

  public function updateCountById($id,$count)
  {

    $this->_db->where('news_id='.$id)->save($count);
  }

  public function countNews($data)
  {
    return $this->_db->where($data)->count();
  }

  public function getCountMax()
  {
    return $this->_db->limit(1)->order('count desc')->find();
  }
}