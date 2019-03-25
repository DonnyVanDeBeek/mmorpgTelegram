<?php
	//[STORYLINE] 1
	class Npc133 extends Npc{
		private $npcId = 133;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();
			$flag = $this->getFlag();
			$text = $this->getText();

			$initMsg = "<b>L'UOMO IN VERDE</b>\n\nNon appena metti piede nella piazza del mercato, passando dalla via principale senti un gran baccano. Ti avvicini alla folla cittadina proprio mentre un uomo vestito da una casacca verde pugnala una figura incappucciata e fugge stringendo in mano qualcosa che non riesci a riconoscere. Intanto la folla si sbraccia e chiama a tutto fiato le guardie allontanando i curiosi dal luogo del misfatto. Mentre ti accorgi che un'altra figura sta sanguinando a terra il losco figuro con veloci balzi inizia ratto a fuggire.";

			$keyOpz = new Keyboard();
			$keyOpz->push("Insegui");
			$keyOpz->push("Esamina Cadaveri");
			$keyOpz->push("Cerca qualcosa da tirargli addosso");
			$keyOpz->push("Cerca Informazioni");

			$TiraPietra = 'Afferri una pietra di medie dimensioni da terra e la scagli con tutta la tua forza verso l\'uomo, il quale scansa la pietra con estrema facilità';
			$cercaInformazioni = 'Investighi cercando di origliare i bisbiglii della gente. Nulla di speciale, se non che senti parlare anche di un secondo uomo completamente vestito di nero che se la stava dando a gambe';

			if($flag == 0){
				write($initMsg);
				$this->setKeyFlagStatus($keyOpz, 1, 18);
			}

			if($flag == 1){
				switch($text){
					case 'Insegui':
						write('Parte la quest di inseguimento');
						$this->backToMainMenu();
						break;

					case 'Esamina Cadaveri':
						write("Esaminando i cataveri trovi qualcosa:\n\n");
						$lamaDiColtello = 55;
						$saccaDiCibarie = 88;
						$Ut->initGiveItem();
						$Ut->notifyGiveItem($lamaDiColtello, 1);
						$Ut->notifyGiveItem($saccaDiCibarie, 1)
						$Ut->giveItem($lamaDiColtello, 1);
						$Ut->giveItem($saccaDiCibarie, 1);
						break;

					case 'Cerca qualcosa da tirargli addosso':
						write($TiraPietra);
						$this->backToMainMenu();
						break;

					case 'Cerca Informazioni':
						write($cercaInformazioni);
						$this->backToMainMenu();
						break;

					default:
						write("Scegli un opzione valida");
						$this->setKeyFlagStatus($keyOpz, 1, 18);

				}
			}
		}
	}
