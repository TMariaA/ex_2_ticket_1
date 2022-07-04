<? use Bitrix\Main\Application;
use Bitrix\Main\IO;
if (!function_exists("p2f")) {
    /**
     * Записывает переданный объект в файл #USER_ID#-dump.html, обработав функцией print_r
     *
     * @param mixed $obj Объект, который необходимо записать в файл
     *
     * @return void
     *
     * @example
     * <pre>
     * p2f($arFields, 1)
     * </pre>
     *
     */
   function p2f($obj, $fileName = false)
    {
        global $USER;
        //$id = $fileName ? $fileName : ($USER->GetID() ? $USER->GetID() : 'guest');
        $id= 5;
        $dump = "<pre style='font-size: 14px;'>" . print_r($obj, true) . "</pre>";

//создаем файл
        $file = new Bitrix\Main\IO\File(Application::getDocumentRoot().'/test/p2f/'. $id . "-dump.html");
        $file->putContents($dump, Bitrix\Main\IO\File::APPEND);
    }
}
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/assignment_group.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/assignment_group.php");
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agent.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/agent.php");
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/event_handlers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/event_handlers.php");
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/ex2/ex2-51.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/ex2/ex2-51.php");
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/ex2/lang/ru/ex2-51.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/ex2/lang/ru/ex2-51.php");
