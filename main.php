<?php

$inviteInc = 0;
$serverName = "GD \"gc\"";

genInviteLink();

echo("Perma invite link generator by Lila2048! \n");
function genInviteLink() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    $increment = 0;

    global $inviteInc;
    global $serverName;

    for ($i = 0; $i < $charactersLength; $i++) {
        while($increment <= 10) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
        $increment++;
        }
    }
        $invite = "https://discord.com/invite/" . $randomString;
    
    $ch = curl_init($invite);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if(!str_contains(mb_strtolower($response), "rate limited")) {
        if(!str_contains(mb_strtolower($response), mb_strtolower($serverName))) {
            $inviteInc++;
            if(str_contains($response, "Discord - Group Chat")) {
                echo("Incorrect invite! Attempt " . $inviteInc . " invite: " . $invite . " Reason: invalid" ."\n");
            } else {
                echo("Incorrect invite! Attempt " . $inviteInc . " invite: " . $invite . " Reason: not right server" ."\n");
            }
            genInviteLink();
        } else  {
            die("invite found! Link: " . $invite . " attempts: " . $inviteInc);
        }
    } else {
        echo("Rate limited");
    }
}

?>
