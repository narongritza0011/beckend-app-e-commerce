<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT o.id_user, o.id_orders,o.invoice,u.name,u.address,u.lat,u.lng,o.order_at,o.status 
FROM  orders  as o 
INNER JOIN user as u
 ON  o.id_user  = u.id_user 
 WHERE invoice = '$id'";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);





    // echo '<pre>';
    //  print_r($id);
    // echo '</pre>';
    // exit();
}



if (isset($_POST) && !empty($_POST)) {

    // echo '<pre>';
    // print_r($_POST);
    // //print_r($_FILES);
    // echo '</pre>';
    // exit();



    $id_user = $_POST['id_user'];
    $invoice = $_POST['invoice'];
    $no_tracking = $_POST['no_tracking'];
    $service = $_POST['service'];





    $sql_check = "SELECT * FROM tb_tracking WHERE invoice = '$invoice'";
    // echo $sql_check;
    // exit;
    $check = mysqli_query($connection, $sql_check);
    if (mysqli_num_rows($check) > 0) {
        $sql = "UPDATE tb_tracking set no_tracking ='$no_tracking',service='$service' WHERE invoice = '$invoice'";
    } else {
        $sql =
            "INSERT INTO tb_tracking
(id_user, invoice, no_tracking, service,status) 
VALUES ('$id_user','$invoice','$no_tracking','$service','1')";
    }

    if (mysqli_query($connection, $sql)) {
        //echo "เพิ่มข้อมูลสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เพิ่มข้อมูลการจัดส่งสำเร็จ");';
        $alert .= 'window.location.href = "?page=' . $_GET['page'] . '"';
        $alert .= '</script>';
        echo $alert;
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
}


?>


<div class="d-flex justify-content-end">
    <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary  mb-2 float-right">ย้อนกลับ</a>
</div>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ที่อยู่ของลูกค้า</h1>
    </div>
    <div class="col-auto">

    </div>
</div>

<hr class="mb-4">

<div class="row g-4  settings-section">

    <div class="col-12 col-md-12 ">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body ">





                <?php foreach ($query as $data) : ?>
                    <h3>ข้อมูลลูกค้า</h3><br>

                    <h6>ชื่อลูกค้า</h6> <span class="align-middle"><?= $data['name'] ?></span>

                    <h6>เลขที่ใบเสร็จ</h6> <span class="align-middle"><?= $data['invoice'] ?></span>


                    <h6>สั่งเมื่อ</h6> <span class="align-middle"><?= $data['order_at'] ?></span>

                    <h6>ที่อยู่</h6>

                    <span class="align-middle"><?= $data['address'] ?></span><br>


                    <br>
                    <h3>เเจ้งเลขพัสดุ</h3>
                    <br>

                    <form action="" method="post">
                        <h6>เลขที่ไอดีลูกค้า</h6>
                        <input type="text" class="form-control" name="id_user" value="<?= $data['id_user'] ?>" placeholder="ประเภทบริการจัดส่ง" readonly required><br>
                        <h6>เลขที่ใบเสร็จ</h6>
                        <input type="text" class="form-control" name="invoice" value="<?= $data['invoice'] ?>" placeholder="ประเภทบริการจัดส่ง" readonly required><br>
                        <h6>หมายเลขติดตามพัสดุ</h6>
                        <input type="text" class="form-control" name="no_tracking" placeholder="เลขพัสดุเเจ้งลูกค้า" required>
                        <h6>ประเภทบริการจัดส่ง</h6>
                        <input type="text" class="form-control" name="service" placeholder="ประเภทบริการจัดส่ง" required><br>


                        <button type="submit" class="btn app-btn-primary">เเจ้งหมายเลขติดตามพัสดุ</button>
                    </form>

                <?php endforeach; ?>



            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->