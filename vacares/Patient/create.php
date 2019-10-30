<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Patient</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleFirstName1">First Name</label>
                          <input type="text" class="form-control" id="Patient_Name_First" placeholder="First Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleLastName1">Last Name</label>
                          <input type="text" class="form-control" id="Patient_Name_Last" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputRank1">Rank</label>
                          <input type="text" class="form-control" id="Rank" placeholder="Ex: SGT">
                        </div>
						            <div class="form-group">
                          <label for="exampleInputBranch1">Branch</label>
                          <input type="text" class="form-control" id="Branch" placeholder="Ex: Army">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputComponent1">Component</label>
                          <div class="radio">
                                <label>
                                <input type="radio" name="Component" id="optionsRadios1" value="0" checked="">
                                Active
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="Component" id="optionsRadios2" value="1">
                                Reserve
                                </label>
                            </div>
							               <div class="radio">
								                <label>
                                <input type="radio" name="Component" id="optionsRadios3" value="2">
                                National Gaurd
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputStreet1">Street Address</label>
                          <input type="text" class="form-control" id="Address_Street" placeholder="Ex: 1234 Baker St. N">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputCity1">City</label>
                          <input type="text" class="form-control" id="Address_City" placeholder="Ex: Minneapolis">
                        </div>
						<div class="form-group">
                          <label for="exampleInputState1">State</label>
                          <input type="text" class="form-control" id="Address_State" placeholder="Ex: MN">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddPatient()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
              
  include('../master.php');
?>
<script>
  function AddPatient(){
        $.ajax(
        {
            type: "POST",
            url: '../api/patient/create.php',
            dataType: 'json',
            data: {
                Patient_Name_First: $("#Patient_Name_First").val(),
                Patient_Name_Last: $("#Patient_Name_Last").val(),        
                Rank: $("#Rank").val(),
                Branch: $("#Branch").val(),        
                Component: $("input[name='Component']:checked").val(),
                Address_Street: $("#Address_Street").val(),
                Address_City: $("#Address_City").val(),
                Address_State: $("#Address_State").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Patient!");
                    window.location.href = '/vacares/patient';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>