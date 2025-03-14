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
		<footer id="footer" class="text-left">
			<div class="row">
				<div class="col-sm-12 col-lg-8 col-lg-offset-2">
					<div class="row">
						<div class="col-sm-4">
							<div class="logo"><a href="https://www.squamish.net/"><?php print caGetThemeGraphic($this->request, 'SN-Logo-white.png', array("alt" => $this->request->config->get("app_display_name"))); ?></a></div>
						</div>
						<div class="col-sm-4">
							<div class="orgLink">Sxwimála-aw̓txw<br/>(Archives & Cultural Collections)</div>
							Located at the Main Office at<br/>
							320 Seymour Blvd<br/>
							North Vancouver, BC, V7L 4J5<br/>
							604-980-4553
						</div>
						<div class="col-sm-4">
							<ul class="list-inline social">
								<li><a href="https://www.facebook.com/SquamishNation" target="_blank"><i class="fa fa-facebook" role="graphics-document" aria-label="Facebook"></i></a></li>
								<li><a href="https://www.instagram.com/squamishnation/" target="_blank"><i class="fa fa-instagram" role="graphics-document" aria-label="Instagram"></i></a></li>
								<li><a href="https://twitter.com/SquamishNation" target="_blank"><i class="fa fa-twitter" role="graphics-document" aria-label="Twitter"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="copyright">&copy; Sḵwx̱wú7mesh Úxwumixw 2023</div>
						</div>
					</div>
			</div>
			</div>
		</footer><!-- end footer -->
<?php
# --- display lightbox alert
if($this->request->getParameter("accept_terms", pInteger)){
	Session::setVar('visited_time', time());
}
if((!Session::getVar('visited_time') || (Session::getVar('visited_time') < (time() - 86400)))){
	
?>
	<div class="disclaimerAlert">
		<div class="disclaimerAlertBox">
			<div class="disclaimerAlertMessage"><H1>Appropriate Use</H1>{{{disclaimer_alert_message}}}<div class="enterButton"><?php print caNavLink($this->request, _t("Accept and Enter"), 'btn btn-default', '', '*', '*', array('accept_terms' => 1)); ?></div></div>
			
		</div>
	</div>
<?php
}
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
	</body>
</html>
