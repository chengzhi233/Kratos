<?php if (!defined('__TYPECHO_ROOT_DIR__'))
	exit; ?>
<!DOCTYPE HTML>
<html class="no-js">

<head>
	<meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>
		<?php $this->archiveTitle(array('category' => _t(' %s '), 'search' => _t(' %s '), 'tag' => _t(' %s '), 'author' => _t(' %s ')), '', ' - '); ?>
		<?php $this->options->title(); ?>
	</title>
	<meta name="keywords" content="<?php $this->keywords() ?>" />
	<?php $this->header('keywords=&generator=&template=&pingback=&xmlrpc=&wlw=&commentReply=&rss1=&rss2=&atom='); ?>
	<link rel="shortcut icon" href="/favicon.ico">
	<link href="https://cdn.bootcdn.net/ajax/libs/animate.css/3.5.1/animate.min.css" rel="stylesheet">
	<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.bootcdn.net/ajax/libs/superfish/1.7.4/superfish.min.css" rel="stylesheet">
	<link rel='stylesheet' id='kratos-style-css' href='<?php $this->options->themeUrl('css/style.css?ver=2.5.2'); ?>'
		type='text/css' media='all' />
	<link href="<?php $this->options->themeUrl('css/404.css'); ?>" type="text/css" rel="stylesheet">
	<?php if ($this->options->site_bw == 'able'): ?>
		<style type="text/css">
			html {
				filter: grayscale(100%);
				-webkit-filter: grayscale(100%);
				-moz-filter: grayscale(100%);
				-ms-filter: grayscale(100%);
				-o-filter: grayscale(100%);
				filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
				filter: gray;
				-webkit-filter: grayscale(1);
			}
		</style>
	<?php endif; ?>
</head>
<?php flush(); ?>

<body data-spy="scroll" data-target=".scrollspy">
	<div id="kratos-wrapper">
		<div id="kratos-page">
			<div id="kratos-header">
				<header id="kratos-header-section">
					<div class="container">
						<div class="nav-header">
							<nav id="kratos-menu-wrap" class="menu-container">
								<ul id="kratos-primary-menu" class="sf-menu">
									<li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
									<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
									<?php while ($pages->next()): ?>
										<li><a href="<?php $pages->permalink(); ?>">
												<?php $pages->title(); ?>
											</a></li>
									<?php endwhile; ?>
								</ul>
							</nav>
						</div>
					</div>
				</header>
			</div>
			<div class="kratos-start kratos-hero-2">
				<div class="kratos-overlay"></div>
				<div class="kratos-cover kratos-cover_2 text-center"
					style="background-image: url(<?php ($this->options->bannerimg) ? $this->options->bannerimg() : $this->options->themeUrl('images/head.png'); ?>);">
					<div class="desc desc2 animate-box">
						<h2>
							<?php $this->options->logoTxt(); ?>
						</h2><span>
							<?php $this->options->logoTxt2(); ?>
						</span>
					</div>
				</div>
			</div>
			<div id="kratos-blog-post" style="background:#f5f5f5">
				<div class="container">
					<div class="row">
						<section id="main" class='col-md-12'>
							<article>
								<div class="kratos-hentry kratos-post-inner clearfix">
									<div class="kratos-post-content">
										<div class="acs">
											<h1 align="center">
												<img alt="404 NOT FOUND"
													src="<?php $this->options->themeUrl('images/404.png'); ?>"
													title="404">
											</h1>
											<hr width="400">
											<p class="no">404 NOT FOUND</p>
											<p class="ASD">你寻找的网页似乎提桶跑路了</p>
										</div>
										<p class="text-center"><a class="btn btn-primary"
												href="javascript:history.back(-1)">返回上页</a>&nbsp<a
												class="btn btn-primary"
												href="<?php $this->options->siteUrl(); ?>">返回首页</a></p>
									</div>
								</div>
							</article>
					</div>
				</div>