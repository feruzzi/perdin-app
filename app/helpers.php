<?php

use Carbon\Carbon;

function fDateDiff($start_, $end_)
{
    $start = Carbon::parse($start_);
    $end = Carbon::parse($end_);
    $diff = $start->diffInDays($end);
    return $diff;
}
function fFormatDate($date_)
{
    $date = Carbon::parse($date_)->format('d M Y');
    return $date;
}
function fTextTruncate($text_, $len)
{
    $text = substr($text_, 0, $len);
    if (strlen($text_) > $len) {
        $text = $text . '...';
        return $text;
    } else {
        return $text;
    }
}