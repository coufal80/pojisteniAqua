<?php
/**
 * Router je speciální typ controlleru, který podle URL adresy zavolá
 * správný controller a jím vytvořený pohled vloží do šablony stránky
 */
class SmerovacKontroler extends Kontroler
{
    /**
     *  Kontroler Instance kontrolleru
     */
	protected Kontroler $kontroler;

    /**
     * Metoda převede pomlčkovou variantu controlleru na název třídy
    */
	private function pomlckyDoVelbloudiNotace(string $text) : string
	{
		$veta = str_replace('-', ' ', $text);
		$veta = ucwords($veta);
		$veta = str_replace(' ', '', $veta);
		return $veta;
	}

    /**
     * Naparsuje URL adresu podle lomítek a vrátí pole parametrů
     * @param string $url URL adresa k naparsování
     * @return array Pole URL parametrů
     */
	private function parsujURL(string $url) : array
	{
		// Naparsuje jednotlivé části URL adresy do asociativního pole
        $naparsovanaURL = parse_url($url);
		// Odstranění počátečního lomítka
		$naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
		// Odstranění bílých znaků kolem adresy
		$naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
		// Rozbití řetězce podle lomítek
		$rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
		return $rozdelenaCesta;
	}

    /**
     * Naparsování URL adresy a vytvoření příslušného controlleru
     * @param array $parametry
     * @return void
     */
    public function zpracuj(array $parametry) : void
    {
		$naparsovanaURL = $this->parsujURL($parametry[0]);
				
		if (empty($naparsovanaURL[0]))		
			$this->presmeruj('sluzba/uvod');		
		// kontroler je 1. parametr URL
		$tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';
		
		if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
			$this->kontroler = new $tridaKontroleru;
		else
			$this->presmeruj('chyba');
		
		// Volání controlleru
        $this->kontroler->zpracuj($naparsovanaURL);
		
		// Nastavení proměnných pro šablonu
		$this->data['titulek'] = $this->kontroler->hlavicka['titulek'];
		$this->data['popisek'] = $this->kontroler->hlavicka['popisek'];
		$this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
		
		// Nastavení hlavní šablony
		$this->pohled = 'rozlozeni';

		$this->data['zpravy'] = $this->vratZpravy();
    }

}