<?php

if (isset($header) && $header) {
    $this->load->view('admin/header');
}

if (isset($sidebar) && $sidebar) {
    $this->load->view('admin/sidebar');
}

if (isset($_view)) {
    $this->load->view('admin/' . $_view);
}

if (isset($footer) && $footer) {
    $this->load->view('admin/footer');
}
