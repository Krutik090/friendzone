<?php require "../config/config.php"; ?>
<?php

    class App{

        public $host = HOST;
        public $dbname = DBNAME;
        public $user = USER;
        public $pass = PASS;

        public $link;

        //create a contruct

        public function __construct(){

            $this->connect();
            
        }

        public function connect(){
            $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."",$this->user,$this->pass);

            if($this->link){
                echo "db Connection Succesfull";
            }
        }

        //Select All
        
        public function selectAll($query){
            $rows = $this->link->query($query);
            $rows -> execute();

            $allrows = $rows->fetchAll(PDO::FETCH_OBJ);

            if($allrows){
                return $allrows;
            }
            else{
                return false;
            }
        }

        //Select one row

        public function selectOne($query){

            $row = $this->link->query($query);
            $row -> execute();

            $singlerow = $row->fetch(PDO::FETCH_OBJ);

            if($singlerow){
                
                return $singlerow;
            
            } 
            else{
                return false;
            }
        }

         //Insert
        
         public function insert($query, $arr, $path){

            if($this->validate($arr) == "empty"){
                echo "<script> alert('one or more inputs are empty')</script>";
            }else{
                $insert_record = $this->link->prepare($query);
                $insert_record->execute($arr);

                header("location: ".$path."");
            }
         }

         //Update

         public function update($query,$arr,$path){
            if($this->validate($arr)=="empty"){
                echo "<script>alert('one or more inputs are empty')</script>";
            }
            else{
                $update_record = $this->link->prepare($query);
                $update_record->execute($arr);

                header("location:".$path."");

            }
         }

         //Delete
         public function delete($query,$path){

            $delete_records = $this->link->query($query);
            $delete_records->execute();

            header("location:".$path."");
         }

         public function validate($arr){
            if(in_array("",$arr)){
                echo "empty";
            }
         }

         //register User
         public function register($query,$arr,$path){

            if($this->validate($arr)=="empty"){
                echo "<script> alert('enter username or password ')</script>";
            }else{

                $register_user=$this->link->prepare($query);
                $register_user->execute();
                
                header("location:".$path."");

            }
         }

         //login user
         public function login($query,$data,$path){
            
            //email 
            $login_user = $this->link->query($query);
            $login_user->execute();

            $fetch = $login_user->fetch(PDO::FETCH_OBJ);

            if($login_user->rowCount()>0){
                
                //password identification
                if(password_verify($data['password'], $fetch['password'])){
                    //starts session vars

                    header("location".$path."");
                }
            }
         }

         //starting session

         public function startingSession(){

            session_start();
         }

         //validating session

         public function validateSession($path){

            if(isset($_SESSION['id'])){
                header("location:".$path."");
            }
         } 
    }

    $obj = new App;