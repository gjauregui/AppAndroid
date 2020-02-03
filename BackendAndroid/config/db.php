<?php

class Connect extends PDO
{
    private $data=[
        'host'=>'localhost',
        'dbname'=>'id12239785_dbandroid',
        'user'=>'id12239785_root',
        'pass'=>'123456'
    ];

    public function __construct()
    {
        try {
            parent::__construct(
                "mysql:host=".$this->data['host'].";dbname=".$this->data['dbname']."",
                $this->data['user'],
                $this->data['pass'],
                [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::ATTR_EMULATE_PREPARES,false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
            );
        } catch (PDOException $e) {
            die("ERROR".$e->getMessage());
        }
    }
}
