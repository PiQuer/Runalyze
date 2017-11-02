<?php
namespace Runalyze\Sync\Provider;
use Runalyze\Bundle\CoreBundle\Entity\AccountClient;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientRepository;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientSettingsRepository;
use Runalyze\Sync\Provider\ActivitySyncInterface;
use Runalyze\Profile\Sync\SyncProvider;
use League\OAuth2\Client\Provider;
use KnpU\OAuth2ClientBundle\Client\OAuth2Client;

class TomTomMySports implements ActivitySyncInterface {

    /** @var Provider\TomTomMySports */
    protected $client;

    /** @var string $refreshToken */
    protected $refreshToken;

    /** @var string $refreshToken */
    protected $accessToken;

    /** @var AccountClientRepository */
    protected $AccountClientRepository;

    /** @var AccountClientSettingsRepository */
    protected $AccountClientSettingsRepository;


    /**
     * Constructor
     *
     * @param AccountClientRepository $accountClient
     * @param AccountClientSettingsRepository $accountClient
     * @param OAuth2Client $client
     */
    public function __construct(AccountClientRepository $accountClient, AccountClientSettingsRepository $accountClientSettings, OAuth2Client $client)
    {
        $this->AccountClientRepository = $accountClient;
        $this->AccountClientSettingsRepository = $accountClientSettings;
        $this->client = $client;
    }

    public function setRefreshToken($refreshToken) {
        $this->refreshToken = $refreshToken;
    }

    public static function getIdentifier() {
        return SyncProviderProfile::TOMTOM_MYSPORTS;
    }

    private function getAccessToken()
    {
        if (empty($accessToken)) {
            $accessToken = $this->client->getAccessToken('refresh_token', [
                'refresh_token' => $this->refreshToken
            ]);
            $this->accessToken = $accessToken->getToken();
        }

    }

    /*
     * @link https://developer.tomtom.com/tomtom-sports-cloud/tomtom-sports-cloud-documentation/get-activity-list
     */
    public function fetchActivityList()
    {
        $this->getAccessToken();

        $url = Provider\TomTomMySports::BASE_MYSPORTS_URL.'1/activity';
        /** @var Provider\TomTomMySports */
        $request = $this->client->getAuthenticatedRequest('GET', $url, $this->accessToken);
        dump($request);

    }

    private function getResponse() {
        return json_decode('
{
    "activities": [
        {
            "local_start_datetime": "2016-09-22T11:54:20+02:00",
            "activity_type": "trail_running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjzFjTS0Hoj2zzTUOem6cKo_4=",
            "aggregates": {
                "active_time_total": 753,
                "distance_total": 1112.7,
                "steps_total": 1405,
                "elapsed_time_total": 753,
                "metabolic_energy_total": 401664,
                "speed_avg": 1.48,
                "climb_total": 20,
                "descent_total": 19,
                "heartrate_avg": 83.84,
                "gradient_min": -0.14,
                "hrz_dist": [
                    754,
                    0,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 744,
                "moving_speed_avg": 1.5
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_be789cf20bab5cd74e15874433?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_be789cf20bab5cd74e15874433?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-22T11:54:19+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjzg-YKFpxYKicDjF7aGaBqAU=",
            "aggregates": {
                "active_time_total": 752,
                "distance_total": 1114.77,
                "steps_total": 1406,
                "elapsed_time_total": 751,
                "metabolic_energy_total": 405848,
                "speed_avg": 1.48,
                "climb_total": 26.79,
                "descent_total": 29.7,
                "heartrate_avg": 105.53,
                "hrz_dist": [
                    465,
                    287,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 739,
                "moving_speed_avg": 1.51
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_eec67cb201a89b080f432b5590?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_eec67cb201a89b080f432b5590?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-12T11:53:42+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjyPZFjXbbUOQty6ZVfCQctAg=",
            "aggregates": {
                "active_time_total": 3148,
                "distance_total": 6160.26,
                "steps_total": 6911,
                "elapsed_time_total": 3148,
                "metabolic_energy_total": 2539688,
                "speed_avg": 1.96,
                "climb_total": 134.78,
                "descent_total": 131.8,
                "heartrate_avg": 105.8,
                "hrz_dist": [
                    2415,
                    733,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3134,
                "moving_speed_avg": 1.97
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f3e7d0297788ebbd3191cd009e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_f3e7d0297788ebbd3191cd009e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-12T11:53:40+02:00",
            "activity_type": "hiking",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjyqEO7m1CvyBCiNSwj-WXv_M=",
            "aggregates": {
                "active_time_total": 3147,
                "distance_total": 5972.93,
                "steps_total": 7045,
                "elapsed_time_total": 3145,
                "metabolic_energy_total": 1405824,
                "speed_avg": 1.9,
                "climb_total": 176,
                "descent_total": 175,
                "heartrate_avg": 122.57,
                "gradient_min": -0.32,
                "hrz_dist": [
                    490,
                    2035,
                    610,
                    12,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a005d6b9101a11c11ece2dbb26?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_a005d6b9101a11c11ece2dbb26?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-09-09T12:31:43+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjxpC1pDQW37khA_rsp2Cth-g=",
            "aggregates": {
                "active_time_total": 2682,
                "distance_total": 6164.46,
                "steps_total": 6298,
                "elapsed_time_total": 2681,
                "metabolic_energy_total": 2686128,
                "speed_avg": 2.3,
                "climb_total": 131.7,
                "descent_total": 132.3,
                "heartrate_avg": 120.11,
                "hrz_dist": [
                    595,
                    1634,
                    453,
                    0,
                    0
                ],
                "moving_time_total": 2682,
                "moving_speed_avg": 2.3
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0d7e3e0891e69a9dbc2da83b51?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0d7e3e0891e69a9dbc2da83b51?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-09T12:31:42+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjx1oQFbnaKFsWokOeXoBoAhU=",
            "aggregates": {
                "active_time_total": 2681,
                "distance_total": 6081.37,
                "steps_total": 6791,
                "elapsed_time_total": 2680,
                "metabolic_energy_total": 2581528,
                "speed_avg": 2.27,
                "climb_total": 130.45,
                "descent_total": 135.78,
                "heartrate_avg": 122.16,
                "hrz_dist": [
                    639,
                    1527,
                    515,
                    0,
                    0
                ],
                "moving_time_total": 2672,
                "moving_speed_avg": 2.28
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_501cbea61722ad1de77246a359?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_501cbea61722ad1de77246a359?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-07T11:58:09+02:00",
            "activity_type": "trail_running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjwj4jYgMlADH_hR8nQOO7kB4=",
            "aggregates": {
                "active_time_total": 2718,
                "distance_total": 6183.99,
                "steps_total": 6405,
                "elapsed_time_total": 2787,
                "metabolic_energy_total": 2552240,
                "speed_avg": 2.28,
                "climb_total": 178,
                "descent_total": 182,
                "heartrate_avg": 116.59,
                "gradient_min": -0.29,
                "hrz_dist": [
                    904,
                    1383,
                    431,
                    0,
                    0
                ],
                "moving_time_total": 2699,
                "moving_speed_avg": 2.29
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_40da6bd6082ef96ca4748eb483?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_40da6bd6082ef96ca4748eb483?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-07T11:58:07+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj3vPDMIa-HovmFaZU9mrZ994=",
            "aggregates": {
                "active_time_total": 2711,
                "distance_total": 6158.6,
                "steps_total": 6389,
                "elapsed_time_total": 2711,
                "metabolic_energy_total": 2732152,
                "speed_avg": 2.27,
                "climb_total": 133.09,
                "descent_total": 132.56,
                "heartrate_avg": 117.28,
                "hrz_dist": [
                    840,
                    1417,
                    452,
                    3,
                    0
                ],
                "moving_time_total": 2701,
                "moving_speed_avg": 2.28
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8876b50093b56d05467602e108?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8876b50093b56d05467602e108?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-05T11:28:54+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj3zlmgQty6WnRtB8mD4occiM=",
            "aggregates": {
                "active_time_total": 3009,
                "distance_total": 6164.6,
                "steps_total": 6897,
                "elapsed_time_total": 3009,
                "metabolic_energy_total": 2711232,
                "speed_avg": 2.05,
                "climb_total": 130.61,
                "descent_total": 131.58,
                "heartrate_avg": 113.5,
                "hrz_dist": [
                    1518,
                    1372,
                    119,
                    0,
                    0
                ],
                "moving_time_total": 2996,
                "moving_speed_avg": 2.06
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d09da5e93f9836565eb77550c6?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d09da5e93f9836565eb77550c6?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-09-05T11:27:53+02:00",
            "activity_type": "hiking",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj1Dul3_NATl40Wx8myq1-08g=",
            "aggregates": {
                "active_time_total": 3021,
                "distance_total": 5765.85,
                "steps_total": 7009,
                "elapsed_time_total": 3021,
                "metabolic_energy_total": 1351432,
                "speed_avg": 1.91,
                "climb_total": 177,
                "descent_total": 177,
                "heartrate_avg": 106.64,
                "gradient_min": -0.39,
                "hrz_dist": [
                    2099,
                    922,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_aaa32519e6c24dc82761bf04f5?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_aaa32519e6c24dc82761bf04f5?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-09-02T12:33:38+02:00",
            "activity_type": "hiking",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj1mzuvOjZoZpbGG3DOWz12DM=",
            "aggregates": {
                "active_time_total": 3261,
                "distance_total": 6017.68,
                "steps_total": 7141,
                "elapsed_time_total": 3260,
                "metabolic_energy_total": 1393272,
                "speed_avg": 1.85,
                "climb_total": 174,
                "descent_total": 174,
                "heartrate_avg": 105.17,
                "gradient_min": -0.33,
                "hrz_dist": [
                    2501,
                    760,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ae015f7d4285537a2c0bab68bd?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_ae015f7d4285537a2c0bab68bd?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-09-02T12:33:37+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj16ZLDWUVVnhsudSxwIwwXc4=",
            "aggregates": {
                "active_time_total": 3253,
                "distance_total": 6184.42,
                "steps_total": 7141,
                "elapsed_time_total": 3252,
                "metabolic_energy_total": 2502032,
                "speed_avg": 1.9,
                "climb_total": 131.22,
                "descent_total": 133.44,
                "heartrate_avg": 108.62,
                "hrz_dist": [
                    2158,
                    1026,
                    70,
                    0,
                    0
                ],
                "moving_time_total": 3247,
                "moving_speed_avg": 1.9
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c2df2a27fc8d08875fbcd7309a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c2df2a27fc8d08875fbcd7309a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-31T12:13:26+02:00",
            "activity_type": "trail_running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj0JUzGcRzkdbq3frtLS5oxD4=",
            "aggregates": {
                "active_time_total": 2685,
                "distance_total": 6192.79,
                "steps_total": 6197,
                "elapsed_time_total": 2685,
                "metabolic_energy_total": 2635920,
                "speed_avg": 2.31,
                "climb_total": 182,
                "descent_total": 178,
                "heartrate_avg": 123.66,
                "gradient_min": -0.27,
                "hrz_dist": [
                    534,
                    1359,
                    793,
                    0,
                    0
                ],
                "moving_time_total": 2670,
                "moving_speed_avg": 2.32
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c80c68272ee8982dea6cdd7a41?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c80c68272ee8982dea6cdd7a41?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-30T10:25:57+01:00",
            "activity_type": "skiing",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj0V-WqEm_ZjTdfEOf1M6tQcM=",
            "aggregates": {
                "active_time_total": 5841,
                "distance_total": 17484.39,
                "elapsed_time_total": 5841,
                "metabolic_energy_total": 2263544,
                "speed_avg": 2.83,
                "climb_total": 1389,
                "descent_total": 3166,
                "heartrate_avg": 95.17,
                "gradient_min": -2.9,
                "active_speed_avg": 0,
                "active_speed_max": 0,
                "snowsport_run_count": 3,
                "hrz_dist": [
                    4669,
                    984,
                    189,
                    0,
                    0
                ],
                "active_distance_total": 0
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_91e0261d5cb4dd9eae2a8b6789?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_91e0261d5cb4dd9eae2a8b6789?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-30T07:55:50+01:00",
            "activity_type": "skiing",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj0sJ4et_qfhKFnogI3u_jz8U=",
            "aggregates": {
                "active_time_total": 5847,
                "distance_total": 16832.83,
                "elapsed_time_total": 5847,
                "metabolic_energy_total": 1878616,
                "speed_avg": 2.87,
                "climb_total": 2506,
                "descent_total": 1346,
                "heartrate_avg": 89.69,
                "gradient_min": -1.96,
                "active_speed_avg": 0,
                "active_speed_max": 0,
                "snowsport_run_count": 5,
                "hrz_dist": [
                    5375,
                    459,
                    14,
                    0,
                    0
                ],
                "active_distance_total": 0
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2034da476793c42c62fd221f4c?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_2034da476793c42c62fd221f4c?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-29T12:32:06+02:00",
            "activity_type": "trail_running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj0wjdy1ImifCyPzF6Jw8mSjg=",
            "aggregates": {
                "active_time_total": 3150,
                "distance_total": 7202.56,
                "steps_total": 7299,
                "elapsed_time_total": 3150,
                "metabolic_energy_total": 3071056,
                "speed_avg": 2.29,
                "climb_total": 217,
                "descent_total": 212,
                "heartrate_avg": 123.92,
                "gradient_min": -0.48,
                "hrz_dist": [
                    625,
                    1447,
                    1078,
                    0,
                    0
                ],
                "moving_time_total": 3146,
                "moving_speed_avg": 2.29
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4338961866528974ce36d968f6?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_4338961866528974ce36d968f6?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-29T12:32:05+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj7GJlevh2cyoHem3Bp7-6HEk=",
            "aggregates": {
                "active_time_total": 3146,
                "distance_total": 7094.57,
                "steps_total": 7287,
                "elapsed_time_total": 3146,
                "metabolic_energy_total": 3071056,
                "speed_avg": 2.26,
                "climb_total": 139.89,
                "descent_total": 137.02,
                "heartrate_avg": 130.97,
                "hrz_dist": [
                    231,
                    1314,
                    1451,
                    150,
                    0
                ],
                "moving_time_total": 3146,
                "moving_speed_avg": 2.26
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8b08abed7ae008d0de163eaaae?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_8b08abed7ae008d0de163eaaae?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-29T09:04:20+02:00",
            "activity_type": "skiing",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj7ajAy3W6hMgw29SzXl9_mbQ=",
            "aggregates": {
                "active_time_total": 12321,
                "distance_total": 24839.68,
                "elapsed_time_total": 12320,
                "metabolic_energy_total": 4652608,
                "speed_avg": 1.61,
                "climb_total": 3052,
                "descent_total": 3010,
                "heartrate_avg": 87.81,
                "gradient_min": -1.2,
                "active_speed_avg": 0,
                "active_speed_max": 0,
                "snowsport_run_count": 7,
                "hrz_dist": [
                    11303,
                    912,
                    106,
                    0,
                    0
                ],
                "active_distance_total": 0
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4aaed6ba935b3779e2f6fb142d?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_4aaed6ba935b3779e2f6fb142d?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-26T11:59:27+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj6MzzvM9FrKLZ_IgKQDysC78=",
            "aggregates": {
                "active_time_total": 3152,
                "distance_total": 7068.48,
                "steps_total": 7873,
                "elapsed_time_total": 3151,
                "metabolic_energy_total": 3117080,
                "speed_avg": 2.24,
                "climb_total": 130.94,
                "descent_total": 128.73,
                "heartrate_avg": 123.12,
                "hrz_dist": [
                    775,
                    1009,
                    1368,
                    0,
                    0
                ],
                "moving_time_total": 3152,
                "moving_speed_avg": 2.24
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_dab119929a16966abacfc41a38?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_dab119929a16966abacfc41a38?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-26T11:59:27+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj61EdblkQtISBHkOdSh3ihbk=",
            "aggregates": {
                "active_time_total": 3155,
                "distance_total": 7135.34,
                "steps_total": 7380,
                "elapsed_time_total": 3155,
                "metabolic_energy_total": 3054320,
                "speed_avg": 2.26,
                "climb_total": 138.52,
                "descent_total": 135.89,
                "heartrate_avg": 123.1,
                "hrz_dist": [
                    800,
                    1033,
                    1322,
                    0,
                    0
                ],
                "moving_time_total": 3150,
                "moving_speed_avg": 2.27
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f63ced4f541985a7d04f6a80d5?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_f63ced4f541985a7d04f6a80d5?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-19T06:58:30-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj5qoDlY2II__VNNSzm3gdOF8=",
            "aggregates": {
                "active_time_total": 3992,
                "distance_total": 3742.37,
                "elapsed_time_total": 4178,
                "metabolic_energy_total": 3020848,
                "speed_avg": 0.94,
                "climb_total": 297.16,
                "descent_total": 301.06,
                "heartrate_avg": 112.4,
                "hrz_dist": [
                    2291,
                    1154,
                    548,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4d2f62bd6beed8e810b417b12e?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_4d2f62bd6beed8e810b417b12e?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-19T06:58:29-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj4Zl7gSzu5FFTUPrvdtpFoa8=",
            "aggregates": {
                "active_time_total": 3994,
                "distance_total": 3593.43,
                "steps_total": 5865,
                "elapsed_time_total": 4175,
                "metabolic_energy_total": 1129680,
                "speed_avg": 0.9,
                "climb_total": 285.27,
                "descent_total": 295.24,
                "heartrate_avg": 113.96,
                "hrz_dist": [
                    2039,
                    1313,
                    642,
                    0,
                    0
                ],
                "moving_time_total": 3509,
                "moving_speed_avg": 1.02
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a8cf39f3f119e1dc1b43e4e0bb?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_a8cf39f3f119e1dc1b43e4e0bb?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-18T06:59:47-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj_J4-YiS5DQl9YfruObPiQ5I=",
            "aggregates": {
                "active_time_total": 3880,
                "distance_total": 3713.96,
                "elapsed_time_total": 3880,
                "metabolic_energy_total": 3188208,
                "speed_avg": 0.96,
                "climb_total": 294.54,
                "descent_total": 298.41,
                "heartrate_avg": 118.38,
                "hrz_dist": [
                    1732,
                    1348,
                    800,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_7cceaa2d537e4d1d1e476d8498?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_7cceaa2d537e4d1d1e476d8498?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-18T06:59:46-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj_sl1AT8g4s0SIogLynJpSGk=",
            "aggregates": {
                "active_time_total": 3879,
                "distance_total": 3597.25,
                "steps_total": 5335,
                "elapsed_time_total": 3877,
                "metabolic_energy_total": 1092024,
                "speed_avg": 0.93,
                "climb_total": 289.35,
                "descent_total": 286.89,
                "heartrate_avg": 119.69,
                "hrz_dist": [
                    1448,
                    1594,
                    837,
                    0,
                    0
                ],
                "moving_time_total": 3233,
                "moving_speed_avg": 1.11
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f9d76a6694d9d3c9dd4900f9aa?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_f9d76a6694d9d3c9dd4900f9aa?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-17T07:13:06-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj_wPQsLLsFS8lgzF5M5KszZQ=",
            "aggregates": {
                "active_time_total": 3768,
                "distance_total": 3760.91,
                "elapsed_time_total": 3767,
                "metabolic_energy_total": 3087792,
                "speed_avg": 1,
                "climb_total": 301.03,
                "descent_total": 303.39,
                "heartrate_avg": 118.28,
                "hrz_dist": [
                    2000,
                    845,
                    923,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8a5a341cd3b6877a99f0ca60cf?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_8a5a341cd3b6877a99f0ca60cf?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-17T07:13:05-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj-mfjxwgTPUXMpG3ALfF_X58=",
            "aggregates": {
                "active_time_total": 3767,
                "distance_total": 3605.84,
                "steps_total": 5656,
                "elapsed_time_total": 3766,
                "metabolic_energy_total": 1108760,
                "speed_avg": 0.96,
                "climb_total": 287.22,
                "descent_total": 294.99,
                "heartrate_avg": 119.07,
                "hrz_dist": [
                    1651,
                    1172,
                    944,
                    0,
                    0
                ],
                "moving_time_total": 3346,
                "moving_speed_avg": 1.08
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f63f3040265f63c77a731ba16e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_f63f3040265f63c77a731ba16e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-16T15:51:09-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj-61GdoXfyqf7BdSy1BG62mI=",
            "aggregates": {
                "active_time_total": 3076,
                "distance_total": 6020.52,
                "steps_total": 6885,
                "elapsed_time_total": 3075,
                "metabolic_energy_total": 2615000,
                "speed_avg": 1.96,
                "climb_total": 16.87,
                "descent_total": 22.26,
                "heartrate_avg": 111.96,
                "hrz_dist": [
                    1281,
                    1793,
                    3,
                    0,
                    0
                ],
                "moving_time_total": 3060,
                "moving_speed_avg": 1.97
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_69768b75e7dfd6501589267d0f?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_69768b75e7dfd6501589267d0f?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-16T15:51:07-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj9AET7kreshjAbDF59rXObH8=",
            "aggregates": {
                "active_time_total": 3075,
                "distance_total": 6018.45,
                "steps_total": 7320,
                "elapsed_time_total": 3073,
                "metabolic_energy_total": 2372328,
                "speed_avg": 1.96,
                "climb_total": 17.35,
                "descent_total": 23.38,
                "heartrate_avg": 112.82,
                "hrz_dist": [
                    1285,
                    1776,
                    13,
                    0,
                    0
                ],
                "moving_time_total": 3075,
                "moving_speed_avg": 1.96
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_b1c60cfd27b42af6aacc481e36?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_b1c60cfd27b42af6aacc481e36?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-12T14:44:16-06:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj8WUgmfAhmnIpS23A6NYd_nQ=",
            "aggregates": {
                "active_time_total": 1715,
                "distance_total": 4046.02,
                "steps_total": 4011,
                "elapsed_time_total": 1715,
                "metabolic_energy_total": 1878616,
                "speed_avg": 2.36,
                "climb_total": 21.83,
                "descent_total": 20.87,
                "heartrate_avg": 117.27,
                "hrz_dist": [
                    534,
                    738,
                    443,
                    0,
                    0
                ],
                "moving_time_total": 1715,
                "moving_speed_avg": 2.36
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d7bc9acb775cd4ecfda9afe7bf?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_d7bc9acb775cd4ecfda9afe7bf?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-12T14:44:15-06:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj8vjOS2Z0glRxqaZX4vdTcHI=",
            "aggregates": {
                "active_time_total": 1714,
                "distance_total": 4007.34,
                "steps_total": 4251,
                "elapsed_time_total": 1713,
                "metabolic_energy_total": 1669416,
                "speed_avg": 2.34,
                "climb_total": 20.42,
                "descent_total": 21.7,
                "heartrate_avg": 117.08,
                "hrz_dist": [
                    554,
                    726,
                    434,
                    0,
                    0
                ],
                "moving_time_total": 1714,
                "moving_speed_avg": 2.34
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4bff207ddfdc2ccf999becb5fa?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_4bff207ddfdc2ccf999becb5fa?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-09T17:00:49-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagj8zJr-uu4dbZGCB8lGxeW9Y8=",
            "aggregates": {
                "active_time_total": 1185,
                "distance_total": 3059.58,
                "steps_total": 2830,
                "elapsed_time_total": 1185,
                "metabolic_energy_total": 1355616,
                "speed_avg": 2.58,
                "climb_total": 15.84,
                "descent_total": 18.93,
                "heartrate_avg": 121.26,
                "hrz_dist": [
                    402,
                    378,
                    405,
                    0,
                    0
                ],
                "moving_time_total": 1185,
                "moving_speed_avg": 2.58
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4d755b13cd12c7791a546104d2?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_4d755b13cd12c7791a546104d2?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-09T17:00:48-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjjecamb8ZgAMsgqZSGnauWW0=",
            "aggregates": {
                "active_time_total": 1184,
                "distance_total": 3023.32,
                "steps_total": 2931,
                "elapsed_time_total": 1183,
                "metabolic_energy_total": 1251016,
                "speed_avg": 2.55,
                "climb_total": 17.59,
                "descent_total": 13.06,
                "heartrate_avg": 125.58,
                "hrz_dist": [
                    327,
                    343,
                    501,
                    13,
                    0
                ],
                "moving_time_total": 1184,
                "moving_speed_avg": 2.55
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_bc78e6ad05b000e82e69b61659?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_bc78e6ad05b000e82e69b61659?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-07T15:38:31-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjj7BR-qSAb8dDwdS36bclUpY=",
            "aggregates": {
                "active_time_total": 1741,
                "distance_total": 4192.51,
                "steps_total": 4141,
                "elapsed_time_total": 1741,
                "metabolic_energy_total": 1949744,
                "speed_avg": 2.41,
                "climb_total": 18.73,
                "descent_total": 19.51,
                "heartrate_avg": 122.65,
                "hrz_dist": [
                    544,
                    650,
                    547,
                    1,
                    0
                ],
                "moving_time_total": 1731,
                "moving_speed_avg": 2.42
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_3ef31acd985d85eb367c8cbbb9?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_3ef31acd985d85eb367c8cbbb9?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-07T15:38:30-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjiIMp7gXmqGnFpfrrBBV9y2Y=",
            "aggregates": {
                "active_time_total": 1747,
                "distance_total": 4006.45,
                "steps_total": 4306,
                "elapsed_time_total": 1745,
                "metabolic_energy_total": 1581552,
                "speed_avg": 2.29,
                "climb_total": 20.93,
                "descent_total": 19.7,
                "heartrate_avg": 110.82,
                "hrz_dist": [
                    1019,
                    353,
                    375,
                    0,
                    0
                ],
                "moving_time_total": 1741,
                "moving_speed_avg": 2.3
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_3431e2c2c12e2f00183abd3be9?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_3431e2c2c12e2f00183abd3be9?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-04T14:21:19-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjiUmMX4gqX4vyBEOZ_fW4Tps=",
            "aggregates": {
                "active_time_total": 3854,
                "distance_total": 7983.55,
                "steps_total": 8876,
                "elapsed_time_total": 3852,
                "metabolic_energy_total": 3263520,
                "speed_avg": 2.07,
                "climb_total": 188.78,
                "descent_total": 196.38,
                "heartrate_avg": 102.68,
                "hrz_dist": [
                    2790,
                    971,
                    93,
                    0,
                    0
                ],
                "moving_time_total": 3679,
                "moving_speed_avg": 2.17
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d6363f34ec04cdc86857931103?format=tcx&dv=6",
                "gpx": "/mysports/1/resource/Clone_d6363f34ec04cdc86857931103?format=gpx&dv=6"
            }
        },
        {
            "local_start_datetime": "2016-08-04T14:21:17-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjitRijR5_R62q5ogO99T2wJ0=",
            "aggregates": {
                "active_time_total": 3853,
                "distance_total": 8004.24,
                "steps_total": 8833,
                "elapsed_time_total": 3853,
                "metabolic_energy_total": 3246784,
                "speed_avg": 2.08,
                "climb_total": 228.94,
                "descent_total": 231.68,
                "heartrate_avg": 102.61,
                "hrz_dist": [
                    2795,
                    989,
                    69,
                    0,
                    0
                ],
                "moving_time_total": 3686,
                "moving_speed_avg": 2.17
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_fc2ef4ae98240949c1195c91d9?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_fc2ef4ae98240949c1195c91d9?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-08-01T12:49:43+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjhLKSpFyyyPCmLtS3LJBH830=",
            "aggregates": {
                "active_time_total": 2435,
                "distance_total": 5306.66,
                "elapsed_time_total": 2435,
                "metabolic_energy_total": 1861880,
                "speed_avg": 2.18,
                "climb_total": 101.04,
                "descent_total": 97.21,
                "heartrate_avg": 113.4,
                "hrz_dist": [
                    1242,
                    819,
                    374,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f6998a3ca21c53197396e7ea06?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_f6998a3ca21c53197396e7ea06?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-08-01T12:49:41+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjhuXZx0crJzTJbaZS31HM-IY=",
            "aggregates": {
                "active_time_total": 2435,
                "distance_total": 5373.49,
                "steps_total": 5955,
                "elapsed_time_total": 2434,
                "metabolic_energy_total": 2213336,
                "speed_avg": 2.21,
                "climb_total": 94.46,
                "descent_total": 99.61,
                "heartrate_avg": 114.05,
                "hrz_dist": [
                    1202,
                    864,
                    369,
                    0,
                    0
                ],
                "moving_time_total": 2431,
                "moving_speed_avg": 2.21
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_36042719972ecca7d28896081f?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_36042719972ecca7d28896081f?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-29T12:52:54+02:00",
            "activity_type": "treadmill",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjgdah0-ZN4JpPCYgOMvOUYXY=",
            "aggregates": {
                "active_time_total": 3432,
                "distance_total": 7000,
                "steps_total": 7312,
                "elapsed_time_total": 3504,
                "metabolic_energy_total": 2832568,
                "speed_avg": 2.04,
                "heartrate_avg": 107.62,
                "hrz_dist": [
                    2093,
                    1335,
                    5,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0337347ffe80976c107870837e?format=tcx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-29T12:52:52+02:00",
            "activity_type": "treadmill",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjgktPAXAY-LwX60OZONLa73A=",
            "aggregates": {
                "active_time_total": 3419,
                "distance_total": 7000,
                "steps_total": 7516,
                "elapsed_time_total": 3418,
                "metabolic_energy_total": 1924640,
                "speed_avg": 2.05,
                "heartrate_avg": 108.01,
                "hrz_dist": [
                    2008,
                    1392,
                    19,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_3c25839953cd3380d3baffe99f?format=tcx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-27T12:13:55+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjg4HqsP3UD14gSvrrwTIfao0=",
            "aggregates": {
                "active_time_total": 3599,
                "distance_total": 7031.96,
                "elapsed_time_total": 3598,
                "metabolic_energy_total": 2184048,
                "speed_avg": 1.95,
                "climb_total": 116.83,
                "descent_total": 109.48,
                "heartrate_avg": 97.83,
                "hrz_dist": [
                    3315,
                    282,
                    2,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_6e48720c68ec4f6ef79213fb86?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_6e48720c68ec4f6ef79213fb86?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-27T12:13:53+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjnNHkMO4aCcJhOIgPfZozg0s=",
            "aggregates": {
                "active_time_total": 3599,
                "distance_total": 7007.28,
                "steps_total": 8391,
                "elapsed_time_total": 3599,
                "metabolic_energy_total": 2677760,
                "speed_avg": 1.95,
                "climb_total": 111.77,
                "descent_total": 110.32,
                "heartrate_avg": 96.36,
                "hrz_dist": [
                    3475,
                    124,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3595,
                "moving_speed_avg": 1.95
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_36cfc34db7d6e94f029aa219a1?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_36cfc34db7d6e94f029aa219a1?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-27T12:12:01+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjnRtBgWPW_iBWmTF9hHr2BrY=",
            "aggregates": {
                "active_time_total": 8,
                "distance_total": 0,
                "elapsed_time_total": 7,
                "metabolic_energy_total": 0,
                "speed_avg": 0,
                "climb_total": 0,
                "descent_total": 0,
                "heartrate_avg": 93.25,
                "hrz_dist": [
                    8,
                    0,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e5ce35e55065dcae95443fe127?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_e5ce35e55065dcae95443fe127?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-25T12:41:56+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjnoavU_WD5gYOe_rqjlu4iLA=",
            "aggregates": {
                "active_time_total": 2777,
                "distance_total": 5413.33,
                "elapsed_time_total": 2776,
                "metabolic_energy_total": 1987400,
                "speed_avg": 1.95,
                "climb_total": 98.4,
                "descent_total": 96.68,
                "heartrate_avg": 109.28,
                "hrz_dist": [
                    1770,
                    806,
                    201,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_cf8159a4ffb091509320e8f222?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_cf8159a4ffb091509320e8f222?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-25T12:41:54+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjmH9y9tkp1kq_vm3EmhkllL0=",
            "aggregates": {
                "active_time_total": 2778,
                "distance_total": 5379.3,
                "steps_total": 6415,
                "elapsed_time_total": 2777,
                "metabolic_energy_total": 2100368,
                "speed_avg": 1.94,
                "climb_total": 98.35,
                "descent_total": 97.1,
                "heartrate_avg": 101.23,
                "hrz_dist": [
                    2326,
                    452,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 2774,
                "moving_speed_avg": 1.94
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1a05c7f0bf18f3f89d2a747cd7?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1a05c7f0bf18f3f89d2a747cd7?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-22T12:20:08+02:00",
            "activity_type": "cycling",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjm-KcJE98zmznXKZTkDhrGrs=",
            "aggregates": {
                "active_time_total": 2741,
                "distance_total": 15700.72,
                "elapsed_time_total": 2741,
                "metabolic_energy_total": 2941352,
                "speed_avg": 5.73,
                "climb_total": 278.01,
                "descent_total": 270.81,
                "heartrate_avg": 116.24,
                "hrz_dist": [
                    961,
                    1764,
                    16,
                    0,
                    0
                ],
                "moving_time_total": 2715,
                "moving_speed_avg": 5.78
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_82af17ff538b039ace72040f4f?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_82af17ff538b039ace72040f4f?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-22T12:20:07+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjlE7JvIB9ttPcNUOYspwfrKY=",
            "aggregates": {
                "active_time_total": 2741,
                "distance_total": 15688.05,
                "steps_total": 5118,
                "elapsed_time_total": 2740,
                "metabolic_energy_total": 5849232,
                "speed_avg": 5.72,
                "climb_total": 274.5,
                "descent_total": 271.52,
                "heartrate_avg": 107.53,
                "hrz_dist": [
                    1099,
                    1621,
                    21,
                    0,
                    0
                ],
                "moving_time_total": 2720,
                "moving_speed_avg": 5.77
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_17e0fccc1dbf9516aa6922612e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_17e0fccc1dbf9516aa6922612e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-20T11:56:35+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjlhmC35vkWRezdjF9QV2Up10=",
            "aggregates": {
                "active_time_total": 4289,
                "distance_total": 8058.84,
                "elapsed_time_total": 4289,
                "metabolic_energy_total": 2497848,
                "speed_avg": 1.88,
                "climb_total": 163.4,
                "descent_total": 167.55,
                "heartrate_avg": 95.79,
                "hrz_dist": [
                    4014,
                    275,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_36169e880a834bfdbcf4917a82?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_36169e880a834bfdbcf4917a82?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-20T11:56:34+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjl9MnbhYorvWE14gPuL1RIqA=",
            "aggregates": {
                "active_time_total": 4288,
                "distance_total": 8067.83,
                "steps_total": 9502,
                "elapsed_time_total": 4287,
                "metabolic_energy_total": 3071056,
                "speed_avg": 1.88,
                "climb_total": 165.51,
                "descent_total": 164.11,
                "heartrate_avg": 96.44,
                "hrz_dist": [
                    4052,
                    236,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 4288,
                "moving_speed_avg": 1.88
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_eaf7c44301b28a55034baa63bb?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_eaf7c44301b28a55034baa63bb?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-18T11:56:52+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjk32xqCEbcX1aUW3EXz5HNVY=",
            "aggregates": {
                "active_time_total": 2870,
                "distance_total": 5440.55,
                "elapsed_time_total": 2869,
                "metabolic_energy_total": 1560632,
                "speed_avg": 1.9,
                "climb_total": 97.29,
                "descent_total": 103.54,
                "heartrate_avg": 92.61,
                "hrz_dist": [
                    2837,
                    33,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_66f8766d54830356d76484b6f7?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_66f8766d54830356d76484b6f7?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-07-18T11:56:49+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjrkBCepDSZGOAV0OaLE9QaNw=",
            "aggregates": {
                "active_time_total": 2871,
                "distance_total": 5366.5,
                "steps_total": 6892,
                "elapsed_time_total": 2870,
                "metabolic_energy_total": 2163128,
                "speed_avg": 1.87,
                "climb_total": 97.9,
                "descent_total": 94.54,
                "heartrate_avg": 96.49,
                "hrz_dist": [
                    2669,
                    121,
                    4,
                    76,
                    0
                ],
                "moving_time_total": 2861,
                "moving_speed_avg": 1.88
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_16470e5cb96cc51e48995a808d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_16470e5cb96cc51e48995a808d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-15T12:13:13+02:00",
            "activity_type": "cycling",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjqLmf37x4VC8xktS0OA3NdNE=",
            "aggregates": {
                "active_time_total": 2890,
                "distance_total": 15733.34,
                "elapsed_time_total": 2888,
                "metabolic_energy_total": 2983192,
                "speed_avg": 5.44,
                "climb_total": 278.73,
                "descent_total": 275.39,
                "heartrate_avg": 116.64,
                "hrz_dist": [
                    845,
                    1911,
                    134,
                    0,
                    0
                ],
                "moving_time_total": 2852,
                "moving_speed_avg": 5.52
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_006f59e1681967d4151fe9cf12?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_006f59e1681967d4151fe9cf12?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-15T12:13:11+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjqXM6bjG0o80GM23Gwe0I8Sw=",
            "aggregates": {
                "active_time_total": 2889,
                "distance_total": 15706.75,
                "steps_total": 5507,
                "elapsed_time_total": 2888,
                "metabolic_energy_total": 6066800,
                "speed_avg": 5.44,
                "climb_total": 276.93,
                "descent_total": 273.16,
                "heartrate_avg": 114.59,
                "hrz_dist": [
                    940,
                    1737,
                    212,
                    0,
                    0
                ],
                "moving_time_total": 2852,
                "moving_speed_avg": 5.51
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_27a2d05ccc76b6e313f917e018?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_27a2d05ccc76b6e313f917e018?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-14T11:35:14+02:00",
            "activity_type": "cycling",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjqyRxDSotTAlpcB8jMiyD-tc=",
            "aggregates": {
                "active_time_total": 2800,
                "distance_total": 15848.82,
                "elapsed_time_total": 2798,
                "metabolic_energy_total": 2953904,
                "speed_avg": 5.66,
                "climb_total": 287.82,
                "descent_total": 277.33,
                "heartrate_avg": 115.51,
                "hrz_dist": [
                    886,
                    1817,
                    97,
                    0,
                    0
                ],
                "moving_time_total": 2766,
                "moving_speed_avg": 5.73
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_07b0d6f4e20c13cdc66ba0192b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_07b0d6f4e20c13cdc66ba0192b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-14T11:35:12+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjpIgkleUsNLZSGfroEIj3TMo=",
            "aggregates": {
                "active_time_total": 2800,
                "distance_total": 15702.18,
                "steps_total": 5239,
                "elapsed_time_total": 2799,
                "metabolic_energy_total": 5891072,
                "speed_avg": 5.61,
                "climb_total": 278.01,
                "descent_total": 269.22,
                "heartrate_avg": 111.68,
                "hrz_dist": [
                    990,
                    1565,
                    245,
                    0,
                    0
                ],
                "moving_time_total": 2764,
                "moving_speed_avg": 5.68
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1d7fefc8260dbea86fed7bbf18?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1d7fefc8260dbea86fed7bbf18?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-11T12:11:16+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjpxXKR3N5LJAK-zF_Gqm5wsw=",
            "aggregates": {
                "active_time_total": 3502,
                "distance_total": 6978.68,
                "steps_total": 8718,
                "elapsed_time_total": 3500,
                "metabolic_energy_total": 2924616,
                "speed_avg": 1.99,
                "climb_total": 125.38,
                "descent_total": 127.14,
                "heartrate_avg": 116.56,
                "hrz_dist": [
                    1220,
                    1902,
                    380,
                    0,
                    0
                ],
                "moving_time_total": 3502,
                "moving_speed_avg": 1.99
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_5a89b8d2a7b72ca9b0e5f97b23?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_5a89b8d2a7b72ca9b0e5f97b23?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-08T12:37:59+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjo7tcgURK8xjUfdS0_Sqv1To=",
            "aggregates": {
                "active_time_total": 3589,
                "distance_total": 7072.5,
                "steps_total": 8480,
                "elapsed_time_total": 3588,
                "metabolic_energy_total": 2874408,
                "speed_avg": 1.97,
                "climb_total": 139.18,
                "descent_total": 132.95,
                "heartrate_avg": 105.68,
                "hrz_dist": [
                    2578,
                    1002,
                    9,
                    0,
                    0
                ],
                "moving_time_total": 3589,
                "moving_speed_avg": 1.97
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ec10c27ff5380f7d4bf7c06268?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_ec10c27ff5380f7d4bf7c06268?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-07T12:12:19+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjvOtSAVeE9YSVD6ZQQYKDPPw=",
            "aggregates": {
                "active_time_total": 2238,
                "distance_total": 11674.05,
                "steps_total": 4322,
                "elapsed_time_total": 2237,
                "metabolic_energy_total": 4656792,
                "speed_avg": 5.22,
                "climb_total": 188.03,
                "descent_total": 193.26,
                "heartrate_avg": 113.46,
                "hrz_dist": [
                    896,
                    1322,
                    20,
                    0,
                    0
                ],
                "moving_time_total": 2235,
                "moving_speed_avg": 5.22
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_544e7343543b54042933343df4?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_544e7343543b54042933343df4?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-05T12:26:09+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjvSH3sNpIAmairh8iuGJGuQE=",
            "aggregates": {
                "active_time_total": 3836,
                "distance_total": 7081.21,
                "steps_total": 8822,
                "elapsed_time_total": 3835,
                "metabolic_energy_total": 2744704,
                "speed_avg": 1.85,
                "climb_total": 138.04,
                "descent_total": 137.98,
                "heartrate_avg": 104.29,
                "hrz_dist": [
                    2949,
                    887,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3833,
                "moving_speed_avg": 1.85
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8ac07f1d6454f86bcd32a69b54?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8ac07f1d6454f86bcd32a69b54?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-04T12:54:20+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjvrwZYkwdGkD6TNS1skMINwc=",
            "aggregates": {
                "active_time_total": 1700,
                "distance_total": 9017.34,
                "steps_total": 3345,
                "elapsed_time_total": 1698,
                "metabolic_energy_total": 3606608,
                "speed_avg": 5.3,
                "climb_total": 148.64,
                "descent_total": 151.78,
                "heartrate_avg": 116.95,
                "hrz_dist": [
                    587,
                    1009,
                    104,
                    0,
                    0
                ],
                "moving_time_total": 1696,
                "moving_speed_avg": 5.32
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1df7a3284da12105dbeac603c3?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1df7a3284da12105dbeac603c3?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-03T13:39:58+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjuEXEx2C3KgxLiUObpgGVKwo=",
            "aggregates": {
                "active_time_total": 1710,
                "distance_total": 8986.22,
                "steps_total": 3442,
                "elapsed_time_total": 1709,
                "metabolic_energy_total": 3635896,
                "speed_avg": 5.26,
                "climb_total": 146.12,
                "descent_total": 152.61,
                "heartrate_avg": 118.5,
                "hrz_dist": [
                    527,
                    873,
                    310,
                    0,
                    0
                ],
                "moving_time_total": 1710,
                "moving_speed_avg": 5.26
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_80859a1a48a1e2c6c816291eb5?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_80859a1a48a1e2c6c816291eb5?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-07-01T12:11:55+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjuY9hdu173e58KPrpX-FQrvc=",
            "aggregates": {
                "active_time_total": 2932,
                "distance_total": 5331.8,
                "steps_total": 6675,
                "elapsed_time_total": 2931,
                "metabolic_energy_total": 2045976,
                "speed_avg": 1.82,
                "climb_total": 98.74,
                "descent_total": 94.5,
                "heartrate_avg": 98.53,
                "hrz_dist": [
                    2753,
                    179,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 2929,
                "moving_speed_avg": 1.82
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2f6373e9fa9809c6bb3afa1a7e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_2f6373e9fa9809c6bb3afa1a7e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-29T11:41:37+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjuhKPpHsuxcgkyjF-VcAeIPE=",
            "aggregates": {
                "active_time_total": 1764,
                "distance_total": 9015.54,
                "steps_total": 3431,
                "elapsed_time_total": 1764,
                "metabolic_energy_total": 3627528,
                "speed_avg": 5.11,
                "climb_total": 139.95,
                "descent_total": 145.92,
                "heartrate_avg": 113.06,
                "hrz_dist": [
                    711,
                    962,
                    91,
                    0,
                    0
                ],
                "moving_time_total": 1762,
                "moving_speed_avg": 5.12
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_69389d3e4d3afc55e48b8b272a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_69389d3e4d3afc55e48b8b272a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-28T12:05:01+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagju9gqFfbiMioTa4gMrCDbpQw=",
            "aggregates": {
                "active_time_total": 1830,
                "distance_total": 9012.91,
                "steps_total": 3639,
                "elapsed_time_total": 1828,
                "metabolic_energy_total": 3644264,
                "speed_avg": 4.93,
                "climb_total": 145.57,
                "descent_total": 144.83,
                "heartrate_avg": 109.65,
                "hrz_dist": [
                    762,
                    1058,
                    10,
                    0,
                    0
                ],
                "moving_time_total": 1830,
                "moving_speed_avg": 4.93
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1f9732d0afc71da71252ed36ac?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1f9732d0afc71da71252ed36ac?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-27T12:43:07+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjtHR_jTnjSpUoAm3HjoSvExE=",
            "aggregates": {
                "active_time_total": 1714,
                "distance_total": 7860.69,
                "steps_total": 3433,
                "elapsed_time_total": 1713,
                "metabolic_energy_total": 3230048,
                "speed_avg": 4.59,
                "climb_total": 135.36,
                "descent_total": 139.68,
                "heartrate_avg": 110.01,
                "hrz_dist": [
                    760,
                    923,
                    30,
                    0,
                    0
                ],
                "moving_time_total": 1711,
                "moving_speed_avg": 4.59
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_9b91ba2ab6834db2cb36ccdbe2?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_9b91ba2ab6834db2cb36ccdbe2?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-20T14:23:23-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjt-mRX6-2UrNw4KZQhKXhnRc=",
            "aggregates": {
                "active_time_total": 8124,
                "distance_total": 8740,
                "steps_total": 11538,
                "elapsed_time_total": 8123,
                "metabolic_energy_total": 2506216,
                "speed_avg": 1.08,
                "climb_total": 340.51,
                "descent_total": 347.77,
                "heartrate_avg": 94.28,
                "hrz_dist": [
                    7246,
                    16,
                    1,
                    23,
                    838
                ],
                "moving_time_total": 7367,
                "moving_speed_avg": 1.19
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1b8ce2face6a5b1c7613499dbd?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1b8ce2face6a5b1c7613499dbd?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-19T07:20:11-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjsRBM-oMcYv_BJTF-kOd8gRo=",
            "aggregates": {
                "active_time_total": 3771,
                "distance_total": 3586.58,
                "steps_total": 6004,
                "elapsed_time_total": 3770,
                "metabolic_energy_total": 1175704,
                "speed_avg": 0.95,
                "climb_total": 288.98,
                "descent_total": 296.52,
                "heartrate_avg": 114.76,
                "hrz_dist": [
                    1907,
                    1318,
                    546,
                    0,
                    0
                ],
                "moving_time_total": 3415,
                "moving_speed_avg": 1.05
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_da9e335560666982d5fc062fa3?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_da9e335560666982d5fc062fa3?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-19T07:21:09-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjs0cHmZiFjTuuZkObYyb3iuE=",
            "aggregates": {
                "active_time_total": 3770,
                "distance_total": 3585.65,
                "elapsed_time_total": 3769,
                "metabolic_energy_total": 2882776,
                "speed_avg": 0.95,
                "climb_total": 295.7,
                "descent_total": 298.74,
                "heartrate_avg": 113.07,
                "hrz_dist": [
                    2088,
                    1309,
                    373,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_5ef8218c901b95c1f7b75bcf3a?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_5ef8218c901b95c1f7b75bcf3a?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-06-18T07:22:50-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjTLILjaeTfncjkfria8XIXSI=",
            "aggregates": {
                "active_time_total": 3894,
                "distance_total": 3634.45,
                "steps_total": 6093,
                "elapsed_time_total": 3894,
                "metabolic_energy_total": 1213360,
                "speed_avg": 0.93,
                "climb_total": 281.97,
                "descent_total": 295.24,
                "heartrate_avg": 110.67,
                "hrz_dist": [
                    2216,
                    1416,
                    262,
                    0,
                    0
                ],
                "moving_time_total": 3440,
                "moving_speed_avg": 1.06
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_011701200d9cf711a5ab154b16?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_011701200d9cf711a5ab154b16?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-18T07:23:48-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjTXiuPCpfiZUUMEOQkiUN2N8=",
            "aggregates": {
                "active_time_total": 3893,
                "distance_total": 3637.8,
                "elapsed_time_total": 3893,
                "metabolic_energy_total": 2765624,
                "speed_avg": 0.93,
                "climb_total": 293.9,
                "descent_total": 300.59,
                "heartrate_avg": 107.5,
                "hrz_dist": [
                    2715,
                    1131,
                    47,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_775cc710663aa29522848af248?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_775cc710663aa29522848af248?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-06-17T07:10:08-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjSBydS5Cgof_9Fx8pjEbeStQ=",
            "aggregates": {
                "active_time_total": 4105,
                "distance_total": 3595.94,
                "steps_total": 6168,
                "elapsed_time_total": 4276,
                "metabolic_energy_total": 1292856,
                "speed_avg": 0.88,
                "climb_total": 295.09,
                "descent_total": 298.69,
                "heartrate_avg": 110.94,
                "hrz_dist": [
                    2360,
                    1317,
                    428,
                    0,
                    0
                ],
                "moving_time_total": 3493,
                "moving_speed_avg": 1.03
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_7e07b715e5b5dce8d0330d5921?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_7e07b715e5b5dce8d0330d5921?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-17T07:11:06-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjSdY4-h1sVh3KtqZbdaYbzyk=",
            "aggregates": {
                "active_time_total": 4097,
                "distance_total": 3569.23,
                "elapsed_time_total": 4273,
                "metabolic_energy_total": 3133816,
                "speed_avg": 0.87,
                "climb_total": 291.52,
                "descent_total": 299.75,
                "heartrate_avg": 110.24,
                "hrz_dist": [
                    2505,
                    1359,
                    233,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_902ca2e98eda0063efecf55ed0?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_902ca2e98eda0063efecf55ed0?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-06-14T13:25:22-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjS4FzmQb1udml9dS-hmeQxNI=",
            "aggregates": {
                "active_time_total": 3780,
                "distance_total": 9487.33,
                "steps_total": 8801,
                "elapsed_time_total": 3778,
                "metabolic_energy_total": 4158896,
                "speed_avg": 2.51,
                "climb_total": 107.82,
                "descent_total": 113.85,
                "heartrate_avg": 117.17,
                "hrz_dist": [
                    1467,
                    1399,
                    914,
                    0,
                    0
                ],
                "moving_time_total": 3421,
                "moving_speed_avg": 2.77
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e732f3590058ad1bcf0350cd59?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_e732f3590058ad1bcf0350cd59?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-14T13:24:21-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjReeDsEQ4NoSpPYgHXSMh9zI=",
            "aggregates": {
                "active_time_total": 3780,
                "distance_total": 8620.96,
                "steps_total": 9169,
                "elapsed_time_total": 3778,
                "metabolic_energy_total": 3489456,
                "speed_avg": 2.28,
                "climb_total": 112.89,
                "descent_total": 110.56,
                "heartrate_avg": 108.92,
                "hrz_dist": [
                    2189,
                    835,
                    756,
                    0,
                    0
                ],
                "moving_time_total": 3694,
                "moving_speed_avg": 2.33
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_01732a8a6f308f924f7f3022a3?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_01732a8a6f308f924f7f3022a3?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-11T12:55:41-06:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjQUkVdnML6Qx3u23MuqA34MQ=",
            "aggregates": {
                "active_time_total": 638,
                "distance_total": 2143.79,
                "steps_total": 1623,
                "elapsed_time_total": 638,
                "metabolic_energy_total": 903744,
                "speed_avg": 3.36,
                "climb_total": 0,
                "descent_total": 48.37,
                "heartrate_avg": 132.85,
                "hrz_dist": [
                    20,
                    255,
                    348,
                    15,
                    0
                ],
                "moving_time_total": 638,
                "moving_speed_avg": 3.36
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a26772691c6df59a3969acf22d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_a26772691c6df59a3969acf22d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-11T12:35:45-06:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjQx5eFWiSBsgY-B8pSWG86z8=",
            "aggregates": {
                "active_time_total": 1125,
                "distance_total": 2010.62,
                "steps_total": 2389,
                "elapsed_time_total": 1124,
                "metabolic_energy_total": 887008,
                "speed_avg": 1.79,
                "climb_total": 50.78,
                "descent_total": 0,
                "heartrate_avg": 91.67,
                "hrz_dist": [
                    1125,
                    0,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 1125,
                "moving_speed_avg": 1.79
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_25a42c3df7e359aaf64a2208ad?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_25a42c3df7e359aaf64a2208ad?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-09T14:12:13-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjXhkb9mDF75A2yR8oBggbCQI=",
            "aggregates": {
                "active_time_total": 3086,
                "distance_total": 8355.44,
                "steps_total": 7427,
                "elapsed_time_total": 3086,
                "metabolic_energy_total": 3422512,
                "speed_avg": 2.71,
                "climb_total": 230.77,
                "descent_total": 246.51,
                "heartrate_avg": 136.6,
                "hrz_dist": [
                    420,
                    1005,
                    1235,
                    56,
                    371
                ],
                "moving_time_total": 2949,
                "moving_speed_avg": 2.83
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2ca9c7829e0150d70c68f93b55?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_2ca9c7829e0150d70c68f93b55?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-09T14:11:12-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjX9O-R-0JGHIBaKZa_-jejP8=",
            "aggregates": {
                "active_time_total": 3087,
                "distance_total": 8007.14,
                "steps_total": 8203,
                "elapsed_time_total": 3086,
                "metabolic_energy_total": 3133816,
                "speed_avg": 2.59,
                "climb_total": 234.87,
                "descent_total": 230.66,
                "heartrate_avg": 124.29,
                "hrz_dist": [
                    682,
                    1177,
                    1228,
                    0,
                    0
                ],
                "moving_time_total": 2925,
                "moving_speed_avg": 2.74
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_53301ecf9141c4dba1417c5cc5?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_53301ecf9141c4dba1417c5cc5?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-06T12:15:27+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjWSpj4sGjKD6wrTF066pDkPI=",
            "aggregates": {
                "active_time_total": 1819,
                "distance_total": 4289.62,
                "steps_total": 4258,
                "elapsed_time_total": 1818,
                "metabolic_energy_total": 2054344,
                "speed_avg": 2.36,
                "climb_total": 103.42,
                "descent_total": 104.74,
                "heartrate_avg": 122.29,
                "hrz_dist": [
                    343,
                    1080,
                    396,
                    0,
                    0
                ],
                "moving_time_total": 1819,
                "moving_speed_avg": 2.36
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_30aa971d633f565b66b5613c0a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_30aa971d633f565b66b5613c0a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-06T12:15:25+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjWreNMFf2MBjoT_rj4YsNHvQ=",
            "aggregates": {
                "active_time_total": 1821,
                "distance_total": 4192.24,
                "steps_total": 4597,
                "elapsed_time_total": 1819,
                "metabolic_energy_total": 1665232,
                "speed_avg": 2.3,
                "climb_total": 105.25,
                "descent_total": 104.41,
                "heartrate_avg": 123.68,
                "hrz_dist": [
                    325,
                    989,
                    464,
                    43,
                    0
                ],
                "moving_time_total": 1813,
                "moving_speed_avg": 2.31
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2bf9f98caa675f56301bad0007?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_2bf9f98caa675f56301bad0007?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-04T13:20:45+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjVNF9GRU7v0Xkh6ZaOs-8LRQ=",
            "aggregates": {
                "active_time_total": 2423,
                "distance_total": 7338.22,
                "steps_total": 4067,
                "elapsed_time_total": 2422,
                "metabolic_energy_total": 3129632,
                "speed_avg": 3.03,
                "climb_total": 285.92,
                "descent_total": 41.98,
                "heartrate_avg": 113.07,
                "hrz_dist": [
                    903,
                    1444,
                    76,
                    0,
                    0
                ],
                "moving_time_total": 2185,
                "moving_speed_avg": 3.36
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a67df46a63417d0dbade6e6df7?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_a67df46a63417d0dbade6e6df7?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-04T11:28:02+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjVoY2eg6iUIGLxNS_yQ43Ju8=",
            "aggregates": {
                "active_time_total": 6326,
                "distance_total": 7284.08,
                "elapsed_time_total": 6325,
                "metabolic_energy_total": 2903696,
                "speed_avg": 1.15,
                "climb_total": 51.78,
                "descent_total": 279.86,
                "heartrate_avg": 90.12,
                "hrz_dist": [
                    5383,
                    181,
                    648,
                    115,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_39d07de9028737f00ef3a8df07?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_39d07de9028737f00ef3a8df07?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-06-04T11:28:01+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjV0yTy4Nup2O8ZW3NMO7yoxI=",
            "aggregates": {
                "active_time_total": 6325,
                "distance_total": 7229.78,
                "steps_total": 8463,
                "elapsed_time_total": 6323,
                "metabolic_energy_total": 2903696,
                "speed_avg": 1.14,
                "climb_total": 52.77,
                "descent_total": 279.58,
                "heartrate_avg": 82.45,
                "hrz_dist": [
                    6325,
                    0,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3500,
                "moving_speed_avg": 2.07
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e2187e7a3c80b51a2b6d4a1453?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_e2187e7a3c80b51a2b6d4a1453?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-03T11:55:31+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjUbVObq_Ely8NoPrjJKxvvx8=",
            "aggregates": {
                "active_time_total": 1443,
                "distance_total": 4054.1,
                "steps_total": 3465,
                "elapsed_time_total": 1442,
                "metabolic_energy_total": 1924640,
                "speed_avg": 2.81,
                "climb_total": 73.69,
                "descent_total": 72.36,
                "heartrate_avg": 125.03,
                "hrz_dist": [
                    330,
                    481,
                    611,
                    21,
                    0
                ],
                "moving_time_total": 1443,
                "moving_speed_avg": 2.81
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d05ee4ae5268764155b4572868?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d05ee4ae5268764155b4572868?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-03T11:55:30+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjUiigvDmRjwlVQjF0Lo0hMRk=",
            "aggregates": {
                "active_time_total": 1443,
                "distance_total": 3783.54,
                "steps_total": 3848,
                "elapsed_time_total": 1441,
                "metabolic_energy_total": 1522976,
                "speed_avg": 2.62,
                "climb_total": 77.23,
                "descent_total": 73.66,
                "heartrate_avg": 124.33,
                "hrz_dist": [
                    327,
                    504,
                    588,
                    24,
                    0
                ],
                "moving_time_total": 1443,
                "moving_speed_avg": 2.62
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_31dff71f371ef751270f7a8c87?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_31dff71f371ef751270f7a8c87?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-01T12:13:13+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjbIi9vB4NgjHXptS9V9144pU=",
            "aggregates": {
                "active_time_total": 1458,
                "distance_total": 3853.48,
                "steps_total": 3516,
                "elapsed_time_total": 1458,
                "metabolic_energy_total": 1840960,
                "speed_avg": 2.64,
                "climb_total": 76.45,
                "descent_total": 76.61,
                "heartrate_avg": 124.16,
                "hrz_dist": [
                    274,
                    629,
                    556,
                    0,
                    0
                ],
                "moving_time_total": 1455,
                "moving_speed_avg": 2.65
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_93796850e8a05bb6ab96b09f3e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_93796850e8a05bb6ab96b09f3e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-06-01T12:13:12+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjbUIYDZPBddPgB23Prj29Z2g=",
            "aggregates": {
                "active_time_total": 1458,
                "distance_total": 3793.42,
                "steps_total": 3918,
                "elapsed_time_total": 1458,
                "metabolic_energy_total": 1531344,
                "speed_avg": 2.6,
                "climb_total": 74.51,
                "descent_total": 70.84,
                "heartrate_avg": 128.06,
                "hrz_dist": [
                    233,
                    501,
                    651,
                    73,
                    0
                ],
                "moving_time_total": 1455,
                "moving_speed_avg": 2.61
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_5b042f48c24abfe9d0cac20c4c?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_5b042f48c24abfe9d0cac20c4c?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-30T11:41:56+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjbt_23wWUbfW45aZYpBzz6W4=",
            "aggregates": {
                "active_time_total": 1472,
                "distance_total": 3847.16,
                "steps_total": 3559,
                "elapsed_time_total": 1471,
                "metabolic_energy_total": 1866064,
                "speed_avg": 2.61,
                "climb_total": 73.22,
                "descent_total": 70.78,
                "heartrate_avg": 126.85,
                "hrz_dist": [
                    138,
                    740,
                    571,
                    23,
                    0
                ],
                "moving_time_total": 1472,
                "moving_speed_avg": 2.61
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_74880581149fb0742943bd63ce?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_74880581149fb0742943bd63ce?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-30T11:41:55+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjbxVTbohYmhePRB8qXfw2bJM=",
            "aggregates": {
                "active_time_total": 1472,
                "distance_total": 3813.71,
                "steps_total": 3888,
                "elapsed_time_total": 1471,
                "metabolic_energy_total": 1594104,
                "speed_avg": 2.59,
                "climb_total": 76.95,
                "descent_total": 73.72,
                "heartrate_avg": 129.41,
                "hrz_dist": [
                    268,
                    389,
                    617,
                    198,
                    0
                ],
                "moving_time_total": 1462,
                "moving_speed_avg": 2.61
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_9d8c06d69aac22f1d0b88a7b9b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_9d8c06d69aac22f1d0b88a7b9b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-27T12:46:23+02:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjanFgGTKnsn1mY0OTQ5_l_pg=",
            "aggregates": {
                "active_time_total": 4004,
                "distance_total": 7279.24,
                "elapsed_time_total": 4003,
                "metabolic_energy_total": 2652656,
                "speed_avg": 1.82,
                "climb_total": 280.84,
                "descent_total": 50.89,
                "heartrate_avg": 103.3,
                "hrz_dist": [
                    2905,
                    1099,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0c47ca6170315b5c8175ec0dc2?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_0c47ca6170315b5c8175ec0dc2?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-05-27T12:46:22+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagja7vFqL9rRZ9Rwvrhun8ge2U=",
            "aggregates": {
                "active_time_total": 4002,
                "distance_total": 7288.77,
                "steps_total": 8928,
                "elapsed_time_total": 4001,
                "metabolic_energy_total": 2648472,
                "speed_avg": 1.82,
                "climb_total": 282.36,
                "descent_total": 46.29,
                "heartrate_avg": 110.11,
                "hrz_dist": [
                    2195,
                    1647,
                    160,
                    0,
                    0
                ],
                "moving_time_total": 3999,
                "moving_speed_avg": 1.82
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_62562370fc9f1cb5b3ba59fa2a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_62562370fc9f1cb5b3ba59fa2a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-27T11:57:11+02:00",
            "activity_type": "cycling",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjZBeQMHBqPSBqqx8qmNtUzXg=",
            "aggregates": {
                "active_time_total": 2439,
                "distance_total": 16662.87,
                "elapsed_time_total": 2439,
                "metabolic_energy_total": 3142184,
                "speed_avg": 6.83,
                "climb_total": 98.03,
                "descent_total": 348.36,
                "heartrate_avg": 109.09,
                "hrz_dist": [
                    1326,
                    1112,
                    1,
                    0,
                    0
                ],
                "moving_time_total": 2429,
                "moving_speed_avg": 6.86
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_89eacee4aa0ab63453455323c1?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_89eacee4aa0ab63453455323c1?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-27T11:57:10+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjZd01gf2mysJdCqZYYTuRSIU=",
            "aggregates": {
                "active_time_total": 2437,
                "distance_total": 16559.95,
                "steps_total": 4546,
                "elapsed_time_total": 2436,
                "metabolic_energy_total": 5857600,
                "speed_avg": 6.8,
                "climb_total": 97.4,
                "descent_total": 345.63,
                "heartrate_avg": 106.91,
                "hrz_dist": [
                    1258,
                    1179,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 2427,
                "moving_speed_avg": 6.82
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_b968bf5dbabbe8ccf3a0830bd4?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_b968bf5dbabbe8ccf3a0830bd4?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-25T12:08:05+02:00",
            "activity_type": "cycling",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjYLkG9kdZ4qi0Lfrhf1hC2o4=",
            "aggregates": {
                "active_time_total": 2947,
                "distance_total": 15730.68,
                "elapsed_time_total": 2947,
                "metabolic_energy_total": 2953904,
                "speed_avg": 5.34,
                "climb_total": 281.02,
                "descent_total": 276.23,
                "heartrate_avg": 113.4,
                "hrz_dist": [
                    1156,
                    1786,
                    5,
                    0,
                    0
                ],
                "moving_time_total": 2874,
                "moving_speed_avg": 5.47
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_584358914f0e769cd201924e78?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_584358914f0e769cd201924e78?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-25T12:08:04+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjYXOjR8qVFUqDjEOThriHX3M=",
            "aggregates": {
                "active_time_total": 2947,
                "distance_total": 15700.22,
                "steps_total": 5247,
                "elapsed_time_total": 2946,
                "metabolic_energy_total": 6029144,
                "speed_avg": 5.33,
                "climb_total": 278.38,
                "descent_total": 271.34,
                "heartrate_avg": 113.84,
                "hrz_dist": [
                    1246,
                    1475,
                    226,
                    0,
                    0
                ],
                "moving_time_total": 2875,
                "moving_speed_avg": 5.46
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_cb8677f249bbd07de96d0d4075?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_cb8677f249bbd07de96d0d4075?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-23T12:12:05+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjYu5NlVzADWzbbogEjJnJ0XU=",
            "aggregates": {
                "active_time_total": 3182,
                "distance_total": 7081.46,
                "steps_total": 9756,
                "elapsed_time_total": 3180,
                "metabolic_energy_total": 3121264,
                "speed_avg": 2.23,
                "climb_total": 137.65,
                "descent_total": 130.18,
                "heartrate_avg": 122.58,
                "hrz_dist": [
                    858,
                    1437,
                    866,
                    21,
                    0
                ],
                "moving_time_total": 3182,
                "moving_speed_avg": 2.23
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_fe08d624c3f3be4b344c781e6d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_fe08d624c3f3be4b344c781e6d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-23T12:12:03+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjfHTmpMLC_BKtvUOSydEgvU4=",
            "aggregates": {
                "active_time_total": 3180,
                "distance_total": 7239.42,
                "steps_total": 7586,
                "elapsed_time_total": 3180,
                "metabolic_energy_total": 3753048,
                "speed_avg": 2.28,
                "climb_total": 136.63,
                "descent_total": 134.01,
                "moving_time_total": 3174,
                "moving_speed_avg": 2.28
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_65487de4c2b795e726fca82387?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_65487de4c2b795e726fca82387?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-20T11:57:55+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjeNpwYvXxI5pzO6ZZLlI2qrg=",
            "aggregates": {
                "active_time_total": 2910,
                "distance_total": 7095.45,
                "steps_total": 9834,
                "elapsed_time_total": 2909,
                "metabolic_energy_total": 2991560,
                "speed_avg": 2.44,
                "climb_total": 135.49,
                "descent_total": 135.44,
                "heartrate_avg": 129.98,
                "hrz_dist": [
                    330,
                    939,
                    1641,
                    0,
                    0
                ],
                "moving_time_total": 2904,
                "moving_speed_avg": 2.44
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d5ef40df9c067c791769d5ab27?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d5ef40df9c067c791769d5ab27?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-20T11:58:53+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjeRDV03g91HhEmh8r17LzL0U=",
            "aggregates": {
                "active_time_total": 2904,
                "distance_total": 7097.46,
                "steps_total": 7011,
                "elapsed_time_total": 2904,
                "metabolic_energy_total": 3439248,
                "speed_avg": 2.44,
                "climb_total": 134.53,
                "descent_total": 136.01,
                "moving_time_total": 2892,
                "moving_speed_avg": 2.45
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2b30905845b6759bc8c2e57517?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_2b30905845b6759bc8c2e57517?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-18T12:06:08+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjeo07Ae5ozF4ceNS83ZO9oUM=",
            "aggregates": {
                "active_time_total": 3218,
                "distance_total": 7118.46,
                "steps_total": 7593,
                "elapsed_time_total": 3218,
                "metabolic_energy_total": 3443432,
                "speed_avg": 2.21,
                "climb_total": 138.57,
                "descent_total": 136.81,
                "heartrate_avg": 122.89,
                "hrz_dist": [
                    761,
                    1567,
                    890,
                    0,
                    0
                ],
                "moving_time_total": 3197,
                "moving_speed_avg": 2.23
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d0a687eb3dad3f7748bf0b7e3a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d0a687eb3dad3f7748bf0b7e3a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-16T12:10:37+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjdOvLKKylQwMQsIgFBtcMkqM=",
            "aggregates": {
                "active_time_total": 1480,
                "distance_total": 3822.97,
                "steps_total": 3553,
                "elapsed_time_total": 1479,
                "metabolic_energy_total": 1845144,
                "speed_avg": 2.58,
                "climb_total": 75.54,
                "descent_total": 73.79,
                "heartrate_avg": 121.61,
                "hrz_dist": [
                    359,
                    666,
                    455,
                    0,
                    0
                ],
                "moving_time_total": 1477,
                "moving_speed_avg": 2.59
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4657479153f060027b8fc863c8?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_4657479153f060027b8fc863c8?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-16T12:10:36+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjdSFumSFptOEnETF3_zfJF14=",
            "aggregates": {
                "active_time_total": 1478,
                "distance_total": 3791.31,
                "steps_total": 3862,
                "elapsed_time_total": 1478,
                "metabolic_energy_total": 1610840,
                "speed_avg": 2.57,
                "climb_total": 76.46,
                "descent_total": 77.72,
                "heartrate_avg": 127.07,
                "hrz_dist": [
                    221,
                    646,
                    477,
                    134,
                    0
                ],
                "moving_time_total": 1467,
                "moving_speed_avg": 2.58
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_39d5db917088e4a981121786b2?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_39d5db917088e4a981121786b2?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-13T12:07:31+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjd3Yl-jrwWyVIUkOSDPZCHKU=",
            "aggregates": {
                "active_time_total": 1926,
                "distance_total": 4968.43,
                "steps_total": 4626,
                "elapsed_time_total": 1925,
                "metabolic_energy_total": 2343040,
                "speed_avg": 2.58,
                "climb_total": 93.65,
                "descent_total": 93.23,
                "heartrate_avg": 124.75,
                "hrz_dist": [
                    410,
                    625,
                    891,
                    0,
                    0
                ],
                "moving_time_total": 1926,
                "moving_speed_avg": 2.58
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8d8a3ccb30d5e68040255db217?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8d8a3ccb30d5e68040255db217?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-13T12:07:30+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjcEVd7puWnIvONm3O4VQahVU=",
            "aggregates": {
                "active_time_total": 1926,
                "distance_total": 4913.97,
                "steps_total": 4984,
                "elapsed_time_total": 1925,
                "metabolic_energy_total": 2037608,
                "speed_avg": 2.55,
                "climb_total": 91.18,
                "descent_total": 90.32,
                "heartrate_avg": 129.85,
                "hrz_dist": [
                    307,
                    555,
                    913,
                    150,
                    0
                ],
                "moving_time_total": 1915,
                "moving_speed_avg": 2.57
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_60f6ee5c0665c689065b231160?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_60f6ee5c0665c689065b231160?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-11T12:03:00+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjchIWjYAPc0-hdR8rEpWRjq4=",
            "aggregates": {
                "active_time_total": 1949,
                "distance_total": 4972.73,
                "steps_total": 4694,
                "elapsed_time_total": 1949,
                "metabolic_energy_total": 2351408,
                "speed_avg": 2.55,
                "climb_total": 90.27,
                "descent_total": 92.03,
                "heartrate_avg": 123.99,
                "hrz_dist": [
                    390,
                    699,
                    860,
                    0,
                    0
                ],
                "moving_time_total": 1949,
                "moving_speed_avg": 2.55
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_9d17522c6b0ec7aad7767e43e6?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_9d17522c6b0ec7aad7767e43e6?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-11T12:02:59+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjDQ3CX1licRj8Xh8u6hRsp7E=",
            "aggregates": {
                "active_time_total": 1950,
                "distance_total": 4914.1,
                "steps_total": 5126,
                "elapsed_time_total": 1948,
                "metabolic_energy_total": 1962296,
                "speed_avg": 2.52,
                "climb_total": 91.81,
                "descent_total": 90.27,
                "heartrate_avg": 124.21,
                "hrz_dist": [
                    397,
                    679,
                    874,
                    0,
                    0
                ],
                "moving_time_total": 1950,
                "moving_speed_avg": 2.52
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_9d4856f422df980742b03824b0?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_9d4856f422df980742b03824b0?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-09T12:00:26+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjD1qJPEL7ntyTHW3LGdXnrEo=",
            "aggregates": {
                "active_time_total": 2069,
                "distance_total": 4970.94,
                "steps_total": 4950,
                "elapsed_time_total": 2068,
                "metabolic_energy_total": 2322120,
                "speed_avg": 2.4,
                "climb_total": 92.86,
                "descent_total": 89.5,
                "heartrate_avg": 121.1,
                "hrz_dist": [
                    785,
                    486,
                    798,
                    0,
                    0
                ],
                "moving_time_total": 2069,
                "moving_speed_avg": 2.4
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_475b0cfd2b1307f40a5b7f439d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_475b0cfd2b1307f40a5b7f439d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-09T12:00:25+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjBFhKYrrJOet28m3L3PKFDaE=",
            "aggregates": {
                "active_time_total": 2069,
                "distance_total": 4902.92,
                "steps_total": 5594,
                "elapsed_time_total": 2068,
                "metabolic_energy_total": 2033424,
                "speed_avg": 2.37,
                "climb_total": 89.64,
                "descent_total": 86,
                "heartrate_avg": 120.6,
                "hrz_dist": [
                    775,
                    524,
                    760,
                    10,
                    0
                ],
                "moving_time_total": 2061,
                "moving_speed_avg": 2.38
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_45f7c6a924b626a44fcecbecbb?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_45f7c6a924b626a44fcecbecbb?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-06T12:35:17+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjBg8BAaFQ1i8ZsR8uLzMOBlo=",
            "aggregates": {
                "active_time_total": 2288,
                "distance_total": 4987.91,
                "steps_total": 5290,
                "elapsed_time_total": 2288,
                "metabolic_energy_total": 2246808,
                "speed_avg": 2.18,
                "climb_total": 93.53,
                "descent_total": 90.97,
                "heartrate_avg": 106.93,
                "hrz_dist": [
                    1565,
                    508,
                    216,
                    0,
                    0
                ],
                "moving_time_total": 2288,
                "moving_speed_avg": 2.18
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4a8084cec6ecc8622102db3625?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_4a8084cec6ecc8622102db3625?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-06T12:35:16+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjAPbcpI365mOodIgAO3GTGlc=",
            "aggregates": {
                "active_time_total": 2288,
                "distance_total": 4893.9,
                "steps_total": 5712,
                "elapsed_time_total": 2287,
                "metabolic_energy_total": 1924640,
                "speed_avg": 2.14,
                "climb_total": 95.73,
                "descent_total": 87.49,
                "heartrate_avg": 106.88,
                "hrz_dist": [
                    1574,
                    456,
                    258,
                    0,
                    0
                ],
                "moving_time_total": 2288,
                "moving_speed_avg": 2.14
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_bcf347fb9088dcc6596dca580d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_bcf347fb9088dcc6596dca580d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-04T12:14:24+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjAqGXx5ZjCafHN_rlyLAYEaw=",
            "aggregates": {
                "active_time_total": 2320,
                "distance_total": 4921.75,
                "steps_total": 6827,
                "elapsed_time_total": 2320,
                "metabolic_energy_total": 1933008,
                "speed_avg": 2.12,
                "climb_total": 91.94,
                "descent_total": 86.37,
                "heartrate_avg": 108.73,
                "hrz_dist": [
                    1578,
                    457,
                    285,
                    0,
                    0
                ],
                "moving_time_total": 2316,
                "moving_speed_avg": 2.13
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ee4f5f1fe2a64f75b5400dea30?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_ee4f5f1fe2a64f75b5400dea30?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-04T12:14:22+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjHfGZR4WtDzuGRYgBdBg0-Go=",
            "aggregates": {
                "active_time_total": 2319,
                "distance_total": 4956.67,
                "steps_total": 5440,
                "elapsed_time_total": 2319,
                "metabolic_energy_total": 2209152,
                "speed_avg": 2.14,
                "climb_total": 94.03,
                "descent_total": 88.58,
                "heartrate_avg": 137.78,
                "hrz_dist": [
                    208,
                    551,
                    1114,
                    447,
                    0
                ],
                "moving_time_total": 2316,
                "moving_speed_avg": 2.14
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2d48e004add2d75d953d5967aa?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_2d48e004add2d75d953d5967aa?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-02T11:45:37+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjGJWqMD9SJ1FvYtS4anvnamE=",
            "aggregates": {
                "active_time_total": 3280,
                "distance_total": 8012.54,
                "steps_total": 10684,
                "elapsed_time_total": 3279,
                "metabolic_energy_total": 3460168,
                "speed_avg": 2.44,
                "climb_total": 130.28,
                "descent_total": 125.53,
                "heartrate_avg": 126.26,
                "hrz_dist": [
                    476,
                    1549,
                    1255,
                    0,
                    0
                ],
                "moving_time_total": 3280,
                "moving_speed_avg": 2.44
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ec438e65b9b73ca1e2c821678a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_ec438e65b9b73ca1e2c821678a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-05-02T11:45:35+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjGsLhUyTLyJUAIaZdmbpsYZo=",
            "aggregates": {
                "active_time_total": 3277,
                "distance_total": 8084.8,
                "steps_total": 7860,
                "elapsed_time_total": 3277,
                "metabolic_energy_total": 4045928,
                "speed_avg": 2.47,
                "climb_total": 128.45,
                "descent_total": 118.17,
                "heartrate_avg": 140.43,
                "hrz_dist": [
                    79,
                    1002,
                    1644,
                    353,
                    199
                ],
                "moving_time_total": 3277,
                "moving_speed_avg": 2.47
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8ae53afef4145c2492332885dd?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8ae53afef4145c2492332885dd?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-29T12:06:00+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjFW60y-vKsCo7SEOWux4Y14c=",
            "aggregates": {
                "active_time_total": 1655,
                "distance_total": 3782.43,
                "steps_total": 3814,
                "elapsed_time_total": 1654,
                "metabolic_energy_total": 1635944,
                "speed_avg": 2.29,
                "climb_total": 55.84,
                "descent_total": 83.86,
                "heartrate_avg": 130.15,
                "hrz_dist": [
                    392,
                    607,
                    308,
                    335,
                    13
                ],
                "moving_time_total": 1634,
                "moving_speed_avg": 2.31
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ea509d45af720fd5e18d76e6b6?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_ea509d45af720fd5e18d76e6b6?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-29T11:51:59+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjFzn_qPBTX-5UCzFzSN-T3Hw=",
            "aggregates": {
                "active_time_total": 660,
                "distance_total": 132.99,
                "steps_total": 1456,
                "elapsed_time_total": 658,
                "metabolic_energy_total": 66944,
                "speed_avg": 0.2,
                "climb_total": 10.35,
                "descent_total": 0,
                "heartrate_avg": 121.01,
                "hrz_dist": [
                    203,
                    259,
                    179,
                    20,
                    0
                ],
                "moving_time_total": 81,
                "moving_speed_avg": 1.64
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_951288f97b7f943cd6ba00c23d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_951288f97b7f943cd6ba00c23d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-25T12:19:02+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjEAqHvFE1mEDSbx8vpX3LRYw=",
            "aggregates": {
                "active_time_total": 3500,
                "distance_total": 8103.39,
                "steps_total": 8403,
                "elapsed_time_total": 3499,
                "metabolic_energy_total": 4100320,
                "speed_avg": 2.32,
                "climb_total": 126.15,
                "descent_total": 122.16,
                "heartrate_avg": 132.28,
                "hrz_dist": [
                    358,
                    1270,
                    1610,
                    254,
                    8
                ],
                "moving_time_total": 3500,
                "moving_speed_avg": 2.32
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1dd02feeb732c637b7ca9a4506?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1dd02feeb732c637b7ca9a4506?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-22T12:09:02+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjLP3R320werw_yIgDL-wZnfs=",
            "aggregates": {
                "active_time_total": 3681,
                "distance_total": 8096.55,
                "elapsed_time_total": 3681,
                "metabolic_energy_total": 3514560,
                "speed_avg": 2.2,
                "climb_total": 128.36,
                "descent_total": 123.22,
                "heartrate_avg": 131.23,
                "hrz_dist": [
                    620,
                    1142,
                    1518,
                    256,
                    146
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_38fefa5c42eba03b4a313010f7?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_38fefa5c42eba03b4a313010f7?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-20T12:25:33+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjLqqavHaplXhQi_rm3C2SlgA=",
            "aggregates": {
                "active_time_total": 4540,
                "distance_total": 9071.79,
                "elapsed_time_total": 4539,
                "metabolic_energy_total": 3819992,
                "speed_avg": 2,
                "climb_total": 153.02,
                "descent_total": 148.58,
                "heartrate_avg": 120.21,
                "hrz_dist": [
                    1169,
                    2603,
                    769,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_3d399ef791a95a20b2c53ace96?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_3d399ef791a95a20b2c53ace96?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-18T12:23:38+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjKZniqNfPUtbW79S6MY_KD_A=",
            "aggregates": {
                "active_time_total": 3724,
                "distance_total": 9004.6,
                "steps_total": 11948,
                "elapsed_time_total": 3723,
                "metabolic_energy_total": 3811624,
                "speed_avg": 2.42,
                "climb_total": 149.33,
                "descent_total": 158.99,
                "heartrate_avg": 130.37,
                "hrz_dist": [
                    274,
                    1580,
                    1621,
                    248,
                    0
                ],
                "moving_time_total": 3707,
                "moving_speed_avg": 2.43
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_26af289967a1778f8f9104c3a4?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_26af289967a1778f8f9104c3a4?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-18T12:23:37+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjKgQMekGaSvCODR8tO66EgfY=",
            "aggregates": {
                "active_time_total": 3721,
                "distance_total": 9043.64,
                "steps_total": 8796,
                "elapsed_time_total": 3720,
                "metabolic_energy_total": 4225840,
                "speed_avg": 2.43,
                "climb_total": 145.83,
                "descent_total": 161.68,
                "heartrate_avg": 132.98,
                "hrz_dist": [
                    139,
                    1758,
                    1517,
                    186,
                    121
                ],
                "moving_time_total": 3721,
                "moving_speed_avg": 2.43
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_3c4675350ee16e12345f237d91?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_3c4675350ee16e12345f237d91?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-12T17:17:48+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjJGL8UwNXxa2CxUOU4Oo1shY=",
            "aggregates": {
                "active_time_total": 2266,
                "distance_total": 5797.88,
                "steps_total": 8484,
                "elapsed_time_total": 2264,
                "metabolic_energy_total": 2447640,
                "speed_avg": 2.56,
                "climb_total": 114.21,
                "descent_total": 112.35,
                "heartrate_avg": 130.99,
                "hrz_dist": [
                    262,
                    709,
                    1294,
                    0,
                    0
                ],
                "moving_time_total": 2177,
                "moving_speed_avg": 2.66
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_706680e8e066c8aeb2d7cf9cc5?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_706680e8e066c8aeb2d7cf9cc5?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-12T17:16:47+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjJjW3MBjOKmnthjFxEyu-ue0=",
            "aggregates": {
                "active_time_total": 2262,
                "distance_total": 5839.28,
                "steps_total": 5321,
                "elapsed_time_total": 2261,
                "metabolic_energy_total": 2673576,
                "speed_avg": 2.58,
                "climb_total": 111.66,
                "descent_total": 113.9,
                "heartrate_avg": 131.26,
                "hrz_dist": [
                    237,
                    764,
                    1261,
                    0,
                    0
                ],
                "moving_time_total": 2174,
                "moving_speed_avg": 2.69
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_35de4c73dfe3a94fd560c43ff3?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_35de4c73dfe3a94fd560c43ff3?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-10T15:56:54+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjIQbPJLmo7cdr4h8t_onmIB0=",
            "aggregates": {
                "active_time_total": 2104,
                "distance_total": 5038.03,
                "steps_total": 7114,
                "elapsed_time_total": 2103,
                "metabolic_energy_total": 2154760,
                "speed_avg": 2.39,
                "climb_total": 72.55,
                "descent_total": 68.48,
                "heartrate_avg": 125.11,
                "hrz_dist": [
                    422,
                    762,
                    914,
                    6,
                    0
                ],
                "moving_time_total": 2073,
                "moving_speed_avg": 2.43
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_81ef2b2e2837b921f13f2f8aef?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_81ef2b2e2837b921f13f2f8aef?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-10T15:55:52+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjI1GER6IxAgMEoW3IDUhtK-Y=",
            "aggregates": {
                "active_time_total": 2101,
                "distance_total": 5132.99,
                "steps_total": 5153,
                "elapsed_time_total": 2100,
                "metabolic_energy_total": 2309568,
                "speed_avg": 2.44,
                "climb_total": 62.39,
                "descent_total": 68.34,
                "heartrate_avg": 128.88,
                "hrz_dist": [
                    338,
                    561,
                    1094,
                    108,
                    0
                ],
                "moving_time_total": 2073,
                "moving_speed_avg": 2.48
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_5109e296d9967dfc40246af8a5?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_5109e296d9967dfc40246af8a5?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-05T12:48:11+10:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjPlbBpKpm61sqkG3JQiHKyds=",
            "aggregates": {
                "active_time_total": 3287,
                "distance_total": 6003.57,
                "steps_total": 6917,
                "elapsed_time_total": 3286,
                "metabolic_energy_total": 2481112,
                "speed_avg": 1.83,
                "climb_total": 25.27,
                "descent_total": 15.35,
                "heartrate_avg": 109.34,
                "hrz_dist": [
                    2366,
                    921,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3276,
                "moving_speed_avg": 1.83
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_21d6fe7177d3ba9ff10685d62a?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_21d6fe7177d3ba9ff10685d62a?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-05T12:47:10+10:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjOWW5sAsALPWs9EOVr4OSUCs=",
            "aggregates": {
                "active_time_total": 3284,
                "distance_total": 6023.6,
                "elapsed_time_total": 3283,
                "metabolic_energy_total": 2359776,
                "speed_avg": 1.83,
                "climb_total": 25.37,
                "descent_total": 16.28,
                "heartrate_avg": 108.54,
                "hrz_dist": [
                    2511,
                    773,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_da6f7dbda39b34d30b48abdca4?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_da6f7dbda39b34d30b48abdca4?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-05T11:34:17+10:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjOvhXYp1VNNP0FogCpaLc3i0=",
            "aggregates": {
                "active_time_total": 3242,
                "distance_total": 6026.16,
                "steps_total": 7145,
                "elapsed_time_total": 3241,
                "metabolic_energy_total": 2347224,
                "speed_avg": 1.86,
                "climb_total": 11.18,
                "descent_total": 12.78,
                "heartrate_avg": 97.63,
                "hrz_dist": [
                    3174,
                    68,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3235,
                "moving_speed_avg": 1.86
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e70bf0d2c69c54b4ff347eb32c?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_e70bf0d2c69c54b4ff347eb32c?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-05T11:33:15+10:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjOzLy0xCZwzHDtzFwXEIZW9A=",
            "aggregates": {
                "active_time_total": 3239,
                "distance_total": 6044.9,
                "elapsed_time_total": 3239,
                "metabolic_energy_total": 1999952,
                "speed_avg": 1.87,
                "climb_total": 10.15,
                "descent_total": 9.95,
                "heartrate_avg": 98.9,
                "hrz_dist": [
                    3088,
                    151,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_af65786c1f673221455074de69?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_af65786c1f673221455074de69?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-05T06:35:11+10:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjNJ6nS9-Yu4743tS7fuZt7c0=",
            "aggregates": {
                "active_time_total": 2566,
                "distance_total": 1808.71,
                "steps_total": 3192,
                "elapsed_time_total": 2565,
                "metabolic_energy_total": 661072,
                "speed_avg": 0.7,
                "climb_total": 169.35,
                "descent_total": 171.87,
                "heartrate_avg": 93.29,
                "hrz_dist": [
                    2131,
                    435,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 1838,
                "moving_speed_avg": 0.98
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4a872e5c498386beeb417d39cb?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_4a872e5c498386beeb417d39cb?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-05T06:34:10+10:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjNsnsKMQBVEqXnaZejSfm5jY=",
            "aggregates": {
                "active_time_total": 2559,
                "distance_total": 1762.58,
                "elapsed_time_total": 2558,
                "metabolic_energy_total": 1485320,
                "speed_avg": 0.69,
                "climb_total": 168.39,
                "descent_total": 172.05,
                "heartrate_avg": 95.47,
                "hrz_dist": [
                    2552,
                    7,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_30579c8f9981440fa7f997e135?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_30579c8f9981440fa7f997e135?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-04T11:58:18+10:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjMDAxjeirZAYmWDFwmWV7-js=",
            "aggregates": {
                "active_time_total": 4591,
                "distance_total": 4471.18,
                "steps_total": 7607,
                "elapsed_time_total": 4590,
                "metabolic_energy_total": 1803304,
                "speed_avg": 0.97,
                "climb_total": 239.14,
                "descent_total": 263.17,
                "heartrate_avg": 109.16,
                "hrz_dist": [
                    3468,
                    162,
                    249,
                    20,
                    692
                ],
                "moving_time_total": 3390,
                "moving_speed_avg": 1.32
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c49591d9212b8dd19cba1b9bd8?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c49591d9212b8dd19cba1b9bd8?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-04T11:57:16+10:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjMfqUPGVnk-QR-YgCYIW-f8Y=",
            "aggregates": {
                "active_time_total": 4589,
                "distance_total": 4873.42,
                "elapsed_time_total": 4588,
                "metabolic_energy_total": 2531320,
                "speed_avg": 1.06,
                "climb_total": 284.25,
                "descent_total": 293.77,
                "heartrate_avg": 92.01,
                "hrz_dist": [
                    4576,
                    13,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ce490d1aace13789bac6987fdb?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_ce490d1aace13789bac6987fdb?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-04T07:50:16+10:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagjM63fX37-fCB-uvrnk0Q1dD0=",
            "aggregates": {
                "active_time_total": 3623,
                "distance_total": 5687.93,
                "steps_total": 7081,
                "elapsed_time_total": 3621,
                "metabolic_energy_total": 2062712,
                "speed_avg": 1.57,
                "climb_total": 39.14,
                "descent_total": 39.06,
                "heartrate_avg": 83.59,
                "hrz_dist": [
                    3623,
                    0,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3493,
                "moving_speed_avg": 1.63
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_cf361731ab01f47e9ad15d4d61?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_cf361731ab01f47e9ad15d4d61?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-04T07:49:14+10:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagczt0pggqLuh3ZUor72PrX2VA=",
            "aggregates": {
                "active_time_total": 3619,
                "distance_total": 5708.57,
                "elapsed_time_total": 3618,
                "metabolic_energy_total": 1970664,
                "speed_avg": 1.58,
                "climb_total": 41.18,
                "descent_total": 39.34,
                "heartrate_avg": 91,
                "hrz_dist": [
                    3488,
                    131,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_098a543e9d5629ee9260e9cab7?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_098a543e9d5629ee9260e9cab7?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-04-03T08:09:45+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcyCT0JyYhilFolx3VzLhKxV0=",
            "aggregates": {
                "active_time_total": 6141,
                "distance_total": 27631.92,
                "steps_total": 9374,
                "elapsed_time_total": 6139,
                "metabolic_energy_total": 11359560,
                "speed_avg": 4.5,
                "climb_total": 183.48,
                "descent_total": 170.23,
                "heartrate_avg": 88.55,
                "hrz_dist": [
                    6140,
                    0,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 5436,
                "moving_speed_avg": 5.08
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_12a11a626607443bddeeb4e92b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_12a11a626607443bddeeb4e92b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-03T08:08:42+11:00",
            "activity_type": "cycling",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcye5RlqvtfbNfNqSnNViPQKA=",
            "aggregates": {
                "active_time_total": 6137,
                "distance_total": 27639.19,
                "elapsed_time_total": 6137,
                "metabolic_energy_total": 5242552,
                "speed_avg": 4.5,
                "climb_total": 182.32,
                "descent_total": 173.75,
                "heartrate_avg": 79.47,
                "hrz_dist": [
                    6137,
                    0,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 5441,
                "moving_speed_avg": 5.08
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_7c03f5fbc0fbbce96ff7baaeba?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_7c03f5fbc0fbbce96ff7baaeba?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-02T10:21:12+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcynO_RD24ZZUH1G8wP3nBzqY=",
            "aggregates": {
                "active_time_total": 1842,
                "distance_total": 4529.19,
                "steps_total": 6075,
                "elapsed_time_total": 1840,
                "metabolic_energy_total": 1886984,
                "speed_avg": 2.46,
                "climb_total": 81.31,
                "descent_total": 87.79,
                "heartrate_avg": 116.57,
                "hrz_dist": [
                    724,
                    541,
                    577,
                    0,
                    0
                ],
                "moving_time_total": 1814,
                "moving_speed_avg": 2.5
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_04b2c2a4f54ec165f65b2fac96?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_04b2c2a4f54ec165f65b2fac96?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-04-02T10:20:10+11:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcx4ihv-kg8u5T_vge7hw-c0A=",
            "aggregates": {
                "active_time_total": 1841,
                "distance_total": 5602.6,
                "steps_total": 4386,
                "elapsed_time_total": 1840,
                "metabolic_energy_total": 2029240,
                "speed_avg": 3.04,
                "climb_total": 71.19,
                "descent_total": 73.39,
                "heartrate_avg": 116.73,
                "hrz_dist": [
                    698,
                    570,
                    573,
                    0,
                    0
                ],
                "moving_time_total": 1697,
                "moving_speed_avg": 3.3
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_fb4d7a7a073335e43229017ca7?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_fb4d7a7a073335e43229017ca7?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-28T12:22:23+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcwXF8GsWKwqLiO28w-l6jb00=",
            "aggregates": {
                "active_time_total": 3759,
                "distance_total": 9006.48,
                "steps_total": 11908,
                "elapsed_time_total": 3758,
                "metabolic_energy_total": 3702840,
                "speed_avg": 2.4,
                "climb_total": 137.02,
                "descent_total": 154.99,
                "heartrate_avg": 121.11,
                "hrz_dist": [
                    864,
                    2317,
                    578,
                    0,
                    0
                ],
                "moving_time_total": 3756,
                "moving_speed_avg": 2.4
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d5aed9ba0533dec472b84ba222?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d5aed9ba0533dec472b84ba222?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-28T12:22:21+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcwuySyFPf2oS62aSn8H_t4Us=",
            "aggregates": {
                "active_time_total": 3757,
                "distance_total": 9119.85,
                "steps_total": 9039,
                "elapsed_time_total": 3757,
                "metabolic_energy_total": 4259312,
                "speed_avg": 2.43,
                "climb_total": 136.89,
                "descent_total": 159.84,
                "heartrate_avg": 121.31,
                "hrz_dist": [
                    851,
                    2325,
                    581,
                    0,
                    0
                ],
                "moving_time_total": 3757,
                "moving_speed_avg": 2.43
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f6e17602fc69c21c3e1884125e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_f6e17602fc69c21c3e1884125e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-25T12:27:50+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc2NivP_ru9HISjIr6UrQSmoY=",
            "aggregates": {
                "active_time_total": 4656,
                "distance_total": 9001.47,
                "steps_total": 11346,
                "elapsed_time_total": 4655,
                "metabolic_energy_total": 3485272,
                "speed_avg": 1.93,
                "climb_total": 142.3,
                "descent_total": 151.31,
                "heartrate_avg": 105.41,
                "hrz_dist": [
                    3730,
                    428,
                    328,
                    170,
                    0
                ],
                "moving_time_total": 4656,
                "moving_speed_avg": 1.93
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f49be60a6bdd0a32491400e7da?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_f49be60a6bdd0a32491400e7da?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-25T12:27:49+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc2RIKjnciA5AlLTOIq1TXH3s=",
            "aggregates": {
                "active_time_total": 4653,
                "distance_total": 9069.54,
                "steps_total": 10526,
                "elapsed_time_total": 4652,
                "metabolic_energy_total": 4066848,
                "speed_avg": 1.95,
                "climb_total": 134.74,
                "descent_total": 154.47,
                "heartrate_avg": 101.38,
                "hrz_dist": [
                    4043,
                    299,
                    295,
                    16,
                    0
                ],
                "moving_time_total": 4653,
                "moving_speed_avg": 1.95
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_be398150dd145c10ecf2502b45?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_be398150dd145c10ecf2502b45?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-23T12:25:12+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc2o_kXOF3G7Z9z_gfoXWZkX0=",
            "aggregates": {
                "active_time_total": 2303,
                "distance_total": 4295.65,
                "steps_total": 5604,
                "elapsed_time_total": 2302,
                "metabolic_energy_total": 1736360,
                "speed_avg": 1.87,
                "climb_total": 69.44,
                "descent_total": 71.99,
                "heartrate_avg": 97.69,
                "hrz_dist": [
                    2073,
                    146,
                    84,
                    0,
                    0
                ],
                "moving_time_total": 2297,
                "moving_speed_avg": 1.87
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ce765d364031ab2a3483268428?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_ce765d364031ab2a3483268428?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-23T12:25:10+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc1SOxxC52YwlGph3Ug9HtJ2A=",
            "aggregates": {
                "active_time_total": 2299,
                "distance_total": 4345.19,
                "steps_total": 5080,
                "elapsed_time_total": 2299,
                "metabolic_energy_total": 1949744,
                "speed_avg": 1.89,
                "climb_total": 73.55,
                "descent_total": 82.63,
                "heartrate_avg": 103.48,
                "hrz_dist": [
                    1752,
                    380,
                    137,
                    30,
                    0
                ],
                "moving_time_total": 2299,
                "moving_speed_avg": 1.89
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_58396d5e1f1b2d65d6fa6acb1b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_58396d5e1f1b2d65d6fa6acb1b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-21T13:14:49+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc1r5fFrgjey8eRNZDifCjqWY=",
            "aggregates": {
                "active_time_total": 1692,
                "distance_total": 4329.59,
                "steps_total": 5727,
                "elapsed_time_total": 1691,
                "metabolic_energy_total": 1824224,
                "speed_avg": 2.56,
                "climb_total": 71.51,
                "descent_total": 78.79,
                "heartrate_avg": 122.06,
                "hrz_dist": [
                    508,
                    596,
                    588,
                    0,
                    0
                ],
                "moving_time_total": 1692,
                "moving_speed_avg": 2.56
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d2078d8c55af75094119a386d5?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d2078d8c55af75094119a386d5?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-21T13:14:48+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc7XpxYSVAXn11h28z7sMp6OE=",
            "aggregates": {
                "active_time_total": 1691,
                "distance_total": 4433.92,
                "steps_total": 4082,
                "elapsed_time_total": 1690,
                "metabolic_energy_total": 2058528,
                "speed_avg": 2.62,
                "climb_total": 73.3,
                "descent_total": 83.39,
                "heartrate_avg": 122.78,
                "hrz_dist": [
                    466,
                    693,
                    532,
                    0,
                    0
                ],
                "moving_time_total": 1691,
                "moving_speed_avg": 2.62
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e73ec540112269a3799730f5ed?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_e73ec540112269a3799730f5ed?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-18T12:12:31+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc6B5CFp-_dhecoDOK8KD6euo=",
            "aggregates": {
                "active_time_total": 3698,
                "distance_total": 9052.69,
                "steps_total": 12043,
                "elapsed_time_total": 3696,
                "metabolic_energy_total": 3886936,
                "speed_avg": 2.45,
                "climb_total": 161.8,
                "descent_total": 143.63,
                "heartrate_avg": 126.96,
                "hrz_dist": [
                    464,
                    1753,
                    1480,
                    0,
                    0
                ],
                "moving_time_total": 3698,
                "moving_speed_avg": 2.45
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_276e6860a5f9c9443f35603f07?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_276e6860a5f9c9443f35603f07?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-18T12:13:29+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc64OsxAnqbjHEQvgd-oG09Ow=",
            "aggregates": {
                "active_time_total": 3695,
                "distance_total": 9076.57,
                "steps_total": 8836,
                "elapsed_time_total": 3695,
                "metabolic_energy_total": 4154712,
                "speed_avg": 2.46,
                "climb_total": 150.58,
                "descent_total": 154.4,
                "heartrate_avg": 140.95,
                "hrz_dist": [
                    74,
                    1704,
                    1246,
                    216,
                    455
                ],
                "moving_time_total": 3695,
                "moving_speed_avg": 2.46
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_9e87e3b8dd8ebd7255c2f3af68?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_9e87e3b8dd8ebd7255c2f3af68?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-14T12:14:23+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc57IXjlC-DqinydZB0gSOzPc=",
            "aggregates": {
                "active_time_total": 1672,
                "distance_total": 4331.72,
                "steps_total": 4094,
                "elapsed_time_total": 1671,
                "metabolic_energy_total": 1945560,
                "speed_avg": 2.59,
                "climb_total": 67.95,
                "descent_total": 79.66,
                "heartrate_avg": 149.41,
                "hrz_dist": [
                    44,
                    475,
                    472,
                    292,
                    390
                ],
                "moving_time_total": 1672,
                "moving_speed_avg": 2.59
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c63e4aa0de08a6cf1753fa1b14?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c63e4aa0de08a6cf1753fa1b14?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-03-11T12:48:44+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc_hvEq2_aOHhXfjOLeu4_OTw=",
            "aggregates": {
                "active_time_total": 3798,
                "distance_total": 9049.63,
                "elapsed_time_total": 3797,
                "metabolic_energy_total": 3397408,
                "speed_avg": 2.38,
                "climb_total": 154,
                "descent_total": 149.61,
                "heartrate_avg": 129.29,
                "hrz_dist": [
                    128,
                    2342,
                    1267,
                    61,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_b1d8f1a0c7d67a7a08c3f088cc?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_b1d8f1a0c7d67a7a08c3f088cc?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-03-09T12:18:41+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc-Si8v868_9bRGh3Xl0xnoMw=",
            "aggregates": {
                "active_time_total": 4303,
                "distance_total": 9057.82,
                "elapsed_time_total": 4301,
                "metabolic_energy_total": 3987352,
                "speed_avg": 2.11,
                "climb_total": 153.2,
                "descent_total": 141.62,
                "heartrate_avg": 128.48,
                "hrz_dist": [
                    151,
                    2666,
                    1466,
                    20,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1bb9d63ef408c56047503e6c26?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_1bb9d63ef408c56047503e6c26?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-03-04T11:37:34+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc-3_33NUlEBK-WW8yZI3sqzc=",
            "aggregates": {
                "active_time_total": 2403,
                "distance_total": 5797.57,
                "steps_total": 5731,
                "elapsed_time_total": 2403,
                "metabolic_energy_total": 2698680,
                "speed_avg": 2.41,
                "climb_total": 101.59,
                "descent_total": 96.59,
                "heartrate_avg": 140.78,
                "hrz_dist": [
                    314,
                    963,
                    450,
                    240,
                    437
                ],
                "moving_time_total": 2399,
                "moving_speed_avg": 2.42
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_848fc27bf65b3c4926d7ed9e81?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_848fc27bf65b3c4926d7ed9e81?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-28T09:45:47-05:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc9RkH9Zfon0-ykTOLv8ldmNc=",
            "aggregates": {
                "active_time_total": 2245,
                "distance_total": 5739.22,
                "steps_total": 5339,
                "elapsed_time_total": 2244,
                "metabolic_energy_total": 2489480,
                "speed_avg": 2.56,
                "climb_total": 81.67,
                "descent_total": 76.75,
                "heartrate_avg": 131.09,
                "hrz_dist": [
                    202,
                    835,
                    1111,
                    97,
                    0
                ],
                "moving_time_total": 2201,
                "moving_speed_avg": 2.61
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_07433be53aea891781215d14bb?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_07433be53aea891781215d14bb?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-27T12:01:40-05:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc9oTpJwG9h2nqc_gctegTFtE=",
            "aggregates": {
                "active_time_total": 3670,
                "distance_total": 7270.75,
                "elapsed_time_total": 3670,
                "metabolic_energy_total": 2204968,
                "speed_avg": 1.98,
                "climb_total": 97.78,
                "descent_total": 97.78,
                "heartrate_avg": 97.35,
                "hrz_dist": [
                    3646,
                    24,
                    0,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_11e452d9fb760e0fb541064cb4?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_11e452d9fb760e0fb541064cb4?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-02-26T09:41:13-05:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc905MloxxcIvd0kFuTAjWkyw=",
            "aggregates": {
                "active_time_total": 2148,
                "distance_total": 5685.14,
                "steps_total": 5196,
                "elapsed_time_total": 2149,
                "metabolic_energy_total": 2564792,
                "speed_avg": 2.65,
                "climb_total": 80.39,
                "descent_total": 77.64,
                "heartrate_avg": 136.53,
                "hrz_dist": [
                    111,
                    542,
                    1265,
                    230,
                    0
                ],
                "moving_time_total": 2123,
                "moving_speed_avg": 2.68
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_aee179532518a2ff8f92bbf8b1?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_aee179532518a2ff8f92bbf8b1?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-23T11:34:33+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc8H00gi0XtyVbtm8yoaqOCtw=",
            "aggregates": {
                "active_time_total": 2559,
                "distance_total": 5765.27,
                "steps_total": 6009,
                "elapsed_time_total": 2558,
                "metabolic_energy_total": 2669392,
                "speed_avg": 2.25,
                "climb_total": 101.56,
                "descent_total": 93.82,
                "heartrate_avg": 124.79,
                "hrz_dist": [
                    399,
                    1354,
                    800,
                    6,
                    0
                ],
                "moving_time_total": 2559,
                "moving_speed_avg": 2.25
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_05fbb952533314bf72b64efb38?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_05fbb952533314bf72b64efb38?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-21T11:45:03+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagc8ip_4TaOWOE09R3XUmsFASc=",
            "aggregates": {
                "active_time_total": 2080,
                "distance_total": 6902.71,
                "steps_total": 3325,
                "elapsed_time_total": 2079,
                "metabolic_energy_total": 2970640,
                "speed_avg": 3.32,
                "climb_total": 133.92,
                "descent_total": 148.9,
                "heartrate_avg": 119.74,
                "hrz_dist": [
                    504,
                    1443,
                    134,
                    0,
                    0
                ],
                "moving_time_total": 2055,
                "moving_speed_avg": 3.36
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_94b2ba9d72051bb619101691bc?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_94b2ba9d72051bb619101691bc?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-19T12:02:26+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcjP8OgmIvrVRef6SgUwo9rcU=",
            "aggregates": {
                "active_time_total": 2248,
                "distance_total": 6861.38,
                "steps_total": 3837,
                "elapsed_time_total": 2247,
                "metabolic_energy_total": 3058504,
                "speed_avg": 3.05,
                "climb_total": 132.05,
                "descent_total": 145.93,
                "heartrate_avg": 119.58,
                "hrz_dist": [
                    825,
                    1030,
                    289,
                    104,
                    0
                ],
                "moving_time_total": 2196,
                "moving_speed_avg": 3.12
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c535c5e7269281ce4e93c1fb04?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c535c5e7269281ce4e93c1fb04?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-18T12:09:48+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcjqhF4Xm2QpAxPNZFoMu2pj4=",
            "aggregates": {
                "active_time_total": 2104,
                "distance_total": 6931,
                "steps_total": 3312,
                "elapsed_time_total": 2104,
                "metabolic_energy_total": 2999928,
                "speed_avg": 3.29,
                "climb_total": 133.5,
                "descent_total": 146.93,
                "heartrate_avg": 116.92,
                "hrz_dist": [
                    675,
                    1347,
                    82,
                    0,
                    0
                ],
                "moving_time_total": 2060,
                "moving_speed_avg": 3.36
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_2ffa3edf52ca20393d1cefed7c?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_2ffa3edf52ca20393d1cefed7c?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-17T11:54:26+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcj2LgUPR6tXIGnW83WStzI8M=",
            "aggregates": {
                "active_time_total": 2390,
                "distance_total": 6832.75,
                "steps_total": 3608,
                "elapsed_time_total": 2389,
                "metabolic_energy_total": 3100344,
                "speed_avg": 2.86,
                "climb_total": 133.23,
                "descent_total": 147.77,
                "heartrate_avg": 114.77,
                "hrz_dist": [
                    1126,
                    959,
                    305,
                    0,
                    0
                ],
                "moving_time_total": 2089,
                "moving_speed_avg": 3.27
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c0b991ef61ebcdebbe442f7cdb?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c0b991ef61ebcdebbe442f7cdb?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-15T12:22:47+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcigbTJ06FnRjvujOOR0igscg=",
            "aggregates": {
                "active_time_total": 2200,
                "distance_total": 6865.12,
                "steps_total": 3426,
                "elapsed_time_total": 2200,
                "metabolic_energy_total": 2987376,
                "speed_avg": 3.12,
                "climb_total": 128.12,
                "descent_total": 147.72,
                "heartrate_avg": 120.98,
                "hrz_dist": [
                    544,
                    1273,
                    383,
                    0,
                    0
                ],
                "moving_time_total": 2107,
                "moving_speed_avg": 3.26
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d9e1d1e44778fb9f9fa12c7d80?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d9e1d1e44778fb9f9fa12c7d80?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-13T12:35:03+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagchGAjDgxIEkXjcm83nAwRgig=",
            "aggregates": {
                "active_time_total": 2273,
                "distance_total": 6833.29,
                "steps_total": 3554,
                "elapsed_time_total": 2272,
                "metabolic_energy_total": 2974824,
                "speed_avg": 3.01,
                "climb_total": 135.05,
                "descent_total": 152.18,
                "heartrate_avg": 123.84,
                "hrz_dist": [
                    350,
                    1465,
                    451,
                    7,
                    0
                ],
                "moving_time_total": 2200,
                "moving_speed_avg": 3.11
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_b3f6bbaa91da0df2b3fd06898c?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_b3f6bbaa91da0df2b3fd06898c?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-10T12:17:53+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagchaqGv4GE5afU09ZFZezUB9U=",
            "aggregates": {
                "active_time_total": 2359,
                "distance_total": 6935.98,
                "steps_total": 3487,
                "elapsed_time_total": 2358,
                "metabolic_energy_total": 3163104,
                "speed_avg": 2.94,
                "climb_total": 133.48,
                "descent_total": 149.02,
                "heartrate_avg": 122.84,
                "hrz_dist": [
                    593,
                    991,
                    775,
                    0,
                    0
                ],
                "moving_time_total": 2264,
                "moving_speed_avg": 3.06
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a59ca2f1f7e3e2b9a5d15d1b14?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_a59ca2f1f7e3e2b9a5d15d1b14?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-02-09T12:50:10+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagchjdobRfR_YGMMR3Sb82aidM=",
            "aggregates": {
                "active_time_total": 2708,
                "distance_total": 6823.75,
                "elapsed_time_total": 2708,
                "metabolic_energy_total": 2050160,
                "speed_avg": 2.52,
                "climb_total": 129.53,
                "descent_total": 150.34,
                "heartrate_avg": 111.6,
                "hrz_dist": [
                    1434,
                    954,
                    320,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c579b44e4e788e1dacdc19d595?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_c579b44e4e788e1dacdc19d595?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-02-08T13:22:53+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagch_3N3JodCmO7kKSgli1fDC4=",
            "aggregates": {
                "active_time_total": 3139,
                "distance_total": 6861.79,
                "elapsed_time_total": 3139,
                "metabolic_energy_total": 2556424,
                "speed_avg": 2.19,
                "climb_total": 130.79,
                "descent_total": 141.62,
                "heartrate_avg": 117.05,
                "hrz_dist": [
                    1042,
                    1585,
                    512,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1cf026d0f3a0d71a772ed1fb87?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_1cf026d0f3a0d71a772ed1fb87?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-02-05T12:43:17+01:00",
            "activity_type": "treadmill",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcg1NbGq0u1etlFkFrca5JG9g=",
            "aggregates": {
                "active_time_total": 1444,
                "distance_total": 4000,
                "steps_total": 3408,
                "elapsed_time_total": 1443,
                "metabolic_energy_total": 548104,
                "speed_avg": 2.77,
                "heartrate_avg": 127.16,
                "hrz_dist": [
                    301,
                    369,
                    774,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f62e64f045a6b81a4897274013?format=tcx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-02-03T12:23:38+01:00",
            "activity_type": "treadmill",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcnANVmr7g03ckZDOPzQZl8h4=",
            "aggregates": {
                "active_time_total": 1443,
                "distance_total": 4000,
                "steps_total": 3416,
                "elapsed_time_total": 1443,
                "metabolic_energy_total": 514632,
                "speed_avg": 2.77,
                "heartrate_avg": 132.54,
                "hrz_dist": [
                    170,
                    315,
                    958,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_34279312914f000c63b35f0b78?format=tcx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-02-01T11:42:52+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcncnwKzMsJJUTxYr9NOagd-M=",
            "aggregates": {
                "active_time_total": 1762,
                "distance_total": 4335.26,
                "steps_total": 4328,
                "elapsed_time_total": 1762,
                "metabolic_energy_total": 1916272,
                "speed_avg": 2.46,
                "climb_total": 74.79,
                "descent_total": 84.76,
                "moving_time_total": 1762,
                "moving_speed_avg": 2.46
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_cf162d9aaea1b46f5f90ba5997?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_cf162d9aaea1b46f5f90ba5997?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-01-21T13:39:25-08:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcmWdm7QQf-x3NQ28202W2YBU=",
            "aggregates": {
                "active_time_total": 3622,
                "distance_total": 5890.91,
                "elapsed_time_total": 3621,
                "metabolic_energy_total": 2686128,
                "speed_avg": 1.63,
                "climb_total": 322.21,
                "descent_total": 321.34,
                "heartrate_avg": 119.15,
                "hrz_dist": [
                    1215,
                    1852,
                    517,
                    38,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_bbd0c3214a7c737c8c2bfa316b?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_bbd0c3214a7c737c8c2bfa316b?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-01-20T07:24:56-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcmvqIP5JK4zuVoaSh2UT47hM=",
            "aggregates": {
                "active_time_total": 3489,
                "distance_total": 3588.08,
                "elapsed_time_total": 3488,
                "metabolic_energy_total": 2250992,
                "speed_avg": 1.03,
                "climb_total": 299.85,
                "descent_total": 299.31,
                "heartrate_avg": 105.87,
                "hrz_dist": [
                    2773,
                    662,
                    54,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f88a5960e99dbfe53701bb054d?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_f88a5960e99dbfe53701bb054d?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-01-19T07:29:56-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcmzAtjh-GFNmiAB3TIKQ9a-4=",
            "aggregates": {
                "active_time_total": 3577,
                "distance_total": 3598.34,
                "elapsed_time_total": 3576,
                "metabolic_energy_total": 2481112,
                "speed_avg": 1.01,
                "climb_total": 299.98,
                "descent_total": 305.09,
                "heartrate_avg": 108.69,
                "hrz_dist": [
                    2186,
                    1103,
                    288,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c26640ecc16246ba1fc9aad952?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_c26640ecc16246ba1fc9aad952?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-01-18T07:28:22-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagclJx4FtCHbGaZafgYAgBJ3fM=",
            "aggregates": {
                "active_time_total": 3534,
                "distance_total": 3580.89,
                "elapsed_time_total": 3533,
                "metabolic_energy_total": 2213336,
                "speed_avg": 1.01,
                "climb_total": 299.42,
                "descent_total": 302.16,
                "heartrate_avg": 107.49,
                "hrz_dist": [
                    2398,
                    855,
                    281,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_261b1d120a55bcc75fa7573bed?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_261b1d120a55bcc75fa7573bed?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2016-01-16T13:31:57-08:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagclsszdcseg6L2Kor98cHC1gg=",
            "aggregates": {
                "active_time_total": 1134,
                "distance_total": 3172.15,
                "steps_total": 2728,
                "elapsed_time_total": 1134,
                "metabolic_energy_total": 1380720,
                "speed_avg": 2.8,
                "climb_total": 50.1,
                "descent_total": 47.25,
                "heartrate_avg": 153.15,
                "hrz_dist": [
                    24,
                    144,
                    289,
                    497,
                    180
                ],
                "moving_time_total": 1094,
                "moving_speed_avg": 2.9
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1f09221b3464d60c731a034b70?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1f09221b3464d60c731a034b70?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-01-13T12:48:10-08:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagclwGWxEbSdEDBizOPCCEHU_U=",
            "aggregates": {
                "active_time_total": 1794,
                "distance_total": 5130.41,
                "steps_total": 4454,
                "elapsed_time_total": 1793,
                "metabolic_energy_total": 2288648,
                "speed_avg": 2.86,
                "climb_total": 39.28,
                "descent_total": 32.14,
                "heartrate_avg": 129.07,
                "hrz_dist": [
                    354,
                    438,
                    1003,
                    0,
                    0
                ],
                "moving_time_total": 1794,
                "moving_speed_avg": 2.86
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_15dd082d177717161b92b4dc98?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_15dd082d177717161b92b4dc98?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-01-08T12:28:19+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagckfhLYWp4RAxwTqShHGOaT_g=",
            "aggregates": {
                "active_time_total": 1958,
                "distance_total": 4938.99,
                "steps_total": 4715,
                "elapsed_time_total": 1958,
                "metabolic_energy_total": 2351408,
                "speed_avg": 2.52,
                "climb_total": 91.96,
                "descent_total": 87.55,
                "heartrate_avg": 122.84,
                "hrz_dist": [
                    440,
                    838,
                    633,
                    47,
                    0
                ],
                "moving_time_total": 1958,
                "moving_speed_avg": 2.52
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0df98f39e312aabdafe7300eb4?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0df98f39e312aabdafe7300eb4?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-01-06T12:04:49+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagckmWls_wtXCoorG82FkLUwf4=",
            "aggregates": {
                "active_time_total": 1995,
                "distance_total": 4952.07,
                "steps_total": 4819,
                "elapsed_time_total": 1994,
                "metabolic_energy_total": 2280280,
                "speed_avg": 2.48,
                "climb_total": 94.29,
                "descent_total": 91.48,
                "heartrate_avg": 125.26,
                "hrz_dist": [
                    305,
                    1063,
                    605,
                    22,
                    0
                ],
                "moving_time_total": 1991,
                "moving_speed_avg": 2.49
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_daccd6c4bb1c1d0aaebbe2c01b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_daccd6c4bb1c1d0aaebbe2c01b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-01-04T12:05:57+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagck68AAnHhq8gfDdZE76IRRAM=",
            "aggregates": {
                "active_time_total": 1953,
                "distance_total": 4898.4,
                "steps_total": 4740,
                "elapsed_time_total": 1952,
                "metabolic_energy_total": 2288648,
                "speed_avg": 2.51,
                "climb_total": 94.84,
                "descent_total": 91.26,
                "heartrate_avg": 148.17,
                "hrz_dist": [
                    85,
                    493,
                    743,
                    239,
                    393
                ],
                "moving_time_total": 1953,
                "moving_speed_avg": 2.51
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0313c89d2d5af62835620c5526?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0313c89d2d5af62835620c5526?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2016-01-01T12:23:28+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcrpLz0MAovtbFC_ganNMGGYk=",
            "aggregates": {
                "active_time_total": 1995,
                "distance_total": 4971.69,
                "steps_total": 4839,
                "elapsed_time_total": 1994,
                "metabolic_energy_total": 2368144,
                "speed_avg": 2.49,
                "climb_total": 91.67,
                "descent_total": 98.41,
                "heartrate_avg": 129.69,
                "hrz_dist": [
                    277,
                    665,
                    1046,
                    7,
                    0
                ],
                "moving_time_total": 1995,
                "moving_speed_avg": 2.49
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0c91c4c4765e8ec6867a6d6ded?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0c91c4c4765e8ec6867a6d6ded?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-30T12:18:26+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcqaGLxGFOeXhDb9ZGcXFegHk=",
            "aggregates": {
                "active_time_total": 2024,
                "distance_total": 4983.94,
                "steps_total": 4934,
                "elapsed_time_total": 2024,
                "metabolic_energy_total": 2389064,
                "speed_avg": 2.46,
                "climb_total": 93.29,
                "descent_total": 89.79,
                "heartrate_avg": 125.94,
                "hrz_dist": [
                    375,
                    730,
                    919,
                    0,
                    0
                ],
                "moving_time_total": 2024,
                "moving_speed_avg": 2.46
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4c869da5cacda7af9904acd06b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_4c869da5cacda7af9904acd06b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-28T12:23:30+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcq_bAp3rXlrwsLKSjgrDVi4I=",
            "aggregates": {
                "active_time_total": 1981,
                "distance_total": 4984.96,
                "steps_total": 4755,
                "elapsed_time_total": 1980,
                "metabolic_energy_total": 2384880,
                "speed_avg": 2.52,
                "climb_total": 91.8,
                "descent_total": 88,
                "heartrate_avg": 127.33,
                "hrz_dist": [
                    336,
                    715,
                    930,
                    0,
                    0
                ],
                "moving_time_total": 1977,
                "moving_speed_avg": 2.52
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0e3938d3fc4282661a81a3acf3?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0e3938d3fc4282661a81a3acf3?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-24T12:07:27+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcpZAwjjgaGeEg5PgaWfRkuGI=",
            "aggregates": {
                "active_time_total": 1649,
                "distance_total": 4326.04,
                "steps_total": 4007,
                "elapsed_time_total": 1648,
                "metabolic_energy_total": 1962296,
                "speed_avg": 2.62,
                "climb_total": 75.04,
                "descent_total": 82.87,
                "heartrate_avg": 127.5,
                "hrz_dist": [
                    219,
                    629,
                    801,
                    0,
                    0
                ],
                "moving_time_total": 1649,
                "moving_speed_avg": 2.62
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_b7b90362a4a1dcb3a217339352?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_b7b90362a4a1dcb3a217339352?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-24T12:07:25+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcp8d77SOD9iVPp4r_qjXvs5k=",
            "aggregates": {
                "active_time_total": 1649,
                "distance_total": 4299.06,
                "steps_total": 4431,
                "elapsed_time_total": 1648,
                "metabolic_energy_total": 1753096,
                "speed_avg": 2.61,
                "climb_total": 74.34,
                "descent_total": 83.32,
                "heartrate_avg": 131.26,
                "hrz_dist": [
                    235,
                    383,
                    961,
                    70,
                    0
                ],
                "moving_time_total": 1649,
                "moving_speed_avg": 2.61
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_80da746d6133cee33042f8759d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_80da746d6133cee33042f8759d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-21T12:04:40+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcoPQD-YLlMYvJw6SjR5e3Kmk=",
            "aggregates": {
                "active_time_total": 2077,
                "distance_total": 5029.76,
                "steps_total": 4851,
                "elapsed_time_total": 2077,
                "metabolic_energy_total": 2468560,
                "speed_avg": 2.42,
                "climb_total": 93.18,
                "descent_total": 86.13,
                "heartrate_avg": 128.4,
                "hrz_dist": [
                    309,
                    785,
                    969,
                    15,
                    0
                ],
                "moving_time_total": 2010,
                "moving_speed_avg": 2.5
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8a087dabfa971908e5f8702e06?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8a087dabfa971908e5f8702e06?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-21T12:04:39+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcoqNImpl83k-mgNZGtFY8IZI=",
            "aggregates": {
                "active_time_total": 2077,
                "distance_total": 4947.13,
                "steps_total": 5063,
                "elapsed_time_total": 2076,
                "metabolic_energy_total": 2041792,
                "speed_avg": 2.38,
                "climb_total": 94.11,
                "descent_total": 88.26,
                "heartrate_avg": 127.68,
                "hrz_dist": [
                    339,
                    811,
                    902,
                    25,
                    0
                ],
                "moving_time_total": 2013,
                "moving_speed_avg": 2.46
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d32098ca66ccb05d6de40bd403?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d32098ca66ccb05d6de40bd403?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-18T11:49:49+01:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcvDnjqwd-LzHQUx3Q8R7VTak=",
            "aggregates": {
                "active_time_total": 2046,
                "distance_total": 4936.98,
                "elapsed_time_total": 2045,
                "metabolic_energy_total": 1757280,
                "speed_avg": 2.41,
                "climb_total": 95.54,
                "descent_total": 88.63,
                "heartrate_avg": 123.7,
                "hrz_dist": [
                    449,
                    829,
                    768,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_334e20d10bbe05a174d7d0c609?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_334e20d10bbe05a174d7d0c609?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2015-12-18T11:49:48+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcvfNGGoqy2NPn8qSiCP4QyFQ=",
            "aggregates": {
                "active_time_total": 2050,
                "distance_total": 4929.03,
                "steps_total": 5314,
                "elapsed_time_total": 2049,
                "metabolic_energy_total": 1970664,
                "speed_avg": 2.4,
                "climb_total": 93.95,
                "descent_total": 91.97,
                "heartrate_avg": 121.87,
                "hrz_dist": [
                    619,
                    632,
                    799,
                    0,
                    0
                ],
                "moving_time_total": 2050,
                "moving_speed_avg": 2.4
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c8787660c0608ff5b5222a77a2?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c8787660c0608ff5b5222a77a2?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-16T12:11:42+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcv6QNeZErNxeIsdZH-z-bw68=",
            "aggregates": {
                "active_time_total": 2191,
                "distance_total": 5047.79,
                "steps_total": 5222,
                "elapsed_time_total": 2190,
                "metabolic_energy_total": 2355592,
                "speed_avg": 2.3,
                "climb_total": 90.66,
                "descent_total": 90.06,
                "heartrate_avg": 115.75,
                "hrz_dist": [
                    900,
                    839,
                    452,
                    0,
                    0
                ],
                "moving_time_total": 2191,
                "moving_speed_avg": 2.3
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_9fb7c057295cc00e82bc2fe689?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_9fb7c057295cc00e82bc2fe689?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-16T12:11:41+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcusA-DivUH31hlor-5VxIUaQ=",
            "aggregates": {
                "active_time_total": 2193,
                "distance_total": 4930.82,
                "steps_total": 5510,
                "elapsed_time_total": 2193,
                "metabolic_energy_total": 2050160,
                "speed_avg": 2.25,
                "climb_total": 94.05,
                "descent_total": 90.97,
                "heartrate_avg": 115.47,
                "hrz_dist": [
                    924,
                    829,
                    440,
                    0,
                    0
                ],
                "moving_time_total": 2190,
                "moving_speed_avg": 2.25
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_1ad9cebec52d35b6290c9c3982?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_1ad9cebec52d35b6290c9c3982?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-10T13:32:59-08:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagctKbOJ2kZkCBtXtZHPhj5YkQ=",
            "aggregates": {
                "active_time_total": 1789,
                "distance_total": 4101.2,
                "elapsed_time_total": 1789,
                "metabolic_energy_total": 1251016,
                "speed_avg": 2.29,
                "climb_total": 27.72,
                "descent_total": 33.33,
                "heartrate_avg": 107.32,
                "hrz_dist": [
                    1099,
                    525,
                    165,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_7323b6ad2c06d0ef95e75aab4d?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_7323b6ad2c06d0ef95e75aab4d?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2015-12-10T13:32:58-08:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagctWxrluTVZ8Ja_281x_g857k=",
            "aggregates": {
                "active_time_total": 1789,
                "distance_total": 4073.98,
                "steps_total": 4164,
                "elapsed_time_total": 1788,
                "metabolic_energy_total": 1677784,
                "speed_avg": 2.28,
                "climb_total": 39.83,
                "descent_total": 42.22,
                "heartrate_avg": 106.94,
                "hrz_dist": [
                    1093,
                    525,
                    171,
                    0,
                    0
                ],
                "moving_time_total": 1789,
                "moving_speed_avg": 2.28
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_adf5b613b05caaeaaa95fe0e2e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_adf5b613b05caaeaaa95fe0e2e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-08T15:49:20-08:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcscL9UNPmuEqEeYr-IHsq8E8=",
            "aggregates": {
                "active_time_total": 3088,
                "distance_total": 4352.82,
                "steps_total": 6275,
                "elapsed_time_total": 3087,
                "metabolic_energy_total": 1531344,
                "speed_avg": 1.41,
                "climb_total": 62.15,
                "descent_total": 290.31,
                "heartrate_avg": 88.65,
                "hrz_dist": [
                    3081,
                    7,
                    0,
                    0,
                    0
                ],
                "moving_time_total": 3059,
                "moving_speed_avg": 1.42
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_7c56b03332aff8976d653e84bf?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_7c56b03332aff8976d653e84bf?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-08T14:45:05-08:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcsl8TgkWzoGzcm0FpKlpkfkk=",
            "aggregates": {
                "active_time_total": 6953,
                "distance_total": 8752.24,
                "elapsed_time_total": 6952,
                "metabolic_energy_total": 3447616,
                "speed_avg": 1.26,
                "climb_total": 363.44,
                "descent_total": 357.32,
                "heartrate_avg": 93.77,
                "hrz_dist": [
                    6572,
                    359,
                    23,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_012cc1fdb2ce1248262bac9fe3?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_012cc1fdb2ce1248262bac9fe3?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2015-12-07T07:09:15-07:00",
            "activity_type": "freestyle",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcTGC6J_dppMJmzUFi21meLHc=",
            "aggregates": {
                "active_time_total": 3503,
                "distance_total": 3620.4,
                "elapsed_time_total": 3502,
                "metabolic_energy_total": 2531320,
                "speed_avg": 1.03,
                "climb_total": 307.72,
                "descent_total": 306.6,
                "heartrate_avg": 110.84,
                "hrz_dist": [
                    2070,
                    1012,
                    421,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ce23bab311bde8a12f4187af61?format=tcx&dv=4",
                "gpx": "/mysports/1/resource/Clone_ce23bab311bde8a12f4187af61?format=gpx&dv=4"
            }
        },
        {
            "local_start_datetime": "2015-12-07T07:09:13-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcT_1U9WE8vOQ-L4r10XjQonE=",
            "aggregates": {
                "active_time_total": 3501,
                "distance_total": 3576.1,
                "steps_total": 6121,
                "elapsed_time_total": 3501,
                "metabolic_energy_total": 1213360,
                "speed_avg": 1.02,
                "climb_total": 293.43,
                "descent_total": 297.46,
                "heartrate_avg": 113.24,
                "hrz_dist": [
                    1881,
                    905,
                    715,
                    0,
                    0
                ],
                "moving_time_total": 3212,
                "moving_speed_avg": 1.11
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_5b57eb0f250ea9ea1aeff9be95?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_5b57eb0f250ea9ea1aeff9be95?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-06T07:13:02-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcSQSJUE2WjKiP6h3bxTpNvnw=",
            "aggregates": {
                "active_time_total": 3352,
                "distance_total": 3829.96,
                "steps_total": 5897,
                "elapsed_time_total": 3352,
                "metabolic_energy_total": 1585736,
                "speed_avg": 1.14,
                "climb_total": 314.71,
                "descent_total": 313.42,
                "heartrate_avg": 113.99,
                "hrz_dist": [
                    1910,
                    994,
                    449,
                    0,
                    0
                ],
                "moving_time_total": 3075,
                "moving_speed_avg": 1.25
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_031e8387f98b51b97a19d4af60?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_031e8387f98b51b97a19d4af60?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-06T07:13:01-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcSplngtvDlI7XCNZMzxsDMHo=",
            "aggregates": {
                "active_time_total": 3350,
                "distance_total": 3628.01,
                "steps_total": 5951,
                "elapsed_time_total": 3349,
                "metabolic_energy_total": 1184072,
                "speed_avg": 1.08,
                "climb_total": 298.62,
                "descent_total": 298.79,
                "heartrate_avg": 113.11,
                "hrz_dist": [
                    1850,
                    890,
                    610,
                    0,
                    0
                ],
                "moving_time_total": 3121,
                "moving_speed_avg": 1.16
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_4b1874e09f07764bd1a0b0ab82?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_4b1874e09f07764bd1a0b0ab82?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-05T07:14:19-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcRP-Xq5kOG9PbwIr1FF-yA5o=",
            "aggregates": {
                "active_time_total": 3387,
                "distance_total": 3758.06,
                "steps_total": 5923,
                "elapsed_time_total": 3387,
                "metabolic_energy_total": 1552264,
                "speed_avg": 1.11,
                "climb_total": 310.11,
                "descent_total": 305.85,
                "heartrate_avg": 118.07,
                "hrz_dist": [
                    1728,
                    832,
                    827,
                    0,
                    0
                ],
                "moving_time_total": 3117,
                "moving_speed_avg": 1.21
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_ac506990a5e6d105425d3d4478?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_ac506990a5e6d105425d3d4478?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-05T07:14:18-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcRTUyGhTC7DHsYTOH7b93hmc=",
            "aggregates": {
                "active_time_total": 3386,
                "distance_total": 3620.95,
                "steps_total": 5970,
                "elapsed_time_total": 3385,
                "metabolic_energy_total": 1230096,
                "speed_avg": 1.07,
                "climb_total": 304.63,
                "descent_total": 299.66,
                "heartrate_avg": 118.58,
                "hrz_dist": [
                    1734,
                    695,
                    957,
                    0,
                    0
                ],
                "moving_time_total": 3108,
                "moving_speed_avg": 1.17
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d0167cf91db276f5c74216d18e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d0167cf91db276f5c74216d18e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-04T07:16:40-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcR2J5eQ9bA_WDIkFiHn78jZw=",
            "aggregates": {
                "active_time_total": 3343,
                "distance_total": 3730.4,
                "steps_total": 5884,
                "elapsed_time_total": 3343,
                "metabolic_energy_total": 1631760,
                "speed_avg": 1.12,
                "climb_total": 311.64,
                "descent_total": 310.08,
                "heartrate_avg": 118.35,
                "hrz_dist": [
                    1777,
                    595,
                    971,
                    0,
                    0
                ],
                "moving_time_total": 3076,
                "moving_speed_avg": 1.21
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_f79b9402d5758b355b8ea9121f?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_f79b9402d5758b355b8ea9121f?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-12-04T07:16:39-07:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcQZuk3CPxM7ky59ZMCjxhkZE=",
            "aggregates": {
                "active_time_total": 3340,
                "distance_total": 3633.59,
                "steps_total": 6104,
                "elapsed_time_total": 3340,
                "metabolic_energy_total": 1238464,
                "speed_avg": 1.09,
                "climb_total": 301.63,
                "descent_total": 295.53,
                "heartrate_avg": 119.1,
                "hrz_dist": [
                    1652,
                    560,
                    1128,
                    0,
                    0
                ],
                "moving_time_total": 3122,
                "moving_speed_avg": 1.16
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_764f191ee4b9bcc9e7f35304c9?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_764f191ee4b9bcc9e7f35304c9?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-29T10:18:01-05:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcQ8zvvzho3H1dpKSp-f3qmmo=",
            "aggregates": {
                "active_time_total": 18691,
                "distance_total": 43126.93,
                "steps_total": 43317,
                "elapsed_time_total": 18690,
                "metabolic_energy_total": 19752664,
                "speed_avg": 2.31,
                "climb_total": 483.02,
                "descent_total": 470.63,
                "heartrate_avg": 129.52,
                "hrz_dist": [
                    825,
                    9993,
                    7845,
                    28,
                    0
                ],
                "moving_time_total": 18353,
                "moving_speed_avg": 2.35
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_3f54ea2c1de2866eb057b6061e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_3f54ea2c1de2866eb057b6061e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-29T10:18:00-05:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcXJzhPyum2uEc1tZNRVXGc6w=",
            "aggregates": {
                "active_time_total": 17645,
                "distance_total": 40345.53,
                "steps_total": 45442,
                "elapsed_time_total": 17644,
                "metabolic_energy_total": 16941016,
                "speed_avg": 2.29,
                "climb_total": 5072.46,
                "descent_total": 5062.98,
                "heartrate_avg": 128.97,
                "hrz_dist": [
                    870,
                    9611,
                    7163,
                    0,
                    0
                ],
                "moving_time_total": 17321,
                "moving_speed_avg": 2.33
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_d35b8d1ecf17fd65d0fd90a795?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_d35b8d1ecf17fd65d0fd90a795?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-24T12:40:49+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcXVZEjqZqLQMrd28_vLUD9lE=",
            "aggregates": {
                "active_time_total": 2411,
                "distance_total": 5251.91,
                "steps_total": 5593,
                "elapsed_time_total": 2411,
                "metabolic_energy_total": 1606656,
                "speed_avg": 2.18,
                "climb_total": 101.27,
                "descent_total": 92.01,
                "heartrate_avg": 107.6,
                "hrz_dist": [
                    1637,
                    712,
                    62,
                    0,
                    0
                ],
                "moving_time_total": 2411,
                "moving_speed_avg": 2.18
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e7c0a17b36a5a599055d53bffd?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_e7c0a17b36a5a599055d53bffd?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-24T12:40:48+01:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcXsuqXDA_NSVzlaSotpRNeFc=",
            "aggregates": {
                "active_time_total": 2410,
                "distance_total": 5013.18,
                "steps_total": 5973,
                "elapsed_time_total": 2409,
                "metabolic_energy_total": 2117104,
                "speed_avg": 2.08,
                "climb_total": 98.7,
                "descent_total": 91.27,
                "heartrate_avg": 107.28,
                "hrz_dist": [
                    1629,
                    688,
                    93,
                    0,
                    0
                ],
                "moving_time_total": 2410,
                "moving_speed_avg": 2.08
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a94622471bc308160820f11bcd?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_a94622471bc308160820f11bcd?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-20T12:11:14+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcWDJ3-RyVBWnCUDOGotbQZFo=",
            "aggregates": {
                "active_time_total": 1637,
                "distance_total": 4296.92,
                "steps_total": 4012,
                "elapsed_time_total": 1637,
                "metabolic_energy_total": 1347248,
                "speed_avg": 2.62,
                "climb_total": 69.46,
                "descent_total": 82.76,
                "heartrate_avg": 125.71,
                "hrz_dist": [
                    332,
                    577,
                    729,
                    0,
                    0
                ],
                "moving_time_total": 1637,
                "moving_speed_avg": 2.62
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_6b8d766b08cd62b5228c1d2c19?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_6b8d766b08cd62b5228c1d2c19?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-20T12:11:13+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcWfjSSJFZ8ov18Yr0WzYV4ac=",
            "aggregates": {
                "active_time_total": 1638,
                "distance_total": 4283.43,
                "steps_total": 4585,
                "elapsed_time_total": 1636,
                "metabolic_energy_total": 1803304,
                "speed_avg": 2.62,
                "climb_total": 69.68,
                "descent_total": 84.03,
                "heartrate_avg": 125.52,
                "hrz_dist": [
                    343,
                    578,
                    717,
                    0,
                    0
                ],
                "moving_time_total": 1634,
                "moving_speed_avg": 2.62
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8de6307e4b3bc7d7c134598f5d?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8de6307e4b3bc7d7c134598f5d?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-17T13:03:44+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcWmU8mgcM6q2tE0FjURdbb6E=",
            "aggregates": {
                "active_time_total": 1582,
                "distance_total": 4300.52,
                "steps_total": 5957,
                "elapsed_time_total": 1580,
                "metabolic_energy_total": 1807488,
                "speed_avg": 2.72,
                "climb_total": 70.42,
                "descent_total": 80.61,
                "heartrate_avg": 128.64,
                "hrz_dist": [
                    232,
                    533,
                    817,
                    0,
                    0
                ],
                "moving_time_total": 1582,
                "moving_speed_avg": 2.72
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_c03e4295cc257e332f739b5061?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_c03e4295cc257e332f739b5061?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-17T13:03:43+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcVAPMs0XBZfCh2x3ailPqXEE=",
            "aggregates": {
                "active_time_total": 1580,
                "distance_total": 4390.38,
                "steps_total": 3945,
                "elapsed_time_total": 1580,
                "metabolic_energy_total": 1313776,
                "speed_avg": 2.78,
                "climb_total": 73.59,
                "descent_total": 87.65,
                "heartrate_avg": 130.87,
                "hrz_dist": [
                    124,
                    566,
                    874,
                    16,
                    0
                ],
                "moving_time_total": 1580,
                "moving_speed_avg": 2.78
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0ea31d3a7d3986440b192d49d0?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0ea31d3a7d3986440b192d49d0?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-13T12:44:37+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcV54iYdOUfdb5OdZNgHKk0kc=",
            "aggregates": {
                "active_time_total": 1610,
                "distance_total": 4280.67,
                "steps_total": 6369,
                "elapsed_time_total": 1610,
                "metabolic_energy_total": 1811672,
                "speed_avg": 2.66,
                "climb_total": 70.42,
                "descent_total": 82.31,
                "heartrate_avg": 124.2,
                "hrz_dist": [
                    298,
                    811,
                    501,
                    0,
                    0
                ],
                "moving_time_total": 1610,
                "moving_speed_avg": 2.66
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_cfe0f77f24860ea9f80f3fc570?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_cfe0f77f24860ea9f80f3fc570?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-13T12:44:36+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcUK1adXLyunh_XfgRbdD8S7c=",
            "aggregates": {
                "active_time_total": 1609,
                "distance_total": 4309.42,
                "steps_total": 4025,
                "elapsed_time_total": 1609,
                "metabolic_energy_total": 1351432,
                "speed_avg": 2.68,
                "climb_total": 73.17,
                "descent_total": 78.91,
                "heartrate_avg": 124.96,
                "hrz_dist": [
                    286,
                    823,
                    500,
                    0,
                    0
                ],
                "moving_time_total": 1605,
                "moving_speed_avg": 2.68
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_0d2de98b58ce0c2557369cd9b5?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_0d2de98b58ce0c2557369cd9b5?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-11T12:30:41+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcUvoRFmlrVbwQHor0nhF3QEw=",
            "aggregates": {
                "active_time_total": 2317,
                "distance_total": 5252.61,
                "steps_total": 5467,
                "elapsed_time_total": 2316,
                "metabolic_energy_total": 1535528,
                "speed_avg": 2.27,
                "climb_total": 78.28,
                "descent_total": 93.18,
                "heartrate_avg": 112.25,
                "hrz_dist": [
                    1064,
                    1130,
                    123,
                    0,
                    0
                ],
                "moving_time_total": 2317,
                "moving_speed_avg": 2.27
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a3cc298e1098ebe8c42810b824?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_a3cc298e1098ebe8c42810b824?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-11T12:30:40+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcUzC0p-Snol4nvzOGZ_GyxbE=",
            "aggregates": {
                "active_time_total": 2316,
                "distance_total": 5119.91,
                "steps_total": 5767,
                "elapsed_time_total": 2315,
                "metabolic_energy_total": 2041792,
                "speed_avg": 2.21,
                "climb_total": 80.15,
                "descent_total": 92.41,
                "heartrate_avg": 106.72,
                "hrz_dist": [
                    1481,
                    708,
                    127,
                    0,
                    0
                ],
                "moving_time_total": 2316,
                "moving_speed_avg": 2.21
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_80a0671da78221715f98ba351c?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_80a0671da78221715f98ba351c?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-09T12:24:16+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcbFoMFk73WISS-m8950Euk8A=",
            "aggregates": {
                "active_time_total": 1537,
                "distance_total": 4305.83,
                "steps_total": 3835,
                "elapsed_time_total": 1536,
                "metabolic_energy_total": 1979032,
                "speed_avg": 2.8,
                "climb_total": 71.24,
                "descent_total": 82.53,
                "heartrate_avg": 127.3,
                "hrz_dist": [
                    280,
                    460,
                    797,
                    0,
                    0
                ],
                "moving_time_total": 1537,
                "moving_speed_avg": 2.8
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_e45bdc1a3fe277eeaa1606da5c?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_e45bdc1a3fe277eeaa1606da5c?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-09T12:24:14+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcbZCpp8M7r2alW9ZPHqHrFj0=",
            "aggregates": {
                "active_time_total": 1536,
                "distance_total": 4292.7,
                "steps_total": 3921,
                "elapsed_time_total": 1536,
                "metabolic_energy_total": 1815856,
                "speed_avg": 2.79,
                "climb_total": 73.22,
                "descent_total": 81.71,
                "heartrate_avg": 128.08,
                "hrz_dist": [
                    307,
                    395,
                    832,
                    2,
                    0
                ],
                "moving_time_total": 1536,
                "moving_speed_avg": 2.79
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_69f9376b746e9c9c04e001cb25?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_69f9376b746e9c9c04e001cb25?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-06T12:01:49+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcaPSa0HnEhwxMfIr2AMI4hDY=",
            "aggregates": {
                "active_time_total": 4831,
                "distance_total": 12333.9,
                "steps_total": 11752,
                "elapsed_time_total": 4829,
                "metabolic_energy_total": 5786472,
                "speed_avg": 2.55,
                "climb_total": 202.63,
                "descent_total": 245.04,
                "heartrate_avg": 128.7,
                "hrz_dist": [
                    341,
                    2547,
                    1943,
                    0,
                    0
                ],
                "moving_time_total": 4831,
                "moving_speed_avg": 2.55
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_361e5237ba2d712fc0d0146f04?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_361e5237ba2d712fc0d0146f04?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-06T12:01:47+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcaqPRs2JdaMgjP_gT8wOzj80=",
            "aggregates": {
                "active_time_total": 4830,
                "distance_total": 12131.33,
                "steps_total": 12379,
                "elapsed_time_total": 4829,
                "metabolic_energy_total": 5146320,
                "speed_avg": 2.51,
                "climb_total": 197,
                "descent_total": 235.01,
                "heartrate_avg": 128.3,
                "hrz_dist": [
                    420,
                    2372,
                    2037,
                    0,
                    0
                ],
                "moving_time_total": 4830,
                "moving_speed_avg": 2.51
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_08b275a0d9cdd922f344e9e278?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_08b275a0d9cdd922f344e9e278?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-04T12:26:01+02:00",
            "activity_type": "treadmill",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagca2l0Au-RnyoUnkFhCuN2CjA=",
            "aggregates": {
                "active_time_total": 2705,
                "distance_total": 5700,
                "steps_total": 6974,
                "elapsed_time_total": 2704,
                "metabolic_energy_total": 2221704,
                "speed_avg": 2.11,
                "heartrate_avg": 115.08,
                "hrz_dist": [
                    1207,
                    529,
                    969,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_a244ceeeebcd287bb0325f8e2c?format=tcx&dv=4"
            }
        },
        {
            "local_start_datetime": "2015-11-04T12:26:00+02:00",
            "activity_type": "treadmill",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcZMUhmiCQ55Uv96SqKEcCvC0=",
            "aggregates": {
                "active_time_total": 2705,
                "distance_total": 5700,
                "steps_total": 4384,
                "elapsed_time_total": 2704,
                "metabolic_energy_total": 1087840,
                "speed_avg": 2.11,
                "heartrate_avg": 116.74,
                "hrz_dist": [
                    1025,
                    677,
                    1003,
                    0,
                    0
                ]
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_cba80fb87e71e9338cc725a841?format=tcx&dv=4"
            }
        },
        {
            "local_start_datetime": "2015-11-02T12:02:57+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcZQ-EK61cEHcYVh3Y0afHOdA=",
            "aggregates": {
                "active_time_total": 1582,
                "distance_total": 4291.8,
                "steps_total": 3839,
                "elapsed_time_total": 1580,
                "metabolic_energy_total": 1878616,
                "speed_avg": 2.71,
                "climb_total": 73.14,
                "descent_total": 81.68,
                "heartrate_avg": 129.66,
                "hrz_dist": [
                    235,
                    385,
                    960,
                    2,
                    0
                ],
                "moving_time_total": 1582,
                "moving_speed_avg": 2.71
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_8127d8f36b11bed022a531f73b?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_8127d8f36b11bed022a531f73b?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-11-02T12:02:56+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcZpJq-TsJCFFAtNZP24aJt9Y=",
            "aggregates": {
                "active_time_total": 1581,
                "distance_total": 4320.76,
                "steps_total": 4025,
                "elapsed_time_total": 1580,
                "metabolic_energy_total": 1836776,
                "speed_avg": 2.73,
                "climb_total": 70.62,
                "descent_total": 82.24,
                "heartrate_avg": 125.16,
                "hrz_dist": [
                    370,
                    400,
                    804,
                    7,
                    0
                ],
                "moving_time_total": 1581,
                "moving_speed_avg": 2.73
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_236ce0aa70a5f2ed53423ac52e?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_236ce0aa70a5f2ed53423ac52e?format=gpx&dv=5"
            }
        },
        {
            "local_start_datetime": "2015-10-30T11:54:29+02:00",
            "activity_type": "running",
            "id": "Qc9iVaF9jfePvhL0Y-qFr4NGpxxWHagcYGu3XBejOB3xcUFhz8QUq9s=",
            "aggregates": {
                "active_time_total": 2394,
                "distance_total": 6276.47,
                "steps_total": 5815,
                "elapsed_time_total": 2393,
                "metabolic_energy_total": 2707048,
                "speed_avg": 2.62,
                "climb_total": 86.82,
                "descent_total": 117.82,
                "heartrate_avg": 129.83,
                "hrz_dist": [
                    214,
                    918,
                    1262,
                    0,
                    0
                ],
                "moving_time_total": 2394,
                "moving_speed_avg": 2.62
            },
            "raw_aggregates": {},
            "links": {
                "tcx": "/mysports/1/resource/Clone_dd93e52e5a0870fdd61614fe05?format=tcx&dv=5",
                "gpx": "/mysports/1/resource/Clone_dd93e52e5a0870fdd61614fe05?format=gpx&dv=5"
            }
        }
    ]
}');
    }

    /**
     * @param array $activityListArray
     */
    private function processActivityList($activityListArray)
    {
        foreach($activityListArray as $activity) {
            // Check if activity is already synced
            // If not queueActivity with needed identifier
        }

    }

    /*
     * @link https://developer.tomtom.com/tomtom-sports-cloud/tomtom-sports-cloud-documentation/get-startstop-activity
     */
    public function fetchActivity($identifier)
    {
        $url = Provider\TomTomMySports::BASE_MYSPORTS_URL.$identifier;
        $request = $this->client->getAuthenticatedRequest('GET', $url, $this->accessToken);

    }

    private function processActivity()
    {
        //Do what is needed to import that activity->
        //Call Parser/Importers
    }
}