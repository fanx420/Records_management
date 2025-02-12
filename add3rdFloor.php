<?php
include 'connect.php';
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

        .card {
            cursor: pointer;

        }

        a {
            text-decoration: none;
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
                    <a href="electricalRoomInspection.php" class="active">Electrical Room Inspection</a>
                    <a href="#">Reports Trough Engineering Email</a>
                </div>

            </div>


            <div class="col-md-10 content my-5 p-5">
                <h2>Add 3rd Floor Report</h2>
                <form action="addReport3rdFloor.php" method="POST">
                    <table class="table">
                        <thead class="table-dark">
                            <th>
                                Date
                            </th>
                            <th>
                                Area
                            </th>
                            <th>
                                Transformer
                            </th>
                            <th>
                                Findings
                            </th>
                        </thead>

                        <tbody>
                            <?php
                            for ($i = 0; $i < 4; $i++) {
                                echo '<tr>';
                                echo '<td><input type="date" name="date[]" class="form-control" ></td>';
                                echo '<td><input type="text" name="area[]" class="form-control" ></td>';
                                echo '<td>
                                        <select name="transformer[]" class="form-control" >
                                            <option value="">Select Transformer</option>
                                            <option value="T1">Transformer 1</option>
                                            <option value="T2">Transformer 2</option>
                                            <option value="T3">Transformer 3</option>
                                            <option value="T4">Transformer 4</option>
                                        </select>
                                      </td>';
                                echo '<td><textarea name="findings[]" class="form-control" ></textarea></td>';
                                echo '<input type="hidden" name="floor[]" value="3rd_floor">';
                                echo '</tr>';
                            }
                            ?>z 

                        </tbody>
                    </table>
                    <div class="btn-container text-end">
                        <button type="submit" name="submit" class="btn btn-primary">Add Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


</body>

</html>