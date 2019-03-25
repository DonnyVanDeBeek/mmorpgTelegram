<?php
	Class Mob90 extends TipoMobCat2{
		//BANDITO BALESTRATO
		public function __construct($id){
			parent::__construct($id);
		}

		public function chooseWhatToDo(){
			$Intelligenza = new AI('MANTIENI_DISTANZA');
			$Intelligenza->setDealer($this);
			$Intelligenza->setTarget($this->target);
			$Intelligenza->run();
		}

		public function dealDamage(Danno &$Danno){
			if($this->provaDi('PRECISIONE') > $Danno->getTarget()->provaDi('DESTREZZA') * 2)
				$this->colpoCritico($Danno);


			$value = rand(25, 50);
			$turni = 1;
			$this->giveBuff('PRECISIONE', $value, $turni);
			$Danno->setPrecisione($Danno->getPrecisione() + $value);
		}

		public function colpoCritico(Danno &$Danno){
			write('Il dardo è stato scagliato con estrema precisione, sarà un colpo critico!');
			$Danno->setDmg($Danno->getDmg() * 2);
		}
	}