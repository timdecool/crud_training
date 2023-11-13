<?php

class Database {
    // Propriétés de la classe
    private $db_host;
    private $db_port;
    private $db_name;
    private $db_user;
    private $db_pass;

    // propriété du DSN (Data Source Name)
    private $db_dsn;

    // PDO 
    private $pdo;

    // Constructeur
    public function __construct(
        $db_host = 'localhost',
        $db_port = '3306',
        $db_name = 'dwwm_231020',
        $db_user = 'root',
        $db_pass = ''
    ) {
        $this->db_host = $db_host;
        $this->db_port = $db_port;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_dsn = 'mysql:host='.$this->db_host.';port='.$this->db_port.';dbname='.$this->db_name.';charset=utf8';
    }

    private function getPDO() {
        if($this->pdo===null) {
            try {
                $db = new PDO($this->db_dsn,$this->db_user,$this->db_pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                         
            }
            catch(PDOException $e) {
                echo "Erreur PDO : ".$e->getMessage();
                die();            
            }
            // Si on arrive ici, tout est ok pour avoir notre objet pdo
            $this->pdo = $db;
        }
        return $this->pdo;
    }

    public function query($statement,$params=[],$output="") {
        $stmt = $this->getPDO()->prepare($statement);
        $stmt->execute($params);

        // Préparer l'output
        $r = false;
        if($output === "all") {
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else if($output === "row") {
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else if($output === "col") {
            $r = $stmt->fetchColumn();
        }
        return $r;
    }

    public function limitedQuery($statement,$offset,$limit) {
        $r = false;

        $stmt = $this->getPDO()->prepare($statement);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }


}