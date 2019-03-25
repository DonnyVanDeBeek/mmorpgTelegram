<?php
	//ASCIA ULULANTE
	class Equip84 extends Equip{
		private $equipId = 84;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onAttack(&$target){
			$frasi = array(
				"AUUUUUUUUUUHHH",
				"UAUAUAUAUAUUUHHHH",
				"AAAAAAAAAAAAAAAAAAUUUUH",
				"UOUOUOUOUOUOUOUUUUUHHHH",
				"UUUUUUUUUUUUUUUUUUUUUUUUUUUEEEEEEH",
				"OHUOHUOHUHOUHOHUHOHUHOHUHOHUOOOOOUUUUH",
				"UUUUUUUUUUIIIIIIIIUUUUUHH"
			);
			$n = count($frasi);
			$frase = $frasi[rand(0, $n-1)];

			write("<b>Ascia Ululante</b>: \"".$frase."\"\n");
		}
	}