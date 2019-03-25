<?php
	class Skill82 extends Skill{
		//TEMPESTA DI FULMINI
		private $id = 82;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			//TEMPESTA DI FULMINI
			//Skill avanzata
			$emoji = "⚡️";
			
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();
			

			$tot_fulmini = mt_rand(2, 7);
			$fulmini = $tot_fulmini;
			
			write($Caster->getNome() . " scatena una tempesta di $tot_fulmini fulmini! " .$emoji. "\n");
			
			$dmg = mt_rand(round($Caster->getTotalStat('MAGIA') * 0.2), round($Caster->getTotalStat('MAGIA') * 0.4));

			$raggio = 3;
			$arrTar = $Caster->getTargetsInRange($raggio);
			shuffle($arrTar); //Ordine bersagli casuale
			$n = count($arrTar);
			for($i = 0; $i < $n and $fulmini > 0; $i++){ //itero i bersagli in range finchè ho fulmini disponibili
				if (mt_rand(0, 4) != 0 and mt_rand(0, 99) < (($fulmini / ($n - $i)) * 100)) { //Ha % di colpire in base ai fulmini e ai bersagli restanti, con 1/5 in piu
					//creazione danno
					$Danno = new Danno();
					$Danno->setDealer($Caster);
					$Danno->setTipo("ELETTRICO");
					$Danno->setPrecisione($Caster->getTotalStat('PRECISIONE') * 10); //non si schivano i fulmini, al massimo è il fulmine che non ti prende, quindi moltiplico
					$Danno->setEquips($Equips);
					$this->equipBuff($Danno);
					$this->overtimeBuff($Danno);
					
					$paralisi_testo = "";
					if (mt_rand(0,1) == 0) { //shocka al 50%, lo shock abbassa solo la costituzione del 10%
						$Buff = new Buff();
						$Buff->setValue(-round($arrTar[$i]->getTotalStat('COSTITUZIONE') / 10));
						$Buff->setTurni(2);
						$Buff->setTarget($arrTar[$i]);
						$Buff->setStat('COSTITUZIONE');
						$Danno->addBuff($Buff);
						$paralisi_testo = " e shockato";
					}
					write($arrTar[$i]->getNome() . " viene colpito".$paralisi_testo." da un fulmine! " .$emoji. "\n");
					$Danno->setTarget($arrTar[$i]);
					$proporzione = round(($raggio - $Caster->getDistanceFrom($arrTar[$i]))/$raggio);
					$Danno->setDmg($dmg * (1 + $proporzione )); //inversamente proporzionale alla distanza
					$Danno->send();
					$fulmini--;
				}
			}

			if ($fulmini > 0) {
				write("$fulmini fulmini non hanno colpito nessuno!\n");
			}
			
			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown()); //5 turni sono onesti

			return true;
		}
	}