<?php 

    require "../config.php"; 


// This code will only run if the delete button is clicked
    if (isset($_GET["id"])) {
	    // this is called a try/catch statement 
        try {
            // define database connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set id variable
            $id = $_GET["id"];
            
            // Create the SQL 
            $sql = "DELETE FROM works WHERE id = :id";

            // Prepare the SQL
            $statement = $connection->prepare($sql);
            
            // bind the id to the PDO
            $statement->bindValue(':id', $id);
            
            // execute the statement
            $statement->execute();

            // Success message
            $success = "Work successfully deleted";

        } catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }
    };

	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM works";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

?>



<?php include "templates/header.php"; ?>

            <h2>Results</h2>
<?php if ($success) echo $success; ?>

            <?php // This is a loop, which will loop through each result in the array
                  foreach($result as $row) { 
            ?>

            <p>
                ID:
                <?php echo $row["id"]; ?><br> 

                Name:
                <?php echo $row['artistname']; ?><br> 

                Date:
                <?php echo $row['worktitle']; ?><br> 

                Weight:
                <?php echo $row['workdate']; ?><br> 

                Body Fat:
                <?php echo $row['worktype']; ?><br>
                
                <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
            </p>

<hr>
<?php }; //close the foreach
     

?>





<form method="post">
   <input type="submit" name="Submit" value="View all">
          
</form>
 
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">


<?php include "templates/footer.php"; ?>