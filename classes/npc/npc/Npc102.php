<?php
	//[NPC ESPLORAZIONE] CAGNOLINO
	class Npc102 extends Npc{
		private $npcId = 102;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();

			$scelteIniziali = new Keyboard();
			$scelteIniziali->push('Accarezzalo');
			$scelteIniziali->push('Strapazzalo di coccole');
			$scelteIniziali->push('Tiragli un manrovescio');

			$azioniCA = new Keyboard();
			$azioniCA->push('Accasciati a terra in posizione fetale');
			$azioniCA->push('Cerca di spaventare i cani ringhiando');
			$azioniCA->push('Tenta di scusarti in cagnese');

			switch($this->getFlag()){
				case 0:
					write("<b>Un Tenero Cagnolino</b>\n");
					write("Senti abbaiare. Ti giri e un batuffolo di tenerezza ti balza addosso dandoti leccate affettuose. Cosa fai?");
					$this->setKeyFlagStatus($scelteIniziali, 1, 18);
				break;

				case 1:
					switch($this->getText()){
						case 'Accarezzalo':
							$exp = 30;
							write("Accarezzi con cautela il pelo del cagnolino. Sembra gradire.\n");
							write("Hai ottenuto $exp exp!");
							$Ut->giveExp($exp);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Strapazzalo di coccole':
							write('Afferri il cagnolino e inizi a strapazzarlo di coccole! Siete davvero carini insieme!'."\n");
							$B = new Buff();
							$B->setStat('CARISMA');
							$B->setTarget($Ut);
							$B->setValue(30);
							$B->setTurni(5);
							$B->send();
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Tiragli un manrovescio':
							write("Con tutta la tua forza molli un manrovescio sul muso del cagnolino. Muore sul colpo.\n");
							write("Senti degli ululati in lontananza e, presto, ti ritrovi circondato da una dozzina di cani adulti");
							$this->setKeyFlagStatus($azioniCA, 2, 18);
						break;

						default:
							write("Scegli un'opzione da tastiera");
							$this->setKeyFlagStatus($scelteIniziali, 1, 18);
					}
				break;

				case 2:
					switch($this->getText()){
						case 'Accasciati a terra in posizione fetale':
							write('I cani si leccano i baffi avvicinandosi a te. Improvvisamente, preso dall\'istinto di sopravvivenza, balzi in aria, saltando i cani e te la dai a gambe, sperando non ti seguano'."\n");
							write('Dopo cinque minuti di corsa al cardiopalma, ti fermi e dei cani non v\'è traccia');
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Cerca di spaventare i cani ringhiando':
							$exp = 30;
							write("Ringhi possentemente contro i cani. Sembra funzionare visto che se la danno a gambe.\n");
							write("Hai ottenuto $exp exp!");
							$Ut->giveExp($exp);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						case 'Tenta di scusarti in cagnese':
							write('(Ma veramente hai scelto questo?)'."\n");
							write('I cani ti fissano confusi. Dopo un silenzio imbarazzante di parecchi secondi uno ti salta addosso sbranandoti.'."\n".'I cani se ne vanno ma perdi 100 Hp');
							$Ut->setHp($Ut->getHp() - 100);
							$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
						break;

						default:
							write("Scegli un'opzione da tastiera");
							$this->setKeyFlagStatus($azioniCA, 2, 18);	
					}
				break;

			}
		}
	}