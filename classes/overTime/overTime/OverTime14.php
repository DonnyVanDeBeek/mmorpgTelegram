<?php
	class OverTime14 extends OverTime{
		private $TipoOverTimeId = 14;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function preTrigger(){
			$Tar = $this->Target;

			write($Tar->getNome().' è confuso');

			if(rand(0,1) == 0){
				write($Tar->getNome().' è così confuso da colpirsi da solo!');
				$dmg = $Tar->getPercentualeStat('HP', 10);
				$Danno = new Danno();
				$Danno->setTarget($Tar);
				$Danno->setTipo('FISICO');
				$Danno->setPrecisione(99999);
				$Danno->setDmg($dmg);
				$Danno->send();

				$Tar->setMovable(false);
				$Tar->setImpaired(true);
			}

			$this->diminuisciTurni();
		}

	}