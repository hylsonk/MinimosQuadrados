<?php
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 12/11/2017
 * Time: 23:54
 */

class pgsql
{
    private $linkid;
    private $host;
    private $user;
    private $passwd;
    private $db;
    private $result;
    private $querycount;

    function __construct($host,$db,$user,$passwd)
    {
        $this->host = $host;
        $this->user = $user;
        $this->passwd = $passwd;
        $this->db = $db;
    }

    function connect(){
        try{
            $this->linkid = @pg_connect("host = $this->host dbname = $this->db user = $this->user password = $this->passwd");
            if (!$this->linkid){
                throw new Exception("Coul not connect to PostgreSQL server.");
            }
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    function disconnect(){
        pg_close($this->linkid);
    }

    function query($query){
        try{
            $this->result = @pg_query($this->linkid,$query);
            if (!$this->result){
                throw new Exception("The database Wuery failed."+pg_last_error($this->result));
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }
        $this->querycount++;
        return $this->result;
    }

    function affectedRows(){
        $count = @pg_affected_rows($this->linkid);
        return $this->result;
    }

    function numRows(){
        $count = @pg_num_rows($this->result);
        return $count;
    }

    function fetchObject(){
        $row = @pg_fetch_object($this->result);
        return $row;
    }

    function fetchRow(){
        $row = @pg_fetch_row($this->result);
        return $row;
    }

    function fetchArray(){
        $row = @pg_fetch_array($this->result,null,PGSQL_ASSOC);
        return $row;
    }

    function numQueries(){
        return $this->querycount;
    }

    function numberFields(){
        $count = @pg_num_fields($this->result);
        return $count;
    }

    function fieldName($offset){
        $field = @pg_field_name($this->result,$offset);
        return $field;
    }


}