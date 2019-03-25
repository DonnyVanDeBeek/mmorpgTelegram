<?php
	class Skill5 extends Skill{
		//VENTO DEL SUD
		private $id = 5;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			$r = rand(2, 5);
			write($Caster->getNome() . ' evoca il Vento Del Sud contro '.$Target->getNome().', il quale viene sbalzato verso nord di ben <b>'.$r.'</b> metri!' . "\n");
			$Target->sposta($r, 'NORD');

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}