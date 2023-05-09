<?php

abstract class Kontroler
{

    /**
     * @var array Pole, jehož indexy jsou poté viditelné v šabloně jako běžné proměnné
     */
    protected array $data = array();
    /**
     * @var string Název šablony bez přípony
     */
    protected string $pohled = "";
    /**
     * @var array|string[] Hlavička HTML stránky
     */
    protected array $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popisek' => '');

    /**
     * Vyrenderuje pohled
     * @return void
     */
    public function vypisPohled(): void
    {
        if ($this->pohled) {
            extract($this->osetri($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("pohledy/" . $this->pohled . ".phtml");
        }
    }

    /**
     * Přesměruje na dané URL
     * @param string $url URL adresa, na kterou přesměrovat
     * @return never
     */
    public function presmeruj(string $url): never
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    private function osetri($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x)) {
            foreach ($x as $k => $v) {
                $x[$k] = $this->osetri($v);
            }
            return $x;
        } else
            return $x;
    }

    public function pridejZpravu(string $zprava) : void
    {
        if (isset($_SESSION['zpravy']))
            $_SESSION['zpravy'][] = $zprava;
        else
            $_SESSION['zpravy'] = array($zprava);
    }

    public function vratZpravy() : array
    {
        if (isset($_SESSION['zpravy']))
        {
            $zpravy = $_SESSION['zpravy'];
            unset($_SESSION['zpravy']);
            return $zpravy;
        } else
            return array();
    }

    public function overUzivatele(bool $admin = false) : void
    {
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        if (!$uzivatel || ($admin && !$uzivatel['admin']))
        {
            $this->pridejZpravu('Nedostatečná oprávnění.');
            $this->presmeruj('prihlaseni');
        }
    }

    /**
     * Hlavní metoda controlleru
     * @param array $parametry Pole parametrů pro využití kontrolerem
     * @return void
     */
    abstract function zpracuj(array $parametry): void;

}