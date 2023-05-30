<?php require views_path('partials/header');?>

<div style="margin-top:8%">
    <br>
    <center>
        <h1 class = "text text-secondary" style ="font-size:104px;">Access Denied !</h1>
        <div class="text text-danger fs-3"><?=Auth::getMessage()?></div>
    </center>
    <br>
    
</div>

<?php require views_path('partials/footer');?>
