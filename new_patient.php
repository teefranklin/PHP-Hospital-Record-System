<?php 

include "includes/header.php"; 
if(isset($_POST["submit"])){
  
  //post variables
  $email  = $_POST["email"];
  $first_name = $_POST["firstname"];
  $last_name = $_POST["lastname"];
  $hospital = $_POST["hospital"];
  $blood_type = $_POST["blood_type"];
  $nkfirstname = $_POST["nkfirstname"];
  $nklastname = $_POST["nklastname"];
  $nkemail = $_POST["nkemail"];
  $nkaddress = $_POST["nkaddress"];
  $dob = $_POST["dob"];
  $address = $_POST["address"];
  $id_no = $_POST["id_no"];
  

	if(patient_exist($email)=="ok"){
      $error = "Patient already exist";
    }
    else{
      $create_patient = create_patient($id_no, $first_name, $last_name, $email, $dob, $blood_type, $address, $hospital, $nkfirstname, $nklastname , $nkemail, $nkaddress);
      
         if($create_patient =="ok"){
           $error = "Patient added Successifuly.";
         }
         else{
          $error = "".$create_patient;
         }
    }
}

?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add New Patient</h1>
          <div class="container">

		    <div class="card o-hidden border-0 shadow-lg my-5">
		      <div class="card-body p-0">
		        <!-- Nested Row within Card Body -->
		        <div class="row">
		          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
		          <div class="col-lg-12">
		            <div class="p-5">
		              <div class="text-center">
		              	Patient Details
		              </div>
		               <hr>
		              <form class="user" method="post" action="new_patient.php">
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="text" name = "firstname" class="form-control" id="exampleFirstName" required="required" placeholder="First Name">
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="text" name = "lastname" class="form-control" id="exampleLastName" required="required" placeholder="Last Name">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-sm-6">
		                   <input type="email"  name = "email" class="form-control" id="exampleInputEmail" required="required" placeholder="Email Address">
		                  </div>
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                     <select  class="form-control" name="blood_type">
								  <option value="A">A</option>
								  <option value="B">B</option>
								  <option value="AB">AB</option>
								  <option value="O">O</option>
							</select>
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
		                   <input type="text"  name = "id_no" class="form-control" id="" required="required" placeholder="ID Number">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="date" name = "dob" class="form-control" id="" required="required" placeholder="DOB">
		                  </div>
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <textarea class="form-control" name="address" placeholder="Patient address"></textarea>
		                  </div>		                 
		                </div>		               
		                <hr>
		                 <div class="text-center">
		              	Next Of Kin Details
		              </div>
		              <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="text" name = "nkfirstname" class="form-control" id="exampleFirstName" required="required" placeholder="Next of Kin First Name">
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="text" name = "nklastname" class="form-control" id="exampleLastName" required="required" placeholder="Next of Kin Last Name">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <div class="col-sm-6">
		                   <input type="email"  name = "nkemail" class="form-control" id="exampleInputEmail" required="required" placeholder="Next of Kin Email Address">
		                  </div>
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <textarea class="form-control" name="nkaddress" placeholder="Next of Kin address" >
		                 	</textarea>
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
		                  Add Patient
		                </button>
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