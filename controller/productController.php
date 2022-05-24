<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    class productController{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database(); 
            $this->fm = new Format();   
        }

        public function insert_product($data,$files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_description = mysqli_real_escape_string($this->db->link, $data['product_description']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            //Check image and put image into folder upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($productName == "" || $category == "" || $brand == "" || $product_description == "" || $price == "" || $type == "" || $file_name == ""){
                $alert = "<span class='error'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product (productName, catId, brandId, product_description, type, price, image) 
                    VALUES ('$productName', '$category', '$brand', '$product_description', '$type', '$price', '$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Success!!!</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

        public function show_product(){
            $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                WHERE p.catId = c.catId and p.brandId = b.brandId
                ORDER BY p.productName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_product($product_start,$limit){
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                WHERE p.catId = c.catId and p.brandId = b.brandId
                ORDER BY p.productId ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data,$files,$id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_description = mysqli_real_escape_string($this->db->link, $data['product_description']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $status = mysqli_real_escape_string($this->db->link, $data['status']);
            //Check image and put image into folder upload
            $permitted = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($productName == "" || $category == "" || $brand == "" || $product_description == "" || $price == "" || $type == "" || $status == ""){
                $alert = "<span class='error'>Fields must be not empty!!!</span>";
                return $alert;
            } else {
                if(!empty($file_name)){
                    if($file_size > 20480){
                        $alert = "<span class='error'>Image size should be less than 2MB!</span>";
                        return $alert;
                    } else if (in_array($file_ext, $permitted) === false){
                        $alert = "<span class='error'> You can upload only :-".implode(', ', $permitted)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product SET 
                        productName = '$productName',
                        catId = '$category',
                        brandId = '$brand',
                        product_description = '$product_description',
                        type = '$type',
                        price = '$price',
                        image = '$unique_image',
                        status = '$status'
                        WHERE productId = '$id'";
                } else {
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category',
                    brandId = '$brand',
                    product_description = '$product_description',
                    type = '$type',
                    price = '$price',
                    status = '$status'
                    WHERE productId = '$id'";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Updated successfully!!!</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Failed!!!</span>";
                    return $alert;
                }
            }
        }

//        public function delete_product($id){
//            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
//            $result = $this->db->delete($query);
//            if($result){
//                $alert = "<span class='success'>Deleted successfully!!!</span>";
//                return $alert;
//            } else {
//                $alert = "<span class='error'>Failed!!!</span>";
//                return $alert;
//            }
//        }

        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //FRONTEND
        public function getproduct_featured(){
            $query = "SELECT * FROM tbl_product WHERE type = '1' AND status = '1' ORDER BY productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product WHERE status = '1' ORDER BY productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product_new(){
            $query = "SELECT * FROM tbl_product WHERE status = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_details($id){
            $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
                where p.catId = c.catId and p.brandId = b.brandId
                and p.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestIP(){
            $query = "SELECT * FROM tbl_product WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE 'apple') AND status = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestSamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE 'samsung') AND status = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestMSI(){
            $query = "SELECT * FROM tbl_product WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE 'msi') AND status = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function getLastestDELL(){
            $query = "SELECT * FROM tbl_product WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE 'dell') AND status = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product($keyword){
            $keyword = $this->fm->validation($keyword);
            $query = "SELECT * FROM tbl_product WHERE productId IN (SELECT productId FROM tbl_product
                WHERE productName LIKE '%$keyword%' AND status = 1) OR productId IN (SELECT productId FROM tbl_product
                WHERE catId = (SELECT catId FROM tbl_category WHERE catName LIKE '%$keyword%' AND status = 1))
                OR productId IN (SELECT productId FROM tbl_product
                WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE '%$keyword%' AND status = 1))
                ORDER BY productName ASC";
            $result = $this->db->select($query);
            return $result;
        }

        public function search_product_pagination($keyword,$product_start,$limit){
            $keyword = $this->fm->validation($keyword);
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_product WHERE productId IN (SELECT productId FROM tbl_product
                WHERE productName LIKE '%$keyword%' AND status = 1) OR productId IN (SELECT productId FROM tbl_product
                WHERE catId = (SELECT catId FROM tbl_category WHERE catName LIKE '%$keyword%' AND status = 1))
                OR productId IN (SELECT productId FROM tbl_product
                WHERE brandId = (SELECT brandId FROM tbl_brand WHERE brandName LIKE '%$keyword%' AND status = 1))
                ORDER BY type DESC, productName ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_brand($brandId){
            $catId = mysqli_real_escape_string($this->db->link, $brandId);
            $query = "SELECT * FROM tbl_product WHERE brandId = '$brandId' AND status = 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_product_by_brand($brandId,$product_start,$limit){
            $brandId = mysqli_real_escape_string($this->db->link, $brandId);
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_product where brandId = '$brandId' AND status = 1 ORDER BY type DESC, productName ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_pagination_product_by_cat($catId,$product_start,$limit){
            $catId = mysqli_real_escape_string($this->db->link, $catId);
            $product_start = mysqli_real_escape_string($this->db->link, $product_start);
            $limit = mysqli_real_escape_string($this->db->link, $limit);
            $query = "SELECT * FROM tbl_product where catId = '$catId' AND status = 1 ORDER BY type DESC, productName ASC LIMIT {$product_start},{$limit}";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>