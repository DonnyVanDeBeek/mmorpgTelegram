<?php
	//FERNBINDER
	class Npc134 extends Npc{
		private $npcId = 134;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){

	$this->addTimesTalked();
	
	$Ut = $this->getUtente();
	$text = $this->getText();
	$flag = $this->getFlag();
	
	$keyboard1 = new Keyboard();
	$keyboard1->push("Toccalo");
	$keyboard1->push("Parlagli");
	$keyboard1->push("Spaventalo");
	$keyboard1->push("Fissalo");
	$keyboard1->push("Non disturbarlo");
	
	$keyboard2 = new Keyboard();
	$keyboard2->push("Scusi, non intendevo disturbarla");
	$keyboard2->push("Esagerato, manco le avessi scagliato una freccia nel ginocchio!");
	
	$keyboard7 = new Keyboard();
	$keyboard7->push("Raccontami di più sul tuo conto");
	$keyboard7->push("Io sono più forte!");
	$keyboard7->push("Buon per te");
	
	$keyboard8 = new Keyboard();
	$keyboard8->push("Rimani fermo");
	$keyboard8->push("Esegui un balletto improvvisato");
	
	$keyboard3 = new Keyboard();
	$keyboard3->push("Arcieri sexy come te non se ne vedono tutti i giorni");
	$keyboard3->push("Bella faretra, la fanno anche per uomini?");
	$keyboard3->push("Non male il tempo oggi, vero?");
	$keyboard3->push("A cosa stai pensando?");
	
	$keyboard9 = new Keyboard();
	$keyboard9->push("Quali sono le gesta a cui ti riferisci?");
	$keyboard9->push("Il tuo è un pensiero molto profondo");

	if ($flag == 0) {
		write("Ti avvicini all'uomo che brandisce l'arco. Noti dietro di lui la grossa faretra colma di frecce.\n\nSembra assorto nei suoi pensieri. ");
		$this->setKeyFlagStatus($keyboard1, 1, 18);
	}

	if ($flag == 1) {
		switch ($text) {
		case 'Toccalo':
			write("Tenti di afferrargli la mano ma lui si scansa.\n\n\"Ma che pensavi di fare, ragazzino?\"");
			$this->setKeyFlagStatus($keyboard2, 2, 18);
			break;

		case 'Parlagli':
			write("Cosa potresti dirgli per attirare la sua attenzione?");
			$this->setKeyFlagStatus($keyboard3, 3, 18);
			break;

		case 'Spaventalo':
			write("Con tutto il tuo fiato tenti di emettere un urlo spaventoso. Lui sembra ignorarti");
			$this->backToMainMenu(0);
			break;

		case 'Fissalo':
			write("Sembra essere sempre molto pensieroso.");
			$this->setKeyFlagStatus($keyboard1, 1, 18);
			break;

		case 'Non disturbarlo':
			write("Decidi di non disturbare l'arciere");
			$this->backToMainMenu(0);
			break;

		default:
			write("Scegli un opzione valida");
			$this->setKeyFlagStatus($keyboard1, 1, 18);
		}
	}

	if ($flag == 2) {
		switch ($text) {
		case 'Scusi, non intendevo disturbarla':
			write("<b>Fernbinder</b>: Sarà meglio per te. Io sono Fernbinder e non ci penso due volte a infilarti una freccia in mezzo agli occhi");
			$this->backToMainMenu(0);
			break;

		case 'Esagerato, manco le avessi scagliato una freccia nel ginocchio!':
			write("<b>Fernbinder</b>: Attento a come parli. Io sono Fernbinder, uno degli arcieri più abili tra gli uomini");
			$this->setKeyFlagStatus($keyboard7, 7, 18);
			break;

		default:
			write("Scegli un opzione valida");
			$this->setKeyFlagStatus($keyboard2, 2, 18);
		}
	}

	if ($flag == 7) {
		switch ($text) {
		case 'Raccontami di più sul tuo conto':
			write("<b>Fernbinder</b>: Vai al nord e ti sapranno raccontare tutto su di me");
			$this->backToMainMenu(0);
			break;

		case 'Io sono più forte!':
			write("<b>Fernbinder</b>: Questo è tutto da vedere!\n\nFernbinder scaglia una freccia in cielo.\n\n<b>Fernbinder</b>: Resta immobile");
			$this->setKeyFlagStatus($keyboard8, 8, 18);
			break;

		case 'Buon per te':
			write("<b>Fernbinder</b>: Sparisci, marmocchio insolente!");
			$this->backToMainMenu(0);
			break;

		default:
			write("Scegli un opzione valida");
			$this->setKeyFlagStatus($keyboard7, 7, 18);
		}
	}

	if ($flag == 8) {
		switch ($text) {
		case 'Rimani fermo':
			write("Rimani immobile mentre un mezzo sorriso si materializza sul volto di Fernbinder.\n\nUna freccia cade dall'alto ai tuoi piedi, sfiorando di pochi millimetri il tuo naso.\n\n<b>Fernbinder</b>: Mmh, ancora troppo poco preciso. Devo migliorare! Adesso lasciami ai miei pensieri");
			$this->backToMainMenu(0);
			break;

		case 'Esegui un balletto improvvisato':
			write("<b>Fernbinder</b>: Idiota!\n\nFernbinder ti si lancia addosso, facendoti cadere a terra.\nImmediatamente dopo, una freccia atterra nel punto in cui c'eri tu prima di cadere.\n\n<b>Fernbinder</b>: Di questo passo non sopravviverai molto. Ti do un consiglio, quando qualcuno più esperto di te ti da dei consigli, seguili!\nCerca di non farti ammazzare. A presto, idiota.");
			$this->backToMainMenu(0);
			break;

		default:
			write("Scegli un opzione valida");
			$this->setKeyFlagStatus($keyboard8, 8, 18);
		}
	}

	if ($flag == 3) {
		switch ($text) {
		case 'Arcieri sexy come te non se ne vedono tutti i giorni':
			write("<b>Fernbinder</b>: Non ho tempo per le tue stupidaggini, io sono Fernbinder. Sparisci moccioso");
			$this->backToMainMenu(0);
			break;

		case 'Bella faretra, la fanno anche per uomini?':
			write("<b>Fernbinder</b>: Le tue sciocchezze non provocano il grande Fernbinder.\n\nFernbinder ti salta addosso in modo fulmineo. In un istante ti ritrovi a terra con Fernbinder che punta l'arco verso di te con un freccia incoccata puntata verso il tuo cuore.\n\n<b>Fernbinder</b>: O forse mi provocano... non lo so. Ma se fossi davvero arrabbiato con te ti avrei già ucciso. Levati prima che cambi idea");
			$this->backToMainMenu(0);
			break;

		case 'Non male il tempo oggi, vero?':
			write("L'arciere ti fulmina con un'occhiataccia. Meglio lasciar stare.");
			$this->backToMainMenu(0);
			break;

		case 'A cosa stai pensando?':
			write("L'uomo accenna un sorriso.\n\n<b>Fernbinder</b>: Mi fa piacere che tu me lo chieda, io sono Fernbinder. Sovente penso alle mie gesta passate. Adoro fare tuffi nel passato. Tempi che non ritorneranno più. Ma la vità umana è troppo breve per sguazzare nel passato.");
			$this->setKeyFlagStatus($keyboard9, 9, 18);
			break;

		default:
			write("Scegli un opzione valida");
			$this->setKeyFlagStatus($keyboard3, 3, 18);
		}
	}

	if ($flag == 9) {
		switch ($text) {
		case 'Quali sono le gesta a cui ti riferisci?':
			write("<b>Fernbinder</b>: Tu non hai girato molto, vero? Vai a nord e troverai il mio nome un po' ovunque, te lo assicuro");
			$this->backToMainMenu(0);
			break;

		case 'Il tuo è un pensiero molto profondo':
			write("<b>Fernbinder</b>: La saggezza è la più importante delle virtù. Ma anche la più difficile da acquisire");
			$this->backToMainMenu(0);
			break;

		default:
			write("Scegli un opzione valida");
			$this->setKeyFlagStatus($keyboard9, 9, 18);
		}
	}
}

	}
	