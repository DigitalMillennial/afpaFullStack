<?php 
include 'header.php';
include 'connection.php';
include 'demande.php';

// Получаем все блюда
$products = getAllProducts();
?>

<main class="main-content">
  <section class="categories-section">
    <div class="categories-container">
      <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
          <div class="category">
            <!-- Изображение -->
            <img src="/img/food/<?php echo htmlspecialchars($product->image); ?>" 
                 alt="<?php echo htmlspecialchars($product->libelle); ?>">
            <!-- Название -->
            <p><?php echo htmlspecialchars($product->libelle); ?></p>
            <!-- Цена -->
            <p class="price"><?php echo number_format($product->prix, 2, ',', ' '); ?> €</p>
            <!-- Контролы заказа -->
            <div class="order-controls">
              <button class="minus-btn" disabled>-</button>
              <span class="quantity">0</span>
              <button class="plus-btn">+</button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Нет доступных блюд.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
