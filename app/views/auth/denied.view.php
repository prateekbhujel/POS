<?php require views_path('partials/header');?>

    <br>
        <center>
            <h1 class = "text text-secondary">Access Denied !</h1>
            <div class="text text-danger"><?=Auth::getMessage()?></div>
        </center>
    <br>

<?php require views_path('partials/footer');?>
