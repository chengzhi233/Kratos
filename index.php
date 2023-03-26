<?php
/**
 * 基于依米花移值WordPress的Kratos模板修改
 * 
 * @package Kratos模板Typecho版
 * @author 橙汁汁
 * @version Bata 1.0
 * @link https://www.chengzhi233.cn/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');?>
	<div class="container">
		<div class="row">
			<section id="main" class="col-md-8">
			<?php if($this->have()):?>
			<?php while($this->next()): ?>
			<article class="kratos-hentry clearfix">
				<div class="kratos-entry-border-new clearfix">
				    
				    
				    <!--加图模式开始-->
<?php
preg_match_all("/\<img.*?src\=(\'|\")(.*?)(\'|\")[^>]*>/i", $this->content, $matches);
$imgCount = count($matches[0]);
if($this->fields->thumb !=""){
    $img = $this->fields->thumb;
    $html = "<div class='kratos-entry-thumb-new'>
	<a href='$this->permalink'>
	<img src= '$img'/>
	</a>
	</div>";
	echo($html);
}
elseif ($imgCount >= 1) {
   $img = $matches[2][0];
   $html = "<div class='kratos-entry-thumb-new'>
	<a href='$this->permalink'>
	<img src= '$img' />
	</a>
	</div>";
	echo($html);
}else{
}
?>


<!--加图模式结束-->
								 
					<div class="kratos-post-inner-new">
						<header class="kratos-entry-header-new">
							<a class="label"><?php $this->category(',',false); ?><i class="label-arrow"></i></a>
							<h2 class="kratos-entry-title-new"><a href="<?php $this->permalink(); ?>"><?php $this->sticky(); $this->title(); ?></a></h2>
						</header>
						<div class="kratos-entry-content-new">
							<p><?php 
							preg_match_all("/\<img.*?src\=(\'|\")(.*?)(\'|\")[^>]*>/i", $this->content, $matches);
							if(count($matches[0])>= 1)
								$this->excerpt(120, '...'); 
							else
								$this->excerpt(200, '...'); 
								?></p>
						</div>
					</div>
					<div class="kratos-post-meta-new">
					<span class="visible-lg visible-md visible-sm pull-left">
					<a href="#"><i class="fa fa-calendar"></i> <?php $this->date('Y/m/d'); ?></a>
					<a href="<?php $this->permalink(); ?>#respond"><i class="fa fa-commenting-o"></i> <?php $this->commentsNum('0', '1', '%d'); ?> 条评论</a>
					</span>
					<span class="pull-left">
					<a href="<?php $this->permalink(); ?>"><i class="fa fa-eye"></i> <?php get_post_view($this); ?> 次阅读</a>
					</span>
					<span class="pull-right">
					<a class="read-more" href="<?php $this->permalink(); ?>">阅读全文 <i class="fa fa-chevron-circle-right"></i></a>
					</span>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
		<?php else: ?>
		<div class="kratos-hentry clearfix">
			<h1 class="kratos-post-header-title">暂无文章</h1>
		</div>
		<?php endif; ?>

		<div class="text-center" id="page-footer">
        		<?php $this->pageNav('<', '>', 3, '', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => '', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
				</div>
			</section>
			<aside id="kratos-widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
                <div id="sidebar">
                    <?php $this->need('sidebar.php'); ?>
                </div>
            </aside>
		</div>
	</div>
</div>
<?php $this->need('footer.php'); ?>
