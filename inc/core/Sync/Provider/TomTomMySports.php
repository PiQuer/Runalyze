<?php
namespace Runalyze\Sync\Provider;
use Runalyze\Sync\Provider\ActivitySyncInterface;
use Runalyze\Profile\Sync\SyncProvider;
use League\OAuth2\Client\Provider;
use KnpU\OAuth2ClientBundle\Client\OAuth2Client;

class TomTomMySports implements ActivitySyncInterface {

    /*
     * @var Provider\TomTomMySports
     */
    protected $client;

    /*
     * @var string $refreshToken
     */
    protected $refreshToken;

    /*
     * @var string $refreshToken
     */
    protected $accessToken;


    /**
     * Constructor
     * @param OAuth2Client $client
     * @param string $refreshToken
     */
    public function __construct(OAuth2Client $client, $refreshToken)
    {
        $this->client = $client;
        $this->accessToken = $refreshToken;
        $this->getAccessToken();
    }

    public static function getIdentifier() {
        return SyncProviderProfile::TOMTOM_MYSPORTS;
    }

    private function getAccessToken() {
        $accessToken = $this->client->getAccessToken('refresh_token', [
            'refresh_token' => $this->refreshToken
        ]);
        $this->accessToken = $accessToken->getToken();

    }

    /*
     * @link https://developer.tomtom.com/tomtom-sports-cloud/tomtom-sports-cloud-documentation/get-activity-list
     */
    public function fetchActivityList() {

        $url = Provider\TomTomMySports::BASE_MYSPORTS_URL.'1/activity';
        /** @var Provider\TomTomMySports */
        $request = $this->client->getAuthenticatedRequest('GET', $url, $this->accessToken);
        dump($request);

    }

    /*
     * @link https://developer.tomtom.com/tomtom-sports-cloud/tomtom-sports-cloud-documentation/get-startstop-activity
     */
    public function fetchActivity($identifier) {
        $url = Provider\TomTomMySports::BASE_MYSPORTS_URL.$identifier;
        $request = $this->client->getAuthenticatedRequest('GET', $url, $this->accessToken);

    }
}