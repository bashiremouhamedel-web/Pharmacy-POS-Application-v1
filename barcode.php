<?php
session_start();
if (!isset($_SESSION['store_id'])) {
    header('location:login.php');
    exit();
}
include('config/db.php');

$storeId = (int) $_SESSION['store_id'];
$products = runQuery("SELECT id, name, code, price FROM `p_medicine` WHERE `store` = '$storeId' AND `code` IS NOT NULL AND `code` != '' ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Barcodes | Pharmacy POS</title>
  <?php include('part/all-css.php'); ?>
  <style>
    .barcode-card { min-height: 230px; }
    .barcode-svg { width: 100%; max-width: 280px; height: 90px; }
    @media print {
      .main-header, .main-sidebar, .main-footer, .no-print { display: none !important; }
      .content-wrapper { margin: 0 !important; padding: 0 !important; }
      .barcode-card { break-inside: avoid; border: 1px solid #ddd; box-shadow: none; }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include('part/navbar.php'); ?>
  <?php include('part/sidebar.php'); ?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
          <h1 class="mb-0">Product Barcodes</h1>
          <button type="button" class="btn btn-primary" onclick="window.print()"><i class="fas fa-print mr-1"></i>Print Barcodes</button>
        </div>
        <div class="row">
          <?php if (empty($products)): ?>
            <div class="col-12"><div class="alert alert-info">No products with barcode codes were found. Add a code when creating a product.</div></div>
          <?php else: ?>
            <?php foreach ($products as $product): ?>
              <div class="col-sm-6 col-lg-4 mb-3">
                <div class="card barcode-card text-center p-3">
                  <h5><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                  <svg class="barcode-svg" data-code="<?php echo htmlspecialchars($product['code'], ENT_QUOTES, 'UTF-8'); ?>"></svg>
                  <div class="font-weight-bold mt-2"><?php echo htmlspecialchars($product['code'], ENT_QUOTES, 'UTF-8'); ?></div>
                  <small class="text-muted"><?php echo formatCurrency($product['price']); ?></small>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </div>
  <?php include('part/footer.php'); ?>
</div>
<?php include('part/all-js.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
<script>
  document.querySelectorAll('.barcode-svg').forEach(function (barcode) {
    JsBarcode(barcode, barcode.dataset.code, {
      format: 'CODE128',
      displayValue: false,
      margin: 8,
      height: 70,
      lineColor: '#212529'
    });
  });
</script>
</body>
</html>
