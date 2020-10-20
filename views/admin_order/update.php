<?php include ROOT.'/views/layout/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админ Панель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Редактирование заказа</li>

                </ol>
            </div>
            <h4>Редактирование заказа № <?php echo $id;?></h4>
            <br>
            <br>
            <h5>Информация о заказе</h5>

            <br>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                    <p>Имя клиента</p>
                    <input type="text" name="username" value="<?php echo $order['username'];?>">

                    <p>Телефон клиента</p>
                   <input type="text" name="user_phone" value="<?php echo $order['user_phone'];?>">

                    <p>Комментарий клиента</p>
                    <input type="text" name="user_comment" value="<?php echo $order['user_comment'];?>">

                    <p>Статус заказа</p>

                        <select name="status">
                            <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>Новый заказ</option>
                            <option value="2" <?php if ($order['status'] == 2) echo ' selected="selected"'; ?>>В обработке</option>
                            <option value="3" <?php if ($order['status'] == 3) echo ' selected="selected"'; ?>>Доставляется</option>
                            <option value="4" <?php if ($order['status'] == 4) echo ' selected="selected"'; ?>>Закрыт</option>
                        </select>

                    <p>Дата заказа</p>
                  <input type="text" name="date" value="<?php echo $order['date'];?>">

                <input type="submit" name="submit" value="Изменить Заказ">
            </form>
                </div>
            </div>

        </div>
    </div>

</section>
<?php include ROOT.'/views/layout/footer_admin.php'; ?>

