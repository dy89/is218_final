<?php include '../view/header.php'; ?>
<main>
    <h1>View/Update Customer</h1>
    <form action="index.php" method="post" id="add_form">
        <input type="hidden" name="action" value="update_customer">

        <input type="hidden" name="customerID"
                           value="<?php echo $customerID; ?>" />

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

        <label>Address:</label>
        <input type="input" name="address"
            value ="<?php echo htmlspecialchars($address);?>">
        <?php echo $fields->getField('address')->getHTML(); ?>
        <br>

        <label>City:</label>
        <input type="input" name="city"
            value ="<?php echo htmlspecialchars($city);?>">
        <?php echo $fields->getField('city')->getHTML(); ?>
        <br>

        <label>State:</label>
        <input type="input" name="state"
            value ="<?php echo htmlspecialchars($state);?>">
        <?php echo $fields->getField('state')->getHTML(); ?>
        <br>

        <label>Postal Code:</label>
        <input type="input" name="postalCode"
            value ="<?php echo htmlspecialchars($postalCode);?>">
        <?php echo $fields->getField('postalCode')->getHTML(); ?>
        <br>

        <label>Country Code:</label>
        <select name="countryKey">
            <option selected><?php echo htmlspecialchars($currentCountry);?></option>
            <?php foreach($countries as $country) :
                $countryName = $country->getcountryName();
                $countryCode = $country->getcountryCode();?>
            <?php if ($currentCountry != $countryName):?>
                <option value="<?php echo $countryCode; ?>">
                <?php echo $countryName; ?>
                </option>
            <?php else: ?>
                <option value="<?php echo $countryCode; ?>" selected>
                <?php echo htmlspecialchars($currentCountry);?></option>
            <?php endif ?>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Phone:</label>
        <input type="input" name="phone"
            value ="<?php echo htmlspecialchars($phone);?>">
        <?php echo $fields->getField('phone')->getHTML(); ?>
        <br>

        <label>Email:</label>
        <input type="input" name="email"
            value ="<?php echo htmlspecialchars($email);?>">
        <?php echo $fields->getField('email')->getHTML(); ?>
        <br>

        <label>Password:</label>
        <input type="input" name="password"
            value ="<?php echo htmlspecialchars($password);?>">
        <?php echo $fields->getField('password')->getHTML(); ?>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Update Customer">
        <br>
    </form>
    <p><a href="index.php?action=search_customer">Search Customers</a></p>

</main>
<?php include '../view/footer.php'; ?>
