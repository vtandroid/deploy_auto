<?php
if (isset($_POST['key']) && isset($_POST['language']) && isset($_POST['country'])) {
    try {
        $keyword = $_POST['key'];
        $language = $_POST['language'];
        $country = $_POST['country'];
        $keyword = urlencode($keyword);
            $url = "http://www.google.com/complete/search?client=chrome&q=$keyword&hl=$language&gl=$country&ds=yt";
            error_log($url);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:46.0) Gecko/20100101 Firefox/46.0');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // read more about HTTPS http://stackoverflow.com/questions/31162706/how-to-scrape-a-ssl-or-https-url/31164409#31164409
            $response = curl_exec($ch);
            curl_close($ch);
            //$response = preg_replace('#https?://.+,|,https?://.+#', '', $response);
			
            $DataJson = json_decode($response);
            $resultSearch = implode("@,@", $DataJson[1]);
        echo $resultSearch;
    } catch (Exception $ex) {
        error_log($ex->getTraceAsString());
    }
}
?>