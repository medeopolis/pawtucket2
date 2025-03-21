<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_entities_default_html.php : 
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
 
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
?>
<div class="row">
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
				<div class='col-md-12 col-lg-12'>
					<H1>{{{^ca_entities.preferred_labels.displayname}}}</H1>
					<H2>{{{^ca_entities.type_id}}}{{{<ifdef code="ca_entities.idno">, ^ca_entities.idno</ifdef>}}}</H2>
				</div><!-- end col -->
			</div><!-- end row -->
			
<?php

	$vs_tmp = $t_item->getWithTemplate("<ifcount code='ca_occurrences.related' min='1' restrictToTypes='event'><unit relativeTo='ca_entities_x_occurrences' delimiter=';;;' sort='ca_occurrences.exhibit_date'>^ca_occurrences.preferred_labels.name<ifdef code='ca_occurrences.exhibit_date'>, ^ca_occurrences.exhibit_date</ifdef>
										<ifdef code='ca_entities_x_occurrences.role'><br/><small>Role:  ^ca_entities_x_occurrences.role</small></ifdef><ifdef code='ca_entities_x_occurrences.person_status'><br><small>Person Status:  ^ca_entities_x_occurrences.person_status</small></ifdef><ifdef code='ca_entities_x_occurrences.effective_date'><br/><small>Effective Date: ^ca_entities_x_occurrences.effective_date</small></ifdef>
										</unit></ifcount>", array("checkAccess" => $va_access_values));
	if($vs_tmp){
		$va_event_text = explode(";;;", $vs_tmp);
		
		$vs_source = $t_item->getWithTemplate("<ifcount code='ca_occurrences.related' min='1' restrictToTypes='event'><unit relativeTo='ca_occurrences' restrictToTypes='event' delimiter=';;;' sort='ca_occurrences.exhibit_date'><ifcount code='ca_objects' min='1'><br/><small>Source: <unit relativeTo='ca_objects' delimiter=', '><l>^ca_objects.preferred_labels.name</l></unit></small></ifcount></unit></ifcount>", array("checkAccess" => $va_access_values));
		$va_source_text = explode(";;;", $vs_source);
		
		$va_event_ids = $t_item->get("ca_occurrences.occurrence_id", array("returnAsArray" => 1, "checkAccess" => $va_access_values, "sort" => "ca_occurrences.exhibit_date"));
		$va_events = array();
		foreach($va_event_ids as $vn_i => $vn_event_id){
			$va_events[] = "<div class='bgLightBlue text-center'>".caDetailLink($this->request, $va_event_text[$vn_i], "", "ca_occurrences", $vn_event_id).$va_source_text[$vn_i]."</div>";
		}
		if(is_array($va_events) && sizeof($va_events)){
			$va_rel_events = array();
			$i = 0;
?>
			<div class="row">
				<div class="col-sm-12">
					<H3>Events</H3>
<?php

					$i = 0;
					$col = 0;
					foreach($va_events as $vs_event_info){
						if($col == 0){
							print "<div class='row'>";
						}
						print "<div class='col-sm-4'>".$vs_event_info."</div>";
						$col++;
						if($col == 3){
							$col = 0;
							print "</div>";
						}
						$i++;
						#if($i == 24){
						#	if(sizeof($va_events) > 24){
						#		print "<div class='row'><div class='col-sm-12 text-center'>".caNavLink($this->request, "View All →", "btn btn-default", "", "Browse", "Events", array("facet" => "entity_facet", "id" => $t_item->get("ca_entities.entity_id")))."</div></div>";
						#	}
						#	break;
						#}
					}
					if($col > 0){
						print "</div>";
					}
?>			
			
				</div>
			</div>
<?php
		}
	}

?>
	

{{{<ifcount code="ca_objects" min="1">
			<div class="row">
				<div class="col-sm-12"><H3>Related Source<ifcount code="ca_objects" min="2">s</ifcount></H3></div>
			</div>
			<div class="row">
				<div id="browseResultsContainer">
					<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>
				</div><!-- end browseResultsContainer -->
			</div><!-- end row -->
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#browseResultsContainer").load("<?php print caNavUrl($this->request, '', 'Browse', 'objects', array('facet' => 'entity_facet', 'id' => '^ca_entities.entity_id'), array('dontURLEncodeParameters' => true)); ?>", function() {
						jQuery('#browseResultsContainer').jscroll({
							autoTrigger: true,
							loadingHtml: '<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>',
							padding: 20,
							nextSelector: 'a.jscroll-next'
						});
					});
					
					
				});
			</script>
</ifcount>}}}
		</div><!-- end container -->
		
		</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 400,
		  moreLink: '<a href="#">More &#8964;</a>'
		});
		$('.trimTextShort').readmore({
		  speed: 75,
		  maxHeight: 112,
		  moreLink: '<a href="#">More &#8964;</a>'
		});
	});
</script>