<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product </h1>
    <form action="." method="post" id="add_form">
    <label>Customer:</label>
    <?php echo htmlspecialchars($fullName);?>
    <br>
    <label>Product:</label>
            <select name="productkey">
            <?php foreach($products as $product) :
                $name = $product->getName();
                $productCode = $product->getproductCode();
                ?>
                <option value="<?php echo $productCode; ?>">
                <?php echo $name; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

    <label>&nbsp;</label>
    <input type="hidden" name="customerID"
                           value="<?php echo $customerID; ?>" />
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Register Product">
    <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>