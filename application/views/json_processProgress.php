
<?php

$response = array("stage" => $stage);

if (isset($error))
{
    $response["error"] = true;
    $response["errorMessage"] = $error;
    echo json_encode($response);
}
elseif ( ! isset($imgurl))
{
    $response["error"] = true;
    $response["errorMessage"] = "Internal error on server!  No image URL provided!";
    echo json_encode($response);
}
else
{
    $response["error"] = false;
    $response["html"] = "<img src='$imgurl' />";
    echo json_encode($response);
}

