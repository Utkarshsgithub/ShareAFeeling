<?php 

    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password);

    if(!$con){
        die("Connection to the database failed". mysqli_connect_error());
    }

    $email_error = NULL;

    $fetch_query = "SELECT * FROM `saf`.`datasaf`";
    $result = mysqli_query($con, $fetch_query);

    $num = mysqli_num_rows($result);

    if(isset($_POST['email'])) {

        $email = $_POST['email'];
        $number = $_POST['number'];
        $message = $_POST['message'];

        $email_query = "SELECT * FROM `saf`.`datasaf` WHERE email='$email' ";
        $email_query_run = mysqli_query($con, $email_query);

        if (mysqli_num_rows($email_query_run) > 0) {
            $email_error = "Email Already Exists!";
        } else {
            $sql = "INSERT INTO `saf`.`datasaf` (`email`, `number`, `message`) VALUES ('$email', '$number', '$message')";
            // echo $sql;

            if ($con->query($sql) === true){
                // echo "Successfully Inserted";
                $insert = true;
            } else {
                echo $con->error;
            };

            $con->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ff40ef3d82.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="master.css">
    <title>Test Website ~ Utkarsh</title>
    <style>
        ::selection {
            color: var(--secondary-color);
            background: rgb(255, 255, 255, 0.6);
        }

        i {
            margin: 5px
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 1000px;
            background-color: var(--secondary-color);
            color: #fff;
        }

        #hero {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            margin: 50px;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
            border-radius: 2px;
        }

        #hero h1 {
            margin: 20px 0;
        }

        form {
            color: var(--primary-color);
            display: flex;
            flex-direction: column;
            margin: 100px 50px;
        }

        ::placeholder {
            color: rgb(150, 150, 150);
            font-size: medium;
        }

        textarea::placeholder {
            color: rgb(150, 150, 150);
            font-size: medium;
        }

        form input, textarea {
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
            width: 700px;
            transition: box-shadow .2s ease-in-out;
            font-size: medium;
        }

        form input:focus, textarea:focus {
            border: none;
            outline: none;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
        }

        form button {
            cursor: pointer;
            padding: 12px 15px;
            font-size: large;
            width: 120px;
            color: var(--secondary-color);
            border: 2px solid var(--primary-color);
            border-radius: 5px;
            margin: 25px 0;
            transition: .2s ease-in-out;
            background: var(--primary-color);
        }

        form button:hover {
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
        }

        form h1 {
            margin: 25px 0;
        }

        #email-error {
            width: 200px;
            color: #fff;
            background: rgb( 160, 0, 0);
        }

        #number-error {
            display: none;
            color: rgb( 160, 0, 0);
        }
        
        #test1{
            margin: 100px 50px;
            margin-bottom: 0;
        }

        #responsiveness {
            margin-top: 50px;
        }

        .img {
            min-height: 150px;
            width: 150px;
            background: #fff;
            margin: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
        }

        .card {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin: 25px 0;
            justify-content: space-evenly;
        }

        .card-reverse {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin: 25px 0;
            flex-direction: row-reverse;
            justify-content: space-evenly;
        }

        .card p, .card-reverse p {
            width: 700px;
        }

        nav {
            display: none;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            padding: 10px;
            background: rgba(0, 255, 0, 0.3);
            width: 700px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
        }

        hr {
            margin: 25px;
        }

        .data {
            margin: 50px;
        }

        @media only screen and (max-width: 1000px) {
            .container {
                width: 100%;
            }
            .card p, .card-reverse p {
                text-align: center;
            }
        }

        @media only screen and (max-width: 870px) {
            .card, .card-reverse {
                flex-direction: column;
            }
            .card p, .card-reverse p {
                width: 90%;
            }
        }

        @media only screen and (max-width: 810px) {
            form input, textarea {
                width: 400px;
            }
        }

        @media only screen and (max-width: 500px) {
            form {
                margin: 25px;
            }
            #hero {
                margin: 25px;
                padding: 5px;
            }
            #test1 {
                margin: 50px 25px;
            }
            .data {
                margin: 15px;
            }
            form input, textarea {
                width: 100%;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <div id="hero">
            <h1>Hey Ankit!</h1>
            <p style="text-align: center;">All three tests are below, I hope you'll like it.</p>
        </div>
        <div id="test1">
            <div class="center">
                <h1 style="line-height: 40px;">Responsiveness Test (Change the window size)</h1>
            </div>
            <div id="responsiveness">
                <div class="card">
                    <div class="img"></div>
                    <p class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam dicta inventore, quod sint in earum voluptatem consequuntur dolore minima temporibus. Iusto dignissimos voluptatibus, a quibusdam mollitia id inventore eos alias assumenda deleniti ad ea?</p>
                </div>
                <div class="card-reverse">
                    <div class="img"></div>
                    <p class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam dicta inventore, quod sint in earum voluptatem consequuntur dolore minima temporibus. Iusto dignissimos voluptatibus, a quibusdam mollitia id inventore eos alias assumenda deleniti ad ea?</p>
                </div>
                <div class="card">
                    <div class="img"></div>
                    <p class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam dicta inventore, quod sint in earum voluptatem consequuntur dolore minima temporibus. Iusto dignissimos voluptatibus, a quibusdam mollitia id inventore eos alias assumenda deleniti ad ea?</p>
                </div>
            </div>
        </div>
        <div id="test2">
            <div class="center">
                <h1 style="margin: 50px 0;">Data From The Database</h1>
            </div>
            <div class="data">
            <?php
            $num = 1;
            if ($num>0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "#ROW ". $num;
                    echo "<br>";
                    echo " EMAIL: ". $row['email'];
                    echo "<br>";
                    echo " NUMBER: ". $row['number'];
                    echo "<br>";
                    echo " MESSAGE: ". $row['message'];
                    echo "<br>";
                    echo "<hr>";
                    $num++;
                };
            }
            ?>
            </div>
            
        </div>
        <div id="test3">
            <form id="form" action="index.php" method="post">
                <h1>Form Validation Test</h1>
                <!--
                if ($insert == TRUE) {
                echo "<nav><h3>Form Submitted!</h3></nav>";
                }
                -->                
                <label for="email">Email</label>
                <span id="email-error"><?php echo $email_error ?></span>

                <input id="email" name="email" type="email" placeholder="Enter Your Email">

                <label for="number">Phone Number</label>
                <span id="number-error">This Phone Number Is Already Registered</span>

                <input id="number" name="number" type="number" placeholder="Most Important 10 Digits Of Your Life">

                <label for="message">Message</label>

                <textarea name="message" placeholder="Anything you wnat to say?" id="message" cols="30" rows="10"></textarea>

                <button type="submit">Send<i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</body>
</html>