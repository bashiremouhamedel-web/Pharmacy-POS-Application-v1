<?php
session_start();
if (!isset($_SESSION['store_id'])) {
    header('location:login.php');
    exit();
}
include('config/db.php');

$store = getCurrentStore();
$currentCurrency = getStoreCurrency();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Settings | Pharmacy POS</title>
  <?php include('part/all-css.php'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include('part/navbar.php'); ?>
  <?php include('part/sidebar.php'); ?>

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-cog mr-2"></i>System Settings</h3>
              </div>
              <div class="card-body">
                <?php if (isset($_SESSION['msg'])): ?>
                  <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['msg'], ENT_QUOTES, 'UTF-8'); unset($_SESSION['msg']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['e-msg'])): ?>
                  <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['e-msg'], ENT_QUOTES, 'UTF-8'); unset($_SESSION['e-msg']); ?></div>
                <?php endif; ?>

                <form method="post" action="actions/update-settings.php">
                  <div class="form-group">
                    <label for="currency">Display Currency</label>
                    <select class="form-control" id="currency" name="currency" required>
                      <?php foreach (SUPPORTED_CURRENCIES as $code => $label): ?>
                        <option value="<?php echo htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $currentCurrency === $code ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($code . ' - ' . $label, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <small class="form-text text-muted">This currency is used by the shared currency formatter across the dashboard.</small>
                  </div>
                  <button type="submit" name="save_settings" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i>Save Settings
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Store</h5>
                <p class="mb-1"><strong><?php echo htmlspecialchars($store['name'] ?? 'Pharmacy', ENT_QUOTES, 'UTF-8'); ?></strong></p>
                <p class="text-muted mb-0">Current currency: <span class="currency"><?php echo htmlspecialchars($currentCurrency, ENT_QUOTES, 'UTF-8'); ?></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include('part/footer.php'); ?>
</div>
<?php include('part/all-js.php'); ?>
</body>
</html>
