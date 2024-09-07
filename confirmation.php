<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reservation Confirmation</title>
   <!-- Add your CSS styles here -->
   <style>
      /* Your CSS styles */
   </style>
</head>
<body>

<div class="container">
   <h1>Reservation Confirmation</h1>
   <?php
   // Retrieve reservation details from URL query parameters
   $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
   $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
   $phone = isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '';
   $date = isset($_GET['date']) ? htmlspecialchars($_GET['date']) : '';
   $time_from = isset($_GET['time_from']) ? htmlspecialchars($_GET['time_from']) : '';
   $time_to = isset($_GET['time_to']) ? htmlspecialchars($_GET['time_to']) : '';
   $guests = isset($_GET['guests']) ? htmlspecialchars($_GET['guests']) : '';
   ?>
   <p><strong>Name:</strong> <?php echo $name; ?></p>
   <p><strong>Email:</strong> <?php echo $email; ?></p>
   <p><strong>Phone:</strong> <?php echo $phone; ?></p>
   <p><strong>Date:</strong> <?php echo $date; ?></p>
   <p><strong>Time From:</strong> <?php echo $time_from; ?></p>
   <p><strong>Time To:</strong> <?php echo $time_to; ?></p>
   <p><strong>Number of Guests:</strong> <?php echo $guests; ?></p>
   <p>Thank you for your reservation! To confirm your reservation, please proceed with the payment.</p>
   <!-- Payment form -->
   <form action="" method="post">
      <label for="card_number">Card Number:</label>
      <input type="text" id="card_number" name="card_number" required>
      <label for="card_exp">Expiration Date:</label>
      <input type="text" id="card_exp" name="card_exp" placeholder="MM/YYYY" required>
      <label for="card_cvv">CVV:</label>
      <input type="text" id="card_cvv" name="card_cvv" maxlength="3" required>
      <input type="submit" name="pay_now" value="Pay Now">
   </form>
</div>

</body>
</html>
