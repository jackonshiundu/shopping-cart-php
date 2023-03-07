<?php
 
class CreatedDb 
{
    public $dbname;
    public $tablename;
    public $servername;
    public $username;
    public $password;
    public $connection;
    //class constructor

    public function __construct(
        $dbname='',
        $tablename='',
        $servername='localhost',
        $username='root',
        $password=''
        ){
            $this->dbname=$dbname;
            $this->tablename=$tablename;
            $this->servername=$servername;
            $this->username=$username;
            $this->password=$password;
            
            //create connetcions

            $this->connection=mysqli_connect($servername,$username,$password);

            //check connections
            if(!$this->connection){
                die('Connection failed:'.mysql_connect_error());
            }

            //query
            $sql="CREATE DATABASE IF NOT EXISTS $dbname";

            //EXECUTE QUERY
            if(mysqli_query($this->connection,$sql)){  
                $this->connection=mysqli_connect($servername,$username,$password,$dbname);

                //sql create new table
                $sql="CREATE TABLE IF NOT EXISTS $tablename 
                (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(25) NOT NULL,
                product_price FLOAT,
                product_image VARCHAR(100)
                );";

                if(!mysqli_query($this->connection,$sql)){
                    echo "Error creating table:". mysqli_error($this->connection);
                }

            }else{
                return false;
            }
        }
        //get products from the database
        public function getData(){
            $sql="SELECT * FROM $this->tablename";
            $result=mysqli_query($this->connection,$sql);
            if(mysqli_num_rows($result)>0){
                return $result;
            }

        }
    
}
?>