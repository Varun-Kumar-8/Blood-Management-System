<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'apollo_hospital');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve registered users
$user_query = "SELECT username, email, phone FROM users";
$user_result = $conn->query($user_query);

// Retrieve donations with timestamp
$donation_query = "SELECT name, amount, donation_time FROM donations";
$donation_result = $conn->query($donation_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users and Donations - Apollo Hospital</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #980202; 
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h1, h2 {
            color: #980202;
        }

        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #fff;
            color: #980202;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .logout:hover {
            background-color: #f4f4f4;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #980202; 
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Registered Users and Donations</h1>
        <a href="home.html" class="logout">Logout</a>
    </header>
    
    <section>
        <h2>Registered Users</h2>
        <ul>
            <?php
            if ($user_result->num_rows > 0) {
                while ($row = $user_result->fetch_assoc()) {
                    echo "<li>Username: " . $row["username"] . ", Email: " . $row["email"] . ", Phone: " . $row["phone"] . "</li>";
                }
            } else {
                echo "<li>No users registered yet.</li>";
            }
            ?>
        </ul>
    </section>
    
    <section>
        <h2>Donations</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Time of Registration</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($donation_result->num_rows > 0) {
                    while ($row = $donation_result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["name"] . "</td>
                                <td>$" . $row["amount"] . "</td>
                                <td>" . $row["donation_time"] . "</td>
                                </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No donations received yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    
    <footer>
        <p>&copy; 2024 Apollo Hospital. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>