<?php
	//[STORYLINE] 1 - INSEGUIMENTO
	class Npc127 extends Npc{
		private $npcId = 127;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();
			$flag = $this->getFlag();
			$text = $this->getText();

			$nome = '<b>Salva-Thor Aran\'zuhl</b>:';



			write("Apri gli occhi. Davanti a te si erge un uomo calvo con degli occhiali.\n\n$nome Benvenuto in questo mondo!\nAncora molto ti è sconosciuto, ma non temere. Sono qui per aiutarti! Ti chiedo solo di avere un attimo di pazienza per ascoltare tutto ciò che ho da dirti.\n\nCosa puoi fare?\n\n<b>Equip</b>\nAttraverso questo tasto, puoi gestire i tuoi armamenti. Spada e armatura sono necessarie se vuoi sopravvivere la fuori. Potresti valutare di avere un arco o una balestra se ti piacciono di più. Magari anche un pugnale o un bastone magico, perché no!\nInsomma, qualcosa devi avere. Come dici? Non hai nulla? Non temere, posso darti qualcosina io per iniziare! Vai su Equip, poi inventario e vedrai i miei doni! Vuoi ottenerne altri? Alcuni puoi averli solamente attraverso delle Quest, molti sono craftabili e altri, invece, possono essere comprati in cambio di soldi(£).\n\n\n<b>Skill</b>\nLe skill sono molto importanti e possono essere usate in battaglia. Solamente attraverso un uso sapiente e astuto delle tue skill riuscirai a cavartela nei momenti peggiori. Qualche skill dovresti già conoscerla, per ottenerne altre dovresti trovare qualcuno che te le insegni!\n\n\n<b>Spostamento</b>\nPer conoscere la tua posizione, utilizza semplicemente il tasto Posizione. Per spostarti all'interno di un luogo, utilizza il pulsante Spostati. Per cambiare luogo, utilizza il pulsante viaggio. ATTENZIONE: non è sempre possibile viaggiare, dovrai spostarti per trovare il posto ideale da cui iniziare il viaggio\n\n\n<b>Battaglia</b>\nCliccando su Cerca Rogne inizierai una battaglia, sempre se troverai qualcuno con cui combattere. Dovrai prima selezionare una skill, dopodichè un bersaglio con il tasto Seleziona Target. Potrai inoltre muoverti, cliccando su Muovi e visualizzare il campo di battaglia cliccando su Mappa. Bada bene, potrai utilizzare solo le skill che il tuo equipaggiamento ti permette di utilizzare. Se hai una spada, non potrai utilizzare la skill Scaglia Freccia.\nPerché combattere? In primis, per i punti esperienza ottenuti sconfiggendo i nemici. Bada bene, dovrai vincere la battaglia per ottenere punti esperienza, ovvero sconfiggere ogni nemico. Otterrai anche soldi e oggetti, i cosiddetti item.\n\n\n<b>Item</b>\nGli item sono degli oggetti collezionabili. Ogni item ha una funzione diversa: alcuni possono essere usati per creare degli equip attraverso il crafting, altri possono essere utilizzati, come un panino da mangiare che restituisce vita, altri ancora possono essere lanciati in battaglia per arrecare danno al nemico.\n\n\nCredo di averti annoiato abbastanza. Se hai bisogno di riascoltare queste informazioni clicca sul pulsante Info! Buona avventura!");
				write("PS: sembra esserci un gran baccano nella piazza del mercato, vai a vedere che succede cliccando su SPOSTATI e poi PIAZZA DEL MERCATO\n\n");

			$skillsDaInsegnare = array(0, 24, 25, 144);
			$equipDaDare = array(17, 15, 206);
			$itemDaDare = array(109);

			$n = count($skillsDaInsegnare, true);
			for($i = 0; $i < $n; $i++)
				$Ut->learnSkill($skillsDaInsegnare[$i]);

			$n = count($equipDaDare);
			for($i = 0; $i < $n; $i++)
				$Ut->giveEquip($equipDaDare[$i]);

			$n = count($itemDaDare);
			for($i = 0; $i < $n; $i++){
				$Ut->initNotifyGiveItem();
				$Ut->notifyGiveItem($itemDaDare[$i], 10);
				$Ut->giveItem($itemDaDare[$i], 10);
			}

			$Ut->aumUtenteStatoRegistrazioneId();


			$this->setKeyFlagStatus(kMenuPrincipale(), 0, 0);
		}

		/*
		public function talk(){
			$this->addTimesTalked();

			$Ut = $this->getUtente();
			$flag = $this->getFlag();
			$text = $this->getText();

			$messaggioIniziale = "I tuoi occhi si aprono dolcemente mentre la brezza mattutina accarezza il tuo volto.\nSei disteso nel bel mezzo di una piazza; intorno a te noti varie bancarelle e mercanti\n\nTutto d'un tratto senti qualcosa muoversi nella tua tasca destra: è la mano callosa di un uomo incappucciato che sta frugando nei tuoi vestiti!";
			$kOpzioni1 = new Keyboard();
			$kOpzioni1->push("Urla: <<AL LADRO!>>");
			$kOpzioni1->push("Alzati e combatti");
			$kOpzioni1->push("Lasciati derubare senza fare nulla");

			$fraseFinale = "Sei assalito da mille dubbi.\nCome sei finito in questa piazza?\nDove ti trovi?\nPer quale motivo sei stato derubato?\nForse avevi qualcosa di prezioso?\nChi era quell'uomo?\n\nTi imponi di trovare l'uomo incappucciato per far luce su questa faccenda.";

			if($flag == 0){
				write($messaggioIniziale);
				$this->setKeyFlagStatus($kOpzioni1, 1, 18);
			}

			if($flag == 1){
				switch($text){
					case "Urla: <<AL LADRO!>>":
						write("Sforzando al massimo le tue corde vocali urli \"AL LADRO!\" sperando che qualcuno ti venga in aiuto\n\nSfortunatamente, dalla tua bocca esce un suono flebile che tu stesso fatichi a udire.\n\nL'uomo incappucciato scappa stringendo nel pugno sinistro l'oggetto a te sottratto\n");
						write($fraseFinale);
						$Ut->aumUtenteStatoRegistrazioneId();
						$this->backToMainMenu(0);
					break;

					case "Alzati e combatti":
						write("Ti alzi di scatto tentando di acciuffare il farabutto ma lui è più lesto di te e riesce a fuggire\n");
						write($fraseFinale);
						$Ut->aumUtenteStatoRegistrazioneId();
						$this->backToMainMenu(0);
					break;

					case "Lasciati derubare senza fare nulla":
						write("Rimani impassibile al furto. L'uomo incappucciato, con tutta calma, ti sottrae un oggetto e se la svigna\n");
						write($fraseFinale);
						$Ut->aumUtenteStatoRegistrazioneId();
						$this->backToMainMenu(0);
					break;

					default:
						write("Scegli un'opzione da tastiera");
						$this->setKeyFlagStatus($kOpzioni1, 1, 18);
				}
			}
		}
		*/
	}