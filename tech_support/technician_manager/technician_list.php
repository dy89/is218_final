<?php include '../view/header.php'; ?>
<main>
	<h1>Technician List </h1>
	<table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Password</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($technicians as $technician) : ?>
            <tr>
                <td><?php echo $technician->getfullName(); ?></td>
                <td><?php echo $technician->getEmail(); ?></td>
                <td><?php echo $technician->getPhone(); ?></td>
                <td><?php echo $technician->getPassword(); ?></td>
				<td><form action="." method="post"
						  id="delete_technician_form">
                    <input type="hidden" name="action"
                           value="delete_technician" />
                    <input type="hidden" name="techID"
                           value="<?php echo $technician->gettechID(); ?>" />
                    <input type="submit" value="Delete" />
                </form></td>
            </tr>
            <?php endforeach; ?>
     </table>
     <p><a href="?action=show_addtech_form">Add Technician</a></p>
</main>
<?php include '../view/footer.php'; ?>