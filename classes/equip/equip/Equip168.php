<?php
	//MONOCOLO DA CECCHINO
	class Equip168 extends Equip{
		private $equipId = 168;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function buff(Danno &$Danno){
			if($Danno->getPrecisione() != null){
				$prec = $Danno->getPrecisione() * 1.5;
				$Danno->setPrecisione($prec);
				write($this->getTipoEquipNome().' aumenta la precisione del 50%!');
			}
		}
	}