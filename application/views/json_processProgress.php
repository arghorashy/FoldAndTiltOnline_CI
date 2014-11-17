
<?php

$response = array("stage" => $stage);

if (isset($error))
{
    $response["error"] = true;
    $response["errorMessage"] = $error;
    echo json_encode($response);
}
// elseif ( ! isset($imgurl))
// {
//     $response["error"] = true;
//     $response["errorMessage"] = "Internal error on server!  No image URL provided!";
//     echo json_encode($response);
// }
else
{
    $response["error"] = false;

    if ($stage == "upload")
    {
        $response["imghtml"] = "<img class='resize' src='$imgurl' />";
        $response["sendback"] = $sendback;
    }
    elseif ($stage == "FnT")
    {
        $response["imgplushtml"] = "<img class='resize' src='$plusimgurl' />";
        $response["imgminushtml"] = "<img class='resize' src='$minusimgurl' />";
    }
    echo json_encode($response);

}

