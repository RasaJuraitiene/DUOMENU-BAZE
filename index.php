<?php include 'app/php/php.php'; ?>

<html>
<head>
    <title>Registration form</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<div class="main_block d-flex justify-content-around m-5">
    <section>
        <form action="#" method="post" name="sent">
            <h2 class="text-center ">Order form</h2>
            <div>
                <input type="email" placeholder="Your email" name="user_email">
            </div>
            <div>
                <select name="flower_name">
                    <option value="roses">Roses</option>
                    <option value="paeonia">Paeonia</option>
                    <option value="tulips">Tulips</option>
                </select>
            </div>
            <div>
                <input min="1" max="1000"type="number" placeholder="Units" name="flower_units">
            </div>
            <div>
                <select name="flower_packaging" >
                    <option value="in_box">In_box</option>
                    <option value="paper_bag">Paper_bag</option>
                    <option value="no_packaging">No packaging</option>
                </select>
            </div>
            <div>
                <input min="1" max="10" type="number" placeholder="Flower price pcs" name="flower_price_pcs">
            </div>
            <div>
                <input type="submit" name="order" value="Order">
            </div>
        </form>
    </section>
    <section>
        <h2 class="text-center ">Your order</h2>
        <table>
            <thead>
            <tr>
                <th>Order ID:</th>
                <th>User email</th>
                <th>Flower name</th>
                <th>Flower units</th>
                <th>Flower packaging</th>
                <th>Flower price</th>
                <th>Order sum</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $object): ?>

                <tr>
                    <?php foreach ($object as $value): ?>
                        <td><?=$value;?></td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </section>
</div>
<section>
    <form action="#" method="post" name="edit">
        <h2 class="text-center ">Change order</h2>
       <div>
           <select name="order_id">
              <?php get_order_id($orders); ?>
           </select>
           <input type="submit" value="delete" name="delete">
       </div>

        <div>
            <input type="email" placeholder="Your email" name="user_email">
        </div>
        <div>
            <select name="flower_name">
                <option value="roses">Roses</option>
                <option value="paeonia">Paeonia</option>
                <option value="tulips">Tulips</option>
            </select>
        </div>
        <div>
            <input min="1" max="1000"type="number" placeholder="Units" name="flower_units">
        </div>
        <div>
            <select name="flower_packaging" >
                <option value="in_box">In_box</option>
                <option value="paper_bag">Paper_bag</option>
                <option value="no_packaging">No packaging</option>
            </select>
        </div>
        <div>
            <input min="1" max="10" type="number" placeholder="Flower price pcs" name="flower_price_pcs">
        </div>
        <div>
            <input type="submit" name="edit" value="Edit">
        </div>
    </form>
</section>
<!-- bootstrap js  -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
<script src="assets/js/jqery.js"></script>
</body>
</html>