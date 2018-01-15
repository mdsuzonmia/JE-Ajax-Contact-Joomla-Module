<?php
/**
 * @package JE Ajax Contact Module !
 * @version 1.1.0
 * @author  jooexpert.com
 * @copyright   Copyright (C) 2018 jooexpert. All rights reserved.
 * @license jooexpert
 */
 
defined('_JEXEC') or die;

$mid = $module->id;
$m_title = $module->title;
$subject_prefix = $params->get('subjectPrefix');
$emailto = $params->get('emailto');
$thankyou = $params->get('thankyou');

$document = JFactory::getDocument();
$document->addStylesheet('modules/mod_je_ajax_contact/tmpl/bootstrap.css');
$document->addStylesheet('modules/mod_je_ajax_contact/tmpl/style.css');
   
    
?>
<div id="je_ajax_contact_<?php echo $mid; ?>" class="je_ajax_contact_module_<?php echo $mid; ?> je_ajax_contact_wrap">
    <div id="result"></div>

    <form >
        <div class="container-fluid">
        <div class="row">

            <!-- Client Name -->
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="client_name" class="sr-only">Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Name" required>
                </div>
                <div class="space-10"></div>
            </div>

            <!-- Client Emmail -->
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="client_email" class="sr-only">Email</label>
                    <input type="email" class="form-control" id="client_email" name="client_email" placeholder="Email" required>
                </div>
                <div class="space-10"></div>
            </div>
</div>
<div class="row">
            <!-- Client Subject -->
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="client_subject" class="sr-only">Subject</label>
                    <input type="text" class="form-control" id="client_subject" name="client_subject" placeholder="Subject" required>
                </div>
                <div class="space-10"></div>
            </div>
</div>
<div class="row">
            <!-- Client Message -->
            <div class="col-xs-12">
                <div class="form-group form-group-sm">
                    <label for="client_message" class="sr-only">comment</label>
                    <textarea class="form-control" rows="6" id="client_message" name="client_message" placeholder="Message" required></textarea>
                </div>
                <input type="button" id="submit" name="" class="btn btn-fill text-uppercase margin-top-40" value="Send message">
                
            </div>
        </div>
        </div>
    </form>

</div>

<script type="text/javascript">

    // Form Element Validation Function
    function jeFormValidation(){
        // Get data
        var name = jQuery("#client_name").val();
        var email = jQuery("#client_email").val();
        var subject = jQuery("#client_subject").val();
        var message = jQuery("#client_message").val();

        // check if name is not empty
        if(name== ''){
            jQuery("#result").html("Name is required.");
            jQuery("#client_name").addClass("text-alert");
            return false;
        }else{
            jQuery("#result").html("");
            jQuery("#client_name").removeClass("text-alert");
        }

        // check if email is not empty
        if(email== ''){
           jQuery("#result").html("Email is required.");
           jQuery("#client_email").addClass("text-alert");
           return false;
        }else{
           jQuery("#result").html("");
           jQuery("#client_email").removeClass("text-alert");
        }

        // check if email is valid
        if(IsEmail(email)==false){
            jQuery("#result").html("Valid email is required.");
            jQuery("#client_email").addClass("text-alert");
            return false;
        }else{
            jQuery("#result").html("");
            jQuery("#client_email").removeClass("text-alert");
        }

        // check if subject is not empty
        if(subject== ''){
            jQuery("#result").html("Subject is required.");
            jQuery("#client_subject").addClass("text-alert");
            return false;
        }else{
            jQuery("#result").html("");
            jQuery("#client_subject").removeClass("text-alert");
        }

        // check if message is not empty
        if(message== ''){
           jQuery("#result").html("Message is required.");
           jQuery("#client_message").addClass("text-alert");
            return false;
        }else{
           jQuery("#result").html("");
           jQuery("#client_message").removeClass("text-alert");
        }

    }

    // name on keyup event
    jQuery( "#client_name" ).keyup(function() { jeFormValidation(); });

    // email on keyup event
    jQuery( "#client_email" ).keyup(function() { jeFormValidation(); });

    // subject on keyup event
    jQuery( "#client_subject" ).keyup(function() { jeFormValidation(); });

    // message on keyup event
    jQuery( "#client_message" ).keyup(function() { jeFormValidation(); });

    // Submit click event
    jQuery( "#submit" ).click(function() { 

        // Get form data
        var name = jQuery("#client_name").val();
        var email = jQuery("#client_email").val();
        var subject = jQuery("#client_subject").val();
        var message = jQuery("#client_message").val();

        var pre = '<?php echo $subject_prefix; ?>';
        var emailto = '<?php echo $emailto; ?>';
        var thankyou = '<?php echo $thankyou; ?>';

        // call form element validation function
        jeFormValidation();

        // check if form all data not empty
        if( name.length > 0 && email.length > 0 && subject.length > 0 && message.length > 0) {

            jQuery("#result").html("Sending ...");
            jQuery.post( 'index.php?option=com_ajax&module=je_ajax_contact&method=getSend&format=raw&Itemid=101',{name:name, email:email, subject:subject, message:message, pre:pre, emailto:emailto, thankyou:thankyou}, function(data){
              if(data){ 
                jQuery("#result").html(data); 
                jQuery("#client_name").val('');
                jQuery("#client_email").val('');
                jQuery("#client_subject").val('');
                jQuery("#client_message").val('');
               }
            });

        }
    });    

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
</script>




