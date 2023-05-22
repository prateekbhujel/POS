<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

		<?php if(!empty($row)):?>

		<form method="post" enctype="multipart/form-data">

			<h5 class="text-danger text-center mb-3"><i class="fa fa-hamburger"></i> Delete Product</h5>

			<div class="alert alert-danger text-center">Are You Sure You Want To Delete This Product ?!!</div>
			
			<div class="mb-3">
			  <label for="productControlInput1" class="form-label">Product description</label>
			  <input value="<?=set_value('description',$row['description'])?>" name="description" type="text" class="form-control" id="productControlInput1" placeholder="Product description" readonly />
			</div>
			
			<div class="mb-3">
			  <label for="barcodeControlInput1" class="form-label">Barcode <small class="text-muted">(optional)</small></label>
			  <input value="<?=set_value('barcode',$row['barcode'])?>" name="barcode" type="text" class="form-control" id="barcodeControlInput1" placeholder="Product barcode" readonly />
	
			</div>
            
            <br>
			<img class="mx-auto d-block" src="<?=$row['image']?>" style="width:80%;">
			<br>
			<button class="btn btn-danger float-end"><i class="fa fa-trash fs-5"></i></button>
			<a href="index.php?pg=admin&tab=products">
				<button type="button" class="btn btn-secondary"><i class="fa fa-window-close fs-5"></i></button>
			</a>
		</form>
		<?php else:?>
			That product was not found
			<br><br>
			<a href="index.php?pg=admin&tab=products">
				<button type="button" class="btn btn-primary">Back to Product Lists</button>
			</a>

		<?php endif;?>

	</div>

<?php require views_path('partials/footer');?>