<?php $track = get_option('theme_trackers');
$color = get_option('theme_color');?>
<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		 <title><?php wp_title("",true); ?></title>
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
				
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
				<div id="header">
					<img src="<?php header_image(); ?>" alt="Robotics Header"/>
					<a href="<?php echo home_url();?>">
						<img src="/wp-content/themes/Robotics/library/images/banner.png" alt="Team Logo" id="logo"/>
					</a>
				</div>
		<!-- end of wordpress head -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
		<!-- drop Google Analytics Here -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $track['tracking']?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
$(function(){

	var menu = $('#navbar'),
		pos = menu.offset();

		$(window).scroll(function(){
                if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('anchor')){
                    menu.fadeOut('fast', function(){
                        $(this).removeClass('anchor').addClass('float').fadeIn('fast');
                    });
                } else if($(this).scrollTop() <= pos.top && menu.hasClass('float')){
                    menu.fadeOut('fast', function(){
                        $(this).removeClass('float').addClass('anchor').fadeIn('fast');
                    });
                }
            });

});
</script>
		
		<div id="container">
			
			<header class="header" role="banner">
			
				<div id="inner-header" class="wrap clearfix">
					<!-- Inner header might as well be called nav...-->
					<nav role="navigation" class="anchor" id="navbar">
						<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->