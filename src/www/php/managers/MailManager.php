<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : UserManager.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 26 mai 2020
 * Description    : Fichier du manager User
 * Version        : 1.0
 */

require_once $_SERVER['DOCUMENT_ROOT'] . 'php/inc/inc.all.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'swiftmailer5/lib/swift_required.php';

class MailManager
{
    /**
     * @brief Méthode qui envoie un mail
     *
     * @param string $subject Le sujet du message
     * @param string $setTo L'adresse mail du destinataire
     * @param string $body Le message du mail
     * @return bool true si le mail est envoyé | false sinon
     */
    private static function send($subject, $setTo, $body)
    {
        // On doit créer une instance de transport smtp avec les constantes
        // définies dans le fichier mailparam.php
        $transport = Swift_SmtpTransport::newInstance(EMAIL_SERVER, EMAIL_PORT, EMAIL_TRANS)
            ->setUsername(EMAIL_USERNAME)
            ->setPassword(EMAIL_PASSWORD);

        try {
            // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
            $mailer = Swift_Mailer::newInstance($transport);
            // On crée un nouveau message
            $message = Swift_Message::newInstance();
            // Le sujet du message
            $message->setSubject($subject);
            // Qui envoie le message 
            $message->setFrom(array(EMAIL_USERNAME => 'Contact TPI'));
            // A qui on envoie le message
            $message->setTo(array($setTo));


            // On assigne le message et on dit de quel type. Dans notre exemple c'est du html
            $message->setBody($body, 'text/html');
            // Maintenant il suffit d'envoyer le message
            $result = $mailer->send($message);
            return true;
        } catch (Swift_TransportException $e) {
            echo "Problème d'envoi de message: " . $e->getMessage();
            return false;
        }
    }

    /**
     * @brief Méthode qui envoie un mail pour confirmer un utilisateur
     *
     * @param string $email L'utilisateur à confirmer
     * @return bool true si le mail est envoyé | false sinon
     */
    public static function sendConfirmAccount($email)
    {
        $user = UserManager::getByEmail($email);
        $subject = "Confirmation de votre adresse mail";
        $message =
            '<html>' .
            ' <head></head>' .
            ' <body>' .
            '  <a href="localhost/confirmationAccount.php?nickname=' . $user->Nickname . '&token=' . $user->Token . '">Pour confirmer votre compte, cliquez-ici.</a>';
        ' </body>' .
            '</html>';

        return self::send($subject, $email, $message);
    }

    /**
     * @brief Méthode qui envoie un mail pour informer l'utilisateur que son film a été noté
     *
     * @param int $movieId L'identifiant numérique du film
     * @param int $score La note donnée au film
     * @return bool true si le mail est envoyé | false sinon 
     */
    public static function sendRatingMail($movieId, $score)
    {
        $movie = MovieManager::getById($movieId);
        $user = $movie->User;
        $subject = "Nouvelle note sur votre film";
        $message =
            '<html>' .
            ' <head></head>' .
            ' <body>' .
            '  <p>L\'utilisateur suivant : ' . $movie->User->Nickname . ' a noté le film suivant : ' . $movie->Title . ' le ' . date('d MMM Y') . ' à ' . date('H:i') . '. Voici la note : ' . $score . '/10.</p></br><a href="localhost/movie.php?movieId=' . $movieId . '">Cliquez-ici pour voir la référence du film.</a>';
        ' </body>' .
            '</html>';

        return self::send($subject, $user->Email, $message);
    }
}
