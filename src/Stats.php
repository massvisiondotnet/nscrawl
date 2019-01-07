<?php

class Stats {

    private $timeDownloading = .0;
    private $timeParsing = .0;
    private $totalTime = .0;
    private $overviewPagesCount = 0;
    private $detailsPagesCount = 0;

    public function addTimeDownloading($t) {
        $this->timeDownloading += $t;
    }

    public function addTimeParsing($t) {
        $this->timeParsing += $t;
    }

    public function addTotalTime($t) {
        $this->totalTime += $t;
    }

    public function incOverviewPagesCount() {
        $this->overviewPagesCount++;
    }

    public function incDetailsPagesCount() {
        $this->detailsPagesCount++;
    }

    public function getStats() {
        return sprintf(
            "Done in %s\nTime downloading: %s\nTime parsing: %s\nLink pages: %d\nDetails pages: %d",
            number_format($this->totalTime, 2),
            number_format($this->timeDownloading, 2),
            number_format($this->timeParsing, 2),
            $this->overviewPagesCount,
            $this->detailsPagesCount
        );
    }

    /**
     * @return Stats
     */
    public static function getInstance() {
        if (static::$instance === null)
            static::$instance = new Stats();
        return static::$instance;
    }

    /** @var Stats */
    private static $instance = null;

    private function __construct() {
    }
}