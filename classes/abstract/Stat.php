<?php
    class Stat{
        private $statId;
        private $statNome;

        private $db;

        private $tableName = 'BOT_RPG_STAT';

        public function __construct($id){
            global $con;
            $this->db = $con->getDB();

            $q = "SELECT * FROM ".$this->tableName." WHERE STAT_ID  = ".$id;
            $res = $this->db->query($q);
            $row = $res->fetch_object();

            $this->statId   = $row->STAT_ID;
            $this->statNome = $row->STAT_NOME;
        }

        public function getStatId(){
            return $this->statId;
        }

        public function getStatNome(){
            return $this->statNome;
        }

        public function filter($stat){
            $stat = trim($stat);
            $stat = strtoupper($stat);
            $sql = "SELECT STAT_ID FROM BOT_RPG_STAT WHERE UPPER(STAT_NOME) = '$stat' LIMIT 1";
            $res = Database()->query($sql);
            if($res->num_rows == 1)
                return $stat;
            else
                return 'FORZA';
        }
    }
