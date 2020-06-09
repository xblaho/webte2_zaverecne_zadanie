<?php


/*
------------------
Language: Slovak
------------------
*/
 
$lang = array();
 
//*****************************************
//NAVBAR HEADER
//*****************************************
 
$lang["navbar_index_button_text"] = 'Hlavná stránka';
$lang["navbar_api_description_button_text"] = 'Popis API';
$lang["navbar_octave_commands_button_text"] = 'Octave príkazy';
$lang["navbar_individual_tasks_button_text"] = 'Individuálne úlohy';
$lang["navbar_individual_tasks_submenu_1_button_text"] = 'Szabóová Klaudia';
$lang["navbar_individual_tasks_submenu_2_button_text"] = 'Edi Gurmani';
$lang["navbar_individual_tasks_submenu_3_button_text"] = 'Dat NguyenThe';
$lang["navbar_individual_tasks_submenu_4_button_text"] = 'Blahó András';
$lang["navbar_statistics_button_text"] = 'Štatistika';

//*****************************************
//NAVBAR FOOTER
//*****************************************

$lang["footer_main_h6_1"] = 'O stránke';
$lang["footer_about_text"] = 'Táto stránka bola vytvorená ako záverečný projekt pre predmet Webové technológie 2';

$lang["footer_main_h6_2"] = 'Menu';
$lang["footer_index_button_text"] = 'Hlavná stránka';
$lang["footer_api_description_button_text"] = 'Popis API';
$lang["footer_octave_commands_button_text"] = 'Octave príkazy';
$lang["footer_statistics_button_text"] = 'Štatistika';

$lang["footer_main_h6_3"] = 'Individuálne úlohy';
$lang["footer_individual_tasks_1_button_text"] = 'Szabóová Klaudia';
$lang["footer_individual_tasks_2_button_text"] = 'Edi Gurmani';
$lang["footer_individual_tasks_3_button_text"] = 'Dat NguyenThe';
$lang["footer_individual_tasks_4_button_text"] = 'Blahó András';

$lang["footer_copyright_text"] = 'Webové technológie 2 - FEI STU - 2020 letný semester';

//*****************************************
//INDEX.PHP
//*****************************************

$lang["index_main_h1_text"] = 'Hlavná stránka';
$lang["index_main_h2_text"] = 'Vitajte na našej stránke!';
$lang["index_main_p_text"] = 'Táto stránka bola vytvorená ako záverečný projekt pre predmet Webové technológie 2. Úlohou bola, aby sme si vytvorili webstránku pre rôzne úlohy.';

$lang["index_main_h2_tasks"] = 'Úlohy';
$lang["index_main_ul_li_1"] = 'Vyskúšať prácu s CAS (Computer Aided System)';
$lang["index_main_ul_li_2"] = 'Rôzne výpočty pomocou CAS a API k tomu';
$lang["index_main_ul_li_3"] = 'Popis API';
$lang["index_main_ul_li_4"] = 'Logovanie odoslaných príkazov';
$lang["index_main_ul_li_5"] = 'Grafy a animácie';
$lang["index_main_ul_li_6"] = 'Štatistiky';
$lang["index_main_ul_li_7"] = 'Export do CSV/PDF';

$lang["index_main_h2_task_distribution"] = 'Rozdelenie úloh';
$lang["index_main_table_head_1"] = 'Úloha';
$lang["index_main_table_head_2"] = 'Meno';
$lang["index_main_table_tr_1_td_1"] = 'API pre CAS';
$lang["index_main_table_tr_1_td_2"] = 'Blahó András';
$lang["index_main_table_tr_2_td_1"] = 'Tlmič auta';
$lang["index_main_table_tr_2_td_2"] = 'Klaudia Szabóová';
$lang["index_main_table_tr_3_td_1"] = 'Náklon lietadla';
$lang["index_main_table_tr_3_td_2"] = 'Blahó András';
$lang["index_main_table_tr_4_td_1"] = 'Inverzné kývadlo';
$lang["index_main_table_tr_4_td_2"] = 'Dat NguyenThe';
$lang["index_main_table_tr_5_td_1"] = 'Gulička na tyči';
$lang["index_main_table_tr_5_td_2"] = 'Edi Gurmani';
$lang["index_main_table_tr_6_td_1"] = 'CAS príkazy pri formuláry';
$lang["index_main_table_tr_6_td_2"] = 'DatNguyen The, Edi Gurmani';
$lang["index_main_table_tr_7_td_1"] = 'LOG, databáza';
$lang["index_main_table_tr_7_td_2"] = 'Szabóová Klaudia';
$lang["index_main_table_tr_8_td_1"] = 'E-mail';
$lang["index_main_table_tr_8_td_2"] = 'Blahó András';
$lang["index_main_table_tr_9_td_1"] = 'Export CSV/PDF';
$lang["index_main_table_tr_9_td_2"] = '';

//*****************************************
//APIDESCRIPTION.PHP
//*****************************************

$lang["apidescription_main_h1_text"] = 'Popis API';

$lang["apidescription_main_h2_text"] = 'Popis';
$lang["apidescription_main_p_text"] = 'Pomocou API môžme požiadať Octave, aby vypočítal príklady pre naše účely, taktiež môže vypočítať individuálne príkazy zadané používateľom. API skontroluje, či API key je správny, a tiež, aby všetky potrebné input hodnoty sú zadané. Ak nie, výpočet nevykoná. Odpoveď pozostáva z troch zoznamov, vo formáte JSON. Prvý (data): obsahuje výsledky výpočtu pre úlohy, druhý (final): obsahuje finálne výsledky pre ďalší výpočet, tretí(error): obsahuje chyby pri vykonaní.';

$lang["apidescription_table_h2_text"] = 'Parametre';
$lang["apidescription_table_head_1"] = 'GET parameter';
$lang["apidescription_table_head_2"] = 'Hodnoty';
$lang["apidescription_table_head_3"] = 'Popis';
$lang["apidescription_table_tr_1_td_1"] = 'apikey';
$lang["apidescription_table_tr_1_td_2"] = 'ABC';
$lang["apidescription_table_tr_1_td_3"] = 'Keď používateľ pridá iný key, ako "ABC", API nefunguje';
$lang["apidescription_table_tr_2_td_1"] = 'type';
$lang["apidescription_table_tr_2_td_2"] = 'kyvadlo, tlmenie, tlmenie, gulicka';
$lang["apidescription_table_tr_2_td_3"] = 'Typ výpočtu pre individuálne úlohy';
$lang["apidescription_table_tr_3_td_1"] = 'input';
$lang["apidescription_table_tr_3_td_2"] = 'double';
$lang["apidescription_table_tr_3_td_3"] = 'Input hodnota pre výpočty';
$lang["apidescription_table_tr_4_td_1"] = 'init*';
$lang["apidescription_table_tr_4_td_2"] = 'double';
$lang["apidescription_table_tr_4_td_3"] = 'Rôzne, opcionálne hodnoty pre individuálne úlohy';

//*****************************************
//OCTAVECOMMANDS.PHP
//*****************************************

$lang["octavecommands_main_h1_text"] = 'Octave príkazy';
$lang["octavecommands_input_text"] = 'Zadajte príkaz';
$lang["octavecommands_btn_text"] = 'Vypočítaj!';

//*****************************************
//STATISTICS.PHP
//*****************************************

$lang["statistics_main_h1_text"] = 'Štatistika';
$lang["statistics_table_header_1"] = 'Individuálna úloha';
$lang["statistics_table_header_2"] = 'Používaná (kus)';
$lang["statistics_button"] = 'Poslať štatistiku na email';

//-----------------------------------------
// !!!!! INDIVIDUAL TASKS START !!!!!
//-----------------------------------------

//Szabóová Klaudia
$lang["szaboovaklaudia_main_h1_text"] = 'Szabóová Klaudia - tlmič kolesa ';
$lang["szaboovaklaudia_input"] = 'Požadovaná výška skokovej prekážky';
$lang["szaboovaklaudia_button"] = 'Vypočítať';
$lang["szaboovaklaudia_check_1"] = 'Graf';
$lang["szaboovaklaudia_check_2"] = 'Animácia';
$lang["szaboovaklaudia_error"] = 'Hodnota musí byť medzi -0.3 a 0.3!';
$lang["szaboovaklaudia_graf_label_1"] = 'Poloha kolesa';
$lang["szaboovaklaudia_graf_label_2"] = 'Poloha vozidla';

//Edi Gurmani
$lang["edigurmani_main_h1_text"] = 'Edi Gurmani - názov úlohy';
$lang["edigurmani_example_1"] = 'Example 1';
$lang["edigurmani_example_2"] = 'Example 2';

//Dat NguyenThe
$lang["datnguyenthe_main_h1_text"] = 'Dat NguyenThe - názov úlohy';
$lang["datnguyenthe_example_1"] = 'Example 1';
$lang["datnguyenthe_example_2"] = 'Example 2';
$lang['datnguyenthe_input_placeholder'] = 'požadovaná nová poloha kyvadla';
$lang["datnguyenthe_submit_button"] = 'Spusti';
$lang["datnguyenthe_graph_trace1"] = 'pozicia_kyvadla';
$lang["datnguyenthe_graph_trace2"] = 'uhol_kyvadla';

//Blahó András
$lang["blahoandras_main_h1_text"] = 'Blahó András - lietadlo';
$lang["blahoandras_input_value_label"] = 'Nový náklon lietadla';
$lang["blahoandras_button_label"] = 'Ukáž!';
$lang["blahoandras_checkbox_graf_label"] = 'Sledovať graf';
$lang["blahoandras_checkbox_animation_label"] = 'Sledovať animáciu';
$lang["blahoandras_graf_1_label"] = 'Náklon lietadla';
$lang["blahoandras_graf_2_label"] = 'Náklon zadnej klapky';
?>