<?php
require "constants.inc";
require "common.php";
require "db.php";

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];

//Very stripped down API that gets just the product fields based on the product_id passed via GET.
switch($method) {
	case "GET":
		$product_id = trim(preg_replace("/[^0-9]/", "", substr(sanitize_get('product_id'), 0, 10)));

		$db = new db();

		$sql = "SELECT
							p.prodID as product_id,
							p.prodNum as product_num,
							p.prodName as product_name,
							p.prodFormat as product_format,
							p.prodPack as product_pack,
							p.prodDateBuy as product_date_buy,
							p.prodQtyBuy as product_qty_buy,
							p.prodPriceBuy as product_price_buy,
							p.prodComment as product_comment,
							p.prodSellPrice as product_sell_price,
							p.prodSoldOut as product_sold_out,
							c.colprodDesc as color_name,
							r.regionName as region_name,
							cn.CountryName as country_name,
							s.suppName AS supplier_name
						FROM
							Products AS p
						LEFT JOIN
							colorProd AS c ON (p.prodColorID = c.colProdID)
						LEFT JOIN
							Regions AS r ON (p.prodRegionID = r.regionID)
						LEFT JOIN
							Country AS cn ON (r.regionCountryID = cn.CountryID)
						LEFT JOIN
							Suppliers AS s ON (p.prodIDSupplier = s.suppID)
						WHERE
							p.prodID = :product_id
							";

		$params[':product_id'] = $product_id;
		$product = $db->fetch_results($sql, $params);
		
		if (empty($product)){
			$data['status'] = "ERROR";
			$data['error_message'] = "Product not found";
		}
		else {
			$data['status'] = "SUCCESS";
			$data['product'] = $product;
		}
		break;
	
	default:
		$data['status'] = "ERROR";
		$data['error_message'] = "Product not found";
		break;
}

header('Content-Type: application/json');
echo json_encode($data);
?>