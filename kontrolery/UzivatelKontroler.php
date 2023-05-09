<?php
// vytvoreno 29.4.2023

class UzivatelKontroler extends Kontroler
{
    public function zpracuj(array $parametry) : void
    {
        
        $spravceUzivatelu = new SpravceUzivatelu();
        
        $uzivatel = $spravceUzivatelu->vratUzivatele();
       

        $this->data['admin'] = $uzivatel && $uzivatel['admin'];

        if (!empty($parametry[1]) && $parametry[1] == 'odstranit')
        {
            $this->overUzivatele(true);
            $spravceUzivatelu->odstranUzivatele($parametry[0]);
            $this->pridejZpravu('Uzivatel byl odstraněn.');
            $this->presmeruj('uzivatele');
        }
        // je zadáno URL
        if (!empty($parametry[0]))
        {   //Získávání uživatele podle url
            $uzivatel = $spravceUzivatelu->vratUzivatele(); // puvodni vratUzivatele a bez parametru
            // Pokud není vyvolá chybu
            if (!$uzivatel)
                $this->presmeruj('chyba');
            // Hlavička stránky
            $this->hlavicka = array(
                'titulek' => $uzivatel['jmeno'],
                'klicova_slova' => $uzivatel['uzivatele_id'],
                'popisek' => $uzivatel['heslo']
            );
            // naplnění proměnných pro šablonu
            $this->data['titulek'] = $uzivatel['jmeno'];
            $this->data['obsah'] = $uzivatel['heslo'];
            // nastavení šablony
            $this->pohled = 'uzivatel'; // uzivatel original 3.5.2023
        }
        else
        {   // Není zadáno url vypíše všechny
            $uzivatel = $spravceUzivatelu->vratUzivateleVsechny(); //vratUzivateleVsechny
            $this->data['uzivatele'] = $uzivatel;
            $this->pohled = 'uzivatele';
        }

    }

}
