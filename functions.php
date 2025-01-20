<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

/* 后台设置 */
function themeConfig($form)
{
    //header部分
    $logoTxt = new Typecho_Widget_Helper_Form_Element_Text('logoTxt', NULL, NULL, _t('首页字1'), _t('不写不加载'));
    $logoTxt2 = new Typecho_Widget_Helper_Form_Element_Text('logoTxt2', NULL, NULL, _t('首页字2'), _t('不写不加载'));
    $form->addInput($logoTxt);
    $form->addInput($logoTxt2);

    $bannerimg = new Typecho_Widget_Helper_Form_Element_Text('bannerimg', NULL, NULL, _t('首页图片'), _t('图片链接，不写会加载默认图'));
    $form->addInput($bannerimg);

    $site_bw = new Typecho_Widget_Helper_Form_Element_Radio(
        'site_bw',
        array('able' => _t('开启'), 'disable' => _t('关闭')),
        'disable',
        _t("黑白模式"),
        _t("开启后呈现为黑白模式")
    );
    $form->addInput($site_bw);


    //侧边栏
    $sidebarlr = new Typecho_Widget_Helper_Form_Element_Radio(
        'sidebarlr',
        array(
            'left_side' => _t('左边栏'),
            'right_side' => _t('右边栏'),
            'single' => _t('无边栏'),
        ),
        'right_side',
        _t('非首页侧边栏设置'),
        _t('默认右边栏')
    );


    $form->addInput($sidebarlr);

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'sidebarBlock',
        array(
            'ShowAuthor' => _t('作者简介'),
            'ShowSearch' => _t('搜索框'),
            'ShowRecent' => _t('最新文章'),
            'ShowCategory' => _t('分类目录')
        ),
        array('ShowAuthor', 'ShowSearch', 'ShowRecent', 'ShowCategory'),
        _t('侧边栏显示')
    );
    $form->addInput($sidebarBlock->multiMode());

    $authordesc = new Typecho_Widget_Helper_Form_Element_Text('authordesc', null, NULL, _t('作者简介'), _t('侧边栏的作者简介'));
    $form->addInput($authordesc);

    $about = new Typecho_Widget_Helper_Form_Element_Text('about', null, NULL, _t('作者简介背景'), _t('侧边栏的作者简介背景图片，不写会加载默认图'));
    $form->addInput($about);

    $author = new Typecho_Widget_Helper_Form_Element_Text('author', null, NULL, _t('作者简介头像'), _t('侧边栏的作者简介头像，不写会加载默认图'));
    $form->addInput($author);

    $ad_sidebar = new Typecho_Widget_Helper_Form_Element_Text('ad_sidebar', NULL, NULL, _t('侧边栏广告'), _t('自定义广告代码，支持html'));
    $form->addInput($ad_sidebar);

    $actionbar = new Typecho_Widget_Helper_Form_Element_Text('actionbar', NULL, NULL, _t('底部文字'), _t('自定义底部文字，可用于放置备案号或者奇奇怪怪的东西'));
    $form->addInput($actionbar);

}



/**
 * 解析内容以实现附件加速
 * @access public
 * @param string $content 文章正文
 * @param Widget_Abstract_Contents $obj
 */
function parseContent($obj)
{
    $options = Typecho_Widget::widget('Widget_Options');
    if (!empty($options->src_add) && !empty($options->cdn_add)) {
        $obj->content = str_ireplace($options->src_add, $options->cdn_add, $obj->content);
    }
    echo trim($obj->content);
}


/*文章阅读次数统计*/
function get_post_view($archive)
{
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie

        }
    }
    echo $row['views'];
}


/*Typecho 24小时发布文章数量*/
function get_recent_posts_number($days = 1, $display = true)
{
    $db = Typecho_Db::get();
    $today = time() + 3600 * 8;
    $daysago = $today - ($days * 24 * 60 * 60);
    $total_posts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))
        ->from('table.contents')
        ->orWhere('created < ? AND created > ?', $today, $daysago)
        ->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish'))->num;
    if ($display) {
        echo $total_posts;
    } else {
        return $total_posts;
    }
}

//随机文章
function theme_random_posts()
{
    $defaults = array(
        'number' => 6,
        'before' => '',
        'after' => '',
        'xformat' => '<a class="list-group-item visible-lg" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a> 
	<a class="list-group-item visible-md" title="{title}" href="{permalink}" rel="bookmark"><i class="fa  fa-book"></i> {title}</a>'
    );
    $db = Typecho_Db::get();

    $sql = $db->select()->from('table.contents')
        ->where('status = ?', 'publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
        ->limit($defaults['number'])
        ->order('RAND()');

    $result = $db->fetchAll($sql);
    echo $defaults['before'];
    foreach ($result as $val) {
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
        echo str_replace(array('{permalink}', '{title}'), array($val['permalink'], $val['title']), $defaults['xformat']);
    }
    echo $defaults['after'];
}
// 自定义关键字
function themeFields($layout)
{
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图地址，填写Null不显示任何图片(仅文章有效)'));
    $layout->addItem($thumb);
    $abstract = new Typecho_Widget_Helper_Form_Element_Textarea('abstract', NULL, NULL, _t('自定义摘要'), _t('输入自定义摘要，不填写自动以文章作为摘要(仅文章有效)'));
    $layout->addItem($abstract);
}

function email_avatar($email)
{
    if ($email) {
        if (strpos($email, "@qq.com") !== false) {
            $email = str_replace('@qq.com', '', $email);
            echo "//q1.qlogo.cn/g?b=qq&nk=" . $email . "&s=640";
        } else {
            echo $this->options->themeUrl('image/avatar.jpg');
        }
    } else {
        echo $this->options->themeUrl('image/avatar.jpg');
    }
}