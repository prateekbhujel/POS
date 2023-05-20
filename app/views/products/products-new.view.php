<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

		<form method="post" enctype="multipart/form-data">

			<h3 class="text-success text-center mt-2 mb-4"><i class="fs-1 fa fa-hamburger"></i> Add Product</h3>
			
			<div class="mb-3">
			  <label for="productControlInput1" class="form-label">Product description</label>
			  <input name="description" type="text" class="form-control <?=!empty($errors['description']) ? 'border-danger':''?>" id="productControlInput1" placeholder="Product description">
			  	<?php if(!empty($errors['description'])):?>
					<small class="text-danger"><?=$errors['description']?></small>
				<?php endif;?>
			</div>
			
			<div class="mb-3">
			  <label for="barcodeControlInput1" class="form-label">Barcode <small class="text-muted">(optional)</small></label>
			  <input name="barcode" type="text" class="form-control <?=!empty($errors['barcode']) ? 'border-danger':''?>" id="barcodeControlInput1" placeholder="Product barcode">
			</div>

			<div class="input-group mb-3">
			  <span class="input-group-text">Qty:</span>
			  <input name="qty" value="1" type="number" class="form-control <?=!empty($errors['qty']) ? 'border-danger':''?>" placeholder="Quantity" aria-label="Quantity">
			  
			  <span class="input-group-text">Amount:</span>
			  <input name="amount" value="0.00" step="1" limit="0" type="number" class="form-control <?=!empty($errors['amount']) ? 'border-danger':''?>" placeholder="Amount" aria-label="Amount">

			</div>

			<div class="my-2">
			<?php if(!empty($errors['qty'])):?>
					<small class="text-danger"><?=$errors['qty']?></small>
			<?php endif;?>
			</div>
			<div class="my-2">
				<?php if(!empty($errors['amount'])):?>
					<small class="text-danger"><?=$errors['amount']?></small>
				<?php endif;?>
			</div>

			<div class="mb-3">
			  <label for="formFile" class="form-label">Product Image</label>
			  <input name="image" class="form-control <?=!empty($errors['image']) ? 'border-danger':''?>" type="file" id="formFile">

			  <?php if(!empty($errors['image'])):?>
					<small class="text-danger"><?=$errors['image']?></small>
				<?php endif;?>
			</div>

			<br>
			<button class="btn btn-danger float-end">Save</button>

			<a href="index.php?pg=admin&tab=products">
				<button type="button" class="btn btn-primary">Cancel</button>
			</a>
		</form>
	</div>

<?php require views_path('partials/footer');?>

