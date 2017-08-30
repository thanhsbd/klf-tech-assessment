<?php
require "constants.inc";
require "common.php";
require "db.php";

//Get parameters from POST
$params[':product_name'] = sanitize_post('product_name');
$params[':product_format'] = sanitize_post('product_format');
$params[':product_price_sell'] = sanitize_post('product_price_sell');
$params[':product_color_id'] = sanitize_post('product_color_id', null);

//Set other not-null parameters
$params[':product_sold_out'] = 0;
$params[':product_available'] = 1; //All other products are set to 0 but I'm assuming that 1 should be the default value?
$params[':product_pack'] = 6;


$db = new db();

//Insert into DB
$sql = "INSERT INTO
					Products
				SET
					prodName = :product_name,
					prodFormat = :product_format,
					prodSellPrice = :product_price_sell,
					prodColorID = :product_color_id,
					prodPack = :product_pack,
					prodSoldOut = :product_sold_out,
					prodAvailable = :product_available;";
	
$db->execute_query($sql, $params);

$product_id = $db->last_insert_id();

header('Location:index.php?route=wine/product&product_id='.$product_id);
?>