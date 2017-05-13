<?php include '../view/header.php'; ?>
<main>
    <h1>Technician Login </h1>
    <p>You must login before you can update an incident.</p>
    <form action="." method="post">
    <label>Email:</label>
        <input type="input" name="email"
            value ="<?php echo htmlspecialchars($email);?>">
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Login" />
        <?php echo $fields->getField('email')->getHTML(); ?>
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>