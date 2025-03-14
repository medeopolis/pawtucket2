<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageFooter.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015-2018 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
?>
		<div style="clear:both; height:1px;"><!-- empty --></div>
		</div><!-- end pageArea --></div><!-- end main --></div><!-- end col --></div><!-- end row --></div><!-- end container -->
		<footer id="footer" class="text-center">
			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						<div class="row logos-row">
							<a href="https://library.arlingtonva.us/" class="navbar-brand">
								<img src="/themes/arlington/assets/pawtucket/graphics/apl_logo.png" alt="Arlington TEST System">
							</a>
							<div class="col" style="margin-left: 45px;">
								<a href="/index.php">
									<H1 style="text-align: left;">The Charlie Clark <br> Center for Local History </H1>
									<span style="color: #000; font-size: 16px;">Arlington Community Digital Collections</span>
								</a>
							</div>
						</div>
						<div class="footer-text">
							Online content in the Center for Local History's Community Archives may be printed or downloaded by individuals, school, or libraries for personal use, study, research, or classroom teaching under certain conditions of use. Unauthorized use of images is prohibited.
						</div>
					</p>
					<!-- <ul class="list-inline social">
						<li><a href="https://www.facebook.com/ArlingtonVAPublicLibrary" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="https://www.instagram.com/arlingtonvalib/" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<li><a href="https://twitter.com/ArlingtonVALib" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
					</ul> -->
					<ul class="list-inline">
						<li><a href="http://library.arlingtonva.us/center-for-local-history/">Center for Local History Home</a></li>
						<li><a href="http://library.arlingtonva.us/collections/local-history/arlingtons-story/arlingtons-story-conditions-of-use/">Conditions of Use</a></li>
						<li><a href="http://library.arlingtonva.us/collections/local-history/historical-scans-and-prints/">Order Scans and Prints</a></li>
						<li><a href="http://library.arlingtonva.us/center-for-local-history/arlington-community-archives/request-archival-material/">Request Research Use of Archival Material</a></li>
					</ul>
				</div>
			</div>
		</footer><!-- end footer -->
<?php
	//
	// Output HTML for debug bar
	//
	if(Debug::isEnabled()) {
		print Debug::$bar->getJavascriptRenderer()->render();
	}
?>
	
		<?php print TooltipManager::getLoadHTML(); ?>
		<div id="caMediaPanel" role="complementary"> 
			<div id="caMediaPanelContentArea">
			
			</div>
		</div>
		<script type="text/javascript">
			/*
				Set up the "caMediaPanel" panel that will be triggered by links in object detail
				Note that the actual <div>'s implementing the panel are located here in views/pageFormat/pageFooter.php
			*/
			var caMediaPanel;
			jQuery(document).ready(function() {
				if (caUI.initPanel) {
					caMediaPanel = caUI.initPanel({ 
						panelID: 'caMediaPanel',										/* DOM ID of the <div> enclosing the panel */
						panelContentID: 'caMediaPanelContentArea',		/* DOM ID of the content area <div> in the panel */
						onCloseCallback: function(data) {
							if(data && data.url) {
								window.location = data.url;
							}
						},
						exposeBackgroundColor: '#000000',						/* color (in hex notation) of background masking out page content; include the leading '#' in the color spec */
						exposeBackgroundOpacity: 0.5,							/* opacity of background color masking out page content; 1.0 is opaque */
						panelTransitionSpeed: 400, 									/* time it takes the panel to fade in/out in milliseconds */
						allowMobileSafariZooming: true,
						mobileSafariViewportTagID: '_msafari_viewport',
						closeButtonSelector: '.close'					/* anything with the CSS classname "close" will trigger the panel to close */
					});
				}
			});
			/*(function(e,d,b){var a=0;var f=null;var c={x:0,y:0};e("[data-toggle]").closest("li").on("mouseenter",function(g){if(f){f.removeClass("open")}d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mousemove",function(g){if(Math.abs(c.x-g.ScreenX)>4||Math.abs(c.y-g.ScreenY)>4){c.x=g.ScreenX;c.y=g.ScreenY;return}if(f.hasClass("open")){return}d.clearTimeout(a);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mouseleave",function(g){d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.removeClass("open")},b)})})(jQuery,window,200);*/
		
//			$(document).ready(function() {
//				$(document).bind("contextmenu",function(e){
//				   return false;
//				 });
//			}); 
		</script>
<?php
	print $this->render("Cookies/banner_html.php");	
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-10610764-32"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){window.dataLayer.push(arguments);}
	gtag('js', new Date());

	// CLH Library Archives UA property ID
	gtag('config', 'UA-10610764-32');
	// CLH Library Archives GA4 property ID
	gtag('config', 'G-G66K0NMWQY');
	// cross-domain UA property ID
	gtag('config', 'UA-10610764-25', {
		'linker': {
			'domains': ['library.arlingtonva.us', 'libcat.arlingtonva.us', 'libsys.arlingtonva.us', 'library.arlingtonva.libguides.com', 'arlingtonva.libcal.com', 'libraryarchives.arlingtonva.us', 'projectdaps.org', 'arlingtonwomenshistory.org']
		}
	});
	// cross-domain GA4 property ID
	gtag('config', 'G-Z2ECWWH16V', {
		'linker': {
			'domains': ['library.arlingtonva.us', 'libcat.arlingtonva.us', 'libsys.arlingtonva.us', 'library.arlingtonva.libguides.com', 'arlingtonva.libcal.com', 'libraryarchives.arlingtonva.us', 'projectdaps.org', 'arlingtonwomenshistory.org']
		}
	});
</script>
	</body>
</html>
