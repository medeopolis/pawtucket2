
<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2">
		<div class="row">
			<div class="col-sm-12 col-md-6"><h1><?php _p("Archival, Library & Publication Objects") ?></h1></div>
			<div class="col-sm-12 col-md-6 advancedSearchNav"><b>Search other record types:</b> <?php print caNavLink($this->request, "People & Organizations", "", "Search", "advanced", "entities"); ?> | <?php print caNavLink($this->request, "Programming", "", "Search", "advanced", "programs"); ?></div>
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
			<label for='ca_objects_preferred_labels_name' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Limit your search to Object Titles only.') ?>"><?php _p('Title') ?></label>
			<div class="sr-only"><?php _p('Limit your search to Object Titles only.') ?></div>
			{{{ca_objects.preferred_labels.name%width=220px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-6">
			<label for='ca_objects_idno' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search object identifiers.') ?>"><?php _p('Identifier') ?></label>
			<div class="sr-only"><?php _p('Search object identifiers.') ?></div>
			{{{ca_objects.idno%width=210px}}}
		</div>
		<div class="advancedSearchField col-sm-6">
			<label for='ca_objects_type_id' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Limit your search to object types.') ?>"><?php _p('Type') ?></label>
			<div class="sr-only"><?php _p('Limit your search to object types.') ?></div>
			{{{ca_objects.type_id%height=1&id=ca_objects_type_id}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for='ca_objects_date_container_date[]' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search records of a particular date or date range.') ?>"><?php _p('Date range <i>(e.g. 1990-1992)</i>') ?></label>
			<div class="sr-only"><?php _p('Search records of a particular date or date range.') ?></div>
			{{{ca_objects.date_container.date%width=200px&height=1px&useDatePicker=0}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for='ca_collections_preferred_labels' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search records within a particular collection.') ?>"><?php _p('Collection') ?></label>
			<div class="sr-only"><?php _p('Search records within a particular collection.') ?></div>
			{{{ca_collections.preferred_labels%width=200px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<label for='ca_occurrences_preferred_labels' class='formLabel' data-toggle="popover" data-trigger="hover" data-content="<?php _p('Search records from a particular program.') ?>"><?php _p('Program') ?></label>
			<div class="sr-only"><?php _p('Search records from a particular program.') ?></div>
			{{{ca_occurrences.preferred_labels%restrictToTypes=program%width=200px}}}
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