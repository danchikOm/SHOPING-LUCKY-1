<?php include ROOT.'/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админ Панель</a></li>
                    <li class="active">Управление категориями</li>
                </ol>
            </div>
            <a href="/admin/category/create/" class="btn btn-default back"><i class="fa fa-plus"></i>Добавить категорию</a>
            <h4>Список категорий </h4>

            <br>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>Id категории</th>
                    <th>Название товара</th>
                    <th>Порядковый номер</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($categoriesList as $itemCategory): ?>
                    <tr>
                        <td><?php echo $itemCategory['id'];?></td>
                        <td><?php echo $itemCategory['name'];?></td>
                        <td><?php echo $itemCategory['sort_order'];?></td>
                        <td><?php echo $itemCategory['status'];?></td>
                        <td><a href="/admin/category/update/<?php echo $itemCategory['id'];?>" title="редактировать"><i class="fa fa-pencil-square"></i></a></td>
                        <td><a href="/admin/category/delete/<?php echo $itemCategory['id'];?>" title="удалить"><i class="fa fa-times"></i></a></td>
                    </tr>

                <?php endforeach;?>
            </table>
        </div>
    </div>

</section>
<?php include ROOT.'/views/layout/footer_admin.php'; ?>

