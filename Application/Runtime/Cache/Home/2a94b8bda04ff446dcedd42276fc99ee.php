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
              <div class="banner">
          <div class="banner-left">
          <div class="banner-info"><span>阅读数</span><i class="news_count node-<?php echo ($topNews[0]['news_id']); ?>" news-id="<?php echo ($topNews[0]['news_id']); ?>"></i></div>
            <a target="_blank" href="/index.php?c=detail&id=<?php echo ($topNews[0]['news_id']); ?>"><img src="<?php echo ($topNews[0]['thumb']); ?>" alt="<?php echo ($topNews[0]['title']); ?>"></a>
          </div>
          <div class="banner-right">
            <ul>
            <?php if(is_array($smallNews)): foreach($smallNews as $key=>$vo): ?><li>
             <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><img width="200" height="140" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"></a>
             </li><?php endforeach; endif; ?>
            </ul>
          </div>
        </div>
        <div class="news-list">
        <?php if(is_array($listNews)): $i = 0; $__LIST__ = $listNews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
            <dt><a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["title"]); ?></a></dt>
            <dd class="news-img">
              <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><img width="200" height="120" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"></a>
            </dd>
            <dd class="news-intro">
               <?php echo ($vo["small_title"]); ?>
            </dd>
            <dd class="news-info">
              <?php echo ($vo["username"]); ?> <span> <?php echo (date('Y-m-d H:i:s',$vo["create_time"])); ?></span> 阅读(<i class="news_count node-<?php echo ($vo["news_id"]); ?>" news-id="<?php echo ($vo["news_id"]); ?>"></i>)
            </dd>
          </dl><?php endforeach; endif; else: echo "" ;endif; ?>
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
<script src="/Public/js/jquery.js"></script>
<script src="/Public/js/count.js"></script>
<script
</body>
</html>