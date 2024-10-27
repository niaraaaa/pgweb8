<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "pgweb8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if delete action is triggered
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Prepare and execute delete query
    $delete_sql = "DELETE FROM penduduk WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1px'><tr>
            <th>Kecamatan</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Luas</th>
            <th>Jumlah Penduduk</th>
            <th>Aksi</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["kecamatan"] . "</td>
                <td>" . $row["longitude"] . "</td>
                <td>" . $row["latitude"] . "</td>
                <td>" . $row["luas"] . "</td>
                <td align='right'>" . $row["jumlah_penduduk"] . "</td>
                <td><a href='?delete_id=" . $row["delete_id"] . "' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a></td>
                </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
