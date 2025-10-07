<?php
function getQuote()
{
$object = json_decode(file_get_contents("quotes.json", true));
$random_quote = $object->quotes[array_rand($object->quotes)];
return $random_quote;
}
?>
