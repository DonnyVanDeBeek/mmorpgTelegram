<?php
	class TipoOverTime{
		private $TipoOverTimeId;
		private $TipoOverTimeNome;
		private $TipoOverTimeDesc;

		public function __construct($id){
			$sql = "SELECT * FROM BOT_RPG_TIPO_OVERTIME WHERE TIPO_OVERTIME_ID = $id";
			$res = Database()->query($sql);
			$row = $res->fetch_object();

			$this->setTipoOverTimeId($row->TIPO_OVERTIME_ID);
			$this->setTipoOverTimeNome($row->TIPO_OVERTIME_NOME);
			$this->setTipoOverTimeDesc($row->TIPO_OVERTIME_DESC);
		}

		public function getTipoOverTimeId(){
			return $this->tipoOverTimeId;
		}

		public function getTipoOverTimeNome(){
			return $this->tipoOverTimeNome;
		}

		public function getTipoOverTimeDesc(){
			return $this->tipoOverTimeDesc;
		}

		public function setTipoOverTimeId($a){
			$this->tipoOvertimeId = $a;
		}

		public function setTipoOverTimeNome($a){
			$this->tipoOvertimeNome = $a;
		}

		public function setTipoOverTimeDesc($a){
			$this->tipoOvertimeDesc = $a;
		}
	}