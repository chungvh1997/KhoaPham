<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
        <div align="center">
            <form action="sreach.php" method="get">
                Search: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>
        <?php
         include "IndexModel.php";
         $product= $model->loadProductIndex();
         if (isset($_REQUEST['ok'])) {
            $search = $_GET['search'];
            if (empty($search)) {
                echo "Yeu cau nhap du lieu vao o trong";
            } else {
                $a = new IndexModel;
                $searchProduct = $a -> getSreach($_GET['search']);
                $countProduct = count($searchProduct);
                if($countProduct>0 && $searchProduct != ''){
                    echo '<table border="1" cellspacing="0" cellpadding="10">';
                    foreach($searchProduct as $item){
                        echo '<tr>';
                            echo "<td>{$item->id}</td>";
                            echo "<td>{$item->name}</td>";
                            echo "<td>{$item->price}</td>";
                            echo "<td>{$item->promotion}</td>";
                            echo "<td>{$item->image}</td>";
                        echo '</tr>';
                    }
                    echo '</table>';
                }else{
                    echo "không tìm thấy sản phẩm";
                }
               
            }
        }
         
        ?>

</body>
</html>