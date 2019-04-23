<?php

if(isset($_POST['submit'])) {
    //what will happen if the user clicks submit
    
    //load config file
    require"../config.php";
    
    try {
        //try and connect to db
        $connection = new PDO($dsn, $username, $password,
        $options);
        
        //get the form contents and put in array
        $new_work = array (
            "artistname" => $_POST['artistname'],
            "worktitle" => $_POST['worktitle'],
            "workdate" => $_POST['workdate'],
            "worktype" => $_POST['worktype'],
            
        );
        
        //create SQL statement
        $sql = "INSERT INTO works (artistname, worktitle, workdate, worktype) VALUES (:artistname, :worktitle, :workdate, :worktype)";
        
        
        //now write to the DB
        $statement= $connection->prepare($sql);
        $statement->execute($new_work);
        
        
    } 
     catch(PDOException $error){
        //error here
        echo $sql. "<br>" . $error->getMessage();
    }
    
    
}


?>


<?php include "templates/header.php"; ?>

<h2>Input your weight here.</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>Work successfully added.</p>
<?php } ?>

<!--form to collect data for each artwork-->


<form method="post">
    
    <label for="artistname">Name</label>
    <input type="text" name="artistname" id="artistname">
           
    <label for="worktitle">Date</label>
    <input type="text" name="worktitle" id="worktitle">
           
    <label for="workdate">Weight</label>
    <input type="text" name="workdate" id="workdate">
           
    <label for="work type">Body Fat</label>
    <input type="text" name="worktype" id="worktype">
    
    <input type="submit" name="submit" value="Complete">


</form>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">


<?php include "templates/footer.php"; ?>