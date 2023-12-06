<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all distinct cvNames
$sqlCvNames = "SELECT DISTINCT ResumeName FROM General";
$resultCvNames = $conn->query($sqlCvNames);

// Assuming you pass the selected cvName as a parameter in the URL
$selectedCvName = isset($_GET['cvName']) ? $_GET['cvName'] : '';

// Fetch data based on the selected cvName
$sql = "SELECT * FROM General WHERE ResumeName = '$selectedCvName'";
$result = $conn->query($sql);

// Fetch phone numbers based on the selected cvName
$sqlPhone = "SELECT * FROM Phone WHERE ResumeName = '$selectedCvName'";
$resultPhone = $conn->query($sqlPhone);

// Fetch degrees based on the selected cvName
$sqlCerDeg = "SELECT * FROM CerDeg WHERE ResumeName = '$selectedCvName'";
$resultCerDeg = $conn->query($sqlCerDeg);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<script>
    function validatePhoneNumber() {
        var phoneNumber = document.getElementById('phone').value;

        // Check if the phone number is exactly 10 digits
        if (phoneNumber.length !== 10 || isNaN(phoneNumber)) {
            alert('Please enter a valid phone number.');
            return false;
        }

        return true;
    }
    function validateBirthday() {
            var birthday = document.getElementById('birthday').value;

            // Check if the birthday is not empty
            if (!birthday) {
                alert('Please enter the birthday.');
                return false;
            }

            return true;
    }
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Résumé</title>
    <!-- Add your stylesheets or inline styles here -->
    <style>
        /* Add your CSS styling here */
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h3 {
    color: #333;
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-top: 10px;
}

input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 20px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

        /* Add more styling as needed */
    </style>
</head>
<body>
    <div class="container">
        <h3>Edit Résumé Information</h3>

        <form action="edit.php" method="GET">
            <label for="cvName">Select Résumé:</label>
            <select id="cvName" name="cvName" onchange="this.form.submit()">
                <option value="" disabled selected>Select Résumé</option>
                <?php
                while ($rowCvName = $resultCvNames->fetch_assoc()) {
                    $cvNameOption = htmlspecialchars($rowCvName['ResumeName']);
                    $selected = ($cvNameOption === $selectedCvName) ? 'selected' : '';
                    echo "<option value='$cvNameOption' $selected>$cvNameOption</option>";
                }
                ?>
            </select>
        </form>

        <?php if ($result->num_rows > 0) : ?>
    <?php $row = $result->fetch_assoc(); ?>
    <form action="update.php" method="POST" onsubmit="return validatePhoneNumber() && validateBirthday();">
        <input type="hidden" name="cvName" value="<?php echo htmlspecialchars($row['ResumeName']); ?>">
        <input type="hidden" name="mail" value="<?php echo htmlspecialchars($row['Mail']); ?>">
        <h3>Edit Résumé Information</h3>
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($row['FullName']); ?>">
        </br>
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($row['Birthday']); ?>">
        </br>
        <label for="addr">Address:</label>
        <input type="text" id="addr" name="addr" value="<?php echo htmlspecialchars($row['Addr']); ?>">
        </br>
        <label for="mail">Mail:</label>
        <input type="text" id="mail" name="mail" value="<?php echo htmlspecialchars($row['Mail']); ?>" readonly>
        </br>
        <label for="website">Website:</label>
        <input type="text" id="website" name="website" value="<?php echo htmlspecialchars($row['Website']); ?>">
        </br>
        <label for="Skills">Skills:</label>
        <input type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($row['Skills']); ?>">
        </br>
        <label for="PersonalSkills">Personal Skills:</label>
        <input type="text" id="PersonalSkills" name="PersonalSkills" value="<?php echo htmlspecialchars($row['PersonalSkills']); ?>">
        </br>
        <label for="Experience">Experience:</label>
        <input type="text" id="Experience" name="Experience" value="<?php echo htmlspecialchars($row['Experience']); ?>">
        </br>

        <h3>Edit Phone Numbers</h3>
        <ul>
            <?php while ($rowPhone = $resultPhone->fetch_assoc()) : ?>
                <li>
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone[<?php echo htmlspecialchars($rowPhone['ResumeName']); ?>]" value="<?php echo htmlspecialchars($rowPhone['Phone']); ?>">
                </li>
            <?php endwhile; ?>
        </ul>

        <h3>Edit Certificate/Degree</h3>
        <ul>
            <?php while ($rowCerDeg = $resultCerDeg->fetch_assoc()) : ?>
                <li>
                    <label for="cerDeg">Certificate/Degree:</label>
                    <input type="text" id="cerDeg" name="cerDeg[<?php echo htmlspecialchars($rowCerDeg['ResumeName']); ?>]" value="<?php echo htmlspecialchars($rowCerDeg['CerDeg']); ?>">
                </li>
            <?php endwhile; ?>
        </ul>

        <input type="submit" value="Update All">
    </form>
    <?php else : ?>
        <p>No data found for the specified CV.</p>
    <?php endif; ?>


        <h3>Delete All Data</h3>
        <form action="delete.php" method="POST">
            <input type="hidden" name="cvName" value="<?php echo htmlspecialchars($selectedCvName); ?>">
            <input type="hidden" name="mail" value="<?php echo htmlspecialchars($row['Mail']); ?>">
            <input type="submit" name="deleteAll" value="Delete All Data">
        </form>
    </div>
</body>
</html>
