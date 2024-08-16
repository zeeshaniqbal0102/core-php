<?php

if ($f == "insert-event")
{

//    $time=  date("H:i", strtotime($_POST['event-end-time']));
//    print_r($time);
//    die();
    if (Wo_CheckSession($hash_id) === true)
    {
//        dd($_POST);
        if (empty($_POST['event_name']) ) {
            $error[] = $error_icon . "Please Check Name"."<br>";
        }



            if (empty($_POST['event_locat'])) {
                $error[] = $error_icon . "Please Check Location"."<br>";
            }
            if (empty($_POST['event_description'])) {
                $error[] = $error_icon . "Please Check Description"."<br>";

            }
//            if (strlen($_POST['event-name']) < 3) {
//                $error[] = $error_icon . $wo['lang']['title_more_than10']."<br>";
//            }
//            if (strlen($_POST['event-description']) < 32) {
//                $error[] = $error_icon . $wo['lang']['desc_more_than32']."<br>";
//            }

            if (empty($_POST['event_start_date'])) {
                $error[] = $error_icon . "Please Check Start Date"."<br>";
            }
            if (empty($_POST['event_end_date'])) {
                $error[] = $error_icon . "Please Check End Date"."<br>";
            }
            if (empty($_POST['event_start_time'])) {
                $error[] = $error_icon . "Please Check Start Time"."<br>";

            }
            if (empty($_POST['event_end_time'])) {
                $error[] = $error_icon . "Please Check End Time";
            }


            $error[] = Wo_MaxField($_POST['event_name'],"Event Name");
            $error[] = Wo_MaxField($_POST['event_locat'],"Event Location", 50);

//        $error[] = Wo_MaxField($_POST['event-start-date'],"Event start date");
//        $error[] = Wo_MaxField($_POST['event-start-time'],"Event start time");
//        $error[] = Wo_MaxField($_POST['event-end-date'],"Event end date");
//        $error[] = Wo_MaxField($_POST['event-end-time'],"Event end time");

            $error[] = Wo_MaxField($_POST['event_description'],"Event Description", 800);
        $error= array_filter($error);

        if (empty($error)) {
            $registration_data = array(
                'name' => Wo_Secure($_POST['event_name']),
                'location' => Wo_Secure($_POST['event_locat']),
                'description' => Wo_Secure($_POST['event_description']),
                'start_date' => Wo_Secure( date('Y-m-d', strtotime($_POST['event_start_date']))),
                'start_time' =>  date("H:i", strtotime($_POST['event_start_time'])),
                'end_date' => Wo_Secure( date('Y-m-d', strtotime($_POST['event_end_date']))),
                'end_time' =>date("H:i", strtotime($_POST['event_end_time'])),
//                'event_type' => Wo_Secure($_POST['event-kind']),
                'poster_id' => $wo['user']['id'],
                'campaign_id' => $_POST['campaign-id'],
                'is_draft' => $_POST['is_draft']
            );
            $last_id           = Wo_InsertEvent($registration_data);

            if ($last_id && is_numeric($last_id)) {
                if (!empty($_FILES["event-cover"]["tmp_name"])) {
                    $temp_name = $_FILES["event-cover"]["tmp_name"];
                    $file_name = $_FILES["event-cover"]["name"];
                    $file_type = $_FILES['event-cover']['type'];
                    $file_size = $_FILES["event-cover"]["size"];
                    Wo_UploadImage($temp_name, $file_name, 'cover', $file_type, $last_id, 'event');
                }
                if($_POST['is_draft'] == 1)
                {
                    $data = array(
                        'message' => $success_icon . $wo['lang']['event_added'],
                        'status' => 200,
                        'url' => Wo_SeoLink("index.php?link1=show-event&eid=" . $last_id)
                    );
                }
                else{
                    $data = array(
                        'message' => $success_icon . "Event Saved",
                        'status' => 200,
                        'url' => $wo['site_url']."/events/saved"
                    );
                }
            }
        }
        else {
            $data = array(
                'status' => 500,
                'message' =>implode(" ", $error)
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
