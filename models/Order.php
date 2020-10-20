<?php


class Order
{


    public static function save($username, $user_phone, $user_comment, $productsInCart, $userId)
    {
        $db = DataBase::getConnection();

        $sql = 'insert into product_order(username, user_phone, user_comment, products_in_cart, user_id)
                   values (:username, :user_phone, :user_comment, :products_in_cart, :user_id)';

        $productsInCart = json_encode($productsInCart);

       $result = $db->prepare($sql);
        $result->bindParam(':username',$username,PDO::PARAM_STR);
        $result->bindParam(':user_phone',$user_phone,PDO::PARAM_STR);
        $result->bindParam(':user_comment',$user_comment,PDO::PARAM_STR);
        $result->bindParam(':products_in_cart',$productsInCart,PDO::PARAM_STR);
        $result->bindParam(':user_id',$userId,PDO::PARAM_STR);

        return $result->execute();

    }

    public static function getOrderListAdmin()
    {
        $db = DataBase::getConnection();
        $orderList = [];
        $result = $db->query("SELECT * FROM product_order ORDER BY id ASC");
        $i=0;
        while ($row = $result->fetch()){
            $orderList[$i]['id']                   = $row['id'];
            $orderList[$i]['username']             = $row['username'];
            $orderList[$i]['user_phone']           = $row['user_phone'];
            $orderList[$i]['user_comment']         = $row['user_comment'];
            $orderList[$i]['user_id']              = $row['user_id'];
            $orderList[$i]['date']                 = $row['date'];
            $orderList[$i]['products_in_cart']     = $row['products_in_cart'];
            $orderList[$i]['status']               = $row['status'];
            $i++;
        }
        return $orderList;
    }

    public static function deleteCategoryById($id)
    {
        $db = DataBase::getConnection();

        $sql = "delete from category where id= :id";
        $result = $db->prepare($sql);
        $result->bindParam(":id",$id, PDO::PARAM_INT);
        return $result->execute();

    }

    public static function createCategory($options)
    {
        $db = DataBase::getConnection();
        $sql = "insert into category (name, sort_order, status) values (:name, :sort_order, :status)";
        $result = $db->prepare($sql);
        $result->bindParam(":name",$options['name'], PDO::PARAM_STR);
        $result->bindParam(":sort_order",$options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(":status",$options['status'], PDO::PARAM_INT);
        if ($result->execute()){
            return $db->lastInsertId();
        }
        return 0;

    }

    public static function getOrderById($id)
    {
        $db = DataBase::getConnection();
        $sql = "select * from product_order where id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(":id",$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();

    }



    public static function deleteOrderById($id)
    {
        $db = DataBase::getConnection();
        $sql = "delete from product_order where id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(":id",$id,PDO::PARAM_INT);
        return $result->execute();


    }


    public static function getStatusText($status)
    {
        switch ($status){
            case "1":
            return 'Новый заказ';
            break;
            case "2":
            return 'В обработке';
            break;
            case "3":
            return 'Доставляется';
            break;
            case "4":
            return 'Закрыт';
            break;

        }
    }

    public static function updateOrderById($id, $options)
    {
        var_dump($options);

        $db = DataBase::getConnection();
        $sql = "update product_order set username = :username, user_phone = :user_phone, 
                    user_comment = :user_comment, date = :date, status = :status where id = :id";

        $result = $db->prepare($sql);var_dump($result);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':username',$options['username'],PDO::PARAM_STR);
        $result->bindParam(':user_phone',$options['user_phone'],PDO::PARAM_STR);
        $result->bindParam(':user_comment',$options['user_comment'],PDO::PARAM_STR);
        $result->bindParam(':status',$options['status'],PDO::PARAM_INT);
        $result->bindParam(':date',$options['date'],PDO::PARAM_STR);


        return $result->execute();
    }



}