<?php
// Editovano a zakomentovano 1.5.2023

    
    class EditorKontroler extends Kontroler
    {
        public function zpracuj(array $parametry) : void
        {
            $this->overUzivatele(true);
            // Hlavička stránky
            $this->hlavicka['titulek'] = 'Editor služeb';
            // Vytvoření instance modelu
            $spravceSluzeb = new SpravceSluzeb();
            // Příprava služby
            $sluzba = array(
                'sluzba_id' => '',
                'titulek' => '',
                'obsah' => '',
                'url' => '',
                'popisek' => '',
                'klicova_slova' => ''
            );
            // Odeslání formuláře
            if ($_POST)
            {
                // Získání služby z $_POST
                $klice = array('titulek', 'obsah', 'url', 'popisek', 'klicova_slova');
                $sluzba = array_intersect_key($_POST, array_flip($klice));
                // Uloženní služby do DB
                $spravceSluzeb->ulozSluzbu($_POST['sluzba_id'], $sluzba);
                $this->pridejZpravu('Služba byla založena.');
                $this->presmeruj('sluzba/' . $sluzba['url']);
            }
            // Je zadane ULS služby k editaci
            else if (!empty($parametry[0]))
            {
                $nactenaSluzba = $spravceSluzeb->vratSluzbu($parametry[0]);
                if ($nactenaSluzba)
                    $sluzba = $nactenaSluzba;
                else
                    $this->pridejZpravu('Služba nenalezena');
            }
    
            $this->data['sluzba'] = $sluzba;
            $this->pohled = 'editor';
        }
    }
