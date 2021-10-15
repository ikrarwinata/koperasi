<?php echo view($Template->header); ?>
<?php echo view($Template->navbar); ?>

<div class="container-fluid">
  <div class="row">
    <div class="container-fluid">
      <div class="row content">
        <!-- sidebar -->
        <div class="col-md-2 col-md-2 col-xs-12 bg-light collapse show" id="navbarSupportedContent">
          <?php echo view($Template->sidebar); ?>
        </div>
        <!-- end sidebar  -->
        <!-- main -->
        <main role="main" class="col-md-10 col-md-10 col-xs-12  pt-3 px-4">
          <div class=" content">

            <?php $this->renderSection('content') ?>

          </div>
        </main>
        <!-- end main -->
      </div>
    </div>
  </div>
</div>

<?php echo view($Template->footer); ?>