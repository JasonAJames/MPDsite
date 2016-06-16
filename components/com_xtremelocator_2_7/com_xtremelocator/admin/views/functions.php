<?php 
    function makeList($name,$elements,$active){
        $res='<select name="'.$name.'">';
        foreach($elements as $element=>$value){
            $res.='<option value="'.$value.'" '.($value==$active?'selected="selected"':'').'>'.$element.'</option>';
        }
        $res.='</select>';
        return $res;
    }
?> 