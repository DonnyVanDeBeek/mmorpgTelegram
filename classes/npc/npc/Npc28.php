<?php
	class Npc28 extends Npc{
		private $npcId = 28;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			//$msg = '<b>Mark Jankos</b>: ';
			$msg = '';

			switch($this->getFlag()){
				case 0:
					$ScudoDiLegno = new TipoEquip(18);

					$msg = '<b>Mr Lobster</b>: ';
					$msg .= 'L\'armeria Lobster è famosa a Oskaria per i suoi pregati armamenti in legno'."\n";
					$msg .= 'Eccoti una lista!'."\n\n";
					$msg .= $ScudoDiLegno->getTipoEquipNome() . ' - 100 monete'."\n";

					$equips = new Keyboard();
					$equips->push('Sono a posto');
					$equips->push('Scudo di legno (+1)');

					$this->setFlag(1);
					$this->setKeyboard($equips);
					$this->getUtente()->setUtenteStatoId(18);
				break;

				case 1:
					switch($this->getText()){
						case 'Sono a posto':
							$msg .= '<b>Mr Lobster</b>: ';
							$msg .= 'Torna presto a trovarmi se ti serve qualcosa.'."\n";
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						case 'Scudo di legno (+1)':
							$prezzo = 100;
							if($this->getUtente()->getUtenteSoldi() < $prezzo){
								$msg .= "Sei un po' al verde...";
								break;
							}

							$this->getUtente()->giveEquip(18);
							$this->getUtente()->takeSoldi($prezzo);

							$msg .= $this->getUtente()->getMsg('GIVE_EQUIP')."\n\n";
							$msg .= '<b>Mr Lobster</b>: ';
							$msg .= 'Uno scudo di ottima fattura.'."\n";
							$msg .= 'Vuoi altro?'."\n";
						break;

						default:
							$msg .= '<b>Mr Lobster</b>: ';
							$msg .= 'Temo di non capire...';
					}
				break;
			}

			$this->addTimesTalked();
			write($msg);
		}
	}
