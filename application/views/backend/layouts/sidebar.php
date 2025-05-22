<?php $role = $this->session->userdata('role'); ?>

<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="<?= site_url('dashboard') ?>" class="app-brand-link">
      <span class="app-brand-logo demo">
        <!-- SVG logo here -->
      </span>
      <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?= ($this->router->fetch_class() == 'dashboard') ? 'active' : '' ?>">
      <a href="<?= site_url('dashboard') ?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <?php if ($role == 'admin'): ?>
      <!-- Doctor -->
      <li class="menu-item <?= ($this->router->fetch_class() == 'doctor') ? 'active' : '' ?>">
        <a href="<?= site_url('doctor') ?>" class="menu-link">
          <i class="menu-icon tf-icons ti ti-app-window"></i>
          <div data-i18n="Doctor">Doctor</div>
        </a>
      </li>

      <!-- Obat -->
      <li class="menu-item <?= ($this->router->fetch_class() == 'obat') ? 'active' : '' ?>">
        <a href="<?= site_url('obat') ?>" class="menu-link">
          <i class="menu-icon tf-icons ti ti-capsule"></i>
          <div data-i18n="Obat">Obat</div>
        </a>
      </li>

      <!-- Penyakit -->
      <li class="menu-item <?= ($this->router->fetch_class() == 'penyakit') ? 'active' : '' ?>">
        <a href="<?= site_url('penyakit') ?>" class="menu-link">
          <i class="menu-icon tf-icons ti ti-virus"></i>
          <div data-i18n="Penyakit">Penyakit</div>
        </a>
      </li>

      <!-- Ruangan -->
      <li class="menu-item <?= ($this->router->fetch_class() == 'ruangan') ? 'active' : '' ?>">
        <a href="<?= site_url('ruangan') ?>" class="menu-link">
          <i class="menu-icon tf-icons ti ti-building-hospital"></i>
          <div data-i18n="Ruangan">Ruangan</div>
        </a>
      </li>
    <?php endif; ?>

    <!-- Logout -->
    <li class="menu-item">
      <a href="<?= site_url('auth/logout') ?>" class="menu-link">
        <i class="menu-icon tf-icons ti ti-logout"></i>
        <div data-i18n="Logout">Logout</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->
