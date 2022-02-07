<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/Department.php';

$sql = $connection->prepare("SELECT * FROM `departments` WHERE `id`=?");
$sql->bind_param('d', $id);

$id = $_GET['id'];

$sql->execute();
$result = $sql->get_result();

$departments = [];

if($result && $result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {

        $new_department = new Department();
        $new_department->name = $row['name'];
        $new_department->address = $row['address'];
        $new_department->email = $row['email'];
        $departments[] = $new_department;
    }

} elseif($result && $result->num_rows == 0) {
    echo 'Risultati non presenti per questa pagina';

} else {
    echo 'Query error';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
</head>
<body>
    <?php foreach($departments as $department) { ?>

        <h1><?php echo $department->name; ?></h1>

        <ul>
            <li>Address: <?php echo $department->address; ?></li>
            <li>Email: <?php echo $department->email; ?></li>
        </ul>
        
    <?php } ?>
</body>
</html>