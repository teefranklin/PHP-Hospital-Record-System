<?php 

include "includes/header.php"; 
$query ="SELECT * FROM auth_user";
$statement = $db->prepare($query);
$statement->execute();
$count= $statement -> rowCount();
$result = $statement->fetchAll();

?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">System Users</h1>
           <div class="container">
           <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User Id</th>
                      <th>First Name</th>
                      <th>Last name</th>
                      <th>Email</th>
                      <th>Admin</th>
                      <th>Hospital</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last name</th>
                      <th>Email</th>
                      <th>Admin</th>
                      <th>Hospital</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($result as $row) : ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['first_name'] ?></td>
                                <td><?php echo $row['last_name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td>
                                <?php 
                                	if($row['is_staff']){
                                		echo "Yes";
                                	}
                                	else{
                                		echo "No";
                                	}
                                 ?>
                                 </td>
                                <td><?php echo $row['hospital'] ?></td>
                                <td><a href="edit_user.php?id=<?php echo $row['id'] ?>" class="badge badge-primary">edit</a><a href="delete_user.php?id=<?php echo $row['id'] ?>" class="badge badge-danger">delete</a>
                                </td>
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