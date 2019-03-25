<?php
	class Skill146 extends Skill{
		//MELODIA FLAUTO: VELOCIZZA BANDITO
		private $id = 146;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();

			$Banditi = array();

			$Bandito = 2;
			$Targs = $Caster->getTargetsInRange(999);
			$n = count($Targs);
			if($n == 0) return false;
			for($i = 0; $i < $n; $i++){
				$T = &$Targs[$i];
				if($T->getCategoria() == $Bandito){
					$Banditi[] = $T;
				}
			}

			if(count($Banditi) > 0){
				shuffle($Banditi);

				write($Caster->getNome() . " suona una melodia che conferisce velocità a ".$Banditi[0]->getNome()."!". "\n");

				$turni = 1;
				$val = rand(20, 50);
				$Banditi[0]->giveBuff("DESTREZZA", $val, $turni);
			}else{
				write($Caster->getNome().' suona la melodia velocizza bandito, ma non ci sono banditi!');
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}