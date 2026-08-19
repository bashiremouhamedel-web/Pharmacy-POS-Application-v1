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
  <title>Product QR Codes | Pharmacy POS</title>
  <?php include('part/all-css.php'); ?>
  <style>
    .qr-card { min-height: 230px; }
    .qr-code { width: 150px; height: 150px; margin: auto; }
    @media print {
      .main-header, .main-sidebar, .main-footer, .no-print { display: none !important; }
      .content-wrapper { margin: 0 !important; padding: 0 !important; }
      .qr-card { break-inside: avoid; border: 1px solid #ddd; box-shadow: none; }
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
          <h1 class="mb-0">Product QR Codes</h1>
          <button type="button" class="btn btn-primary" onclick="window.print()"><i class="fas fa-print mr-1"></i>Print QR Codes</button>
        </div>
        <div class="row">
          <?php if (empty($products)): ?>
            <div class="col-12"><div class="alert alert-info">No products with codes were found.</div></div>
          <?php else: foreach ($products as $product): ?>
            <div class="col-sm-6 col-lg-4 mb-3">
              <div class="card qr-card text-center p-3">
                <h5><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <canvas class="qr-code" data-code="<?php echo htmlspecialchars(json_encode(array(
                  'product' => $product['name'],
                  'barcode' => $product['code'],
                  'sell_price' => formatCurrency($product['price'])
                )), ENT_QUOTES, 'UTF-8'); ?>"></canvas>
                <div class="font-weight-bold mt-2"><?php echo htmlspecialchars($product['code'], ENT_QUOTES, 'UTF-8'); ?></div>
                <small class="text-muted"><?php echo formatCurrency($product['price']); ?></small>
              </div>
            </div>
          <?php endforeach; endif; ?>
        </div>
      </div>
    </section>
  </div>
  <?php include('part/footer.php'); ?>
</div>
<?php include('part/all-js.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script>
  document.querySelectorAll('.qr-code').forEach(function (canvas) {
    new QRious({ element: canvas, value: canvas.dataset.code, size: 150, level: 'H' });
  });
</script>
</body>
</html>
