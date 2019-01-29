<?php

/**
 * @description Add data to table 'int2_settings_estatemanagement'  - Real estate management (Správa nemovitosti)
 */
$envodb -> query("INSERT INTO " . DB_PREFIX . "int2_settings_estatemanagement VALUES
(1, 'FIMA KV s.r.o.', 'www.fimakv.cz'),
(2, 'MACHEX KV s.r.o.', 'www.machexkv.cz'),
(3, 'IKON spol. s r.o.', 'www.ikon.cz'),
(4, 'Aval Rent s.r.o.', 'www.sprava85.cz'),
(5, 'ORBYT KV s.r.o.', 'www.orbyt.cz'),
(6, 'DOSPRA spol. s r.o.', 'www.dospra.cz'),
(7, 'Norobyt s.r.o.', ''),
(8, 'REBA s.r.o.', 'www.reba.cz'),
(9, 'ALFABYT s.r.o.', 'www.alfabyt.cz'),
(10, 'Bronislava Hánělová', 'www.snkv.cz')");

/**
 * @description Add data to table 'int2_settings_region' - Region (Kraje)
 */
$envodb -> query("INSERT INTO " . DB_PREFIX . "int2_settings_region VALUES
(1, 'Karlovarská kraj','51')");

/**
 * @description Add data to table 'int2_settings_district' - District (Okres)
 */
$envodb -> query("INSERT INTO " . DB_PREFIX . "int2_settings_district VALUES
(1, 1, 'Karlovy Vary','3403'),
(2, 1, 'Sokolov',''),
(3, 1, 'Cheb','')");

/**
 * @description Add data to table 'int2_settings_city'  - Cities (Města)
 */

// District (Okres) Karlovy Vary
$envodb -> query("INSERT INTO " . DB_PREFIX . "int2_settings_city VALUES
(1, 1, 1, 'Abertamy','554979'),
(2, 1, 1, 'Andělská Hora','538001'),
(3, 1, 1, 'Bečov nad Teplou','554995'),
(4, 1, 1, 'Bochov','555029'),
(5, 1, 1, 'Boží Dar','506486'),
(6, 1, 1, 'Božičany','555045'),
(7, 1, 1, 'Bražec','500101'),
(8, 1, 1, 'Březová','537870'),
(9, 1, 1, 'Chodov','578011'),
(10, 1, 1, 'Chyše','555207'),
(12, 1, 1, 'Černava','538019'),
(11, 1, 1, 'Čichalov','506621'),
(13, 1, 1, 'Dalovice','537918'),
(14, 1, 1, 'Děpoltovice','538116'),
(15, 1, 1, 'Doupovské Hradiště','500127'),
(16, 1, 1, 'Hájek','538159'),
(17, 1, 1, 'Horní Blatná','555169'),
(18, 1, 1, 'Hory','551651'),
(19, 1, 1, 'Hradiště','555177'),
(20, 1, 1, 'Hroznětín','555185'),
(21, 1, 1, 'Jáchymov','555215'),
(22, 1, 1, 'Jenišov','537926'),
(23, 1, 1, 'Karlovy Vary','554961'),
(24, 1, 1, 'Kolová','555258'),
(25, 1, 1, 'Krásné Údolí','555304'),
(26, 1, 1, 'Krásný Les','578045'),
(27, 1, 1, 'Kyselka','555347'),
(28, 1, 1, 'Merklín','555363'),
(29, 1, 1, 'Mírová','537934'),
(30, 1, 1, 'Nejdek','555380'),
(31, 1, 1, 'Nová Role','555398'),
(32, 1, 1, 'Nové Hamry','506494'),
(33, 1, 1, 'Ostrov','555428'),
(34, 1, 1, 'Otovice','537969'),
(35, 1, 1, 'Otročín','555444'),
(36, 1, 1, 'Pernink','555452'),
(37, 1, 1, 'Pila','556947'),
(38, 1, 1, 'Pšov','555525'),
(39, 1, 1, 'Potůčky','555479'),
(40, 1, 1, 'Sadov','555533'),
(41, 1, 1, 'Smolné Pece','538027'),
(42, 1, 1, 'Stanovice','555550'),
(43, 1, 1, 'Stráž nad Ohří','555584'),
(44, 1, 1, 'Stružná','555592'),
(45, 1, 1, 'Šemnice','555614'),
(46, 1, 1, 'Štědrá','555622'),
(47, 1, 1, 'Teplička','537845'),
(48, 1, 1, 'Toužim','555657'),
(49, 1, 1, 'Útvina','555681'),
(50, 1, 1, 'Valeč','555690'),
(51, 1, 1, 'Velichov','555703'),
(52, 1, 1, 'Verušičky','555711'),
(53, 1, 1, 'Vojkovice','555738'),
(54, 1, 1, 'Vrbice','566675'),
(55, 1, 1, 'Vysoká Pec','578029'),
(56, 1, 1, 'Žlutice','555762')");

/**
 * @description Add data to table 'int2_settings_ku'  - Katastrální území
 */
// District (Okres) Karlovy Vary
$envodb -> query("INSERT INTO " . DB_PREFIX . "int2_settings_ku VALUES
(1, 1, 1, 1, 'Abertamy','600016'),
(2, 1, 1, 52, 'Albeřice u Hradiště','917923'),
(3, 1, 1, 2, 'Andělská Hora','600369'),
(4, 1, 1, 33, 'Arnoldov','715816'),
(5, 1, 1, 3, 'Bečov nad Teplou','601268'),
(6, 1, 1, 30, 'Bernov','702609'),
(7, 1, 1, 48, 'Bezděkov u Prachomet','732788'),
(8, 1, 1, 4, 'Bochov','606758'),
(9, 1, 1, 43, 'Boč','605891'),
(10, 1, 1, 23, 'Bohatice','663581'),
(11, 1, 1, 40, 'Bor u Karlových Var','607274'),
(12, 1, 1, 38, 'Borek u Štědré','736481'),
(13, 1, 1, 5, 'Boží Dar','608866'),
(14, 1, 1, 6, 'Božičany','608939'),
(15, 1, 1, 48, 'Branišov','627020'),
(16, 1, 1, 4, 'Bražec u Bochova','798720'),
(17, 1, 1, 7, 'Bražec u Doupova','917931'),
(18, 1, 1, 19, 'Bražec u Hradiště','990779'),
(19, 1, 1, 7, 'Bražec u Těšetic','930041'),
(20, 1, 1, 46, 'Brložec u Štědré','763179'),
(21, 1, 1, 35, 'Brť','716642'),
(22, 1, 1, 8, 'Březová','663697'),
(23, 1, 1, 52, 'Budov','780278'),
(24, 1, 1, 20, 'Bystřice u Hroznětína','648507'),
(25, 1, 1, 38, 'Chlum u Novosedel','706922'),
(26, 1, 1, 9, 'Chodov u Bečova nad Teplou','652148'),
(27, 1, 1, 49, 'Chylice u Útviny','775673'),
(28, 1, 1, 10, 'Chyše','655538'),
(29, 1, 1, 23, 'Cihelny','631043'),
(30, 1, 1, 23, 'Čankov','746746'),
(31, 1, 1, 12, 'Černava','620017'),
(32, 1, 1, 49, 'Český Chloumek','673731'),
(33, 1, 1, 11, 'Čichalov','623725'),
(34, 1, 1, 10, 'Čichořice','655511'),
(35, 1, 1, 4, 'Číhaná u Javorné','657727'),
(36, 1, 1, 13, 'Dalovice','624586'),
(37, 1, 1, 26, 'Damice','673901'),
(38, 1, 1, 14, 'Děpoltovice','625515'),
(39, 1, 1, 4, 'Dlouhá Lomnice','626422'),
(40, 1, 1, 48, 'Dobrá Voda u Toužimi','627038'),
(41, 1, 1, 33, 'Dolní Žďár u Ostrova','715859'),
(42, 1, 1, 46, 'Domašín u Zbraslavi','791776'),
(43, 1, 1, 23, 'Doubí u Karlových Var','631051'),
(44, 1, 1, 19, 'Doupov u Hradiště','990833'),
(45, 1, 1, 15, 'Doupovské Hradiště','917940'),
(46, 1, 1, 23, 'Drahovice','663701'),
(47, 1, 1, 42, 'Dražov','632325'),
(48, 1, 1, 48, 'Dřevohryzy','627046'),
(49, 1, 1, 23, 'Dvory','663549'),
(50, 1, 1, 30, 'Fojtov','634492'),
(51, 1, 1, 24, 'Háje u Karlových Var','668559'),
(52, 1, 1, 16, 'Hájek u Ostrova','636681'),
(53, 1, 1, 33, 'Hanušov','678287'),
(54, 1, 1, 4, 'Herstošice','772623'),
(55, 1, 1, 42, 'Hlinky','632317'),
(56, 1, 1, 33, 'Hluboký','664863'),
(57, 1, 1, 17, 'Horní Blatná','642380'),
(58, 1, 1, 44, 'Horní Tašovice','757250'),
(59, 1, 1, 33, 'Horní Žďár u Ostrova','715824'),
(60, 1, 1, 18, 'Hory u Jenišova','658383'),
(61, 1, 1, 20, 'Hroznětín','648515'),
(62, 1, 1, 1, 'Hřebečná','600024'),
(63, 1, 1, 52, 'Hřivínov','780286'),
(64, 1, 1, 10, 'Jablonná u Chyší','655619'),
(65, 1, 1, 21, 'Jáchymov','656437'),
(66, 1, 1, 53, 'Jakubov','784532'),
(67, 1, 1, 4, 'Javorná u Toužimi','657735'),
(68, 1, 1, 32, 'Jelení u Nových Hamrů','706159'),
(69, 1, 1, 22, 'Jenišov','658391'),
(70, 1, 1, 50, 'Jeřeň','776572'),
(71, 1, 1, 4, 'Jesínky','606804'),
(72, 1, 1, 31, 'Jimlíkov','608947'),
(73, 1, 1, 23, 'Karlovy Vary','663433'),
(74, 1, 1, 33, 'Kfely u Ostrova','664871'),
(75, 1, 1, 56, 'Knínice u Žlutic','780936'),
(76, 1, 1, 38, 'Kobylé','736490'),
(77, 1, 1, 48, 'Kojšovice','767921'),
(78, 1, 1, 38, 'Kolešov u Žlutic','736503'),
(79, 1, 1, 24, 'Kolová','668567'),
(80, 1, 1, 48, 'Komárov u Štědré','668672'),
(81, 1, 1, 43, 'Korunní','756423'),
(82, 1, 1, 53, 'Kosmová','669946'),
(83, 1, 1, 50, 'Kostrčany','670685'),
(84, 1, 1, 11, 'Kovářov u Žlutic','623733'),
(85, 1, 1, 4, 'Kozlov','671622'),
(86, 1, 1, 25, 'Krásné Údolí','673749'),
(87, 1, 1, 3, 'Krásný Jez','601276'),
(88, 1, 1, 26, 'Krásný Les','673927'),
(89, 1, 1, 33, 'Květnová','678295'),
(90, 1, 1, 27, 'Kyselka','678678'),
(91, 1, 1, 48, 'Lachovice','767930'),
(92, 1, 1, 46, 'Lažany u Štědré','763187'),
(93, 1, 1, 26, 'Léno','673935'),
(94, 1, 1, 30, 'Lesík','702617'),
(95, 1, 1, 40, 'Lesov','745880'),
(96, 1, 1, 28, 'Lípa','693120'),
(97, 1, 1, 48, 'Luhov u Toužimi','770400'),
(98, 1, 1, 52, 'Luka u Verušiček','688622'),
(99, 1, 1, 30, 'Lužec u Nejdku','634506'),
(100, 1, 1, 43, 'Malý Hrzín','605921'),
(101, 1, 1, 33, 'Maroltov','678309'),
(102, 1, 1, 35, 'Měchov','716651'),
(103, 1, 1, 28, 'Merklín u Karlových Var','693138'),
(104, 1, 1, 31, 'Mezirolí','705241'),
(105, 1, 1, 4, 'Mirotice u Kozlova','671631'),
(106, 1, 1, 29, 'Mírová','695556'),
(107, 1, 1, 56, 'Mlyňany','797774'),
(108, 1, 1, 38, 'Močidlec','706931'),
(109, 1, 1, 11, 'Mokrá u Chyší','655554'),
(110, 1, 1, 33, 'Mořičov','715956'),
(111, 1, 1, 46, 'Mostec','763195'),
(112, 1, 1, 50, 'Nahořečice','670693'),
(113, 1, 1, 30, 'Nejdek','702625'),
(114, 1, 1, 4, 'Německý Chloumek','657743'),
(115, 1, 1, 48, 'Nežichov','770418'),
(116, 1, 1, 14, 'Nivy','625523'),
(117, 1, 1, 27, 'Nová Kyselka','678686'),
(118, 1, 1, 31, 'Nová Role','705250'),
(119, 1, 1, 16, 'Nová Víska u Ostrova','636690'),
(120, 1, 1, 32, 'Nové Hamry','706167'),
(121, 1, 1, 4, 'Nové Kounice','657751'),
(122, 1, 1, 38, 'Novosedly u Žlutic','706949'),
(123, 1, 1, 20, 'Odeř','625531'),
(124, 1, 1, 25, 'Odolenovice','673757'),
(125, 1, 1, 30, 'Oldřichov u Nejdku','702633'),
(126, 1, 1, 28, 'Oldřiš u Merklína','693146'),
(127, 1, 1, 23, 'Olšová Vrata','663654'),
(128, 1, 1, 33, 'Ostrov nad Ohří','715883'),
(129, 1, 1, 43, 'Osvinov','756431'),
(130, 1, 1, 34, 'Otovice u Karlových Var','716596'),
(131, 1, 1, 35, 'Otročín','716669'),
(132, 1, 1, 4, 'Pávice','671649'),
(133, 1, 1, 4, 'Pěčkovice','671657'),
(134, 1, 1, 43, 'Peklo','756458'),
(135, 1, 1, 36, 'Pernink','719315'),
(136, 1, 1, 37, 'Pila','720593'),
(137, 1, 1, 26, 'Plavno','673943'),
(138, 1, 1, 23, 'Počerny','753831'),
(139, 1, 1, 40, 'Podlesí u Sadova','745898'),
(140, 1, 1, 10, 'Podštěly','655571'),
(141, 1, 1, 48, 'Políkno u Toužimi','770426'),
(142, 1, 1, 4, 'Polom u Údrče','772631'),
(143, 1, 1, 21, 'Popov u Jáchymova','656470'),
(144, 1, 1, 35, 'Poseč','716677'),
(145, 1, 1, 39, 'Potůčky','726516'),
(146, 1, 1, 30, 'Pozorka u Nejdku','634522'),
(147, 1, 1, 48, 'Prachomety','732796'),
(148, 1, 1, 46, 'Prohoř','733130'),
(149, 1, 1, 56, 'Protivec u Žlutic','733831'),
(150, 1, 1, 46, 'Přestání','763209'),
(151, 1, 1, 49, 'Přílezy','673765'),
(152, 1, 1, 28, 'Pstruží u Merklína','693154'),
(153, 1, 1, 38, 'Pšov u Žlutic','736511'),
(154, 1, 1, 45, 'Pulovice','762296'),
(155, 1, 1, 19, 'Radošov u Hradiště','991244'),
(156, 1, 1, 27, 'Radošov u Kyselky','678694'),
(157, 1, 1, 10, 'Radotín u Chyší','655597'),
(158, 1, 1, 48, 'Radyně','767964'),
(159, 1, 1, 12, 'Rájec u Černavy','620033'),
(160, 1, 1, 56, 'Ratiboř u Žlutic','780944'),
(161, 1, 1, 23, 'Rosnice u Staré Role','753840'),
(162, 1, 1, 55, 'Rudné','702641'),
(163, 1, 1, 20, 'Ruprechtov u Hroznětína','648523'),
(164, 1, 1, 23, 'Rybáře','663557')");

?>