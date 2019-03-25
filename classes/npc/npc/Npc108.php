<?php
	//[NPC ESPLORAZIONE] GROSSA ZUCCA NELLA GABBIA
	class Npc108 extends Npc{
		private $npcId = 108;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();

			$ZuccaGigante = 151;
			$PezzoDiZuccaAberrante = 152;

			$scelteIniziali = new Keyboard();
			$scelteIniziali->push('Prendila');
			$scelteIniziali->push('Spappola');
			$scelteIniziali->push('Intaglia la zucca');

			$kSpappola = new Keyboard();
			$kSpappola->push('Mangia');
			$kSpappola->push('Prendi un pezzo per farla analizzare');

			//frasi
			$prendila = "Sradichi le spesse radici con difficoltà. Sei costretto a scavare fino in profondità per ottenere il tuo bottino. Dopo dieci minuti di lavoro hai quello che cercavi.\n";
			$spappola = "Per quanto colossale, l'ortaggio non sembra aver evoluto la sua scorza. Con un colpo ben assestato la fai esplodere in pezzi. La consistenza è davvero molto liquida all'interno, ti pare come un caco.\n";
			$intagliaLaZucca = "Nonostante i pericoli che ti circondano, nulla ti spaventa. Inizi a lavorare grossolanamente la pianta come ti avevano insegnato a farlo col legno da bambino. Questo inizia a farti pensare e più vai avanti e più comprendi quanto tutto sia cambiato e che ora quel ragazzino è diventato un uomo. Quando finisci la zucca ha un' espressione di allegria e leggerezza e tu una di commozione.\n";
			$mangia = "Nonostante gli effetti infidi sulla natura dell'ambiente inizi a cibartene finché non sei sazio.";
			$prendiUnPezzo = "Non ti fidi dell'ambiente sinistro della gabbia. Decidi di prenderne un grosso pezzo da portare a Kalimiro, lui saprà dirti qualcosa di più.\n";

			switch($this->getFlag()){
				case 0:
					write("<b>Zucca</b>\n");
					write("Da decadi gli esperimenti falliti nella gabbia hanno prodotto un habitat, beh, dal punto di vista scientifico, molto interessante... La vegetazione è cresciuta in vie impressionanti e perverse, avendo anche conseguenze nel microclima e nella fauna locale. Tutte queste creature esistono solo tra queste mura di serra e pochi là fuori nel mondo riuscirebbero a credere a queste presenze inafferrabili. Ogni foglia, piuma e ramo sono un mistero. Facendoti strada tra imponenti felci e il groviglio di radici avvisti una forma di vita strabiliante, quella che pare una zucca di dimensioni inenarrabili.");
					$this->setKeyFlagStatus($scelteIniziali, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Prendila':
							write($prendila);
							$Ut->giveItem($ZuccaGigante);
							$Ut->initNotifyGiveItem();
							$Ut->notifyGiveItem($ZuccaGigante);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Spappola':
							write($spappola);
							$this->setKeyFlagStatus($kSpappola, 2, 18);
						break;

						case 'Intaglia la zucca':
							write($intagliaLaZucca);
							$exp = 30;
							$Ut->giveExp($exp);
							$Ut->notifyGiveExp($exp);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						default:
							write("Scegli un'opzione da tastiera");
							$this->setKeyFlagStatus($scelteIniziali, 1, 18);
						break;
					}
				break;

				case 2:
					switch($this->getText()){
						case 'Mangia':
							write($mangia);
							$Ut->heal(200);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Prendi un pezzo per farla analizzare':
							write($prendiUnPezzo);
							$Ut->giveItem($PezzoDiZuccaAberrante);
							$Ut->initNotifyGiveItem();
							$Ut->notifyGiveItem($PezzoDiZuccaAberrante);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						default:
							write("Scegli un'opzione da tastiera");
							$this->setKeyFlagStatus($kSpappola, 2, 18);
						break;
					}
				break;
				
				default:

				break;
			}
		}
	}