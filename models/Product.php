<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);


class Product {

    const DEFAULT_COUNT = 3;

    public static function getLatestProducts($count = self::DEFAULT_COUNT) {

        $count = intval($count);
        $db = DataBase::getConnection();

        $productList = [];

        $result = $db->query("SELECT id, name, price, image, is_new FROM product WHERE status = '1' and is_recommended='0' ORDER BY id DESC LIMIT " . $count);

        $i=0;
        while($row = $result->fetch()) {
            $productList[$i]['id']     = $row['id'];
            $productList[$i]['name']   = $row['name'];
            $productList[$i]['price']  = $row['price'];
            $productList[$i]['image']  = $row['image'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;
    }

    /**
     * Возвращает список рекомендуемых товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getRecProducts($count = self::DEFAULT_COUNT )
    {

        $count = intval($count);
        $db = DataBase::getConnection();

        $productList = [];

        $result = $db->query("SELECT id, name, price, image, is_new FROM product WHERE status='1' and is_recommended = '1' ORDER BY id DESC LIMIT " . $count);

        $i=0;
        while($row = $result->fetch()) {
            $productList[$i]['id']     = $row['id'];
            $productList[$i]['name']   = $row['name'];
            $productList[$i]['price']  = $row['price'];
            $productList[$i]['image']  = $row['image'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;

    }

    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {

       if ($categoryId) {
           $page = intval($page);
           $offset = ($page-1) * self::DEFAULT_COUNT;

           $db = DataBase::getConnection();
           $products = [];
           $result = $db->query("SELECT id, name, price, image, is_new FROM product 
            WHERE status = '1' AND category_id = '$categoryId' ORDER BY id ASC LIMIT ".self::DEFAULT_COUNT . " OFFSET ".$offset);

           $i = 0;

           while ( $row = $result->fetch()) {
               $products[$i]['id'] = $row['id'];
               $products[$i]['name'] = $row['name'];
               $products[$i]['price'] = $row['price'];
               $products[$i]['image'] = $row['image'];
               $products[$i]['is_new'] = $row['is_new'];
               $i++;
           }
       }
        return $products;
    }

    public static function getProductById($id)
    {

        $id = intval($id);
        if ($id){
            $db = DataBase::getConnection();

            $result = $db->query('select * from product where id ='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            return $result->fetch();

        }
    }

    public static function getTotalProductsInCategory($categoryId)
    {
        $db= DataBase::getConnection();
        $result = $db->query('select count(id) as count from product where status="1" and category_id ='.$categoryId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];



    }

    public static function getProductsByIds(array $productsIds)
    {
        $products = array();
        $db = DataBase::getConnection();

        $idsString = implode(',',$productsIds);

        $sql = "select * from product where status='1' and  id in ($idsString) ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()){
            $products[$i]['id']    = $row['id'];
            $products[$i]['code']  = $row['code'];
            $products[$i]['name']  = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;

        }
        return $products;

    }

    public static function getImage($id)
    {
        $path = '/upload/images/products/';
        $pathToImage = $path.$id.'.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)){
            return $pathToImage;
        }
        return $path.'no_images.jpg';



    }

    public static function getProductsList()
    {
        $db = DataBase::getConnection();

        $productsList = [];

        $result = $db->query("SELECT id, name, price, code FROM product  ORDER BY id ASC");

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['code'] = $row['code'];
            $i++;
        }

        return $productsList;
    }

    public static function deleteProductById($id)
    {
        $db = DataBase::getConnection();

        $sql='DELETE FROM product WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_INT);

        return $result->execute();

    }

    public static function createProduct($options)
    {
        $db = DataBase::getConnection();
        $sql = "insert into product(name, code, price,category_id, brand, availability, description, is_new, is_recommended, status)
                values (:name, :code, :price, :category_id, :brand, :availability, :description, :is_new, :is_recommended, :status)";
        $result = $db->prepare($sql);
        $result->bindParam(':name',$options['name'],PDO::PARAM_STR);
        $result->bindParam(':code',$options['code'],PDO::PARAM_STR);
        $result->bindParam(':price',$options['price'],PDO::PARAM_STR);
        $result->bindParam(':category_id',$options['category_id'],PDO::PARAM_INT);
        $result->bindParam(':brand',$options['brand'],PDO::PARAM_STR);
        $result->bindParam(':availability',$options['availability'],PDO::PARAM_INT);
        $result->bindParam(':description',$options['description'],PDO::PARAM_STR);
        $result->bindParam(':is_new',$options['is_new'],PDO::PARAM_INT);
        $result->bindParam(':is_recommended',$options['is_recommended'],PDO::PARAM_INT);
        $result->bindParam(':status',$options['status'],PDO::PARAM_INT);

        if ($result->execute()){
            return $db->lastInsertId();
        }
        return 0;

    }

    /**
     * @param $id товара
     * @param $options массив товара
     * @return boolean <p>результат выполнения метода</p>
     */
    public static function updateProductById($id, $options)
    {

        $db = DataBase::getConnection();
        $sql = "update product set name = :name, code = :code, price = :price, category_id = :category_id, brand = :brand,
                                    availability = :availability, description = :description, is_new = :is_new, is_recommended = :is_recommended,
                                     status = :status where id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':name',$options['name'],PDO::PARAM_STR);
        $result->bindParam(':code',$options['code'],PDO::PARAM_STR);
        $result->bindParam(':price',$options['price'],PDO::PARAM_STR);
        $result->bindParam(':category_id',$options['category_id'],PDO::PARAM_INT);
        $result->bindParam(':brand',$options['brand'],PDO::PARAM_STR);
        $result->bindParam(':availability',$options['availability'],PDO::PARAM_INT);
        $result->bindParam(':description',$options['description'],PDO::PARAM_STR);
        $result->bindParam(':is_new',$options['is_new'],PDO::PARAM_INT);
        $result->bindParam(':is_recommended',$options['is_recommended'],PDO::PARAM_INT);
        $result->bindParam(':status',$options['status'],PDO::PARAM_INT);
        return $result->execute();
    }

}










