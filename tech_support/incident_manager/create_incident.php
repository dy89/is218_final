<?php include '../view/header.php'; ?>
<main>
    <h1>Create Incident </h1>
    <form action="." method="post" id="add_form">
    <label>Customer:</label>
    <?php echo htmlspecialchars($fullName);?>
    <br>
    <label>Product:</label>
            <select name="productkey">
            <?php foreach($registrations as $registration) :
                $name = $registration->getproductName();
                $productCode = $registration->getproductCode();
                ?>
                <option value="<?php echo $productCode; ?>">
                <?php echo $name; ?>
                </option>
            <?php endforeach; ?>
            </select><br>
    <label>Title:</label>
        <input type="input" name="title"
            value ="<?php echo htmlspecialchars($title);?>">
        <?php echo $fields->getField('title')->getHTML(); ?>
        <br>
    <label>Description:</label>
        <textarea name="description" rows = "5" cols="40">
           <?php echo htmlspecialchars($description);?> </textarea>
        <?php echo $fields->getField('description')->getHTML(); ?>
        <br>
    <label>&nbsp;</label>
    <input type="hidden" name="customerID"
                           value="<?php echo $customerID; ?>" />
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Register Product">
    <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>