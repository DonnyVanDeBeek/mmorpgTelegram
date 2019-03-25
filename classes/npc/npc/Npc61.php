<?php
	//BILL
	class Npc61 extends Npc{
		private $npcId = 61;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){
			$this->addTimesTalked();
			$audioId = 'CQADBAADKwMAAoJRmFBG4jSYqrA6hgI';
			$this->getUtente()->sendAudio($audioId);
			write("<b>Bill</b>: \"A fallen angel, in the dark\nNever thought you'd fall so far\nFallen angel, close your eyes\nI won't let you fall tonight\nFallen angel\"");
		}
	}