<?php
/* ----------------------------------------------------------------------
 * app/plugins/NovaStory/themes/novastory/views/member_map_balloon_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2010-2013 Whirl-i-Gig
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
 	$va_access_values = caGetUserAccessValues($this->request);
 	$va_place_ids		= $this->getVar("place_ids");
	$t_place = new ca_places();
?>
	<div class="exploreMapBalloonContainer">
<?php
	foreach($va_place_ids as $vn_place_id){
		print "<div class='mapItem'>";
		$t_place->load($vn_place_id);
		$vs_image = $t_place->get("ca_object_representations.media.iconlarge", array("checkAccess" => $va_access_values, "limit" => 1));
		if($vs_image){
			print "<div class='mapImage'>".caDetailLink($this->request, $vs_image, '', 'ca_places', $t_place->get("place_id"))."</div>";
		}
		print "<H1>".$t_place->getWithTemplate("<l>^ca_places.preferred_labels.name</l>")."</H1>";
		$desc = $t_place->get("ca_places.description");
		if($desc){
			print "<p>".$desc."</p>";
		}
		print "<div>".caNavLink($this->request, _t("Browse All Objects"), 'btn btn-default btn-sm', '', 'Browse', 'objects', array("facet" => "place_facet", "id" => $t_place->get("ca_places.place_id")))."</div>";
		print "<div style='clear:both;'></div>";
		print "</div><!-- end mapItem -->";
	}
?>
	<div style="clear:both"><!-- empty --></div></div><!-- end memberMapBalloonContainer -->
