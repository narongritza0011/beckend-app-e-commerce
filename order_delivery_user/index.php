<?php

$sql = "SELECT o.id_orders,o.invoice,u.name,u.address,o.order_at,o.status 
FROM  orders_delivery  as o 
INNER JOIN user as u
 ON  o.id_user  = u.id_user 
 WHERE o.status in (1,2)
 ";
$query = mysqli_query($connection, $sql);







?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">รายการสั่งซื้อ Delivery ของลูกค้า</h1>
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
                            <th scope="col">วัน-เวลาที่สั่งซื้อ</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($query as $data) : ?>
                            <tr>

                                <td class="align-middle"><?= $data['invoice'] ?></td>
                                <td class="align-middle"><?= $data['name'] ?></td>
                                <td class="align-middle"><?= $data['order_at'] ?></td>




                                <td class="align-middle"><?= ($data['status'] == 1 ? '<span class="badge bg-danger text-white">รอชำระเงิน</span>' : ($data['status'] == 2 ?  '<span class="badge bg-warning text-white">กำลังเตรียมสินค้า</span>' : '<span class="badge bg-success text-white">จัดส่งสำเร็จ</span>')) ?></td>
                                <td class="align-middle">
                                    <a href="?page=<?= $_GET['page'] ?>&function=view&id=<?= $data['invoice'] ?>" class="btn btn-sm btn-info text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg> </a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=update&id=<?= $data['id_orders'] ?>" class="btn btn-sm btn-warning text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square " viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg></a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=map&id=<?= $data['invoice'] ?>" class="btn btn-sm btn-primary text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg> </a>

                                    <a onclick="return confirm('คุณต้องการลบ คำสั่งซื้อ : <?= $data['invoice'] ?> หรือไม่')" href="?page=<?= $_GET['page'] ?>&function=delete&id=<?= $data['invoice'] ?>"" class=" btn btn-sm btn-danger text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg></a>


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