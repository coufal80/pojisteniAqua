<?php

class RegistraceKontroler extends Kontroler
{
    public function zpracuj(array $parametry) : void
    {
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Registrace';
        if ($_POST)
        {
            try
            {
                $spravceUzivatelu = new SpravceUzivatelu();
                $spravceUzivatelu->registruj($_POST['jmeno'], $_POST['prijmeni'], $_POST['rodne_cislo'], $_POST['telefon'], $_POST['email'], $_POST['adresa'], $_POST['mesto'], $_POST['heslo'], $_POST['heslo_znovu'], $_POST['rok']);
                $spravceUzivatelu->prihlas($_POST['jmeno'], $_POST['heslo']);
                $this->pridejZpravu('Byl jste úspěšně zaregistrován.');
                $this->presmeruj('administrace');
            }
            catch (ChybaUzivatele $chyba)
            {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
        // Nastavení šablony
        $this->pohled = 'registrace';
    }
}


