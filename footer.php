			<footer class="footer" role="contentinfo">
			
				<div id="inner-footer" class="wrap clearfix">
					
					<nav role="navigation">
    					<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
	                </nav>
	                		
					<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">Monarch Modern theme</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://team2896damien.com" property="cc:attributionName" rel="cc:attributionURL">FRC Team 2896</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_US">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.<br />Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="http://themble.com/bones/" rel="dct:source">http://themble.com/bones/</a>.
<a href="http://info.flagcounter.com/<?php $track = get_option('theme_trackers');$color = get_option('theme_color');echo $track['flag'];?>"><img src="http://s<?php echo $track['server']?>.flagcounter.com/count/<?php echo $track['flag'];?>/bg_<?php echo $color['base'];?>/txt_<?php echo $color['link'];?>/border_FFFF00/columns_5/maxflags_12/viewers_0/labels_1/pageviews_1/flags_1/" alt="Flag Counter" border="0"></a>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html> <!-- end page. what a ride! -->