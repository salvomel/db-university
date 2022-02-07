<?php
require_once __DIR__ . '/Department.php';
require_once __DIR__ . '/database.php';

$sql = 'SELECT * FROM departments';
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {

    $departments = [];

    while($row = $result->fetch_assoc()) {

        $new_department = new Department();
        $new_department->id = $row['id'];
        $new_department->name = $row['name'];
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
    <title>University</title>
</head>
<body>
    <h1>Dipartimenti</h1>

    <?php foreach($departments as $department) { ?>
        
        <ul>
            <li>
                <a href="department-details.php?id=<?php echo $department->id; ?>"><?php echo $department->name; ?></a>
            </li>
        </ul>
        
    <?php } ?>
</body>
</html>
