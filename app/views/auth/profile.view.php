<?php require views_path('partials/header');?>

	<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4" >

        <?php if(is_array($row)) :?>
            <center>
				<h3><i class="fa fa-user"></i> User Profile </h3>
				<div><?=esc(APP_NAME)?></div>
			</center>
            <br>
            <table class="table table-hover table-striped table-warning">
                <tr>
                    <td colspan="2">
                        <img src="<?=crop($row['image'],400,$row['gender'])?>" style="width: 100%;max-width:100px;">
                    </td>
                </tr>

                <tr>
                    <th>Username</th><td><?=$row['username']?></td>
                </tr>
                <tr>
                    <th>Email</th><td><?=$row['email']?></td>
                </tr>
                <tr>
                    <th>Gender</th><td><?=$row['gender']?></td>
                </tr>
                <tr>
                    <th>Role</th><td><?=$row['role']?></td>
                </tr>
                <tr>
                    <th>Created At</th><td><?=get_date($row['date'])?></td>

                </tr>
            </table>
            <br> 
            <a href="index.php?pg=edit-user&id=<?=$row['id']?>">
				<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
			</a>
            
            <a href="index.php?pg=delete-user&id=<?=$row['id']?>">
				<button class="btn btn-danger btn-sm float-end"><i class="fa fa-trash"></i></button>
			</a>

        <?php else:?>
            <div class="text alert alert-danger">
                That User Was Not Found !!
            </div>

        <?php endif;?>
	</div>

<?php require views_path('partials/footer');?>
