<!DOCTYPE html>
<html class="indigo accent-2">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <!-- Google Icon Fonts -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- mobile optimization -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>User List</title>
    <style>
        /* Style the table */
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
        }

        /* Style the table header */
        th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 10px;

        }

        /* Style the table rows */
        tr {
            border-bottom: 1px solid #ddd;
        }

        /* Style the table data cells */
        td {
            padding: 5px;
            text-align: center;
        }

        /* Style the account image cell */
        td img {
            max-width: 100px;
            max-height: 100px;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .container {
            margin-top: 2rem;
            padding-left: 10rem;
            height: fit-content;
        }

        .logoutbtn {
            margin-left: 30rem;
        }

        .topbar,
        th {
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="topbar">
        <h1 class="white-text">Administrator Page</h1>
    </div>
    <div class="container indigo accent-1">
        <table border="1">
            <thead>
                <tr>
                    <th class="indigo lighten-4">ID</th>
                    <th class="indigo lighten-4">Account Image</th>
                    <th class="indigo lighten-4">Username</th>
                    <th class="indigo lighten-4">Password</th>
                    <th class="indigo lighten-4">Email</th>
                    <th class="indigo lighten-4">Date of Birth</th>
                    <th class="indigo lighten-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include('connection.php');

                // Fetch user data from the database and populate the table
                $sql = "SELECT id, acc_image, acc_username, acc_password, acc_email, acc_dob FROM accounts";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo '<td><img src="' . $row["acc_image"] . '" alt="Account Image"></td>';
                        echo "<td>" . $row["acc_username"] . "</td>";
                        echo "<td>" . $row["acc_password"] . "</td>";
                        echo "<td>" . $row["acc_email"] . "</td>";
                        echo "<td>" . $row["acc_dob"] . "</td>";
                        echo '<td><button class="delete-button" onclick="deleteRow(' . $row["id"] . ')">Delete</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found.</td></tr>";
                }

                // Close the database connection (from the connection.php file)
                $con->close();
                ?>
            </tbody>
        </table>
        <a class="logoutbtn blue accent-2 waves-effect waves-light btn" onclick="logout()">Logout</a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
        function deleteRow(userId) {
            var confirmation = confirm("Are you sure you want to delete this user?");

            if (confirmation) {
                // Send an AJAX request to delete_user.php
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "deleteUser.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // If the request is successful, remove the row from the table
                        if (xhr.responseText === "User deleted successfully") {
                            var row = document.getElementById("userRow" + userId);
                            if (row) {
                                row.parentNode.removeChild(row);
                                alert("Account deleted successfully.");
                            }
                        } else {
                            alert("Error: " + xhr.responseText);
                        }
                    }
                };
                xhr.send("user_id=" + userId);
            }
        }
        function logout() {
            
            window.location.href = "login.php";
        }
    </script>
</body>

</html>