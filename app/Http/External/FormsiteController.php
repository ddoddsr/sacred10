<?php

namespace App\Http\External;

use GuzzleHttp\Client;
use App\Http\Controllers\StaffController;

class FormsiteController
{

    protected $client;
    protected $headers ;
    public function __construct()
    {
        $this->client = new Client();
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('FORMSITE_TOKEN', '')
        ];
    }

    public function storeForms()
    {
        $formData = $this->getFormData();
        $staff = (new StaffController)->storeRecord($formData);
    }

    public function getFormMeta()
    {
        // formMeta (items) are the field id, postion and value
        // this output was used to make the array used in $this->fieldNames();
        logger("FormMeta");
        $response =  $this->client->request(
            'GET',
            env('FORMSITE_API_URL' ) . '/items',
            [
                'headers' => $this->headers
            ],
        );
        $contents = json_decode($response->getBody()->getContents());

        $itemMeta =  [];
        foreach( $contents as $content) {
            foreach( $content as $field) {
                // 'position'
                $itemMeta [$field->id] = $field->label ;
            }
        }
        logger($itemMeta);
    }
    public function getFormData()
    {

        $fieldNames = $this->fieldNames();
        $nextPage = 0;
        $lastPage = 0;
        $formData = [];

        do {
            $nextPage++ ;
            $response =  $this->client->request(
                'GET',
                env('FORMSITE_API_URL' ) . '/results',
                [
                    'query' =>
                    [
                        'limit' => env('FORMSITE_LIMIT'),
                        'after_date' => env('FORMSITE_AFTER_DATE'),
                      // TODO REMOVE before after testing
                        // 'before_date' => env('FORMSITE_BEFORE_DATE'),
                        'page' => $nextPage
                    ],
                    'headers' => $this->headers
                ],
            );

            if ($lastPage == 0 ){
                $lastPageStr = $response->getHeader('Pagination-Page-Last')[0];
                // TODO "Pagination-Page-Current"  could use for loop compare
                //"Pagination-Limit"
                $lastPage = (int)$lastPageStr;
            }

            $contents = json_decode($response->getBody()->getContents());
            foreach ($contents->results as $result) {
                $scheds = [];
                $sched = (object)[];

                 foreach($result->items as $item) {
                    // get the field number and look it up in $fieldNames
                    if (array_key_exists((int)$item->id,$fieldNames))
                    {
                        // set a Variable variable for the fieldName
                        $fieldName = $fieldNames[(int)$item->id];
                        //TODO treim leading, trailing and internal extra spaces
                        $$fieldName = $item->value ?? 'n_a' ;
                        $fieldName  = ${$fieldName} ;
                        if ( in_array((int)$item->id, array_keys($fieldNames, 'day' ))) {
                            if($item->values){
                                $sched->day = $item->values[0]->value ;
                            }
                        }
                        if ( in_array((int)$item->id, array_keys($fieldNames, 'start' ))) {
                            if($item->values){
                                $sched->start = $item->values[0]->value ;
                            }
                        }
                        if ( in_array((int)$item->id, array_keys($fieldNames, 'end' ))) {
                            if($item->values){
                                $sched->end = $item->values[0]->value ;
                                logger(['value' => $sched]);
                            }
                        }
                        if ( in_array((int)$item->id, array_keys($fieldNames, 'location' ))) {
                            if($item->values){
                                $sched->location = $item->values[0]->value ;
                                logger(['location' => $sched]);
                                // $scheds will be stored
                                $scheds[] = $sched;
                            }
                            // resest $sched
                            $sched = (object)[];
                        }

                    }
                    else
                    {
                        logger("Key " . $item->id . " does not exist!");
                    }

                 }

                $formData[] =
                    (object)[
                        'resultId' => $result->id,
                        'startDate' => $result->date_start,
                        'finishDate' => $result->date_finish,
                        'updateDate' => $result->date_update,
                        'resultStatus' => $result->result_status,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'designation' => $result->items[3]->values[0]->value,
                        'department' => $result->items[4]->value,
                        'supervisor' => $result->items[5]->value,
                        'superEmail1' => $result->items[6]->value,
                        'superEmail2' => $result->items[7]->value,
                        // 'pipetosomewhere' => $result->items[8]->value,
                        'effectiveDate' => $result->items[9]->value,
                        'sched' => $scheds ?? (object)[],
                    ];

            }

        } while ($lastPage != $nextPage);

        return $formData;
    }

    private function fieldNames() {
        return [
            92 => 'firstName',
            93 => 'lastName',
            91 => 'emailAddress',
            217 => 'designation',
            214 => 'department',
            173 => 'supervisor',
            212 => 'superEmail1',
            229 => 'superEmail2',
            231 => 'superEmail',
            213 => 'effective',
            5   => 'day',
            114 => 'start',
            115 => 'end',
            8   => 'location',
            116 => 'day',
            117 => 'start',
            118 => 'end',
            119 => 'location',
            120 => 'day',
            121 => 'start',
            122 => 'end',
            123 => 'location',
            124 => 'day',
            125 => 'start',
            126 => 'end',
            127 => 'location',
            128 => 'day',
            129 => 'start',
            130 => 'end',
            131 => 'location',
            132 => 'day',
            133 => 'start',
            134 => 'end',
            135 => 'location',
            136 => 'day',
            137 => 'start',
            138 => 'end',
            139 => 'location',
            140 => 'day',
            141 => 'start',
            142 => 'end',
            143 => 'location',
            145 => 'day',
            146 => 'start',
            147 => 'end',
            148 => 'location',
            149 => 'day',
            150 => 'start',
            151 => 'end',
            152 => 'location',
            153 => 'day',
            154 => 'start',
            155 => 'end',
            156 => 'location',
            157 => 'day',
            158 => 'start',
            159 => 'end',
            160 => 'location',
            161 => 'day',
            162 => 'start',
            163 => 'end',
            164 => 'location',
            165 => 'day',
            166 => 'start',
            167 => 'end',
            168 => 'location',
            169 => 'day',
            170 => 'start',
            171 => 'end',
            172 => 'location',
// not storing these below
              17 => 'Total Hours :',
              88 => 'Service Hours',
              '88-0' => '1',
              '88-1' => '2',
              '88-2' => '3',
              '88-3' => '4',
              '88-4' => '5',
              228 => 'Name',
              196 => '.',
              197 => '.',
              198 => '.',
              199 => '.',
              201 => '.',
              202 => '.',
              203 => '.',
              204 => '.',
              205 => '.',
              206 => '.',
              207 => '.',
              209 => '.',
              210 => '.',
              208 => '.',
              211 => '.',
              223 => 'By the grace of God, I make the following commitments:',
              111 => 'Today\'s Date',
              110 => 'Signature',
        ];
    }
}
