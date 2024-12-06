<?php
$host = 'localhost';
$dbname = 'dashboard_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM banners WHERE id = ?");
        $stmt->execute([$id]);
        $banner = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        $image = $_FILES['image']['name'];

        if ($image) {
            $target = "../assets/images/banners/" . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $sql = "UPDATE banners SET title = ?, description = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $description, $image, $id]);
        } else {
            $sql = "UPDATE banners SET title = ?, description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $description, $id]);
        }
        echo "تم تعديل البانر بنجاح!";
    }
} catch (PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>

<h1>تعديل بانر</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $banner['id'] ?>">
    <label>العنوان:</label>
    <input type="text" name="title" value="<?= $banner['title'] ?>" required>
    <br>
    <label>الوصف:</label>
    <textarea name="description" rows="4"><?= $banner['description'] ?></textarea>
    <br>
    <label>الصورة (اختياري):</label>
    <input type="file" name="image">
    <br>
    <button type="submit">تعديل</button>
</form>
