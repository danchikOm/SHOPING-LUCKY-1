<?php
include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';


class SiteController
{

    public function actionIndex(){

      $categories   = array();
      $categories   = Category::getCategoriesList();
      $latestProducts = array();
      $latestProducts = Product::getLatestProducts(10);

      $recommProducts = array();
      $recommProducts = Product::getRecProducts(10);

     require_once ROOT . '/views/site/site.php';
     return true;

    }

    public function actionContact(){

        $userEmail = '';
        $userMessage = '';
        $result = false;

        if (isset($_POST['submit'])){

            $userEmail = $_POST['userEmail'];
            $userMessage = $_POST['userMessage'];

            $errors = false;

            if (!User::checkEmail($userEmail)){
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {

                $adminEmail = 'admin@shopping-lucky.ga';
                $subject = 'Тема письма';
                $message = "Текст:{$userMessage}. От {$userEmail}";
               // var_dump($message);
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once (ROOT.'/views/site/contact.php');
        return true;

    }

}