<?php


class AdminOrderController
{
    public function actionIndex()
    {

        // self::checkAdmin();

        $ordersList = Order::getOrderListAdmin();

        require_once ROOT . '/views/admin_order/admin_order.php';
        return true;
    }

    public function actionDelete($id)
    {
        // self::checkAdmin();

        if (isset($_POST['submit'])) {
            Order::deleteOrderById($id);
            header("Location: /admin/order");
        }
        require_once ROOT . '/views/admin_order/delete.php';
        return true;

    }


    public function actionUpdate($id)
    {
        // self::checkAdmin();
        $order = Order::getOrderById($id);
        $productsQuantity = json_decode($order['products_in_cart'],true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);
        if (isset($_POST['submit'])) {

            $options['username']       = $_POST['username'];
            $options['user_phone']     = $_POST['user_phone'];
            $options['user_comment']   = $_POST['user_comment'];
            $options['status']         = $_POST['status'];
            $options['date']           = $_POST['date'];

             if (Order::updateOrderById($id, $options)) {

                header("Location: /admin/order");
            }

        }

        require_once ROOT . '/views/admin_order/update.php';
        return true;
    }


    public function actionView($id)
    {
        // self::checkAdmin();
        $order = Order::getOrderById($id);
        $productsQuantity = json_decode($order['products_in_cart'],true);
        $productsIds = array_keys($productsQuantity);
        $products = Product::getProductsByIds($productsIds);

        require_once ROOT.'/views/admin_order/view.php';
        return true;
    }

}