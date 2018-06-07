<?php
 
    session_cache_limiter( 'nocache' );
    header( 'Expires: ' . gmdate( 'r', 0 ) );
    header( 'Content-type: application/json' );


    $to         = 'praveen@cavaseeds.com';

    $email_template = 'contact.html';

    $inlineRadioOption_1      = strip_tags($_GET['inlineRadioOption_1']);
    $name       = strip_tags($_GET['name']);
    $cname       = strip_tags($_GET['cname']);
    $email      = strip_tags($_GET['email']);
    $phone      = strip_tags($_GET['phone']);
    $country  = strip_tags($_GET['country']);
    $city   = strip_tags($_GET['city']);
    $message    = nl2br( htmlspecialchars($_GET['message'], ENT_QUOTES) );
    
    $result     = array();



    if(empty($inlineRadioOption_1)){

         $result = array( 'response' => 'error', 'empty'=>'inlineRadioOption_1', 'message'=>'<strong>Error!</strong>&nbsp; Title is empty.' );
         echo json_encode($result );
         die;
    }

    if(empty($name)){

        $result = array( 'response' => 'error', 'empty'=>'name', 'message'=>'<strong>Error!</strong>&nbsp; Name is empty.' );
        echo json_encode($result );
        die;
    }

    if(empty($cname)){

        $result = array( 'response' => 'error', 'empty'=>'cname', 'message'=>'<strong>Error!</strong>&nbsp; Company name is empty.' );
        echo json_encode($result );
        die;
    }

    if(empty($email)){

        $result = array( 'response' => 'error', 'empty'=>'email', 'message'=>'<strong>Error!</strong>&nbsp; Email is empty.' );
        echo json_encode($result );
        die;
    } 

    if(empty($phone)){

        $result = array( 'response' => 'error', 'empty'=>'phone', 'message'=>'<strong>Error!</strong>&nbsp; Phone is empty.' );
        echo json_encode($result );
        die;
    } 


    if(empty($country)){

         $result = array( 'response' => 'error', 'empty'=>'country', 'message'=>'<strong>Error!</strong>&nbsp; Country is empty.' );
         echo json_encode($result );
         die;
    }


    if(empty($city)){

         $result = array( 'response' => 'error', 'empty'=>'city', 'message'=>'<strong>Error!</strong>&nbsp; City is empty.' );
         echo json_encode($result );
         die;
    }


    if(empty($message)){

         $result = array( 'response' => 'error', 'empty'=>'message', 'message'=>'<strong>Error!</strong>&nbsp; Message body is empty.' );
         echo json_encode($result );
         die;
    }




    


    $headers  = "From: " . $name . ' <' . $email . '>' . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    $templateTags =  array(
        '{{email}}'=>$email,
        '{{message}}'=>$message,
        '{{name}}'=>$name,
        '{{phone}}'=>$phone,
        '{{country}}'=>$country,
        '{{city}}'=>$city,
        '{{inlineRadioOption_1}}'=>$inlineRadioOption_1
        );


    $templateContents = file_get_contents( dirname(__FILE__) . '/email-templates/'.$email_template);

    $contents =  strtr($templateContents, $templateTags);

    if ( mail( $to, $email, $contents, $headers ) ) {
        $result = array( 'response' => 'success', 'message'=>'<strong>Thank You!</strong>&nbsp; Your email has been delivered.' );
    } else {
        $result = array( 'response' => 'error', 'message'=>'<strong>Error!</strong>&nbsp; Cann\'t Send Mail.'  );
    }

    echo json_encode( $result );

    die;
?>