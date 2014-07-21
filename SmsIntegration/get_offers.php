<?php
include './config.php';
include './transaction_history_parser.php';

// This file is for handling the request for multiple users

$card_numbers = '[{"card_number":"5701042908"},{"card_number":"3805003752"}]';

class get_offers
{
    public $card_numbers = [];          // list to hold card numbers of users
    public $offers = array();
    
    function get_offers($card_numbers)
    {
        // extract the different card numbers from the packet
        $this->extract_card_numbers($card_numbers);
        
        // pack offers for all users in one packet
        $this->pack_offers();
        foreach($this->offers as $item)
        {
            //echo $item."<br>";
        }
        
        echo json_encode($this->offers);
    }
    
    function extract_card_numbers($card_numbers)
    {
        $data = json_decode($card_numbers);
        foreach($data as $user_data)
        {
            $this->card_numbers[] = $user_data->card_number;
        }
    }
    
    function pack_offers()
    {
        foreach($this->card_numbers as $card_number)
        {
            $thp = new transaction_history_parser($card_number);
            $this->offers[$card_number] = $thp->get_rec_offers();
        }   
    }
}

$obj = new get_offers($card_numbers);

?>