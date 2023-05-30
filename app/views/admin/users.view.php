<div class="table-responsive">
	
	<table class="table table-striped table-hover table-bordered">
		<tr class="table-info">
			<th>Image</th><th>User Name</th><th>Gender</th><th>Email</th><th>Role</th><th>Date</th>
			<th>
				<a href="index.php?pg=signup">
					<button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add new</button>
				</a>
			</th>
		</tr>

		<?php if (!empty($users)):?>
			<?php foreach ($users as $user):?>
	 		<tr>
				<td>
					<a href="index.php?pg=profile&id=<?=$user['id']?>">
                        <img src="<?=crop($user['image'],400,$user['gender'])?>" style="width: 100%;max-width:100px;">
                    </a>
                </td>

				<td>
					<a href="index.php?pg=profile&id=<?=$user['id']?>">
						<?=esc($user['username'])?>
					</a>	
				</td>
				<td><?=esc($user['gender'])?></td>
				<td><?=esc($user['email'])?></td>
				<td><?=esc($user['role'])?></td>

				<td><?=date("jS M, Y",strtotime($user['date']))?></td>
				<td>
					<a href="index.php?pg=user-edit&id=<?=$user['id']?>">
						<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
					</a>
					<a href="index.php?pg=user-delete&id=<?=$user['id']?>">
						<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
					</a>
				</td>
			</tr>
			<?php endforeach;?>
		<?php endif;?>
		
	</table>
</div>