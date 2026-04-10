<?php
// update_person.php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data
    $stmt = $pdo->prepare("SELECT * FROM user_profiles WHERE user_id = :id");
    $stmt->execute(['id' => $userId]);
    $personalInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$personalInfo) {
        echo "User not found.";
        exit;
    }
}

// Handle form submission for updating user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $middleName = htmlspecialchars(trim($_POST['middle_name']));
    $suffix = htmlspecialchars(trim($_POST['suffix']));
    $age = htmlspecialchars(trim($_POST['age']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $birthday = htmlspecialchars(trim($_POST['birthday']));

    // Update user in the database
    $stmt = $pdo->prepare("UPDATE user_profiles SET first_name = :first_name, last_name = :last_name, middle_name = :middle_name, suffix = :suffix, age = :age, gender = :gender, birthday = :birthday WHERE user_id = :id");
    $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'middle_name' => $middleName, 'suffix' => $suffix, 'age' => $age, 'gender' => $gender, 'birthday' => $birthday, 'id' => $userId]);

    // Redirect back to the personal information table after update
    header("Location: personal_info_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS -->

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #111;
            /* Black background */
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background-color: #fff;
            /* White background for form container */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff6600;
            /* Orange color */
            font-size: 30px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            /* Dark text for labels */
        }

        input,
        select {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f4f4f4;
            /* Light gray input background */
            color: #333;
            width: 100%;
        }

        input[type="number"],
        input[type="date"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }

        select {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 12px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            width: 48%;
            /* Slightly smaller buttons for better layout */
        }

        .btn-update {
            background-color: #ff6600;
            /* Orange */
            color: white;
        }

        .btn-update:hover {
            background-color: #e65c00;
            /* Darker shade on hover */
        }

        .btn-delete {
            background-color: #dc3545;
            /* Red */
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
            /* Darker shade on hover */
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group input,
        .form-group select {
            margin-bottom: 15px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .form-footer a {
            display: inline-block;
            text-align: center;
            padding: 12px 18px;
            border-radius: 4px;
            background-color: #e1e1e1;
            /* Light gray */
            color: #333;
            text-decoration: none;
        }

        .form-footer a:hover {
            background-color: #ccc;
            /* Slightly darker gray on hover */
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Update User</h2>
        <form action="update_person.php?id=<?php echo htmlspecialchars($personalInfo['id']); ?>" method="POST">

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($personalInfo['first_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($personalInfo['last_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($personalInfo['middle_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="suffix">Suffix:</label>
                <input type="text" id="suffix" name="suffix" value="<?php echo htmlspecialchars($personalInfo['suffix']); ?>">
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($personalInfo['age']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php echo ($personalInfo['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($personalInfo['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($personalInfo['birthday']); ?>" required>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-update">Update</button>
                <a href="partnermodule.php" class="btn btn-delete">Cancel</a>
            </div>
        </form>
    </div>

</body>

</html>