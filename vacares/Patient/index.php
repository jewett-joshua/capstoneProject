<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Patients List</h3>
                  </div>
                  <er -->
                  <div class="bo!-- /.box-headx-body">
                    <table id="patients" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Rank</th>
                        <th>Branch</th>
                        <th>Component</th>
						            <th>Street</th>
                        <th>City</th>
                        <th>State</th>
						            <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Fist Name</th>
                        <th>Last Name</th>
                        <th>Rank</th>
                        <th>Branch</th>
                        <th>Component</th>
						            <th>Street</th>
                        <th>City</th>
                        <th>State</th>
						            <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>';
  include('../master.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    var url = "../api/patient/read.php";
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].Patient_Name_First+"</td>"+
                "<td>"+data[user].Patient_Name_Last+"</td>"+
                "<td>"+data[user].Rank+"</td>"+
                "<td>"+data[user].Branch+"</td>"+
                "<td>"+data[user].Component+"</td>"+
                "<td>"+data[user].Address_Street+"</td>"+
                "<td>"+data[user].Address_City+"</td>"+
                "<td>"+data[user].Address_State+"</td>"+
                "<td><a href='update.php?id="+data[user].Patient_Name_Last+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].Patient_Name_Last+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#patients"));
        }
    });
  });

  function Remove(Patient_Name_Last){
    var result = confirm("Are you sure you want to Delete the Patient Record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/patient/delete.php',
            dataType: 'json',
            data: {
                Patient_Name_Last: Patient_Name_Last
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed Patient!");
                    window.location.href = '/vacares/patient';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>