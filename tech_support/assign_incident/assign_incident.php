<?php include '../view/header.php'; ?>
<main>
    <h1>Assign Incident</h1> 
    <form action="index.php" method="post" id="add_form">
        <input type="hidden" name="action" value="assign">

        <label>Customer:</label>
        <?php echo $incident->getcustomerName(); ?>
        <br>

        <label>Product:</label>
        <?php echo $incident->getproductCode(); ?>
        <br>

        <label>Technician:</label>
        <?php echo $technician->getfullName(); ?>
        <br>

        <input type="submit" value="Assign Incident">
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>
