<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<?php
$config = F('WEB_CONFIG'); $cats = D('Menu')->getCat(); ?>

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
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-9">
        <div class="news-detail">
        <h1><?php echo ($news["title"]); ?></h1>
        <?php echo ($news["content"]); ?>
        </div>
      </div>
      <div class="col-sm-3 col-md-3">
        <div class="right-title">
          <h3>文章排行</h3>
          <span>TOP ARTICLES</span>
        </div>
        <div class="right-content">
          <ul>
          <?php if(is_array($rankNews)): $k = 0; $__LIST__ = $rankNews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
              <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["small_title"]); ?></a>
              <?php if($k == 1): ?><div class="intro">
                <?php echo ($vo["description"]); ?>
              </div><?php endif; ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
        <?php if(is_array($advNews)): $i = 0; $__LIST__ = $advNews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$advNew): $mod = ($i % 2 );++$i;?><div class="right-hot">
          <a target="_blank" href="<?php echo ($advNew["url"]); ?>"><img src="<?php echo ($advNew["thumb"]); ?>" alt="<?php echo ($advNew["title"]); ?>"></a>
          <?php echo ($advNew["title"]); ?>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>
  </div>
</section>
</body>
</html>