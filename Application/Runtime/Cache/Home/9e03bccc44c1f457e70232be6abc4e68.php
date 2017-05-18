<?php if (!defined('THINK_PATH')) exit(); $config = F('WEB_CONFIG'); $cats = D('Menu')->getCat(); ?>

<head>
  <meta charset="UTF-8">
  <title><?php echo ($config["title"]); ?></title>
  <meta name="keywords" contents="<?php echo ($config["keywords"]); ?>" />
  <meta name="description" contents="<?php echo ($config["description"]); ?>" />
  <link rel="stylesheet" href="/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/Public/css/home/main.css" type="text/css" />
</head>
<body>
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="/">
          <img src="/Public/images/logo.png" alt="">
        </a>
      </div>
      <input type="hidden" name="cat_id" value="<?php echo ($cat_id); ?>"/>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="/" <?php if(0 == $cat_id): ?>class="curr"<?php endif; ?>>首页</a></li>
        <?php if(is_array($cats)): foreach($cats as $key=>$cat): ?><li><a href="/index.php?c=cat&id=<?php echo ($cat["menu_id"]); ?>" <?php if($cat['menu_id'] == $cat_id): ?>class="curr"<?php endif; ?>><?php echo ($cat["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
<section>
<div class="container" style="...">
<h1 style="color:red;"><?php echo ($message); ?></h1>
<h3 id="location" style="...">系统将在<span style="...">3</span>秒后系统自动跳转</h3>
</div>
</section>
</body>
<script src="/Public/js/jquery.js"></script>
<script>
	var url="/";
	var time=3;
	setInterval('refer()',1000);
	function refer(){
		if(time==0)
		{
			location.href=url;
            
		}
		$("#location span").html(time);
		time--;
	}
</script>
</html>