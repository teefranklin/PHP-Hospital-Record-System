<?php 

include "includes/header.php"; 
$query ="SELECT * FROM patient";
$statement = $db->prepare($query);
$statement->execute();
$count= $statement -> rowCount();
$result = $statement->fetchAll();

?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Patients</h1>
           <div class="container">
           <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Patients</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>First Name</th>
                      <th>Last name</th>
                      <th>Email</th>
                      <th>DOB</th>
                      <th>Blood type</th>
                      <th>Address</th>
                      <th>Hospital</th>
                      <th>Added Date</th>
                      <th>NOK</th>
                      <th>NOK Address</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>First Name</th>
                      <th>Last name</th>
                      <th>Email</th>
                      <th>DOB</th>
                      <th>Blood type</th>
                      <th>Address</th>
                      <th>Hospital</th>
                      <th>Date Added</th>
                      <th>NOK</th>
                      <th>NOK Address</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($result as $row) : ?>
                            <tr>
                                <td><?php echo $row['id_no'] ?></td>
                                <td><?php echo $row['fname'] ?></td>
                                <td><?php echo $row['lname'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['dob'] ?></td>
                                <td><?php echo $row['blood_type'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['hospital'] ?></td>
                                <td><?php echo $row['date_added'] ?></td>
                                <td><?php echo $row['nok_fname']." ".$row['nok_lname'] ?></td>
                                <td><?php echo $row['nok_address'] ?></td>
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