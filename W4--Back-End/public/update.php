<?php 

// this code will only execute after the submit button is clicked
	
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

            <h2>History</h2>

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
                
                <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>
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