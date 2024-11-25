<?php
// Include Composer's autoload file
require 'vendor/autoload.php'; // Adjust path if necessary

use Razorpay\Api\Api;

// Razorpay credentials
$keyId = 'YOUR_RAZORPAY_KEY_ID';
$keySecret = 'YOUR_RAZORPAY_KEY_SECRET';

// Handle order creation request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $api = new Api($keyId, $keySecret);

    // Collect payment data
    $amount = intval($_POST['amount']); // Amount in paisa (e.g., ₹500 = 50000)
    $currency = 'INR';
    $receipt = 'rcpt_' . time(); // Unique receipt ID

    try {
        // Create Razorpay order
        $order = $api->order->create([
            'receipt' => $receipt,
            'amount' => $amount,
            'currency' => $currency,
            'payment_capture' => 1, // Auto-capture payment
        ]);

        // Return order details
        echo json_encode([
            'success' => true,
            'orderId' => $order['id'],
            'keyId' => $keyId,
            'amount' => $amount,
            'currency' => $currency,
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment Integration</title>
    <!-- Razorpay Library -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Razorpay Payment Integration</h1>
    <div>
        <p>Total Amount: ₹500</p>
        <button id="proceedToPayButton">Proceed to Pay</button>
    </div>

    <script>
        document.getElementById("proceedToPayButton").onclick = async function () {
            const amount = 50000; // Amount in paisa (e.g., ₹500 = 50000)

            // Create Razorpay order using server-side PHP
            const response = await fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `amount=${amount}`,
            });

            const data = await response.json();

            if (!data.success) {
                console.error("Order creation failed:", data.error);
                alert("Failed to create payment order. Please try again.");
                return;
            }

            // Initialize Razorpay
            const razorpayOptions = {
                key: data.keyId,
                amount: data.amount,
                currency: data.currency,
                name: "Your Company Name",
                description: "Test Payment",
                order_id: data.orderId, // Order ID from the server
                handler: function (response) {
                    alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
                    console.log("Payment Response:", response);
                },
                prefill: {
                    name: "Customer Name",
                    email: "customer@example.com",
                    contact: "9876543210",
                },
                theme: {
                    color: "#3399cc",
                },
            };

            const rzp = new Razorpay(razorpayOptions);
            rzp.open();
        };
    </script>
</body>
</html>
