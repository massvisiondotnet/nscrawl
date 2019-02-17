<?php

class Phones {

    public function getById($id, $isMobile=false) {
        //if (!isset($this->phonesByIds[$id]))
        //    $this->phonesByIds[$id] = $this->getPhones($id);
        return $this->getPhones($id, $isMobile);
    }

    private function getPhones($id, $isMobile=false) {
        $phone1 = null;
        $phone2 = null;
        $postdata = http_build_query(
            array(
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-type: application/x-www-form-urlencoded\nX-requested-with: XMLHttpRequest",
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents(
            sprintf('https://www.nekretnine.rs/form/show-phone-number/%s/%s', $isMobile ? 'mob' : 'phone', $id),
            false,
            $context
        );
        $arr = json_decode($result, true);
        if ($arr && isset($arr['phone']) && is_array($arr['phone']) && count($arr['phone']) > 0) {
            $phone1 = trim($arr['phone'][0]);
            /*
            $phones = $arr['phone'][0];
            @list($phone1, $phone2) = preg_split('/\s+/', trim($phones));
            if ($phone1)
                $phone1 = trim($phone1);
            if ($phone2)
                $phone2 = trim($phone2);
            //echo(sprintf("phone1: %s, phone2: %s\n", $phone1, $phone2));
            */
        }
        return array($phone1, $phone2);
    }

    private $phonesByIds = array();

    /**
     * Get singleton instance
     *
     * @return Phones
     */
    public static function getInstance() {
        if (static::$instance == null)
            static::$instance = new Phones();
        return static::$instance;
    }

    /** @var Phones */
    private static $instance = null;

    /**
     * Phones constructor.
     */
    private function __construct() {
    }
}