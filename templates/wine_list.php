<?php
$db = new db();

$sql = "SELECT
					p.prodID as product_id,
					p.prodNum as product_num,
					p.prodName as product_name,
					p.prodFormat as product_format,
					p.prodSellPrice as product_sell_price,
					p.prodSoldOut as product_sold_out,
					c.colprodDesc as color_name,
					r.regionName as region_name,
					cn.CountryName as country_name
				FROM
					Products AS p
				LEFT JOIN
					colorProd AS c ON (p.prodColorID = c.colProdID)
				LEFT JOIN
					Regions AS r ON (p.prodRegionID = r.regionID)
				LEFT JOIN
					Country AS cn ON (r.regionCountryID = cn.CountryID)
				ORDER BY
					prodID DESC
				LIMIT
					1000";

$products = $db->fetch_all_results($sql);

//Get colors for add_wine form
$sql = "SELECT
					colProdID as color_id,
					colProdDesc as color_name
				FROM
					colorProd
				ORDER BY
					colProdID
				ASC
					";

$colors = $db->fetch_all_results($sql);
?>
<h1>Wine List</h1>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_wine_modal">Add Wine</button>
<br />
<br />
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Color</th>
			<th>Format (ml)</th>
			<th>Region</th>
			<th>Status</th>
			<th class="text-right">Price</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($products as $product) { ?>
			<tr>
				<td>
					<a href="index.php?route=wine/product&product_id=<?php echo $product['product_id']?>">
						<?php echo $product['product_name'];?>
					</a>
				</td>
				<td><?php echo $product['color_name']?></td>
				<td><?php echo $product['product_format']?></td>
				<td><?php echo $product['region_name'] . ", " . $product['country_name']?></td>
				<td><?php echo (!$product['product_sold_out']? "In Stock": "Sold Out")?></td>
				<td class="text-right"><?php echo money_format('%n', $product['product_sell_price'])?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php
include('wine_add.php');
?>