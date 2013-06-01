    </div><!-- body-content-->
    </div> <!-- /container -->
  </div><!-- wrapper -->
    <div id="footer">
      <div class="container">
        <div class="row">
          <div class="span6">
            <div class="fb-like-box" data-href="http://www.facebook.com/good2u.tw" data-width="460" data-height="190" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-border-color="#333333" data-header="false"></div>
          </div>
          <div class="span6" id="foot-container">
            <ul class="foot-nav">
              <li><a href="mailto:socool@iii.org.tw">與我們聯絡</a></li>
              <li><a href="<?=base_url()?>">Good2u首頁</a></li>
              <li><?=anchor('page/term','隱私權政策')?></li>
            </ul>    
            <p>Copyright &copy;  2012-2013
              資策會 數位教育研究所
              All Rights Reserved
              </p>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<!-- facebook plug-in -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=383459391711296";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
// (function(d, s, id) {
//   var js, fjs = d.getElementsByTagName(s)[0];
//   if (d.getElementById(id)) return;
//   js = d.createElement(s); js.id = id;
//   js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=135636719906371";
//   fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));
//   FB.init({
//     appId  : '135636719906371',
//     frictionlessRequests: true,
//   });
//   function sendRequestViaMultiFriendSelector() {
//     FB.ui({method: 'apprequests',
//       message: '這裡有很多好課程，快來Good2u看看！'
//     }, requestCallback);
//   }
</script>
<!-- google analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32474210-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!--bootstrap JS-->
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-button.js"></script>
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js"></script>
<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tab.js"></script>
<!-- fancy-box -->
<script type="text/javascript" src="<?=base_url()?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<!-- jquery validation -->
<script src="<?=base_url()?>js/jquery.validate.js"></script>
<!-- nailthubms -->
<link href="<?=base_url()?>js/nailthumbs/jquery.nailthumb.1.1.css" rel="stylesheet" type="text/css">
<script src="<?=base_url()?>js/nailthumbs/jquery.nailthumb.1.1.js" type="text/javascript" charset="utf-8"></script>	