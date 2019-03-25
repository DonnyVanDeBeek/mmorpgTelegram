<?php
	//AMBROSIUS MERCANTE DI MERAVIGLIE
	class Npc96 extends Npc{
		private $npcId = 96;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$casi = array();

			$opz = array();
			$opz[0] = array(
							array(
								'testo' => 'Arrivederci!',
								'risposta' => "<b>Ambrosius</b>: Ci vediamo giovanotto!\n",
								'flag' => 1, 
								'backToMenu' => true
							),
							array(
								'testo' => "Piccola Fucina Magica\n1000£",
								'function' => array(
												'object' => parent,
												'name' => 'sellItem', 
												'parameters' => array('tipoItemId' => 99, 'prezzo' => 1000, 'quantita' => 1),
												'onTrue' => "<b>Ambrosius</b>: Buona fortuna con i potenziamenti! Una volta sono riuscito ad arrivare a +24!",
												'onFalse' => "<b>Ambrosius</b>: Ragazzo, non hai abbastanza spiccioli..."
											), 
								'flag' => 2,  
								'backToMenu' => false
							),
							array(
								'testo' => "Boccale Di Fratello Faggtron\n250£",
								'risposta' => "<b>Mercante Abusivo</b>: Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'object' => parent,
												'name' => 'sellEquip', 
												'parameters' => array('tipoEquipId' => 115, 'prezzo' => 250, 'livello' => 1),
												'onTrue' => "<b>Ambrosius</b>: Ottimo acquisto giovane! Hai comprato un boccale di tutto rispetto!",
												'onFalse' => "<b>Ambrosius</b>: Ragazzo, non hai abbastanza spiccioli..."
											), 
								'flag' => 2,  
								'backToMenu' => false
							),
							array(
								'testo' => "Dadi Della Buona Sorte\n200£",
								'risposta' => "<b>Mercante Abusivo</b>: Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'object' => parent,
												'name' => 'sellEquip', 
												'parameters' => array('tipoEquipId' => 87, 'prezzo' => 200, 'livello' => 1),
												'onTrue' => "<b>Ambrosius</b>: Cosa? No... ti assicuro che non sono dadi truccati! Ecco a te!",
												'onFalse' => "<b>Ambrosius</b>: Ragazzo, non hai abbastanza spiccioli..."
											), 
								'flag' => 2,  
								'backToMenu' => false
							),
						);


			$casi[0]['flagPrec'] = null;
			$casi[0]['testo'] = '
Vedi una bancarella tronfia di ninnoli e gingilli cangianti, d\'ogni tipo e forma. Mentre esamini una sfera di cristallo contenente una piccola creatura ti si para di fronte un bizzarro ometto. "Salve, se cerca qualcosa di vago intravisto in un sogno d\'estate, ebbene sono abbastanza sicuro di poterglielo offrire! Ho personalmente aggiunto pezzi mirabolanti e unicissimi alla mia collezione di stramberie vagando in lungo ed in largo. Si fidi della mia parola e non la deluderò!"';
			$casi[0]['opzioni'] = $opz[0];

			//IO E LEI NON CI SIAMO MAI PARLATI
			$casi[1]['flagPrec'] = 0;
			$casi[1]['opzioni'] = array();


			//RENE D'ORCO
			$casi[2]['flagPrec'] = 0;
			$casi[2]['opzioni'] = $opz[0];

			//OFFERTA SPECIALE
			$casi[3]['flagPrec'] = 0;
			$casi[3]['opzioni'] = $opz[0];


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