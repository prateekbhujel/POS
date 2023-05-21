<?php

/*
* Product Class
*/
class Product extends Model
{

    protected $table = 'products';

    protected $allowed_columns= [
                'barcode',
                'user_id',
                'description',
                'qty',
                'amount',
                'image',
                'date',
                'views',
    ];


/*              This Function is Used to validation             */
    
    public function validate($data)
    {

        $errors = [];
    
/*                  Check Description                              */
        if(empty($data['description']))
        {
            $errors['description'] = "Product description is required";
        }else
        if(!preg_match('/[a-zA-Z0-9 _\-\$&\(\)]+/', $data['description']))
        {
            $errors['description'] ="only letters and spaces allowed in description";
        }


/*                  Check Quantity                                 */
           
        if(empty($data['qty']))
        {
            $errors['qty'] = "Product Quantity is required";
        }else
        if(!preg_match('/^[0-9]+$/', $data['qty']))
        {
            $errors['qty'] ="Quantity must be number !";
        }

/*                  Check Amount                                */
        if(empty($data['amount']))
        {
        $errors['amount'] = "Product Amount is required";
        }else
        if(!preg_match('/^[0-9].+$/', $data['amount']))
        {
        $errors['amount'] ="Amount must be number !";
        }  

/*                  Check Image                                        */

        $max_size = 5;//5MB
        $size = $max_size * (1024 * 1024) ;//Converting to MB
        if(empty($data['image']))
        {
        $errors['Image'] = "Product Image is required";
        }else
        if(!($data['image']['type'] == "image/jpeg" || $data['image']['type'] == "image/jpg" || $data['image']['type'] == "image/png" || $data['image']['type'] == "image/webp"))
        {
        $errors['image'] ="Image must be valid JPEG, PNG or WEBP Format !";
        }else
        if($data['image']['error'] > 0)
        {
            $errors['image'] = "The submitted Image Failed to Upload ! Error NO: " .$data['image']['error'];
        }else
        if($data['image']['size'] > $size)
        {
            $errors['image'] = "The Image must be lower than " . $max_size . "MB";
        }


    return $errors;
    
    }

/*      This Function Generates Random number                    */
    public function generate_barcode()
    {
        return "2222" . rand(1000, 9999999999);
    }


/*            File Generator                                      */

        public function generate_filename($ext = "jpg")
        {
            // Generates unique Name for file

            //Just in case Hash Matches 
            return hash ("sha1", rand(1000, 9999999999)) . "__" . rand(1000, 99999). "." . $ext;
        }
}