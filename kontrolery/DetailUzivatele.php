<?php
// Vytvořeno 3.5.2023
class DetailUzivateleKontroler extends Kontroler
{
    public function zpracuj(array $parametry) : void
    {
        // vytvoření instance modelu, který umožní práci s uživateli
        $spravceUzivatelu = new SpravceUzivatelu();
        // Získání uživatele podel URL
        $detailUzivatele = $spravceUzivatelu->detailUzivatele($parametry[0]); // 3.5.2023
        if (!$detailUzivatele)
            $this->presmeruj('chyba');

        // Hlavička stránky
        $this->hlavicka = array(
            'titulek' => $detailUzivatele['prijmeni'],
            'klicova_slova' => $detailUzivatele['klicova_slova'],
            'popis' => $detailUzivatele['popis'],
        );

        // Naplnění proměnných pro šablonu
        $this->data['titulek'] = $detailUzivatele['titulek'];
        $this->data['obsah'] = $detailUzivatele['obsah'];

        // Nastavení šablony
        $this->pohled = 'detailuzivatele';
    }
}