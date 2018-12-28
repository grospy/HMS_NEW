<?php require_once("../globals.php");;echo'<html>
<head>
    <title>';echo xlt('Email Notification Report');echo'</title>
    ';\OpenEMR\Core\Header::setupHeader();echo'</head>
<body class="body_top container">
<header class="row">
    ';require_once("batch_navigation.php");echo'    <h1 class="col-md-12">
        <a href="batchcom.php">';echo xlt('Batch Communication Tool');echo'</a>
        <small>';echo xlt('Email Notification Report');echo'</small>
    </h1>
</header>
<main class="row">
    <ul class="col-md-12">
        ';$email_sender=$_POST['email_sender'];$sent_by=$_SESSION["authId"];while($row=sqlFetchArray($res)){$pt_name=$row['title'].' '.$row['fname'].' '.$row['lname'];$pt_email=$row['email'];$email_subject=$_POST['email_subject'];$email_body=$_POST['email_body'];$email_subject=preg_replace('/\*{3}NAME\*{3}/',$pt_name,$email_subject);$email_body=preg_replace('/\*{3}NAME\*{3}/',$pt_name,$email_body);$headers="MIME-Version: 1.0\r\n";$headers.="To: ".$pt_name."<".$pt_email.">\r\n";$headers.="From: <".$email_sender.">\r\n";$headers.="Reply-to: <".$email_sender.">\r\n";$headers.="X-Priority: 3\r\n";$headers.="X-Mailer: PHP mailer\r\n";if(mail($pt_email,$email_subject,$email_body,$headers)){echo"<li>".xlt('Email sent to').": ".text($pt_name)." , ".text($pt_email)."</li>";}else{$m_error=true;$m_error_count++;}};echo'    </ul>
    ';if($m_error){echo'<div class="alert alert-danger">'.xlt('Could not send email due to a server problem.').' '.$m_error_count.' '.xlt('emails not sent').'</div>';};echo'</main>
</body>
</html>
';