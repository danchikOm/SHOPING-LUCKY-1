
<?php include ROOT . '/views/layout/header.php'; ?>
<style>

#login {
-webkit-perspective: 1000px;
-moz-perspective: 1000px;
perspective: 1000px;
margin-top:50px;
margin-left:30%;
}
.login {
font-family: 'Josefin Sans', sans-serif;
-webkit-transition: .3s;
-moz-transition: .3s;
transition: .3s;
-webkit-transform: rotateY(40deg);
-moz-transform: rotateY(40deg);
transform: rotateY(40deg);
}
.login:hover {
-webkit-transform: rotate(0);
-moz-transform: rotate(0);
transform: rotate(0);
}
.login article {

}
.login .form-group {
margin-bottom:17px;
}
.login .form-control,
.login .btn {
border-radius:0;
}
.login .btn {
text-transform:uppercase;
letter-spacing:3px;
}
.input-group-addon {
border-radius:0;
color:#fff;
background:#f3aa0c;
border:#f3aa0c;
}
h3{
    color: #2a6496;
}
.forgot {
font-size:16px;
}
.forgot a {
color:#333;
}
.forgot a:hover {
color:#5cb85c;
}

#inner-wrapper, #contact-us .contact-form, #contact-us .our-address {
color: #1d1d1d;
font-size: 19px;
line-height: 1.7em;
font-weight: 300;
padding: 50px;
background: #fff;
box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
margin-bottom: 100px;
}
.input-group-addon {
border-radius: 0;
border-top-right-radius: 0px;
border-bottom-right-radius: 0px;
color: #fff;
background: #f3aa0c;
border: #f3aa0c;
border-right-color: rgb(243, 170, 12);
border-right-style: none;
border-right-width: medium;
}
</style>
    <div class="col-md-4 col-md-offset-4"  id="login">
        <?php if ($result): ?>
        <p>Вы успешно зарегистрированы!!!</p>
        <?php else: ?>
        <?php  if (isset($errors) && is_array($errors)): ?>
        <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </ul>
        <?php endif;  ?>
        <section id="inner-wrapper" class="login">

            <article>
                <h3>Регистрация на сайте </h3>

                <form method="post" action="">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
                            <input type="email" class="form-control" name="email"  placeholder="Email Address" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                            <input type="password" class="form-control"  name="confPassw" placeholder="Confirm Password"  value="<?php echo $confPassw; ?>">
                        </div>
                    </div>
                    <input type="submit" name="registr" class="btn btn-success btn-block" value="Регистрация"/>
                </form>
            </article>
        </section>
        <?php endif; ?>
    </div>
<?php include ROOT . '/views/layout/footer.php'; ?>


