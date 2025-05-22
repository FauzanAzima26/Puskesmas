<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php $this->load->view('backend/layouts/sidebar'); ?>
      <div class="layout-page">
        <?php $this->load->view('backend/layouts/navbar'); ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <?php $this->load->view($content); ?>
          </div>
          <?php $this->load->view('backend/layouts/footer'); ?>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>
  <?php $this->load->view('backend/layouts/scripts'); ?>
</body>
</html>
