<?php
	//ASPERSORIO CIPOLLOSO
	class Equip130 extends Equip{
		private $equipId = 130;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onHit(&$Target){
			$heal = 50;
			$perc = rand(0,10);
			$limit = 8;
			if($perc > $limit)
				$this->utente->heal($heal);
		}
	}