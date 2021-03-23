<?php


namespace App\BL;


use App\ExDiary;

class CreateDiaryEntries
{
    public function Create( int $userid, string $startdate, int $numweeks = 12, int $daysperweek = 7 ) {
        $startDate = new \DateTime( $startdate );
        for( $i = 1; $i <= $numweeks; $i++ ) {
            for ( $j = 1; $j <= $daysperweek; $j++ ) {
                $day = ((($i-1)*7) + $j - 1);
                $startDate = new \DateTime( $startdate );
                $calcDate = $startDate->add(new \DateInterval('P' . $day . 'D'));
                $entry = new ExDiary();
                $entry->userid = $userid;
                $entry->week = $i;
                $entry->day = $j;
                $entry->calcdate = $calcDate->format('Y-m-d');
                $entry->stretchingdone = -1;
                $entry->strengtheningdone = -1;
                $entry->notes = "";
                $entry->save();
            }
        }
    }
}
