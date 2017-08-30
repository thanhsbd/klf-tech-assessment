<?php
require "constants.inc";
require "common.php";
require "db.php";

//Set the current navigation based on the route
if (isset($_GET['route']) && !empty($_GET['route'])) {
	//Explode the route to get the root (parent) view so that we can highlight that as the current page on the navigation
	$route = explode('/', $_GET['route']);
	
	//Basic switch statement to find out the template to load based on the exact route that was given. By default, it should go to a 404 page but for now we'll direct it to the wine_list page
	//Could be more dynamic but for the sake of this project, it'll do.
	switch($_GET['route']) {
		case "wine":
			load_template('wine_list', $route[0]);
			break;
				
		case "wine/product":
			load_template('wine_product', $route[0]);
			break;
				
		case "wine/add":
			load_template('wine_add', $route[0]);
			break;
				
		case "supplier":
			load_template('supplier', $route[0]);
			break;
				
		case "region":
			load_template('region', $route[0]);
			break;
		
		default:
			load_template('wine_list', $route[0]);
			break;
	}
}
//By default, load the wine_list template
else{
	load_template('wine_list', "wine");
}

?>