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
    <?php if ($productsInCart): ?>
        <p>Вы выбрали слдедующие товары: </p>
     <table class="table-bordered table-striped table">
      <tr>
          <th>Код товара</th>
          <th>Название</th>
          <th>Стоимость</th>
          <th>Количество</th>
          <th>Удалить</th>
      </tr>
         <?php foreach ($products as $product): ?>
         <tr>
             <td><?php echo $product['code']; ?></td>
             <td>
                 <a href="/product/<?php echo $product['id'];?>">
                     <?php echo $product['name']; ?>
                 </a>
             </td>
             <td><?php echo $product['price']; ?></td>
             <td><?php echo $productsInCart[$product['id']]; ?></td>
             <td><a class="fa fa-close" href="/cart/delete/<?php echo $product['id'];?>">&#10008;</a></td>
         </tr>
         <?php endforeach;  ?>
         <tr>
             <td colspan="3">Общая стоимость</td>
                <td><?php echo $totalPrice;  ?></td>
         </tr>
         <tr>
             <?php endif; ?>
             <td>
                 <a href="/cart/checkout/" class="btn btn-primary">
                 <i class="fa fa-shopping-cart"></i>&nbsp;Оформить заказ</a>
             </td>
         </tr>
     </table>

        </div>
      </div>
    </div>
   </div>
 </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function (){
        $('.add-to-cart').click(function (){
            var id = $(this).attr('data-id');
            $.post("/cart/addAjax/"+id,{},function(response) {
                $('#cart-count').html(response);

            });
            return false;
        });
    });
</script>
<?php var_dump($_SERVER['DOCUMENT_ROOT']);?>
<?php include ROOT.'/views/layout/footer.php';  ?>

