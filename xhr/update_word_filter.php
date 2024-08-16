<?php


if ( Wo_CheckSession($hash_id) === true) {



    if (isset($_POST['user_id'])) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {


            $words = $_POST["word"];
            $wordsReal=  $_POST["word"];
            $words_unique = array_unique($_POST["word"]);


            if (count($words) == count($words_unique)){
                Wo_delete_word_filter(Wo_Secure($_POST['user_id']));

            foreach ($words as $key => $word) {


                if (isset($word) && isset($_POST['replace'][$key])) {
                    $data["word"] = Wo_Secure($word);
                    $data["replace"] = Wo_Secure($_POST['replace'][$key]);
                    $data["user_id"] = Wo_Secure($_POST['user_id']);
                    Wo_insert($data, T_USER_WORD_FILTER);


                }

            }
            $data = array(
                'status' => 200);
        }else{




                function array_duplicates(array $array)
                {
                    return array_diff_assoc($array, array_unique($array));
                }


                $duplicates = array_duplicates($wordsReal);


                $repeatingWords= implode(", " , $duplicates);

                $data = array(
                    'status' => 402,
                'message'=>"$repeatingWords should not be repeat." );
            }
    }
    }

    header("Content-type: application/json");
    echo json_encode($data);
    exit();

}