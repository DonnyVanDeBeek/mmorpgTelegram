<?php
	//LANTONIEL L'ANZIANO
	class Npc44 extends Npc{
		private $npcId = 44;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$msg = '';
			$this->addTimesTalked();

			switch($this->getFlag()){
				case 0:
					$msg .= "Salve, avventuriero! Io sono Lantoniel, il custode di questo osservatorio.\n";
					$msg .= "Di solito non lascio entrare nessuno, ma tu mi sembri un tipo sveglio.\n";
					$msg .= "Battimi in una partita di scacchi e ti darò una copia delle chiavi dell'osservatorio!\n";
					$msg .= "Ti avverto, sono piuttosto bravo! Accetti la sfida, avventuriero?";

					$opzioni = new Keyboard();
					$opzioni->push('Accetto la sfida, custode!');
					$opzioni->push('...tieniti la chiave.');

					$this->setFlag(1);
					$this->setKeyboard($opzioni);
					$this->getUtente()->setUtenteStatoId(18);
				break;

				case 1:
					switch($this->getText()){
						case 'Accetto la sfida, custode!':
							$msg .= "Lantoniel tira fuori dal nulla una scacchiera. Iniziate a giocare.\n";
							$difficolta = 100;
							$intelligenza = $this->getUtente()->getTotalStat('INTELLIGENZA');
							$intelligenza = $intelligenza < 1 ? 1 : $intelligenza;

							if(rand(0,$difficolta) > rand(0, $intelligenza)){
								$msg .= "Lantoniel riesce facilmente a batterti grazie alle sue abilità";
								$this->setFlag(0);
								$this->getUtente()->setUtenteStatoId(17);
								$this->setKeyboard(kNpc());
							}else{
								$msg .= "<b>Dopo un intensa partita ricca di colpi di scena, riesci a mettere sotto scacco matto Lantoniel, il quale ti consegna la chiave dell'osservatorio.</b>";
								$this->getUtente()->gainItem(26);
								$this->setFlag(2);
								$this->getUtente()->setUtenteStatoId(17);
								$this->setKeyboard(kNpc());
							}
						break;

						case '...tieniti la chiave.':
							$msg .= "L'osservatorio di Oskaria è spettacolare! Non sai che ti perdi, avventuriero! A presto.";
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;
					}


				break;

				case 2:
					$msg .= "Goditi l'osservatorio: è uno spettacolo.\n";
					$msg .= "Io devo leggermi ancora molti manuali sul gioco degli scacchi, non si smette mai di imparare, avventuriero!";
				break;
			}

			write($msg);
		}
	}