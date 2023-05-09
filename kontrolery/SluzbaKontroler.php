<?php

class SluzbaKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        // Vytvoření instance modelu, který nám umožní pracovat se službami
        $spravceSluzeb = new SpravceSluzeb();
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        $this->data['admin'] = $uzivatel && $uzivatel['admin'];

        // Je zadáno URL ke smazání
        if (!empty($parametry[1]) && $parametry[1] == 'odstranit')
        {
            $this->overUzivatele(true);
            $spravceSluzeb->odstranSluzbu($parametry[0]);
            $this->pridejZpravu('Služba byla odstraněna.');
            $this->presmeruj('sluzba');
        }

        // Je zadáno URL
        if (!empty($parametry[0])) {
            // Získávání služby podle url
            $sluzba = $spravceSluzeb->vratSluzbu($parametry[0]);
            // Pokud nebyla služba s danou URL nalezena, přesměrujeme na ChybaKontroler
            if (!$sluzba)
                $this->presmeruj('chyba');

            // Hlavička stránky
            $this->hlavicka = array(
                'titulek' => $sluzba['titulek'],
                'klicova_slova' => $sluzba['klicova_slova'],
                'popisek' => $sluzba['popisek'],
            );

            // Naplnění proměnných pro šablonu
            $this->data['titulek'] = $sluzba['titulek'];
            $this->data['obsah'] = $sluzba['obsah'];

            // Nastaveni šablony
            $this->pohled = 'sluzba';

        } else {
            // Není zadáno URL služby, vypíšeme všechny
            $sluzby = $spravceSluzeb->vratSluzby();
            $this->data['sluzby'] = $sluzby;
            $this->pohled = 'sluzby';
        }

    }

}