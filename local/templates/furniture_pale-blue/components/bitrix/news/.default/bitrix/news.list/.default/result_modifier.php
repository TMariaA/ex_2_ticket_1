<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
//[ex2-34]
if ($arParams["SPECIALDATE"] == "Y")
{
$arResult["DATE_FIRST_NEWS"] = $arResult["ITEMS"]["0"]["ACTIVE_FROM"];
$this->__component->setResultCacheKeys($arResult["DATE_FIRST_NEWS"]);
}