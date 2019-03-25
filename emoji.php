<?php
	$emoji = array(

		'CLIPBOARD' => 						"\xF0\x9F\x93\x8B",
		'PEDESTRIAN' => 					"\xF0\x9F\x9A\xB6",
		'MEMO' => 							"\xF0\x9F\x93\x9D",
		'HORSE_RACING' => 					"\xF0\x9F\x8F\x87",
		'EARTH_GLOBE_A' => 					"\xF0\x9F\x8C\x8E",
		'EARTH_GLOBE_E' => 					"\xF0\x9F\x8C\x8D",
		'BOAR' => 							"\xF0\x9F\x90\x97",
		'SCHOOL_SATCHEL' => 				"\xF0\x9F\x8E\x92",
		'EYES' => 							"\xF0\x9F\x91\x80",
		'COLLISION_SYMBOL' => 				"\xF0\x9F\x92\xA5",
		'SKULL' => 							"\xF0\x9F\x92\x80",
		'JAPANESE_SYMBOL_FOR_BEGINNER' => 	"\xF0\x9F\x94\xB0",
		'LARGE_BLUE_CIRCLE' => 				"\xF0\x9F\x94\xB5",
		'LARGE_RED_CIRCLE' =>				"\xF0\x9F\x94\xB4",
		'BOLT' =>							"\xF0\x9F\x94\xA9",
		'INPUT_SYMBOL_FOR_SYMBOLS' =>		"\xF0\x9F\x94\xA3",
		'WHITE_MEDIUM_SQUARE' =>			"\xE2\x97\xBB",
		'BLACK_MEDIUM_SQUARE' =>			"\xE2\x97\xBC",
		'UP' =>								"\xF0\x9F\x94\xBC",
		'DOWN' =>							"\xF0\x9F\x94\xBD",
		'RIGHT' =>							"\xE2\x96\xB6",
		'LEFT' =>							"\xE2\x97\x80",
		'MAN_AND_WOMAN'	=>					"\xF0\x9F\x91\xAB",
		'PLUS_SIGN'	=>						"\xE2\x9E\x95",
		'ARROW_BACK' =>						"\xF0\x9F\x94\x99",
        'INFO' =>                           "ℹ️"
	);

    define('SYMBOLS_BROKEN_HEART', "\xF0\x9F\x92\x94");
    define('RUN', "\xF0\x9F\x8F\x83");
    define('BOW', "🏹");
    define('ROD', "⚕️");
    define('THUNDERSTORM', "🌩️");
    define('LIGHTNING', "⚡");
    define('FIRE', "\xF0\x9F\x94\xA5");
    define('GREEN_HEART', "\xF0\x9F\x92\x9A");
    define('SYRINGE', "💉");
    define('ARROW_HEART', "💘");
    define('NURSE_WOMAN', "👩‍⚕️");
    define('ATOM', "⚛️");
    define('DOUBLE_HEART', "💕");
    define('ARROW_BACK', "\xF0\x9F\x94\x99");
    define('VS', "\xF0\x9F\x86\x9A");
    define('MAP', "🗺️");
    define('RUNNING_MST', "🏃🏼");
    define('DASHING_AWAY', "💨");
    define('LEFT_RIGHT_ARROW', "↔️");
    define('UP_DOWN_ARROW', "↕️");
    define('MEMO', "\xF0\x9F\x93\x9D");
    define('COLLISION_SYMBOL', "\xF0\x9F\x92\xA5");
    define('BRIEFCASE', "💼");
    define('CROSS_MARK_BUTTON', "❎");
    define('GREEN_CHECKMARK', "✅");
    define('RED_CROSS', "🔴");
    define('REAL_RED_CROSS', "❌");
    define('GREY_CHECKMARK', "☑️");
    define('HAMMER_AND_WRENCH', "🛠️");
    define('BANNED', "🚫");

    define('FORZA', "⚔️");
    define('MAGIA', "🔮");//"🔥");//"🔮");
    define('CARISMA', "💬");
    define('PRECISIONE', "🎯");
    define('SAGGEZZA', "📚");//"🦉");
    define('INTELLIGENZA', "💡");
    define('DESTREZZA', "👟");
    define('ARMATURA', "🛡️");
    define('HP', "♥️");
    define('SALVAMAGIA', "👘");
    define('COSTITUZIONE', "🥩");

    define('MONEY', "💰");

    define('ZERO', "\x30\xE2\x83\xA3");
    define('UNO', "\x31\xE2\x83\xA3");
    define('DUE', "\x32\xE2\x83\xA3");
    define('TRE', "\x33\xE2\x83\xA3");
    define('QUATTRO', "\x34\xE2\x83\xA3");
    define('CINQUE', "\x35\xE2\x83\xA3");
    define('SEI', "\x36\xE2\x83\xA3");
    define('SETTE', "\x37\xE2\x83\xA3");
    define('OTTO', "\x38\xE2\x83\xA3");
    define('NOVE', "\x39\xE2\x83\xA3");

    define('UP', "🆙");
    define('EYE_BUBBLE', "🔍");

    $emojiStats = array(
                'HP'            => HP,
                'FORZA'         => FORZA,
                'MAGIA'         => MAGIA,
                'INTELLIGENZA'  => INTELLIGENZA,
                'PRECISIONE'    => PRECISIONE,
                'CARISMA'       => CARISMA,
                'SAGGEZZA'      => SAGGEZZA,
                'DESTREZZA'     => DESTREZZA,
                'ARMATURA'      => ARMATURA,
                'SALVAMAGIA'    => SALVAMAGIA,
                'COSTITUZIONE'  => COSTITUZIONE
            );
    $addrES = &$emojiStats;
    function getEmojiStats(){
    	global $addrES;
    	return $addrES;
    }

    define('PALLA_DI_FUOCO', "☄️");
