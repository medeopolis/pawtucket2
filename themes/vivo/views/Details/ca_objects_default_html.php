<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2022 Whirl-i-Gig
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
 
	$t_object = 			$this->getVar("item");
	$va_comments = 			$this->getVar("comments");
	$va_tags = 				$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");
	$vn_pdf_enabled = 		$this->getVar("pdfEnabled");
	$vn_id =				$t_object->get('ca_objects.object_id');
	$va_access_values = caGetUserAccessValues($this->request);
?>
<div class="container"><div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container">
			<div class="row">
				<div class='col-md-10'>
					<H1>{{{^ca_objects.preferred_labels.name}}}</H1>
					<H2>{{{^ca_objects.type_id}}}</H2>
				</div>
				<div class='col-md-2'>
<?php
					print "<div id='detailTools'>";
					if($t_object->get("ca_objects.video_out", array("convertCodesToDisplayText" => true)) == "Yes"){
						print "<div class='detailTool'>".caNavLink($this->request, "<span class='glyphicon glyphicon-envelope'></span> Rent or Purchase", "", "", "Contact", "Form", array("contactType" => "RentalPurchase", "table" => "ca_objects", "id" => $t_object->get("ca_objects.object_id")))."</div>";
					}
					print "<div class='detailTool'>".caNavLink($this->request, "<span class='glyphicon glyphicon-envelope'></span> Inquire", "", "", "Contact", "Form", array("table" => "ca_objects", "id" => $t_object->get("ca_objects.object_id")))."</div>";
					print "<div class='detailTool'>".caNavLink($this->request, "<span class='glyphicon glyphicon-envelope'></span> Feedback", "", "", "Contact", "Form", array("contactType" => "Feedback", "table" => "ca_objects", "id" => $t_object->get("ca_objects.object_id")))."</div>";
					print "</div>";
?>
				
				</div><!-- end col -->
			</div>
			<div class="row">
				<div class='col-md-12'>
					<HR/>
				</div>
			</div>
			<div class="row">
<?php
$vb_2_col = false;
if(trim($this->getVar("representationViewer")) || $t_object->get("ca_objects.transcript_upload_container.transcript_upload.url")){
	$vb_2_col = true;
}
if($vb_2_col){
?>
				<div class='col-sm-6 col-md-6 col-lg-6'>
					{{{representationViewer}}}
				
				
					<div id="detailAnnotations"></div>
				
					<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>
				
	<?php
					# Comment and Share Tools
					if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {
						
						print '<div id="detailTools">';
						if ($vn_comments_enabled) {
	?>				
							<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment" aria-label="<?php print _t("Comments and tags"); ?>"></span>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a></div><!-- end detailTool -->
							<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
	<?php				
						}
						if ($vn_share_enabled) {
							print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt" aria-label="'._t("Share").'"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
						}
						if ($vn_pdf_enabled) {
							print "<div class='detailTool'><span class='glyphicon glyphicon-file' aria-label='"._t("Download")."'></span>".caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
						}
						print '</div><!-- end detailTools -->';
					}				

	?>
				
					{{{<ifdef code="ca_objects.transcript_upload_container.transcript_upload.url"><div class="unit"><unit relativeTo="ca_objects.transcript_upload_container.transcript_upload" delimiter="<br/>"><ifdef code="ca_objects.transcript_upload_container.transcript_upload.url"><a href="^ca_objects.transcript_upload_container.transcript_upload.url%version=original"><span class="glyphicon glyphicon-download-alt" role="button" aria-label="Download"></span></a> <a href="^ca_objects.transcript_upload_container.transcript_upload.url%version=original"><ifdef code="ca_objects.transcript_upload_container.transcript_caption">^ca_objects.transcript_upload_container.transcript_caption</ifdef><ifnotdef code="ca_objects.transcript_upload_container.transcript_caption">Download Transcript</ifnotdef></a></ifdef></unit></div></ifdef>}}}
					
				</div><!-- end col -->
			
				<div class='col-sm-6 col-md-6 col-lg-6'>
<?php
}else{
?>
				<div class='col-sm-12'>
<?php
}
?>				
					{{{<ifdef code="ca_objects.title_note"><div class="unit"><label>Title note</label><unit relativeTo="ca_objects.title_note" delimiter="<br>">^ca_objects.title_note</unit></div></ifdef>}}}
					{{{<ifdef code="ca_objects.alt_title"><div class="unit"><label>Alternate Titles</label><unit relativeTo="ca_objects.alt_title" delimiter="<br>">^ca_objects.alt_title</unit></div></ifdef>}}}
					{{{<ifdef code="ca_objects.date_container.date"><div class="unit"><label>Date</label><unit relativeTo="ca_objects.date_container" delimiter="<br>">^ca_objects.date_container.date<ifdef code="ca_objects.date_container.date_note">, ^ca_objects.date_container.date_note</ifdef></unit></div></ifdef>}}}
					{{{<ifdef code="ca_objects.remaster_date"><div class="unit"><label>Remaster Date</label>^ca_objects.remaster_date</div></ifdef>}}}
					{{{<ifdef code="ca_objects.language"><div class="unit"><label>Language</label>^ca_objects.language%delimiter=,_</div></ifdef>}}}
					{{{<ifdef code="ca_objects.genre"><div class="unit"><label>Genre</label>^ca_objects.genre%delimiter=,_</div></ifdef>}}}
					{{{<ifdef code="ca_objects.custom_extent"><div class="unit"><label>Extent</label>^ca_objects.custom_extent</div></ifdef>}}}
					{{{<ifdef code="ca_objects.idno"><div class="unit"><label>Identifier</label>^ca_objects.idno</div></ifdef>}}}
					
					{{{<ifdef code="ca_objects.object_description.description"><unit relativeTo="ca_objects.object_description" delimiter=" ">
						<div class='unit'>
							<if rule='^ca_objects.object_description.description_type !~ /other/'><label>^ca_objects.object_description.description_type</label></if>
							<span class="trimText">^ca_objects.object_description.description</span>
							<ifdef code="ca_objects.object_description.description_source|ca_objects.object_description.description_date|ca_objects.object_description.geographic_coverage"><br/><br/><i>
								<ifdef code="ca_objects.object_description.description_source">^ca_objects.object_description.description_source<ifdef code="ca_objects.object_description.description_date|ca_objects.object_description.geographic_coverage">, </ifdef></ifdef>
								<ifdef code="ca_objects.object_description.description_date">^ca_objects.object_description.description_date<ifdef code="ca_objects.object_description.geographic_coverage">, </ifdef></ifdef>
								<ifdef code="ca_objects.object_description.geographic_coverage">^ca_objects.object_description.geographic_coverage</ifdef>
							</i></ifdef>
							
						</div>
					</unit></ifdef>}}}
					
					{{{<ifdef code="ca_objects.content_description"><div class="unit"><label>Content Description</label>^ca_objects.content_description<ifdef code="ca_objects.content_source"><br/><br/><i>^ca_objects.content_source</i></ifdef></div></ifdef>}}}
					
					<!-- document -->
					{{{<ifdef code="ca_objects.physical_doc"><div class="unit"><label>Physical Description</label>
						<ifdef code="ca_objects.physical_doc.physical_document"><div class="unit">^ca_objects.physical_doc.physical_document</div></ifdef>
						<ifdef code="ca_objects.physical_doc.height_doc|ca_objects.physical_doc.width_doc|ca_objects.physical_doc.depth_doc"><div class="unit"><ifdef code="ca_objects.physical_doc.height_doc">height: ^ca_objects.physical_doc.height_doc </ifdef><ifdef code="ca_objects.physical_doc.width_doc">width: ^ca_objects.physical_doc.width_doc </ifdef><ifdef code="ca_objects.physical_doc.depth_doc">depth: ^ca_objects.physical_doc.depth_doc </ifdef></div></ifdef>
					
						<ifdef code="ca_objects.physical_doc.phys_doc_type|ca_objects.physical_doc.bw_doc|ca_objects.physical_doc.pages"><div class="unit">
							<ifdef code="ca_objects.physical_doc.phys_doc_type">^ca_objects.physical_doc.phys_doc_type<ifdef code="ca_objects.physical_doc.bw_doc|ca_objects.physical_doc.pages">, </ifdef></ifdef>
							<ifdef code="ca_objects.physical_doc.bw_doc">^ca_objects.physical_doc.bw_doc<ifdef code="ca_objects.physical_doc.pages">, </ifdef>
							<ifdef code="ca_objects.physical_doc.pages">^ca_objects.physical_doc.pages page(s)</ifdef>
						</div></ifdef>
						<ifdef code="ca_objects.physical_doc.phys_doc_notes"><div class="unit">^ca_objects.physical_doc.phys_doc_notes</div></ifdef>
						<ifdef code="ca_objects.physical_doc.phys_doc_source"><div class="unit"><i>^ca_objects.physical_doc.phys_doc_source</i></div></ifdef>
					</div></ifdef>}}}
					
					<!-- image -->
					{{{<ifdef code="ca_objects.physical_image_analogue"><div class="unit"><label>Physical Description</label>
						<ifdef code="ca_objects.physical_image_analogue.phys_image_analogue"><div class="unit">^ca_objects.physical_image_analogue.phys_image_analogue</div></ifdef>
						<ifdef code="ca_objects.physical_image_analogue.height_image_a|ca_objects.physical_image_analogue.width_image_a"><div class="unit"><ifdef code="ca_objects.physical_image_analogue.height_image_a">height: ^ca_objects.physical_image_analogue.height_image_a </ifdef><ifdef code="ca_objects.physical_image_analogue.width_image_a">width: ^ca_objects.physical_image_analogue.width_image_a</ifdef></div></ifdef>
					
						<ifdef code="ca_objects.physical_image_analogue.phys_image_type|ca_objects.physical_image_analogue.bw_image_a"><div class="unit">
							<ifdef code="ca_objects.physical_image_analogue.phys_image_type">^ca_objects.physical_image_analogue.phys_image_type<ifdef code="ca_objects.physical_image_analogue.bw_image_a">, </ifdef></ifdef>
							<ifdef code="ca_objects.physical_image_analogue.bw_image_a">^ca_objects.physical_image_analogue.bw_image_a</ifdef>
						</div></ifdef>
						<ifdef code="ca_objects.physical_image_analogue.phys_notes_image"><div class="unit">^ca_objects.physical_image_analogue.phys_notes_image</div></ifdef>
						<ifdef code="ca_objects.physical_image_analogue.phys_source_image"><div class="unit"><i>^ca_objects.physical_image_analogue.phys_source_image</i></div></ifdef>
					</div></ifdef>}}}
					
					<!-- object > born dig -->
					{{{<ifdef code="ca_objects.physical_born_dig"><div class="unit"><label>Physical Description</label>
						<ifdef code="ca_objects.physical_born_dig.phys_born_dig"><div class="unit">^ca_objects.physical_born_dig.phys_born_dig</div></ifdef>
						<ifdef code="ca_objects.physical_born_dig.phys_born_dig_notes"><div class="unit">Notes: ^ca_objects.physical_born_dig.phys_born_dig_notes</div></ifdef>
						<ifdef code="ca_objects.physical_born_dig.phys_source_born_dig"><div class="unit"><i>^ca_objects.physical_born_dig.phys_source_born_dig</i></div></ifdef>
					</div></ifdef>}}}
					
					<!-- object > physical -->
					{{{<ifdef code="ca_objects.physical_analogue_dig"><div class="unit"><label>Physical Description</label>
						<ifdef code="ca_objects.physical_analogue_dig.phys_analogue_dig_desc"><div class="unit">^ca_objects.physical_analogue_dig.phys_analogue_dig_desc</div></ifdef>
						<ifdef code="ca_objects.physical_analogue_dig.height_born|ca_objects.physical_analogue_dig.width_born|ca_objects.physical_analogue_dig.depth_born"><div class="unit"><ifdef code="ca_objects.physical_analogue_dig.height_born">height: ^ca_objects.physical_analogue_dig.height_born </ifdef><ifdef code="ca_objects.physical_analogue_dig.width_born">width: ^ca_objects.physical_analogue_dig.width_born </ifdef><ifdef code="ca_objects.physical_analogue_dig.depth_born">depth: ^ca_objects.physical_analogue_dig.depth_born </ifdef></div></ifdef>
					
						<ifdef code="ca_objects.physical_analogue_dig.bw_dig"><div class="unit">^ca_objects.physical_analogue_dig.bw_dig</div></ifdef>
						<ifdef code="ca_objects.physical_analogue_dig.phys_analogue_dig"><div class="unit">^ca_objects.physical_analogue_dig.phys_analogue_dig</div></ifdef>
						<ifdef code="ca_objects.physical_analogue_dig.phys_source_analogue_dig"><div class="unit"><i>^ca_objects.physical_analogue_dig.phys_source_analogue_dig</i></div></ifdef>
					</div></ifdef>}}}
					
					<!-- libraray and publication -->
					{{{<ifdef code="ca_objects.physical_lib"><div class="unit"><label>Physical Description</label>
						<ifdef code="ca_objects.physical_lib.phys_lib"><div class="unit">^ca_objects.physical_lib.phys_lib</div></ifdef>
						<ifdef code="ca_objects.physical_lib.phys_spine"><div class="unit">Spine height: ^ca_objects.physical_lib.phys_spine</div></ifdef>
					
						<ifdef code="ca_objects.physical_lib.phys_document_type"><div class="unit">^ca_objects.physical_lib.phys_document_type</div></ifdef>
						<ifdef code="ca_objects.physical_lib.phys_notes_lib"><div class="unit">^ca_objects.physical_lib.phys_notes_lib</div></ifdef>
						<ifdef code="ca_objects.physical_lib.phys_source_lib"><div class="unit"><i>^ca_objects.physical_lib.phys_source_lib</i></div></ifdef>
					</div></ifdef>}}}
					
					{{{<ifdef code="ca_objects.subjects"><div class="unit"><label>Subjects</label>^ca_objects.subjects%delimiter=,_</div></ifdef>}}}
					{{{<ifdef code="ca_objects.tags"><div class="unit"><label>Tags</label>^ca_objects.tags%delimiter=,_</div></ifdef>}}}
					
				
					{{{<ifcount code="ca_objects.children" min="1"><div class="unit"><label>Formats</label><unit relativeTo="ca_objects.children" delimiter="<br/>">^ca_objects.preferred_labels</unit></div></ifcount>}}}
					
					<!-- library publication -->
					{{{<ifdef code="ca_objects.volume"><div class="unit"><label>Volume</label>^ca_objects.volume</div></ifdef>}}}
					{{{<ifdef code="ca_objects.issue"><div class="unit"><label>Issue</label>^ca_objects.issue</div></ifdef>}}}
					{{{<ifdef code="ca_objects.edition"><div class="unit"><label>Edition</label>^ca_objects.edition</div></ifdef>}}}
					{{{<ifdef code="ca_objects.series"><div class="unit"><label>Series Statement</label>^ca_objects.series</div></ifdef>}}}
					{{{<ifdef code="ca_objects.publication_info"><div class="unit"><label>Place of Publication</label>^ca_objects.publication_info</div></ifdef>}}}
								
					
<?php
				$va_entities = $t_object->get("ca_entities", array("returnWithStructure" => 1, "checkAccess" => $va_access_values));
				if(is_array($va_entities) && sizeof($va_entities)){
					$va_entities_by_type = array();
					foreach($va_entities as $va_entity_info){
						$va_entities_by_type[$va_entity_info["relationship_typename"]][] = caDetailLink($this->request, $va_entity_info["displayname"], "", "ca_entities", $va_entity_info["entity_id"]);
					}
					foreach($va_entities_by_type as $vs_type => $va_entity_links){
						print "<div class='unit'><label>".$vs_type."</label>".join(", ", $va_entity_links)."</div>";
					}
				}
?>					
					{{{<ifcount code="ca_collections" min="1"><div class="unit"><label>Collection</label><unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.preferred_labels.name</l></unit></div></ifcount>}}}
					{{{<ifcount code="ca_occurrences" min="1" restrictToTypes="event"><div class="unit"><label>Related programs & events</label><div class="trimTextShort"><unit relativeTo="ca_occurrences" delimiter="<br/>" restrictToTypes="event"><l>^ca_occurrences.preferred_labels.name</l> (^relationship_typename)</unit></div></div></ifcount>}}}
					{{{<ifcount code="ca_occurrences" min="1" restrictToTypes="subject_guide"><div class="unit"><label>Related Subject Guides</label><div class="trimTextShort"><unit relativeTo="ca_occurrences" delimiter="<br/>" restrictToTypes="subject_guide"><l>^ca_occurrences.preferred_labels.name</l> (^relationship_typename)</unit></div></div></ifcount>}}}
				
					
					{{{<ifdef code="ca_objects.rightsSummary_asset"><div class="unit"><i>^ca_objects.rightsSummary_asset</i></div></ifdef>}}}
					{{{<ifdef code="ca_objects.content_notice"><div class="unit"><i>^ca_objects.content_notice</i></div></ifdef>}}}
					
				</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row --></div>

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 300,
		  moreLink: '<a href="#">More &#8964;</a>'
		});
		$('.trimTextShort').readmore({
		  speed: 75,
		  maxHeight: 112,
		  moreLink: '<a href="#">More &#8964;</a>'
		});
	});
</script>
