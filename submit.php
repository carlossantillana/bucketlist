<?php
   if(isset($_POST['enterItem'])) {
        //Initializing variables
        $host = "localhost";
        $user = "root";
        $password = "Lapras#131";
        $database = "bucketList";
        $getItem;
        $revisedItem;
        $newItem = $_POST['enterItem'];
        echo "original:" . $newItem . "<br>";
        $revisedItem = SmartCensor($newItem);
        echo "new:" . $revisedItem . "<br>";
        if ($newItem != $revisedItem || $newItem === " " || strlen($newItem) <= 2 || is_numeric($newItem)){
            header('Location: index.html');
        }
        //start connection
        $conn = mysqli_connect($host, $user, $password, $database) or die("Cound not connect! <br>" . mysqli_connect_error() );
        $sql = "INSERT INTO items(item) VALUE ('$newItem')";
        $conn->query($sql);//Insert into database
        mysqli_close($conn);
}
header('Location: index.html');


/**
 * @author Zangeel
 * @copyright 2009
 */


function SmartCensor($string)
{
    /**
     * Config Arrays
     **/

    //Words used to split swears, i.e. a.s.s
    $illegal = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "+",
        "=", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ",", ".", "/", "\\", "{",
        "}", "[", "]", "~", "`", ">", "<", ";", ":", "'", "\"", "?", "|");

    //Swears and their replacements
    $BadWords = array("a.ss", "s.hit", "f.uck", "bitc.h", "as.shole", "fu.cker", "sht", "btch", "f.uk", "c.unt", "moron", "idiot", "imbecel", "dick", "vagina", "tit", "titty", "penis", "wiener");
    $RePlace = array("***", "*****", "****", "*****", "*******", "******", "****", "*****", "****", "****", "***", "***", "***", "***", "***", "***", "***", "***", "***");

    //RegEx to find spaced out swears
    $RegEx = array(
    "(\s?+(a|A)\s?\s?+(s|S)\s?\s?+(s|S)\s+)" => " *** ",
    "(\s?+(s|S)\s?\s?+(h|H)\s?\s?+(i|I)\s?\s?+(t|T)\s?+)" => " **** ",
    "(\s?+(f|F)\s?\s?+(u|U)\s?\s?+(c|C)\s?\s?+(k|K)\s?+)" => " **** ",
    "(\s?+(b|B)\s?\s?+(i|I)\s?\s?+(t|T)\s?\s?+(c|C)\s?\s?+(h|H)\s?+)" => " ***** ",
    "(\s?+(a|A)\s?\s?+(s|S)\s?\s?+(s|S)\s?\s?+(h|H)\s?\s?+(o|O)\s?\s?+(l|L)\s?\s?+(e|E)\s?+)" => " ******* ",
    "(\s?+(f|F)\s?\s?+(u|U)\s?\s?+(c|C)\s?\s?+(k|K)\s?\s?+(e|E)\s?\s?+(r|R)\s?+)" => " ****** ",
    "(\s?+(s|S)\s?\s?+(h|H)\s?\s?+(t|T)\s?+)" => " **** ",
    "(\s?+(b|B)\s?\s?+(t|T)\s?\s?+(c|C)\s?\s?+(h|H)\s?+)" => " ***** ",
    "(\s?+(f|F)\s?\s?+(u|U)\s?\s?+(k|K)\s?+)" => " **** ",
    "(\s?+(c|C)\s?\s?+(u|U)\s?\s?+(n|N)\s?\s?+(t|T)\s?+)" => " **** "
    );

    /**
     *Start Process
     **/

     //(1) Take care of spaced out swears via regex
      $string = preg_replace(array_keys($RegEx), array_values($RegEx), $string);

     //EXPODE: Seperate the string word by word
     $ex = explode(" ", $string);

    //Alternate letters, e.g. @ for A, $ for S
    $alt = array("@", "!", "$", "|", "0");
    $real = array("a", "i", "s", "i", "o");

    //(2) Get rid of string seperators, check for swears
    for ($i = 0; $i < sizeof($ex); $i++) {
        $x = str_ireplace($illegal, "", $ex[$i]);
        if (in_array(strtolower($x), $BadWords)) {
            $ex[$i] = str_ireplace($BadWords, $RePlace, $x);
        }
    }

    //(3) Check for alternate spelling with special chars
    for ($i = 0; $i < sizeof($ex); $i++) {
        $y = str_ireplace($alt, $real, $ex[$i]);
        if (in_array(strtolower($y), $BadWords)) {
            $ex[$i] = str_ireplace($BadWords, $RePlace, $y);
        }
    }


    return implode(" ", $ex);
}
