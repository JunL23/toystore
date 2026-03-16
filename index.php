<?php 

    /* TO-DO: Include header.php
              Hint: header.php is inside the includes folder and already connects to the database
    */

	include 'includes/header.php';

    /*
	 * Retrieve toy information from the database based on the toy ID.
	 * 
	 * @param PDO $pdo       An instance of the PDO class.
	 * @param string $id     The ID of the toy to retrieve.
	 * @return array|null    An associative array containing the toy information, or null if no toy is found.
	 */
	function get_toy(PDO $pdo) {
		                                                    // SQL query to retrieve toy information based on the toy ID
		$sql = "SELECT * 
			FROM toy;";	                        // :id is a placeholder for value provided later 
		                                                    // It's a parameterized query that helps prevent SQL injection attacks and ensures safer interaction with the database

		                                                    // Execute the SQL query using the pdo function and fetch the result
		$toy = pdo($pdo, $sql)->fetchAll();		// Associative array where 'id' is the key and $id is the value. Used to bind the value of $id to the placeholder :id in SQL query.

		return $toy;                                        // Return the toy information (associative array)
	}

	$toy1 = get_toy($pdo);                          // Retrieve info about toy with ID '0001' from the database using provided PDO connection

?>


<section class="toy-catalog">


    <!-- TOY CARD START -->
    <div class="toy-card">
  	    <!-- TO-DO: Create a hyperlink to toy.php and pass the toy number as a URL parameter
                    Hint: Access the value from the $toy1 array (what is the column name in the database?) -->
  	    <a href="toy.php?toynum=<?= $toy1[0]['toyID'] ?>">

  		    <!-- TO-DO: Display the toy image and update the alt text to the toy name
                        Hint: Access the values from the $toy1 array (what are the column names in the database?) -->
  			<img src="<?= $toy1[0]['img_src'] ?>" alt="<?= $toy1[0]['name'] ?>">
  		</a>

  		<!-- TO-DO: Display the name of the toy
                    Hint: Access the value from the $toy1 array (what is the column name in the database?) -->
  		<h2><?= $toy1[0]['name'] ?></h2>

  		<!-- TO-DO: Display price of toy 
                    Hint: Access the value from the $toy1 array (what is the column name in the database?) -->
  		<p>$<?= $toy1[0]['price'] ?></p>
  	</div>
    <!-- TOY CARD END -->


    <!-- TO-DO: Display the rest of the toys in the database

                Hint 1: You could copy/paste the toy-card block for each toy, but this would be repetitive.

                Hint 2: Instead, how could you modify the get_toy() function so it returns ALL toys
                        from the database instead of just one?

                Hint 3: Once you have an array of toys, how could you use a PHP loop to display
                        each toy inside a toy-card?
    -->
	<?php for($i = 1; $i < count($toy1); $i++){ ?>

		<div class="toy-card">
			<a href="toy.php?toynum=<?= $toy1[$i]['toyID'] ?>">
				<img src="<?= $toy1[$i]['img_src'] ?>" alt="<?= $toy1[$i]['description'] ?>">
			</a>

			<h2><?= $toy1[$i]['name'] ?></h2>

			<p>$<?= $toy1[$i]['price'] ?></p>
		</div>

	<?php } ?>


</section>

<?php include 'includes/footer.php'; ?>