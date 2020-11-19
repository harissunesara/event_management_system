<?php

class db_function {

    private $conn;

    public function __construct() {
        $database = new Database;
        $mydb = $database->dbConnection();
        $this->conn = $mydb;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function select_fields($fileds, $tblname) {
        $stmt = $this->runQuery("SELECT " . $fileds . " FROM " . $tblname . " ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function select_where($sel_fld, $tbl, $val) {
        $sql = "select " . $sel_fld . " from " . $tbl . "";
        $where = "";
        if (is_array($val)) {
            foreach ($val as $fds) {

                $where = $where . " " . $fds[0] . " " . $fds[1] . " " . $fds[2] . " :" . $fds[1];
                $fld_array[$fds[1]] = $fds[3];
            }
            $sql = $sql . " " . $where;

            $stmt = $this->runQuery($sql);
            $stmt->execute($fld_array);
        } else {
            $stmt = $this->runQuery($sql);
            $stmt->execute();
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //$sth->execute(array('calories' => $calories, 'colour' => $colour));
        return $row;
    }

    public function select_where_all($sel_fld, $tbl, $val) {
        $sql = "select " . $sel_fld . " from " . $tbl . "";
        $where = "";
        if (is_array($val)) {
            foreach ($val as $fds) {

                $where = $where . " " . $fds[0] . " " . $fds[1] . " " . $fds[2] . " :" . $fds[1];
                $fld_array[$fds[1]] = $fds[3];
            }


            $sql = $sql . " " . $where;
            $stmt = $this->runQuery($sql);
            $stmt->execute($fld_array);
        } else {
            $stmt = $this->runQuery($sql);
            $stmt->execute();
        }

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //$sth->execute(array('calories' => $calories, 'colour' => $colour));
        return $row;
    }

    public function select_join_where($sel_fld, $tbl, $wherefrld, $val) {
       
        $sql = "select " . $sel_fld . " from ";
        $where = "";

        if (is_array($tbl)) {
            foreach ($tbl as $mytble) {
                $sql = $sql . " " . $mytble . " ";
            }
            $sql = $sql . " " . $where;
        } else {
            $sql = $sql . " " . $tbl . " ";
        }


        if (is_array($wherefrld)) {
            foreach ($wherefrld as $fds) {
                $where = $where . " " . $fds[0] . " " . $fds[1] . " " . $fds[2] . " " . $fds[3];
            }
            $sql = $sql . " " . $where;
        }
$where2="";
        if (is_array($val)) {
            foreach ($val as $fds) {
                $where2 = $where2 . " " . $fds[0] . " " . $fds[1] . " " . $fds[2] . " :" . $fds[1];
                $fld_array[$fds[1]] = $fds[3];
            }
            $sql = $sql . " " . $where2;

            $stmt = $this->runQuery($sql);
            $stmt->execute($fld_array);
        } else {

            $stmt = $this->runQuery($sql);
            $stmt->execute();
        }

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //$sth->execute(array('calories' => $calories, 'colour' => $colour));
        return $row;
    }

    public function select_join_where_order($sel_fld, $tbl, $wherefrld, $val,$orderby) {
       
        $sql = "select " . $sel_fld . " from ";
        $where = "";

        if (is_array($tbl)) {
            foreach ($tbl as $mytble) {
                $sql = $sql . " " . $mytble . " ";
            }
            $sql = $sql . " " . $where;
        } else {
            $sql = $sql . " " . $tbl . " ";
        }


        if (is_array($wherefrld)) {
            foreach ($wherefrld as $fds) {
                $where = $where . " " . $fds[0] . " " . $fds[1] . " " . $fds[2] . " " . $fds[3];
            }
            $sql = $sql . " " . $where;
        }
        $where2="";
        if (is_array($val)) {
            foreach ($val as $fds) {
                $where2 = $where2 . " " . $fds[0] . " " . $fds[1] . " " . $fds[2] . " :" . $fds[1];
                $fld_array[$fds[1]] = $fds[3];
            }
            $sql = $sql . " " . $where2 . " order by " .$orderby;

            $stmt = $this->runQuery($sql);
            $stmt->execute($fld_array);
        } else {
            
            $sql = $sql . " order by " .$orderby;
            $stmt = $this->runQuery($sql);
            $stmt->execute();
        }

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //$sth->execute(array('calories' => $calories, 'colour' => $colour));
        return $row;
    }

    
    public function select_fields_where_two($fileds, $tblname, $whereflds1, $wherevalues1, $whereflds2, $wherevalues2) {
        $sql = "SELECT " . $fileds . " FROM " . $tblname . " WHERE " . $whereflds1 . "=:" . $whereflds1 . " AND " . $whereflds2 . "=:" . $whereflds2 . "";

        $stmt = $this->runQuery($sql);
        $fld_array[':' . $whereflds1] = $wherevalues1;
        $fld_array[':' . $whereflds2] = $wherevalues2;
        $stmt->execute($fld_array);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function select_fields_where($fileds, $tblname, $whereflds, $wherevalues, $orderby) {
        //echo "SELECT " . $fileds . " FROM " . $tblname . " WHERE " . $whereflds . "=:" . $whereflds . "";
        $stmt = $this->runQuery("SELECT " . $fileds . " FROM " . $tblname . " WHERE " . $whereflds . "=:" . $whereflds . " order by " . $orderby . " desc LIMIT 1");
        $stmt->execute(array(':' . $whereflds . '' => $wherevalues));
        //  $fld_array[':' . $wherfld1] = $whereval1;
        //  $stmt->execute($fld_array);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function select_data_table($tblname, $fileds, $whereflds, $wherevalues) {
        if ($whereflds != "") {

            $stmt = $this->runQuery("SELECT " . $fileds . " FROM " . $tblname . " WHERE " . $whereflds . "=:" . $whereflds . "");
            $stmt->execute(array(':' . $whereflds . '' => $wherevalues));
        } else {
            $stmt = $this->runQuery("SELECT " . $fileds . " FROM " . $tblname . " ");
            $stmt->execute();
        }
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function select_data_where_condition($tblname, $sel_fields, $wherfld1, $wherecond1, $whereval1, $wherefld2, $wherecond2, $whereval2, $wherefld3, $wherecond3, $whereval3) {
        $sql_where = "";
        $fld_array = array();

        if ($wherfld1 != "") {
            $sql_where = $sql_where . " " . $wherfld1 . $wherecond1 . ":" . $wherfld1 . "";
            $fld_array[':' . $wherfld1] = $whereval1; //array(':'.$wherfld1.''=>$wherfld1);
        }
        if ($wherefld2 != "") {
            $sql_where = $sql_where . " and " . $wherefld2 . $wherecond2 . ":" . $wherefld2 . "";
            $fld_array[':' . $wherefld2] = $whereval2;
        }
        if ($wherefld3 != "") {
            $sql_where = $sql_where . " and " . $wherefld3 . $wherecond3 . ":" . $wherefld3 . "";
            $fld_array[':' . $wherefld3] = $whereval3;
        }


        if ($sql_where != "") {
            $sql = "SELECT " . $sel_fields . " FROM " . $tblname . " WHERE " . $sql_where . "";
            $stmt = $this->runQuery($sql);
            $stmt->execute($fld_array);
        } else {
            $stmt = $this->runQuery("SELECT " . $sel_fields . " FROM " . $tblname . " ");
            $stmt->execute();
        }
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $row;
    }

    public function insert_data($tblname, $myfileds, $myvalues) {
        //   my code 
        $fields = "";
        $vals = "";

        $to = count($myfileds);
        for ($i = 0; $i <= $to - 1; $i++) {
            $fields = $fields . $myfileds[$i] . ",";
            $vals = $vals . " :" . $myfileds[$i] . ",";
        }
        $fields = substr($fields, 0, (strlen($fields) - 1));
        $vals = substr($vals, 0, (strlen($vals) - 1));

        $sql = "INSERT INTO " . $tblname . " (" . $fields . ") values(" . $vals . ") ";
        $stmt = $this->conn->prepare($sql);
        for ($i = 0; $i <= $to - 1; $i++) {
            //$data=strip_tags($myvalues[$i]);
            $stmt->bindparam(":" . $myfileds[$i], $myvalues[$i]);
        }
        $stmt->execute();
        return $stmt;
        ///
    }

    public function update_data($tblname, $myfileds, $myvalues, $mywhereflds, $mywherevls) {

        try {//   my code 
            $fields = "";
            $vals = "";
            $update_sql = "update " . $tblname . " set ";

            $to = count($myfileds);
            for ($i = 0; $i <= $to - 1; $i++) {
                $update_sql = $update_sql . $myfileds[$i] . "=:" . strip_tags($myfileds[$i]) . ",";
            }
            $update_sql = substr($update_sql, 0, (strlen($update_sql) - 1));
            $update_sql = $update_sql . " where " . $mywhereflds . "=:" . $mywhereflds;

            $stmt = $this->conn->prepare($update_sql);
            for ($i = 0; $i <= $to - 1; $i++) {
                //echo  "". $myfileds[$i] ." ".$myvalues[$i];
                $stmt->bindparam(":" . $myfileds[$i], $myvalues[$i]);
            }
            $stmt->bindparam(":" . $mywhereflds, $mywherevls);

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            $e->getMessage();
        }
        ///
    }

    // rupesh
    public function update_data_where($tblname, $myfileds, $myvalues, $mywhereflds, $mywherevls,$fld,$mval) {

        try {//   my code 
            $fields = "";
            $vals = "";
            $update_sql = "update " . $tblname . " set ";

            $to = count($myfileds);
            for ($i = 0; $i <= $to - 1; $i++) {
                $update_sql = $update_sql . $myfileds[$i] . "=:" . strip_tags($myfileds[$i]) . ",";
            }
            $update_sql = substr($update_sql, 0, (strlen($update_sql) - 1));
            $update_sql = $update_sql . " where " . $mywhereflds . "=:" . $mywhereflds;

            $stmt = $this->conn->prepare($update_sql);
            for ($i = 0; $i <= $to - 1; $i++) {
                //echo  "". $myfileds[$i] ." ".$myvalues[$i];
                $stmt->bindparam(":" . $myfileds[$i], $myvalues[$i]);
            }
            $stmt->bindparam(":" . $mywhereflds, $mywherevls);

            $stmt->execute();
            return $stmt;
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
        ///
    }

    // end Rupesh
    public function delete_data($tblname, $mywhereflds, $mywherevls) {
        try {
            $fields = "";

            $vals = "";

            $delete_sql = "delete from " . $tblname;

            $delete_sql = $delete_sql . " where " . $mywhereflds . "=:" . $mywhereflds;

            $stmt = $this->conn->prepare($delete_sql);
            $stmt->bindparam(":" . $mywhereflds, $mywherevls);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function upload_file($FILES, $file_name, $folder) {
        if ($FILES[$file_name]['name'] != "") {
            $myfname = uniqid() . $FILES[$file_name]['name'];
            $path = $folder . "/" . $myfname;
            move_uploaded_file($FILES[$file_name]['tmp_name'], $path);
        } else {
            $myfname = "";
        }
        return $myfname;
    }

}

?>