<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_images_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
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
 
	$qr_res 			= $this->getVar('result');				// browse results (subclass of SearchResult)
	$va_facets 			= $this->getVar('facets');				// array of available browse facets
	$va_criteria 		= $this->getVar('criteria');			// array of browse criteria
	$vs_browse_key 		= $this->getVar('key');					// cache key for current browse
	$va_access_values 	= $this->getVar('access_values');		// list of access values for this user
	$vn_hits_per_block 	= (int)$this->getVar('hits_per_block');	// number of hits to display per block
	$vn_start		 	= (int)$this->getVar('start');			// offset to seek to before outputting results
	$vn_row_id		 	= (int)$this->getVar('row_id');			// id of last visited detail item so can load to and jump to that result - passed in back button
	$vb_row_id_loaded 	= false;
	if(!$vn_row_id){
		$vb_row_id_loaded = true;
	}
	
	$va_views			= $this->getVar('views');
	$vs_current_view	= $this->getVar('view');
	$va_view_icons		= $this->getVar('viewIcons');
	$vs_current_sort	= $this->getVar('sort');
	
	$t_instance			= $this->getVar('t_instance');
	$vs_table 			= $this->getVar('table');
	$vs_pk				= $this->getVar('primaryKey');
	$va_access_values = caGetUserAccessValues($this->request);
	$o_config = $this->getVar("config");	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);

	$vb_ajax			= (bool)$this->request->isAjax();
	

	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);

	$o_icons_conf = caGetIconsConfig();
	$va_object_type_specific_icons = $o_icons_conf->getAssoc("placeholders");
	if(!($vs_default_placeholder = $o_icons_conf->get("placeholder_media_icon"))){
		$vs_default_placeholder = "<i class='fa fa-picture-o fa-2x'></i>";
	}
	$vs_default_placeholder_tag = "<div class='bResultItemImgPlaceholder'>".$vs_default_placeholder."</div>";
		

		$vn_col_span = 3;
		$vn_col_span_sm = 4;
		$vb_refine = false;
		if(is_array($va_facets) && sizeof($va_facets)){
			$vb_refine = true;
			$vn_col_span = 3;
			$vn_col_span_sm = 4;
			$vn_col_span_xs = 6;
		}
		if ($vn_start < ($n = $qr_res->numHits())) {
			$vn_c = 0;
			$vn_results_output = 0;
			$qr_res->seek($vn_start);
			
			if ($vs_table != 'ca_objects') {
				$va_ids = array();
				while($qr_res->nextHit() && ($vn_c < $vn_hits_per_block)) {
					$va_ids[] = $qr_res->get($vs_pk);
					$vn_c++;
				}
				$va_images = caGetDisplayImagesForAuthorityItems($vs_table, $va_ids, array('version' => 'small', 'relationshipTypes' => caGetOption('selectMediaUsingRelationshipTypes', $va_options, null), 'checkAccess' => $va_access_values));
			
				$vn_c = 0;	
				$qr_res->seek($vn_start);
			}
			
			$t_list_item = new ca_list_items();
			while($qr_res->nextHit()) {
				if($vn_c == $vn_hits_per_block){
					if($vb_row_id_loaded){
						break;
					}else{
						$vn_c = 0;
					}
				}
				$vn_id 					= $qr_res->get("{$vs_table}.{$vs_pk}");
				if($vn_id == $vn_row_id){
					$vb_row_id_loaded = true;
				}
				# --- check if this result has been cached
				# --- key is MD5 of table, id, view, refine(vb_refine)
				$vs_cache_key = md5($vs_table.$vn_id."images".$vb_refine);
				if(($o_config->get("cache_timeout") > 0) && ExternalCache::contains($vs_cache_key,'browse_result')){
					print ExternalCache::fetch($vs_cache_key, 'browse_result');
				}else{

					$vs_idno_detail_link 	= caDetailLink($this->request, $qr_res->get("{$vs_table}.idno"), '', $vs_table, $vn_id);
					$vs_label_detail_link 	= "<span class='resultLabel'>".caDetailLink($this->request, $qr_res->get("{$vs_table}.preferred_labels.name"), '', $vs_table, $vn_id)."</span>";
					$vs_thumbnail = "";
					$vs_type_placeholder = "";
					$vs_typecode = "";
					if ($vs_table == 'ca_objects') {
						if(!($vs_thumbnail = $qr_res->get('ca_object_representations.media.medium', array("checkAccess" => $va_access_values)))){
							$t_list_item->load($qr_res->get("type_id"));
							$vs_typecode = $t_list_item->get("idno");
							if($vs_type_placeholder = caGetPlaceholder($vs_typecode, "placeholder_media_icon")){
								$vs_thumbnail = "<div class='bResultItemImgPlaceholder'>".$vs_type_placeholder."</div>";
							}else{
								$vs_thumbnail = $vs_default_placeholder_tag;
							}
						}
						$vn_parent_id = $qr_res->get("ca_objects.parent_id");
						$t_parent = new ca_objects($vn_parent_id);
						#$vs_catno = "";
						#if ($vs_catalog_number = $qr_res->get('ca_objects.catalog_number')) {
						#	$vs_catno = "<div class='catno'>cat. ".$vs_catalog_number."</div>";
						#}
						
						$vn_parent_id = $qr_res->get("ca_objects.parent_id");
						$t_parent = new ca_objects($vn_parent_id);
						$vs_catno = "";
						if ($vs_catalog_number = $qr_res->get('ca_objects.institutional_id')) {
							$vs_catno = "<div class='catno'>".$vs_catalog_number."</div>";
						}
					
						// $collection_id = $this->request->getParameter('id', pInteger);
// 						$rels = array_filter($t_parent->getRelatedItems('ca_collections', ['returnAs' => 'array']) ?? [], function($v) use ($collection_id) {
// 							return $v['collection_id'] == $collection_id;
// 						});
// 					
// 						$tr = null;
// 						if(sizeof($rels ?? []) > 0) {
// 							$rels = array_shift($rels);
// 							$t_rel = new ca_objects_x_collections($rels['relation_id']);
// 							$tr = $t_rel->get('ca_objects_x_collections.transaction_remarks');
// 						}
						
						$vs_info = null;
						if ($vs_date = $qr_res->get('ca_objects.display_date')) {
							$vs_info.= $vs_date;
						}
						if ($va_collection = $t_parent->getWithTemplate('<unit relativeTo="ca_objects_x_collections"><if rule="^ca_objects_x_collections.current_collection =~ /yes/"><unit relativeTo="ca_collections">^ca_collections.preferred_labels</unit></if></unit>')) {
							$vs_info.= $va_collection;
						}
						// if($t_rel && ($tr = $t_rel->get('ca_objects_x_collections.transaction_remarks'))) {
// 							$vs_info .= ", {$tr}";
// 						}
						if($vs_info) { $vs_info = "<p>{$vs_info}</p>"; }
						$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);				
					} else {
						if($va_images[$vn_id]){
							$vs_thumbnail = $va_images[$vn_id];
						}else{
							$vs_thumbnail = $vs_default_placeholder_tag;
						}
						$vs_rep_detail_link 	= caDetailLink($this->request, $vs_thumbnail, '', $vs_table, $vn_id);			
					}
					
					$vs_expanded_info = $qr_res->getWithTemplate($vs_extended_info_template);

					$vs_compare_link = !$vs_type_placeholder ? "<a href='#' class='compare_link' data-id='object:{$vn_id}'><div class='compareIcon' aria-hidden='true'></div></a>" : '';
					
					$vs_result_output = "
		<div class='bResultItemCol col-xs-{$vn_col_span_xs} col-sm-{$vn_col_span_sm} col-md-{$vn_col_span}'>
			<div class='bResultItem' id='row{$vn_id}' onmouseover='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").show();'  onmouseout='jQuery(\"#bResultItemExpandedInfo{$vn_id}\").hide();'>
				<div class='bSetsSelectMultiple'><input type='checkbox' name='object_ids' value='{$vn_id}'></div>
				<div class='bResultItemContent'><div class='imgContainer'><div class='text-center bResultItemImg'>{$vs_rep_detail_link}</div></div>
					<div class='bResultItemText'>	
						{$vs_label_detail_link}
						{$vs_info}
						{$vs_catno}
						{$vs_compare_link}
					</div><!-- end bResultItemText -->
				</div><!-- end bResultItemContent -->
			</div><!-- end bResultItem -->
		</div><!-- end col -->";
					ExternalCache::save($vs_cache_key, $vs_result_output, 'browse_result');
					print $vs_result_output;
				}
				$vn_c++;
				$vn_results_output++;
			}
			
			if ($n > 0) {
				print "<div style='clear:both'></div>".caNavLink($this->request, _t('Next %1', $vn_hits_per_block), 'jscroll-next', '*', '*', '*', array('s' => $vn_start + $vn_results_output, 'key' => $vs_browse_key, 'view' => $vs_current_view));
			}
		}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		if($("#bSetsSelectMultipleButton").is(":visible")){
			$(".bSetsSelectMultiple").show();
		}
	});
</script>
