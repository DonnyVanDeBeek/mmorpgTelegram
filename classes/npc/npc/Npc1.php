<?php
	class Npc1 extends Npc{
		private $npcId = 1;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){

			if(rand(0,10) > 5){
				$str = '';
				$Cipolla = new Item1($this->getUtente());

				$str .= "<b>Vetto</b>: \"<i>Benvenuti al Dragons!\n";
				$str .= 'Uomo, vedo che hai '. $Cipolla->getItemQuantita() . ' cipolle!</i>"';
				write($str);
			}else{
				parent::talk();
			}


			$this->addTimesTalked();
			//return $str;
		}
	}
