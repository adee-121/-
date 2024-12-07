<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = 'localhost';
    $dbname = 'dashboard_db';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $target = "../assets/images/banners/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO banners (title, description, image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $description, $image]);
            echo "تم إضافة البانر بنجاح!";
        } else {
            echo "فشل رفع الصورة.";
        }
    } catch (PDOException $e) {
        echo "فشل الاتصال: " . $e->getMessage();
    }
}
?>

<h1>إضافة بانر جديد</h1>
<form action="" method="post" enctype="multipart/form-data">
    <label>العنوان:</label>
    <input type="text" name="title" required>
    <br>
    <label>الوصف:</label>
    <textarea name="description" rows="4"></textarea>
    <br>
    <label>الصورة:</label>
    <input type="file" name="image" required>
    <br>
    <button type="submit">إضافة</button>
</form>
