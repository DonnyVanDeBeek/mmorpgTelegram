<?php
	Class Razza0 extends Utente{
		private $target;

		public function __construct($UTENTE_ID){
			parent::__construct($UTENTE_ID);
		}

		public function vigoreUmano(){
			write("Vigore Umano di ".$this->getNome()." si attiva!");
			$heal = $this->getTotalStat('HP') * 0.3;
			$this->heal($heal);
		}

		public function passive(){
			$memo = 'VIGORE_UMANO';
			$val = $this->getMemo($memo);
			if($val == 3){
				$this->vigoreUmano();
				$this->setMemo($memo, 0);
			}else{
				$this->setMemo($memo, $val + 1);
			}
		}

	}
