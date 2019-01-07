<?php

class Parser {

    public static function getNew($filename) {
        $p = new Parser();
        $p->filename = $filename;
        return $p;
    }

    public function set($tag, $replacement=null) {
        if (is_array($tag))
            $this->replacements = array_merge($this->replacements, $tag);
        else
            $this->replacements[$tag] = $replacement;
        return $this;
    }

    public function display() {
        $this->content = file_get_contents(__DIR__ . '/html/' . $this->filename . '.html');
        $this->replace();
        return $this->content;
    }

    private function replace() {
        foreach ($this->replacements as $tag => $replacement)
            $this->content = preg_replace('/'.$tag.'/ms', $replacement, $this->content);
    }

    private $filename = null;
    private $replacements = array();
    private $content = null;
}