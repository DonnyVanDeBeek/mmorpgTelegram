<?php
	//MAESTRO DELLE SPADE NADRIC
	class Npc122 extends Npc{
		private $npcId = 122;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$SaltoLacerativo = 15;
			$UrloDaBattaglia = 92;

			$onTrue = $this->getSpeakNome()." Toccata, fuga e grinta. Osserva attentamente\n";
			$onFalse = $this->getSpeakNome()." Vedo che hai già imparato ciò che vorrei insegnarti. Tuttavia un ripassino non fa mai male.\n";
			$onFuoriOrario = $this->getSpeakNome()." Perdonami, al momento non ho voglia di insegnarti nulla. Torna più tardi.";

			$Ut = $this->getUtente();

			$flag = $this->getFlag(); 

			if($flag == 0){
				$hour = date('H');
				//$Ut->sendMessage($hour);
				if($hour == 18){
					$this->setFlag(1);

					$res = $Ut->learnSkill($SaltoLacerativo);
					$res2 = $Ut->learnSkill($UrloDaBattaglia);

					if($res || $res2){
						write($onTrue);
						$Ut->initNotifyLearnSkill();

						if($res)
							$Ut->notifyLearnSkill($SaltoLacerativo);

						if($res2)
							$Ut->notifyLearnSkill($UrloDaBattaglia);
					}else{
						write($onFalse);
					}

				}else{
					write($onFuoriOrario);
				}
			}

			if($flag == 1)
				write($this->getSpeakNome()." L'arte della spada è un dono per pochi. Spero che i miei insegnamenti ti saranno utili.\n");
				//parent::speak();
			
		}
	}