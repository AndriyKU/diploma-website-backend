<?php

class ContactModel
{
    private $name;
    private $email;
    private $age;
    private $message;

    public function validateContact($name, $email, $age, $message)
    {
        $this->name = trim(filter_var($name, FILTER_SANITIZE_STRING));
        $this->email = trim(filter_var($email, FILTER_SANITIZE_EMAIL));
        $this->age = filter_var($age, FILTER_SANITIZE_NUMBER_INT);
        $this->message = htmlspecialchars(trim($message));

        if (strlen($this->name) < 3)
            return 'Il nome inserito è troppo corto';
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return 'Hai inserito un\'e-mail errata, formattala correttamente';
        else if (!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
            return 'Non è un\'età valida';
        else if (strlen($this->message) < 3)
            return 'Il messaggio è troppo breve';
        else
            return 'Correct';
    }

    public function sendMail()
    {
        /*
        Avviso: per inviare correttamente una email dal sito, è necessario sostituire le righe di testo con le configurazioni corrette, perché le configurazioni qui scritte sono fittizie e non funzioneranno.
        */

        // Autocarica la libreria PHPMailer
        require 'vendor/autoload.php'; // Autocaricatore tramite Composer

        $mail = new PHPMailer\PHPMailer\PHPMailer(true); // Istanzia un oggetto da PHPMailer

        try {
            $mail->SMTPDebug = 0; // Specifica che non ci siano informazioni di debug durante l'invio delle mail

            // Impostazioni del server SMTP
            $mail->isSMTP(); // Usa SMTP
            $mail->Host = ''; // Specifica l'host del server SMTP
            $mail->SMTPAuth = true; // Abilita l'autenticazione di accesso al server SMTP
            $mail->Username = ''; // Login SMTP
            $mail->Password = ''; // Password SMTP
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Abilita la crittografia TLS
            $mail->Port = 587; // Porta a cui connettersi
            $mail->CharSet = 'UTF-8'; // Impostazione della codifica del testo
            $mail->Encoding = 'base64';

            // Impostazioni del mittente
            $mail->setFrom($this->email, $this->name); // Specifica il mittente
            $mail->addAddress('admin@mail.com', 'admin'); // Aggiunge il destinatario
            $mail->addReplyTo($this->email, $this->name); // a chi si potrà rispondere all'email

            // Impostazioni del contenuto dell'e-mail
            $mail->isHTML(false); // Imposta il formato dell'email su testo semplice
            $mail->Subject = 'Сообщение с нашего сайта'; // Oggetto/tema dell'email
            $mail->Body    = 'Имя: ' . $this->name . "\n" . 'Возраст: ' . $this->age . "\n" . 'Сообщение: ' . $this->message; // Corpo dell'email
            $mail->AltBody = ''; // Lascia vuoto il testo alternativo dell'email poiché l'e-mail non contiene HTML, è quindi non serve il testo senza HTML

            // Invia l'email
            $mail->send();
            return 'Messaggio inviato con successo';
        } catch (PHPMailer\PHPMailer\Exception $e) {
            return <<<HTML
            Il messaggio non è stato inviato!<br />
            Motivazione: {$mail->ErrorInfo}<br />
            <a href="https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting" style="color:#ff5644;">https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting</a>
            HTML;
        }
    }
}
