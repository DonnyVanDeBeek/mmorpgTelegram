<?php
	class Npc1 extends Npc{
		private $npcId = 1;

		public function __construct(){
			parent::__construct($this->npcId);
		}
    }
