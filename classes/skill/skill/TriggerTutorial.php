<?php
	public function trigger(){
			//NB: nel file mi rivolgo a Caster e Target come se fossero derivanti da classi differenti, non è così. Sono la stessa classe. Ho scritto così in modo da rendere il file più leggibile e intuitivo
			
			$Caster = $this->getCaster(); //Colui che lancia la skill
			$Target = $this->getTarget(); //Il Bersaglio della skill (se essa lo richiede, altrimenti sarà null)
			$Equips = $this->getEquips(); //Gli Equips che il Caster ha equipaggiati, ma solo quelli necessari all'utilizzo della skill

			//write è il comando per scrivere un testo nel messaggio
			write($Caster->getNome() . " Sorprende " . $Target->getNome() . " con due attacchi consecutivi!" . "\n");

			//Funzioni di Caster e Target

			//int Caster::getTotalStat(string)
			//		prende il valore totale di una statistica, può ricevere FORZA, DESTREZZA, MAGIA,
			//		INTELLIGENZA, PRECISIONE, ARMATURA, SALVAMAGIA, HP, SAGGEZZA, COSTITUZIONE, CARISMA
			
			$dmg = $Caster->getTotalStat('FORZA');

			//void Caster::heal(int)
			//		cura di un valore int, la curà può essere gestita diversamente da mob a mob e da razza a razza
			$Caster->heal(100) //curo Caster di 100 hp

			//array(Target) Caster::getTargetsInRange(float)
			//		prende tutti gli oggetti target entro una certa distanza float
			//		serve per gli attacchi ad area

			//Esempio danno AOE
			$Danno = new Danno();
			//...Imposto i vari valori dell'oggetto Danno...

			$arrTar = $Caster->getTargetsInRange(3);
			$n = count($arrTar);
			for($i = 0; $i < $n; $i++){
				$Danno->setTarget($arrTar[$i]);
				$Danno->send();
			}

			//Spostarsi verso un Target
			//void Caster::moveTowards(Target)
			$Caster->moveTowards($Target);

			//Spostarsi lontano da un target
			//void Caster::moveAwayFrom(Target)
			$Caster->moveAwayFrom($Target);

			//Per calcolare la distanza tra due punti (ma non dovrebbe servirti)
			//float Caster::getDistanceFrom(Target);
			$distanza = $Caster->getDistanceFrom();


			$da = new Danno();
			//Chi fa il danno, opzioni: $Caster oppure NULL
			$da->setDealer($Caster);
			//Valore del danno
			$da->setDmg($dmg);
			$da->setTipo("FISICO");//MAGICO, FUOCO, CONTUNDENTE, TAGLIENTE, PERFORANTE...
			$da->setPrecisione($Caster->getTotalStat('PRECISIONE'));//Qui è bene mettere la precisione del caster, di base
			$da->setEquips($Equips);
			$da->setTarget($Target);

			//Se voglio aggiungere un debuff/buff al danno
			$Buff = new Buff();
			$Buff->setValue(10);//Valore del buff, mettere in negativo (-10) per debuff
			$Buff->setTurni(4); //Numero di turni di durata
			$Buff->setTarget($Target);//Il Target
			$Buff->setStat('FORZA');//Stat che il buff va a modificare

			//Collego il buff al danno
			$da->addBuff($Buff);

			//Eventuali effetti di equip che modificano il danno
			$this->equipBuff($da);

			//Eventuali effetti di overtime che modificano il danno
			$this->overtimeBuff($da);

			//invio il danno
			$da->send();

			//eventuali effetti di equip
			$this->equipOnAttack();

			//parte il cooldown
			$this->startCooldown($this->getCooldown());

			return true;
		}