<?php
	class Npc5 extends Npc{
		private $npcId = 5;
		
		public function __construct(){
			parent::__construct($this->npcId);
		}
	}