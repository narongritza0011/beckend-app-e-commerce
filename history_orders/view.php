<?php


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT o.invoice,o.quantity,o.price,p.name
    FROM order_details as o
    INNER JOIN product as p ON o.id_product = p.id_product WHERE invoice = '$id'";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);
}



if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql_detail = "SELECT 
     SUM(price*quantity) as total
    FROM order_details
     WHERE invoice = '$id'";
    $query_detail = mysqli_query($connection, $sql_detail);
    $result_detail = mysqli_fetch_assoc($query_detail);
}


//echo '<pre>';
//print_r($id);
//echo '</pre>';
//exit();



?>

<div class="d-flex justify-content-end">
    <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary  mb-2 float-right">ย้อนกลับ</a>
</div>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ดูรายละเอียด</h1>
    </div>
    <div class="col-auto">

    </div>
</div>

<hr class="mb-4">

<div class="row g-4  settings-section">

    <div class="col-12 col-md-12 ">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body ">
                <span class="align-middle">
                    <h6>เลขที่ใบเสร็จ</h6> <?php echo $id ?>
                </span>


                <?php foreach ($query as $data) : ?>
                    <hr>

                    <span class="align-middle">
                        <?= $data['name'] ?>
                    </span><br>
                    <span class="align-middle">
                       จำนวน <?= $data['quantity'] ?> ชิ้น <br>
                    </span>
                    <span class="align-middle">
                        ราคา <?= $data['price'] ?> บาท
                    </span><br>
                    <hr>

                <?php endforeach; ?>


                <h6 class="text-end">ราคารวม</h6>
                <div class="d-flex justify-content-end">
                    <span class="align-middle">
                        <?= $result_detail['total'] ?> บาท
                    </span>
                </div>




            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->