<?php 
include "includes/header.php"; 
$id = $_GET['id'];

$query ="SELECT * FROM auth_user where id=$id";
$statement = $db->prepare($query);
$statement->execute();
$count= $statement -> rowCount();
$result = $statement->fetchAll();
$first_name = $result[0]["first_name"];
$last_name = $result[0]["last_name"];

$full_name = $first_name." ".$last_name;

if(isset($_POST['delete'])){
	if($count>0){
    $query ="DELETE FROM auth_user where id=$id";
    $statement = $db->prepare($query);
    $statement->execute();
    if($statement){
        //header('Location:user.php');
      die('User deleted successfuly !');
    }
	}else{
	    die('user not found !');
	}
}
else if(isset($_POST['cancel'])){
		//header('Location:user.php');
  die('Canceled !');
}
?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Delete User</h1>
          <div class="container">
          	 <div class="col-lg-8">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Are you sure you want to delete user <?php echo $full_name; ?></h6>
                </div>
                <div class="card-body">
                  <form method="post">
                  	<div class="row">
                  		<div class="col-lg-6">
		                  	<button type="submit" name="delete" class="btn btn-danger btn-icon-split">
		                    <span class="icon text-white-50">
		                      <i class="fas fa-trash"></i>
		                    </span>
		                    <span class="text">Delete</span>
		                  </button>
		                  </div>
		                  <div class="col-lg-6">
		                  	 <button type="submit" name="cancel" href="user.php" class="btn btn-primary btn-icon-split">
		                    <span class="icon text-white-50">
		                      <i class="fas fa-arrow-left"></i>
		                    </span>
		                    <span class="text">Cancel</span>
		                  </button>
		                  </div>
                  	</div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
<?php 

 include "includes/footer.php"; 

?> 