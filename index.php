<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATION USING AJAX</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">


</head>

<body>



<!-- Modal -->
<form>
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div class="form-group">
    <label for="completename">Name:</label>
    <input type="text" class="form-control" id="completename"  placeholder="Enter your name">
    </div>

    <div class="form-group">
    <label for="completemail">Email:</label>
    <input type="email" class="form-control" id="completemail"  placeholder="Enter your email">
    </div>

    <div class="form-group">
    <label for="completemobile">Mobile:</label>
    <input type="number" class="form-control" id="completemobile"  placeholder="Enter your number">
    </div>

    <div class="form-group">
    <label for="completeplace">Place:</label>
    <input type="text" class="form-control" id="completeplace"  placeholder="Enter your place">
    </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark" onclick="adduser()">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>

<!-- update modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div class="form-group">
    <label for="upadtename">Name:</label>
    <input type="text" class="form-control" id="updatename"  placeholder="Enter your name">
    </div>

    <div class="form-group">
    <label for="updateemail">Email:</label>
    <input type="email" class="form-control" id="updateemail"  placeholder="Enter your email">
    </div>

    <div class="form-group">
    <label for="updatemobile">Mobile:</label>
    <input type="number" class="form-control" id="updatemobile"  placeholder="Enter your number">
    </div>

    <div class="form-group">
    <label for="updateplace">Place:</label>
    <input type="text" class="form-control" id="updateplace"  placeholder="Enter your place">
    </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark" onclick="updateDetails()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>


</form>
<div class="container my-3">
    <h1 class="text-center">PHP CRUD OPERATION USING AJAX</h1>
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#completeModal">
  Add New Users
</button>

<div id="displayDataTable"></div>
</div>

<!-- Bootstrap Javascript  -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).ready(function(){
        displayData();
    })

function onload() {
    $.ajax({
      url:"insert.php",
      type:'GET',
      success:function (data, status){
        //function to display data
        console.log(data);  //or we can put data
        displayData();
      }
});
}
onload();


// display fnction
function displayData(){
  var displayData="true";
  $.ajax({
    url:'display.php',
    type:'POST',
    data:{
      displaySend:displayData
    },
    success:function(data,status){
        $('#displayDataTable').html(data);
    }
  });
    }

  function adduser(){
    var nameAdd = $('#completename').val();
    // alert(emailAdd);
    var emailAdd = $('#completemail').val();
    // alert(emailAdd);
    var mobileAdd = $('#completemobile').val();
    // alert(mobileAdd);
    var placeAdd = $('#completeplace').val();

    //ajax function

    $.ajax({
      url:"insert.php",
      type:'POST',
      data:{
        nameSend:nameAdd,
        emailSend:emailAdd,
        mobileSend:mobileAdd,
        placeSend:placeAdd
      },
      success:function (data,status){
        //function to display data
        console.log(data);  //or we can put data
        displayData();
      }
    });

    $.ajax({
      url:"insert.php",
      type:'GET',
      success:function (data, status){
        //function to display data
        console.log(data);  //or we can put data
        $('#completeModal').modal('hide');
        displayData();
      }
    });
    
  
  }

  //delete function
  function Deleteuser(deleteid){
    $.ajax({
        url:"delete.php",
        type:'post',
        data:{
            deletesend:deleteid
        },
        success:function(data,status){
            displayData();
        }
    });
  }

  //update function 
  function GetDetails(updateid){
    $('#hiddendata').val(updateid);

    $.post("update.php",{update:updateid},function(data,status){
        var userid=JSON.parse(data);
        $('#updatename').val(userid.name);
        $('#updateemail').val(userid.email);
        $('#updatemobile').val(userid.mobile);
        $('#updateplace').val(userid.place);
    })
    $('#updateModal').modal("show");
  }

//onclick event function
  function updateDetails(){
    var updatename=$('#updatename').val();
    var updateemail=$('#updateemail').val();
    var updatemobile=$('#updatemobile').val();
    var updateplace=$('#updateplace').val();

    var hiddendata=$('#hiddendata').val();

    $.post ("update.php",{
        updatename:updatename,
        updateemail:updateemail,
        updatephone:updatephone,
        updateplace:upadteplace,
        hiddendata:hiddendata
    }, function(data,status){
        $('#updateModal').modal('hide');
        displayData();
    });
  }

  
</script>

</body>
</html>