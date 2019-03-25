<?php
	//IL PARLATORE
	class Npc62 extends Npc{
		private $npcId = 62;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$voiceId = 'AwADBAADLAMAAoJRmFDkN2ce2nXZ5AI ';
			$this->getUtente()->sendVoice($voiceId);
			write("<b>Il Parlatore</b>: \"Possiedo la voce. Ascolta il mio messaggio vocale.\"");
		}
	}