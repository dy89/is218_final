<?php include '../view/header.php'; ?>
<main>
	<h1>Customer Search </h1>
    <form action="." method="post">
    <label>Last Name:</label>
        <input type="input" name="lastName"
            value ="<?php echo htmlspecialchars($lastName);?>">
        <input type="hidden" name="action" value="search_customer">
        <input type="submit" value="Search" />
        <br>
    </form>
    <form action ="." method ="post">
        <h1>Add a new customer </h1>
        <input type="hidden" name="action" value="add_customer">
        <input type="submit" value="Add Customer" />
    </form>
    <h1>Results </h1>
	<table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo $customer->getfullName(); ?></td>
                <td><?php echo $customer->getEmail(); ?></td>
                <td><?php echo $customer->getCity(); ?></td>
				<td><form action="." method="post"
						  id="view_customer_form">
                    <input type="hidden" name="action"
                           value="view_customer" />
                    <input type="hidden" name="customerID"
                           value="<?php echo $customer->getcustomerID(); ?>" />
                    <input type="submit" value="Select" />
                </form></td>
            </tr>
            <?php endforeach; ?>
     </table>
</main>
<?php include '../view/footer.php'; ?>