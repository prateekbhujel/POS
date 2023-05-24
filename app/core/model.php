<?php

/*
* Model Class
*/
class Model extends Database
{
    protected $table;
    

    /* Gets the allowed column defined in the Model Class*/        

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


    /* Insert Into the Database */        
    
    public function insert($data)
    {
            
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $keys = array_keys($clean_array);

        $query = "insert into $this->table";
        $query .= "(".implode(",", $keys).") values ";
        $query .= "( :".implode(", :", $keys).")";

        $db =  new Database;
        $db->query($query, $clean_array);
    }    


    /* Updates the query from the Database */

    public function update($id, $data)
    {
            
        $clean_array = $this->get_allowed_columns($data, $this->table);
        $keys = array_keys($clean_array);
        
        $query = "update $this->table set ";
        foreach ($keys as $column) 
        {
            $query .= $column."=:".$column ."," ;
        }
        $query = trim($query,',');
        $query .= " where id =:id";
        $clean_array['id'] = $id;
        
        $db = new Database;
        $db->query($query, $clean_array);
    } 
    

    /* Deletes the data from Table */
	public function delete($id)
	{

		$query = "delete from $this->table where id = :id limit 1";
		$clean_array['id'] = $id;

		$db = new Database;
		$db->query($query,$clean_array);	

	}


    /* Returns the array and finds where the data is : */

    public function where($data, $limit = 10, $offset = 0, $order = 'desc', $order_column = 'id') //limit and offset is for pagination where offset is a page number
    {
        $keys = array_keys($data);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= "$key = :$key && ";
        }
        $query = trim($query,'&& ');
        $query.= " order by $order_column $order limit $limit offset $offset";
        $db = new Database();
        return $db->query($query, $data);
    }


    /* Returns the array and finds all the data is : */

    public function getAll($limit = 10, $offset = 0, $order = 'desc', $order_column = 'id')
    {

        $query = "select * from $this->table order by $order_column $order limit $limit offset $offset";

        $db = new Database();
        return $db->query($query);
    }


    /* Gets the Fist data from the table with id  */

    public function first($id)
    {
        $keys = array_keys($id);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= "$key = :$key && ";
        }
        $query = trim($query,'&& ');

        if($res = $this->query($query, $id))
        {
            return $res[0];
        }

        return false;
    }
   
}