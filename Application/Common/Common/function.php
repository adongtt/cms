		<?php
		/*
		公用的方法
		*/

		/**
		 * json格式返回数据
		 * 
		 **/
		function show($status,$message,$data=array())
		{
		    $result = array(
		        'status'=>$status,
		        'message'=>$message,
		        'data'=>$data);
		    exit(json_encode($result));
		}
		/*
		密码加密
		 */
		function getMd5ByPassword($password)
		{
		   return md5($password.C('MD5_PRE'));
		}

		function getMenuType($type)
		{
			return $type?'后台菜单':'前端导航';
		}
		/*
				获取菜单状态
		 */
		function getMenuStatus($status)
		{

		 if($status==1)
		 	return '正常';
		 else if($status==0)
		 	return '关闭';
		 else
		 	return '删除';
		}
		/*
		是否有封面图
		 */
		function isThumb($thumb){
		if($thumb)
			return '<span style="color:red">有</span>';
		else
			return '<span>无</span>';
		}

		/*
		kindeditor插件返回函数
		 */
		function showKind($status,$data)
		{
			header('Content-type:application/json;charset=UTF-8');
			if($status==0){
				exit(json_encode(array('error'=>0,'url'=>$data)));
			}
			exit(json_encode(array('error'=>1,'message'=>"上传失败")));
		}
		/*
		获取登录用户名
		 */
		function getLoginUsername()
		{
			return $_SESSION['adminUser']['username']?$_SESSION['adminUser']['username']:'';
		}

		/*
		获取登录用户id
		 */
		function getLoginId()
		{
			return $_SESSION['adminUser']['admin_id']?$_SESSION['adminUser']['admin_id']:'';
		}
		/*
		通过munuid获取menu名（栏目)
		 */
		function getCatname($menuCat,$menuId){
			$str = $menuId;
			foreach($menuCat as $cat){
		          if($cat['menu_id'] == $menuId)
		          	$str = $cat['name'];
			}
			return $str;
		}
		/*
		获取来源网站名称
		 */
		function getCopyFrom($copyForm,$formId){
			return $copyForm[$formId];

		}

		function getActive($navc)
		{
		    $c=strtolower(CONTROLLER_NAME); //获取当前活动的控制器名称
		    if(strtolower($navc) == $c)
		    	return 'class=active';
		    else
		    	return '';
		}

		/*
		公共的排序函数
		参数 模型名
		 */
		function commonListorder($model,$listorder,$jumpUrl){
		      $errors = array();
		      //dump($listorder);exit;
		      try
		      {
		      if($listorder){

		        foreach($listorder as $id =>$v)
		        {
		          $res = D($model)->setListOrderById($id,$v);
		          if(!$res)
		          {
		            $errors[]=$id;
		          }
		        }
		        if(empty($errors))
		        {
		        return show(0,'排序失败-'.explode(',',$errors),$jumpUrl);
		        }
		        return show(1,'排序成功',$jumpUrl);
		      }
		      else
		        return show(0,'排序失败',$jumpUrl);
		    }catch(Exceptin $e){
		 return show(0,$e->getMessage(),$jumpUrl);
		}
		}
		function orStatus($status)
		{
			return $status?0:1;
		}