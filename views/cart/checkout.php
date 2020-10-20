<?php include ROOT.'/views/layout/header.php';  ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id']; ?>" data-toggle="collapse" data-parent="#accordian" >
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            <?php echo $categoryItem['name'];  ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sportswear" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Nike </a></li>
                                            <li><a href="#">Under Armour </a></li>
                                            <li><a href="#">Adidas </a></li>
                                            <li><a href="#">Puma</a></li>
                                            <li><a href="#">ASICS </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
      <div class="col-sm-9 padding-right" >
    <div class="features_items">
    <h2 class="title text-center">Корзина</h2>

                  <?php if ($result):  ?>
                    <p>Заказ оформлен. Мы вам перезвоним</p>
                    <?php else: ?>

                    <p>Выбрано товаров на сумму <?php echo $totalPrice; ?> сом в количестве <?php echo $totalQuantity;?></p>


                    <div class="col-sm-4">
                    <?php  if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif;  ?>

                    <p>Для оформления заказа заполните форму. Наш менеджер свяжется с вами</p>
                    <div class="login-form">
                        <form action="#" method="post">
                            <p>Ваше Имя:</p>
                            <input type="text"  name="username"  placeholder="Имя" value="<?php echo $username; ?>"/>
                           <p>Номер телефона</p>
                            <input type="text"  name="user_phone"  placeholder="Номер телефона" value="<?php echo $user_phone;?>"/>
                            <p>Комментарий к заказу</p>
                            <input type="text"  name="user_comment"  placeholder="Комментарии" value="<?php echo $user_comment; ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить"/>
                        </form>
                    </div>
                    <br/>
                    <br/>
                </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</section>

<?php include ROOT.'/views/layout/footer.php';  ?>

