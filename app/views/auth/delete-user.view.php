<?php require views_path('partials/header');?>

	<div class="container-fluid border col-lg-5 col-md-6 mt-5 p-4" >

        <?php if(is_array($row) && $row['deletable']) :?>
		<form method="post">
			<center>
				<h3><i class="fa fa-user"></i> Delete User</h3>
				<div class="alert alert-danger text-center">
                    Are You Sure You want to delete this User?!!
                </div>
			</center>
			<br>
		 
			<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Username</label>
                <div class="form-control">
                    <?=esc($row['username'])?>
                </div>
			</div>
			
			<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Email address</label>
              <div class="form-control">
                    <?=esc($row['email'])?>
                </div>
			</div>

            <div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Gender</label>
              <div class="form-control">
                    <?=esc($row['gender'])?>
                </div>
			</div>

            <div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Role</label>
              <div class="form-control">
                    <?=esc($row['role'])?>
                </div>
            </div>

			<br>
			<button class="btn btn-danger float-end">Delete</button>
			
			<a href="index.php?pg=admin&tab=users">
				<button type="button" class="btn btn-primary">Cancel</button>
			</a>
		</form>
        <?php else:?>

			<?php if(is_array($row) && !$row['deletable']) :?>
            	<div class="text alert alert-danger text-center"> User Cannot be Deleted !!</div>
			<?php else:?>
				<div class="text alert alert-danger text-center"> User Was Not Found !!</div>
			<?php endif;?>
            
			<a href="index.php?pg=admin&tab=users">
				<button class="btn btn-primary btn-sm">Cancel</button>
			</a>

        <?php endif;?>
	</div>

<?php require views_path('partials/footer');?>
