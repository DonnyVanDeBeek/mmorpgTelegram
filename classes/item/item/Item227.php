<?php
	//PERGAMENA IMBRATTATA DI SANGUE
	class Item227 extends Item{
		private $itemId = 227;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			write('Ciao ragazzi, sono Donny. Volevo informarvi che sto lavorando alla descrizione della pergamena. Provate a leggerla più tardi!');
		}
	}