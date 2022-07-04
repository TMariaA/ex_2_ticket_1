<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader,
    Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
    ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
    return;
}
//******my code******
//echo '<pre>'; print_r($arParams); echo '</pre>';

if (!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 36000000;
}

if ($this->startResultCache()) {
    $arNewsId = array();
    $arNews = array();
    $arSectionsId = array();
    $arSections = array();
    //новости
    $obNews = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
            "ACTIVE" => "Y"
        ),
        false,
        false,
        array("NAME", "ACTIVE_FROM", "ID"),
    );
    while ($newsElements = $obNews->Fetch()) {
        $arNewsId[] = $newsElements["ID"];
        $arNews[$newsElements["ID"]] = $newsElements;
    }

//    echo '<pre>'; print_r($arNewsId); echo '</pre>';
//список активных разделов с привязкой к активным новостям
    $obSection = CIBlockSection::GetList(
        array(),
        array(
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "ACTIVE" => "Y",
            $arParams["PROPERTY_IBLOCK_ID"] => $arNewsId,
            "CNT_ACTIVE" =>"Y"
        ),
        true,
        array("ID", "NAME", "IBLOCK_ID", $arParams["PROPERTY_IBLOCK_ID"]),
        false,
    );
    while ($sectionsCatalog = $obSection->Fetch()) {
        $arSectionsId[] = $sectionsCatalog["ID"];
        $arSections[$sectionsCatalog["ID"]] = $sectionsCatalog;
    }
//получаем активные товары из разделов

    $obProduct = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
            "ACTIVE" => "Y",
        ),
        false,
        false,
        array(
            "NAME",
            "IBLOCK_SECTION_ID",
            "ID",
            "IBLOCK_ID",
            "PROPERTY_ARTNUMBER",
            "PROPERTY_MATERIAL",
            "PROPERTY_PRICE",
        ),
    );
    while ($arProduct = $obProduct->Fetch()) {
        foreach ($arSections[$arProduct["IBLOCK_SECTION_ID"]][$arParams["PROPERTY_IBLOCK_ID"]] as $newsId) {
            $arNews[$newsId]["PRODUCTS"][] = $arProduct;
        }
    }
    //    echo '<pre>';
//    print_r($arNews);
//    echo '</pre>';

    //распределение разделов по новостям и подсчет количества
    $arResult["PRODUCT_CNT"] = 0;
//        echo '<pre>';
//    print_r($arSections);
//    echo '</pre>';
    foreach ($arSections as $arSection) {
        $arResult["PRODUCT_CNT"] += $arSection["ELEMENT_CNT"];
        foreach ($arSection[$arParams["PROPERTY_IBLOCK_ID"]] as $newId) {
            $arNews[$newId]['SECTIONS'][] = $arSection["NAME"];
        }
    }
$arResult["NEWS"] = $arNews;
    $this->SetResultCacheKeys(array("PRODUCT_CNT"));
    $this->includeComponentTemplate();
} else {
    $this->abortResultCashe();
}
$APPLICATION->SetTitle($arResult["PRODUCT_CNT"]);

//******my code******
//if(intval($arParams["PRODUCTS_IBLOCK_ID"]) > 0)
//{
//
//	//iblock elements
//	$arSelectElems = array (
//		"ID",
//		"IBLOCK_ID",
//		"NAME",
//	);
//	$arFilterElems = array (
//		"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
//		"ACTIVE" => "Y"
//	);
//	$arSortElems = array (
//			"NAME" => "ASC"
//	);
//
//	$arResult["ELEMENTS"] = array();
//	$rsElements = CIBlockElement::GetList($arSortElems, $arFilterElems, false, false, $arSelectElems);
//	while($arElement = $rsElements->GetNext())
//	{
//		$arResult["ELEMENTS"][] = $arElement;
//	}
//
//	//iblock sections
//	$arSelectSect = array (
//			"ID",
//			"IBLOCK_ID",
//			"NAME",
//	);
//	$arFilterSect = array (
//			"IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"],
//			"ACTIVE" => "Y"
//	);
//	$arSortSect = array (
//			"NAME" => "ASC"
//	);
//
//	$arResult["SECTIONS"] = array();
//	$rsSections = CIBlockSection::GetList($arSortSect, $arFilterSect, false, $arSelectSect, false);
//	while($arSection = $rsSections->GetNext())
//	{
//		$arResult["SECTIONS"][] = $arSection;
//	}
//
//	// user
//	$arOrderUser = array("id");
//	$sortOrder = "asc";
//	$arFilterUser = array(
//		"ACTIVE" => "Y"
//	);
//
//	$arResult["USERS"] = array();
//	$rsUsers = CUser::GetList($arOrderUser, $sortOrder, $arFilterUser); // выбираем пользователей
//	while($arUser = $rsUsers->GetNext())
//	{
//		$arResult["USERS"][] = $arUser;
//	}
//
//
//}

?>