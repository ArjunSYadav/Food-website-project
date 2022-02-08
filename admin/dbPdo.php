<?php

class database
{
    private $db_name = "mysql:host=localhost;dbname=food";
    private $databaseName="food";
    private $username = "root";
    private $password = "";

    public $conn = false;
    public $mysqli = "";
    private $result = array();

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new PDO($this->db_name, $this->username, $this->password);
            $this->conn = true;
            if ($this->mysqli->errorInfo()) {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }
        } else {

            return true;
        }
    }

    public function insert($table_n, $params = array())
    {
        if ($this->tableExit($table_n)) {

            $table_columns = implode(',', array_keys($params));
            $table_values = implode("','", $params);

            $sql = "INSERT INTO $table_n ($table_columns) VALUES ('$table_values')";
            $runsql = $this->mysqli->prepare($sql);
            if ($runsql->execute()) {
                array_push($this->result, $this->mysqli->lastInsertId());
                return true;
            } else {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($table_n, $params = array(), $where = null)
    {
        if ($this->tableExit($table_n)) {
            $args = array();
            foreach ($params as $key => $values) {
                $args[] = "$key = '$values'";
            }

            $sql = "UPDATE $table_n SET " . implode(',', $args);

            if ($where != null) {
                $sql .= " WHERE $where";
            }
            $runsql = $this->mysqli->prepare($sql);
            if ($runsql->execute()) {
                array_push($this->result, $runsql->rowcount());
                return true;
            } else {
                array_push($this->result, $runsql->errorInfo());
                return false;
            }
        } else {
            return false;
        }
    }


    public function select($table_n, $rows = "*", $join = null, $join_2=null, $where = null, $orderby = null, $offset=null, $limit = null)
    {
        if ($this->tableExit($table_n)) {

            $sql = "SELECT $rows FROM $table_n ";
            if ($join != null) {
                $sql .= " LEFT JOIN $join";
            }
            if ($join_2 != null) {
                $sql .= " LEFT JOIN $join_2";
            }
            if ($where != null) {
                $sql .= "WHERE $where";
            }
            if ($orderby != null) {
                $sql .= "ORDER BY $orderby";
            }
            if ($limit != null && $offset != null) {
                $sql .= "LIMIT $offset, $limit";
            }

            $querry = $this->mysqli->prepare($sql);
            $querry->execute();
            if ($querry) {
                $this->result = $querry->fetchAll(PDO::FETCH_ASSOC);
                return true;
            } else {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete($table_n, $where = null){
        if ($this->tableExit($table_n)) {
            $sql="DELETE FROM $table_n";
            if($where != null){
                $sql .= " WHERE $where";
            }

            $querry = $this->mysqli->prepare($sql);
            $querry->execute();
            if ($querry) {
                array_push($this->result, $querry->rowCount());
                return true;
            } else {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }

        }else{
            return false;
        }
    }

    // FUNCTION to show pagination
  public function pagination($table, $join = null, $where = null, $limit){
    // Check to see if table exists
    if($this->tableExit($table)){
        //If no limit is set then no pagination is available
        if( $limit != null){
            // select count() query for pagination
      $sql = "SELECT COUNT(*) FROM $table";
      if($where != null){
            $sql .= " WHERE $where";
              }
              if($join != null){
                  $sql .= ' JOIN '.$join;
              }
              // echo $sql; exit;
    //   $query = $this->mysqli->query($sql);
    $querry = $this->mysqli->prepare($sql);
    $querry->execute();
      $total_record = $querry->fetchAll(PDO::FETCH_NUM);
      $total_record = $total_record[0];

      $total_page = ceil( $total_record / $limit);

      $url = basename($_SERVER['PHP_SELF']);

          if(isset($_GET["page"])){
                  $page = $_GET["page"];
                  }
                  else{
                    $page = 1;
                  }

      // show pagination
      $output =   "<ul class='pagination'>";
      if($page>1){
          $output .="<li><a href='$url?page=".($page-1)."' class='page-link'>Prev</a></li>";
      }
      if($total_record > $limit){
        for ($i=1; $i<=$total_page ; $i++) {
          if($i == $page){
             $cls = "class='active'";
          }else{
             $cls = '';
          }
            $output .="<li $cls><a class='page-link' href='$url?page=$i'>$i</a></li>";
        }
      }
      if($total_page>$page){
        $output .="<li> <a class='page-link' href='$url?page=".($page+1)."'>Next</a></li>";
      }
      $output .= "</ul>";

      return $output;
        }

    }else{
      return false; // Table does not exist
    }
}

    public function sqlQuerry($sql)
    {

        $querry = $this->mysqli->prepare($sql);
        $querry->execute();
        if ($querry) {
            $this->result = $querry->fetchAll(PDO::FETCH_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->errorInfo());
        }
    }

    public function getResult()
    {

        $val = $this->result;
        $this->result = array();
        return $val;
    }

    private function tableExit($table_n)
    {
        $sql = "SHOW TABLES FROM $this->databaseName LIKE '$table_n'";
        $tableInDb = $this->mysqli->prepare($sql);
        $tableInDb->execute();
        if ($tableInDb) {
            if ($tableInDb->rowCount() == 1) {
                return true;
            } else {
                array_push($this->result, $table_n . "does not exist in this database. ");
                return false;
            }
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli =null) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
