<?php

// Správce uživatelů redakčního systému
class SpravceUzivatelu
{

    /**
     * Vrátí otisk hesla
    */
    public function vratOtisk(string $heslo) : string
    {
        return password_hash($heslo, PASSWORD_DEFAULT);
    }

        // Registrace všech promennych provedena 1.5.2023
      public function registruj(string $jmeno, string $prijmeni, string $rodne_cislo, string $telefon, string $email, string $adresa, string $mesto,  string $heslo, string $hesloZnovu, string $rok) : void
    {
        if ($rok != date('Y'))
            throw new ChybaUzivatele('Chybně vyplněný antispam.');
        if ($heslo != $hesloZnovu)
            throw new ChybaUzivatele('Hesla nesouhlasí.');
        $uzivatel = array(
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'rodne_cislo' => $rodne_cislo,
            'telefon' => $telefon,
            'email' => $email,
            'adresa' => $adresa,
            'mesto' => $mesto,
            'heslo' => $this->vratOtisk($heslo),
        );
        try
        {
            Db::vloz('uzivatele', $uzivatel);
        }
        catch (PDOException $chyba)
        {
            throw new ChybaUzivatele('Uživatel s tímto jménem je již zaregistrovaný.');
        }
    }

    /**
     * Přihlásí uživatele do systému
     */
    public function prihlas(string $jmeno, string $heslo) : void
    {
        $uzivatel = Db::dotazJeden('
            SELECT uzivatele_id, jmeno, prijmeni, admin, heslo
            FROM uzivatele
            WHERE jmeno = ?
        ', array($jmeno));
        if (!$uzivatel || !password_verify($heslo, $uzivatel['heslo']))
            throw new ChybaUzivatele('Neplatné jméno nebo heslo.');
        $_SESSION['uzivatel'] = $uzivatel;
    }

    /**
     * Odhlásí uživatele
     */
    public function odhlas() : void
    {
        unset($_SESSION['uzivatel']);
    }

    /**
     * Vrátí aktuálně přihlášeného uživatele
     */
    public function vratUzivatele() : ?array
    {
        if (isset($_SESSION['uzivatel']))
            return $_SESSION['uzivatel'];
        return null;
    }

  

    // 3.5.2023 **************************************************
    public function detailUzivatele(string $url) : array
    {

        return Db::dotazJeden('
        SELECT *
        FROM uzivatele
        ORDER BY prijmeni
        WHERE url = ?
        ', array($url)); 
            
    }

     
   

    // public function vratUzivatel() : array
    // {
    //     return Db::dotazJeden('SELECT * FROM uzivatele ORDER BY prijmeni')->fetchAll();
    // }


    // Celé texty
	// uzivatele_id 	jmeno 	prijmeni 	rodne_cislo 	telefon 	email 	adresa 	mesto 	kod_sluby 	jmeno_sluby 	heslo
    // Zakomentovaný originál 2.5.2023
    public function vratUzivateleVsechny() :array
    {
        // editovano 1.5.2023
        return Db::dotazVsechny('SELECT uzivatele_id, CONCAT(jmeno, " ", prijmeni) AS cele_jmeno, rodne_cislo, telefon FROM uzivatele ORDER BY prijmeni');
    }

    public function ulozUzivatele(int|bool $id, array $uzivatel) : void
    {
        if (!$id)
            Db::vloz('uzivatele', $uzivatel);
        else
            Db::zmen('uzivatele', $uzivatel, 'WHERE uzivatele_id = ?', array($id));
    }

    // public function odstranUzivatele(string $url) : void
    // {
    //     Db::dotaz('
    //     DELETE FROM uzivatele
    //     WHERE url = ?
    //     ', array($url));
    // } zakomentováno 1.5.2023

    public function odstranUzivatele(int $uzivatel) : void

    {
        Db::dotaz('DELETE FROM uzivatele WHERE uzivatele_id=?', array($uzivatel));
    }
    

}
