<!-- /views/products/edit.php -->
<h2>Edit Product</h2>
<form action="/update" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $data['name'] ?>">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= $data['price'] ?>">
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $data['quantity'] ?>">
    </div>
    <input type="hidden" name="id" value="<?= $data['id']?>">
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        <img src="<?= $data['image'] ?>" width="100" height="100" alt="Current Image">
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
