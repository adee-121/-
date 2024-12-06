<?php
$host = 'localhost';
$dbname = 'dashboard_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM banners";
    $stmt = $conn->query($sql);

    echo "<h1>لوحة التحكم - إدارة البانرات</h1>";
    echo "<a href='add_banner.php'>إضافة بانر جديد</a>";
    echo "<table border='1'>
            <tr>
                <th>رقم</th>
                <th>العنوان</th>
                <th>الوصف</th>
                <th>الصورة</th>
                <th>إجراءات</th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['description']}</td>
                <td><img src='../assets/images/banners/{$row['image']}' width='100'></td>
                <td>
                    <a href='edit_banner.php?id={$row['id']}'>تعديل</a> |
                    <a href='delete_banner.php?id={$row['id']}'>حذف</a>
                </td>
              </tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "فشل الاتصال: " . $e->getMessage();
}
?>
