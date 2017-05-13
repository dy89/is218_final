<?php include '../view/header.php'; ?>
<main>
	<h1>Select Technician </h1>
	<table>
            <tr>
                <th>Name</th>
                <th>Open Incidents</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($_SESSION['logged']['technicians'] as $technician) : 
                $techID = $technician->gettechID();?>
            <tr>
                <td><?php echo $technician->getfullName(); ?></td>
                <td><?php echo $technician->getincidentCount(); ?></td>
				<td><form action="." method="post"
						  id="select_tech_form">
                    <input type="hidden" name="action"
                           value="assign_tech" />
                    <input type="hidden" name="techID"
                           value="<?php echo $techID; ?>" />
                    <input type="submit" value="Select" />
                </form></td>
            </tr>
            <?php endforeach; ?>
     </table>
</main>
<?php include '../view/footer.php'; ?>