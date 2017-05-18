<?php
namespace Admin\Controller;
use Think\Controller;
class ImageController extends Controller{

     private $uploadObj;
     public function ajaxuploadimage(){
         $res = D('UploadImage')->imageUpload();
         if($res===false)
         	return show(0,'上传失败');
         else
         	return show(1,'上传成功',$res);

     }

     public function kindupload()
     {
     	$res = D('UploadImage')->upload();
     	if($res===false)
     		return showKind(1,'上传失败');
     	return showKind(0,$res);

     }

}