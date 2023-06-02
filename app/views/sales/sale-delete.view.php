<?php require views_path('partials/header');?>

	<div class="container-fluid border rounded p-4 m-2 col-lg-4 mx-auto">

		<?php if(!empty($row)):?>

		<form method="post">

			<center>
				<h5 class="text-danger mb-4"><i class="fa fa-trash"></i> Delete Sale Data</h5>
			</center>

			<div class="alert alert-danger text-center"> Are you sure you want to delete this Sale data??!!</div>

			<div class="mb-3">
			  <label  class="form-label"> Sale description</label>
			  <input disabled value="<?=$row['description']?>" type="text" class="form-control">
			</div>
			<div class="mb-3">
			  <label class="form-label"> Barcode : </label>
			  <input disabled value="<?=$row['barcode']?>" type="number" class="form-control">
			</div>
			
			<div class="mb-3">
			  <label class="form-label"> Receipt No.: </label>
			  <input disabled value="<?=$row['receipt_no']?>"  type="number" class="form-control">
			</div>

			<div class="mb-3">
			  <label class="form-label"> Sold Quantity: </label>
			  <input disabled value="<?=$row['qty']?>" type="number" class="form-control">
			</div>


			<div class="mb-3">
			  <label class="form-label"> Total :</label>
			  <input disabled value="Rs. <?=$row['total']?>"  type="text" class="form-control text-success">
			</div>

			<div class="mb-3">
			  <label class="form-label"> Date : </label>
			  <input disabled value="<?=get_date($row['date'])?>" type="text" class="form-control">
			</div>
			<br>
			<button class="btn btn-danger float-end"><i class="fa fa-trash"></i></button>
			<a href="index.php?pg=admin&tab=sales">
				<button type="button" class="btn btn-primary"> Cancel</button>
			</a>
		</form>
		<?php else:?>
			That Record was not found
			<br><br>
			<a href="index.php?pg=admin&tab=sales">
				<button type="button" class="btn btn-primary"> Back to Sales</button>
			</a>

		<?php endif;?>

	</div>

<?php require views_path('partials/footer');?>