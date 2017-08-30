<div id="add_wine_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
			<form action="add.php" method="post">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Wine</h4>
	      </div>
	      <div class="modal-body">
					<div class="form-group row">
						<input type="text" name="product_name" placeholder="Product Name" class="form-control col-md-12" value="" />
					</div>
					<div class="form-group row">
						<input type="text" name="product_format" placeholder="Format (ml)" class="form-control col-md-6" value="" />
						<input type="text" name="product_price_sell" placeholder="Sell Price" class="form-control col-md-6" value="" />
					</div>
					<div class="form-group row">
						<label>Wine Color</label>
						<select name="product_color_id" class="form-control">
							<?php foreach($colors as $c) {
								?>
								<option value="<?php echo $c['color_id']?>"><?php echo $c['color_name']?></option>
								<?php
							}?>
						</select>
					</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Add</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
			</form>
    </div>
  </div>
</div>