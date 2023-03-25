<?php  

require_once 'vendor/autoload.php';

set_time_limit(0);
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/tmp/cookies.txt" , '');

function request($url, $postdata = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36');

    curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'] . "/tmp/cookies.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'] . "/tmp/cookies.txt");

    $headers = [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2Nzk3MTM5MDgsImV4cCI6MTY3OTcxNzUwOCwibG9naW4iOiJiaWx5YXZrYSJ9.iUBJUc_z5Pyt2vNBxKsryoC4cIaKZi1_CCJADZDZX5FVdU1aRu8Q6_uB3hksCS-8vXwGh_6U2o9BawtujPc8H2Hn8lAL1otELIR9SAchyVl2eCCzbxlPbDrw2AscSHTAICXD4O5h70ICb6h9OkkZtOvN9vtLFJXlyW5TfvqHSj9XTBxWZf-EpKrhjxY5ypHy_LH_CyuBfbxUFW_sZtlhLAMW-B2Xi8GcFZVmGnGvuyUOhZMDIGCSTf7mdR9_0cbSINzpJPObJUsIjo6UO3L5fVEjkwW_qumPYb8ZfwM3RTn2_0L09Q5VqciKqs0oe-pM_8THobqVisHDcicGKcvjnvM4vuYJdAJfB7FiLCbfXxY07LqRX1R68ZvvuVTCLJpw5hO4cG9GTaZmBYdOTcyFYygyFbDO91lPai4a_AvzpgoMckzZDysNOBcNPRQkkWgJB2Vrdm-OdTgqFU7Lgks5tvwb0HPbcMyBB_w4AOncqjJPOeo87DB4U0ESw911ShhRo80xDi_C8dknSiWZfHIAEjIIiLtoM33WHKTMeMp1PihIP6v-rVa2MJ-CiNwqTAbIrvgOgFiRev4PmFJtV0u5gBiHA561D-OeKcV2ICewRFpWIwJONGlCXrWP5fXxI3uvOqPiivcmVYC67EqhCh8oOSkRY3P_XykuUeoBsgAJ8EU'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if($postdata) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    }

    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}


$post = [
    'lang' => 'ru',
    'r' => 'https://api-links.sape.ru/app_seo/search/rent/projectId/29400?isOpenUrl=true&urlId=191883',
    'username' => 'bilyavka',
    'password' => 'fdj588ksdjjk',
    'bindip' => '0',

];

request('https://auth.sape.ru/login', $post);

$count = 1;


$file = fopen('result.csv', 'a');
$headers = ['Домен', 'ИКС', 'Яндекс индекс', 'Google индекс ', 'CF','TF','DA','DR','Трафик', 'Цена, в мес., р', 'Цена главной, в мес., р'];
fputcsv($file, $headers, ';');


for ($i=1; $i <= 6; $i++) { 
    $post = '{
        "urlId": 129099728,
        "projectId": 3643259,
        "pageResultsSize": 1000,
        "pageResultsNumber":' . $i . ',
        "newSearch": true,
        "order": 0,
        "isInFavoriteLists": false,
        "isNewSite": false,
        "priceFrom": null,
        "priceTo": null,
        "isSmartSearchUsed": false,
        "smartSearchContentText": "",
        "ahrefsDomainRatingFrom": null,
        "ahrefsDomainRatingTo": null,
        "sqiFrom": null,
        "sqiTo": null,
        "mjCfFrom": null,
        "mjCfTo": null,
        "mjTfFrom": null,
        "mjTfTo": null,
        "mozDomainAuthorityFrom": null,
        "mozDomainAuthorityTo": null,
        "domainNofVisitorsFrom": null,
        "trFrom": null,
        "trTo": null,
        "extLinksTo": null,
        "domainLevel": 0,
        "pageLevel1": false,
        "pageLevel2": false,
        "pageLevel3": false,
        "daysOldWhoisFrom": null,
        "ahrefsTotalKeywordsFrom": null,
        "ahrefsTotalKeywordsTo": null,
        "ahrefsTotalBacklinksFrom": null,
        "ahrefsTotalBacklinksTo": null,
        "intRankFrom": null,
        "intRankTo": null,
        "nofPagesInGoogle": null,
        "nofPagesInYandex": null,
        "categories": [],
        "regions": [],
        "siteLanguages": [],
        "domainZones": [],
        "wordsType": 0,
        "words": "",
        "wordsProximity": 10,
        "schemasAccess": 0,
        "dateAdded": 0,
        "isOpenUrl": true,
        "isDouble": false,
        "self": false,
        "noDoubleInProject": null,
        "noDoubleInFolder": "",
        "linksDisplayMode": -1,
        "siteIds": null,
        "pageIds": null,
        "pagesPerSite": "preferred",
        "filterAg": [],
        "filterCatAgFilterOr": false,
        "inYandexGoogle": 0
    }';
    
    $response = json_decode(request('https://api-links.sape.ru/rest/Search/rent/tree', $post), true);
    $jobHandleID = $response['jobHandleId'];
    
    json_decode(request('https://api-links.sape.ru/rest/Search/rent/tree/getResult/jobHandleId/' . $jobHandleID), true);

    sleep(10);
    $response = json_decode(request('https://api-links.sape.ru/rest/Search/rent/tree/getResult/jobHandleId/' . $jobHandleID), true);
    
    
    
    if (isset($response['data']['resultList'])) {
        foreach ($response['data']['resultList'] as $arr) {
            $line = [
                $arr['url'], 
                $arr['sqi'],
                $arr['nofPagesInYandex'], 
                $arr['nofPagesInGoogle'], 
                $arr['mjCf'], 
                $arr['mjTf'], 
                $arr['mozDomainAuthority'], 
                $arr['ahrefsDomainRank'],
                $arr['traffic'],
                $arr['priceFrom'],
                $arr['priceTo']
            ];
        
            fputcsv($file, $line, ';');
        
        }
    }
}

fclose($file);

