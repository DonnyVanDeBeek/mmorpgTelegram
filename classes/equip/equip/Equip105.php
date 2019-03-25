<?php
	//DAGA DELL'OLTRETOMBA
	class Equip105 extends Equip{
		private $equipId = 105;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function buff(Danno &$Danno){
			if(rand(0,10) > 5){
				write($this->getTipoEquipNome().' irradia una luce sinistra.'."\n");
				$Buff = new Buff();
				$Buff->setStat('DESTREZZA');
				$Buff->setDurata(100);
				$Buff->setValue(rand(-5, -15));
				$Buff->setTarget($Danno->getTarget());
				$Danno->addBuff($Buff);
			}
		}

		public function effect(){
			$Utente = $this->utente;
			write("La maledizione di ".$this->getTipoEquipNome().' colpisce il suo portatore!'."\n");
			$Utente->setHp($Utente->getHp() - 5);
			write($Utente->getNome().' perde 5 HP!'."\n");
		}
	}