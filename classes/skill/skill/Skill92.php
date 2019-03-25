<?php
	class Skill92 extends Skill{
		//URLO DA BATTAGLIA
		private $id = 92;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();

			write($Caster->getNome() . " alza al cielo la spada urlando, caricandosi di grinta\n");

			$value = 10;
			$turni = 2;

			$Buff = new Buff();
			$Buff->setStat('FORZA');
			$Buff->setTurni($turni);
			$Buff->setValue($value);
			$Buff->setTarget($Caster);
			$Buff->send();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}