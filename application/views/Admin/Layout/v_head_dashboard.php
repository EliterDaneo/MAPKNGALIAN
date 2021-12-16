<?php
$query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan=$query->num_rows();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Website MA PK MA'ARIF NGALIAN</title>
<!-- Favicons -->
  <link href="<?= base_url () ?>assets/depan-web/assets/img/favicon.jpg" rel="icon">
  <link href="<?= base_url () ?>assets/depan-web/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url () ?>assets/belakang-web/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url () ?>assets/belakang-web/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url () ?>assets/belakang-web/dist/css/adminlte.min.css">
</head>
