<?php
/**
 * Created by JetBrains PhpStorm.
 * User: max
 * Date: 01.09.13
 * Time: 19:34
 * To change this template use File | Settings | File Templates.
 */

class Sender extends CComponent
{
    private $_text;
    private $_subject;
    private $_from;
    private $_recipients;

    public function __construct(Mailer $mailer = null)
    {
        if ($mailer !== null) {
            $this->_text = $mailer->buildMessage();
            $this->_subject = $mailer->template->subject;
            $this->from = $mailer->template->from;
        }
    }
}