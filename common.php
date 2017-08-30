<?php
function load_template($template, $current_nav = ""){
	//Get navigation menu items
	$countries = get_countries_and_regions();
	
	$suppliers = get_suppliers();
	
	include('templates/header.php');
	include('templates/nav.php');
	include('templates/'.$template.'.php');
	include('templates/footer.php');
}

//Basic sanitization. Not putting too much since it's a test app/.
function sanitize_post($index, $default = "") {
	if (!isset($_POST[$index]))
		return $default;
	else
		return trim(substr($_POST[$index], 0, 1024));
}
function sanitize_get($index, $default = "") {
	if (!isset($_GET[$index]))
		return $default;
	else
		return trim(substr($_GET[$index], 0, 1024));
}

function get_countries_and_regions() {
	$db = new db();
	
	//Get all of the countries first
	$sql = "SELECT
						c.CountryID AS country_id,
						c.CountryName AS country_name
					FROM
						Country AS c
					ORDER BY
						c.CountryName ASC";
						
	$countries = $db->fetch_all_results($sql);
	
	//Loop over all countries and build a secondary array with its regions
	for ( $i = 0; $i < count($countries); $i++ ) {
		$sql = "SELECT
							r.regionID AS region_id,
							r.regionName AS region_name
						FROM
							Regions AS r
						WHERE
							r.regionCountryID = :country_id";
		$params[':country_id'] = $countries[$i]['country_id'];
		$regions = $db->fetch_all_results($sql, $params);
		$countries[$i]['regions'] = $regions;
	}
	
	$db = null;
	
	return $countries;
}

function get_suppliers() {
	$db = new db();
	
	$sql = "SELECT
						s.suppID AS supplier_id,
						s.suppName AS supplier_name
					FROM
						Suppliers AS s
					ORDER BY
						s.suppName ASC";
						
	$suppliers = $db->fetch_all_results($sql);
	$db = null;
	
	return $suppliers;
}
?>