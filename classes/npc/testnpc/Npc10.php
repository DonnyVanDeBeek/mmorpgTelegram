<?php
	class Npc10 extends Npc{
		private $npcId = 10;
		
		public function __construct(){
			parent::__construct($this->npcId);
		}
	}