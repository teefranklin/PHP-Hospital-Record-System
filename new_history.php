<?php 

include "includes/header.php"; 
if(isset($_POST["submit"])){
  
  //post variables
  $id_no  = $_POST["id_no"];
  $doctor = $_POST["doctor"];
  $description = $_POST["description"];
 

      $create_record = create_record($id_no, $description, $doctor);
      
         if($create_record =="ok"){
           $error = "Record added Successifuly.";
         }
         else{
          $error = "".$create_record;
         }
}


?>
		<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add New Medical Record</h1>
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
		              <form class="user" method="post" action="new_history.php">
		                <div class="form-group row">
		                  <div class="col-sm-6 mb-3 mb-sm-0">
		                    <input type="text" name = "id_no" class="form-control" id="" required="required" placeholder="Patient ID No">
		                  </div>
		                  <div class="col-sm-6">
		                    <input type="text" name = "doctor" class="form-control" id="e" required="required" placeholder="Doctor">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <textarea class="form-control" name="description" placeholder="Illness Description"></textarea>
		                </div>
		                <p>
		                <?php
		                  if (isset($error)) {
		                    echo " <center> <div class=''>". $error . "</div> </center>";               
		                    }
		                ?>
		                </p>
		                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
		                  Add Record
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