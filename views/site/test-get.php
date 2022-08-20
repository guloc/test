<h1>Тестовая страница</h1>
<?php if($age >= 14) {
echo $name .' '. $age;
}
else {
    throw new \yii\web\HttpException(403, 'Access is closed.');
}
?>