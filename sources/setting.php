<?php
if ($wo['loggedin'] == false) {
    header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
    exit();
}
$user_id =  $wo['user']['user_id'];
$wo["word_filter"]= Wo_GetAllData(T_USER_WORD_FILTER , " user_id = '$user_id' " );
$wo['relation_status']     = array(0=>"Select Relationship",1=>"Single","Married","Divorced","In a relationship","Open for one","Not Interested","Widow","Widower", "Complicated");
$wo["looking_for"] = array(0=>"Select one",1=>"Men","Women","Friends");
$wo["politic_view"] = array(0=>"Select one",1=>"Very Conservative","Conservative","Middle of the road","Liberal", "Very Liberal", "Not at all");

$wo["food_enjoyed"]= Wo_GetAllData(T_FOOD_ENJOYED);
$wo["user_food_enjoyed"]= Wo_GetSelectedData(T_USER_ENJOYED_FOOD);
$wo["books"]= Wo_GetAllData(T_BOOKS);
$wo["user_books"]= Wo_GetSelectedData(T_USER_BOOK);
$wo["movies_s"]= Wo_GetAllData(T_MOVIES_S);
$wo["user_movies"]= Wo_GetSelectedData(T_USER_MOVIES);
$wo["likes_s"]= Wo_GetAllData(T_LIKES_S);
$wo["user_likes"]= Wo_GetSelectedData(T_USER_LIKES);
$wo["dislikes"]= Wo_GetAllData(T_DISLIKES);
$wo["user_dislikes"]= Wo_GetSelectedData(T_USER_DISLIKE);
$wo["language_spoken"]= Wo_GetAllData(T_LANGUAGE_SPOKEN);
$wo["user_language_spoken"]= Wo_GetSelectedData(T_USER_LANGUAGE_SPOKEN);
$wo["interests_hobbies"]= Wo_GetAllData(T_INTERESTS_HOBBIES);
$wo["user_interests_hobbies"]= Wo_GetSelectedData(T_USER_INTEREST_HOBBIES);
$wo["followers"]= Wo_GetFriends();
$wo["friends_timeline_post"]= Wo_GetSelectedData(T_FRIENDS_TIMELINE);

$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'setting';
$wo['title']       = $wo['lang']['setting'] . ' | ' . $wo['config']['siteTitle'];
$wo['content']     = Wo_LoadPage('setting/content');