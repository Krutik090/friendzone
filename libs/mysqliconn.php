
<?php
require "../config/config.php";
class App{

    public $host = HOST;
    public $dbname = DBNAME;
    public $user = USER;
    public $pass = PASS;

    public $con;

    public function __construct(){
        $this->connect();
    
    }

    public function connect(){
        $this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->dbname) or die("Not connected");
        
    }

    public function insert($query){
        mysqli_multi_query($this->con,$query) or die("Not Inserted");
    }

    public function update($query){
        mysqli_query($this->con,$query) or die("Not Updated");
    }

    public function delete($query){
        mysqli_query($this->con,$query) or die("Not Deleted");
    }

    public function select($query){
        $rec = mysqli_query($this->con,$query);?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
            </head>
            <body>
                <table border="1">
                <thead>
                        <tr>
                            <td>USERNAME</td>
                            <td>PASSWORD</td>
                            <td>EMAIL</td>
                        </tr>
                    </thead>
                    <?php
        if(mysqli_num_rows($rec)>0){
            while($row = mysqli_fetch_assoc($rec)){ 
            
                    echo "<tr>";
                      echo "<td>". $row['uname']." </td>";
                      echo "<td>". $row['upass']." </td>";
                      echo "<td>". $row['uemail']." </td>";     
                    echo "</tr>";
            }
                    ?>
                </table>
                
            </body>
            </html>
               
                <?php
            
        }
    }

    public function validate($query){
        $rec = mysqli_query($this->con,$query);
        return $rec;

    }
    public function login()
    {
        if(isset($_POST['txtuname'] ) && isset($_POST['txtupass'])){
            $uname=$_POST['txtuname'];
            $upass = $_POST['txtupass'];
            $res = $this->validate("SELECT * FROM TBL_USER WHERE uname='$uname' and upass ='$upass'");
          
            
               if(mysqli_num_rows($res)==1){
                
                echo "login sucsesfull";
               } 
               else{
                
                header("location:login.php");
               } 
            }
    
}
/*
$q = "INSERT INTO TBL_USER VALUES('KRUTIK','1234','KRUTIK@GMAIL.COM');";
$q .= "INSERT INTO TBL_USER VALUES('HET','HETYU','HET@GMAIL.COM');";
$q .= "INSERT INTO TBL_USER VALUES('DEEP','DEEPLO','DEEP@GMAIL.COM');";
*/
//$OBJ->insert($q);
//$OBJ->update("UPDATE TBL_USER SET UNAME='BHAVIK' WHERE UNAME = 'KRUTIK'");
//$OBJ->select("SELECT * FROM TBL_USER;");

}



