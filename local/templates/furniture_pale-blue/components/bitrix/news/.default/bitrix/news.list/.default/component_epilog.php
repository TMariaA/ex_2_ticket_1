<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//[ex2-34]
if(isset($arResult["DATE_FIRST_NEWS"])){
    $APPLICATION->SetPageProperty('specialdate',$arResult["DATE_FIRST_NEWS"] );
}
