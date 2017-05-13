<?php include '../view/header.php'; ?>
<main>
	<h1>Select Incident </h1> 
	<table>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Date Opened</th>
                <th>Title</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($_SESSION['logged']['incidents'] as $incident) : 
                $incidentID = $incident->getincidentID();?>
            <tr>
                <td><?php echo $incident->getcustomerName(); ?></td>
                <td><?php echo $incident->getproductCode(); ?></td>
                <td><?php echo $incident->getdateOpened(); ?></td>
                <td><?php echo $incident->getTitle(); ?></td>
                <td><?php echo $incident->getDescription(); ?></td>
				<td><form action="." method="post"
						  id="select_tech_form">
                    <input type="hidden" name="action"
                           value="select_tech">
                    <input type="hidden" name="incidentID"
                           value="<?php echo $incidentID; ?>">
                    <input type="submit" value="Select">
                </form></td>
            </tr>
            <?php endforeach; ?>
     </table>
</main>
<?php include '../view/footer.php'; ?>