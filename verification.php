<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Input</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/verification.css" />
</head>

<body>
    <div class="container">
        <div class="inputfield">
            <input type="number" maxlength="1" class="input" disabled />
            <input type="number" maxlength="1" class="input" disabled />
            <input type="number" maxlength="1" class="input" disabled />
            <input type="number" maxlength="1" class="input" disabled />
        </div>
        <button class="hide" id="submit" onclick="validateOTP()">Submit</button>
    </div>
    <!-- Script -->
    <script src="js/verification.js"></script>
</body>

</html>