<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product </h1>
    <form action="." method="post" id="add_form">
    <label>Customer:</label>
    <?php echo $_SESSION['logged']['customer'];?>
    <br>
    <label>Product:</label>
            <select name="productkey">
            <?php foreach($_SESSION['logged']['reg'] as $registration) :
                $name = $registration->getproductName();
                $productCode = $registration->getproductCode();
                ?>
                <option value="<?php echo $productCode; ?>">
                <?php echo $name; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

    <label>&nbsp;</label>
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Register Product">
    <br>
    </form>
    <form action="." method="post" id="add_form">
    <p>You are logged in as <?php echo $_SESSION['logged']['email']; ?> </p>
    <input type="hidden" name="action" value="logout">
    <input type="submit" value="Logout">
    <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>