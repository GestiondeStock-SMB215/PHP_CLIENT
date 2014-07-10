<html>
    <?php
    session_start();
    $dbconn = dbconnect();
     error_reporting(7);
    if (isset($_POST['user_name']) && ($_POST['user_name']!="") && 
        isset($_POST['user_username']) && ($_POST['user_username']!="") && 
        isset($_POST['user_password']) && ($_POST['user_password']!="") && 
        isset($_POST['user_email']) && ($_POST['user_email']!="")){
        
    
    $user_name=$_POST['user_name'];
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
    $user_password = md5($user_password);
    $user_email=$_POST['user_email'];
    $user_status=$_POST['user_status'];
    $user_id=$_POST['user_id'];
    
    mysqli_query($dbconn,"INSERT INTO user(user_name, user_username, user_password, user_email)VALUES('".
            mysqli_real_escape_string($user_name)."', '"
            . mysqli_real_escape_string($user_username)."', '"
            . mysqli_real_escape_string($user_password)."', '"
            . mysqli_real_escape_string($user_email)."')");
    
    mysqli_close($link);
        }
        echo ('ERROR');
    ?>
       
    <form name="reg" action="register.php" onsubmit="return validateForm()" method="post">
<table width="274" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td><div align="right">Name:</div></td>
      <td><input type="text" name="user_name" value="<?= $user_name?>"/></td>
    </tr>
    <tr>
      <td><div align="right">Username:</div></td>
      <td><input type="text" name="user_username" value="<?= $user_username?>" /></td>
    </tr>
    <tr>
      <td><div align="right">Password:</div></td>
      <td><input type="text" name="password" /></td>
    </tr>
    <tr>
      <td><div align="right">Email:</div></td>
      <td><input type="text" name="user_email" value="<?=$user_email?>" /></td>
    </tr>
    <tr>
      <td><div align="right"></div></td>
      <td><input name="submit" type="submit" value="Submit" /></td>
    </tr>
 </table>
    </form>
         <script type="text/javascript">
            function validateForm(){
            var name=document.forms["reg"]["user_name"].value;
            var username=document.forms["reg"]["user_username"].value;
            var password=document.forms["reg"]["user_password"].value;
            var email=document.forms["reg"]["user_email"].value;
           
            if ((name==null || name=="") && (username==null || username=="") && (password==null || password=="") && (email==null || email==""))
              {
              alert("All Field must be filled out");
              return false;
              }
            if (name==null || name=="")
              {
              alert("First name must be filled out");
              return false;
              }
            if (username==null || username=="")
              {
              alert("Last name must be filled out");
              return false;
              }
            if (password==null || password=="")
              {
              alert("Gender name must be filled out");
              return false;
              }
            if (email==null || email=="")
              {
              alert("address must be filled out");
              return false;
              }
            
            }
          </script>    

    
        
</html>
