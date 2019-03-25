<?php
	Class Mob6 extends Mob{
		public function __construct($id){
			parent::__construct($id);
		}

		public function scoccaFreccia(){
			$range = 20;
			$Target = $this->target;
			if($this->getDistanceFrom($Target) > $range){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome() . ' scocca una freccia verso ' . $Target->getNome() . ' '.BOW."\n");

			$dmg = (int)$this->getTotalStat('FORZA')/2;
			
			$dan = new Danno();
			$dan->setDealer($this);
			$dan->setDmg($dmg);
			$dan->setTipo('FISICO');
			$dan->setElemento('LOTTA');
			$dan->setPrecisione(50);

			$Target->subisciDanno($dan);

			//COSTRUISCI MESSAGGIO
			//$msg .= $Target->getMsg('SUBISCI_DANNO');
				
			//$this->msg['SKILL'] = $msg;

			return true;
		}

		public function scoccaFrecciaMagica(){
			$range = 10;
			$Target = $this->target;
			if($this->getDistanceFrom($Target) > $range){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome() . ' scocca una freccia <b>magica</b> verso ' . $Target->getNome() . ' '.BOW."\n");

			$dmg = (int)$this->getTotalStat('FORZA')/3;
			

			$Debuff = new Buff();
			$Debuff->setUtente($Target);
			$Debuff->setStat('COSTITUZIONE');
			$Debuff->setDurata(100);
			$Debuff->setValue(rand(-30, -10));

			$dan = new Danno();
			$dan->setDealer($this);
			$dan->setDmg($dmg);
			$dan->setTipo('FISICO');
			$dan->setElemento('LOTTA');
			$dan->setPrecisione('80');
			$dan->addBuff($Debuff);

			$Target->subisciDanno($dan);

			return true;
		}
	}
