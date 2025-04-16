<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Shop Econer</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #2c3e50;
            overflow: hidden;
        }

        li {
            float: right;
        }

        .logo {
            float: left;
            font-weight: bold;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 16px 20px;
            text-decoration: none;
        }

        li a:hover,
        li a.active {
            background-color: #1abc9c;
        }

        .container {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f9f9f9;
            transition: background-color 0.3s, border 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: #fff;
            border: 1px solid #1abc9c;
            outline: none;
        }

        .registerbtn {
            background-color: #1abc9c;
            color: white;
            padding: 14px;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .registerbtn:hover {
            background-color: #16a085;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .signin {
            text-align: center;
            padding: 20px;
            background-color: #ecf0f1;
            border-top: 1px solid #ccc;
            border-radius: 0 0 10px 10px;
        }

        a {
            color: #1abc9c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <ul>
        <li class="logo"><a href="#">Shop Econer</a></li>
        <li><a class="active" href="#">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About</a></li>
    </ul>

    <form action="/action_page.php">
        <div class="container">
            <h1>Create Account</h1>
            <p>Please fill in this form to register.</p>
            <hr>

            <label for="fullname">Full Name</label>
            <input type="text" placeholder="Enter your full name" name="fullname" id="fullname" required>

            <label for="email">Email</label>
            <input type="text" placeholder="Enter your email" name="email" id="email" required>

            <label for="phone">Phone</label>
            <input type="text" placeholder="Enter your phone number" name="phone" id="phone" required>

            <label for="psw">Password</label>
            <input type="password" placeholder="Enter password" name="psw" id="psw" required>

            <label for="psw-repeat">Repeat Password</label>
            <input type="password" placeholder="Repeat password" name="psw-repeat" id="psw-repeat" required>

            <hr>
            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

            <button type="submit" class="registerbtn">Register</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="#">Sign in</a>.</p>
        </div>
    </form>

</body>

</html>
