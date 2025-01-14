<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-sm-12 col-md-5"><h1><?php _p("People & Organizations") ?></h1></div>
			<div class="col-sm-12 col-md-7 advancedSearchNav"><b>Search other record types:</b> <?php print caNavLink($this->request, "Objects", "", "Search", "advanced", "objects"); ?> | <?php print caNavLink($this->request, "Programming", "", "Search", "advanced", "programs"); ?></div>
		</div>
		

        <p><?php _p("Enter your search terms in the fields below."); ?></p>
{{{form}}}

<div class='advancedContainer'>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for="_fulltext" class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search across all fields in the database.') ?>"><?php _p('Keyword') ?></label>
			<div class="sr-only"><?php _p('Search across all fields in the database.') ?></div>
			{{{_fulltext%width=200px&height=1}}}
		</div>			
	</div>		
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for='ca_entities_preferred_labels' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Limit your search to the names of people and organizations.') ?>"><?php _p('Name') ?></label>
			<div class="sr-only"><?php _p('Limit your search to the names of people and organizations.') ?></div>
			{{{ca_entities.preferred_labels%width=220px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for='ca_entities_ind_gen_role[]' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search the roles of people and organizations.') ?>"><?php _p('Role') ?></label>
			<div class="sr-only"><?php _p('Search the roles of people and organizations.') ?></div>
			{{{ca_entities.ind_gen_role%width=200px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for='ca_entities_biography_biography_text[]' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search people and organizations by their biography text.') ?>"><?php _p('Biography') ?></label>
			<div class="sr-only"><?php _p('Search people and organizations by their biography text.') ?>></div>
			{{{ca_entities.biography.biography_text%width=200px&height=1}}}
		</div>
	</div>
	<br style="clear: both;"/>
	<div class='advancedFormSubmit'>
		<a href="#" class="caAdvancedSearchFormReset btn btn-default">Reset</a>&nbsp;&nbsp;
		<a href="#" class="caAdvancedSearchFormSubmit btn btn-default">Search</a>
	</div>
</div>	

{{{/form}}}

	</div>
</div><!-- end row -->

<script>
	jQuery(document).ready(function() {
		$('.advancedSearchField .formLabel').popover(); 
	});
	
</script>