<?php
	class Skill14 extends Skill{
		//PALLA DI FUOCO
		private $id = 14;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			$outputText = $Caster->getNome() . ' lancia una palla di fuoco contro '.$Target->getNome().'! '.PALLA_DI_FUOCO."\n";

			//DEFINISCO IL DANNO
			//IL METODO getTotalStat(string) MI PERMETTE DI PRENDERE UNA STATISTICA DELL'OGGETTO CHE LA RICHIAMA, SIA MOB CHE UTENTE
			$dmg = $Caster->getTotalStat('MAGIA') * 0.4 + $Caster->getTotalStat('INTELLIGENZA') * 0.1;

			//CREO UN NUOVO OGGETTO Danno
			$da = new Danno();
			//IMPOSTO CHI PROVOCA IL DANNO
			$da->setDealer($Caster);
			//IMPOSTO IL VALORE DEL DANNO
			$da->setDmg($dmg);
			//IMPOSTO IL TIPO DI DANNO (FISICO, MAGICO, CONTUNDENTE, PERFORANTE, TAGLIENTE, BRUCIATURA, SANGUINAMENTO...)
			$da->setTipo('FUOCO');
			//IMPOSTO LA PRECISIONE, QUESTA VERRA' CONFRONTATA CON LA DESTREZZA DI CHI RICEVE LA SKILL PER DECIDERE IL DODGE
			$da->setPrecisione(40);
			//IMPOSTO GLI EQUIPS CHE SI ATTIVERANNO DURANTE IL DANNO
			$da->setEquips($Equips);
			//IMPOSTO CHI SUBISCE IL DANNO
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overTimeBuff($da);
			
			if(rand(0,9) == 0){
				$outputText .= "La palla di fuoco è particolarmente ardente!\n";
				$BRUCIATURA = new OverTime();
				$BRUCIATURA->setTipoOverTime('BRUCIATURA');//Il tipo, in questo caso Bruciatura
				$BRUCIATURA->setValue($Caster->getTotalStat('MAGIA') * 0.2); //Il danno (non si chiama danno poiché ci sono anche OverTime di cura)
				$BRUCIATURA->setNumTurni(3);//Turni per cui si protrae
				$BRUCIATURA->setTarget($Target);
				
				$da->addOverTimes($BRUCIATURA);//Aggiungo l'overTime al danno
			}
			
			write($outputText);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
			
			return true;
		}
	}