<?php
include("../dbcon.php");

session_start();

if(!isset($_SESSION['user_session'])){
    header("location:index.php");
}

if(isset($_POST['submit'])){
    $invoice_number = $_GET['invoice_number'];
    echo "<h1>....LOADING</h1>";

    $bar_code = $_POST['bar_code'];
    $med_name = $_POST['med_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $reg_date = strtotime($_POST['reg_date']);
    $new_reg_date = date('Y-m-d', $reg_date);
    $exp_date = strtotime($_POST['exp_date']);
    $new_exp_date = date('Y-m-d', $exp_date);
    $company = $_POST['company'];
    $sell_type = $_POST['sell_type'];
    $actual_price = $_POST['actual_price'];
   

    $wholesale_price = $_POST['wholesale_price'];
    $retail_price = $_POST['retail_price'];

    $wholesale_profit = $wholesale_price - $actual_price;
    $retail_profit = $retail_price - $actual_price;

    $wholesale_profit_percentage = (($wholesale_profit / $actual_price) * 100);
    $retail_profit_percentage = (($retail_profit / $actual_price) * 100);

    $status = "Available";

    $wholesale_price = intval($_POST['wholesale_price']);
    $retail_price = intval($_POST['retail_price']);

    $sql = "INSERT INTO stock(bar_code, medicine_name, category, quantity, remain_quantity, act_remain_quantity, register_date, expire_date, company, sell_type, actual_price,  status, wholesale_price, retail_price, wholesale_profit, retail_profit) 
    VALUES ('$bar_code', '$med_name', '$category', '$quantity', '$quantity', '$quantity', '$new_reg_date', '$new_exp_date', '$company', '$sell_type', '$actual_price',  '$status', '$wholesale_price', '$retail_price', '$wholesale_profit', '$retail_profit')";

    $result = mysqli_query($con, $sql);

    if($result){
        echo "<script type='text/javascript'>window.top.location='view.php?invoice_number=$invoice_number';</script>";
    }
}
?>
