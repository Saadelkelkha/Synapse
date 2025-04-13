<?php
$conn = new mysqli("localhost", "root", "", "synapse");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["story_image"])) {
    $filename = time() . "_" . basename($_FILES["story_image"]["name"]);
    $target = "uploads/" . $filename;

    if (move_uploaded_file($_FILES["story_image"]["tmp_name"], $target)) {
        $stmt = $conn->prepare("INSERT INTO stories (image, created_at) VALUES (?, NOW())");
        $stmt->bind_param("s", $filename);
        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "image" => $filename,
                "id" => $conn->insert_id
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Erreur BDD"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Erreur upload"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Requête invalide"]);
}
?>
