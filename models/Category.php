<?php


class Category
{
    public static function getCategoriesList() {

        $db = DataBase::getConnection();

        $categoryList = [];

        $result = $db->query("SELECT id, name FROM category ORDER BY sort_order ASC");

        $i=0;
        while ($row = $result->fetch()){
            $categoryList[$i]['id']     = $row['id'];
            $categoryList[$i]['name']   = $row['name'];

            $i++;
        }
        return $categoryList;
    }

    public static function getCategoriesListAdmin()
    {
        $db = DataBase::getConnection();
        $categoryList = [];
        $result = $db->query("SELECT id, name, sort_order, status FROM category ORDER BY id ASC");
        $i=0;
        while ($row = $result->fetch()){
            $categoryList[$i]['id']             = $row['id'];
            $categoryList[$i]['name']           = $row['name'];
            $categoryList[$i]['sort_order']     = $row['sort_order'];
            $categoryList[$i]['status']         = $row['status'];
            $i++;
        }
        return $categoryList;
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

    public static function getCategoryById($id)
    {
        $db = DataBase::getConnection();
        $sql = "select * from category where id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(":id",$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();

    }

    public static function updateCategoryById($id, $options)
    {
        $db = DataBase::getConnection();
        $sql = "update category set name=:name, sort_order=:sort_order, status=:status where id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(":id",$id, PDO::PARAM_INT);
        $result->bindParam(":name",$options['name'],PDO::PARAM_STR);
        $result->bindParam(":sort_order",$options['sort_order'],PDO::PARAM_INT);
        $result->bindParam(":status",$options['status'],PDO::PARAM_INT);
        return $result->execute();


    }


}