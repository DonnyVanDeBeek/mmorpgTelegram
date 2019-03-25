<?php
	//TELESCOPIO GIGANTE
	class Npc45 extends Npc{
		private $npcId = 45;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$h = date('H');
			if($h < 21 || $h > 6){
				$msg = "Contempli il cielo azzurro.\nLe nuvole sono così vicine che ti sembra di esserci dentro.\nSono bianche e candide, a occhio diresti che sono anche soffici.";
			}else{
				$msg = "Stelle. Migliaia, milioni, miliardi di stelle abitano il cielo notturno.\nTuttavia, quei puntini luminosi che vedi sono solo la luce emanata dalle stelle milioni di anni luce or sono.";
			}
			write($msg);
		}
	}