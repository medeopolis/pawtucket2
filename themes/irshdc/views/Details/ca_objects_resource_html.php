<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2015 Whirl-i-Gig
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
 
$vs_mode = $this->request->getParameter("mode", pString);
if($vs_mode == "map"){
	include("map_large_html.php");
}else{
	$va_options = $this->getVar("config_options");
	$t_object = 			$this->getVar("item");
	$va_comments = 			$this->getVar("comments");
	$va_tags = 				$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");
	$vn_pdf_enabled = 		$this->getVar("pdfEnabled");
	$vn_id =				$t_object->get('ca_objects.object_id');
	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);
	
	$va_access_values = $this->getVar("access_values");
	$va_breadcrumb_trail = array(caNavLink($this->request, "Home", '', '', '', ''));
	$o_context = ResultContext::getResultContextForLastFind($this->request, "ca_objects");
	$vs_last_find = strToLower($o_context->getLastFind($this->request, "ca_objects"));
	$vs_link_text = "";
	if(strpos($vs_last_find, "browse") !== false){
		$vs_link_text = "Find";	
	}elseif(strpos($vs_last_find, "search") !== false){
		$vs_link_text = "Search";	
	}elseif(strpos($vs_last_find, "gallery") !== false){
		$vs_link_text = "Features";	
	}elseif(strpos($vs_last_find, "narrative") !== false){
		$vs_link_text = "Narrative Threads";	
	}elseif(strpos($vs_last_find, "listing") !== false){
		$vs_link_text = "Resources";	
	}
	if($vs_link_text){
		$va_params["row_id"] = $t_object->getPrimaryKey();
 		$va_breadcrumb_trail[] = $o_context->getResultsLinkForLastFind($this->request, "ca_objects", $vs_link_text, null, $va_params);
 	}
 	$va_breadcrumb_trail[] = caTruncateStringWithEllipsis($t_object->get('ca_objects.preferred_labels.name'), 60);

?>
			<div class="row">
				<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
					{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
				</div><!-- end detailTop -->
			</div>
<?php
			 	if ($this->getVar("resultsLink")) {
					# --- breadcrumb trail only makes sense when there is a back button
					print "<div class='row'><div class='col-sm-12 breadcrumbTrail'><small>";
					print join(" > ", $va_breadcrumb_trail);
					print "</small></div></div>";
				}
?>
			<div class="row">
<?php
				$va_transcript_rep_ids = $va_full_text_rep_ids = array();
				$vs_representationViewer = trim($this->getVar("representationViewer"));
				if($vs_representationViewer){
?>
				<div class='col-sm-12 col-md-5'>
					<?php print $vs_representationViewer; ?>				
<?php
					# --- is there a transcript media
					$t_list = new ca_lists();
					$va_type = $t_list->getItemFromList("object_representation_types", "transcript");
					$va_transcript_rep_ids = array_keys($t_object->getRepresentations(null, null, array("checkAccess" => $va_access_values, "restrict_to_types" => array($va_type["item_id"]))));
					
					$va_type = $t_list->getItemFromList("object_representation_types", "full_text");
					$va_full_text_rep_ids = array_keys($t_object->getRepresentations(null, null, array("checkAccess" => $va_access_values, "restrict_to_types" => array($va_type["item_id"]))));
					
					if(is_array($va_transcript_rep_ids) && sizeof($va_transcript_rep_ids)){
						print "<div id='transcriptLink' class='text-center'>";
						if(is_array($va_transcript_rep_ids) && sizeof($va_transcript_rep_ids)){
							foreach($va_transcript_rep_ids as $vn_transcript_rep_id){
								$t_rep = new ca_object_representations($vn_transcript_rep_id);
							
								print " ".caNavLink($this->request, "<span class='glyphicon glyphicon-download'></span> ".$t_rep->get("transcript_translation", array("convertCodesToDisplayText" => true))." Transcript", "btn btn-default btn-small", "", "Detail", "DownloadRepresentation", array("context" => "objects", "download" => "1",  "version" => "original", "representation_id" => $vn_transcript_rep_id, "id" => $t_object->get("object_id")))." ";
							}
						}
						print "</div>";
					}
?>
					<div id="detailAnnotations"></div>
<?php				
					$va_reps = $t_object->getRepresentations("icon", null, array("checkAccess" => $va_access_values));
					if(sizeof($va_reps) > 1){
						print "<div><small>".sizeof($va_reps)." media</small></div>";
					}
					print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-2 col-md-2 col-xs-3", "version" => "iconlarge"));
					
?>
				</div><!-- end col -->
<?php
				}else{
					$t_list_item = new ca_list_items();
					$o_icons_conf = caGetIconsConfig();
					$vs_default_placeholder = "<i class='fa fa-picture-o fa-4x'></i>";
					$t_list_item->load($t_object->get("resource_type"));
					$vs_typecode = $t_list_item->get("idno");
					if($vs_type_placeholder = caGetPlaceholder($vs_typecode, "placeholder_large_media_icon")){
						$vs_thumbnail = $vs_type_placeholder;
					}else{
						$vs_thumbnail = $vs_default_placeholder_tag;
					}
					
?>
					<div class='col-sm-12 col-md-5'>
						
						<?php print "<div class='detailPlaceholderContainer'>".$vs_thumbnail."</div>"; ?>
<?php
					# --- is there a transcript media - sometimes there is one even though the primary media in not accessible to the public and a placeholder shows for the audio
					$t_list = new ca_lists();
					$va_type = $t_list->getItemFromList("object_representation_types", "transcript");
					$va_transcript_rep_ids = array_keys($t_object->getRepresentations(null, null, array("checkAccess" => $va_access_values, "restrict_to_types" => array($va_type["item_id"]))));
					if(is_array($va_transcript_rep_ids) && sizeof($va_transcript_rep_ids)){
						print "<div id='transcriptLink' class='text-center'>";
						foreach($va_transcript_rep_ids as $vn_transcript_rep_id){
							$t_rep = new ca_object_representations($vn_transcript_rep_id);
							
							print " ".caNavLink($this->request, "<span class='glyphicon glyphicon-download'></span> ".$t_rep->get("transcript_translation", array("convertCodesToDisplayText" => true))." Transcript", "btn btn-default btn-small", "", "Detail", "DownloadRepresentation", array("context" => "objects", "download" => "1",  "version" => "original", "representation_id" => $vn_transcript_rep_id, "id" => $t_object->get("object_id")))." ";
						}
						print "</div>";
					}
?>
					</div>
<?php
				}
?>
				<!--<div class='col-sm-12 col-md-<?php print ($vs_representationViewer) ? "5" : "7"; ?>'>-->
				<div class='col-sm-12 col-md-5'>
					<div class="stoneBg">				

						<H4>{{{^ca_objects.preferred_labels.name}}}
						{{{<ifdef code="ca_objects.dc_website"><br/><unit delimiter="<br/>"><a href="^ca_objects.dc_website" class="redLink" target="_blank">^ca_objects.dc_website <span class="glyphicon glyphicon-new-window"></span></a></unit></ifdef>}}}
						</H4>
						{{{<ifdef code="ca_objects.language"><div class='unit'><h6>Language</h6><unit delimiter=", ">^ca_objects.language</unit></div></ifdef>}}}
						
						{{{<ifcount code="ca_entities.related" restrictToTypes="school" min="1"><div class="unit"><H6>Related School<ifcount code="ca_entities.related" restrictToTypes="school" min="2">s</ifcount></H6><unit relativeTo="ca_entities" restrictToTypes="school" delimiter=", "><l>^ca_entities.preferred_labels.displayname</l></unit></div></ifcount>}}}
						{{{<ifdef code="ca_objects.description"><div class='unit'>^ca_objects.description</div></ifdef>}}}
					</div><!-- end stoneBg -->
<?php
						include("themes_html.php");
?>
				</div>
				<!--<div class='col-sm-12 col-md-<?php print ($vs_representationViewer) ? "2" : "5"; ?>'>-->
				<div class='col-sm-12 col-md-2'>
<?php
					# Comment and Share Tools
						
					print '<div id="detailTools">';
					if ($this->getVar("resultsLink")) {
						print '<div class="detailTool detailToolInline detailNavFull">'.$this->getVar("resultsLink").'</div><!-- end detailTool -->';
					}
					if ($this->getVar("previousLink")) {
						print '<div class="detailTool detailToolInline detailNavFull">'.$this->getVar("previousLink").'</div><!-- end detailTool -->';
					}
					if ($this->getVar("nextLink")) {
						print '<div class="detailTool detailToolInline detailNavFull">'.$this->getVar("nextLink").'</div><!-- end detailTool -->';
					}
					print "<div class='detailTool'><a href='#' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', $va_add_to_set_link_info["controller"], 'addItemForm', array('object_id' => $vn_id))."\"); return false;' title='".$va_add_to_set_link_info["link_text"]."'>".$va_add_to_set_link_info["icon"]." ".$va_add_to_set_link_info["link_text"]."</a></div>";
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}
					if ($vn_pdf_enabled) {
						print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
					}
?>
					{{{<ifdef code="ca_objects.dc_website"><div class='detailTool'><span class='glyphicon glyphicon-new-window'></span><a href="^ca_objects.dc_website" target="_blank">View Website</a></div></ifdef>}}}
					
<?php				
					
					if(is_array($va_full_text_rep_ids) && sizeof($va_full_text_rep_ids)){
						foreach($va_full_text_rep_ids as $vn_full_text_rep_id){
							$t_rep = new ca_object_representations($vn_transcript_rep_id);
							print "<div class='detailTool'><a href='#' title='"._t("Read Online")."' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'Detail', 'GetMediaOverlay', array('context' => 'objects', 'id' => $vn_id, 'representation_id' => $vn_full_text_rep_id, 'item_id' => $vn_id, 'overlay' => 1))."\"); return false;' ><span class='glyphicon glyphicon-zoom-in'></span> Read Online</a></div>\n";
							# --- online print one button to the first rep with read online
							break;
						}
					}
					print "<div class='detailTool'><span class='glyphicon glyphicon-envelope'></span>".caNavLink($this->request, "Ask a Question", "", "", "Contact", "Form", array("contactType" => "askArchivist", "table" => "ca_objects", "row_id" => $t_object->get("object_id")))."</div>";
					
					print '</div><!-- end detailTools -->';			

						if ($vn_comments_enabled) {
							$vn_num_comments = sizeof($va_comments) + sizeof($va_tags);
?>				
							<div class="collapseBlock last discussion">
								<h3>Discussion</H3>
								<div class="collapseContent open">
									<div id='detailDiscussion'>
										Do you have a story to contribute related to these records or a comment about this item?<br/>
<?php
										
										if($this->request->isLoggedIn()){
											print "<button type='button' class='btn btn-default' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'Detail', 'CommentForm', array("tablename" => "ca_objects", "item_id" => $t_object->getPrimaryKey()))."\"); return false;' >"._t("Add your comment")."</button>";
										}else{
											print "<button type='button' class='btn btn-default' onclick='caMediaPanel.showPanel(\"".caNavUrl($this->request, '', 'LoginReg', 'LoginForm', array())."\"); return false;' >"._t("Login/register to comment")."</button>";
										}
										if($vn_num_comments){
											print "<br/><br/><a href='#comments'>Read All Comments <i class='fa fa-angle-right' aria-hidden='true'></i></a>";
										}
?>
									</div><!-- end itemComments -->
								</div>
							</div>
<?php				
						}
					if($t_object->get("ca_places.georeference", array("checkAccess" => $va_access_values))){
						include("map_html.php");
					}
?>
				</div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-12">
<?php
		include("related_tabbed_html.php");
		include("related_objects_html.php");
		
					if($vn_num_comments){
?>
						<a name="comments"></a><div class="block">
							<h3>Discussion</H3>
							<div class="blockContent">
								<div id="detailComments">
<?php
								if(sizeof($va_comments)){
									print "<H2>Comments</H2>";
								}
								print $this->getVar("itemComments");
?>
								</div>
							</div>
						</div>
<?php
					}
?>				
			
					
				</div>
			</div>

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 100
		});
		$('.trimTextShort').readmore({
		  speed: 75,
		  maxHeight: 18
		});
		$('.trimTextSubjects').readmore({
		  speed: 75,
		  maxHeight: 80,
		  moreLink: '<a href="#" class="moreLess">More</a>',
		  lessLink: '<a href="#" class="moreLess">Less</a>'
		});
		
		var options = {
			placement: function () {
<?php
#			if($vs_representationViewer){
?>
				if ($(window).width() > 992) {
					return "left";
				}else{
					return "auto top";
				}
<?php
#			}else{
?>
				//return "auto top";
<?php			
#			}
?>
			},
			trigger: "hover",
			html: "true"
		};
		$('[data-toggle="popover"]').each(function() {
  			if($(this).attr('data-content')){
  				$(this).popover(options).click(function(e) {
					$(this).popover('toggle');
				});
  			}
		});
		
		$('.collapseBlock h3').click(function() {
  			block = $(this).parent();
  			block.find('.collapseContent').toggle();
  			block.find('.fa').toggleClass("fa-toggle-down");
  			block.find('.fa').toggleClass("fa-toggle-up");
  			
		});
		
		$( document ).ajaxComplete(function() {
			if ($('div.caAudioPlayer').length) {
				$('div.caAudioPlayer').each(function(i, obj) {
					if(!$(this).find(".detailPlaceholderContainer").length) {
						$(this).prepend('<div class="detailPlaceholderContainer"><i class="fa fa-file-sound-o fa-4x"></i></div>');
					}
				});
			}
<?php		
		if(is_array($va_full_text_rep_ids) && sizeof($va_full_text_rep_ids)){
			foreach($va_full_text_rep_ids as $vn_full_text_rep_id){
?>
				if(!$("#cont<?php print $vn_full_text_rep_id; ?> .detailMediaToolbar a.zoomButton").hasClass("readOnlineLoaded")){
					$("#cont<?php print $vn_full_text_rep_id; ?> .detailMediaToolbar a.zoomButton").append("<span class='readOnline'>Read Online</span>");
					$("#cont<?php print $vn_full_text_rep_id; ?> .detailMediaToolbar a.zoomButton").addClass("readOnlineLoaded");
				}
<?php			
			}
		}
?>
		});
	});
</script>
<?php
}
?>