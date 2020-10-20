<?php include ROOT.'/views/layout/header.php';  ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 padding-right">
                <?php if ($result): ?>
                <p>Данные отредактированы!!! </p>
                <?php else: ?>
                <?php  if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif;  ?>

                <div class="signup-form">
                    <h2>Редактирование данных</h2>
                    <form action="#" method="post">
                        <p>Имя</p>
                        <input type="text"  name="name"  placeholder="Name" value="<?php echo $name; ?>"/>
                        <p>Пароль</p>
                        <input type="password"  name="password" placeholder="Password" value="<?php echo $password; ?>"/>
                        <br/>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить"/>
                    </form>
                </div>
              <?php endif;  ?>
            </div>
        </div>
    </div>

</section>

<?php include ROOT.'/views/layout/footer.php';  ?>
