<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbcon.php');


    if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
    {

        $name=$_POST['name'];
        $country=$_POST['country'];

        if(empty($name)){
            $errMSG = "�̸��� �Է��ϼ���.";
        }
        else if(empty($country)){
            $errMSG = "���� �Է��ϼ���.";
        }

        if(!isset($errMSG))
        {
            try{
                $stmt = $con->prepare('INSERT INTO person(name, country) VALUES(:name, :country)');
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':country', $country);

                if($stmt->execute())
                {
                    $successMSG = "���ο� ����ڸ� �߰��߽��ϴ�.";
                }
                else
                {
                    $errMSG = "����� �߰� ����";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage()); 
            }
        }

    }
?>

<html>
   <body>
        <?php 
        if (isset($errMSG)) echo $errMSG;
        if (isset($successMSG)) echo $successMSG;
        ?>
        
        <form action="<?php $_PHP_SELF ?>" method="POST">
            Name: <input type = "text" name = "name" />
            Country: <input type = "text" name = "country" />
            <input type = "submit" name = "submit" />
        </form>
   
   </body>
</html>