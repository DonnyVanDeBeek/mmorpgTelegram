<?php
	//LAMA INCANDESCENTE
	class Equip99 extends Equip{
		private $equipId = 99;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onHit(&$Target){
			$Utente = $this->utente;

			//if(rand(0,10) > 5) return 0;

			write('La lama incandescente ha effetto su '.$Target->getNome().'!'."\n");

			/*
			$OT = new OverTime();
			$OT->setTipoOverTime('BRUCIATURA');
			$OT->setValue($Target->getTotalStat('HP') * 0.05);
			$OT->setNumTurni(3);
			$OT->setTarget($Target);
			$OT->send();
			*/
			$val = $Target->getTotalStat('HP') * 0.05;
			$Target->giveOverTime('BRUCIATURA', $val, 3);
		}
	}