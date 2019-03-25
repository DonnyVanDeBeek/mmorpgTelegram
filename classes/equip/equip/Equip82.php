<?php
	//ANELLO "SCEMO CHI LEGGE"
	class Equip82 extends Equip{
		private $equipId = 82;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function effect(){
			$Ut = $this->utente;

			write("Ti distrai osservando la scritta \"Scemo chi legge\" incisa sul tuo anello");

			$D = new Danno();
			$D->setDealer(null);
			$D->setTarget($Ut);
			$D->setDmg(15);
			$D->setPrecisione(9999);
			$D->setTipo('PURO');

			
		}
	}