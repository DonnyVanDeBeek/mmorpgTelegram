<?php
	class Skill70 extends Skill{
		//ASSAGGIO BIPENNE
		private $id = 70;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function loadVars(){
			//Precisione
			$this->addVar(1, 'MOLT PRECISIONE', '', 1);
			$this->addVar(2, 'SOMM PRECISIONE', '', 0);

			//Forza
			$this->addVar(3, 'MOLT FORZA', '', 1);
			$this->addVar(4, 'SOMM FORZA', '', 1);

			//Frase iniziale
			$this->addFrase(0, 'FRASE INIZIALE', '', "_caster:nome_ da un assaggio d'ascia a _target:nome_");


		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			//write($Caster->getNome() . " da un assaggio d'ascia a " . $Target->getNome() . "!" . "\n");
			write($this->getFrase(0));

			$moltPrecisione = $this->getVar(1);
			$sommPrecisione = $this->getVar(2);

			$moltForza = $this->getVar(3);
			$sommForza = $this->getVar(4);

			$prec = ($Caster->getTotalStat("PRECISIONE") * $moltPrecisione) + $sommPrecisione; 
			$dmg = ($Caster->getTotalStat("FORZA") * $moltForza) + $sommForza;

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("FISICO");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$da->send();

			return true;
		}
	}