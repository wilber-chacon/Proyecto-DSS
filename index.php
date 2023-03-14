<?php
session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: ./views/prestamista/');
} else {
  header('Location: ./views/login/');
}
?>