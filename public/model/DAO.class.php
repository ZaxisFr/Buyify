<?php

    class DAO {
        private $db;
        private $database = 'sqlite:../model/data/buyify.db';

        function __construct() {
            try {
              $this->db = new PDO($this->database);
            }
            catch (PDOException $e){
              die("erreur de connexion:".$e->getMessage());
            }
        }

        function select(string $table, string $where = '1', $bind = [], string $fields = '*') : array {
            $req = $this->db->prepare("SELECT $fields FROM $table WHERE $where");
            $req->execute($bind);
            return $req->fetchAll();
        }

        function selectAsClass(string $class, string $table, string $where = '1', $bind = [], string $fields = '*') : array {
            $req = $this->db->prepare("SELECT $fields FROM $table WHERE $where");
            $req->execute($bind);
            return $req->fetchAll(PDO::FETCH_CLASS, $class);
        }

        function run($sql, $bind = []) {
            $req = $this->db->prepare($sql);
            $req->execute($bind);
            return $req->fetchAll();
        }
    }

    ?>
