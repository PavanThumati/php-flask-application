<?php
$apiUrl = 'http://app-service/';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query(['name' => $name])
        ]
    ];
    $context = stream_context_create($options);
    file_get_contents($apiUrl, false, $context);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$response = file_get_contents($apiUrl);
$users = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Flask-MySQL App</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #dfe9f3, #ffffff);
            margin: 60px auto;
            max-width: 720px;
            padding: 30px;
            color: #1a1a1a;
            line-height: 1.6;
        }

        h1, h2 {
            color: #003366;
            border-bottom: 2px solid #003366;
            padding-bottom: 6px;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 40px;
        }

        input[type="text"] {
            flex: 1 1 280px;
            padding: 14px 16px;
            border: 2px solid #cce0ff;
            border-radius: 6px;
            font-size: 16px;
            background-color: #fefefe;
            transition: border-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
        }

        input[type="text"]:focus {
            border-color: #3399ff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(51, 153, 255, 0.2);
        }

        input[type="submit"] {
            padding: 14px 24px;
            background-color: #3399ff;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        input[type="submit"]:hover {
            background-color: #1a75d1;
            transform: translateY(-2px);
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        li {
            background-color: #ffffff;
            padding: 14px 18px;
            margin-bottom: 12px;
            border-left: 5px solid #3399ff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.06);
            transition: transform 0.2s ease;
        }

        li:hover {
            transform: translateX(5px);
        }

        @media (max-width: 600px) {
            body {
                margin: 30px 16px;
            }

            form {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="submit"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Enter a Name</h1>
    <form method="post">
        <input type="text" name="name" required placeholder="Enter a name" />
        <input type="submit" value="Add" />
    </form>

    <h2>User List</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?php echo htmlspecialchars($user['name']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
