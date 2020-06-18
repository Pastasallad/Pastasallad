<?php

// https://xpider.sj.se/grafisktur42.php?man=true&datum=2018-10-30&persKat=lokf&persID=11270
// T = 11270
// B = 11370
// H = 11395
// R = 12260

define('IDS', ['11270', '11370', '11395', '12260']);
define('DATES', getDates());
define('LINK', ['https://xpider.sj.se/grafisktur42.php?man=true&datum=','&persKat=lokf&persID=']);

$dateArray = getDates();
$linkArray = array("https://xpider.sj.se/grafisktur42.php?man=true&datum=",
              "&persKat=lokf&persID=");

$personLinks = getLinks();

//Initiate cURL.
$curl = curl_init();
connect();

foreach($personLinks as $id=>$links) {
    foreach ($links as $i=>$link) {
        saveImage($link, $id, $i);
    }
}

// Returns array with today and 5 following dates.
function getDates() {
    // Set timezone
    date_default_timezone_set('Europe/Stockholm');
    // Current date
    $date = date('Y-m-d');
    
    for ($i = 0; $i < 6; $i++) {
        $date = strtotime("+$i day");
        $out[$i] = date('Y-m-d', $date);
    }
    
    return $out;
}

// Return links for each day for the id
function getLinks() {
    
    foreach (IDS as $id) {
        for ($i = 0; $i < 6; $i++) {
        $out[$i] = LINK[0] . DATES[$i] . LINK[1] . $id;
        }
        $links[$id] = $out;
    }
    
    return $links;
}

function connect() {
    global $curl;
    //The username or email address of the account.
    define('USERNAME', 'Fi448y');

    //The password of the account.
    define('PASSWORD', 'Kalle020');

    //Set a user agent. This basically tells the server that we are using Chrome ;)
    define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

    //Where our cookie information will be stored (needed for authentication).
    define('COOKIE_FILE', 'cookie.txt');

    //URL of the login form.
    define('LOGIN_FORM_URL', 'https://xpider.sj.se/login.php');

    //Login action URL. Sometimes, this is the same URL as the login form.
    define('LOGIN_ACTION_URL', 'https://xpider.sj.se/login.php');


    //An associative array that represents the required form fields.
    //You will need to change the keys / index names to match the name of the form
    //fields.
    $postValues = array(
        'user' => USERNAME,
        'pass' => PASSWORD
    );

    //Initiate cURL.
    //$curl = curl_init();

    //Set the URL that we want to send our POST request to. In this
    //case, it's the action URL of the login form.
    curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);

    //Tell cURL that we want to carry out a POST request.
    curl_setopt($curl, CURLOPT_POST, true);

    //Set our post fields / date (from the array above).
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));

    //We don't want any HTTPS errors.
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    //Where our cookie details are saved. This is typically required
    //for authentication, as the session ID is usually saved in the cookie file.
    curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

    //Sets the user agent. Some websites will attempt to block bot user agents.
    //Hence the reason I gave it a Chrome user agent.
    curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

    //Tells cURL to return the output once the request has been executed.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //Allows us to set the referer header. In this particular case, we are 
    //fooling the server into thinking that we were referred by the login form.
    curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);

    //Do we want to follow any redirects?
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);

    //Execute the login request.
    curl_exec($curl);

    //Check for errors!
    if(curl_errno($curl)){
        throw new Exception(curl_error($curl));
    }
}

function saveImage($url, $id, $nr) {
    global $curl;
    //We should be logged in by now. Let's attempt to access a password protected page
    curl_setopt($curl, CURLOPT_URL, $url);

    //Use the same cookie file.
    curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

    //Use the same user agent, just in case it is used by the server for session validation.
    curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

    //We don't want any HTTPS / SSL errors.
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    //Execute the GET request and print out the result.
    $current = curl_exec($curl);

    //Where to save
    $file = 'img/' . $id . '_' . $nr . '.png';
    file_put_contents($file, $current);
}

header('Location: index.php');
?>