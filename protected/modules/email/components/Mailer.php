<?php
Yii::import('email.components.EmailTemplateParser');

class Mailer extends CComponent
{
    private $_emailtext;
    private $_template;
    private $_recipients = array();


    public function __construct( $template = null )
    {
        if ( $template === null )
            return parent::__construct();

        if ( $template instanceof EmailTemplates )
            $this->_template = $template;
        else if ( is_string($template) )
            $this->_template = EmailTemplates::model()->findByAttributes(array('alias'=>$template));
    }

    public function getTemplate()
    {
        return $this->_template;
    }

    public function buildMessage( $template = null, $vars = array() )
    {
        if ( $template ) {
            if ( $template instanceof EmailTemplates )
                $this->_template = $template;
            else if ( is_string($template) )
                $this->_template = EmailTemplates::model()->findByAttributes(array('alias'=>$template));
        }

        if ( $this->_template === null )
            throw new CHttpException(404, 'Не найден шаблон для рассылки писем');

        $vars = CMap::mergeArray(CHtml::listData(EmailVars::model()->findAll(), 'name', 'value'), $vars);
        $templateParser = new EmailTemplateParser;
        $templateParser->setText($this->_template->content);
        $templateParser->setReplacements($vars);
        $this->_emailtext = $templateParser->decode();
        return $this->_emailtext;
    }

    public function setRecipients($recipients)
    {
        if ( !is_array($recipients) ) {
            $recipients = array($recipients);
        }
        $templateId = $this->_template === null ? -1 : $this->_template->id;
        $criteria = new CDbCriteria;
        $criteria->addCondition("template_id=:template_id");
        $criteria->params[':template_id'] = $templateId;
        $this->_recipients = CHtml::listData( EmailRecipient::model()->findAll($criteria), 'id', 'email' );
        foreach ( $recipients as $recipient ) {
            if ( in_array($recipient, $this->_recipients) )
                continue;
            $model = new EmailRecipient;
            $model->email = $recipient;
            $model->template_id = ( $templateId === -1 ) ? 0 : $templateId;
            if ( $model->save(false) )
                $this->_recipients[] = $recipient;
        }
    }

    protected function sendProcess()
    {
        $this->buildMessage();
        foreach ( $this->_recipients as $recipient ) {
            self::sendMail($this->_template->subject, $this->_emailtext, $recipient, $this->_template->from);
        }
    }

    public static function sendMail($subject, $message, $to='', $from='')
    {
        if($to=='') $to = Yii::app()->params['adminEmail'];
        if($from=='') $from = 'no-reply@torsim.ru';
        $headers = "MIME-Version: 1.0\r\nFrom: $from\r\nReply-To: $from\r\nContent-Type: text/html; charset=utf-8";
        $message = wordwrap($message, 70);
        $message = str_replace("\n.", "\n..", $message);
        return mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }
}