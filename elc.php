<?php
include 'connect.php';

$query = "SELECT * FROM electrical_room_inspection WHERE floor LIKE 'elc'";
$result = executeQuery($query);
$records = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="icon" href="assets/logo.png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #660000;
            border-bottom-width: 2px;
            border-bottom-color: black;
            border-bottom-style: solid;
        }

        .sidebar {
            position: fixed;
            top: 55px;
            left: 0;
            width: 250px;
            border-right-width: 2px;
            border-right-color: black;
            border-right-style: solid;
            padding: 20px;
            height: calc(100vh - 55px);
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .profile img {
            margin-top: 10px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sidebar .menu a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            text-decoration: none;
            color: #000;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar .menu a.active {
            background-color: #e9ecef;
            color: #007bff;
        }

        .sidebar .menu a:hover {
            background-color: #e9ecef;
        }

        .sidebar .logout-btn {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .content {
                margin-left: 0;
            }
        }

        @keyframes cardHover {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .card:hover {
            animation: cardHover 0.5 forwards;
        }

        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top shadow-sm scrolling-navbar">
        <div class="container-fluid">
            <a class="navbar-brand ms-2" href="#"><img src="assets/logo.png" width="50px" alt="logo"></a>
            <h2 class="ms-2 text-white">Records Management</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 sidebar">
                <div class="profile">
                    <img src="assets/default_pfp.jpg" alt="">
                </div>
                <div class="menu my-5">
                    <a href="index.php">Classroom Inspection</a>
                    <a href="elc.php" class="active">Electrical Room Inspection</a>
                    <a href="#">Reports Through Engineering Email</a>
                </div>

            </div>


            <div class="col-md-10 content my-5 p-5">


                <div class="table-responsive ">
                    <h2>ELC</h2>
                    <table class="table">
                        <thead class="table-dark">
                            <th>
                                Date
                            </th>
                            <th> Area

                            </th>

                            </th>
                            <th>
                                Transformer
                            </th>
                            <th>
                                Findings
                            </th>
                            <th>
                                Actions
                            </th>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($records as $record): ?>
                                <tr>
                                    <td><?= htmlspecialchars($record['date']) ?></td>
                                    <td><?= htmlspecialchars($record['area']) ?></td>
                                    <td><?= htmlspecialchars($record['transformer']) ?></td>
                                    <td><?= htmlspecialchars($record['findings']) ?></td>
                                    <td>
                                    <form action="editElc.php" method="GET"><input type="hidden" name="id" value="<?= $record['id'] ?>"><button type="submit" class="btn btn-primary">Edit</button">
                                    </form>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <div class="btn-container d-flex justify-content-end">
                    <a href="addElc.php"> <button class="btn btn-primary"> Add Report</button></a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


</body>

</html>
