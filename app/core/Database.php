<?php
Trait Database
{
    private function connect()
    {
        $string = 'mysql:hostname=' . DB_HOST . ';dbname=' . DB_NAME;
        $conn = new PDO($string, DB_USER, DB_PASS);
        return $conn;
    }
    public function query($query, $data = [])
    {
        // create a connection
        $conn = $this->connect();
        // prepare a statement
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }
    public function get_row($query, $data = [])
    {
        // create a connection
        $conn = $this->connect();
        // prepare a statement
        $stmt = $conn->prepare($query);
        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }
        return false;
    }

}
