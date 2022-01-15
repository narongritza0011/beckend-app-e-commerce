<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT t.id, t.id_user,t.invoice,t.no_tracking,t.service,t.order_at,u.name,t.status
    FROM  tb_tracking as t
    INNER JOIN user as u
    ON t.id_user = u.id_user WHERE id = '$id'
    ";



    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);
}



if (isset($_POST) && !empty($_POST)) {



    $id = $_GET['id'];
    $no_tracking = $_POST['no_tracking'];
    $service = $_POST['service'];
    $status = $_POST['status'];




    $sql = "UPDATE tb_tracking SET id = '$id', no_tracking = '$no_tracking', service = '$service'
         ,  status = '$status' WHERE id = '$id'";
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
        <h1 class="app-page-title mb-0">เเก้ไขข้อมูลสินค้า</h1>
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
                        <label class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" value="<?= $result['name'] ?>" class="form-control" placeholder="" disabled required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">วัน-เวลา ที่เเจ้งพัสดุ</label>
                        <input type="text" value="<?= $result['order_at'] ?>" class="form-control" disabled placeholder="" required>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เลขที่ใบเสร็จ</label>
                        <input type="text" value="<?= $result['invoice'] ?>" class="form-control" disabled placeholder="" required>
                    </div>



                    <div class="mb-3 col-lg-6">





                        <div class="mb-3 col-lg-6">
                            <label class="form-label">หมายเลขติดตามพัสดุ</label>
                            <input type="text" value="<?= $result['no_tracking'] ?>" class="form-control" name="no_tracking" placeholder="" required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label class="form-label">ประเภทบริการจัดส่ง</label>
                            <input type="text" value="<?= $result['service'] ?>" class="form-control" name="service" placeholder="" required>
                        </div>



                        <div class="mb-3 col-lg-6">

                            <label class="form-label">สถานะ</label>
                            <select name="status" class="form-control" required>
                                <option value="" disabled>กำหนดการใช้งาน</option>
                                <option value="1" <?php echo ($result['status'] == 1) ? 'selected' : ''; ?>> เเจ้งเตือนเเล้ว</option>
                                <option value="0" <?php echo ($result['status'] == 0) ? 'selected' : ''; ?>>ยกเลิกการเเจ้งเตือน</option>

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