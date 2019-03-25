<?php
	//GROSSO POZZO
	class Npc104 extends Npc{
		private $npcId = 104;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function riempiBottiglia(){
			$BottigliaVuota = 137;
			$BottigliaAcqua = 138;

			$Ut = $this->getUtente();

			if($Ut->hasTipoItem($BottigliaVuota)){
				$Ut->togliItem($BottigliaVuota);
				$Ut->giveItem($BottigliaAcqua);
				return true;
			}
			
			return false;
		}

		public function talk(){
			$flag = 0;
			if($this->hasAlreadyTalkedToUser()){
				$flag = $this->getFlag();
				$timestamp = $this->getTimestampLastTimeTalked();
				if(date('Ymd') != date('Ymd', strtotime($timestamp)))
					$flag = 0;
			}

			$onTrue = "Attingi dal pozzo per riempire la bottiglia.\nHai ottenuto una bottiglia d'acqua!";
			$onFalse = "Non hai bottiglie da riempire.\n";
			$fraseGuardiaFalse = "Una guardia ti si avvicina e ti fa notare che hai preso abbastanza acqua per oggi\n";
			$fraseGuardiaTrue = "Chiedi alla guardia se puoi attingere al pozzo. Permesso accordato\n";

			switch($flag){
				case 0:
					if($this->riempiBottiglia()){
						write($onTrue);
						$this->setFlag(1);
					}else{
						write($onFalse);
					}
					$this->addTimesTalked();
				break;

				case 1:
					if($this->riempiBottiglia()){
						write($onTrue);
						$this->setFlag(2);
					}else{
						write($onFalse);
					}
					$this->addTimesTalked();
				break;

				case 2:
					if($this->riempiBottiglia()){
						write($onTrue);
						$this->setFlag(3);
					}else{
						write($onFalse);
					}
					$this->addTimesTalked();
				break;

				case 3:
					$timestamp = empty($timestamp) ? $this->getTimestampLastTimeTalked() : $timestamp;
					if(date('Ymd') == date('Ymd', strtotime($timestamp))){
						write($fraseGuardiaFalse);
					}else{
						write($fraseGuardiaTrue);
						$this->setFlag(0);
					}
				break;
			}
		}
	}