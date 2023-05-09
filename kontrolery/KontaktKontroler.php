<?php

class KontaktKontroler extends Kontroler
{
	public function zpracuj(array $parametry) : void
	{
		$this->hlavicka = array(
			'titulek' => 'Kontaktní formulář',
			'klicova_slova' => 'kontakt, email, formulář',
			'popisek' => 'Kontaktní formulář našeho webu.'
		);
		
		if ($_POST)
		{
			try
			{
				$odesilacEmailu = new OdesilacEmailu();
				$odesilacEmailu->odesliSAntispamem($_POST['rok'], "isynchro@gmail.com", "Email z webu", $_POST['zprava'], $_POST['email']);
				$this->pridejZpravu('Email byl úspšně odeslán.');
				$this->presmeruj('kontakt');
			}
			catch (ChybaUzivatele $chyba)
			{
				$this->pridejZpravu($chyba->getMessage());
			}
		}	
		
		$this->pohled = 'kontakt';
    }
}