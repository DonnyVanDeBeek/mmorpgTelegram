<?php
    function kMenuPrincipale(){
        $row = array();
        global $emoji;
        global $ut;
        $kMenuPrincipale = new Keyboard();
        $row[] = new Buttonline(
            $emoji['CLIPBOARD'].    "\nAzioni",
            $emoji['MEMO'].         "\nScheda"
        );
        $row[] = new Buttonline(
            $emoji['PEDESTRIAN'].                                   "\nSpostati",
            $emoji['EARTH_GLOBE_'.((rand(0,10) > 5) ? 'A' : 'E')].  "\nPosizione",
            $emoji['HORSE_RACING'].                                   "\nViaggio"
        );
        $row[] = new Buttonline(
            $emoji['BOAR'].                                         "\nCerca Rogne",
            $emoji['JAPANESE_SYMBOL_FOR_BEGINNER'].                 "\nEquip"
        );
        $row[] = new Buttonline(
           $emoji['COLLISION_SYMBOL'].  "\nSkills",
           $emoji['SCHOOL_SATCHEL'].    "\nItem",
           $emoji['BOLT'].              "\nCraft"
        );
        $row[] = new Buttonline(
            $emoji['EYES'].             "\nUtenti",
            $emoji['MAN_AND_WOMAN'].    "\nNPC "
        );

        //$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
        //$kMenuPrincipale->push($sl->getSottoluogoNome());

        foreach($row as $bl){
            $kMenuPrincipale->push($bl);
        }
        unset($bl);

        $lastLine = new Buttonline();

        $gildaId = $ut->isInGilda();
        if($gildaId !== false)
            $lastLine->push("Gilda");

        $lastLine->push($emoji['INFO']."\nInfo");

        $kMenuPrincipale->push($lastLine);


        if($ut->canAddPunti())
            $kMenuPrincipale->push($emoji['PLUS_SIGN']."\nAggiungi Punti");

            return $kMenuPrincipale;
    }

    function kSottoluoghi(){
        global $ut;
        $lu = new Sottoluogo($ut->getUtenteSottoluogoId());
        $kSottoluoghi = new Keyboard();
        //$lu->getArraySottoluogoColumn('NOME')
    	$kSottoluoghi->push($lu->getArrayNomiSottoluoghiVisibili());
        return $kSottoluoghi;
    }

    function kMobs(){
        global $ut;
        $kMobs = new Keyboard();
        $kMobs->push(ARROW_BACK."\n".'Torna Indietro');
        $arr = $ut->selectAllMobsInRange();
        if(count($arr) > 0)
    	    $kMobs->push($arr);
        else
            $kMobs->push('Sei troppo distante o vicino per usare questa skill su qualcuno!');
        return $kMobs;
    }

    function kItems(){
        global $ut;
        $kItems = new Keyboard();
    	$kItems->push(ARROW_BACK."\n"."Torna al menu principale");
    	$kItems->push($ut->selectAllItems());
        return $kItems;
    }

    function kScompartimenti(){
        global $ut;
        $kItems = new Keyboard();
        $kItems->push(ARROW_BACK."\n"."Torna al menu principale");
        $n = count($ut->selectAllItems())/50;
        for($i = 0; $i < $n; $i++){
            $kItems->push($i+1);
        }
        return $kItems;
    }

    function kItemsInRange($start, $end){
        global $ut;
        $kItems = new Keyboard();
        $kItems->push(ARROW_BACK."\n"."Torna al menu principale");
        //$ut->sendMessage('start: '.$start.' end:'.$end);
        $kItems->push($ut->selectItemsInRange($start, $end));
        return $kItems;
    }

    function kLuoghi(){
        global $db;
        $kLuoghi = new Keyboard();
    	$kLuoghi->push($db->getArrayFromColumnAndTableName('LUOGO_NOME', 'BOT_RPG_LUOGO'));
        return $kLuoghi;
    }

    function kStats(){
        global $db;
        $kStats  = new Keyboard();
        $kStats->push(ARROW_BACK."\n".'Torna Indietro');
    	$kStats->push($db->getArrayFromColumnAndTableName('STAT_NOME', 'BOT_RPG_STAT'));
        return $kStats;
    }

    function kCraft(){
        global $ut;
        $kCraft  = new Keyboard();
        $kCraft->push(ARROW_BACK."\n"."Torna Indietro");
    	//$kCraft->push($ut->selectAllCraftableItems());
        //$kCraft->push("1");
        $n = count($ut->selectAllReceipts())/25;
        for($i = 0; $i < $n; $i++){
            $kCraft->push($i+1);
        }
        return $kCraft;
    }

    function kMuovi(){
        global $emoji;
        $kMuovi = new Keyboard();
    	$bl_1 = new Buttonline("Stai Fermo", $emoji['UP'], "Stai Fermo");
    	$bl_2 = new ButtonLine($emoji['LEFT'], $emoji['DOWN'], $emoji['RIGHT']);
    	$kMuovi->push($bl_1);
    	$kMuovi->push($bl_2);
    	$kMuovi->push("Mappa");
    	$kMuovi->push(ARROW_BACK."\n"."Torna Indietro");
        return $kMuovi;
    }

    function kEquipManager(){
        $kEquipManager = new Keyboard();
    	//$bl_1 = new Buttonline("Aggiungi", "Upgrade");
    	//$bl_2 = new Buttonline("Rimuovi", "Rimuovi Tutto");
    	//$kEquipManager->push($bl_1);
    	//$kEquipManager->push($bl_2);
        $kEquipManager->push(ARROW_BACK."\n"."Torna Indietro");
    	$kEquipManager->push(BRIEFCASE."\n"."Inventario");
        $kEquipManager->push(CROSS_MARK_BUTTON."\n"."Rimuovi Tutto");
        return $kEquipManager;
    }

    function kActiveEquipList(){
        global $ut;
        $kActiveEquipList = new Keyboard();
    	$kActiveEquipList->push(ARROW_BACK."\n"."Torna Indietro");
    	$kActiveEquipList->push($ut->selectAllEquipActive());
        return $kActiveEquipList;
    }

    function kNotActiveEquipList(){
        global $ut;
        $kNotActiveEquipList = new Keyboard();
        $kNotActiveEquipList->push(ARROW_BACK."\n"."Torna Indietro");
        $kNotActiveEquipList->push($ut->selectAllEquipNotActive());
        return $kNotActiveEquipList;
    }

    function kSkills(){
        global $ut;
        $kSkills = new Keyboard();
        $kSkills->push(ARROW_BACK."\n".'Torna Indietro');
        $id = $ut->getId();

        $sql = "SELECT DISTINCT(S.SKILL_ID), S.SKILL_NOME AS NOME, CE.CATEGORIA_EQUIP_ID, CE.CATEGORIA_EQUIP_NOME
            FROM BOT_RPG_SKILL S, BOT_RPG_LEARNED_SKILL LS, BOT_RPG_UTENTE U, BOT_RPG_CATEGORIA_EQUIP CE, BOT_RPG_EQUIP E, BOT_RPG_TIPO_EQUIP TE, BOT_RPG_SKILL_CATEGORIA_EQUIP SCE
            WHERE S.SKILL_ID = LS.LEARNED_SKILL_SKILL_ID
            AND LS.LEARNED_SKILL_UTENTE_ID = U.UTENTE_ID
            AND E.EQUIP_UTENTE_ID = U.UTENTE_ID
            AND E.EQUIP_TIPO_EQUIP_ID = TE.TIPO_EQUIP_ID
            AND TE.TIPO_EQUIP_CATEGORIA_EQUIP_ID = CE.CATEGORIA_EQUIP_ID
            AND E.EQUIP_ATTIVO = 1
            AND SCE.SKILL_ID = S.SKILL_ID
            AND SCE.CATEGORIA_EQUIP_ID = CE.CATEGORIA_EQUIP_ID
            AND U.UTENTE_ID = $id;";
        $res = Database()->query($sql);
        while($row = $res->fetch_object()){
            $kSkills->push($row->NOME);
        }

        $sql = "
        SELECT SKILL_ID, SKILL_NOME AS NOME
        FROM BOT_RPG_SKILL S WHERE S.SKILL_ID NOT IN(SELECT SKILL_ID FROM BOT_RPG_SKILL_CATEGORIA_EQUIP)
        AND S.SKILL_ID IN(SELECT LEARNED_SKILL_SKILL_ID FROM BOT_RPG_LEARNED_SKILL WHERE LEARNED_SKILL_UTENTE_ID = $id)";
        $res = Database()->query($sql);
        while($row = $res->fetch_object()){
            $kSkills->push($row->NOME);
        }



        //$kSkills = $ut->getSkillsButtons();
        //$ut->sendMessage($kSkills);
        return $kSkills;
    }

    function kViaggio(){
        $kViaggio = '["Selezione Luogo"], ["Torna al menu principale"]';
        return $kViaggio;
    }

    function kBattle(){
        $key = new Keyboard();
        $bl1 = new Buttonline(VS."\n"."Seleziona Target", COLLISION_SYMBOL."\n".'Skills');
        $bl2 = new Buttonline(MAP."\n"."Mappa", LEFT_RIGHT_ARROW.UP_DOWN_ARROW."\n"."Muovi", RUNNING_MST.DASHING_AWAY."\n".'Scappa');
        $bl3 = new Buttonline(MEMO."\n"."Scheda Personaggio");
	    $key->push($bl1);
        $key->push($bl2);
        $key->push($bl3);
        return $key;
    }

    function kRespawn(){
	   $kRespawn = '["Respawn"]';
       return $kRespawn;
    }

    function kNpc(){
        global $ut;
        $kNpc = new Keyboard();
        $kNpc->push(ARROW_BACK."\n"."Torna Indietro");
        $kNpc->push($ut->selectAllNpcHere());
        return $kNpc;
    }

    function kNearLuoghi(){
        global $ut;
        $kNearLuoghi = new Keyboard();
        $kNearLuoghi->push(ARROW_BACK."\n".'Torna Indietro');
        $Sottoluogo = new Sottoluogo($ut->getUtenteSottoluogoId());
        $kNearLuoghi->push($Sottoluogo->getNearLuoghiArrayNomi());
        return $kNearLuoghi;
    }

    function kNearSottoluoghi(){
        global $ut;
        $kNearSottoluoghi = new Keyboard();
        $kNearSottoluoghi->push(ARROW_BACK."\n".'Torna Indietro');
        $Sottoluogo = new Sottoluogo($ut->getUtenteSottoluogoId());
        $kNearSottoluoghi->push($Sottoluogo->getNearSottoluoghiVisibiliArrayNomi($ut->getUtenteSottoluogoId()));
        return $kNearSottoluoghi;
    }

    function kOpzioniUtente(){
        $kOpzioniUtente = new Keyboard();
        $kOpzioniUtente->push('Scheda');
        $kOpzioniUtente->push('Equip');
        $kOpzioniUtente->push(ARROW_BACK."\n".'Torna Indietro');
        //$kOpzioniUtente->push('Sfida a duello');
        return $kOpzioniUtente;
    }

    function kDuello(){
        global $emoji;
        $kDuello = new Keyboard();
        $bl_1 = new Buttonline("Stai Fermo", $emoji['UP'], "Stai Fermo");
        $bl_2 = new ButtonLine($emoji['LEFT'], $emoji['DOWN'], $emoji['RIGHT']);
        $bl_3 = new Buttonline("Scheda", "Usa Skill", "Mappa");
        $kDuello->push($bl_1);
        $kDuello->push($bl_2);
        $kDuello->push($bl_3);
        $kDuello->push('Ritirati');
        return $kDuello;
    }

    function kOwnedCategorieEquip(){
        global $ut;
        $kOwnedCategorieEquip = new Keyboard();
        $kOwnedCategorieEquip->push(ARROW_BACK."\n".'Torna Indietro');
        $kOwnedCategorieEquip->push($ut->getAllOwnedCategorieEquipNome());
        return $kOwnedCategorieEquip;
    }

    function kSelectedEquipsByCategoria(){
        global $ut;
        $key = new Keyboard();
        $key->push(ARROW_BACK."\n".'Torna Indietro');
        $key->push($ut->getButtonEquipOwnedByCategoriaId($ut->getUtenteCategoriaEquipId()));
        return $key;
    }

    function kManageSingleEquip($isEquipped){
        global $ut;
        $key = new Keyboard();
        $button = $isEquipped ? REAL_RED_CROSS."\n".'Rimuovi' : GREEN_CHECKMARK."\n".'Equipaggia';
        $bl = new Buttonline($button, UP."\n"."Upgrade");
        $key->push(EYE_BUBBLE."\n".'Visualizza');
        $key->push($bl);
        $key->push(ARROW_BACK."\n".'Torna Indietro');
        return $key;
    }

    function kConfermaCraft(){
        $key = new Keyboard();
        $key->push('Crafta');
        $key->push('Annulla');
        return $key;
    }

    function kProfilo(){
        $key = new Keyboard();
        $key->push(ARROW_BACK."\n".'Torna Indietro');
        $bt1 = new Buttonline("Equip", "Buff/Debuff");
        $bt2 = new Buttonline("Stati", "Quest");
        $key->push($bt1);
        $key->push($bt2);
        //$bt2 = new Buttonline("Buff", "Debuff");
        //$bt3 = new Buttonline("Mob","Pet");
        return $key;
    }

    function kAzioni(){
        $key = new Keyboard();
        $key->push(ARROW_BACK."\n".'Torna Indietro');
        $key->push('Esplora');
        return $key;
    }

    function kHandleItem(){
        $key = new Keyboard();
        $key->push(ARROW_BACK."\n".'Torna Indietro');
        $key->push('Usa');
        return $key;
    }

    function kIncastona(){
        global $ut;
        $key = new Keyboard();
        $key->push(ARROW_BACK."\n".'Torna Indietro');
        $key->push($ut->selectItemsDaIncastonare());
        return $key;
    }

    function kIncastonaConfirm(){
       $key = new Keyboard();
       $key->push('Procedi');
       $key->push('Annulla'); 
       return $key;
    }