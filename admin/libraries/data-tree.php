<?php
function data_tree($cat, $parent_id=0,$level = 0)
{
    $result=array();
    foreach ($cat as $k=>$value) {
        if ($value['parent_id'] == $parent_id) {
            $value['level'] = $level;
            $result[] = $value;
            unset($cat[$k]);
            $child = data_tree($cat, $value['id'],$level+1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}
