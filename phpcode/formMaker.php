<?php 
session_start();
    if (isset($_POST['numQ'])){
        $numbOfQ = $_POST['numbOfQ'];
        $category = $_POST['age'];
        $Hcode = $_POST['Hcode'];
        if ($Hcode !== $_SESSION['Hcode']){
            $error = "Unique code did not match";
            header("Location: /hospital/template/formCreate.html?msg=$error");
            exit();
        }
        else{
            for ($i=0; $i <= $numbOfQ; $i++){
                echo '<form action="./formMaker.php" method="POST" style="display:none;" id="Qbank">
                <label for="question">Question '.($i+1).' : </label>
                <input type="text" name="question" id="question" placeholder="Question...">
                <button type="submit" name="Q">ADD</button>
                </form>';
            }  
        }
    }
    if(isset($_POST['Q'])){
        $question = $_POST['question'];
        $sql = "INSERT INTO healthf (age,question,Hcode) VALUES (?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            $error = "failed to update data";
            header("Location: /hospital/template/formCreate.html?msg=$error");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sss", $age,$question,$Hcode);
            mysqli_stmt_execute($stmt);
            $error = "Done..Next please...";
            header("Location: /hospital/template/formCreate.html?msg=$error");
            exit();
        }
    }
    else{
        echo "error";
    }
    ?>