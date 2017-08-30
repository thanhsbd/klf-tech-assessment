<?php
if (isset($_GET['product_id']))
{
	$product_id = trim(preg_replace("/[^0-9]/", "", substr($_GET['product_id'], 0, 10)));

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
}

//Display product details if product was found
if (isset($product) && !empty($product))
{
	?>
	<br />
	<button class="btn btn-primary pull-left" onclick="window.location='index.php'">
		Back
	</button>
	<br />
	<br />
	<h1>Product Info</h1>
	<div class="col-md-6 col-md-offset-3">
		<table class="table">
			<tr>
				<th>Product Name</th>
				<td><?php echo $product['product_name']?></td>
			</tr>
			<tr>
				<th>Product Number</th>
				<td><?php echo $product['product_num']?></td>
			</tr>
			<tr>
				<th>Format (ml)</th>
				<td><?php echo $product['product_format']?></td>
			</tr>
			<tr>
				<th>Pack</th>
				<td><?php echo $product['product_pack']?></td>
			</tr>
			<tr>
				<th>Date bought</th>
				<td><?php echo $product['product_date_buy']?></td>
			</tr>
			<tr>
				<th>Quantity Bought</th>
				<td><?php echo $product['product_qty_buy']?></td>
			</tr>
			<tr>
				<th>Price Bought</th>
				<td><?php echo $product['product_price_buy']?></td>
			</tr>
			<tr>
				<th>Colour</th>
				<td><?php echo $product['color_name']?></td>
			</tr>
			<tr>
				<th>Status</th>
				<td><?php echo (!$product['product_sold_out']? "In Stock": "Sold Out")?></td>
			</tr>
			<tr>
				<th>Region</th>
				<td><?php echo $product['region_name']?></td>
			</tr>
			<tr>
				<th>Country</th>
				<td><?php echo $product['country_name']?></td>
			</tr>
			<tr>
				<th>Supplier</th>
				<td><?php echo $product['supplier_name']?></td>
			</tr>
		</table>
	</div>
<?php
}
//If product was not found
else
{
	?>
	<h2 class="text-danger text-center">This product cannot be found</h2>
	<?php
}
?>