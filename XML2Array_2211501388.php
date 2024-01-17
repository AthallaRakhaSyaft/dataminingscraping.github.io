<?php
// <center><h1>2211501388 ATHALLA RAKHA SYAFA'AT</h1></center>

function XML2Array(SimpleXMLElement $parrent)
{
  $array = array();
  
  foreach ($parrent as $name => $element) {
    ($node = & $array[$name])
      && (1 === count($node) ? $node = array($node) : 1) 
      && $node = & $node[];

      $node = $element ->count() ? XML2Array($element) : trim ($element);
    }
  return $array;
  }
?>
