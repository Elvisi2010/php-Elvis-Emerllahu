<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Ticket.al</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .landing-container {
            max-width: 700px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 50px;
        }

        .landing-container h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .landing-container p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .cta-buttons a {
            text-decoration: none;
        }

        .cta-buttons button {
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            background-color: #2980b9;
            color: white;
            transition: background-color 0.3s;
        }

        .cta-buttons button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>

<div class="landing-container">
    <h1>Welcome to Ticket.al 🎫</h1>
    <p>Your one-stop destination to book tickets for concerts, movies, and football matches.</p>

    <div class="cta-buttons">
        <a href="login.php"><button>Login</button></a>
        <a href="signup.php"><button>Sign Up</button></a>
    </div>
</div>

</body>
</html>
