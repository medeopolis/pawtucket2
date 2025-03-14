<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/gallery_slideshow_html : Front page of site 
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
	$qr_res = $this->getVar('featured_set_items_as_search_result');
	$o_config = $this->getVar("config");
	$vs_caption_template = $o_config->get("front_page_set_item_caption_template");
	if(!$vs_caption_template){
		$vs_caption_template = "<l>^ca_objects.preferred_labels.name</l>";
	}
	if($qr_res && $qr_res->numHits()){
?>

<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2"> 
		<H2>Recently Added</H2>

			<div class="frontGrid">	
<?php
		
					$vn_col = $i = 0;
					while($qr_res->nextHit()){
						if($qr_res->get('ca_object_representations.media.iconlarge', array("checkAccess" => $va_access_values))){
							$vs_media = $qr_res->getWithTemplate('<l>^ca_object_representations.media.iconlarge</l>', array("checkAccess" => $va_access_values));
							if($vn_col == 0){
								print "<div class='row'>";
							}
							print "<div class='col-sm-3 col-xs-6'>".$vs_media.$qr_res->getWithTemplate('<l><div class="frontGridCaption">^ca_objects.preferred_labels</div></l>')."</div>"; 
							$i++;
							$vn_col++;
							if($vn_col == 4){
								print "</div>";
								$vn_col = 0;
							}
							if($i == 8){
								break;
							}
						}
					}
					if($vn_col > 0){
						print "</div><!-- end row -->";
					}
?>
			</div>
		
	</div>
</div>

<?php
	}
?>