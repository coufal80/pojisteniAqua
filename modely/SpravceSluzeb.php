<?php

// Třída poskytuje metody pro správů služeb v systému
class SpravceSluzeb
{
    // Vrátí službu z databáze podle url
    public function vratSluzbu(string $url) : array
    {
        return Db::dotazJeden('
        SELECT `sluzba_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
        FROM `sluzby`
        WHERE `url` = ?
        ', array($url));

    }

    // Vrátí seznam služeb v databázi
    public function vratSluzby() : array
    {
        return Db::dotazVsechny('
        SELECT `sluzba_id`, `titulek`, `url`, `popisek`
        FROM `sluzby` 
        ORDER BY `sluzba_id` DESC
        ');
    }
                            // Pridal jsem bool
    public function ulozSluzbu(int|bool $id, array $sluzba) : void
    {
        if (!$id)
            Db::vloz('sluzby', $sluzba);
        else
            Db::zmen('sluzby', $sluzba, 'WHERE sluzba_id = ?', array($id));
    }

    public function odstranSluzbu(string $url) : void
    {
        Db::dotaz('
            DELETE FROM sluzby
            WHERE url = ?
            ', array($url));
    }
}