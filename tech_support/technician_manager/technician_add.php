<?php include '../view/header.php'; ?>
<main>
    <h1>Add Technician</h1>
    <form action="index.php" method="post" id="add_form">
        <input type="hidden" name="action" value="add_technician">

        <label>First Name:</label>
        <input type="input" name="firstName"
            value ="<?php echo htmlspecialchars($firstName);?>">
        <?php echo $fields->getField('firstName')->getHTML(); ?>
        <br>

        <label>Last Name:</label>
        <input type="input" name="lastName"
            value ="<?php echo htmlspecialchars($lastName);?>">
        <?php echo $fields->getField('lastName')->getHTML(); ?>
        <br>

        <label>Email:</label>
        <input type="input" name="email"
            value ="<?php echo htmlspecialchars($email);?>">
        <?php echo $fields->getField('email')->getHTML(); ?>
        <br>

        <label>Phone:</label>
        <input type="input" name="phone"
            value ="<?php echo htmlspecialchars($phone);?>">
        <?php echo $fields->getField('phone')->getHTML(); ?>
        <br>

        <label>Password:</label>
        <input type="input" name="password"
            value ="<?php echo htmlspecialchars($password);?>">
        <?php echo $fields->getField('password')->getHTML(); ?>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Technician">
        <br>
    </form>
    <p><a href="index.php?action=list_technicians">View Technician List</a></p>

</main>
<?php include '../view/footer.php'; ?>
