<?php 
if ($f == "load-my-blogs" && $wo['loggedin'] === true) {

    if($s == "more-blogs")
    {

            $html = '';
            $asd = $_GET['offset'];
//    dd($_GET['user_id']);


            $blogs = Wo_GetMyBlogs($_GET['user_id'], $_GET['offset']);

            if (count($blogs) > 0) {
                foreach ($blogs as $key => $wo['blog']) {
                    $html .= Wo_LoadPage('blog/includes/card-lg-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html
                );
            } else {
                $data = array(
                    'status' => 404
                );
            }
            header("Content-type: application/json");
            echo json_encode($data);
            exit();


    }

    $html  = '';
    $asd = $_GET['offset'];
//    dd($_GET);


    $blogs = Wo_GetMyBlogs($wo['user']['id'], $_GET['offset']);

    if (count($blogs) > 0) {
        foreach ($blogs as $key => $wo['blog']) {
            $html .= Wo_LoadPage('blog/includes/card-lg-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}

