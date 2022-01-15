<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM orders_delivery WHERE id_orders = '$id'";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);
    //print_r($result);
    //  exit;
}

if (isset($_POST) && !empty($_POST)) {


    $status = $_POST['status'];

    $sql = "UPDATE orders_delivery SET    status= '$status' WHERE id_orders = '$id'";
    if (mysqli_query($connection, $sql)) {
        //echo "เพิ่มข้อมูลสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เเก้ไขข้อมูลสินค้าสำเร็จ");';
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
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">จัดการสถานะคำสั่งซื้อ</h1>
    </div>
    <div class="col-auto ">
        <div class="d-flex justify-content-start">
            <a href="?page=<?= $_GET['page'] ?>" class="btn app-btn-secondary  mb-2 float-right">ย้อนกลับ</a>
        </div>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4  settings-section">

    <div class="col-12 col-md-12">

        <div class="app-card app-card-settings shadow-sm p-4 ">

            <div class="app-card-body">

                <form action="" method="POST" enctype="multipart/form-data">



                    <div class="mb-3 col-lg-6">

                        <label class="form-label">สถานะคำสั่งซื้อ</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled>กรุณาเลือก</option>
                            <option value="1" <?php echo ($result['status'] == 1) ? 'selected' : ''; ?>>รอชำระเงิน</option>
                            <option value="2" <?php echo ($result['status'] == 2) ? 'selected' : ''; ?>>กำลังเตรียมสินค้า</option>
                            <option value="3" <?php echo ($result['status'] == 3) ? 'selected' : ''; ?>>จัดส่งสินค้าเเล้ว</option>

                        </select>
                    </div>
                    <button type="submit" class="btn app-btn-primary">บันทึก</button>
                </form>
            </div>
            <!--//app-card-body-->

        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->