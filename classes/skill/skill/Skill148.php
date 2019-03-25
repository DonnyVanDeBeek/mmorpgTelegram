<?php
	class Skill148 extends Skill{
		//SPARGI MONETE
		private $id = 148;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			if(!$Caster->togliSoldi(10)){
				write("Non hai abbastanza monete! Oh, andiamo! Te ne servono solamente 10!");
				return false;
			}

			write($Caster->getNome() . " afferra 10 monete dalla sua saccoccia e le lancia sul campo di battaglia "."\n");

			$Bandito = 2;

			$Targets = $Caster->getTargetsInRange(999);
			$n = count($Targets);
			for($i = 0; $i < $n; $i++){
				if($Targets[$i]->getCategoria() == $Bandito)
					$this->provaAConfondereBandito($Targets[$i]);
			}

			return true;
		}

		public function provaAConfondereBandito(&$Ban){
			$Confusione = 14;
			$perc = 50;
			$int = $Ban->getTotalStat('INTELLIGENZA');
			$perc -= intVal($int/10);

			if($perc < 1)
				$perc = 1;

			if(Functions::percentuale($perc))
				$Ban->giveOverTime($Confusione, 0, 3);
		}
	}