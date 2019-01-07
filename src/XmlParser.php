
<?php

class XmlParser {

    /**
     * Gets value by tag
     *
     * @param  string $text
     * @param  string $tag
     * @return mixed
     */
    public function getTagValue($text, $tag) {
        if (preg_match('/<'.$tag.'>((?:(?!<\/'.$tag.'>).)*)<\/'.$tag.'>/ms', $text, $matches))
            return $matches[1];
        else
            return null;
    }

    /**
     * Extracts all texts surrounded by given tag
     *
     * @param string $text
     * @param string $tag
     * @return array
     */
    public function getAllWrappedInTag($text, $tag) {
        if (preg_match_all('/<'.$tag.'>((?:(?!<\/'.$tag.'>).)*)<\/'.$tag.'>/ms', $text, $matches))
            return $matches[1];
        else
            return array();
    }
}