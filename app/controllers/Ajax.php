<?php 

defined("ABSPATH") ? "":die();

// Capture AJAX data
$raw_data = file_get_contents("php://input");

if(!empty($raw_data))
{
	$OBJ = json_decode($raw_data, true); //Converting JSON Objects into array
	if(is_array($OBJ))
	{
		if($OBJ['data_type'] == 'search')
		{
			$productClass = new Product();

			if(!empty($OBJ['text']))
			{
				//Perform Search Query
				$text = "%".$OBJ['text']."%";
				$query = "select * from products where description like :find limit 10";
				$rows = $productClass->query($query, ['find' =>$text]);

			}else
			{
				//Perform Search All Query
				$rows = $productClass->getAll();
			}

			if($rows)
			{

				foreach ($rows as $key => $row) 
    			{
		
					$rows[$key]['description'] = strtoupper($row['description']);
					$rows[$key]['image'] = crop($row['image']);
				}
					echo json_encode($rows);

			}
		} 
	}
}
