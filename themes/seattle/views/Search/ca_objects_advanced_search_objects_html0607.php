
<div class="row">
	<div class="col-sm-8 " style='border-right:1px solid #ddd;'>
		<h1>Objects Advanced Search</h1>

<?php			
print "<p>Enter your search terms in the fields below.</p>";
?>
<script>
document.write(localStorage.getItem("search_type_id");
</script>
{{{form}}}

<div class='advancedContainer' >


<div class='row'>
<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search on Object type">Type</span>
			
			<span  style="display:none">{{{ca_objects.type_id}}}</span>
<script>



$(window).bind("pageshow", function() {
	//var form = document.getElementById("caAdvancedSearch");
	//form.reset();
	checktype(document.getElementById('ca_objects_type_id').options[document.getElementById('ca_objects_type_id').selectedIndex].value);
	checkmap_group(document.getElementById('ca_objects.map_group[]2').selectedIndex);
	
});


window.onload =checktype(document.getElementById('format_type_selection').options[document.getElementById('format_type_selection').selectedIndex].value);
window.onload =checkColl(document.getElementById('ca_collections_preferred_labels').options[document.getElementById('ca_collections_preferred_labels').selectedIndex].value);

function checktype(val) {
if (val == ""){
	document.getElementById('MapSearch').style ='display:none';
	document.getElementById('PhotoSearch').style ='display:none';
	document.getElementById('TextSearch').style ='display:none';
	document.getElementById('AudioSearch').style ='display:none';
	document.getElementById('MovingImageSearch').style ='display:none';
	document.getElementById('allseries').style ='display:block';
	document.getElementById('imageseries').style ='display:none';
	document.getElementById('mapseries').style ='display:none';
	document.getElementById('textseries').style ='display:none';
	
	//image fields
	document.getElementById('ca_objects.orientation[]').value ="";
	document.getElementById('_fulltext[]2').value ="";
	document.getElementById('ca_objects.volume[]').value ="";
	//map fields
	document.getElementById('ca_objects.physical_des.extent_type[]').value ="";
	document.getElementById('ca_objects.physical_des.color[]').value ="";
	document.getElementById('ca_objects.physical_notes[]').value ="";
	document.getElementById('ca_objects.scope_theme[]').value ="";
	document.getElementById('_fulltext[]3').value ="";
	document.getElementById('ca_objects.map_group[]2').selectedIndex=0;
	
	$('#adding').find('span').remove();
	
	//text fields
	document.getElementById('ca_objects.location.loc_box[]').value ="";
	document.getElementById('ca_objects.location.folder_num[]').value ="";
	//series dropdown
	
	
	}
else if (val == 23){
	document.getElementById('MapSearch').style ='display:none';
	document.getElementById('PhotoSearch').style ='display:block';
	document.getElementById('TextSearch').style ='display:none';
	document.getElementById('AudioSearch').style ='display:none';
	document.getElementById('MovingImageSearch').style ='display:none';
	document.getElementById('allseries').style ='display:none';
	document.getElementById('imageseries').style ='display:block';
	document.getElementById('mapseries').style ='display:none';
	document.getElementById('textseries').style ='display:none';
	document.getElementById('ca_collections_idno1').name = "ca_collections.idno";
	//map fields
	document.getElementById('ca_objects.physical_des.extent_type[]').value ="";
	document.getElementById('ca_objects.physical_des.color[]').value ="";
	document.getElementById('ca_objects.physical_notes[]').value ="";
	document.getElementById('ca_objects.scope_theme[]').value ="";
	document.getElementById('_fulltext[]3').value ="";
	document.getElementById('ca_objects.map_group[]2').selectedIndex=0;
	document.getElementById('ca_objects.location.loc_box[]').value ="";
	document.getElementById('ca_objects.location.folder_num[]').value ="";
	$('#adding').find('span').remove();
	$('allseries').find('div').remove();
	
	
}
else if (val == 24){
	document.getElementById('MapSearch').style ='display:none';
	document.getElementById('PhotoSearch').style ='display:none';
	document.getElementById('TextSearch').style ='display:none';
	document.getElementById('AudioSearch').style ='display:none';
	document.getElementById('MovingImageSearch').style ='display:block';
	document.getElementById('allseries').style ='display:none';
	document.getElementById('imageseries').style ='display:none';
	document.getElementById('mapseries').style ='display:none';
	document.getElementById('textseries').style ='display:none';
}

else if (val == 25)
	{
	document.getElementById('MapSearch').style ='display:none';
	document.getElementById('PhotoSearch').style ='display:none';
	document.getElementById('TextSearch').style ='display:block';
	document.getElementById('AudioSearch').style ='display:none';
	document.getElementById('MovingImageSearch').style ='display:none';
	document.getElementById('allseries').style ='display:none';
	document.getElementById('imageseries').style ='display:none';
	document.getElementById('mapseries').style ='display:none';
	document.getElementById('textseries').style ='display:block';
	//image fields
	document.getElementById('ca_objects.orientation[]').value ="";
	document.getElementById('_fulltext[]2').value ="";
	document.getElementById('ca_objects.volume[]').value ="";
	//map fields
	document.getElementById('ca_objects.physical_des.extent_type[]').value ="";
	document.getElementById('ca_objects.physical_des.color[]').value ="";
	document.getElementById('ca_objects.physical_notes[]').value ="";
	document.getElementById('ca_objects.scope_theme[]').value ="";
	document.getElementById('_fulltext[]3').value ="";
	document.getElementById('ca_objects.map_group[]2').selectedIndex=0;
	$('#adding').find('span').remove();
	document.getElementById('image_series').style ='display:none';
	document.getElementById('map_series').style ='display:none';
	document.getElementById('text_series').style ='display:block';
	
	
	
}

else if (val == 26)
	{
	document.getElementById('mapseries').style ='display:block';
	document.getElementById('MapSearch').style ='display:block';
	document.getElementById('PhotoSearch').style ='display:none';
	document.getElementById('TextSearch').style ='display:none';
	document.getElementById('AudioSearch').style ='display:none';
	document.getElementById('MovingImageSearch').style ='display:none';
	document.getElementById('allseries').style ='display:none';
	document.getElementById('imageseries').style ='display:none';
	
	document.getElementById('textseries').style ='display:none';
	//image fields
	document.getElementById('ca_objects.orientation[]').value ="";
	document.getElementById('_fulltext[]2').value ="";
	document.getElementById('ca_objects.volume[]').value ="";
	
	//text fields
	document.getElementById('ca_objects.location.loc_box[]').value ="";
	document.getElementById('ca_objects.location.folder_num[]').value ="";
	//series dropdown
	document.getElementById('image_series').style ='display:none';
	document.getElementById('map_series').style ='display:block';
	document.getElementById('text_series').style ='display:none';
	
}

else if (val == 28)
	{
	document.getElementById('MapSearch').style ='display:none';
	document.getElementById('PhotoSearch').style ='display:none';
	document.getElementById('TextSearch').style ='display:none';
	document.getElementById('AudioSearch').style ='display:block';
	document.getElementById('MovingImageSearch').style ='display:none';
	document.getElementById('allseries').style ='display:none';
	document.getElementById('imageseries').style ='display:none';


}
}

function checkColl(val) {
	

if (val == 'Olmsted Digital Collection'){
document.getElementById('OlmstedSearch').style ='display:block';}
else{
document.getElementById('OlmstedSearch').style ='display:none';}


}

function checkSearchType(storage) {
if (!storage) {
	document.getElementById('MapSearch').style ='display:none';
	document.getElementById('PhotoSearch').style ='display:none';
	document.getElementById('TextSearch').style ='display:none';
	document.getElementById('AudioSearch').style ='display:none';
	document.getElementById('MovingImageSearch').style ='display:none';
	
}
else if (storage == 23){
document.getElementById('PhotoSearch').style ='display:block';
}
else if (storage == 24){
document.getElementById('MovingImageSearch').style ='display:block';
}
else if (storage == 25){
document.getElementById('TextSearch').style ='display:block';
}
else if (storage == 26){
document.getElementById('MapSearch').style ='display:block';
}
else if (storage == 28){
document.getElementById('AudioSearch').style ='display:block';
}
}

function checkSeries(storage) {
if (String(storage).includes('Olmsted')) {
document.getElementById('OlmstedSearch').style ='display:block';}
else {
document.getElementById('OlmstedSearch').style ='display:none';	
	
}}

function checklastSeries() {
if (document.referrer.includes("collections")) {
	

$('#ca_collections_idno0').val(localStorage.getItem("collection_name"));


}
	
}	


document.getElementById('ca_objects_type_id"').onchange=function(){ checktype(document.getElementById('ca_objects_type_id"').options[document.getElementById('ca_objects_type_id"').selectedIndex].value); }


</script>	
		
		<select id="ca_objects_type_id" name="ca_objects.type_id" onKeyup="checktype(this.options[this.selectedIndex].value);" onchange="document.getElementsByName('ca_objects.map_group[]')[1].selectedIndex =0;checktype(this.options[this.selectedIndex].value);document.getElementById('ca_objects.map_group[]2').selectedIndex=0;$('#adding').find('span').remove();" onclick="checktype(this.options[this.selectedIndex].value);" onunload="checktype(this.options[this.selectedIndex].value);"class="">
<option value="">-</option>
<!--<option value="28">Audio</option>-->
<option value="23"> Image</option>
<option value="26">Map</option>
<!--<option value="24"> Moving Image</option>-->
<!--<option value="24">&nbsp;&nbsp;&nbsp; Moving Image</option>-->


<option value="25"> Textual Record</option>
</select>
<input name="ca_objects.type_id_label" value="Type" type="hidden" >
</div>
</div>



	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search across all fields in the database.">Keyword</span>
			
			{{{_fulltext%width=200px&height=1}}}
			
			
		</div>			
	</div>		
	<div class='row'>
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit your search to Object Titles and Descriptions only.">Title/Description</span>
			{{{ca_objects.preferred_labels.name%width=220px}}}
		</div>
	</div>
	<div class='row'>
		<div class="advancedSearchField col-sm-6">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search object identifiers.">Identifer</span>
			{{{ca_objects.idno%width=210px}}}
		</div>
		
	
	</div>
	
	<div class='row' style="display:none;">
		<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search records of a particular date or date range.">Date range <i>(e.g. 1970-1979)</i></span>
			{{{ca_objects.dates.dates_value%width=200px&height=40px&useDatePicker=0}}}
		</div>
	</div>
	<div class='row'>
	<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search records of a particular date or date range.">Date or Date range <i>(e.g. 1970-1979)</i><br/>
			{{{ca_objects.date.dates_value%width=220px&height=40px&useDatePicker=0}}}
		</div>
		</div>
		<div class='row'>
		
<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Notes">Note</span>
			{{{ca_objects.external_note%width=500px&height=40px}}}
		</div>	
		</div>



	<div class='row'>	
	<div class="advancedSearchField col-sm-12">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Related People/Organizations">Related People/Organizations</span>

			{{{ca_entities.preferred_labels.displayname}}}
		</div>
		</div>
			
<script type='text/javascript'>//<![CDATA[ 


$(window).load(function(){
$(document).ready(function () {
	$.ajax({
        type: "GET",
        url: "http://archives.seattle.gov/digital-collections/media/series_dropdown.xml",
        dataType: "xml",
        success: function (result) {
            $(result).find("p").each(function () {
				if ($(this).attr("id") == localStorage.getItem("collection_name") && document.referrer.includes('Detail/collections')){
                $("#ca_collections_idno0").append($("<option selected />").val($(this).attr("id")).text($(this).attr("id")+": "+$(this).attr("nm")));}
				else {
                $("#ca_collections_idno0").append($("<option />").val($(this).attr("id")).text($(this).attr("id")+": "+$(this).attr("nm")));}
            });
        }
    });
    $.ajax({
        type: "GET",
        url: "http://archives.seattle.gov/digital-collections/media/image_series_dropdown.xml",
        dataType: "xml",
        success: function (result) {
            $(result).find("p").each(function () {
                $("#ca_collections_idno1").append($("<option />").val($(this).attr("id")).text($(this).attr("id")+": "+$(this).attr("nm")));
            });
        }
    });
	$.ajax({
        type: "GET",
        url: "http://archives.seattle.gov/digital-collections/media/map_series_dropdown.xml",
        dataType: "xml",
        success: function (result) {
            $(result).find("p").each(function () {
                $("#ca_collections_idno2").append($("<option />").val($(this).attr("id")).text($(this).attr("id")+": "+$(this).attr("nm")));
            });
        }
    });
	$.ajax({
        type: "GET",
        url: "http://archives.seattle.gov/digital-collections/media/text_series_dropdown.xml",
        dataType: "xml",
        success: function (result) {
            $(result).find("p").each(function () {
                $("#ca_collections_idno3").append($("<option />").val($(this).attr("id")).text($(this).attr("id")+": "+$(this).attr("nm")));
            });
        }
    });
});
});//]]>  

</script>
	

		
		
		

		<div class='row'>
	
	
	

	
		
		

<script>
	
if ((document.referrer.includes('index.php/Detail/collections/')) && (String(localStorage.getItem("collection_name")).includes("Olmsted"))){
document.write('<span id="OlmstedSearch">');}
else {
document.write('<span id="OlmstedSearch" style="display:none">');	
}


</script>	


<div  class="advancedSearchField col-sm-12" style="display:none;">
<h2>Olmsted Search fields:</h2>
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Parks">Parks</span>
			

<select id="_fulltext[]" name="_fulltext[]">
			<OPTION value="">-
			
                    </option><option value="Cowen Park"> Cowen Park
                    </option><option value="Denny Park"> Denny Park
                    </option><option value="Discovery Park"> Discovery Park
                    </option><option value="Fort Lawton"> Fort Lawton
                    </option><option value="Frink Park"> Frink Park
                    </option><option value="Green Lake Park"> Green Lake Park
                    </option><option value="Hamilton Viewpoint"> Hamilton Viewpoint
                    </option><option value="Interlaken Park"> Interlaken Park
                    </option><option value="Kinnear Park"> Kinnear Park
                    </option><option value="Jefferson Park"> Jefferson Park
                    
                    </option><option value="Leschi Park"> Leschi Park
                    </option><option value="Lincoln Park"> Lincoln Park
                    </option><option value="Madison Park"> Madison Park
                    </option><option value="Madrona Park"> Madrona Park
                    </option><option value="Mt. Baker Park"> Mt. Baker Park
                 
                    </option><option value="Schmitz Park"> Schmitz Park
                    </option><option value="Seward Park"> Seward Park
                    </option><option value="Volunteer Park"> Volunteer Park
                    </option><option value="Washington Park"> Washington Park
                    </option><option value="Arboretum">Arboretum
                    </option><option value="Woodland Park"> Woodland Park

                    
                    
                    
                </option></select>
			
			<input name="_fulltext[]" value="" id="_fulltext[]" type="hidden">

		</div>
		
		</span>
		
<span id="allseries" style="display:none">

	<div id="series_dropdown1" class="advancedSearchField col-sm-12" style="display:none">
			Collections
			{{{ca_collections.idno%width=200px&height=40px}}}
		</div>
		<div class="advancedSearchField col-sm-12" >
			<span  class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Series/Collection">Series/Collection</span>
			
			<select id="ca_collections_idno0" onload="checklastSeries()"  onchange="checkSeries(this.value);$(this).attr('name', 'ca_collections.idno');"><OPTION value="">-</select>
			
			<input id="ca_collections_idno" name="ca_collections.idno_label0" value="Collection Number(from related collections)" type="hidden">
		</div>		
		
		

</span>	
<script type="application/javascript">

//document.write(localStorage.getItem("collection_name"));
$("#ca_collections_idno0[value='0204-01']").attr('selected', 'selected');

//$('#ca_collections_idno0').val("0204-01");
//document.write(document.referrer);
</script>
<script>

if (document.referrer.includes("collections")) {
	

$('#ca_collections_idno0').val("0204-01");
//document.getElementById("ca_collections_idno0").value =localStorage.getItem("collection_name");
//document.write("hello");

}else {
	document.getElementById("ca_collections_idno0").value = "";
}

if (document.referrer.includes('maps1.htm')) {

document.getElementById("ca_objects_type_id").value =localStorage.getItem("search_type_id");


}

</script>

<span id="imageseries" style="display:none">

	<div id="series_dropdown2" class="advancedSearchField col-sm-12" style="display:none">
			Collections
			
		</div>
		<div class="advancedSearchField col-sm-12" >
			<span  class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Series/Collection">Series/Collection</span>
			
			<select id="ca_collections_idno1"    onchange="checkSeries(this.value);$(this).attr('name', 'ca_collections.idno');"><OPTION value="">-</select>
			
			<input id="ca_collections_idno" name="ca_collections.idno_label" value="Collection Number(from related collections)" type="hidden">
		</div>	
</span>
<span id="mapseries" style="display:none">

	<div id="series_dropdown" class="advancedSearchField col-sm-12" style="display:none">
			Collections
			
		</div>
		<div class="advancedSearchField col-sm-12" >
			<span  class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Series/Collection">Series/Collection</span>
			
			<select id="ca_collections_idno2"   onchange="checkSeries(this.value);$(this).attr('name', 'ca_collections.idno');"><OPTION value="">-</select>
			
			<input id="ca_collections_idno" name="ca_collections.idno_label" value="Collection Number(from related collections)" type="hidden">
		</div>		
		
		

</span>	
<span id="textseries" style="display:none">

	<div id="series_dropdown" class="advancedSearchField col-sm-12" style="display:none">
			Collections
			
		</div>
		<div class="advancedSearchField col-sm-12" >
			<span  class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Series/Collection">Series/Collection</span>
			
			<select id="ca_collections_idno3" onchange="checkSeries(this.value);$(this).attr('name', 'ca_collections.idno');"><OPTION value="">-</select>
			
			<input id="ca_collections_idno" name="ca_collections.idno_label" value="Collection Number(from related collections)" type="hidden">
		</div>		
		
		

</span>	
		

			
<span id="PhotoSearch" style="display:none">
<div  class="advancedSearchField col-sm-12">
<h2>Image only fields:</h2>



			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Orientation">Orientation</span>

			{{{ca_objects.orientation%width=210px}}}
		</div>
		
		<div class="advancedSearchField col-sm-12">
		<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Geographical Area/Neighborhoods">Geographical Area/Neighborhoods</span>


<select id="_fulltext[]2" name="_fulltext[]">
			<OPTION value="">-
			
					<OPTION value="ADAMS">ADAMS
				
			<OPTION value="ALKI">ALKI 
			<OPTION value="ARBOR HEIGHTS">ARBOR HEIGHTS
			<OPTION value="ATLANTIC">ATLANTIC
			<OPTION value="BALLARD">BALLARD
			<OPTION value="BEACON HILL">BEACON HILL
			<OPTION value="BELLTOWN">BELLTOWN
			<OPTION value="BITTER LAKE">BITTER LAKE
			<OPTION value="BLUE RIDGE">BLUE RIDGE 
			<OPTION value="BRIARCLIFF">BRIARCLIFF 
			<OPTION value="BRIGHTON">BRIGHTON 
			<OPTION value="BROADVIEW">BROADVIEW 
			<OPTION value="BROADWAY">BROADWAY 
			<OPTION value="BRYANT">BRYANT 
			<OPTION value="CAPITOL HILL">CAPITOL HILL 
			<OPTION value="CASCADE">CASCADE  
			<OPTION value="CEDAR PARK">CEDAR PARK 
			<OPTION value="CENTRAL AREA">CENTRAL AREA  
			<OPTION value="CENTRAL BUSINESS DISTRICT">CENTRAL BUSINESS DISTRICT 
			<OPTION value="CENTRAL WATERFRONT">CENTRAL WATERFRONT 
			<OPTION value="COLUMBIA CITY">COLUMBIA CITY 
			<OPTION value="CROWN HILL">CROWN HILL 
			<OPTION value="DELRIDGE">DELRIDGE 
			<OPTION value="DENNY BLAINE">DENNY BLAINE 
			<OPTION value="DENNY REGRADE">DENNY REGRADE 
			<OPTION value="DOWNTOWN">DOWNTOWN 
			<OPTION value="DUNLAP">DUNLAP  
			<OPTION value="EAST QUEEN ANNE">EAST QUEEN ANNE 
			<OPTION value="EASTLAKE">EASTLAKE  
			<OPTION value="FAIRMOUNT PARK">FAIRMOUNT PARK 
			<OPTION value="FAIRVIEW">FAIRVIEW 
			<OPTION value="FAUNTLEROY">FAUNTLEROY 
			<OPTION value="FIRST HILL">FIRST HILL 
			<OPTION value="FREMONT">FREMONT  
			<OPTION value="GATEWOOD">GATEWOOD 
			<OPTION value="GENESEE">GENESEE 
			<OPTION value="GEORGETOWN">GEORGETOWN 
			<OPTION value="GREEN LAKE">GREEN LAKE 
			<OPTION value="GREENWOOD">GREENWOOD  
			<OPTION value="HALLER LAKE">HALLER LAKE 
			<OPTION value="HARBOR ISLAND">HARBOR ISLAND 
			<OPTION value="HARRISON">HARRISON 
			<OPTION value="HIGH POINT">HIGH POINT 
			<OPTION value="HIGHLAND PARK">HIGHLAND PARK  
			<OPTION value="HOLLY PARK">HOLLY PARK 
			<OPTION value="INDUSTRIAL DISTRICT">INDUSTRIAL DISTRICT 
			<OPTION value="INTERBAY">INTERBAY 
			<OPTION value="INTERNATIONAL DISTRICT">INTERNATIONAL DISTRICT  
			<OPTION value="JUNCTION">JUNCTION 
			<OPTION value="LAKE CITY">LAKE CITY 
			<OPTION value="LAURELHURST">LAURELHURST 
			<OPTION value="LAWTON PARK">LAWTON PARK 
			<OPTION value="LESCHI">LESCHI  
			<OPTION value="LOWER QUEEN ANNE">LOWER QUEEN ANNE 
			<OPTION value="LOYAL HEIGHTS">LOYAL HEIGHTS 
			<OPTION value="MADISON PARK">MADISON PARK 
			<OPTION value="MADRONA">MADRONA 
			<OPTION value="MAGNOLIA">MAGNOLIA 
			<OPTION value="MANN">MANN 
			<OPTION value="MAPLE LEAF">MAPLE LEAF  
			<OPTION value="MATTHEWS BEACH">MATTHEWS BEACH 
			<OPTION value="MEADOWBROOK">MEADOWBROOK 
			<OPTION value="MID BEACON HILL">MID BEACON HILL 
			<OPTION value="MINOR">MINOR 
			<OPTION value="MONTLAKE">MONTLAKE 
			<OPTION value="MOUNT BAKER">MOUNT BAKER  
			<OPTION value="NORTH ADMIRAL">NORTH ADMIRAL  
			<OPTION value="NORTH BEACH">NORTH BEACH 
			<OPTION value="NORTH BEACON HILL">NORTH BEACON HILL 
			<OPTION value="NORTH COLLEGE PARK">NORTH COLLEGE PARK 
			<OPTION value="NORTH DELRIDGE">NORTH DELRIDGE 
			<OPTION value="NORTH QUEEN ANNE">NORTH QUEEN ANNE 
			<OPTION value="NORTHGATE">NORTHGATE 
			<OPTION value="OLYMPIC HILLS">OLYMPIC HILLS 
			<OPTION value="PHINNEY RIDGE">PHINNEY RIDGE 
			<OPTION value="PIKE MARKET">PIKE MARKET  
			<OPTION value="PINEHURST">PINEHURST 
			<OPTION value="PIONEER SQUARE">PIONEER SQUARE  
			<OPTION value="PORTAGE BAY NEIGHBORHOOD">PORTAGE BAY NEIGHBORHOOD 
			<OPTION value="QUEEN ANNE">QUEEN ANNE 
			<OPTION value="RAINIER BEACH">RAINIER BEACH 
			<OPTION value="RAINIER VALLEY">RAINIER VALLEY 
			<OPTION value="RAINIER VIEW">RAINIER VIEW 
			<OPTION value="RAVENNA">RAVENNA  
			<OPTION value="RIVERVIEW">RIVERVIEW 
			<OPTION value="ROOSEVELT">ROOSEVELT  
			<OPTION value="ROXHILL">ROXHILL 
			<OPTION value="SAND POINT">SAND POINT 
			<OPTION value="SEAVIEW">SEAVIEW 
			<OPTION value="SEWARD PARK NEIGHBORHOOD">SEWARD PARK NEIGHBORHOOD  
			<OPTION value="SOUTH BEACON HILL">SOUTH BEACON HILL 
			<OPTION value="SOUTH DELRIDGE">SOUTH DELRIDGE 
			<OPTION value="SOUTH LAKE UNION">SOUTH LAKE UNION 
			<OPTION value="SOUTH PARK">SOUTH PARK 
			<OPTION value="SOUTHEAST MAGNOLIA">SOUTHEAST MAGNOLIA 
			<OPTION value="STEVENS">STEVENS  
			<OPTION value="SUNSET HILL">SUNSET HILL 
			<OPTION value="UNIVERSITY DISTRICT">UNIVERSITY DISTRICT  
			<OPTION value="VICTORY HEIGHTS">VICTORY HEIGHTS 
			<OPTION value="VIEW RIDGE">VIEW RIDGE 
			<OPTION value="WALLINGFORD">WALLINGFORD 
			<OPTION value="WEDGEWOOD">WEDGEWOOD  
			<OPTION value="WEST QUEEN ANNE">WEST QUEEN ANNE 
			<OPTION value="WEST SEATTLE">WEST SEATTLE 
			<OPTION value="WEST WOODLAND">WEST WOODLAND 
			<OPTION value="WESTLAKE">WESTLAKE 
			<OPTION value="WHITTIER HEIGHTS">WHITTIER HEIGHTS 
			<OPTION value="WINDERMERE">WINDERMERE 
			<OPTION value="YESLER TERRACE">YESLER TERRACE 
			</select>
			
			<input name="_fulltext[]" value="" id="_fulltext[]" type="hidden">

		</div>
	<!--	<div class="advancedSearchField col-sm-12">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Color Mode">Color Mode</span>

			{{{ca_objects.color_mode}}}
		</div>-->

		<div class="advancedSearchField col-sm-12">

<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Volume">Volume</span>

			
			{{{ca_objects.volume}}}
		</div>
<!--		<div class="advancedSearchField col-sm-12">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Photographer">Photographer</span>
			{{{ca_entities.preferred_labels.displayname/photographer}}}
			<input name="ca_entities.preferred_labels.displayname/photographer_label" value="Photographer" type="hidden">
		</div>-->
		
	</div>	
	</span>
	<span id="MapSearch" style="display:none" ><h2>Map only fields:</h2>
	
<div class="advancedSearchField" style="display:none">
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit Search to">Limit search to</span>

			{{{ca_objects.map_group%width=220px}}}
			<input name="ca_objects.map_group_label" value="Limit search to" type="hidden">
		</div>	
	<div class="advancedSearchField">
	<span class="formLabel" data-toggle="popover" data-trigger="hover" data-content="Search Map Group" data-original-title="" title="">Limit search to</span>
	
<select id="ca_objects.map_group[]" name="ca_objects.map_group[]" onclick="checkmap_group(this.selectedIndex)" onchange="checkmap_group(this.selectedIndex)">
<option value="" selected="1">-</option>
<option value="7417" >&nbsp;&nbsp;&nbsp; All maps except CRWS Maps, Pole Maps and Zoning Map sets</option>
<option value="7418">&nbsp;&nbsp;&nbsp; Cedar River Watershed Maps</option>
<option value="7419">&nbsp;&nbsp;&nbsp; All Zoning Maps</option>
<option value="7419">&nbsp;&nbsp;&nbsp; 1923 Zoning Maps</option>
<option value="7419">&nbsp;&nbsp;&nbsp; 1947 Zoning Maps</option>
<option value="7419">&nbsp;&nbsp;&nbsp; 1961 Zoning Maps</option>
<option value="7419">&nbsp;&nbsp;&nbsp; 1973 Zoning Maps</option>
</select>
<input name="ca_objects.map_group[]" value="" id="ca_objects.map_group[]" type="hidden">

	<input name="ca_objects.map_group_label" value="Limit search to" type="hidden">	
		</div>
	

<div class="advancedSearchField" style="display:none" >
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Limit Search to"></span>

			{{{ca_objects.date_lc.date_value%width=220px}}}
			<input name="ca_objects.map_group_label" value="Limit search to" type="hidden">
		</div>	
<span id="adding" style="display:none"></span>	

		<script>	

function checkmap_group(val) {
if (val == 0) {
	$('#adding').find('span').remove();
}
if (val == 1) {
	$('#adding').find('span').remove();
}
if (val == 2) {
	$('#adding').find('span').remove();
}
if (val == 3) {
	$('#adding').find('span').remove();
}
if (val == 4){

$('#adding').find('span').remove();
$('#adding').append('<span><input name="ca_objects.date.dates_value[]" id="ca_objects.date.dates_value[]" value="1923" maxlength="255" class="dateBg" rows="1" style="width: 220px;" size="" type="text"></span>');
}


if (val == 5){

$('#adding').find('span').remove();
$('#adding').append('<span><input name="ca_objects.date.dates_value[]" id="ca_objects.date.dates_value[]" value="1947" maxlength="255" class="dateBg" rows="1" style="width: 220px;" size="" type="text"></span>');
}
if (val == 6){

$('#adding').find('span').remove();
$('#adding').append('<span><input name="ca_objects.date_lc.date_value[]" id="ca_objects.date_lc.date_value[]" value="1961" maxlength="255" class="dateBg" rows="1" style="width: 220px;" size="" type="text"></span>');
}
if (val == 7){

$('#adding').find('span').remove();
$('#adding').append('<span><input name="ca_objects.date.dates_value[]" id="ca_objects.date.dates_value[]" value="1973" maxlength="255" class="dateBg" rows="1" style="width: 220px;" size="" type="text"></span>');
}
}
</script>

	<script>
	

	
	//document.onload=document.write(document.getElementsByName("ca_objects.map_group[]")[1].selectedIndex);
	document.getElementsByName("ca_objects.map_group[]")[0].selectedIndex =0;
	
	</script>
	
	<div class="advancedSearchField">
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Extent Type">Extent Type</span>

			{{{ca_objects.physical_des.extent_type%width=220px}}}
			<input name="ca_objects.physical_des.extent_type_label" value="Map Type" type="hidden">
		</div>
	
	<!--<div class="advancedSearchField">
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Color">Color</span>
		{{{ca_objects.physical_des.color%width=220px}}}
		<input name="ca_objects.physical_des.color_label" value="Map Color" type="hidden">
		</div>-->
	<div class="advancedSearchField">
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Map Medium">Map Medium</span>

			{{{ca_objects.physical_notes%width=220px}}}
		</div>
		
		
		
	
		
	<div class="advancedSearchField">
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Scope\Theme">Scope\Theme</span>


			{{{ca_objects.scope_theme%width=420px}}}
			
		</div>
		
	
	<div class="advancedSearchField">
		<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Geographical Area/Neighborhoods">Geographical Area/Neighborhoods</span>


<select id="_fulltext[]3" name="_fulltext[]">
			<OPTION value="">-
			
					<OPTION value="ADAMS">ADAMS
				
			<OPTION value="ALKI">ALKI 
			<OPTION value="ARBOR HEIGHTS">ARBOR HEIGHTS
			<OPTION value="ATLANTIC">ATLANTIC
			<OPTION value="BALLARD">BALLARD
			<OPTION value="BEACON HILL">BEACON HILL
			<OPTION value="BELLTOWN">BELLTOWN
			<OPTION value="BITTER LAKE">BITTER LAKE
			<OPTION value="BLUE RIDGE">BLUE RIDGE 
			<OPTION value="BRIARCLIFF">BRIARCLIFF 
			<OPTION value="BRIGHTON">BRIGHTON 
			<OPTION value="BROADVIEW">BROADVIEW 
			<OPTION value="BROADWAY">BROADWAY 
			<OPTION value="BRYANT">BRYANT 
			<OPTION value="CAPITOL HILL">CAPITOL HILL 
			<OPTION value="CASCADE">CASCADE  
			<OPTION value="CEDAR PARK">CEDAR PARK 
			<OPTION value="CENTRAL AREA">CENTRAL AREA  
			<OPTION value="CENTRAL BUSINESS DISTRICT">CENTRAL BUSINESS DISTRICT 
			<OPTION value="CENTRAL WATERFRONT">CENTRAL WATERFRONT 
			<OPTION value="COLUMBIA CITY">COLUMBIA CITY 
			<OPTION value="CROWN HILL">CROWN HILL 
			<OPTION value="DELRIDGE">DELRIDGE 
			<OPTION value="DENNY BLAINE">DENNY BLAINE 
			<OPTION value="DENNY REGRADE">DENNY REGRADE 
			<OPTION value="DOWNTOWN">DOWNTOWN 
			<OPTION value="DUNLAP">DUNLAP  
			<OPTION value="EAST QUEEN ANNE">EAST QUEEN ANNE 
			<OPTION value="EASTLAKE">EASTLAKE  
			<OPTION value="FAIRMOUNT PARK">FAIRMOUNT PARK 
			<OPTION value="FAIRVIEW">FAIRVIEW 
			<OPTION value="FAUNTLEROY">FAUNTLEROY 
			<OPTION value="FIRST HILL">FIRST HILL 
			<OPTION value="FREMONT">FREMONT  
			<OPTION value="GATEWOOD">GATEWOOD 
			<OPTION value="GENESEE">GENESEE 
			<OPTION value="GEORGETOWN">GEORGETOWN 
			<OPTION value="GREEN LAKE">GREEN LAKE 
			<OPTION value="GREENWOOD">GREENWOOD  
			<OPTION value="HALLER LAKE">HALLER LAKE 
			<OPTION value="HARBOR ISLAND">HARBOR ISLAND 
			<OPTION value="HARRISON">HARRISON 
			<OPTION value="HIGH POINT">HIGH POINT 
			<OPTION value="HIGHLAND PARK">HIGHLAND PARK  
			<OPTION value="HOLLY PARK">HOLLY PARK 
			<OPTION value="INDUSTRIAL DISTRICT">INDUSTRIAL DISTRICT 
			<OPTION value="INTERBAY">INTERBAY 
			<OPTION value="INTERNATIONAL DISTRICT">INTERNATIONAL DISTRICT  
			<OPTION value="JUNCTION">JUNCTION 
			<OPTION value="LAKE CITY">LAKE CITY 
			<OPTION value="LAURELHURST">LAURELHURST 
			<OPTION value="LAWTON PARK">LAWTON PARK 
			<OPTION value="LESCHI">LESCHI  
			<OPTION value="LOWER QUEEN ANNE">LOWER QUEEN ANNE 
			<OPTION value="LOYAL HEIGHTS">LOYAL HEIGHTS 
			<OPTION value="MADISON PARK">MADISON PARK 
			<OPTION value="MADRONA">MADRONA 
			<OPTION value="MAGNOLIA">MAGNOLIA 
			<OPTION value="MANN">MANN 
			<OPTION value="MAPLE LEAF">MAPLE LEAF  
			<OPTION value="MATTHEWS BEACH">MATTHEWS BEACH 
			<OPTION value="MEADOWBROOK">MEADOWBROOK 
			<OPTION value="MID BEACON HILL">MID BEACON HILL 
			<OPTION value="MINOR">MINOR 
			<OPTION value="MONTLAKE">MONTLAKE 
			<OPTION value="MOUNT BAKER">MOUNT BAKER  
			<OPTION value="NORTH ADMIRAL">NORTH ADMIRAL  
			<OPTION value="NORTH BEACH">NORTH BEACH 
			<OPTION value="NORTH BEACON HILL">NORTH BEACON HILL 
			<OPTION value="NORTH COLLEGE PARK">NORTH COLLEGE PARK 
			<OPTION value="NORTH DELRIDGE">NORTH DELRIDGE 
			<OPTION value="NORTH QUEEN ANNE">NORTH QUEEN ANNE 
			<OPTION value="NORTHGATE">NORTHGATE 
			<OPTION value="OLYMPIC HILLS">OLYMPIC HILLS 
			<OPTION value="PHINNEY RIDGE">PHINNEY RIDGE 
			<OPTION value="PIKE MARKET">PIKE MARKET  
			<OPTION value="PINEHURST">PINEHURST 
			<OPTION value="PIONEER SQUARE">PIONEER SQUARE  
			<OPTION value="PORTAGE BAY NEIGHBORHOOD">PORTAGE BAY NEIGHBORHOOD 
			<OPTION value="QUEEN ANNE">QUEEN ANNE 
			<OPTION value="RAINIER BEACH">RAINIER BEACH 
			<OPTION value="RAINIER VALLEY">RAINIER VALLEY 
			<OPTION value="RAINIER VIEW">RAINIER VIEW 
			<OPTION value="RAVENNA">RAVENNA  
			<OPTION value="RIVERVIEW">RIVERVIEW 
			<OPTION value="ROOSEVELT">ROOSEVELT  
			<OPTION value="ROXHILL">ROXHILL 
			<OPTION value="SAND POINT">SAND POINT 
			<OPTION value="SEAVIEW">SEAVIEW 
			<OPTION value="SEWARD PARK NEIGHBORHOOD">SEWARD PARK NEIGHBORHOOD  
			<OPTION value="SOUTH BEACON HILL">SOUTH BEACON HILL 
			<OPTION value="SOUTH DELRIDGE">SOUTH DELRIDGE 
			<OPTION value="SOUTH LAKE UNION">SOUTH LAKE UNION 
			<OPTION value="SOUTH PARK">SOUTH PARK 
			<OPTION value="SOUTHEAST MAGNOLIA">SOUTHEAST MAGNOLIA 
			<OPTION value="STEVENS">STEVENS  
			<OPTION value="SUNSET HILL">SUNSET HILL 
			<OPTION value="UNIVERSITY DISTRICT">UNIVERSITY DISTRICT  
			<OPTION value="VICTORY HEIGHTS">VICTORY HEIGHTS 
			<OPTION value="VIEW RIDGE">VIEW RIDGE 
			<OPTION value="WALLINGFORD">WALLINGFORD 
			<OPTION value="WEDGEWOOD">WEDGEWOOD  
			<OPTION value="WEST QUEEN ANNE">WEST QUEEN ANNE 
			<OPTION value="WEST SEATTLE">WEST SEATTLE 
			<OPTION value="WEST WOODLAND">WEST WOODLAND 
			<OPTION value="WESTLAKE">WESTLAKE 
			<OPTION value="WHITTIER HEIGHTS">WHITTIER HEIGHTS 
			<OPTION value="WINDERMERE">WINDERMERE 
			<OPTION value="YESLER TERRACE">YESLER TERRACE 
			</select>
			
			<input name="_fulltext[]" value="" id="_fulltext[]" type="hidden">

		</div>
<!--	<div class="advancedSearchField">
	<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Map author">Map author</span>
			{{{ca_entities.preferred_labels.displayname/author}}}
			<input name="ca_entities.preferred_labels.displayname/author_label" value="Author" type="hidden">

		</div>-->
	</span>
	<div>
	
<span id="TextSearch" style="display:none" ><h2>Textual Record only fields:</h2>
<!--
<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Creator">Creator</span>
			{{{ca_entities.preferred_labels.displayname/creator}}}
			<input name="ca_entities.preferred_labels.displayname/creator_label" value="Creator" type="hidden">
		</div>
-->
<div class="advancedSearchField" style="width:60px">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Box">Box</span>
			{{{ca_objects.location.loc_box%width=50px&height=27px}}}
			<input name="ca_objects.location.loc_box_label" value="Box" type="hidden">
			</div>
			<div class="advancedSearchField">
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Folder">Folder</span>

			{{{ca_objects.location.folder_num%width=50px&height=27px}}}
			<input name="ca_objects.location.folder_num_label" value="Folder" type="hidden">
		</div>
		
</span>

<span id="MovingImageSearch" style="display:none" ><h2>Moving Image only fields:</h2>

<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Credits">Credits</span>
		
			{{{ca_objects.main_description_credits}}}
		</div>

<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Produced(location)">Produced(location)</span>

			{{{ca_objects.place}}}
		</div><br><br><br>

<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Moving Image Type">Moving Image Type</span>

			{{{ca_objects.mi_nature}}}
		</div><br><br><br>
<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Physical formats">Physical formats</span>

			{{{ca_objects.physical_carrier.media_Type}}}
		</div><br><br><br>
<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Digital formats">Digital formats</span>

			{{{ca_objects.vi_file.do_file_type}}}
		</div>
</span>

<span id="AudioSearch" style="display:none" >
<div class="advancedSearchField ">
<h2>Audio only fields:</h2>
			<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Speakers">Speakers</span>

			{{{ca_entities.preferred_labels.displayname/speaker}}}
		</div>
		<div class="advancedSearchField">
		<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Recordist">Recordist</span>
			{{{ca_entities.preferred_labels.displayname/recording_engineer}}}
		</div>

<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Body Name">Body Name</span>

			{{{ca_objects.body_name}}}
		</div>


<div class="advancedSearchField">
<span class='formLabel' data-toggle="popover" data-trigger="hover" data-content="Search Event Name">Event Name</span>


<select id="ca_objects.event_name[]_autocomplete" name="ca_objects.event_name_autocomplete">
                    <option value="" selected="1"> All
					
                 
                  
                    
                    
                    
                </option><option value="Annual Message of the Mayor">Annual Message of the Mayor</option><option value="Board Meeting">Board Meeting</option><option value="Commission meeting">Commission meeting</option><option value="Committee Meeting">Committee Meeting</option><option value="Conference">Conference</option><option value="Confirmation Hearing">Confirmation Hearing</option><option value="Council Briefing">Council Briefing</option><option value="Council Meeting">Council Meeting</option><option value="County Council Meeting">County Council Meeting</option><option value="Forum">Forum</option><option value="Full Council Meeting">Full Council Meeting</option><option value="Interview">Interview</option><option value="Interviews">Interviews</option><option value="Joint City/County Meeting">Joint City/County Meeting</option><option value="Joint committee meeting">Joint committee meeting</option><option value="Joint Hearing">Joint Hearing</option><option value="Mayor Charles Royer">Mayor Charles Royer</option><option value="Mayor's Address">Mayor's Address</option><option value="Panel Meeting">Panel Meeting</option><option value="Press Conference">Press Conference</option><option value="Public Forum">Public Forum</option><option value="Public Hearing">Public Hearing</option><option value="Retreat">Retreat</option><option value="Special  Meeting">Special  Meeting</option><option value="Special meeting">Special meeting</option><option value="Steering Team Meeting">Steering Team Meeting</option><option value="Task Force Meeting">Task Force Meeting</option><option value="Testimony">Testimony</option><option value="Town Hall">Town Hall</option><option value="Unknown">Unknown</option><option value="Walking Tour">Walking Tour</option><option value="Workshop">Workshop</option><option value="Zoning hearing ">Zoning hearing </option></select>
<input name="ca_objects.event_name[" value="" id="ca_objects.event_name[]" type="hidden">
</div>			
		
		</div>
		
		

			
	
	<br style="clear: both;"/>
	<div class='advancedFormSubmit'>
		<span class='btn btn-default'>{{{reset%label=Reset}}}</span>
		<span class='btn btn-default' style="margin-left: 20px;">{{{submit%label=Search}}}</span>
		
	</div>
	</div>
	
	

{{{/form}}}

	</div>

	<div class="col-sm-4" >
		<h1>Quick Tips:</h1>
			<p>Searching can be done either through the advanced search form or the search box above. Selecting different formats will show additional search fields specific to those formats. </p>
			<p>In some cases, the search box may allow for constructing more complex searches. For a full walk-through of how to use the SMA Digital Collections site,  click <a href="http://archives.seattle.gov/SMAWalkThrough.pdf">here</a>.</p>
			<h2>Wildcards</h2>
			<p>The asterisk ("*") is used as a wildcard character. That is, it matches any text. Wildcards may only be used at the end of a word, to match words that start your search term.<p>

			<h2>Searching on dates</h2>
			<p> Use "#" before the date for exact matches. Searches can be done with most common formats including date ranges--click <a href="#" onClick="document.getElementById('date_explain').style ='display:block;padding:5px;background-color: #e7e7e7';">here</a> for examples.  </p>
<span id="date_explain" style="display:none;" >
<a href="#" style="padding-left:98%;" onClick="document.getElementById('date_explain').style ='display:none';">X</a>
<p>You may search on dates in any of these formats:</p>
<li>Year: 2007</li>
<li>Month and year:  June 2007, 6/2007</li>
<li>Specific date:  June 6 2007; June 7, 2007; 6/7/2007; 6/7/07; 2007-06-06</li>
<li>Date with 24 hour time:	June 7, 2007 16:43; 6/7/2007 @ 16:43; June 7 2007 at 16:43</li>
<li>Date with 12 hour time:	June 7, 2007 4:43:03pm; 6/7/2007 @ 4:43:03p.m.</li><br>

Imprecise Dates:
<li>June 10 1955 ~ 10d (June 10th 1955 plus or minus 10 days)</li>
<li> 1955 ~ 3y (1955 plus or minus 3 years)</li>
<br>

<p>For Date Ranges use:
to, -, and, .., through or from, between</p>	
<p>Examples:</p>

<li>June 5, 2007 - June 15, 2007</li>
<li>Between June 5, 2007 and June 15 2007</li>
<li>From 6/5/2007 to 6/15/2007</li>
<li>6/5/2007 @ 9am .. 6/5/2007 @ 5pm</li>
<li>6/5 .. 6/15/2007  (Note implicit year in first date)</li>
<li>6/5 at 9am - 5pm (Note implicit date in current year with range of times)</li><br>


<p>Matching is by default very loose: items with any overlap will be returned. You can restrict matching to items with dates that are completely encompassed by your search date by prepending a "#" to your search data. Eg. "#May 10 2005"</p>
	</p>
</span>		
	</div><!-- end col -->
</div><!-- end row -->

<script>
	jQuery(document).ready(function() {
		$('.advancedSearchField .formLabel').popover(); 
	});
	
</script>