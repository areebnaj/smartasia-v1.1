<?php

include ('config/dbcon.php');

function getAll ($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function getAllActive($table)
{
    global $con;
    $query ="SELECT * FROM $table WHERE status='0'";
    return $query_run = mysqli_query($con, $query);
}
