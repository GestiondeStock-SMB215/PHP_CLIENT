<html>
    <?php
session_start();
    include("../resources/lib.inc.php");
    error_reporting(7);
    $dbconn = dbconnect();
if(isset($_POST["role_name"]) && isset($_POST["role_desc"])){
		
		mysqli_query($dbconn,"INSERT INTO `role`(role_name, role_desc) 
		VALUES('".$_POST["role_name"]."','".$_POST["role_desc"]."');");
		//die("INSERT INTO `role`(role_name, role_desc) 
		//VALUES('".$_POST["role_name"]."' ,'".$_POST["role_desc"]."');");
	header("location:role.php");
}
        ?>
    <table cellpadding="5" cellspacing="0" border="1" id="t1">
			<tr style="background-color:#a0a0a0;">
				<th>NAME</th>                  
				<th>DESCRIPTION</th>
                         </tr>
                         <form action="role.php" method="post">
					<td><input type="text"  name="role_name" required tabindex="1" /></td>
                                        <td><input type="text"  name="role_desc" required tabindex="1" /></td>
                                        <td><input type="submit" value="Add"/></td>
                         </form>
                         
                         <?php
                         $dbconn = dbconnect();
				$query=mysqli_query($dbconn,"SELECT * FROM `role` order by role_name ASC");
				$i = 1;
				$count=0;
				while($row = mysqli_fetch_array($query)){
					if($i%2==0){
						echo "<tr style=\"background-color:#f0f0f0;\">";
					}
					else{
						echo "<tr>";
					}
					$i++;
					$count++;
					echo "<form method=\"post\" action=save.php?role_id=".$row['role_id'].">"
                                                . "<td><input type='text' name='role_name' value='".$row['role_name']."'/></td>";
                                        echo "<td><input type='text' name='role_desc' value='".$row['role_desc']."'/></td>";
					echo "<td><input type=\"submit\" value=\"Save\"/></form></td>";
					echo "<td><a href=\"delete.php?role_id=".$row[0]."\" onClick=\"return confirmDelete()\">Delete</a></td>";
					echo "</tr></form>";
				}
				
				mysqli_close($dbconn);
			?>
                        
    </table>
    <script type="text/JavaScript">
			function confirmDelete(){
				var agree = confirm("Are you sure you want to delete this item?");
				if(agree){
					 return true;
				}
				else{
					 return false ;
				}
			}
		</script>
</html>