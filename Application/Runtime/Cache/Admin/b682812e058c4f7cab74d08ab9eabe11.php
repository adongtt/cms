<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/Public/css/sing/common.css" />
    <link rel="stylesheet" href="/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/bootstrap.min.js"></script>
    <script src="/Public/js/dialog/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>

<div id="wrapper">

    <?php
$menus = D('Menu')->getAdminMenu(); $index = 'index'; $loginUser = getLoginUsername(); $loginId = getLoginId(); ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo ($loginUser); ?><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/admin.php?c=admin&a=personal&id=<?php echo ($loginId); ?>"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="/admin.php?c=login&a=loginout"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li <?php echo (getActive($index)); ?>>
        <a href="/admin.php"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php echo (getActive($vo["c"])); ?>>
        <a href="/admin.php?m=<?php echo ($vo["m"]); ?>&c=<?php echo ($vo["c"]); ?>&a=<?php echo ($vo["f"]); ?>"><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($vo["name"]); ?></a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>

    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=admin">用户管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i><?php echo ($nav); ?>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        
        <div>
          <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3></h3>
                <div class="table-responsive">
                    <form id="singcms-listorder">
                    <table class="table table-bordered table-hover singcms-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>用户名</th>
                            <th>真实姓名</th>
                            <th>最后登录时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                                
                                <td><?php echo ($user["admin_id"]); ?></td>
                                <td><?php echo ($user["username"]); ?></td>
                                <td><?php echo ($user["realname"]); ?></td>
                                <td><?php echo (date('Y-m-d H:s:i',$user["lastlogintime"])); ?></td>
                                <td><?php echo (getMenuStatus($user["status"])); ?><span  attr-status="<?php echo (orStatus($user["status"])); ?>"  attr-id="<?php echo ($user["admin_id"]); ?>" class="sing_cursor singcms-on-off" id="singcms-on-off" ></span></td>
                                <td>    <a href="javascript:void(0)" attr-id="<?php echo ($user["admin_id"]); ?>" id="singcms-delete"  attr-a="admin" attr-message="删除"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                               
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>
                    </form>
                    
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>
    var SCOPE = {
        'add_url' : '/admin.php?c=admin&a=add',
        'edit_url' : '/admin.php?c=admin&a=edit',
        'set_status_url' : '/admin.php?c=admin&a=setStatus',
        'index_url' : '/',

    }
</script>

<script src="/Public/js/admin/common.js"></script>



</body>

</html>