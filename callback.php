<?php
global $size;
global $response2;
global $structure;
global $provider;

require_once('C:\wamp64\www\topline\vendor\autoload.php');
include 'C:\wamp64\www\topline\getfuel.php';
include 'C:\wamp64\www\topline\getnames.php';
include 'C:\wamp64\www\topline\idtoname.php';
session_start();
$provider = new Evelabs\OAuth2\Client\Provider\EveOnline([
    'clientId'          => 'e707ab60f6cc48e09c0219071e9c4288',
    'clientSecret'      => 'spQt8uO8lBbUJjbOSkJ6kKyEiIy9mWKaukG2tusc',
    'redirectUri'       => 'http://localhost/topline/callback.php',
]);
if (!isset($_GET['code'])) {
    // here we can set requested scopes but it is totally optional
    // make sure you have them enabled on your app page at
    // https://developers.eveonline.com/applications/
    $options = [
        'scope' => ['publicData','esi-corporations.read_structures.v1','esi-corporations.read_corporation_membership.v1','esi-universe.read_structures.v1'] // array or string
    ];
    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    unset($_SESSION['token']);
    header('Location: '.$authUrl);
    exit;
// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    // In this example we use php native $_SESSION as data store
    if(!isset($_SESSION['token']))
    {
        // Try to get an access token (using the authorization code grant)
        $_SESSION['token'] = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
    }elseif($_SESSION['token']->hasExpired()){
        // This is how you refresh your access token once you have it
        $new_token = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $_SESSION['token']->getRefreshToken()
        ]);
        // Purge old access token and store new access token to your data store.
        $_SESSION['token'] = $new_token;
    }

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($_SESSION['token']);
        // Use these details to create a new profile
        printf('Hello %s! ', $user->getCharacterName());
    } catch (\Exception $e) {
        // Failed to get user details
        exit('Oh dear...');
    }
    // Use this to interact with an API on the users behalf
    printf('Your access token is: %s', $_SESSION['token']->getToken());
  $request = $provider->getAuthenticatedRequest(
    'GET',
    'https://esi.evetech.net/v2/corporations/98491666/structures/',
   $_SESSION['token']->getToken()
    );


    $response = $provider->getResponse($request);


}
$fuelID = getfuel($response);


$key2 =  array_column($response, 'structure_id');


$i=0;

foreach($key2 as $size){

        $id = $key2[$i];

  $request = $provider->getAuthenticatedRequest(
    'GET',
    'https://esi.evetech.net/v2/universe/structures/'.$id,
   $_SESSION['token']->getToken()
    );

echo  nl2br ("\n");
echo  nl2br ("\n");

    $response2 = $provider->getResponse($request);



$i++;


print_r($response2["name"]);
print_r("   ");


print_r($fuelID["date"]);
print_r("   ");

}

 // get memeber ID


$request = $provider->getAuthenticatedRequest(
  'GET',
  'https://esi.evetech.net/latest/corporations/98491666/members/',
 $_SESSION['token']->getToken()
  );

$response3 = $provider->getResponse($request);
echo  nl2br ("\n");
echo  nl2br ("\n");


// get member names
$o=0;

foreach ($response3 as $Temp2){

//print_r ($response3[$o]);
echo  nl2br ("\n");
echo  nl2br ("\n");
$ID = $response3[$o];
//print_r ($ID);
$o++;

$namestore;

$namestore=getnameId($ID);
print_r($namestore);

}
