<?php 

include "includes/header.php"; 
if(isset($_POST["submit"])){
  
  //post variables
  $password = $_POST["password1"];
  $email  = $_POST["email"];
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  $first_name = $_POST["firstname"];
  $last_name = $_POST["lastname"];
  $hospital = $_POST["hospital"];
  
  //varibles to validate the password
  $uppercase = preg_match('@[A-Z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  
  //Check the strength of the password
  if(!$uppercase || !$number || strlen($password) < 8) {
    $error = 'Password should be at least 8 characters in length and should include at least one upper case letter and one number';
  }else{
    //Strong password.';
	if(email_exist($email)=="ok"){
      $error = "The email is already registered with another user";
    }
    else{
      if($password1 == $password2){ //password confirmation
      $password = $password1;
      $create_user = create_user($email,$password,$first_name,$last_name,$hospital);
      
         if($create_user =="ok"){
           $error = "User created Successifuly.";
         }
         else{
          $error = "".$create_user;
         }
      } 
      else{
          $error = "Passwords do not match.";
      }
    }
  }
}

?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add New System User</h1>
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
		              <form class="user" method="post" action="new_user.php">
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="text" name = "firstname" class="form-control" id="exampleFirstName" required="required" placeholder="First Name">
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="text" name = "lastname" class="form-control" id="exampleLastName" required="required" placeholder="Last Name">
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
		                   <input type="email"  name = "email" class="form-control" id="exampleInputEmail" required="required" placeholder="Email Address">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="password"  name = "password1" class="form-control" id="exampleInputPassword" required="required" placeholder="Password">
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="password"  name = "password2" class="form-control" id="exampleRepeatPassword" required="required" placeholder="Repeat Password">
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
		                  Add User
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