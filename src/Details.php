<?php

class Details {

    private $naslov = '';
    private $lokacija = '';
    private $adresa = '';
    private $struktura = '';
    private $kvadratura = '';
    private $sprat = '';
    private $ukupno_spratova = '';
    private $lift = '';
    private $grejanje = '';
    private $terasa_lodja = '';
    private $god_gradnje = '';
    private $opis = '';
    private $useljiv = '';
    private $uknjizen = '';
    private $cena = '';
    private $telefon1 = '';
    private $telefon2 = '';
    private $ID = '';
    private $datum = '';
    private $azurirano = '';
    private $prizemlje = '';
    //private $type_of_user = '';
    private $vlasnistvo = '';
    private $tip_stavke = '';
    private $broj_u_registru = '';

    public function toCsvHeader() {
        return implode(',', array(
            'naslov',
            'lokacija',
            'adresa',
            'struktura',
            'kvadratura',
            'sprat',
            'ukupno_spratova',
            'lift',
            'grejanje',
            'terasa_lodja',
            'god_gradnje',
            'opis',
            'useljiv',
            'uknjizen',
            'cena',
            'telefon1',
            'telefon2',
            'ID',
            'datum',
            'prizemlje',
            //'type_of_user',
            'vlasnistvo',
            'tip_stavke',
            //'azurirano',
            'broj_u_registru',
        ));
    }

    public function toCsvRow() {
        return implode(',', array(
            $this->packToCsv($this->naslov),
            $this->packToCsv($this->lokacija),
            $this->packToCsv($this->adresa),
            $this->packToCsv($this->struktura),
            $this->packToCsv($this->kvadratura),
            $this->packToCsv($this->sprat),
            $this->packToCsv($this->ukupno_spratova),
            $this->packToCsv($this->lift),
            $this->packToCsv($this->grejanje),
            $this->packToCsv($this->terasa_lodja),
            $this->packToCsv($this->god_gradnje),
            $this->packToCsv($this->opis),
            $this->packToCsv($this->useljiv),
            $this->packToCsv($this->uknjizen),
            $this->packToCsv($this->cena),
            $this->packToCsv($this->telefon1),
            $this->packToCsv($this->telefon2),
            $this->packToCsv($this->ID),
            $this->packToCsv($this->datum),
            $this->packToCsv($this->prizemlje),
            $this->packToCsv($this->vlasnistvo),
            $this->packToCsv($this->tip_stavke),
            //$this->packToCsv($this->azurirano),
            $this->packToCsv($this->broj_u_registru),
        ));
    }

    private function packToCsv($cell) {
        return sprintf('"%s"', preg_replace('/"/', '', $cell));
    }

    /**
     * @return mixed
     */
    public function getAzurirano() {
        return $this->azurirano;
    }

    /**
     * @param mixed $azurirano
     */
    public function setAzurirano($azurirano) {
        $this->azurirano = $azurirano;
    }
    private $link;

    /**
     * @return mixed
     */
    public function getNaslov() {
        return $this->naslov;
    }

    /**
     * @param mixed $naslov
     */
    public function setNaslov($naslov) {
        $this->naslov = $naslov;
    }

    /**
     * @return mixed
     */
    public function getLokacija() {
        return $this->lokacija;
    }

    /**
     * @param mixed $lokacija
     */
    public function setLokacija($lokacija) {
        $this->lokacija = $lokacija;
    }

    /**
     * @return mixed
     */
    public function getAdresa() {
        return $this->adresa;
    }

    /**
     * @param mixed $adresa
     */
    public function setAdresa($adresa) {
        $this->adresa = $adresa;
    }

    /**
     * @return mixed
     */
    public function getStruktura() {
        return $this->struktura;
    }

    /**
     * @param mixed $struktura
     */
    public function setStruktura($struktura) {
        $this->struktura = $struktura;
    }

    /**
     * @return mixed
     */
    public function getKvadratura() {
        return $this->kvadratura;
    }

    /**
     * @param mixed $kvadratura
     */
    public function setKvadratura($kvadratura) {
        $this->kvadratura = $kvadratura;
    }

    /**
     * @return mixed
     */
    public function getSprat() {
        return $this->sprat;
    }

    /**
     * @param mixed $sprat
     */
    public function setSprat($sprat) {
        $this->sprat = $sprat;
    }

    /**
     * @return mixed
     */
    public function getUkupnoSpratova() {
        return $this->ukupno_spratova;
    }

    /**
     * @param mixed $ukupno_spratova
     */
    public function setUkupnoSpratova($ukupno_spratova) {
        $this->ukupno_spratova = $ukupno_spratova;
    }

    /**
     * @return mixed
     */
    public function getLift() {
        return $this->lift;
    }

    /**
     * @param mixed $lift
     */
    public function setLift($lift) {
        $this->lift = $lift;
    }

    /**
     * @return mixed
     */
    public function getGrejanje() {
        return $this->grejanje;
    }

    /**
     * @param mixed $grejanje
     */
    public function setGrejanje($grejanje) {
        $this->grejanje = $grejanje;
    }

    /**
     * @return mixed
     */
    public function getTerasaLodja() {
        return $this->terasa_lodja;
    }

    /**
     * @param mixed $terasa_lodja
     */
    public function setTerasaLodja($terasa_lodja) {
        $this->terasa_lodja = $terasa_lodja;
    }

    /**
     * @return mixed
     */
    public function getGodGradnje() {
        return $this->god_gradnje;
    }

    /**
     * @param mixed $god_gradnje
     */
    public function setGodGradnje($god_gradnje) {
        $this->god_gradnje = $god_gradnje;
    }

    /**
     * @return mixed
     */
    public function getOpis() {
        return $this->opis;
    }

    /**
     * @param mixed $opis
     */
    public function setOpis($opis) {
        $this->opis = $opis;
    }

    /**
     * @return mixed
     */
    public function getUseljiv() {
        return $this->useljiv;
    }

    /**
     * @param mixed $useljiv
     */
    public function setUseljiv($useljiv) {
        $this->useljiv = $useljiv;
    }

    /**
     * @return mixed
     */
    public function getUknjizen() {
        return $this->uknjizen;
    }

    /**
     * @param mixed $uknjizen
     */
    public function setUknjizen($uknjizen) {
        $this->uknjizen = $uknjizen;
    }

    /**
     * @return mixed
     */
    public function getCena() {
        return $this->cena;
    }

    /**
     * @param mixed $cena
     */
    public function setCena($cena) {
        $this->cena = $cena;
    }

    /**
     * @return mixed
     */
    public function getTelefon1() {
        return $this->telefon1;
    }

    /**
     * @param mixed $telefon1
     */
    public function setTelefon1($telefon1) {
        $this->telefon1 = $telefon1;
    }

    /**
     * @return mixed
     */
    public function getTelefon2() {
        return $this->telefon2;
    }

    /**
     * @param mixed $telefon2
     */
    public function setTelefon2($telefon2) {
        $this->telefon2 = $telefon2;
    }

    /**
     * @return mixed
     */
    public function getID() {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID) {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getDatum() {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum) {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link) {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getPrizemlje() {
        return $this->prizemlje;
    }

    /**
     * @param string $prizemlje
     */
    public function setPrizemlje($prizemlje) {
        $this->prizemlje = $prizemlje;
    }

    /**
     * @return string
     */
    public function getVlasnistvo() {
        return $this->vlasnistvo;
    }

    /**
     * @param string $vlasnistvo
     */
    public function setVlasnistvo($vlasnistvo) {
        $this->vlasnistvo = $vlasnistvo;
    }

    /**
     * @return string
     */
    public function getTipStavke() {
        return $this->tip_stavke;
    }

    /**
     * @param string $tip_stavke
     */
    public function setTipStavke($tip_stavke) {
        $this->tip_stavke = $tip_stavke;
    }

    /**
     * @return string
     */
    public function getBrojURegistru() {
        return $this->broj_u_registru;
    }

    /**
     * @param string $broj_u_registru
     */
    public function setBrojURegistru($broj_u_registru) {
        $this->broj_u_registru = $broj_u_registru;
    }

}