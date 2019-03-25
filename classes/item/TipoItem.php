<?php
    Class TipoItem{
        protected $tipoItemId;
        protected $tipoItemNome;
        protected $tipoItemDesc;

		private $tableName = 'BOT_RPG_TIPO_ITEM';

        private $db;

        protected $msg = array();

        public function __construct($id){
           //global $con;
           //$this->db = $con->getDB();

        	$this->db = Database();

           $q = "SELECT * FROM ".$this->tableName." WHERE TIPO_ITEM_ID = ".	$id;
		   $res = $this->db->query($q);
		   $row = $res->fetch_object();

		   $this->tipoItemId   = $row->TIPO_ITEM_ID;
		   $this->tipoItemNome = $row->TIPO_ITEM_NOME;
		   $this->tipoItemDesc = $row->TIPO_ITEM_DESC;
           $this->tipoItemCategoriaId = $row->TIPO_ITEM_CATEGORIA_ITEM_ID;
        }


        public function getMsg($name){
            return $this->msg[$name];
        }

		public function getTipoItemId(){
			return $this->tipoItemId;
		}

		public function getTipoItemNome(){
			return $this->tipoItemNome;
		}

		public function getTipoItemDesc(){
			return $this->tipoItemDesc;
		}

        public function getTipoItemCategoriaId(){
            return $this->tipoItemCategoriaId;
        }
    }
