<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel with Sanctum Authentication</title>
    <style>
        .card {
            padding: 0px 30px;
            width: 70%;
            min-height: 500px;
            background-color: rgb(151, 148, 153);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .card_header h3 {
            text-align: center;
            font-size: 45px;
            color: #8211c4;
            opacity: 0;
            animation: fadeIn 2.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card_body {
            text-align: center;
            margin-top: 4rem;
        }

        .card_body h4 {
            text-align: center;
            margin-top: 2px;
            color: rgb(2, 15, 7);
            font-family: 'Arial', sans-serif;
            animation: neon 2.5s infinite alternate;
            margin-bottom: 5rem;
        }

        .card_body a {
            margin-top: 10px;
            color: rgb(2, 15, 7);
            font-family: 'Arial', sans-serif;
            border: 2px solid rgb(8, 73, 212);
            padding: 8px 10px;
            background-color: rgb(10, 29, 199);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        @keyframes neon {
            0% {
                text-shadow: 0 0 5px #8211c4, 0 0 10px #110a38, 0 0 20px #4c00ff7c, 0 0 30px #00ff00, 0 0 40px #00ff00, 0 0 55px #00ff00, 0 0 75px #00ff00, 0 0 100px #00ff00;
            }

            50% {
                text-shadow: 0 0 10px #3911e9, 0 0 20px #00ff00, 0 0 30px #8211c4, 0 0 40px #00ff00, 0 0 50px #00ff00, 0 0 70px #8211c4, 0 0 90px #00ff00, 0 0 120px #00ff00;
            }

            100% {
                text-shadow: 0 0 20px #c41129, 0 0 30px #00ff00, 0 0 40px #dbe919, 0 0 50px #00ff00, 0 0 60px #8211c4, 0 0 80px #00ff00, 0 0 100px #8211c4, 0 0 130px #00ff00;
            }
        }
    </style>

</head>

<body class="">
    <div class="card">
        <div class="card_header">
            <h3>This Is Sanctum Authentication</h3>
        </div>
        <div class="card_body">
            <h4>It is Token Based Authentication</h4>
            <a href="https://laravel.com/docs/10.x/sanctum" target="blank">Documentation</a>
        </div>
    </div>

</body>

</html>
