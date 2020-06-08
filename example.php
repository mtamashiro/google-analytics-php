<?php

require_once __DIR__ . '\GAData.php';

$google_analytics = new GAData();
$accounts = $google_analytics->get_accounts();

$profile_id = $google_analytics->get_account_profile_id($accounts[0]->id);
$google_analytics->set_profile_id($profile_id);


$today = DateTime::createFromFormat('d. m. Y.', date('d. m. Y.'));
$start_date = $today->sub(new DateInterval('P24M'));
$end_date = DateTime::createFromFormat('d. m. Y.', date('d. m. Y.'));

//todas as metricas e dimensões podem ser pesquisadas em https://ga-dev-tools.appspot.com/dimensions-metrics-explorer/
$dimension = 'yearMonth';
$metrics = [];
$metrics[] = 'ga:avgSessionDuration';
$metrics[] = 'ga:percentNewSessions';
$metrics[] = 'ga:pageviewsPerSession';
$metrics[] = 'ga:bounceRate';
$metrics[] = 'ga:users';
$metrics[] = 'ga:sessions';
$metrics[] = 'ga:pageViews';


try {
    $result = $google_analytics->get_results($start_date->format('Y-m-d'), $end_date->format('Y-m-d'), $metrics, $dimension);
} catch (Exception $e) {
    echo $e;
}



