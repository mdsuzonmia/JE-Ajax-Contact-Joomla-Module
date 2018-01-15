<?php
/**
 * @package	JE Ajax Contact Module !
 * @version	1.1.0
 * @author	jooexpert.com
 * @copyright	Copyright (C) 2018 jooexpert. All rights reserved.
 * @license	jooexpert
 */
defined('_JEXEC') or die;

class ModJeAjaxContactHelper{
	
    public static function getSendAjax(){

        $name = JRequest::getVar('name');
        $email = JRequest::getVar('email');
        $subject = JRequest::getVar('subject');
        $message = JRequest::getVar('message');
        $message = nl2br($message);

        $pre = JRequest::getVar('pre');
        $emailto = JRequest::getVar('emailto');
        $thankyou = JRequest::getVar('thankyou');

        $mailer = JFactory::getMailer();
        $config = JFactory::getConfig();
		$sender = array( 
		    $config->get( 'mailfrom' ),
		    $config->get( 'fromname' ) 
		);

		$mailer->setSender($sender);
		$mailer->isHTML(true);
		$mailer->addRecipient($emailto);
		$body   = "<b>Name: ".$name."</b><br/> \n
		           <b>Email: ".$email."</b><br/> \n 
		           <b>Subject: ".$subject."</b><br/> \n
		           <b>Message: </b><br/> \n
		           ".$message." \n
		           ";
		$mailer->setSubject($pre.' '.$subject);
		$mailer->setBody($body);

		$send = $mailer->Send();
		if ( $send !== true ) {
		    $meg = 'Error sending email.';
		} else {
		    $meg = $thankyou;
		}
		
        return $meg;
    }

    
    

}
