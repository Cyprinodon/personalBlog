<?php
if( isset( $_SESSION ) == false ) {
  session_start();
}
/*CONSTANTS
**********************************************************/
const ROOT_PATH = __DIR__.DIRECTORY_SEPARATOR;
const VIEW_PATH = ROOT_PATH."views/";
const MODEL_PATH = ROOT_PATH."models/";
const CONTROLLER_PATH = ROOT_PATH."controllers/";

/*AUTOLOAD
**********************************************************/
require('Autoloader.php');
spl_autoload_register( array( 'Autoloader', 'loadAll' ) );

/*ROUTER
**********************************************************/
/*LOGIN
===============================*/
if( isset( $_GET['loginattempt'] ) AND $_GET['loginattempt'] == true ) {
  $loginManager = new controllers\Login;
  $loginManager->checkInputs();
}
if( isset( $_GET['logoutattempt'] ) AND $_GET['logoutattempt'] == true ) {
  $loginManager = new controllers\Login;
  $loginManager->logout();
  header( "Location: index.php?page=home" );
}
/*PAGE ROUTING
===============================*/
if( isset( $_GET['page'] ) )
{
  $page = $_GET['page'];

  switch($page)
  {
    /*HOME
    -------------------------*/
    case "home" :
      $homePage = new controllers\Home;
      $homePage->listAllArticles();
      break;

    /*ARTICLE
    -------------------------*/
    case "article" :
      if( isset( $_GET['id'] ) AND $_GET['id'] > 0 ) {
        $articlePage = new controllers\Home;
        if( isset( $_GET['action'] ) AND $_GET['action'] == "add-new-comment" ) {
          $articlePage->addNewComment();
        }
        else {
          $articlePage->displayDetailedArticle();
        }
      }
      else {
        echo "Error: 'id' missing in query string.";
      }
      break;

    /*CONTACT
    -------------------------*/
    case "contact" :
      $contactPage = new controllers\Contact;
      if( isset( $_GET['action'] ) AND $_GET['action'] == 'send-mail' ) {
        $contactPage->sendMail();
      }
      $contactPage->displayView();
      break;

    /*ADMIN PANEL
    -------------------------*/
    case "admin-panel" :
      if( isset( $_SESSION['ID'] ) ) {
        $adminPanelPage = new controllers\AdminPanel;
        if( isset( $_GET['action'] ) ) {
          switch( $_GET['action'] ) {
            case 'publish-article':
              $adminPanelPage->displayPublicationPage();
              break;
            case 'edit-article':
              $adminPanelPage->displayEditionPage();
              break;
            case 'send-edited-article':
              $adminPanelPage->editArticle();
              break;
            case 'send-published-article':
              $adminPanelPage->addNewArticle();
              break;
            case 'delete-article':
              $adminPanelPage->deleteArticle();
              break;
            case 'add-moderator':
              $adminPanelPage->displayNewModeratorPage();
              break;
            case 'edit-moderator':
              $adminPanelPage->displayEditModeratorPage();
              break;
            case 'send-moderator':
              $adminPanelPage->addNewModerator();
              break;
            case 'send-edited-moderator':
              $adminPanelPage->editModerator();
              break;
            case 'delete-moderator':
              $adminPanelPage->deleteModerator();
              break;
            case 'accept-comment':
              $adminPanelPage->changeCommentStatus("Validé");
              break;
            case 'refuse-comment':
              $adminPanelPage->changeCommentStatus("Refusé");
              break;
            case 'delete-comment':
              $adminPanelPage->deleteComment();
              break;
            default:
              $adminPanelPage->displayAllContent();
          }
        }
        else {
          $adminPanelPage->displayAllContent();
        }
      }
      else {
        $homepage = new controllers\Home;
        $homepage->displayWarningPage( "Vous n'êtes pas autorisé à accéder à l'espace Administration sans vous être préalablement connecté !" );
      }
      break;
  }
}
else{
  $_GET['page'] = "home";
  $homePage = new controllers\Home;
  $homePage->listAllArticles();
}
