<?php include ROOT.'/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админ Панель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Просмотр заказа</li>

                </ol>
            </div>
            <h4>Просмотр заказа № <?php echo $id;?></h4>
            <br>
            <br>
            <h5>Информация о заказе</h5>

            <br>
            <table class="table-admin-small table-striped table">
                    <tr>
                    <td>Номер заказа</td>
                     <td><?php echo $order['id'];?></td>
                    </tr>
                <tr>
                    <td>Имя клиента</td>
                    <td><?php echo $order['username'];?></td>
                </tr>
                <tr>
                    <td>Телефон клиента</td>
                    <td><?php echo $order['user_phone'];?></td>
                </tr>
                <tr>
                    <td>Комментарий клиента</td>
                    <td><?php echo $order['user_comment'];?></td>
                </tr>
                <tr>
                    <td>Статус заказа</td>
                    <td><?php echo Order::getStatusText($order['status']);?></td>
                </tr>
                <tr>
                    <td>Дата заказа</td>
                    <td><?php echo $order['date'];?></td>
                </tr>
            </table>

            <h5>Товары в заказе</h5>
            
                <table class="table-admin-medium  table-bordered table-striped table">
                    <tr>
                        <th>Id товара</th>
                        <th>Артикуль</th>
                        <th>Название товара</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                    <?php foreach ($products as $productItem): ?>
                        <tr>
                            <td><?php echo $productItem['id'];?></td>
                            <td><?php echo $productItem['code'];?></td>
                            <td><?php echo $productItem['name'];?></td>
                            <td><?php echo $productItem['price'];?></td>
                            <td><?php echo $productsQuantity[$productItem['id']];?></td>
                        </tr>
                <?php endforeach;?>
            </table>
            <a href="/admin/order" class="btn btn-default back"><i class="fa fa-arrow-left">Назад</i></a>
        </div>
    </div>

</section>
<?php include ROOT.'/views/layout/footer_admin.php'; ?>

