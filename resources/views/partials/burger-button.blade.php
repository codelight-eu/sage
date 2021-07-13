<?php
  if (!isset($classNames)) {
    $classNames = [];
  }

  $classNamesString = '';
  foreach ($classNames as $className) {
    $classNamesString = $classNamesString . ' ' . $className;
  }
?>

<a href="#" class="BurgerButton {{ $classNamesString }}">
  <div class="BurgerButton_bar BurgerButton_bar-1"></div>
  <div class="BurgerButton_bar BurgerButton_bar-2"></div>
  <div class="BurgerButton_bar BurgerButton_bar-3"></div>
</a>
