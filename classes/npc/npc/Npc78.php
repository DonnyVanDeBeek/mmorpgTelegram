<?php
	//NPC DI PROVA
	class Npc78 extends Npc{
		private $npcId = 78;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$casi = array();

			$opz = array();
			$opz[0] = array(
							array(
								'testo' => 'Non voglio nessuna pozione... grazie!',
								'risposta' => "Torna presto a trovarmi!\n",
								'flag' => 1, 
								'backToMenu' => true
							),
							array(
								'testo' => 'Pozione piccola della forza',
								'risposta' => "Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'name' => 'sellItem', 
												'parameters' => array('tipoItemId' => 6, 'prezzo' => 50, 'quantita' => 1)
											), 
								'flag' => 2,  
								'backToMenu' => false
							),
							array(
								'testo' => 'Pozione piccola della magia',
								'risposta' => "Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'name' => 'sellItem', 
												'parameters' => array('tipoItemId' => 7, 'prezzo' => 50, 'quantita' => 1)
											), 
								'flag' => 3, 
								'backToMenu' => false
							),
							array(
								'testo' => 'Posso farti una domanda?',
								'risposta' => "Sicuro, che vuoi sapere?\n", 
								'flag' => 4, 
								'backToMenu' => false)
						);

			$opz[1] = array(
							array(
								'testo' => 'Sei in regola?',
								'risposta' => "Ma certo... ho tutti i documenti nel... ma dove li avrò lasciati?\n", 
								'flag' => 5, 
								'backToMenu' => false
							),
							array(
								'testo' => 'Si guadagna bene con questo negozietto?',
								'risposta' => "Siamo l'unico negozio di pozioni nei dintorni... ti pare che non guadagnamo?\n", 
								'flag' => 6, 
								'backToMenu' => false
							),
							array(
								'testo' => 'Ho finito con le domande',
								'risposta' => "Ci sentiamo!\n", 
								'flag' => 7, 
								'backToMenu' => true
							),
						);


			$casi[0]['flagPrec'] = null;
			$casi[0]['testo'] = "<b>Mark Jankos</b>: Benvenuto nel negozio di pozioni dei fratelli Jankos!\nEcco a te la lista delle pozioni che ti consiglio!\nPozione piccola della forza - 10 Monete\nPozione piccola della magia - 10 Monete\n";
			$casi[0]['opzioni'] = $opz[0];

			//NON VOGLIO NIENTE
			$casi[1]['flagPrec'] = 0;
			$casi[1]['opzioni'] = array();


			//POZIONE PICCOLA DELLA FORZA
			$casi[2]['flagPrec'] = 0;
			$casi[2]['opzioni'] = $opz[0];

			//POZIONE PICCOLA DELLA MAGIA
			$casi[3]['flagPrec'] = 0;
			$casi[3]['opzioni'] = $opz[0];

			//POSSO FARTI UNA DOMANDA?
			$casi[4]['flagPrec'] = 0;
			$casi[4]['opzioni'] = $opz[1];

			//Sei in regola?
			$casi[5]['flagPrec'] = 0;
			$casi[5]['opzioni'] = $opz[1];

			//Si guadagna bene con questo negozietto?
			$casi[6]['flagPrec'] = 0;
			$casi[6]['opzioni'] = $opz[1];

			//Ho finito con le domande
			$casi[7]['flagPrec'] = 0;
			$casi[7]['opzioni'] = array();//$opz[0];





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
						call_user_func(array(parent, $func), $para);
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

			$this->getUtente()->setUtenteStatoId(18);
			$this->setKeyboard($opzioni);
	
			if($status !== null){
				//$this->getUtente()->sendMessage('Entro status');
				$n = count($casi[$status]['opzioni']);
	
				if($n == 0){ 
					$this->backToMenu();
					if($casi[$status]['flagPrec'] !== null)
						$this->setFlag($casi[$status]['flagPrec']);
				}
			}

			write($msg);

		}
	}