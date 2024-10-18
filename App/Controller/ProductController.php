<?php

    namespace App\Controller;

    use App\Model\Product;
    
    class ProductController {
        public function product_page() {
            $products = Product::getAll();
            return view('product','Product Page',$products);
        }
    
        public function create() {
            return view('create','Create Page');
        }

        public function edit_page(){
            $product = Product::get_data(['id' => $_POST['id']]);
            return view("edit",'Edit Page',$product);
        }

        public function update() {

            $id = htmlspecialchars(strip_tags($_POST['id']));
            $name = htmlspecialchars(strip_tags($_POST['name']));
            $price = htmlspecialchars(strip_tags($_POST['price']));
            $quantity = htmlspecialchars(strip_tags($_POST['quantity']));

            $data = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $targetDir = "uploads/";
                $targetFile = $targetDir . basename($image["name"]);
                move_uploaded_file($image["tmp_name"], $targetFile);

                $data['image'] = $targetFile;
            }


            Product::update($id, $data); 
            header('Location: /');
        }
    
        public function store() {
            // dd($_POST);
            if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['quantity'])){

                $name = htmlspecialchars(strip_tags($_POST['name']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $quantity = htmlspecialchars(strip_tags($_POST['quantity']));

                $data = [
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity
                ];

                if (isset($_FILES['image'])) {
                    $image = $_FILES['image'];
                    $targetDir = "uploads/";
                    $targetFile = $targetDir . basename($image["name"]);
                    move_uploaded_file($image["tmp_name"], $targetFile);
            
                    $data['image'] = $targetFile;
                }
            }
            Product::create($data);
            header('Location: /');
        }
            
        public function delete(){
            $id = $_POST['id'];
            Product::delete($id);
            header('Location: /');
        }

        public function take_api(){
            $data = Product::getAll();
            dd(api($data)) ;
        }
    }
    
?>