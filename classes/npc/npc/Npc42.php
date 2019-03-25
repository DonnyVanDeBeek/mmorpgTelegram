<?php
	//BARDO GIANLUNCA
	class Npc42 extends Npc{
		private $npcId = 42;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$msg = '';

			$this->addTimesTalked();

			switch($this->getFlag()){
				case 0:
					$msg .= '<b>Bardo Gianluca</b>"';
					$msg .= 'Salve, avventuriero!"'."\n";
					$msg .= '*Pessimo assolo con l\'arpa*'."\n";
					$msg .= '<b>Bardo Gianluca</b>"';
					$msg .= 'Che ci faccio io qui, vuole sapere?"'."\n";
					$msg .= '*Acuto fortissimo e prolungato accompagnato dallo strimpellamento dell\'arpa*'."\n\n";
					$msg .= '<b>'.$this->getUtente()->getNome().'</b>: Smettila, ti prego'."\n\n";
					$msg .= '<b>Bardo Gianluca</b>."';
					$msg .= 'Badi a come parla! Le conviene darmi del lei! Sono un bardo potente, io...""'."\n";
					$msg .= '*Bardo Gianluca si gratta la testa con nervosismo*'."\n";
					$msg .= '<b>Bardo Gianluca</b>."';
					$msg .= 'Ascolta... è dura per me... prima raccoglievo qualche spicciolo grazie alla mia arpa, poi è arrivato quel maledetto pifferaio a soffiarmi il lavoro! Da allora mi nutro solo di topi di fogna... ma guarda un po\' l\'ironia della sorte! Quel pifferaccio si è messo a incantare i topi ultimamente e io non ho più nulla da mangiare. Ti chiedo solo una cosa, entra in quella casa e metti fuorigioco il pifferaio, io non posso farlo, sono un inutile bardo. Sarai ricompensato a dovere!"';

					$opzioni = new Keyboard();
					$opzioni->push('Va bene, sconfiggerò il pifferaio!');
					$opzioni->push('Scusami, adesso non posso, ma tornerò!');
					$opzioni->push('Mia nonna suona meglio di te, ed è morta.');

					$this->setFlag(1);
					$this->setKeyboard($opzioni);
					$this->getUtente()->setUtenteStatoId(18);
					break;

				case 1:
					switch($this->getText()){
						case 'Va bene, sconfiggerò il pifferaio!':
							$msg .= '<b>Bardo Gianluca</b>."';
							$msg .= 'La ringrazio buonuomo, il pifferaio si trova dentro questa villa!'."\n";
							$this->setFlag(2);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						case 'Scusami, adesso non posso, ma tornerò!':
							$msg .= '<b>Bardo Gianluca</b>."';
							$msg .= 'Non importa... rimarrò da solo... lasciato a me stesso: la dura vita del bardo."'."\n";
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						case 'Mia nonna suona meglio di te, ed è morta.':
							$msg .= '<b>Bardo Gianluca</b>."';
							$msg .= 'RAGAZZINO IMPERTINENTE! NON HAI RISPETTO PER UN POVERO BARDO SENZA TETTO!! VATTENE VIA!"'."\n";
							$this->setFlag(0);
							$this->getUtente()->setUtenteStatoId(17);
							$this->setKeyboard(kNpc());
						break;

						default:
							$msg .= '<b>Bardo Gianluca</b>: ';
							$msg .= 'Exusez moi, credo di avere un po\' di cerume nelle orecchie, potrebbe ripetere?';
					}
				break;

				case 2:
					if($this->getUtente()->getNumTipoMobUccisi(9) > 0){
						$msg .= '<b>Bardo Gianluca</b>: ';
						$msg .= 'Hai sconfitto il pifferaio! Ma come hai fatto??"'."\n\n";
						$msg .= '<b>Quest completata</b>'."\n";
						$this->getUtente()->giveSoldi(50);
						$this->getUtente()->giveExp(25);
						$this->setFlag(3);
					}else{
						$msg .= '<b>Bardo Gianluca</b>: ';
						$msg .= 'Torna da me quando avrai sconfitto il pifferaio!"'."\n";
						$msg .= '*Motivetto con l\'arpa altamente discutibile dal punto di vista melodico*';
					}
				break;

				case 3:
					$msg .= '<b>Bardo Gianluca</b>: ';
					$msg .= 'Ti sarò sempre grato riguardo alla storia del pifferaio! Scriverò una canzone su di te e tutti la canteranno ai banchetti e alle feste! Naturalmente sarò io a suonarla!"'."\n";
					$msg .= '*Una goccia di sudore freddo ti solca il viso*';
				break;
			}

			write($msg);
		}
	}
