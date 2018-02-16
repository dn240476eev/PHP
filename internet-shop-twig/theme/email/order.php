<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <h3>Дорогой наш клиент, <span><? echo $first_name ?></span></h3>
    <h4>Ваш заказ успешно оформлен !</h4>
    <h4>Номер Вашего заказа: <span>{{ order.id }}</span></h4>
    <h4>Сумма заказа: <span>{{ order.total_cost }}</span> грн</h4>
    <h4>Статус заказа: <span>{{ order.name }}</span></h4>

<table>
<tr>
	
	<td>Email</td>
	<td><? echo $e_mail ?></td>

</tr>
</table>

</body>
</html>