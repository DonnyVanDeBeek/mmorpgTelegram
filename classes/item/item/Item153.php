<?php
	//DARDO FISCHIANTE
	class Item153 extends Item{
		private $itemId = 153;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function scagliaDardo(Danno &$Danno){
			if(!$this->togliItem())
				return false;

			write('Un sibilo taglia l\'aria!');
		}
	}
