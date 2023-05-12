<?php
// Connect to Databse
$insert=FALSE;
$update=FALSE;
$delete=FALSE;

$servername="localhost:3307";
$username="root";
$password="";
$database="inotes";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("The Database is not connected due to thi error-->".mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `sno`=$sno";
  $result=mysqli_query($conn,$sql);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset( $_POST['snoEdit'])){
  $sno= $_POST['snoEdit'];
  $title= $_POST['titleEdit'];
  $description= $_POST['descriptionEdit'];
 // update
 $sql="UPDATE `notes` SET `title`='$title' , `description`='$description' WHERE `notes`.`sno`='$sno'";
 $result=mysqli_query($conn,$sql);
 if($result){
  $update=true;
}
else{
  echo "Data was not updated successfully! due to this error ".mysqli_error($conn);
}
}
else{
  $title= $_POST['title'];
  $description= $_POST['description'];
  
  // insertion
  $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
  $result=mysqli_query($conn,$sql);
  if($result){
    $insert=TRUE;
  }
  else{
    echo "The record has not inserted because of this error ".mysqli_error($conn);
  }
 }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function() {
      $('#myTable').DataTable();
    });
    </script>

<title>iNotes--Making easy</title>
</head>
  <body>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="/index.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="title" class="form-label">Note</label>
              <input type="text" name="titleEdit" class="form-control" id="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
         
      </div>
      <div class="modal-footer mr-auto d-block">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="/PHP-logo.svg.png" height="40px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has Inserted successfully
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      
      ?>
       <?php
      if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has Updated successfully
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      
      ?>
       <?php
      if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has Deleted successfully
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
      }
      ?>

      <div class="container my-4">
        <h2>Add a Note to iNotes</h2>
        <form action="/index.php" method="POST">
            <div class="mb-3">
              <label for="title" class="form-label">Note</label>
              <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>

      <div class="container my-4">
      <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">sno</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql="SELECT * FROM `notes`";
    $result=mysqli_query($conn,$sql);
    $sno=1;
    while($rows=mysqli_fetch_assoc($result)){
      echo "<tr>
      <th scope='row'>".$sno. "</th>
      <td>". $rows['title']."</td>
      <td>". $rows['description']. "</td>
      <td><button class='edit btn btn-sm btn-primary' id=".$rows['sno'].">Edit</button>  <button class='delete btn btn-sm btn-primary' id=d".$rows['sno'].">Delete</button> </td>
    </tr>";
    $sno+=1;
    }
  ?>
  </tbody>
</table>
</div>
<hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></scrip>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>

    <script>
      edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit",);
          tr=e.target.parentNode.parentNode;
          title=tr.getElementsByTagName("td")[0].innerText;
          description=tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description);
          titleEdit.value=title;
          descriptionEdit.value=description;
          snoEdit.value=e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })

      deletes=document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit",);
          sno=e.target.id.substr(1,);
          if(confirm("Are you sure?")){
            console.log("Yes");
            window.location=`/index.php?delete=${sno}`;
          }
          else{
            console.log("No")
          }
        })
      })
    </script>
  </body>
</html>
