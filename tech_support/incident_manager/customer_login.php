<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Login </h1>
    <form action="." method="post">
    <label>Email:</label>
        <input type="input" name="email"
            value ="<?php echo htmlspecialchars($email);?>">
        <input type="hidden" name="action" value="get_customer">
        <input type="submit" value="Get Customer" />
        <?php echo $fields->getField('email')->getHTML(); ?>
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>