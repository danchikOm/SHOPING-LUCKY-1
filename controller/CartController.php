<?php


class CartController
{

    public function actionAdd($id){

      Cart::addProduct($id);

      $ref = $_SERVER['HTTP_REFERER'];
      header("Location: $ref");

    }

    public function actionAddAjax($id)
    {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        $productsInCart = false;
        $productsInCart = Cart::getProducts();

        if ($productsInCart){
            $productsIds =  array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
        }

     require_once (ROOT.'/views/cart/cart.php');
        return true;
    }

    public function actionCheckout()
    {
        $categories = array();
        $categories = Category::getCategoriesList();
        $result = false;

        if (isset($_POST['submit'])) {

            $username = $_POST['username'];
            $user_phone = $_POST['user_phone'];
            $user_comment = $_POST['user_comment'];

            $errors = false;

            if (!User::checkName($username)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($user_phone)) {
                $errors[] = 'Неправильно набран номер';
            }

            if ($errors == false) {
                $productsInCart = Cart::getProducts();

                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = USER::checkLogged();
                }

                $result = Order::save($username, $user_phone, $user_comment, $productsInCart, $userId);
                if ($result) {
                    $adminEmail = 'daniyar.8-4@mail.ru';
                    $subject = 'Новый заказ';
                    $message = 'admin@shopping-lucky.ga';
                   mail($adminEmail, $subject, $message);

                    Cart::clear();
                }
            } else {
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

            }

        }else{
            //form not submitted;
            $productsInCart = Cart::getProducts();

            if ($productsInCart ==false){
                header("Location: /");
            }else{
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $username = false;
                $user_phone = false;
                $user_comment = false;

                //checkout user;
                if(User::isGuest()){
                    //input empty;
                }else{
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);

                    $username = $user['name'];
                }

            }

        }
           require_once (ROOT.'/views/cart/checkout.php');
             return true;

    }



    public function actionDelete($id){

            Cart::deleteProduct($id);
            header("Location: /cart");


    }

}