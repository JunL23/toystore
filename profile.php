<?php

    /* TO-DO: Include header.php
            Hint: header.php is inside the includes folder and already connects to the database
    */

    include 'includes/header.php';


            
	require_login($logged_in);                              // Redirect user if not logged in
	$username = $_SESSION['username'];                      // Retrieve the username from the session data
    $custID   = $_SESSION['custID'];                        // Retrieve the custID from the session data



    /* TO-DO: Create a function that retrieves ALL order information for the logged-in user 

              Your function should:
                1. Query the appropriate tables to retrieve:
                    - order information
                    - toy name
                    - toy image
                    Make sure to sort the results in descending order (most recent first)
                2. Execute the SQL query using the pdo() helper function and fetch the results
                3. Return orders for the logged-in user only
	*/

    function order_query(PDO $pdo, string $custID) {
        $sql = "SELECT o.orderID, t.name, t.img_src, o.quantity, o.date_ordered, o.deliv_addr, o.date_deliv
                FROM orders as o
                JOIN toy as t
                ON t.toyID = o.toyID
                JOIN customer as c
                ON c.custID = o.custID
                WHERE c.custID = :custID";
            
        $orders = pdo($pdo, $sql, ['custID' => $custID])->fetchAll();

        return $orders;
    }

    /* TO-DO: Call function to retrieve orders for the logged-in user */

    $order = order_query($pdo, $custID);
	
?>

<main class="container profile-page">

    <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>

    <!-- TO-DO: Check if no orders were returned from the database -->
    <?php if(count($order) == 0) { ?>
        <div class="no-orders">
            <p>You have no orders yet.</p>
        </div>

    <!-- TO-DO: Otherwise (order data was returned) -->
    <?php } else {?>
        <div class="orders-container">

            <!-- TO-DO: Loop through each order returned from the database -->
            <?php for($i = 0; $i < count($order); $i++){ ?>

                <div class="order-card">

                    <!-- TO-DO: Display the toy image and update the alt text to the toy name -->
                    <img src="<?= $order[$i]['img_src'] ?>" alt="<?= $order[$i]['name'] ?>">

                    <div class="order-info">

                        <!-- TO-DO: Display the order number -->
                        <p><strong>Order Number:</strong> <?= $order[$i]['orderID'] ?></p>

                        <!-- TO-DO: Display the toy name -->
                        <p><strong>Toy:</strong> <?= $order[$i]['name'] ?></p>

                        <!-- TO-DO: Display the order quantity -->
                        <p><strong>Quantity:</strong> <?= $order[$i]['quantity'] ?></p>

                        <!-- TO-DO: Display the date ordered -->
                        <p><strong>Date Ordered:</strong> <?= $order[$i]['date_ordered'] ?></p>

                        <!-- TO-DO: Display the delivery address -->
                        <p><strong>Delivery Address:</strong> <?= $order[$i]['deliv_addr'] ?></p>

                        <!-- TO-DO: Display the delivery date
                                    Hint: If the delivery date is NULL, use the null-coalescing operator to display a placeholder message like "Pending"
                         -->
                        <p><strong>Delivery Date:</strong> <?= $order[$i]['date_deliv'] ?? "Pending" ?></p>
                    </div>
                </div>

            <?php } ?>
        </div>
    <?php } ?>

</main>

<?php include 'includes/footer.php'; ?>