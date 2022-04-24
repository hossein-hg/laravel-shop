<?php
function jalaliDate($date , $format = '%B %d، %Y')
{
    return \Morilog\Jalali\Jalalian::forge($date)->format($format);
}
