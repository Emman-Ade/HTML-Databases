<?php
require_once('registration.php');

$conn = new mysqli('localhost', 'root', '', 'students');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$eagle_id = $_POST['eagle_id'];
$status_id = $_POST['status_id'];

$stmt;
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (firstname, lastname, eagle_id, status_id) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("ssii", $firstname, $lastname, $eagle_id, $status_id);
    $stmt->execute();
    echo "Registration Successful :D";
    $stmt->close();
}

$result = display_data($conn); // Fetch data again after inserting

?>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Eagle ID</th>
        <th>Status</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $row['firstname']; ?></td>
        <td><?php echo $row['lastname']; ?></td>
        <td><?php echo $row['eagle_id']; ?></td>
        <td>
            <?php 
                // Fetch status information based on status_id
                $status_query = "SELECT statusOF FROM status WHERE status_id = " . $row['status_id'];
                $status_result = mysqli_query($conn, $status_query);
                if ($status_result && mysqli_num_rows($status_result) > 0) {
                    $status_row = mysqli_fetch_assoc($status_result);
                    echo $status_row['statusOF'];
                } else {
                    echo "Status not found";
                }
            ?>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

<?php
function display_data($conn) {
    $query = "SELECT * FROM registration";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    return $result;
}
?>