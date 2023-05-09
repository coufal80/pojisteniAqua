<?php

// 29.4.2023

//editovano a zakomentovano 1.5.2023
 // Celé texty
	// uzivatele_id 	jmeno 	prijmeni 	rodne_cislo 	telefon 	email 	adresa 	mesto 	kod_sluby 	jmeno_sluby 	heslo sluzba admin
class EditorUzivateluKontroler extends Kontroler
{
    public function zpracuj(array $parametry) : void //3.5.2023 - mažu (array $parametry a vypisuji všechno)
    {
        $this->overUzivatele(true);
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Editor uživatelů';
        // Vytvoření instance modelu
        $spravceUzivatelu = new SpravceUzivatelu();
        // Příprava služby
        $uzivatel = array(
            'uzivatele_id' => '',
            'jmeno' => '',
            'prijmeni' => '',
            'rodne_cislo' => '',
            'telefon' => '',
            'email' => '',
            'adresa' => '',
            'mesto' => '',
            'kod_sluzby' => '',
            'jmeno_sluzby' => '',
            'heslo' => '',
            'sluzba' => ''
        );
        // Odeslání formuláře
        if ($_POST)
        {
            // Získání uživatele z $_POST
            $klice = array('uzivatele_id','jmeno','prijmeni','rodne_cislo','telefon',  'email','adresa',
            'mesto','kod_sluzby','jmeno_sluzby','heslo','sluzba');
            $uzivatel = array_intersect_key($_POST, array_flip($klice));
            // Uloženní uzivatele do DB
            $spravceUzivatelu->ulozUzivatele($_POST['uzivatele_id'], $uzivatel);
            $this->pridejZpravu('Uživatel byl uložen.');
            $this->presmeruj('uzivatel/' . $uzivatel ['url']); // puvodni uzivatel/'url'
        }
        // Je zadane ULS uživatele k editaci
        else if (!empty($parametry[0]))
        {
            
            $nactenyUzivatel = $spravceUzivatelu->vratUzivatele(); //$nactenyUzivatel|vratUzivatele
            if ($nactenyUzivatel) // puv. $nactenyUzivatel
                $uzivatel = $nactenyUzivatel;
            else
                $this->pridejZpravu('Uživatel nenalezen.');
        }

        $this->data['uzivatel'] = $uzivatel; //prepsano 'uzivatel'
        $this->pohled = 'editoruzivatele'; // puvodni 'editoruzivatele'
    }
}



