<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?php
if (isset($arResult["MIN_PRICE"]) and isset($arResult["MIN_PRICE"])) {
    $text = '<div style="color:red; margin: 34px 15px 35px 15px">---Текст из компонента ---: min = '.$arResult["MIN_PRICE"].' and max = '.$arResult["MAX_PRICE"].'</div>';
    $APPLICATION->AddViewContent("prices", $text);
}