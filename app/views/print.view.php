<?php 

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

 		$WshShell = new COM("WScript.Shell");
 		///$obj = $WshShell->Run("cmd /c wscript.exe www/public/file.vbs",0, true); 
 		$obj = $WshShell->Run("cmd /c wscript.exe ".ABSPATH."/file.vbs",0, true); 
 		
 		$WshShell = new COM("WScript.Shell");
 		///$obj = $WshShell->Run("cmd /c wscript.exe www/public/file.vbs",0, true); 
 		$obj = $WshShell->Run("cmd /c wscript.exe ".ABSPATH."/file.vbs",0, true); 
  
 	 
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=esc(APP_NAME)?></title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link href="assets/css/nepali.datepicker.v4.0.1.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>

    <?php

        $data = $_GET['data'] ?? "";

        $obj  = json_decode($data, true);
        
    ?>

<?php if(is_array($obj)):?>

    <center>
        <h1><?=$obj['company']?></h1>
        <h4>Receipt</h4>
        <div><i><?=date("jS F, Y H:i a")?></i></div>
    </center>    

    <table class="table table-striped">
        
        <tr>
            <th>Quantity</th>
            <th>Product Name</th>
            <th>@</th>
            <th>Amount</th>
        </tr>
        
        <?php foreach($obj['data'] as $key):?>
            <tr>
            
                <td>
                    <?=$key['qty']?>
                </td>
                
                <td>
                    <?=$key['description']?>
                </td>
                
                <td>
                    Rs. <?=$key['amount']?>
                </td>
                
                <td>Rs. <?=number_format($key['qty'] * $key['amount'],2)?></td>
            
            </tr>
        <?php endforeach;?>
            <tr>
                <td colspan="2"></td> 
                <td>
                     <b> Total : </b> 
                </td> 
                <td>
                     <b> Rs. <?=$obj['gtotal']?> </b> 
                    </td>
            </tr>

            <tr>
                <td colspan="2"></td> 
                <td> <b>Amount Paid :</b></td> 
                <td><b>Rs. <?=$obj['amount']?></b></td>
            </tr>

            <tr>
                <td colspan="2"></td> 
                <td>
                    <b>Change:</b>
                </td> 
                <td>
                   <b> Rs. <?=$obj['change']?> </b>
                </td>
            </tr>
    </table>

    <center>
        <p> 
            <b> <i> Thanks For Shopping With Us ! </i> </b>
        </p>
    
    </center>
<?php endif;?>

<script type="text/javascript">

    window.print();
    
    var ajax = new XMLHttpRequest();
    
    ajax.addEventListener('onreadystatechange', function(){

        (ajax.readyState == 4)
        {
            // console.log(ajax.responseText);
        }
    });

    ajax.open('POST','', true);
    ajax.send();
</script>

</body>
</html>