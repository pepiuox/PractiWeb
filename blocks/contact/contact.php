<!-- contact block -->

<div class="row">    
    <div class="col-md-5">        
        <div class="infocontact">
            <img src="<?php echo $imgp; ?>" alt="<?php echo $ttlp; ?>" width="100%" />
            <?php
            $resultc = $database->query("SELECT value FROM config");
            $array = array();
            while ($rowt = $resultc->fetch_row()) {
                $array[] = $rowt;
            }
            echo '<p>';
            echo SITE_NAME . '<br>';
            echo '<a href="mailto:' . SITE_EMAIL . '">' . SITE_EMAIL . '</a><br />';
            echo 'Telf: ' . PHONE_CONTACT;
            echo '</p>';
            ?>                  
        </div>
    </div>        
    <div class="col-md-7">
        <?php
        $nameErr = $emailErr = $answerboxErr = '';
        $name = $email = $message = $answerbox = '';
        if (isset($_POST['submitted'])) {

            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $subject = trim('EMAIL DE LA WEB');
            $message = trim($_POST["message"]);
            $answerbox = trim($_POST["answerbox"]);

            if (empty($_POST["name"]) && strlen($name) < 2) {
                $nameErr = "Nombre es requirido";
            } else {
                $name = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameErr = "Solo letras y espacios en blanco";
                }
            }
            if (empty($_POST["email"])) {
                $emailErr = "Email es requirido";
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalido el formato de email";
                }
            }
            if (empty($_POST["message"]) && strlen($message) < 10) {
                $message = htmlspecialchars($message);
            } else {
                $message = test_input($_POST["message"]);
            }
            if ($answerbox != 36) {
                $answerboxErr = "Calcule la suma correctamente.";
            } else {
                $answerbox = test_input($_POST["answerbox"]);
            }
            if (isset($_POST['name']) && isset($_POST['mail']) && $answerbox = 36) {
                // put your email address here     
                $mmail = SITE_EMAIL;

                // prepare a "pretty" version of the message
                $body = "Este manesaje a sido enviado desde la página web:" . "\n";
                $body .= "Nombre:  " . $name . "\n";
                $body .= "E-Mail: " . $email . "\n";
                $body .= "Mensaje: " . $message . "\n";

                // Use the submitters email if they supplied one     
                // (and it isn't trying to hack your form).     
                // Otherwise send from your email address.     

                if ($_POST['email'] && !preg_match("/[\r\n]/", $_POST['email'])) {
                    $headers = "From: $_POST[email]";
                } else {
                    $headers = "From: $mmail";
                }

                // finally, send the message     
                $headers = 'From: ' . $email . "\r\n" .
                        'Reply-To: ' . $email . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                mail($mmail, $subject, $body, $headers);
                print "Correo electrónico enviado con éxito - Mail succesuffully sent";
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <h3>Contact <?php echo SITE_NAME; ?></h3>         
        <form class="br" method="POST" action="">
            <div class="col-md-12">
                <label>Nombre:</label>
                <input id='name' name='name' type="text" value=""/>
                <span class="error">* <?php echo $nameErr; ?></span>
            </div>
            <div class="col-md-12">
                <label>Email:</label>
                <input id='email' name='email' type="text" value=""/>
                <span class="error">* <?php echo $emailErr; ?></span>
            </div>                        
            <div class="col-md-12">
                <label>Mensaje:</label>
                <textarea id='message' name="message"></textarea>
                <p style='width: 70px;'>47 - 9 = ?<input type="text" name="answerbox" id="answerbox" maxlength="2"  size="2"/></p>
                <span class="error">* <?php echo $answerboxErr; ?></span>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Enviar"/>  
                <input type='hidden' value='1' name='submitted' />
            </div>
        </form>       
    </div>
</div>

