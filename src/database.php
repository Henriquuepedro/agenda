<?php

include 'connection.php';

class Database{
    
    private $table = "";
    private $columns = "";
    private $where = "";
    private $value = "";
    public function __construct(){}

    //SELECT
    public function setSelect(string $columns, string $table, string $where = NULL)
    {
        $this->columns = $columns;
        $this->table = $table;
        $this->where = $where;
        return $this->getSelect();
    }

    public function getSelect()
    {
        if((empty($this->columns)) || (empty($this->table))){
            throw new Exception("Você precisa passar os TABELA e COLUNA caso queria WHERE também!");
        }

        $where = " WHERE {$this->where}";
        if(isset($this->where) == null){
            $where = "";
        }
        $query = "SELECT {$this->columns} FROM {$this->table} $where";

        $cn = new Conexao();
        $con = $cn->connect();
        $sql = $con->query($query);

        return $sql;
        
    }

    //INSERT
    public function setInsert(string $table, string $columns, string $value)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->value = $value;
        return $this->getInsert();
    }

    public function getInsert()
    {
        if((empty($this->columns)) || (empty($this->value)) || (empty($this->table))){
            throw new Exception("Você precisa passar todos os campos!");
        }

        $query = "INSERT INTO {$this->table} ({$this->columns}) VALUES ({$this->value})";

        $cn = new Conexao();
        $con = $cn->connect();
        $sql = $con->query($query);

        return $sql;
        
    }

    //UPDATE
    public function setUpdate(string $table, string $columns, string $where)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->where = $where;
        return $this->getUpdate();
    }

    public function getUpdate()
    {
        if((empty($this->columns)) || (empty($this->where)) || (empty($this->table))){
            throw new Exception("Você precisa passar todos os campos!");
        }

        $where = "WHERE {$this->where}";
        if($this->where == null){
            $where = "";
        }
        $query = "UPDATE {$this->table} SET {$this->columns} $where";

        $cn = new Conexao();
        $con = $cn->connect();
        $sql = $con->query($query);

        return $sql;
        
    }
    
    //DELETE
    public function setDelete(string $table,  string $where)
    {
        $this->table = $table;
        $this->where = $where;
        return $this->getDelete();
    }

    public function getDelete()
    {
        if((empty($this->where)) || (empty($this->table))){
            throw new Exception("Você precisa passar todos os campos!");
        }

        $query = "DELETE FROM {$this->table} WHERE {$this->where}";

        $cn = new Conexao();
        $con = $cn->connect();
        $sql = $con->query($query);

        return $sql;
        
    }
}