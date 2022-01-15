<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id_user = '$id'";
    $query = mysqli_query($connection, $sql);
    $result = mysqli_fetch_assoc($query);
}

if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST);



    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];



    //exit();
    $sql = "UPDATE user SET name = '$name', email = '$email', phone = '$phone'
        , address = '$address',status = '$status'  WHERE id_user = '$id'";
    if (mysqli_query($connection, $sql)) {
        //echo "เพิ่มข้อมูลสำเร็จ";
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("เเก้ไขข้อมูลสำเร็จ");';
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
        <h1 class="app-page-title mb-0">เเก้ไขข้อมูลสมาชิก</h1>
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
                        <label class="form-label">ID ผู้ใช้</label>
                        <input type="text" value="<?= $result['id_user'] ?>" class="form-control" placeholder="ชื่อผู้ใช้" disabled required>
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" value="<?= $result['name'] ?>" class="form-control" name="name" placeholder="ชื่อผู้ใช้" required>
                    </div>


                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อีเมล์</label>
                        <input type="email" value="<?= $result['email'] ?>" class="form-control" name="email" readonly placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input type="number" value="<?= $result['phone'] ?>" class="form-control" name="phone" placeholder="" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ที่อยู่</label>
                        <textarea class="form-control " style="height: 80px" name="address"><?= $result['address'] ?></textarea>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <h6>ตำเเหน่งที่อยู่</h6>
                        <div id='map' style='width:600px;height:400px'></div>
                    </div>
                    <div class="mb-3 col-lg-6">

                        <label class="form-label">สถานะ</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled>กำหนดการใช้งาน</option>
                            <option value="1" <?php echo ($result['status'] == 1) ? 'selected' : ''; ?>> เปิดการใช้งาน</option>
                            <option value="0" <?php echo ($result['status'] == 0) ? 'selected' : ''; ?>>ปิดการใช้งาน</option>

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


<script type="text/javascript">
    function triggerFile() {

        $("#image").trigger("click");
        return false
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        readURL(this);
    });




    (function() {

        var map, marker, latlng;
        /* initial locations for map */
        var _lat = <?= $result['lat'] ?>;
        var _lng = <?= $result['lng'] ?>;

        function showMap() {
            /* set the default initial location */
            latlng = {
                lat: _lat,
                lng: _lng
            };

            /* invoke the map */
            map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 18
            });

            /* show the initial marker */
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Hello World!'
            });


            /* I think you can use the jQuery like this within the showMap function? */
            $.ajax({
                url: 'phpmobile/getlanglong.php',
                data: {
                    "id": getacara
                },
                dataType: 'json',
                success: function(data, status) {
                    $.each(data, function(i, item) {

                        /* add a marker for each location in response data */
                        addMarker(item.latitude, item.longitude, 'A title ~ could be returned in json data');
                    });
                },
                error: function() {
                    output.text('There was an error loading the data.');
                }
            });
        }

        /* simple function just to add a new marker */
        function addMarker(lat, lng, title) {
            marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map: map,
                title: title
            });
        }

        document.addEventListener('DOMContentLoaded', showMap, false);
    }());
</script>