<?php

$sql = "SELECT o.invoice,u.name,u.address,o.order_at,o.status 
FROM  orders_delivery  as o 
INNER JOIN user as u
 ON  o.id_user  = u.id_user 
 WHERE o.status=3
 ";
$query = mysqli_query($connection, $sql);


?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">ประวัติรายการสั่งซื้อทั้งหมด</h1>
    </div>
    <div class="col-auto">

    </div>
</div>

<hr class="mb-4">
<div class="row g-4  settings-section">
    <div class="col-12 col-md-12 ">
        <div class="app-card app-card-settings shadow-sm p-4">

            <div class="app-card-body ">

                <table class="table  table-hover" id="tableall">
                    <thead class="text-center ">
                        <tr>

                            <th scope="col">หมายเลขคำสั่งซื้อ</th>
                            <th scope="col">ชื่อผู้ใช้</th>
                            <th scope="col">ที่อยู่</th>
                            <th scope="col">วัน-เวลา</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($query as $data) : ?>
                            <tr>
                                <td class="align-middle"><?= $data['invoice'] ?></td>
                                <td class="align-middle"><?= $data['name'] ?></td>
                                <td class="align-middle"><?= $data['address'] ?></td>
                                <td class="align-middle"><?= $data['order_at'] ?></td>
                                <td class="align-middle"><?= ($data['status'] == 1 ? '<span class="badge bg-warning text-white">รอดำเนินการ</span>' : '<span class="badge bg-success text-white">คำสั่งซื้อสำเร็จ</span>') ?></td>
                                <td class="align-middle">
                                    <a href="?page=<?= $_GET['page'] ?>&function=view&id=<?= $data['invoice'] ?>" class="btn btn-sm btn-info text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg> </a>
                                   


                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->
    </div>
</div>
<!--//row-->




<script type="text/javascript">
    $(document).ready(function() {
        $('#tableall').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "ไม่มีข้อมูล",
                "info": "เเสดง _START_ - _END_ จาก _TOTAL_ รายการทั้งหมด",
                "infoEmpty": "เเสดง 0 - 0 จาก 0 รายการ",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "เเสดง _MENU_ รายการ",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "search": "ค้าหา:",
                "zeroRecords": "ไม่มีข้อมูลที่ค้นหา",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "หน้าถัดไป",
                    "previous": "ก่อนหน้า"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });
    });
</script>

<?php
mysqli_close($connection);
?>