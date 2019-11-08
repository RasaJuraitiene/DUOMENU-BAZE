<?php

$servername = "phpsualum.lt";
$username = "root";
$password = "";
$dbname = "db_test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print "connection failed" . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_email = $_POST['user_email'];
    $flower_name = $_POST['flower_name'];
    $flower_units = $_POST['flower_units'];
    $flower_packaging = $_POST['flower_packaging'];
    $flower_price_pcs = $_POST['flower_price_pcs'];
    $order_sum = $flower_units * $flower_price_pcs;

    if (empty($user_email) || empty($flower_units) || empty($flower_price_pcs)){
        print $status = "Inputs are empty!";
    }elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
    $status = "Enter valid email!";
        }else {
//            Cia reikia irasyti koda is duomenu bazes. pirmos reiksmes yra pavadinimai paimti is duomenu bazes, po VALUES paimti is input laukeliu
            $sql = "INSERT INTO flowers_orders (user_email, flower_name, flower_units, flower_packaging, flower_price_pcs, order_sum) VALUES (:user_email, :flower_name, :flower_units, :flower_packaging, :flower_price_pcs, :order_sum)";

            $stmt=$conn->prepare($sql);
            $stmt->execute(['user_email' => $user_email, 'flower_name' => $flower_name, 'flower_units' => $flower_units, 'flower_packaging' => $flower_packaging, 'flower_price_pcs' => $flower_price_pcs, 'order_sum' => $order_sum]);

            print $status="Your information was sent";
    }

    
}

$sql1 = "SELECT `flower_name` FROM `flowers` WHERE 1";
$sql2 =  "SELECT `user_email`, `flower_name`, `flower_units`, `flower_packaging`, `flower_price_pcs`, `order_sum` FROM `flowers_orders` WHERE 1";

class FLOWERS
{

}

;
class ORDERS
{

}

;
//aprasome visa eiga users kintamajam (prisijungimas prie duomenu
//bazes, mySQL uzklausa, grazinimas gautu duomenu i naujai sukurta klase)
$flowersNEW = $conn->query($sql1)->fetchAll(PDO::FETCH_CLASS, 'FLOWERS');
$orders = $conn->query($sql2)->fetchAll(PDO::FETCH_CLASS, 'ORDERS');

////pasitikrinam ar gaunam reikiamus duomenis - objektus
////var_dump($orders);

////uzdarom prisijungima prie duomenu bazes
$conn = null;

?>
<html>
<head>
    <title>Registration form</title>
    <style>
        .main_block {
            width: 80%;
            height: 90vh;
            margin: 0 auto;
        }
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
        }
        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }
        input, select {
            width: 15vw;
            padding: 5px;
            margin: 5px !important;
        }
        section {
            width: 40vw;
            height: 40vh;
            border-radius: 5%;
            padding: 10px;
        }


    </style>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main_block d-flex justify-content-around m-5">
    <section>
    <form action="#" method="post">
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
        <input type="submit" value="Order">
        </div>
    </form>
    </section>
    <section>
        <h2 class="text-center ">Your order</h2>
        <table>
                    <thead>
                    <tr>
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
<!-- bootstrap js  -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
<script src="assets/js/jqery.js"></script>
</body>
</html>