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

function fCalculateDistance($trip)
{
    $latitudeFrom = $trip->origin_city->lat;
    $longitudeFrom = $trip->origin_city->long;
    $latitudeTo = $trip->destination_city->lat;
    $longitudeTo = $trip->destination_city->long;
    // convert from degrees to radians
    $earthRadius = 6371;
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    $result = number_format($angle * $earthRadius, 2, ',', '');
    return $result;
}

// function fCalculateAllowance($distance, $s_province, $e_province, $s_island, $e_island, $cs_inter, $ce_inter, $dateDiff)
// {
//     if ($cs_inter == 0 && $ce_inter == 0) {
//         $international = "0";
//     } else {
//         $international = "1";
//     }
//     $distance = (int)$distance;
//     $currency = "IDR";
//     $fmt = new NumberFormatter('id_IDN', NumberFormatter::CURRENCY);
//     if ($distance > 60 && $s_province == $e_province && $international == "0") {
//         $allowance = 200000;
//     } elseif ($distance > 60 && $s_province != $e_province && $s_island == $e_island && $international == "0") {
//         $allowance = 250000;
//     } elseif ($distance > 60 && $s_province != $e_province && $s_island != $e_island && $international == "0") {
//         $allowance = 300000;
//     } elseif ($international == "1") {
//         $allowance = 50;
//         $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
//         $currency = "USD";
//         // return $fmt->formatCurrency($allowance, "USD") . "\n";
//     } elseif ($distance < 60 && $international == "0") {
//         $allowance = 0;
//         // return $fmt->formatCurrency($allowance, "IDR") . "\n";
//     }
//     $total = $dateDiff * $allowance;
//     return ([
//         'allowance' => $fmt->formatCurrency($allowance, $currency) . "\n",
//         'total' => $fmt->formatCurrency($total, $currency) . "\n"
//     ]);
// }
function fCalculateAllowance($trip, $distance, $dateDiff)
{
    $s_province = $trip->origin_city->province;
    $e_province = $trip->destination_city->province;
    $s_island = $trip->origin_city->island;
    $e_island = $trip->destination_city->island;
    $cs_inter = $trip->origin_city->international;
    $ce_inter = $trip->destination_city->international;

    if ($cs_inter == 0 && $ce_inter == 0) {
        $international = "0";
    } else {
        $international = "1";
    }
    $distance = (int)$distance;
    $currency = "IDR";
    $fmt = new NumberFormatter('id_IDN', NumberFormatter::CURRENCY);
    if ($distance > 60 && $s_province == $e_province && $international == "0") {
        $allowance = 200000;
    } elseif ($distance > 60 && $s_province != $e_province && $s_island == $e_island && $international == "0") {
        $allowance = 250000;
    } elseif ($distance > 60 && $s_province != $e_province && $s_island != $e_island && $international == "0") {
        $allowance = 300000;
    } elseif ($international == "1") {
        $allowance = 50;
        $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        $currency = "USD";
        // return $fmt->formatCurrency($allowance, "USD") . "\n";
    } elseif ($distance < 60 && $international == "0") {
        $allowance = 0;
        // return $fmt->formatCurrency($allowance, "IDR") . "\n";
    }
    $total = $dateDiff * $allowance;
    return ([
        'allowance' => $fmt->formatCurrency($allowance, $currency) . "\n",
        'total' => $fmt->formatCurrency($total, $currency) . "\n"
    ]);
}