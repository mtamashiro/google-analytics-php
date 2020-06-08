<?php
require_once __DIR__ . '/vendor/autoload.php';

class GAData
{
    private $analytics;
    private $profile_id;
    static $CREDENTIALS = __DIR__ . '/credentials.json';

    public function __construct()
    {
        $this->analytics = $this->initializeAnalytics();
    }

    private function initializeAnalytics()
    {

        $KEY_FILE_LOCATION = GAData::$CREDENTIALS;
        $client = new Google_Client();
        $client->setApplicationName("conexão com o google analytics API");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        return new Google_Service_Analytics($client);
    }

    public function set_profile_id($profile_id)
    {
        $this->profile_id = $profile_id;
    }

    public function get_profile_id()
    {
        return $this->profile_id;
    }

    public function is_profile_set()
    {
        return $this->profile_id == '' ? false : true;
    }


    public function get_results($start_date, $end_date, $metrics, $dimensions)
    {

        if (!$this->is_profile_set()) {
            throw new Exception('Profile ID deve estar configurado');
        }

        $metric_string = '';
        if (is_array($metrics)) {
            foreach ($metrics as $key => $metric) {
                $metric_string .= $metric_string;
                if ($key != (sizeof($metrics) - 1))
                    $metric_string .= ',';
            }
        }

        return $this->analytics->data_ga->get(
            'ga:' . $this->get_profile_id(),
            $start_date,
            //'today',
            $end_date,
            'ga:avgSessionDuration,ga:percentNewSessions,ga:pageviewsPerSession,ga:bounceRate,ga:users,ga:sessions,ga:pageViews',
            array(
                'dimensions' => 'ga:' . $dimensions
            ));
    }

    public function get_accounts()
    {
        $list = $this->analytics->management_accounts->listManagementAccounts();
        $accounts = $list->getItems();
        if (count($accounts) > 0) {
            return $accounts;
        } else {
            throw new Exception("Nenhuma conta do Google analytics está associada a conta do email");
        }
    }

    function get_account_profile_id($account_id)
    {

        $properties = $this->analytics->management_webproperties->listManagementWebproperties($account_id);
        if (count($properties->getItems()) > 0) {
            $items = $properties->getItems();
            $first_property_id = $items[0]->getId();
            $profiles = $this->analytics->management_profiles->listManagementProfiles($account_id, $first_property_id);

            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();
                return $items[0]->getId();
            } else {
                throw new Exception('Nenhuma visualização (perfis) encontrada para este usuário.');
            }
        } else {
            throw new Exception('Nenhuma propriedade encontrada para este usuário.');
        }

    }
}
