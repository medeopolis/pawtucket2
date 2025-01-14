<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
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
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
	$va_access_values = $this->getVar("access_values");
	$o_config = caGetBrowseConfig();
	
	#
	# --- entity set to show at top of entity browse when no search or browse has been done yet
	#
	$vs_title = "";
	$va_featured_ids = array();
	if($vs_set_code = $o_config->get("browse_featured_songs_set")){
		$t_set = new ca_sets();
		$t_set->load(array('set_code' => $vs_set_code));
		# Enforce access control on set
		if((sizeof($va_access_values) == 0) || (sizeof($va_access_values) && in_array($t_set->get("access"), $va_access_values))){
			$va_featured_ids = array_keys(is_array($va_tmp = $t_set->getItemRowIDs(array('checkAccess' => $va_access_values))) ? $va_tmp : array());
			$qr_res = caMakeSearchResult('ca_occurrences', $va_featured_ids);
		}
	}
	if($qr_res && $qr_res->numHits()){
?>
		<div class="row">
			<div class="col-sm-12">
				<div class="featuredList">	
<?php
	print '<div class="featuredListTitle">Selected Songs</div>';

			$vn_i = $vn_c = 0;
			$vb_more = false;
			if($qr_res && $qr_res->numHits()) {
				while($qr_res->nextHit()) {
					if ( $vn_i == 0) { print "<div class='row'>"; } 
					print "<div class='col-sm-3'>";
					print $qr_res->getWithTemplate("<l><div class='featuredTile'><div class='title noImage'>^ca_occurrences.preferred_labels.name</div></div></l>");	
					print "</div><!-- end col -->";
					$vn_i++;
					if ($vn_i == 4) {
						print "</div><!-- end row -->\n";
						$vn_i = 0;
					}
					$vn_c++;
					if($vn_c == 12){
						print "<div class='moreFeatured' style='display:none;'>";
						$vb_more = true;
					}
				}
				if ($vn_i > 0) {
					print "</div><!-- end row -->\n";
				}
				if($vb_more){
					print "</div><!-- end moreFeatured -->";
					print "<div class='row'><div class='col-sm-4 col-sm-offset-4 text-center'><a href='#' onClick='$(\".moreFeatured\").toggle();' class='moreFeatured btn btn-default'>More Selected Songs <i class='fa fa-arrow-right'></i></a><a href='#' onClick='$(\".moreFeatured\").toggle();' class='moreFeatured btn btn-default' style='display:none;'>Show Less <i class='fa fa-arrow-right'></i></a></div></div>";
						
				}
			}
?>
			</div>
		</div>
	</div>
<?php
		
	}
?>