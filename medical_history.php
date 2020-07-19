<?php 

include "includes/header.php"; 

$query ="SELECT * FROM med_history inner join patient where med_history.patient_id=patient.id";

// $query ="SELECT * FROM med_histrory inner join patient where med_histrory.patient_id=patient.id and patient.id_no=?";

$statement = $db->prepare($query);
$statement->execute();
$count= $statement -> rowCount();
$result = $statement->fetchAll();

?><!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Medical Records</h1>
           <div class="container">
           <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Medical Records</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Patient Name</th>
                      <th>ID Number</th>
                      <th>Doctor</th>
                      <th>Illness Description</th>
                      <th>Hospital</th>
                      <th>Date Added</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Patient Name</th>
                      <th>ID Number</th>
                      <th>Doctor</th>
                      <th>Illness Description</th>
                      <th>Hospital</th>
                      <th>Date Added</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($result as $row) : ?>
                            <tr>
                                <td><?php echo $row['fname']." ".$row['lname'] ?></td>
                                <td><?php echo $row['id_no'] ?></td>
                                <td><?php echo $row['doctor'] ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo $row['hospital'] ?></td>
                                <td><?php echo $row['added_date'] ?></td>
                            </tr>
                        <?php endforeach; ?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
       </div>
        <!-- /.container-fluid -->
<?php 

include "includes/footer.php"; 

?>