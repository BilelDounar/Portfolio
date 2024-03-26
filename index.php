<?php
session_start();
require('inc/fonction.php');
require('inc/log.php');

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$success = false;
$errors = [];

if (!empty($_POST['submitted'])) {
    // Faille XSS
    $nom = cleanxss('nom');
    $prenom = cleanxss('prenom');
    $mail = cleanxss('mail');
    $message = cleanxss('message');



    $errors = validText($errors, $nom, 'nom', 3, 30);
    $errors = validText($errors, $prenom, 'prenom', 3, 30);
    $errors = validmail($errors, $mail, 'mail');
    $errors = validText($errors, $message, 'message', 5, 200);


    if (count($errors) == 0) {
        $success = true;


        $sendmail = new PHPMailer(true);
        try {
            // Paramètres du serveur SMTP
            $sendmail->isSMTP();
            $sendmail->Host = 'smtp.hostinger.com';
            $sendmail->SMTPAuth = true;
            $sendmail->Username = 'contact@portfoliobileldounar.online';
            $sendmail->Password = '7gB#2D@9fZ!';
            $sendmail->SMTPSecure = 'ssl';
            $sendmail->Port = 465; // ou 465


            // Destinataire et contenu
            $sendmail->setFrom('contact@portfoliobileldounar.online');
            $sendmail->AddAddress('bileldounar@gmail.com');
            $sendmail->isHTML(true);
            $sendmail->Subject = 'Formulaire de Contact';
            $sendmail->Body = "<div color: #452A79;> <h1> Formulaire de Contact </h1> <br>
                Nom : " . $nom . "<br> Prenom : " . $prenom . "<br> Mail :" . $mail . "<br><br>
                Message : <p> " . $message . " </p> </div>";

            // Envoyer l'email
            $sendmail->send();
            echo '<div class="success-message">L\'email a été envoyé avec succès.</div> ';
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'email : {$sendmail->ErrorInfo}";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/input.css">
    <link rel="stylesheet" href="asset/css/output.css">
    <link rel="icon" href="asset/img/logo.png" type="image/png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/style.css">
    <meta name="description" content="Bienvenue dans mon monde digital ! Je suis Bilel Dounar, un développeur passionné par la création numérique. Explorez mon portfolio où chaque ligne de code raconte une histoire. Envie de donner vie à vos idées ? Contactez-moi et ensemble, transformons vos concepts en réalité digitale.">

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/ripples.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Bilel Dounar - Portfolio</title>

</head>

<body>
    <button onclick="burgerOpen()" id="burger_button" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 sidebar">

            <div class="element_sidebar">

                <ul class="space-y-2 font-medium" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-delay="2000" data-aos-duration="1000">
                    <a href="#" class="flex items-center ps-2.5 mb-5">
                        <span class="logo_sidebar self-center text-xl font-semibold whitespace-nowrap ">Bilel
                            Dounar</span>
                    </a>
                    <li class="li_nav">
                        <a href="#profil" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i class="fa-solid fa-house"></i>
                            <span class="ms-3">ACCUEIL</span>
                        </a>
                    </li>
                    <li class="li_nav">
                        <a href="#projets" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i class="fa-solid fa-diagram-project"></i>
                            <span class="ms-3">PROJETS</span>
                        </a>
                    </li>
                    <li class="li_nav">
                        <a href="#competences" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i class="fa-solid fa-pen"></i>
                            <span class="ms-3">COMPETENCES</span>
                        </a>
                    </li>
                    <li class="li_nav">
                        <a href="#contact" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i class="fa-regular fa-address-card li_i"></i>
                            <span class="ms-3">CONTACT</span>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="button_footer_sidebar">
                <a href="#" onclick="parameter(event)" class="parameter dark:hover:bg-gray-700">
                    <i class="fa-solid fa-gear"></i>
                </a>
                <a href="#" onclick="contracteSidebar(event)" class="parameter dark:hover:bg-gray-700">
                    <i id="sidebarIcon" class="fa-solid fa-angles-left"></i>
                </a>
            </div>
        </div>
    </aside>

    <section class="p-4 sm:ml-64 section_sidebar">
        <section id="profil">
            <div class="wrap" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="2000">
                <div class="profil_top">
                    <div class="profil_photo">
                        <img src="asset/img/photo_profil.jpeg" alt="">
                    </div>
                    <div class="profil_info">
                        <h2>Bilel Dounar</h2>
                        <div class="profil_info_stat">
                            <span> 3 Réseaux</span>
                            <span> 3 Projets</span>
                            <span>1<span id="changing-text"></span></span>

                        </div>
                        <p class="profil_info_p">Bonjour !

                            Je suis Bilel Dounar, un jeune développeur web de 20 ans en quête d'un stage pour avril et
                            d'une
                            alternance à partir de septembre. Passionné par l'innovation, je cherche à mettre mes
                            compétences au service de projets captivants. <br><br>

                            Explorez mon portfolio pour découvrir mes réalisations. Pour toute opportunité ou question,
                            je suis à votre écoute. Merci pour votre visite !
                        </p>
                    </div>
                </div>
                <div class="profil_réseaux">
                    <div class="reseaux" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="2000" data-aos-duration="900">
                        <a href="https://github.com/BilelDounar" target="_blank" class="box_img_reseaux"><i class="fa-brands fa-github "></i></a>
                        <span>GitHub</span>
                    </div>
                    <div class="reseaux" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="2000" data-aos-duration="1100">
                        <a href="https://www.instagram.com/blx___x/" target="_blank" class="box_img_reseaux"><i class="fa-brands fa-instagram "></i></a>
                        <span>Instagram</span>
                    </div>
                    <div class="reseaux" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="2000" data-aos-duration="1400">
                        <a href="https://www.linkedin.com/in/bilel-dounar-26a87b21b/" target="_blank" class="box_img_reseaux"><i class="fa-brands fa-linkedin "></i></a>
                        <span>LinkedIn</span>
                    </div>
                    <div class="reseaux" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="2000" data-aos-duration="1700">
                        <a href="/asset/img/CV - Bilel Dounar.pdf" download target="_blank" class="box_img_reseaux"><i class="fa-solid fa-file-arrow-down "></i></a>
                        <span>CV</span>
                    </div>
                </div>
                <div class="hr_style">
                    <hr>
                </div>

            </div>
        </section>

        <section id="projets">
            <div class="wrap1">

                <div class="h3_container">
                    <h3 class="underline"><i class="fa-solid fa-list-check"></i> Projets</h3>
                    <h3><i class="fa-solid fa-briefcase"></i> Compétences</h3>
                </div>

                <div class="projets_box">
                    <div class="project_card modal_projets_img1" onclick="modalProjets(event,'projetOnlyvax')" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                        <h2>ONLYVAX</h2>
                        <p>Carnet de vaccination <br> -<br> Projet de formation </p>
                    </div>
                    <div class="project_card modal_projets_img2" onclick="modalProjets(event,'agGrid')" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                        <h2>AG-GRID</h2>
                        <p>Gestion d’info. utilisateur <br> -<br> Stage à l’étanger </p>
                    </div>
                    <div class="project_card modal_projets_img3" onclick="modalProjets(event,'portfolio')" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                        <h2>PORTFOLIO</h2>
                        <p>Mon portfolio <br> -<br> Projet personnel </p>
                    </div>
                    <div class="project_card modal_projets_img4" onclick="modalProjets(event,'CanView')" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                        <h2>Can View</h2>
                        <p>Gestionnaire de CV <br> -<br> Projet de formation </p>
                    </div>
                    <div class="project_card modal_projets_img5" onclick="modalProjets(event,'Pitchoune')" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                        <h2>Pitchoune</h2>
                        <p>Garde d'enfant facilité <br> -<br> Projet de formation </p>
                    </div>
                </div>

                <div class="hr_style">
                    <hr>
                </div>

            </div>
        </section>

        <section id="competences">
            <div class="wrap1">
                <div class="h3_container">
                    <h3><i class="fa-solid fa-list-check"></i> Projets</h3>
                    <h3 class="underline"><i class="fa-solid fa-briefcase"></i> Compétences</h3>
                </div>

                <div class="competences_chart" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-easing="linear">
                    <canvas id="myChart" height="120px"></canvas>
                </div>
                <div class="hr_style">
                    <div class="hr_style">
                        <hr>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="wrap2">
                <div class="contact_text">
                    <h2>ME CONTACTER</h2>
                    <p data-aos="fade-up" data-aos-anchor-placement="center-bottom">Formulaire de Contact : Utilisez le
                        formulaire en ligne pour un contact rapide et efficace. <br>

                        E-mail : Envoyez-moi un e-mail à <a href="mailto:bilel.dounar.pro@gmail.com">bilel.dounar.pro@gmail.com</a>. Je répondrai dès
                        que possible.
                        <br>
                        Réseaux Sociaux : Rendez vous sur mes réseaux sociaux afin de m'envoyer un message. <br>

                        Téléphone : Préférez-vous parler de vive voix ? Appelez-moi au <a href="tel:+33785430209">07.85.43.02.09</a>.
                    </p>
                </div>

                <div class="contact_form" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <form action="" method="post" onsubmit="desactiverBouton()">
                        <div class="formulaire">
                            <div class="formulaire_container">
                                <div class="form_box">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php getPostValue('nom'); ?>">
                                    <span class="erreur"><?php viewError($errors, 'nom'); ?></span>
                                </div>
                                <div class="form_box">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" placeholder="Message"><?php getPostValue('message'); ?></textarea>
                                    <span class="erreur"><?php viewError($errors, 'message'); ?></span>
                                </div>
                            </div>
                            <div class="formulaire_container">
                                <div class="form_box">
                                    <label for="Prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" class="input_set" value="<?php getPostValue('prenom'); ?>">
                                    <span class="erreur"><?php viewError($errors, 'prenom'); ?></span>
                                </div>
                                <div class="form_box">
                                    <label for="email">Email</label>
                                    <input type="mail" name="mail" id="mail" placeholder="Email" class="input_set" value="<?php getPostValue('mail'); ?>">
                                    <span class="erreur"><?php viewError($errors, 'mail'); ?></span>
                                </div>
                                <input type="submit" id="submitBtn" name="submitted" value="Envoyer" >


                            </div>
                        </div>
                        <div class="form_data_check">
                            <p>En soumettant ce formulaire, vous consentez à l'utilisation <br> de vos informations afin
                                d'être recontacté(e).</p>
                        </div>
                    </form>
                </div>
                <div class="hr_style" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <hr>
                </div>
                <p data-aos="fade-up" data-aos-anchor-placement="center-bottom" class="copyright">Copyright&copy - Bilel
                    Dounar - Tous droit réservé</p>
            </div>
        </section>

    </section>

    <div id="modal_parameter">
        <div class="modal_parameter_container">
            <span class="leave_modal" onclick="leaveModal()"><i class="fa-solid fa-x"></i></span>
            <div class="modal_parameter_text">
                <h2>PARAMETRES</h2>
                <br>

                <label for="theme" class="theme">
                    <span>Light</span>
                    <span class="theme__toggle-wrap">
                        <input onclick="toggleTheme()" type="checkbox" class="theme__toggle" id="theme" role="switch" name="theme" value="dark" checked />
                        <span class="theme__fill"></span>
                        <span class="theme__icon">
                            <span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span><span class="theme__icon-part"></span>
                        </span>
                    </span>
                    <span>Dark</span>
                </label>
            </div>
        </div>
    </div>

    <div id="loading-screen">
        <h1>PORTFOLIO <br>- <br> Bilel D.</h1>
        <l-ripples size="400" speed="7" color="#222222"></l-ripples>
    </div>
    <div id="modal_bk_filter">
        <div id="modal_projets">
            <div class="modal_projets_container">
                <span class="leave_modal_projets" onclick="leaveModalProjets()"><i class="fa-solid fa-x"></i></span>

                <div class="modal_projets_text">
                    <h2>ONLYVAX</h2>
                    <span>Carnet de vaccination</span>
                </div>
                <div class="modal_projets_content">
                    <p>Text.</p>
                    <a href="#" target="_blank" class="box_link_projet">
                        <span>Accéder à GitHub</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <span class="leave_sidebar" onclick="burgerClose()"><i class="fa-solid fa-x"></i></span>

    <script src="asset/js/main.js"></script>

</body>

</html>