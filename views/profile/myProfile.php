<?php include ROOT.'/views/layout/header.php';  ?>
<section>
    <div class="container">
        <div class="row">
            <h1>Личные Данные</h1>
            <h2>Добро пожаловать на сайт: <?php echo $user['name']; ?> !</h2>
            <ul>
                <li><a href="/myProfile/edit">Редактрирование личных данных</a></li>
                <li><a href="/user/history/">Список покупок</a></li>
            </ul>
        </div>
    </div>



</section>

<?php include ROOT.'/views/layout/footer.php';  ?>
