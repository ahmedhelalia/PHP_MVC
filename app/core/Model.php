<?php

/**
 * Main Model trait
 */
trait Model
{
    use Database;
    protected $limit = 10;
    protected $offset = 0;
    protected $orderType = "DESC";
    protected $orderColumn = 'id';

    public function findAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->orderColumn $this->orderType LIMIT $this->limit OFFSET $this->offset ";
        return $this->query($query);
    }
    // Multiple rows
    public function where($data, $data_not = [])
    {
        /**
         * The query is supposed to be like this
         * ==> SELECT * FROM users WHERE id = :id LIMIT 10 OFFSET 0
         */
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach ($keys as $key) {
            // this is for prepared statements
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            // this is for prepared statements
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        $query .=  "ORDER BY $this->orderColumn $this->orderType LIMIT $this->limit OFFSET $this->offset";
        // we are merging them because query only takes one parameter
        $data = array_merge($data, $data_not);
        //echo $query;
        return $this->query($query, $data);
    }

    // One row
    public function first($data, $data_not)
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach ($keys as $key) {
            // this is for prepared statements
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            // this is for prepared statements
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        $query .=  " LIMIT $this->limit OFFSET $this->offset";
        // we are merging them because query only takes one parameter
        $data = array_merge($data, $data_not);
        //echo $query;
        $result = $this->query($query, $data);
        if ($result) {
            return $result[0];
        }
        return false;
    }
    public function insert($data)
    {
        /**
         * Remove Unwanted data
         */
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table " . '(' . implode(',', $keys) . ')' . " VALUES " . '(:' . implode(",:", $keys) . ')';
        //echo $query;
        $this->query($query, $data);
        return false;
    }
    public function update($id, $data, $id_column = 'id')
    {
        /**
         * Remove Unwanted data
         */
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET  ";
        foreach ($keys as $key) {
            // this is for prepared statements
            $query .= $key . " = :" . $key . ", ";
        }


        $query = trim($query, ", ");
        $query .=  " WHERE $id_column = :$id_column";

        //echo $query;
        $data[$id_column] = $id;
        $this->query($query, $data);
        return false;
    }
    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :id";
        //echo $query;
        $this->query($query, $data);
        return false;
    }
}
