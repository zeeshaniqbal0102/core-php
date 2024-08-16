<?php

//print_r($_POST);
//die();
if ($f == "insert-campaign-endorsement") {
    if (Wo_CheckSession($hash_id) === true)
    {

        if (empty($_POST['endorsement-review']))
        {
            $error = $error_icon . "Please Enter Review";
        }
        if (empty($_POST['rate']))
        {
            $error = $error_icon . "Please Enter Rating";
        }
//        else
//        {
//            if (strlen($_POST['event-name']) < 10) {
//                $error = $error_icon . $wo['lang']['title_more_than10'];
//            }
//            if (strlen($_POST['event-description']) < 10) {
//                $error = $error_icon . $wo['lang']['desc_more_than32'];
//            }
//            if (empty($_POST['event-start-date'])) {
//                $error = $error_icon . $wo['lang']['please_check_details'];
//            }
//            if (empty($_POST['event-end-date'])) {
//                $error = $error_icon . $wo['lang']['please_check_details'];
//            }
//            if (empty($_POST['event-start-time'])) {
//                $error = $error_icon . $wo['lang']['please_check_details'];
//            }
//            if (empty($_POST['event-end-time'])) {
//                $error = $error_icon . $wo['lang']['please_check_details'];
//            }
//        }
        if (empty($error))
        {
            $review_data = array(
                'campaign_id' => Wo_Secure($_POST['campaign_id']),
                'user_id' => $wo["user"]["user_id"],
                'review' => Wo_Secure($_POST['endorsement-review']),
                'rating' => Wo_Secure($_POST['rate'])
            );
            $last_id  = Wo_Insertcampaignreview($review_data);

            if($last_id && is_numeric($last_id))
            {
                $data = array(
                    'message' => $success_icon . "Review has been submitted",
                    'status' => 200
                );
            }
        }
        else
        {
            $data = array(
                'status' => 500,
                'message' => $error
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
