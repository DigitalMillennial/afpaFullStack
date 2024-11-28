<footer class="footer" style="display: flex; align-items: center; justify-content: center; padding: 10px;">
  <!-- Политика конфиденциальности -->
  <a href="politique-confidentialite.php" aria-label="Политика конфиденциальности">Politique de confidentialité</a>

  <!-- Логотип с текстом для доступности -->
  <img 
    src="/img/the_district_brand/logo_transparent.png" 
    alt="Логотип ресторана" 
    style="height: 60px; width: 60px; margin: 0 20px;"
    loading="lazy">

  <!-- Ментions légales -->
  <a href="mentions_legales.php" aria-label="Юридические упоминания">Mentions légales</a>
</footer>

<!-- Метатег Content-Security-Policy -->
<script>
  (function() {
    // Устанавливаем строгую политику безопасности контента
    document.head.insertAdjacentHTML('beforeend', `
      <meta http-equiv="Content-Security-Policy" 
            content="default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self';">
    `);
  })();
</script>
</body>
</html>
