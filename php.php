<?php

$servername = "phpsualum.lt";
$username = "root";
$password = "";
$dbname = "db_test";
$sql1 = "SELECT `flower_name` FROM `flowers` WHERE 1";
$sql2 =  "SELECT `order_id`, `user_email`, `flower_name`, `flower_units`, `flower_packaging`, `flower_price_pcs`, `order_sum` FROM `flowers_orders` WHERE 1";

class FLOWERS
{

}

class ORDERS
{

}

//sita funkcija naudojama gauti ID is lenteles ir atvaizduoti formoje prie select
function get_order_id($array)
{
    foreach ($array as $object) {
        print '<option value="' . $object->order_id . '">' . $object->order_id . "</option>";
    }
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print "connection failed" . $e->getMessage();
}
//$_POST ['order'] yra input mygtuko name, o 'order' = value

if (isset($_POST['order'])) {
//cia irasyti orderi pirmos formos (patikritna duomenis ir iraso uzsakyma i duomenu baze
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_email = $_POST['user_email'];
        $flower_name = $_POST['flower_name'];
        $flower_units = $_POST['flower_units'];
        $flower_packaging = $_POST['flower_packaging'];
        $flower_price_pcs = $_POST['flower_price_pcs'];
        $order_sum = $flower_units * $flower_price_pcs;

        if (empty($user_email) || empty($flower_units) || empty($flower_price_pcs)) {
            print $status = "Inputs are empty!";
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $status = "Enter valid email!";
        } else {
//            Cia reikia irasyti koda is duomenu bazes. pirmos reiksmes yra pavadinimai paimti is duomenu bazes, po VALUES paimti is input laukeliu
            $sql = "INSERT INTO flowers_orders (user_email, flower_name, flower_units, flower_packaging, flower_price_pcs, order_sum) VALUES (:user_email, :flower_name, :flower_units, :flower_packaging, :flower_price_pcs, :order_sum)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(['user_email' => $user_email, 'flower_name' => $flower_name, 'flower_units' => $flower_units, 'flower_packaging' => $flower_packaging, 'flower_price_pcs' => $flower_price_pcs, 'order_sum' => $order_sum]);

            //        print $status="Your information was sent";
        }
    }
    //cia IF baigiasi
    //$_POST ['edi'] yra input mygtuko name, o 'edit' = value
}elseif(isset($_POST['edit'])) {
//kitos formos IF, skirtas pakeisti orderio info duomenu bazeje
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $order_id = $_POST['order_id'];
        $user_email = $_POST['user_email'];

        if (empty($user_email) || empty($order_id)) {
            print $status = "Inputs are empty!";
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $status = "Enter valid email!";
        } else {
//            Cia reikia irasyti koda is duomenu bazes. pirmos reiksmes yra pavadinimai paimti is duomenu bazes, po VALUES paimti is input laukeliu
            $sqlupdate = "UPDATE `flowers_orders` SET `user_email` = '$user_email'  WHERE `order_id` = '$order_id'";

            $stmt = $conn->prepare($sqlupdate);
            $stmt->execute(['user_email' => $user_email]);
        }
    }
}
    if (isset ($_POST['delete'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_id = $_POST['order_id'];

//            Cia reikia irasyti koda is duomenu bazes. pirmos reiksmes yra pavadinimai paimti is duomenu bazes, po VALUES paimti is input laukeliu
            $sqlDELETE = "DELETE FROM `flowers_orders` WHERE order_id = '$order_id'";
            $stmt = $conn->prepare($sqlDELETE);
            $stmt->execute(['order_id' => $order_id]);
            print "pavyko";
        }
    }
//aprasome visa eiga users kintamajam (prisijungimas prie duomenu
//bazes, mySQL uzklausa, grazinimas gautu duomenu i naujai sukurta klase)
$flowersNEW = $conn->query($sql1)->fetchAll(PDO::FETCH_CLASS, 'FLOWERS');
$orders = $conn->query($sql2)->fetchAll(PDO::FETCH_CLASS, 'ORDERS');

//$update = $conn->query($sqlupdate)->fetchAll(PDO::FETCH_CLASS, 'Order_update');

////pasitikrinam ar gaunam reikiamus duomenis - objektus
//var_dump($orders);

////uzdarom prisijungima prie duomenu bazes
$conn = null;
?>