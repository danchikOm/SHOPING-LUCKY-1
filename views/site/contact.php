<?php include ROOT.'/views/layout/header.php';  ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 padding-right">
                <?php if ($result): ?>
                    <p>Сообщение успешно отправлено! Мы ответим вам на указанный email. </p>
                <?php else: ?>
                    <?php  if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif;  ?>

                    <div class="signup-form">
                        <h2>Обратная связь</h2>
                        <h5>Есть вопрос? Напишите нам!!!</h5>
                        <form action="#" method="post">
                            <p>Ваша почта</p>
                            <input type="email"  name="userEmail"  placeholder="Email" value="<?php echo $userEmail; ?>"/>
                            <p>Сообщение</p>
                            <input type="text"  name="userMessage" placeholder="Message" value="<?php echo $userMessage; ?>"/>
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Отправить"/>
                        </form>
                    </div>
                <?php endif;  ?>
            </div>
        </div>
    </div>

</section>

<?php include ROOT.'/views/layout/footer.php';  ?>
