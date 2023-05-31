<ul class="nav nav-tabs">
	<li class="nav-item">
		<a href="#" class="nav-link active" aria-current="page" >Table View</a>
	</li>
	<li class="nav-item">
		<a href="#" class="nav-link">Graph View</a>
	</li>
</ul>
<br>
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
				<td>Rs. <?=esc($sale['amount'])?></td>
				<td><?=esc($sale['total'])?></td>
				<td><?=esc($sale['user_id'])?></td>
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
</div>