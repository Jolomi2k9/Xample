<?php

/* Automate the creation of input forms */
function inputElement($icon,$placeholder,$name,$value){
    $ele="
          <div class=\"input-group mb-2\">
              <div class=\"input-group-prepent\">
                 <div class=\"input-group-text bg-warning\">$icon.</div>
                 </div>
              <input type=\"text\" name='$name' value='$value'autocomplete=\"off\"placeholder='$placeholder'class=\"form-control\"id=\"inlineFormInnputGroup\" placeholder=\"Username\">                
           </div>    
    ";
    echo $ele;
}
/* Automate the creation of buttons */
function buttonElement($btnID,$styleClass,$text,$name,$atr){
  $btn="
  <button name='$name' '$atr' class='$styleClass'id='$btnID'>$text</button>
  ";
  echo $btn;  
}