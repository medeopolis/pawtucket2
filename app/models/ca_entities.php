<?php
/** ---------------------------------------------------------------------
 * app/models/ca_entities.php : table access class for table ca_entities
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2008-2025 Whirl-i-Gig
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
 * @subpackage models
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 * 
 * ----------------------------------------------------------------------
 */
require_once(__CA_LIB_DIR__."/IBundleProvider.php");
require_once(__CA_LIB_DIR__."/RepresentableBaseModel.php");
require_once(__CA_LIB_DIR__."/HistoryTrackingCurrentValueTrait.php");

BaseModel::$s_ca_models_definitions['ca_entities'] = array(
 	'NAME_SINGULAR' 	=> _t('entity'),
 	'NAME_PLURAL' 		=> _t('entities'),
 	'FIELDS' 			=> array(
 		'entity_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_HIDDEN, 
			'IDENTITY' => true, 'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => _t('CollectiveAccess id'), 'DESCRIPTION' => _t('Unique numeric identifier used by CollectiveAccess internally to identify this entity')
		),
		'parent_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true, 
			'DEFAULT' => '',
			'LABEL' => 'Parent id', 'DESCRIPTION' => 'Identifier of parent entity'
		),
		'locale_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT, 
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true, 
			'DISPLAY_FIELD' => array('ca_locales.name'),
			'DEFAULT' => '',
			'LABEL' => _t('Locale'), 'DESCRIPTION' => _t('The locale from which the entity originates.')
		),
		'source_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true, 
			'DEFAULT' => '',
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'LIST_CODE' => 'entity_sources',
			'LABEL' => _t('Source'), 'DESCRIPTION' => _t('Administrative source of the entity. This value is often used to indicate the administrative sub-division or legacy database from which the entity information originates, but can also be re-tasked for use as a simple classification tool if needed.')
		),
		'type_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LIST_CODE' => 'entity_types',
			'LABEL' => _t('Entity type'), 'DESCRIPTION' => _t('The type of the entity. eg. individual, organization, family, etc.')
		),
		'idno' => array(
			'FIELD_TYPE' => FT_TEXT, 'DISPLAY_TYPE' => DT_FIELD, 
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'LABEL' => _t('Entity identifier'), 'DESCRIPTION' => _t('A unique alphanumeric identifier for this entity.'),
			'BOUNDS_LENGTH' => array(0,255)
		),
		'idno_sort' => array(
			'FIELD_TYPE' => FT_TEXT, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 255, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => 'Idno sort', 'DESCRIPTION' => 'Sortable version of value in idno',
			'BOUNDS_LENGTH' => array(0,255)
		),
		'idno_sort_num' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => 'Sortable object identifier as integer', 'DESCRIPTION' => 'Integer value used for sorting objects; used for idno range query.'
		),
		'source_info' => array(
			'FIELD_TYPE' => FT_VARS, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 88, 'DISPLAY_HEIGHT' => 15,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => _t('Data source information'), 'DESCRIPTION' => _t('Serialized array used to store source information for entity information retrieved via web services [NOT IMPLEMENTED YET].')
		),
		'lifespan' => array(
			'FIELD_TYPE' => FT_HISTORIC_DATERANGE, 'DISPLAY_TYPE' => DT_FIELD, 
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true, 
			'DEFAULT' => '',
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'START' => 'life_sdatetime', 'END' => 'life_edatetime',
			'LABEL' => _t('Lifetime'), 'DESCRIPTION' => _t('Lifetime of entity (date range)')
		),
		'hier_entity_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => _t('Entity hierarchy'), 'DESCRIPTION' => _t('Identifier of entity that is root of the entity hierarchy.')
		),
		'hier_left' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => 'Hierarchical index - left bound', 'DESCRIPTION' => 'Left-side boundary for nested set-style hierarchical indexing; used to accelerate search and retrieval of hierarchical record sets.'
		),
		'hier_right' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => 'Hierarchical index - right bound', 'DESCRIPTION' => 'Right-side boundary for nested set-style hierarchical indexing; used to accelerate search and retrieval of hierarchical record sets.'
		),
		'access' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT, 
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => 0,
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'BOUNDS_CHOICE_LIST' => array(
				_t('Not accessible to public') => 0,
				_t('Accessible to public') => 1
			),
			'LIST' => 'access_statuses',
			'LABEL' => _t('Access'), 'DESCRIPTION' => _t('Indicates if entity information is accessible to the public or not. ')
		),
		'status' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT, 
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => 0,
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'BOUNDS_CHOICE_LIST' => array(
				_t('Newly created') => 0,
				_t('Editing in progress') => 1,
				_t('Editing complete - pending review') => 2,
				_t('Review in progress') => 3,
				_t('Completed') => 4
			),
			'LIST' => 'workflow_statuses',
			'LABEL' => _t('Status'), 'DESCRIPTION' => _t('Indicates the current state of the entity record.')
		),
		'deleted' => array(
			'FIELD_TYPE' => FT_BIT, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => 0,
			'LABEL' => _t('Is deleted?'), 'DESCRIPTION' => _t('Indicates if the entity is deleted or not.'),
			'BOUNDS_VALUE' => array(0,1),
			'DONT_INCLUDE_IN_SEARCH_FORM' => true
		),
		'rank' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_FIELD, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => _t('Sort order'), 'DESCRIPTION' => _t('Sort order'),
		),
		'view_count' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT, 
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => false, 
			'DEFAULT' => '',
			'LABEL' => 'View count', 'DESCRIPTION' => _t('Number of views for this record.')
		),
		'submission_user_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true, 
			'DEFAULT' => null,
			'DONT_ALLOW_IN_UI' => true,
			'LABEL' => _t('Submitted by user'), 'DESCRIPTION' => _t('User submitting this entity')
		),
		'submission_group_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true, 
			'DEFAULT' => null,
			'DONT_ALLOW_IN_UI' => true,
			'LABEL' => _t('Submitted for group'), 'DESCRIPTION' => _t('Group this entity was submitted under')
		),
		'submission_status_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT,
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true,
			'DEFAULT' => null,
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'LIST_CODE' => 'submission_statuses',
			'LABEL' => _t('Submission status'), 'DESCRIPTION' => _t('Indicates submission status')
		),
		'submission_via_form' => array(
			'FIELD_TYPE' => FT_TEXT, 'DISPLAY_TYPE' => DT_OMIT,
			'DISPLAY_WIDTH' => 40, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true,
			'DEFAULT' => null,
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'LABEL' => _t('Submission via form'), 'DESCRIPTION' => _t('Indicates what contribute form was used to create the submission')
		),
		'submission_session_id' => array(
			'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_SELECT,
			'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
			'IS_NULL' => true,
			'DEFAULT' => null,
			'ALLOW_BUNDLE_ACCESS_CHECK' => true,
			'LABEL' => _t('Submission session'), 'DESCRIPTION' => _t('Indicates submission session')
		),
 	)
);

class ca_entities extends RepresentableBaseModel implements IBundleProvider {
	use HistoryTrackingCurrentValueTrait;
	
	# ------------------------------------------------------
	# --- Object attribute properties
	# ------------------------------------------------------
	# Describe structure of content object's properties - eg. database fields and their
	# associated types, what modes are supported, et al.
	#

	# ------------------------------------------------------
	# --- Basic object parameters
	# ------------------------------------------------------
	# what table does this class represent?
	protected $TABLE = 'ca_entities';
	      
	# what is the primary key of the table?
	protected $PRIMARY_KEY = 'entity_id';

	# ------------------------------------------------------
	# --- Properties used by standard editing scripts
	# 
	# These class properties allow generic scripts to properly display
	# records from the table represented by this class
	#
	# ------------------------------------------------------

	# Array of fields to display in a listing of records from this table
	protected $LIST_FIELDS = array('idno');

	# When the list of "list fields" above contains more than one field,
	# the LIST_DELIMITER text is displayed between fields as a delimiter.
	# This is typically a comma or space, but can be any string you like
	protected $LIST_DELIMITER = ' ';


	# What you'd call a single record from this table (eg. a "person")
	protected $NAME_SINGULAR;

	# What you'd call more than one record from this table (eg. "people")
	protected $NAME_PLURAL;

	# List of fields to sort listing of records by; you can use 
	# SQL 'ASC' and 'DESC' here if you like.
	protected $ORDER_BY = array('idno');

	# Maximum number of record to display per page in a listing
	protected $MAX_RECORDS_PER_PAGE = 20; 

	# How do you want to page through records in a listing: by number pages ordered
	# according to your setting above? Or alphabetically by the letters of the first
	# LIST_FIELD?
	protected $PAGE_SCHEME = 'alpha'; # alpha [alphabetical] or num [numbered pages; default]

	# If you want to order records arbitrarily, add a numeric field to the table and place
	# its name here. The generic list scripts can then use it to order table records.
	protected $RANK = 'rank';
	
	# ------------------------------------------------------
	# Hierarchical table properties
	# ------------------------------------------------------
	protected $HIERARCHY_TYPE				=	__CA_HIER_TYPE_ADHOC_MONO__;
	protected $HIERARCHY_LEFT_INDEX_FLD 	= 	'hier_left';
	protected $HIERARCHY_RIGHT_INDEX_FLD 	= 	'hier_right';
	protected $HIERARCHY_PARENT_ID_FLD		=	'parent_id';
	protected $HIERARCHY_DEFINITION_TABLE	=	'ca_entities';
	protected $HIERARCHY_ID_FLD				=	'hier_entity_id';
	protected $HIERARCHY_POLY_TABLE			=	null;
	
	# ------------------------------------------------------
	# Change logging
	# ------------------------------------------------------
	protected $UNIT_ID_FIELD = null;
	protected $LOG_CHANGES_TO_SELF = true;
	protected $LOG_CHANGES_USING_AS_SUBJECT = array(
		"FOREIGN_KEYS" => array(
		
		),
		"RELATED_TABLES" => array(
		
		)
	);
	
	# ------------------------------------------------------
	# Labeling
	# ------------------------------------------------------
	protected $LABEL_TABLE_NAME = 'ca_entity_labels';
	
	# ------------------------------------------------------
	# Attributes
	# ------------------------------------------------------
	protected $ATTRIBUTE_TYPE_ID_FLD = 'type_id';			// name of type field for this table - attributes system uses this to determine via ca_metadata_type_restrictions which attributes are applicable to rows of the given type
	protected $ATTRIBUTE_TYPE_LIST_CODE = 'entity_types';	// list code (ca_lists.list_code) of list defining types for this table
	
	# ------------------------------------------------------
	# Sources
	# ------------------------------------------------------
	protected $SOURCE_ID_FLD = 'source_id';				// name of source field for this table
	protected $SOURCE_LIST_CODE = 'entity_sources';		// list code (ca_lists.list_code) of list defining sources for this table

	# ------------------------------------------------------
	# Self-relations
	# ------------------------------------------------------
	protected $SELF_RELATION_TABLE_NAME = 'ca_entities_x_entities';
	
	# ------------------------------------------------------
	# ID numbering
	# ------------------------------------------------------
	protected $ID_NUMBERING_ID_FIELD = 'idno';				// name of field containing user-defined identifier
	protected $ID_NUMBERING_SORT_FIELD = 'idno_sort';		// name of field containing version of identifier for sorting (is normalized with padding to sort numbers properly)
	
	# ------------------------------------------------------
	# Search
	# ------------------------------------------------------
	protected $SEARCH_CLASSNAME = 'EntitySearch';
	protected $SEARCH_RESULT_CLASSNAME = 'EntitySearchResult';
	
	# ------------------------------------------------------
	# ACL
	# ------------------------------------------------------
	protected $SUPPORTS_ACL = true;
	
	# ------------------------------------------------------
	# $FIELDS contains information about each field in the table. The order in which the fields
	# are listed here is the order in which they will be returned using getFields()

	protected $FIELDS;
	

	# ------------------------------------------------------
	protected function initLabelDefinitions($pa_options=null) {
		parent::initLabelDefinitions($pa_options);
		$this->BUNDLES['ca_object_representations'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Media representations'));
		$this->BUNDLES['ca_entities'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related entities'));
		$this->BUNDLES['ca_places'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related places'));
		$this->BUNDLES['ca_objects'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related objects'));
		$this->BUNDLES['ca_objects_table'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related objects list'));
		$this->BUNDLES['ca_objects_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related objects list'));
		$this->BUNDLES['ca_object_representations_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related object representations list'));
		$this->BUNDLES['ca_entities_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related entities list'));
		$this->BUNDLES['ca_places_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related places list'));
		$this->BUNDLES['ca_occurrences_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related occurrences list'));
		$this->BUNDLES['ca_collections_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related collections list'));
		$this->BUNDLES['ca_list_items_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related list items list'));
		$this->BUNDLES['ca_storage_locations_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related storage locations list'));
		$this->BUNDLES['ca_loans_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related loans list'));
		$this->BUNDLES['ca_movements_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related movements list'));
		$this->BUNDLES['ca_object_lots_related_list'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related object lots list'));
		$this->BUNDLES['ca_occurrences'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related occurrences'));
		$this->BUNDLES['ca_collections'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related collections'));
		$this->BUNDLES['ca_object_lots'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related lot'));
		$this->BUNDLES['ca_loans'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related loans'));
		$this->BUNDLES['ca_movements'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related movements'));
		$this->BUNDLES['ca_storage_locations'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related storage locations'));
		
		$this->BUNDLES['ca_tour_stops'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related tour stops'));
		
		$this->BUNDLES['ca_list_items'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related vocabulary terms'));
		$this->BUNDLES['ca_sets'] = array('type' => 'related_table', 'repeating' => true, 'label' => _t('Related sets'));
		$this->BUNDLES['ca_sets_checklist'] = array('type' => 'special', 'repeating' => true, 'label' => _t('Sets'));
		
		$this->BUNDLES['ca_item_tags'] = array('type' => 'special', 'repeating' => true, 'label' => _t('Tags'));
		$this->BUNDLES['ca_item_comments'] = array('type' => 'special', 'repeating' => true, 'label' => _t('Comments'));
		
		$this->BUNDLES['hierarchy_navigation'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Hierarchy navigation'));
		$this->BUNDLES['hierarchy_location'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Location in hierarchy'));
		
		$this->BUNDLES['authority_references_list'] = array('type' => 'special', 'repeating' => false, 'label' => _t('References'));

		$this->BUNDLES['history_tracking_current_value'] = array('type' => 'special', 'repeating' => false, 'label' => _t('History tracking – current value'), 'displayOnly' => true);
		$this->BUNDLES['history_tracking_current_date'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Current history tracking date'), 'displayOnly' => true);
		$this->BUNDLES['history_tracking_chronology'] = array('type' => 'special', 'repeating' => false, 'label' => _t('History'));
		$this->BUNDLES['history_tracking_current_contents'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Current contents'));
		
		$this->BUNDLES['submitted_by_user'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Submitted by'), 'displayOnly' => true);
		$this->BUNDLES['submission_group'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Submission group'), 'displayOnly' => true);
		
		$this->BUNDLES['generic'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Display template'));
	}
	# ------------------------------------------------------
	/**
	 * Implementations can override this to add more criteria for hashing, e.g. hierarchy path components or what have you
	 * @return array
	 */
	public function getAdditionalChecksumComponents() {
		if(!$this->getPrimaryKey()) { return false; }
		return array($this->get('lifespan'));
	}
	# ------------------------------------------------------------------
	/**
	 * 
	 */
	public function addLabel($pa_label_values, $pn_locale_id, $pn_type_id=null, $pb_is_preferred=false, $pa_options=null) {
		if(!is_array($pa_label_values) || ((sizeof($pa_label_values) === 1) && isset($pa_label_values['displayname']))) {
			$pa_label_values = DataMigrationUtils::splitEntityName(is_array($pa_label_values) ? $pa_label_values['displayname'] : $pa_label_values, $pa_options);
		}
		return parent::addLabel($pa_label_values, $pn_locale_id, $pn_type_id, $pb_is_preferred, $pa_options);
	}
	# ------------------------------------------------------------------
	/**
	 * 
	 */
	public function editLabel($pn_label_id, $pa_label_values, $pn_locale_id, $pn_type_id=null, $pb_is_preferred=false, $pa_options=null) {
		if(!is_array($pa_label_values) || ((sizeof($pa_label_values) === 1) && isset($pa_label_values['displayname']))) {
			$pa_label_values = DataMigrationUtils::splitEntityName(is_array($pa_label_values) ? $pa_label_values['displayname'] : $pa_label_values, $pa_options);
		}
		return parent::editLabel($pn_label_id, $pa_label_values, $pn_locale_id, $pn_type_id, $pb_is_preferred, $pa_options);
	}
	# ------------------------------------------------------------------
	/**
	 * 
	 */
	public function replaceLabel($pa_label_values, $pn_locale_id, $pn_type_id=null, $pb_is_preferred=true, $pa_options=null) {
		if(!is_array($pa_label_values) || ((sizeof($pa_label_values) === 1) && isset($pa_label_values['displayname']))) {
			$pa_label_values = DataMigrationUtils::splitEntityName(is_array($pa_label_values) ? $pa_label_values['displayname'] : $pa_label_values, $pa_options);
		}
		return parent::replaceLabel($pa_label_values, $pn_locale_id, $pn_type_id, $pb_is_preferred, $pa_options);
	}
	# -------------------------------------------------------
}
