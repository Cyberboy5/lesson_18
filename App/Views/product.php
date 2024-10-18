<!-- /views/products/index.php -->
<h2>Product List</h2>
<a href="/create" class="btn btn-primary">Add New Product</a>
<table class="table table-striped m-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $product): ?>
        <tr>
            <th scope="row"><?= $product['id'] ?></th>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><img src="<?= $product['image'] ?>" width="50" height="50"></td>
            <td>
                <!-- Edit button -->
                <form action="/edit" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $product['id']?>">
                    <button type="submit" name = 'edit' class="btn btn-warning">Edit</button>
                </form>
                
                <!-- Delete form -->
                <form action="/delete" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $product['id']?>">
                    <button type="submit" name = 'delete' class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
