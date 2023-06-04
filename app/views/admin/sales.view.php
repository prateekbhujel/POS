<ul class="nav nav-tabs">
	<li class="nav-item">
		<a href="index.php?pg=admin&tab=sales" class="nav-link <?=($section == 'table' ?'active':'')?>" aria-current="page" >Table View</a>
	</li>
	<li class="nav-item">
		<a href="index.php?pg=admin&tab=sales&s=graph" class="nav-link <?=($section == 'graph') ? 'active' : ''?>">Graph View</a>
	</li>
</ul>
<br>
<?php if($section == 'table'):?>

		<form>
			<div class="row mb-2">
				<div class="col-sm-4">
					<div class="input-group ">
						<label class="input-group-text" for="start">Start Date : </label>
						<input class="form-control" id="start" type="date"  name ="start" value ="<?=!empty($_GET['start']) ? $_GET['start'] : ''?>">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="input-group ">
						<label class="input-group-text" for="end">End Date : </label>
						<input class="form-control" id="end" type="date" name ="end" value ="<?=!empty($_GET['end']) ? $_GET['end']: ''?>">
					</div>
				</div>
				<div class="col-sm-3">
				<div class="input-group ">
						<label class="input-group-text" for="limit">Rows : </label>
						<input class="form-control" id="limit" type="number" min="1" name="limit" value ="<?=!empty($_GET['limit']) ? $_GET['limit']: ''?>">
					</div>
				</div>
				<div class="col-sm-1">
					<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
				</div>
				<input type="hidden" name="pg"value="admin">
				<input type="hidden" name="tab"value="sales">
			</div>
		</form>
		<div class="clearfix"></div>

	<div class="table-responsive">
		<div class="my-3"><h3>Today's Total: 	<span class = "text text-success"> Rs. <?=number_format($sales_total)?></span></h3></div>
		<table class="table table-striped table-hover table-bordered">
			<tr class="table-info">
				<th>Barcode</th><th>Receipt NO</th><th>Description</th><th>Qty</th><th>Amount</th><th>Total</th><th>Cashier</th><th>Date</th>
				<th>
					<a href="index.php?pg=home">
						<button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add new</button>
					</a>
				</th>
			</tr>

			<?php if (!empty($sales)):?>
				<?php foreach ($sales as $sale):?>
				<tr>
					<td><?=esc($sale['barcode'])?></td>
					<td><?=esc($sale['receipt_no'])?></td>
					<td><?=esc($sale['description'])?></td>
					<td><?=esc($sale['qty'])?></td>
					<td class="text-success">Rs. <?=esc($sale['amount'])?></td>
					<td class="text-success">Rs. <?=esc($sale['total'])?></td>
					<?php 
						$cashier = get_user_by_id($sale['user_id']);
						if(empty($cashier))
						{
							$name = "Unknown";
							$name_link = "#";
						}else
						{
							$name = $cashier['username'];
							$name_link ="index.php?pg=profile&id=".$cashier['id'];
						}
					?>
					<td>
						<a href="<?=$name_link?>">
							<?=esc($name)?>
						</a>
					</td>
					<td><?=date("jS M, Y",strtotime($sale['date']))?></td>
					<td>
						<a href="index.php?pg=sale-edit&id=<?=$sale['id']?>">
							<button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
						</a>
						<a href="index.php?pg=sale-delete&id=<?=$sale['id']?>">
							<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
						</a>
					</td>
				</tr>
				<?php endforeach;?>
			<?php endif;?>
			
		</table>

		<?php

			$pager->display();
		?>

	</div>
<?php else:?>
	<h4>Graph View</h4>
<?php endif;?>