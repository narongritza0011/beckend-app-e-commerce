<?php


$id = 1;
$sql = "SELECT * FROM tb_about WHERE id = '$id'";
$query = mysqli_query($connection, $sql);
$result = mysqli_fetch_assoc($query);


if (isset($_POST) && !empty($_POST)) {

    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    // exit();


    $image_qr = $_POST['image_qr'];
    $name_bank = $_POST['name_bank'];
    $bank_number = $_POST['bank_number'];
    $full_name = $_POST['full_name'];
    $line_id = $_POST['line_id'];

    $sql = "UPDATE tb_about SET image_qr = '$image_qr', name_bank = '$name_bank', bank_number = '$bank_number'
        , full_name = '$full_name' , line_id = '$line_id' WHERE id = '$id'";
    if (mysqli_query($connection, $sql)) {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("อัปเดตข้อมูลช่องทางการชำระเงินฉันสำเร็จ");';
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
        <h1 class="app-page-title mb-0">ข้อมูลช่องทางการชำระเงิน</h1>
    </div>
    <div class="col-auto ">

    </div>
</div>
<hr class="mb-4">
<div class="row g-4  settings-section">

    <div class="col-12 col-md-12">

        <div class="app-card app-card-settings shadow-sm p-4 ">

            <div class="app-card-body">

                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รูป QR code สำหรับชำระเงิน</label><br>
                        <img width="100" src="<?= $result['image_qr'] ?>" alt="" srcset=""><br>
                        <input type="text" value="<?= $result['image_qr'] ?>" class="form-control" name="image_qr" placeholder="ใส่ url รูปภาพ" required>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อธนาคาร</label>
                        <textarea class="form-control " style="height: 200px" name="name_bank"><?= $result['name_bank'] ?></textarea>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เลขบัญชีธนาคาร</label>
                        <textarea class="form-control " style="height: 80px" name="bank_number"><?= $result['bank_number'] ?></textarea>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" value="<?= $result['full_name'] ?>" class="form-control " name="full_name" required>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ID ไลน์</label>
                        <input value="<?= $result['line_id'] ?>" class="form-control " name="line_id" required>
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