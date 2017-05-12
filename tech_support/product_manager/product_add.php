<?php include '../view/header.php'; ?>
<main>
    <h1>Add Product</h1>
    <form action="index.php" method="post" id="add_form">
        <input type="hidden" name="action" value="add_product">

        <label>Code:</label>
        <input type="input" name="productCode"
            value ="<?php echo htmlspecialchars($productCode);?>">
        <?php echo $fields->getField('productCode')->getHTML(); ?>
        <br>

        <label>Name:</label>
        <input type="input" name="name"
            value ="<?php echo htmlspecialchars($name);?>">
        <?php echo $fields->getField('name')->getHTML(); ?>
        <br>

        <label>Version:</label>
        <input type="input" name="version"
            value ="<?php echo htmlspecialchars($version);?>">
        <?php echo $fields->getField('version')->getHTML(); ?>
        <br>

        <label>Release Date:</label>
        <input type="input" name="releaseDate"
            value ="<?php echo htmlspecialchars($releaseDate);?>">
        <?php echo $error_message ?>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Product">
        <br>
    </form>
    <p><a href="index.php?action=list_products">View Product List</a></p>

</main>
<?php include '../view/footer.php'; ?>
