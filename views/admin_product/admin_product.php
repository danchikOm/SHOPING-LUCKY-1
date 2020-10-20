<?php include ROOT.'/views/layout/header_admin.php'; ?>

<section>
<div class="container">
    <div class="row">
        <br>
        <div class="breadcrumbs">
          <ol class="breadcrumb">
              <li><a href="/admin">Админ Панель</a></li>
              <li class="active">Управление товарами</li>
          </ol>
        </div>
        <a href="/admin/product/create/" class="btn btn-default back"><i class="fa fa-plus"></i>Добавить товар</a>
        <h4>Список товаров</h4>

        <br>
        <table class="table-bordered table-striped table">
            <tr>
                <th>Id товара</th>
                <th>Артикуль</th>
                <th>Название товара</th>
                <th>Цена</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($products as $productItem): ?>
            <tr>
                <td><?php echo $productItem['id'];?></td>
                <td><?php echo $productItem['code'];?></td>
                <td><?php echo $productItem['name'];?></td>                
                <td><?php echo $productItem['price'];?></td>
                <td><a href="/admin/product/update/<?php echo $productItem['id'];?>" title="редактировать"><i class="fa fa-pencil-square"></i></a></td>
                <td><a href="/admin/product/delete/<?php echo $productItem['id'];?>" title="удалить"><i class="fa fa-times"></i></a></td>
            </tr>

        <?php endforeach;?>
        </table>
    </div>
</div>

</section>
<?php include ROOT.'/views/layout/footer_admin.php'; ?>

