<?php
class ChybaKontroler extends Kontroler
{
    public function zpracuj(array $parametry) : void
    {
		// Hlavička požadavku
		header("HTTP/1.0 404 Not Found");
		// Hlavička stránky
		$this->hlavicka['titulek'] = 'Chyba 404';
		// Nastavení šablony
		$this->pohled = 'chyba';
    }
}