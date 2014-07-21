<?php
include './config.php';
include './transaction_history_parser.php';

/*******************************************
 get_offers.php
 Author: Mohit Kumar
 
 Arguments:
 $card_numbers := json encoded string with each element having key as "card_number" and value
                    as the debit/credit card number of the user
                    
********************************************/

// for debugging purposes
// $card_numbers = '[{"card_number":"5701042908"},{"card_number":"3805003752"}]';

class get_offers
{
    public $card_numbers = [];          // list to hold card numbers of users
    public $offers = array();           // to hold the combined offers of all the users
    
    // constructor function
    function get_offers($card_numbers)
    {
        // extract the different card numbers from the packet supplied as an argument
        $this->extract_card_numbers($card_numbers);
        
        // pack offers for all users in one packet
        $this->pack_offers();
        
        // for debugging purposes only
        // $this->get_encoded_offers();
        
    }
    
    // extracts card numbers for individual user from packet
    function extract_card_numbers($card_numbers)
    {
        $data = json_decode($card_numbers);
        foreach($data as $user_data)
        {
            $this->card_numbers[] = $user_data->card_number;
        }
    }
    
    // get the offers for each user and pack them together in one packet ready to send
    function pack_offers()
    {
        foreach($this->card_numbers as $card_number)
        {
            $thp = new transaction_history_parser($card_number);
            $this->offers[$card_number] = $thp->get_rec_offers();
        }   
    }
    
    // prints all the offers , used for debugging purposes
    function print_offers()
    {
        foreach($this->offers as $card_number=>$offers)
        {
            echo $card_number."--------->"."<br>";
            foreach($offers as $offer)
            {
                echo $offer."<br>";
            }
        }
    }
    
    // get the json encoded packet of offers
    function get_encoded_offers()
    {
        return json_encode($this->offers);
    }
}

//for debugging purposes only
//$obj = new get_offers($card_numbers);

?>