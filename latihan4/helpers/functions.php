<?php
function is_select($var, $val)
{
    if ($var == $val) {
        return 'selected="selected"';
    }

    return false;
}
?>
