<?php
#Establish a connection to the MySQL database
$servername = "marking-db.cccnwlhhyhlh.us-east-1.rds.amazonaws.com"; #host name
$username = "admin";
$password = "Marking123";
$dbname = "Scribii";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $Tags = '<p><span><div><br><strong><em>';
    $Attributes = 'style';
    $annotatedText = $_POST["annotatedtext"];
    $sanitizedAnnotatedText = strip_tags($annotatedText, $Tags.$Attributes);

    $query = "insert into `Scribii`.Annotated_input(Annotated_input) values(?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $sanitizedAnnotatedText);
        if ($stmt->execute()) {
            echo "<p>db connected and submitted a result</p>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    mysqli_close($conn);
    ?>
