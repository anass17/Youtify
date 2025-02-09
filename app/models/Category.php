<?php

    class Category {
        private int $cat_id;
        private string $cat_name;
        private array $errors = [];
        

        public function __construct(int $category_id = 0, string $name = '') {
            $this -> cat_id = $category_id;
            $this -> cat_name = $name;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setCategoryName(string $name) {
            $this -> cat_name = $name;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getCategoryId() {
            return $this -> cat_id;
        }

        public function getCategoryName() {
            return $this -> cat_name;
        }

        public function getErrors() {
            return $this -> errors;
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function createCategory() : bool {

            $db = Database::getInstance();
            
            !Security::validateName($this -> cat_name) ? ($this -> errors[] = "Category Name is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // Insert New Category

            $columns = [
                'cat_name'
            ];

            $parameters = [
                $this -> cat_name
            ];

            $insert_id = $db -> insert('categories', $columns, $parameters);

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            $this -> cat_id = $insert_id;

            return true;
        }

        public function updateCategory() : bool {

            $db = Database::getInstance();
            
            !Security::validateName($this -> cat_name) ? ($this -> errors[] = "Category Name is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // Update Category

            $columns = [
                'cat_name'
            ];

            $parameters = [
                $this -> cat_name,
                $this -> cat_id
            ];

            if (!$db -> update('categories', $columns, 'cat_id = ?', $parameters)) {
                $this -> errors[] = "Could not process your request";
                return false;
            }

            return true;
        }

        public function deleteCategory() : bool {

            $db = Database::getInstance();

            // Delete Category

            $parameters = [
                $this -> cat_id
            ];

            if (!$db -> delete('categories', 'cat_id = ?', $parameters)) {
                $this -> errors[] = "Could not process your request";
                return false;
            }

            return true;
        }

        public function loadCategory(int|string $id) {
            $db = Database::getInstance();

            try {
                $id = (int) $id;
            } catch (Exception $e) {
                Security::logError(__CLASS__ . " -> Invalid Category ID: " . $e -> getMessage());
                return false;
            }
        
            $result = $db -> select('SELECT * FROM categories WHERE cat_id = ?', [$id]);
        
            if (!$result) {
                Security::logError(__CLASS__ . " -> This category does not exist");
                return false;
            }
            
            $this -> cat_id = $result["cat_id"];
            $this -> cat_name = $result["cat_name"];
        
            return true;
        }

        public static function getAllCategories() {
            $db = Database::getInstance();

            $categories_list = $db -> selectAll("SELECT * FROM categories ORDER BY cat_id ASC");

            $categories = [];

            foreach($categories_list as $category) {
                $instance = new Category($category['cat_id'], $category['cat_name']);
                $categories[] = $instance;
            }

            return $categories;
        }
    }

?>