<?php
/* ----------------------------------------------------------------------
 * views/Browse/list_facet_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014-2015 Whirl-i-Gig
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
 
	# -----------------------------------------------------------
	# --- facet view for group_mode = alphabetical, none
	# -----------------------------------------------------------

	$va_facet_content = 	$this->getVar('facet_content');
	$vs_facet_name = 		$this->getVar('facet_name');
	$vs_view = 				$this->getVar('view');
	$vs_key = 				$this->getVar('key');
	$va_facet_info = 		$this->getVar("facet_info");
	$vb_is_nav = 			(bool)$this->getVar('isNav');
	$vn_start =				$this->getVar('start');
	$vn_items_per_page =	$this->getVar('limit');
	$vn_facet_size =		$this->getVar('facet_size');
	
	$va_letter_bar = array();
	$vs_order_by = $va_facet_info["order_by_label_fields"][0];
	$vs_facet_list = "";	
	
	$vn_c = 0;
	
	if($vs_last_letter_list = $this->request->getParameter('lastletters', pString)){
		$va_letter_bar = explode("---", $vs_last_letter_list);
	}

	if($vb_is_nav){
		foreach($va_facet_content as $vn_id => $va_item) {
			if($va_facet_info["group_mode"]== "alphabetical"){
				$vs_first_letter = mb_strtoupper(mb_substr($va_item[$vs_order_by], 0, 1));
				if(!$vs_first_letter){
					$vs_first_letter = mb_strtoupper(mb_substr($va_item["label"], 0, 1));
				}
				if(!in_array($vs_first_letter, $va_letter_bar)){
					$va_letter_bar[$vs_first_letter] = $vs_first_letter;
					if (ctype_alpha($vs_first_letter)) {
						$vs_facet_list .= "<div  class='browseFacetItem col-sm-4 col-md-3 letterHeader'><a class='anchorName' name='facetList".$vs_first_letter."'><strong>".$vs_first_letter."</strong></a></div>";
					}
					if ($vn_start > 0) {
						# --- append link to facet bar
?>
						<script type="text/javascript">
						
							jQuery("#bLetterBar").append("<a href='#facetList<?php print $vs_first_letter; ?>' id='facetLetterBar<?php print $vs_first_letter; ?>'><?php print $vs_first_letter; ?></a>");
						</script>
<?php
					}
				}
			}			
				$vs_facet_list .= "<div class='browseFacetItem col-xs-12 col-sm-4 col-md-3'>".caNavLink($this->request, $va_item['label'], '', '*', '*', '*', array('facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_view, 'key' => $vs_key))."</div>\n";
			$vn_c++;
			if ($vn_c >= $vn_items_per_page) { break; }
		}
		if ($vn_start == 0) {
			if($va_facet_info["group_mode"]== "alphabetical"){
				print "<div id='scrollDiv'><div id='buf'><div id='bLetterBar'>";
				foreach($va_letter_bar as $vs_letter){
					if (ctype_alpha($vs_letter)) {
						print "<a href='#facetList".$vs_letter."' id='facetLetterBar".$vs_letter."'>".$vs_letter."</a>";
					}	
				}
				print "</div></div></div><!-- end bLetterBar -->";
			}	
?>
			<div id="panel_<?php print $vs_facet_name; ?>" class="row alphaList">
<?php
		}
			print $vs_facet_list;
		if ($vn_facet_size >= ($vn_start + $vn_items_per_page)) {
			print caNavLink($this->request, caBusyIndicatorIcon($this->request).' '._t('Loading'), 'caNextPage', '*', '*', '*', array('facet' => $vs_facet_name, 'getFacet' => 1, 'key' => $vs_key, 'isNav' => $vb_is_nav ? 1 : 0, 's' => $vn_start + $vn_items_per_page, 'lastletters' => join("---", $va_letter_bar)));
		}
		if ($vn_start == 0) {
?>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#panel_<?php print $vs_facet_name; ?>").jscroll({
						loadingHtml: "<div class='browseFacetItem col-sm-4 col-md-3'><a href='#'><?php print addslashes(caBusyIndicatorIcon($this->request).' '._t('Loading...')); ?></a></div>",
						padding: 1000000,
						nextSelector: '.caNextPage',
						debug: true
					});
					$('html, body').animate({
						scrollTop: 1
					}, 0);
					$('html, body').animate({
						scrollTop: 0
					}, 0);
				});	
			</script>
			<script type="text/javascript">
				$(window).scroll(function() {    
					var scroll = $(window).scrollTop();

					 //>=, not <=
					if (scroll >= 55) {
						//clearHeader, not clearheader - caps H
						$("#scrollDiv").addClass("bLetterBarScroll");
					}
					if (scroll <= 55) {
						//clearHeader, not clearheader - caps H
						$("#scrollDiv").removeClass("bLetterBarScroll");
					}					
				});
			</script>			
<?php
		}
	
	} else {
		foreach($va_facet_content as $vn_id => $va_item) {
			if($va_facet_info["group_mode"]== "alphabetical"){
				$vs_first_letter = mb_strtoupper(mb_substr($va_item[$vs_order_by], 0, 1));
				if(!$vs_first_letter){
					$vs_first_letter = mb_strtoupper(mb_substr($va_item["label"], 0, 1));
				}
				if(!in_array($vs_first_letter, $va_letter_bar)){
					$va_letter_bar[$vs_first_letter] = $vs_first_letter;
					$vs_facet_list .= "<div id='facetList".$vs_first_letter."'><strong>".$vs_first_letter."</strong></div>";
				}
			}			
				$vs_facet_list .= "<div>".caNavLink($this->request, $va_item['label'], '', '*', '*', '*', array('facet' => $vs_facet_name, 'id' => $va_item['id'], 'view' => $vs_view, 'key' => $vs_key))."</div>\n";
			$vn_c++;
		}
		print "<a href='#' class='pull-right' id='bMorePanelClose' onclick='jQuery(\"#bMorePanel\").toggle(); return false;'><span class='glyphicon glyphicon-remove-circle'></span></a>";
		print "<H1 id='bScrollListLabel'>".$va_facet_info["label_plural"]."<span class='bFilterCount'> (".sizeof($va_facet_content)." total)</span></H1>";
		if($va_facet_info["group_mode"]== "alphabetical"){
			print "<div id='bLetterBar'>";
			foreach($va_letter_bar as $vs_letter){
				print "<a href='#' onclick='jumpToLetter(\"facetList".$vs_letter."\"); return false;'>".$vs_letter."</a><br/>";
			}
			print "</div><!-- end bLetterBar -->";
		}
		print "<div id='bScrollList'>".$vs_facet_list."</div><!-- end bScrollList -->";
		print "<div style='clear:both;'></div>";
		if($va_facet_info["group_mode"]== "alphabetical"){
?>
		<script type="text/javascript">		
			function jumpToLetter(jumpToItemID){
				jQuery("#bScrollList").scrollTop(0);
				var position = jQuery("#" + jumpToItemID).position();
				var scrollListPosition = jQuery("#bScrollList").position();
				jQuery("#bScrollList").scrollTop(position.top - scrollListPosition.top - 5);
			}
		</script>
<?php
		}
	}
?>