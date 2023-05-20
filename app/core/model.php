<?php

/*
* Model Class
*/
class Model extends Database
{
    protected $table;
    
    protected function get_allowed_columns($data)
    {
        if(!empty($this->allowed_columns))
        foreach ($data as $key => $value) 
            {
                if(!in_array($key, $this->allowed_columns))
                {
                    unset($data[$key]);
                }
            }
            
        return $data;
        
    }

    
    public function insert($data)
    {
            
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $keys = array_keys($clean_array);

        $query = "insert into $this->table";
        $query .= "(".implode(",", $keys).") values ";
        $query .= "( :".implode(", :", $keys).")";

        $this->query($query, $clean_array);
    }    

    public function where($data)
    {
        $keys = array_keys($data);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= "$key = :$key && ";
        }
        $query = trim($query,'&& ');

        return $this->query($query, $data);
    }    
   
   
}