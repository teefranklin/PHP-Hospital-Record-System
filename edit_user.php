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
$email = $result[0]["email"];
$hospital = $result[0]["hospital"];

if(isset($_POST["submit"])){
  $password = $_POST["password2"];
  $email  = $_POST["email"];
  $first_name = $_POST["firstname"];
  $last_name = $_POST["lastname"];
  $hospital = $_POST["hospital"];
	   if($password!=""){
	   	$stmt = $db->prepare("update auth_user set  email=?, first_name=?, last_name=? hospital=?, password=? where id=$id");
        $stmt->execute(array($email, $first_name, $last_name, $hospital, $password));
        $counter = $stmt->rowCount();
        if ($counter > 0) {
            $error = "User was updated successfuly";
            $result["id"] = $db->lastInsertId();
        } else {
            $error  = "Failed to update the user";
        }
	   }
	   else{
	   		$stmt = $db->prepare("update auth_user set  email=?, first_name=?, last_name=?, hospital=? where id=$id");
	        $stmt->execute(array($email, $first_name, $last_name, $hospital));
	        $counter = $stmt->rowCount();
	        if ($counter > 0) {
	            $error = "User was  updated successfuly";
	            $result["id"] = $db->lastInsertId();
	        } else {
	            $error  = "Failed to update the user";
	        }
	   }
}

?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Edit User</h1>
           <div class="container">

		    <div class="card o-hidden border-0 shadow-lg my-5">
		      <div class="card-body p-0">
		        <!-- Nested Row within Card Body -->
		        <div class="row">
		          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
		          <div class="col-lg-12">
		            <div class="p-5">
		              <div class="text-center">
		              </div>
		              <form class="user" method="post">
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="text" name = "firstname" class="form-control" id="exampleFirstName" required="required" value=<?php echo $first_name;  ?>>
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="text" name = "lastname" class="form-control" id="exampleLastName" required="required" value=<?php echo $last_name;  ?>>
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                     <select  class="form-control" name="hospital">
								  <option value="Harare Hospital">Harare Hospital</option>
								  <option value="Parirenyatwa">Parirenyatwa</option>
								  <option value="Karanda">Karanda</option>
								  <option value="Chitungwiza Hospital">Chitungwiza Hospital</option>
							</select>
		                  </div>
		                  <div class="col-sm-6">
		                   <input type="email"  name = "email" class="form-control" id="exampleInputEmail" required="required" value=<?php echo $email;  ?>>
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="password"  name = "password1" class="form-control" id="exampleInputPassword" placeholder="New assword" >
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="password"  name = "password2" class="form-control" id="exampleRepeatPassword" placeholder="Confirm Password">
		                  </div>
		                </div>
		                <p>
		                <?php
		                  if (isset($error)) {
		                    echo " <center> <div class=''>". $error . "</div> </center>";               
		                    }
		                ?>
		                </p>
		                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
		                  Update User
		                </button>
		                <hr>
		              </form>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>

		  </div>
        </div>
        <!-- /.container-fluid -->
<?php 

include "includes/footer.php"; 

?>