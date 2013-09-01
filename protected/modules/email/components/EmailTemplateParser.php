<?php

class EmailTemplateParser extends CComponent
{
    /**
     * @var string marker of block begin
     */
    public $startBlock = '[*';
    /**
     * @var string marker of block end
     */
    public $endBlock = '*]';
    /**
     * @var string of template_text
     */
    protected $text;
    /**
     * @var array of allowed variables
     */
    protected $replacements;

    public function __construct($replacements = array())
    {
        $this->replacements = is_array($replacements) ? $replacements : array();
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setReplacements(array $replacements)
    {
        $this->replacements = $replacements;
    }

    public function addReplacement($alias, $value)
    {
        $this->replacements[$alias] = $value;
    }

    protected function _processReplace()
    {
        foreach ($this->replacements as $alias => $replacement) {
            $patterns[] = $this->startBlock . $alias . $this->endBlock;
            $replacements[] = $replacement;
        }
        return str_replace($patterns, $replacements, $this->text);
    }

    /**
     * Content parser
     * Use $this->decodeWidgets($model->text) in view
     * @param $text
     * @return mixed
     */
    public function decode($text = false)
    {
        if ( $text )
            $this->text = $text;
        return $this->_processReplace();
    }
}