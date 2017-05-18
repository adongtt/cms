<?php
namespace Common\Model;
use Think\Model;

class PositionModel extends Model{
    private $_db;
    public function __construct(){
        $this->_db = M('position');
    }


    public function getPositions()
    {
    	$wehre = array(
    		'status' => array('neq',-1),
    	);
    	return $this->_db->where($wehre)->select();
    }


}