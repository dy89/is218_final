<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Login </h1>
    <form action="." method="post">
    <label>Email:</label>
        <input type="input" name="email"
            value ="<?php echo htmlspecialchars($email);?>">
        <?php echo $fields->getField('email')->getHTML(); ?>
        <br>
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Login" />
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>