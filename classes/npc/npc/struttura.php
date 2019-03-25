<?php
	//MERCANTE ABUSIVO
	class Npc59 extends Npc{
		private $npcId = 59;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$casi = array();

			$opz = array();
			$opz[0] = array(
							array(
								'testo' => 'Io e lei non ci siamo mai parlati',
								'risposta' => "<b>Mercante Abusivo</b>: ...ma che dic... oh... ehm... vattene!\n",
								'flag' => 1, 
								'backToMenu' => true
							),
							array(
								'testo' => 'Tagliagole (+5)',
								'risposta' => "<b>Mercante Abusivo</b>: Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'object' => parent,
												'name' => 'sellEquip', 
												'parameters' => array('tipoEquipId' => 98, 'prezzo' => 500, 'livello' => 5),
												'onTrue' => "<b>Mercante Abusivo</b>: Usalo solo per legittima difesa... eheheh",
												'onFalse' => "<b>Mercante Abusivo</b>: Andiamo, sono solo 500 monete!"
											), 
								'flag' => 2,  
								'backToMenu' => false
							),
							array(
								'testo' => 'Rene D\'Orco',
								'risposta' => "<b>Mercante Abusivo</b>: Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'object' => parent,
												'name' => 'sellItem', 
												'parameters' => array('tipoItemId' => 85, 'prezzo' => 1000, 'quantita' => 1),
												'onTrue' => "<b>Mercante Abusivo</b>: Psst... eccolo qui, il rene. Non fare rumore!",
												'onFalse' => "<b>Mercante Abusivo</b>: Non ho tempo da perdere! Il prezzo è 1000 monete e non scenderà!"
											), 
								'flag' => 2,  
								'backToMenu' => false
							),
							array(
								'testo' => 'Offerta Speciale',
								'risposta' => "<b>Mercante Abusivo</b>: Ottima scelta, c'è qualcos'altro che posso fare?\n",
								'function' => array(
												'object' => parent,
												'name' => 'sellItem', 
												'parameters' => array('tipoItemId' => 85, 'prezzo' => 4000, 'quantita' => 5),
												'onTrue' => "<b>Mercante Abusivo</b>: Perbacco! Hai fatto un affarone!",
												'onFalse' => "<b>Mercante Abusivo</b>: Torna con più soldi!"
											), 
								'flag' => 3, 
								'backToMenu' => false
							)
						);


			$casi[0]['flagPrec'] = null;
			$casi[0]['testo'] = "<b>Mercante Abusivo</b>: Salve! Lei non è di queste parti, vero? Beh... nemmeno io. Ne vuoi un po'? Cosa? Ma come \"cosa?\"!! Reni d'orco... costano molto.\nGuarda, ti mostro il mio listino:\n\nTagliagole (+5)\nSpada a una mano\n500 monete\n\nRene D'Orco\n1000 monete\n\n(Offerta Speciale)\nRene D'Orco x5\n4000 monete";
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