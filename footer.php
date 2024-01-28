<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
?>
<script type="text/javascript">
    function times() {
        var time = new Date();
        var HH = time.getHours();
        HH = HH < 10 ? "0" + HH : HH;
        var MM = time.getMinutes();
        MM = MM < 10 ? "0" + MM : MM;
        var SS = time.getSeconds();
        SS = SS < 10 ? "0" + SS : SS;
        document.getElementById("mytime").innerHTML = "[现在是" + HH + ":" + MM + ":" + SS + "( つ•̀ω•́)つ]"
    }
    var mytimes = setInterval("times()", 1000);
</script>
<!--footer-->
<footer>
    <div id="footer">
        <div class="cd-tool visible-lg text-center">
            <a class="cd-top cd-is-visible cd-fade-out"><span class="fa fa-chevron-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 footer-list text-center">
                    <div>
                        <?php echo $this->options->actionbar(); ?>
                        <div />
                        <div id="mytime">不要停下来啊</div>
                        <div>Theme by <a href="https://github.com/chengzhi233/Kratos">Kratos-C</a>&nbsp;Powered by <a
                                href="http://typecho.org/">Typecho</a></div>
                    </div>
                </div>
            </div>
        </div>
</footer>

<script src="https://cdn.bootcdn.net/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type='text/javascript' src='<?php $this->options->themeUrl('js/jquery.waypoints.min.js'); ?>'></script>
<script type='text/javascript' src='<?php $this->options->themeUrl('js/jquery.stellar.min.js'); ?>'></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.hoverintent/1.8.1/jquery.hoverIntent.min.js"></script>
<script type='text/javascript' src='<?php $this->options->themeUrl('js/superfish.min.js'); ?>'></script>
<script type='text/javascript' src='<?php $this->options->themeUrl('js/kratos.js?ver=2.5.2'); ?>'></script>
<?php if (!$this->options->sidebarlr == 'single'): ?>
    <script type="text/javascript">
        if ($("#main").height() > $("#sidebar").height()) {
            var footerHeight = 0;
            if ($('#page-footer').length > 0) {
                footerHeight = $('#page-footer').outerHeight(true);
            }

            $('#sidebar').affix({
                offset: {
                    top: $('#sidebar').offset().top - 30,
                    bottom: $('#footer').outerHeight(true) + footerHeight + 6
                }
            });
        }
    </script>
<?php endif; ?>
</body>

</html>