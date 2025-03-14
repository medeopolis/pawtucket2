<?php
/* ----------------------------------------------------------------------
 * views/Browse/browse_results_html.php : 
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
	
	$va_views			= $this->getVar('views');
	$vs_current_view	= $this->getVar('view');
	$va_view_icons		= $this->getVar('viewIcons');
	
	$vs_current_sort	= $this->getVar('sort');
	$vs_sort_dir		= $this->getVar('sort_direction');
	
	$vs_table 			= $this->getVar('table');
	$t_instance			= $this->getVar('t_instance');
	
	$vb_is_search		= ($this->request->getController() == 'Search');
	
	
	$va_options			= $this->getVar('options');
	$vs_extended_info_template = caGetOption('extendedInformationTemplate', $va_options, null);
	$vb_ajax			= (bool)$this->request->isAjax();
	$va_browse_info = $this->getVar("browseInfo");
	$vs_sort_control_type = caGetOption('sortControlType', $va_browse_info, 'dropdown');
	$o_config = $this->getVar("config");
	$vs_result_col_class = $o_config->get('result_col_class');
	$vs_refine_col_class = $o_config->get('refine_col_class');
	$va_export_formats = $this->getVar('export_formats');
	
	$va_add_to_set_link_info = caGetAddToSetInfo($this->request);

 	$o_result_context = new ResultContext($this->request, 'ca_objects', 'multisearch');
	
	
if (!$vb_ajax) {	// !ajax
?>
<div class="row" style="clear:both;">
	<div class="col-xs-0 col-sm-3 col-md-3  col-lg-3">
		<div class=' mortonRefine'>
<?php
		print $this->render("Browse/browse_refine_subview_html.php");
?>	
		</div><!-- end mortonRefine -->		
	</div><!-- end col-2 -->
	<div class='col-xs-12 col-sm-8 col-md-9 col-lg-9'>
<?php 
			if($vs_sort_control_type == 'list'){
				if(is_array($va_sorts = $this->getVar('sortBy')) && sizeof($va_sorts)) {
					print "<H5 id='bSortByList'><ul><li><strong>"._t("Sort by:")."</strong></li>\n";
					$i = 0;
					foreach($va_sorts as $vs_sort => $vs_sort_flds) {
						$i++;
						if ($vs_current_sort === $vs_sort) {
							print "<li class='selectedSort'>{$vs_sort}</li>\n";
						} else {
							print "<li>".caNavLink($this->request, $vs_sort, '', '*', '*', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'sort' => $vs_sort))."</li>\n";
						}
						if($i < sizeof($va_sorts)){
							print "<li class='divide'>&nbsp;</li>";
						}
					}
					print "<li>".caNavLink($this->request, '<span class="glyphicon glyphicon-sort-by-attributes'.(($vs_sort_dir == 'asc') ? '' : '-alt').'"></span>', '', '*', '*', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'direction' => (($vs_sort_dir == 'asc') ? _t("desc") : _t("asc"))))."</li>";
					print "</ul></H5>\n";
				}
			}
?>
				
			<div id="searchOptions" >
<?php
		print "<h1>".$va_browse_info["displayName"]." <span class='grayText'>(".$qr_res->numHits()." result".(($qr_res->numHits() != 1 ? "s" : "")).")</span>";	

			if(is_array($va_facets) && sizeof($va_facets)){
?>
			<a href='#' id='bRefineButton' onclick='jQuery("#bRefine").toggle(); return false;'><i class="fa fa-filter"></i></a>
<?php
			}
			if(is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
				print "<a href='#' class='bSetsSelectMultiple' id='bSetsSelectMultipleButton' onclick='jQuery(\"#setsSelectMultiple\").submit(); return false;'><button type='button' class='btn btn-default btn-sm'>"._t("Add selected results to %1", $va_add_to_set_link_info['name_singular'])."</button></a>";
			}
		print "</h1>";
?>
				<div class='row'>	
					<div class='col-sm-3 col-md-3 col-lg-3 btn-group'>
					<a href='#' data-toggle="dropdown">Sort By: <span class='btn'><?php print $vs_current_sort;?><b class="caret"></b></span></a>
					<ul class="dropdown-menu" role="menu">
	<?php				
						if(is_array($va_sorts = $this->getVar('sortBy')) && sizeof($va_sorts)) {
							foreach($va_sorts as $vs_sort => $vs_sort_flds) {
								if ($vs_current_sort === $vs_sort) {
									print "<li><a href='#'><em>{$vs_sort}</em></a></li>\n";
								} else {
									print "<li>".caNavLink($this->request, $vs_sort, '', '*', '*', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'sort' => $vs_sort))."</li>\n";
								}
							}
						}
	?>										
					</ul>
					</div><!-- end buttongrp -->
					<div class='col-sm-3 col-md-3 col-lg-3 btn-group'>
	<?php
						if ($vs_sort_dir == 'asc') {
							$vs_sort_label = "ascending";
						} else {
							$vs_sort_label = "descending";
						}
	?>				
						<a href='#' data-toggle="dropdown">Sort Order: <span class='btn'><?php print ucfirst($vs_sort_label);?><b class="caret"></b></span></a>
						<ul class="dropdown-menu" role="menu">
	<?php	
							if(is_array($va_sorts = $this->getVar('sortBy')) && sizeof($va_sorts)) {
								print "<li>".caNavLink($this->request, (($vs_sort_dir == 'asc') ? '<em>' : '')._t("Ascending").(($vs_sort_dir == 'asc') ? '</em>' : ''), '', '*', '*', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'direction' => 'asc'))."</li>";
								print "<li>".caNavLink($this->request, (($vs_sort_dir == 'desc') ? '<em>' : '')._t("Descending").(($vs_sort_dir == 'desc') ? '</em>' : ''), '', '*', '*', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'direction' => 'desc'))."</li>";
							}
	?>										
						</ul>
					</div><!-- end buttongrp -->
	<?php	
						$vs_buf = "";		
						
						$va_recent_searches = $o_result_context->getSearchHistory(array('findTypes' => array('search_advanced', 'search_basic', 'multisearch'))); 
						if (is_array($va_recent_searches) && sizeof($va_recent_searches)) {
							$v_i = 0;
							foreach($va_recent_searches as $vs_search => $va_search_info) {
								$vs_buf.= "<li>".caNavLink($this->request, $va_search_info['display'], '', '', 'Search', 'objects', array('search' => $vs_search))."</li>";
								$v_i++;
								if ($v_i == 10) {
									break;
								}
							}
	?>
							<div class='col-sm-4 col-md-4 col-lg-4 btn-group'>
			
								<a href='#' data-toggle="dropdown">Recent Searches: <span class='btn'><?php print $va_search_info['display'];?><b class='caret'></b></span></a>
								<ul class="dropdown-menu" role="menu">
			<?php	
									print $vs_buf;
			?>										
								</ul>
							</div><!-- end buttongrp -->
<?php
						}
?>
					<div class='col-sm-2 col-md-2 col-lg-2 btn-group'>
		<?php
				
					if(is_array($va_views) && (sizeof($va_views) > 1)){
						$vs_views = array();
						foreach($va_views as $vs_view => $va_view_info) {
							if ($vs_current_view === $vs_view) {
								$vs_views[] = '<li><a href="#" class="active">'.$vs_view.'</a></li>';
							} else {
								$vs_views[] = "<li>".caNavLink($this->request, $vs_view, 'disabled', '*', '*', '*', array('view' => $vs_view, 'key' => $vs_browse_key)).'</li>';
							}
						}
						print "<a href='#' data-toggle='dropdown'>View: <span class='btn'>".$vs_current_view."<b class='caret'></b></span></a>";
						print "<ul class='dropdown-menu' role='menu'>";
						print join('',$vs_views);
						print "</ul>";
					}
		?>
					</div>	<!-- end buttongrp -->
				</div><!-- end row -->										
			</div><!-- end searchoptions -->	

		
		<H5>
<?php
			if (sizeof($va_criteria) > 0) {
				$i = 0;
				$vs_browse_crit = "Browsing by ";
				foreach($va_criteria as $va_criterion) {
					if ($va_criterion['facet_name'] != '_search') {
						$vs_browse_crit.= "<span class='facetName'>".$va_criterion['facet'].':</span>';
						$vs_browse_crit.= caNavLink($this->request, '<button type="button" class="btn btn-default btn-sm browseBtn">'.$va_criterion['value'].' <span class="glyphicon glyphicon-remove-circle"></span></button>', 'browseRemoveFacet', '*', '*', '*', array('removeCriterion' => $va_criterion['facet_name'], 'removeID' => $va_criterion['id'], 'view' => $vs_current_view, 'key' => $vs_browse_key));
					}else{
						print '<span class="facetName" style="display:block;">Search results for '.$va_criterion['value']." <small>("._t('%1 %2 %3', $qr_res->numHits(), ($va_browse_info["labelSingular"]) ? $va_browse_info["labelSingular"] : $t_instance->getProperty('NAME_SINGULAR'), ($qr_res->numHits() == 1) ? _t("Result") : _t("Results")).")</small></span>";
					}
					$i++;
					if($i < sizeof($va_criteria)){
						$vs_browse_crit.= " ";
					}
					$va_current_facet = $va_facets[$va_criterion['facet_name']];
					if((sizeof($va_criteria) == 1) && !$vb_is_search && $va_current_facet["show_description_when_first_facet"] && ($va_current_facet["type"] == "authority")){
						$t_authority_table = new $va_current_facet["table"];
						$t_authority_table->load($va_criterion['id']);
						$vs_facet_description = $t_authority_table->get($va_current_facet["show_description_when_first_facet"]);
					}
				}
			}
			if (sizeof($va_criteria) > ($vb_is_search ? 1 : 0)) {
				print $vs_browse_crit."<div class='browseBtn'><i class='fa fa-refresh'></i> ".caNavLink($this->request, _t("Start Over"), '', '*', '*', '*', array('view' => $vs_current_view, 'key' => $vs_browse_key, 'clear' => 1))."</div>";
			}
?>		
		</H5>
<?php
		if($vs_facet_description){
			print "<div class='bFacetDescription'>".$vs_facet_description."</div>";
		}

?>	
		<div class="row">
			<div id="browseResultsContainer">
<?php
} // !ajax

if ($qr_res->numHits() > 0) {
	print $this->render("Browse/browse_results_{$vs_current_view}_html.php");			
} else {
?>
	<h3><?php print _t('No results found'); ?></h3>
<?php
}
if (!$vb_ajax) {	// !ajax
?>
			</div><!-- end browseResultsContainer -->
		</div><!-- end row -->
		</form>
	</div><!-- end col-8 -->

	
	
</div><!-- end row -->	

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#browseResultsContainer').jscroll({
			autoTrigger: true,
			loadingHtml: "<?php print caBusyIndicatorIcon($this->request).' '.addslashes(_t('Loading...')); ?>",
			padding: 20,
			nextSelector: 'a.jscroll-next'
		});
<?php
		if(is_array($va_add_to_set_link_info) && sizeof($va_add_to_set_link_info)){
?>
		jQuery('#setsSelectMultiple').submit(function(e){		
			objIDs = [];
			jQuery('#setsSelectMultiple input:checkbox:checked').each(function() {
			   objIDs.push($(this).val());
			});
			objIDsAsString = objIDs.join(';');
			caMediaPanel.showPanel('<?php print caNavUrl($this->request, '', $va_add_to_set_link_info['controller'], 'addItemForm', array("saveSelectedResults" => 1)); ?>/object_ids/' + objIDsAsString);
			e.preventDefault();
			return false;
		});
<?php
		}
?>
	});

</script>
<?php
		print $this->render('Browse/browse_panel_subview_html.php');
} //!ajax