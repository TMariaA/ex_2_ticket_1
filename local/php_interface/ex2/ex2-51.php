<?
IncludeModuleLangFile(__FILE__);
AddEventHandler("main", "OnBeforeEventAdd", array("exam51", "ex2_51"));
class exam51
{
    function ex2_51(&$event, &$lid, &$arFields)
    {
        if($event == "FEEDBACK_FORM"){
            global $USER;
            if ($USER->IsAuthorized()){
                $arFields["AUTHOR"] = GetMessage("ex_51_AUTH_USER", array(
                    '#ID#'=>$USER->GetID(),
                    '#LOGIN#'=>$USER->GetLogin(),
                    '#NAME#'=>$USER->GetFullName(),
                    '#NAME_FORM#'=>$arFields["AUTHOR"],
                ));
            }else{
                $arFields["AUTHOR"] = GetMessage("ex_51_NO_AUTH_USER",array(
                    '#NAME_FORM#'=>$arFields["AUTHOR"],
                ));
            }
            CEventLog::Add(array(
                'SEVERITY' => 'SECURITY',
                'AUDIT_TYPE_ID' => GetMessage("ex_51_REPLACEMENT"),
                'MODULE_ID' => 'main',
                'ITEM_ID'=> $event,
                'DESCRIPTION' => GetMessage("ex_51_REPLACEMENT").'-'.$arFields["AUTHOR"],
            ));
//            echo '<pre>'; print_r($event); echo '</pre>';
//            echo '<pre>'; print_r($lid); echo '</pre>';
//            echo '<pre>'; print_r($arFields); echo '</pre>';
        }

//        die();
    }
}
?>