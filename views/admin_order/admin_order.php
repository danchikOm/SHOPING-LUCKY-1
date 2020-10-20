<?php include ROOT.'/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админ Панель</a></li>
                    <li class="active">Управление заказами</li>
                </ol>
            </div>

            <h4>Список заказов </h4>

            <br>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>Id заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $orderItem): ?>
                    <tr>
                        <td><?php echo $orderItem['id'];?></td>
                        <td><?php echo $orderItem['username'];?></td>
                        <td><?php echo $orderItem['user_phone'];?></td>
                        <td><?php echo $orderItem['date'];?></td>
                        <td>
                            <?php echo Order::getStatusText($orderItem['status']);?>

                        </td>
                        <td><a href="/admin/order/view/<?php echo $orderItem['id'];?>" title="просмотр"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/order/update/<?php echo $orderItem['id'];?>" title="редактировать"><i class="fa fa-pencil-square"></i></a></td>
                        <td><a href="/admin/order/delete/<?php echo $orderItem['id'];?>" title="удалить"><i class="fa fa-times"></i></a></td>
                    </tr>

                <?php endforeach;?>
            </table>
        </div>
    </div>

</section>
<?php include ROOT.'/views/layout/footer_admin.php'; ?>

