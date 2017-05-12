<?php include '../view/header.php'; ?>
<main>
	<h1>Product List </h1>
	<table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Version</th>
                <th>Release Date</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product->getproductCode(); ?></td>
                <td><?php echo $product->getName(); ?></td>
                <td class="right"><?php echo $product->getVersionFormatted(); ?></td>
				<td><?php $releaseDate = new DateTime($product->getreleaseDate()); echo $releaseDate->format('m-d-Y'); ?></td>
				<td><form action="." method="post"
						  id="delete_product_form">
                    <input type="hidden" name="action"
                           value="delete_product" />
                    <input type="hidden" name="productCode"
                           value="<?php echo $product->getproductCode(); ?>" />
                    <input type="submit" value="Delete" />
                </form></td>
            </tr>
            <?php endforeach; ?>
     </table>
     <p><a href="?action=show_add_form">Add Product</a></p>
</main>
<?php include '../view/footer.php'; ?>