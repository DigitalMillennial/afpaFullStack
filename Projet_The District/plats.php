<?php 
include 'header.php';
include 'connection.php';
include 'demande.php'; 

// Экранирование входящего параметра id
$idcat = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Получаем данные из базы с учетом безопасности
$products = getProducts($idcat); 
?>

<main class="main-content">
  <section class="categories-section">
    <div class="categories-container">
      <?php foreach ($products as $product): ?>
        <div class="category">
          <!-- Изображение -->
          <img src="/img/food/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
               alt="<?php echo htmlspecialchars($product->libelle, ENT_QUOTES, 'UTF-8'); ?>">
          <!-- Название -->
          <p class=""><?php echo htmlspecialchars($product->libelle, ENT_QUOTES, 'UTF-8'); ?></p>
          <!-- Цена -->
          <p class="price"><?php echo number_format((float)$product->prix, 2, ',', ' '); ?> €</p>
          <!-- Контролы заказа -->
          <div class="order-controls">
            <button class="minus-btn" disabled>-</button>
            <span class="quantity">0</span>
            <button class="plus-btn">+</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<a href="Contact.php" class="cart-button">
  <i class="fa-solid fa-cart-shopping"></i>
</a>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
