<?php

 if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
	<div class="container">
		<div class="row">
			<?php if ($this->options->sidebarlr == 'left_side'): ?>
			<aside id="kratos-widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
                <div id="sidebar">
                    <?php $this->need('sidebar.php'); ?>
                </div>
            </aside>
			<?php endif; ?>
            <section id="main" class='<?php echo ($this->options->sidebarlr ==  'single') ? 'col-md-12' : 'col-md-8'; ?>'>
				<article>
					<div class="kratos-hentry kratos-post-inner clearfix">
						<header class="kratos-entry-header">
							<h1 class="kratos-entry-title text-center"><?php $this->title(); ?></h1>
						</header>
						<div class="kratos-post-content">
                        <?php parseContent($this); ?>
						</div>
					</div>
					
					<!--不知道这个干啥的，本来就是注释的-->
					<?php //$this->need('comments.php'); ?>
				</article>
			</section>
			<?php if ($this->options->sidebarlr == 'right_side'): ?>
				<aside id="kratos-widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
	                <div id="sidebar">
	                    <?php $this->need('sidebar.php'); ?>
	                </div>
	            </aside>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $this->need('footer.php'); ?>
