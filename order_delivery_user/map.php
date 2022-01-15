<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT o.id_user, o.id_orders,o.invoice,u.name,u.address,u.phone,u.lat,u.lng,o.order_at,o.status 
FROM  orders_delivery  as o 
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
                    
                    <h6>เลขที่ใบเสร็จ</h6> <span class="align-middle"><?= $data['invoice'] ?></span><br>


                    <h6>วัน-เวลาที่สั่งซื้อ</h6> <span class="align-middle"><?= $data['order_at'] ?></span><br>

                    <h6>ที่อยู่</h6>

                    <span class="align-middle"><?= $data['address'] ?></span><br>
                    <h6>เบอร์ลูกค้า</h6> <span class="align-middle"><?= $data['phone'] ?></span>
                    <br><br>
                    <h6>ตำเเหน่งที่อยู่</h6>
                    <div id='map' style='width:600px;height:400px'></div>

                <?php endforeach; ?>



            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->

<script type='text/javascript'>
    (function() {

        var map, marker, latlng;
        /* initial locations for map */
        var _lat = <?= $data['lat'] ?>;
        var _lng = <?= $data['lng'] ?>;

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