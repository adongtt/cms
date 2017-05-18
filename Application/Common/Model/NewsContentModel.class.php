<?php
namespace Common\Model;
use Think\Model;

class NewsContentModel extends Model{
    private $_db;
    public function __construct(){
        $this->_db = M('news_content');
    }

  public function getNewsContentById($id)
  {
  	return $this->_db->field('news_id,content')->where($id)->find();
  }

  public function save($data=array(),$id)
    {
      return $this->_db->where('news_id='.$id)->save($data);
    }

  public function insert($data)
  {
     return $this->_db->add($data);
  }

}