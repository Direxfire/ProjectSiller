<!DOCTYPE html>

<?php
// define variables and set to empty values
$firstname = $lastname = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = test_input($_POST["first_name"]);
  $email = test_input($_POST["email"]);
  $lastname = test_input($_POST["last_name"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form action="savedata.php" method="post">
   First Name: <input type="text" name="first_name">
  <br><br>
  Last Name: <input type="text" name="last_name">
  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
<!---   Website: <input type="text" name="website">
  <br><br>
 Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <br><br>-->
  <input type="submit" name="submit" value="Submit">
</form>

<?php
if(isset($_POST['submit'])){
    $autoline=$_POST['autoline'];
}
?>
