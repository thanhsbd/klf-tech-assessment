<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">KLF Tech Assessment</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?route=wine">Wine List<?php echo ($current_nav == "wine"? '<span class="sr-only">(current)</span>': '') ?></a>
      </li>
		  <li class="nav-item dropdown">
	       <a class="nav-link dropdown-toggle" href="#" id="suppliers-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	         Suppliers<?php echo ($current_nav == "supplier"?  '<span class="sr-only">(current)</span>': '') ?>
	       </a>
	       <div class="dropdown-menu columns" aria-labelledby="suppliers-dropdown">
					 <?php foreach($suppliers as $s) { ?>
						 <a class="dropdown-item" href="index.php?route=supplier&supplier_id=<?php echo $s['supplier_id']?>">
						 	<?php echo $s['supplier_name']?>
						 </a>
					 <?php } ?>
	       </div>
	     </li>
		  <li class="nav-item dropdown">
	       <a class="nav-link dropdown-toggle" href="#" id="regions-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	         Regions<?php echo ($current_nav == "region"?  '<span class="sr-only">(current)</span>': '') ?>
	       </a>
	       <div class="dropdown-menu columns" aria-labelledby="regions-dropdown">
					 <?php foreach($countries as $c) { ?>
						 <a class="dropdown-item country" href="#">
						 	<?php echo $c['country_name']?>
						 </a>

						 <?php foreach($c['regions'] as $r) { ?>
							 <a class="dropdown-item region" href="index.php?route=region&region_id=<?php echo $s['region_id']?>">
							 	<?php echo $r['region_name']?>
							 </a>
						 <?php } ?>
					 <?php } ?>
	       </div>
	     </li>
    </ul>
  </div>
</nav>

<style>
	.dropdown-menu.columns {
		font-size:0.9em;
		-webkit-column-count: 4; /* Chrome, Safari, Opera */
    -moz-column-count: 4; /* Firefox */
    column-count: 4;
	}
	
	.dropdown-menu.columns .dropdown-item {
		width:200px;
	}
	
	.dropdown-menu.columns .dropdown-item.country {
		font-weight:bold;
	}
	
	.dropdown-menu.columns .dropdown-item.region {
		margin-left:5px;
	}
	
	.dropdown-menu.columns .dropdown-item.region:last-of-type {
		margin-bottom:10px;
	}
</style>