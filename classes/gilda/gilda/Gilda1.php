<?php
	Class Gilda1 extends Gilda{
		private $id = 1;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->id);
		}

		public function mainMenu(){
			$npcId = 129;
			$Ut = $this->getUtente();
			Functions::redirectToNpc($Ut, $npcId);
		}
	}