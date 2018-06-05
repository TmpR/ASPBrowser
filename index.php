<?php
include_once __DIR__.'/simple_html_dom.php';
include_once __DIR__.'/ASPBrowser.php';
                                       

/**Remove spaces from string
 * @param $s
 * @return string
 */
function removeSpaces($s) {
    return trim(preg_replace('!\s+!', ' ', $s));
}



function getAddresses(simple_html_dom $dom) {

	foreach($dom->find('option') as $option) {
        if($option->value) $vars[$option->value] = $option->innertext;
      
    }

	return $vars;

}



$url = 'https://apps.wigan.gov.uk/MyNeighbourhood/';
$browser = new ASPBrowser();
$browser->doGetRequest($url); 
$resultPage = $browser->doPostRequest($url, array('ctl00$ContentPlaceHolder1$txtPostcode' => $_GET['postcode'])); 

print_r(getAddresses($resultPage));


$resultPage = $browser->doPostBack($url, 'ctl00$ContentPlaceHolder1$lstAddresses', 'UPRN100011709213'); 
echo $resultPage;

$resultPage = $browser->doGetRequest('https://apps.wigan.gov.uk/MyNeighbourhood/MyArea.aspx'); 
echo $resultPage;

$resultPage->clear();


