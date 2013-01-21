<?php
App::uses('AppHelper', 'View/Helper');

class EvTextHelper extends AppHelper {
    public $helpers = array('Text');

    /**
     * Converts url's to links, adds htmlentities, and converts new lines to br's
     *
     * @param string $text
     * @return string
     */
    public function format($text) {
        // Note that autoLink applies htmlentites as well.
        return nl2br($this->Text->autoLink($text, array('target' => '_blank', 'rel' => 'nofollow')));
    }
}
