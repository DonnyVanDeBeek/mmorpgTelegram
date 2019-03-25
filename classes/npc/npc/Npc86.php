<?php
	//BANCO DI LAVORO
	class Npc86 extends Npc{
		private $npcId = 86;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function deduciFrattaglie($arr){
			$intelligenza = $this->getUtente()->getTotalStat('INTELLIGENZA');
			$prova = 50;
			if($intelligenza > $prova){
				return true;
			}else{
				return false;
			}
		}

		public function prendiMannaia(){
			$prova = 50;
			$dest = $this->getUtente()->provaDi('DESTREZZA');
			if($dest > $prova){
				return true;
			}else{
				//$className = 'Sottoluogo'.$this->getUtente()->getSottoluogoId();
				$ST = new Sottoluogo($this->getUtente()->getSottoluogoId());
				$this->battagliaConGoblin($ST);
				return false;
			}
		}

		public function battagliaConGoblin(&$Sottoluogo){
			$ut = &$this->utente;
			$utId = $ut->getId();
			$ut->clearAllMobHere();

			$goblinFurioso = array(
				'ID' => 55,
				'LVL' => 25,
				'HP' => 100,
				'NOME_ID' => 173,
				'UTENTE_ID' => $utId,
				'TARGET_ID' => $utId,
				'TARGET_ENTITA_ID' => 0,
				'X' => 3,
				'Y' => 1
			);
			$Sottoluogo->summonMob($goblinFurioso);


			$ut->setX(3);
			$ut->setY(4);
			$ut->setUtenteStatoId(3);
			$this->setKeyboard(kBattle());
		}

		public function talk(){
			$this->addTimesTalked();
			$casi = array();

			$opz = array();
			$opz[0] = array(
							array(
								'testo' => 'Prendi la mannaia',
								'risposta' => "",
								'function' => array(
												'object' => $this,
												'name' => 'prendiMannaia', 
												'parameters' => array(),
												'onTrue' => "Senza farti vedere, prendi la mannaia",
												'onFalse' => "Senti delle risatine. Girandoti, vedi tre goblin che se la ghignano con fare malefico. Sembra che vogliano la tua pellaccia."
											), 
								'flag' => 0, 
								'backToMenu' => false
							),
							array(
								'testo' => 'Deduci a chi appartengano quelle frattaglie',
								'risposta' => "",
								'function' => array(
												'object' => $this,
												'name' => 'deduciFrattaglie', 
												'parameters' => array(),
												'onTrue' => "Deduci che si tratta di uno gnomo",
												'onFalse' => "Non riesci a capire di chi si tratta"
											), 
								'flag' => 0,  
								'backToMenu' => false
							),
							array(
								'testo' => 'Non fai nulla',
								'risposta' => "Hai scelto di non fare nulla",
								'flag' => 1,  
								'backToMenu' => true
							)
						);


			$casi[0]['flagPrec'] = null;
			$casi[0]['testo'] = "In mezzo alla stanza si erge un tavolo rudimentale fatto di pietra pieno di sangue raggrumato. Un sistema di scanalature lo fa convogliare in alcune tinozze che presumi servano a riutilizzarlo per altri scopi. Sopra rimangono ancora delle frattaglie e una grossa mannaia di bassa fattura.";
			$casi[0]['opzioni'] = $opz[0];

			//IO E LEI NON CI SIAMO MAI PARLATI
			$casi[1]['flagPrec'] = 0;
			$casi[1]['opzioni'] = array();

			$flag = $this->getFlag();
			$txt = $this->getText();
			$flagBTM = false;

			$status = null;
			
			$msg .= $casi[$flag]['testo'];
			$n = count($casi[$flag]['opzioni']);

			if($n == 0){ 
				$this->backToMenu();
				$this->setFlag(0);
				write($msg);
				return 0;
			}

			$finisci = false;
			$st = '';
	
			for($i = 0; $i < $n; $i++){
				$testo = $casi[$flag]['opzioni'][$i]['testo'];
				if($txt == $testo){
					$status = $casi[$flag]['opzioni'][$i]['flag'];
					$this->setFlag($status);
					$msg = $casi[$flag]['opzioni'][$i]['risposta'];

					if(isset($casi[$flag]['opzioni'][$i]['function']['name']) && isset($casi[$flag]['opzioni'][$i]['function']['parameters'])){
						$func = $casi[$flag]['opzioni'][$i]['function']['name'];
						$para = $casi[$flag]['opzioni'][$i]['function']['parameters'];
						$res = call_user_func(array($casi[$flag]['opzioni'][$i]['function']['object'], $func), $para);
						if($res)
							$msg = $casi[$flag]['opzioni'][$i]['function']['onTrue'];
						else
							$msg = $casi[$flag]['opzioni'][$i]['function']['onFalse']; 
					}
				}
			}


			if($status !== null)
				$n = count($casi[$status]['opzioni']);
	
			$opzioni = new Keyboard();
			for($i = 0; $i < $n; $i++){
				if($status !== null)
					$j = $status;
				else
					$j = 0;

				//$this->getUtente()->sendMessage('Entro keyboard');
				$testo = $casi[$j]['opzioni'][$i]['testo'];
				$btm = $casi[$j]['opzioni'][$i]['backToMenu'];
	
				$opzioni->push($testo);
			}

			$usid = $this->getUtente()->getUtenteStatoId();
			if($usid == 18 || $usid == 17){
				$this->getUtente()->setUtenteStatoId(18);
				$this->setKeyboard($opzioni);
			}
	
			if($status !== null){
				//$this->getUtente()->sendMessage('Entro status');
				$n = count($casi[$status]['opzioni']);
	
				if($n == 0 && $this->getUtente()->getUtenteStatoId() == 18){ 
					$this->backToMenu();
					if($casi[$status]['flagPrec'] !== null)
						$this->setFlag($casi[$status]['flagPrec']);
				}
			}

			write($msg);

		}
	}