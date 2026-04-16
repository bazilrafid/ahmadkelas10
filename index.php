<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techfix Servis</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 94%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 8px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #333;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Techfix Servis</h2>

    <form method="POST" action="action_login.php">
        Username:
        <input type="text" name="username" required>

        Password:
        <input type="password" name="password" required>

        <button>Login</button>
    </form>
</div>

</body>
</html>