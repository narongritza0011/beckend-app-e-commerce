<?php

$sql = "SELECT t.id, t.id_user,t.invoice,t.no_tracking,t.service,t.order_at,u.name,t.status
FROM  tb_tracking as t
INNER JOIN user as u
ON t.id_user = u.id_user 
 ";
$query = mysqli_query($connection, $sql);



// SELECT o.id_orders,o.invoice,u.name,u.address,o.order_at,o.status 
// FROM  orders  as o 
// INNER JOIN user as u
//  ON  o.id_user  = u.id_user 



?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">รายการจัดการเเจ้งเลขพัสดุ</h1>
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

                            <th scope="col">ชื่อผู้ใช้</th>
                            <th scope="col">เลขที่ใบเสร็จ</th>
                            <th scope="col">เลขเเจ้งพัสดุ</th>
                            <th scope="col">บริการ</th>
                            <th scope="col">วัน-เวลา</th>
                            <th scope="col">สถานะ</th>

                            <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($query as $data) : ?>
                            <tr>

                                <td class="align-middle"><?= $data['name'] ?></td>
                                <td class="align-middle"><?= $data['invoice'] ?></td>
                                <td class="align-middle"><?= $data['no_tracking'] ?></td>
                                <td class="align-middle"><?= $data['service'] ?></td>
                                <td class="align-middle"><?= $data['order_at'] ?></td>




                                <td class="align-middle"><?= ($data['status'] == 1 ? '<span class="badge bg-success text-white">เเจ้งเตือนเเล้ว</span>' :  '<span class="badge bg-danger text-white">ยกเลิกเเจ้งเตือน</span>') ?></td>
                                <td class="align-middle">

                                    <a href="?page=<?= $_GET['page'] ?>&function=update&id=<?= $data['id'] ?>" class="btn btn-sm btn-warning text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square " viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg></a>


                                    <a onclick="return confirm('คุณต้องการลบ คำสั่งซื้อ : <?= $data['id'] ?> หรือไม่')" href="?page=<?= $_GET['page'] ?>&function=delete&id=<?= $data['id'] ?>"" class=" btn btn-sm btn-danger text-white rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
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