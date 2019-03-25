<?php
	//KMERR DISTRUTTORE DI REGNI
	class Npc8 extends Npc{
		private $npcId = 8;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();
			$FendenteStremante = 55;

			$flag = $this->getFlag();

			$onTrue = $this->getSpeakNome()." Sembri un tipo che sa il fatto suo. Ti insegnerò qualcosina, osserva attentamente.\n"; 

			if($flag == 0){
				$prova = 25;
				$Forza = $Ut->getTotalStatNoEquip('FORZA');
				if($Forza >= $prova){
					$this->setFlag(1);
					$res = $Ut->learnSkill($FendenteStremante);
					if($res){
						write($onTrue);
						$Ut->initNotifyLearnSkill();
						$Ut->notifyLearnSkill($FendenteStremante);
					}
					else{
						parent::speak();
						//write($onFalse);
					}
				}
			}

			if($flag == 1)
				parent::speak();
			
		}
	}