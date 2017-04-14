<?php

/**
 * Created by PhpStorm.
 * User: longthanh
 * Date: 13/04/2017
 * Time: 11:14
 */
use PHPHtmlParser\Dom;
class Process
{
    static $arrTLDDomainMap = array('ac'=>'google.ac','ad'=>'google.ad','ae'=>'google.ae','af'=>'google.com.af','ag'=>'google.com.ag','ai'=>'google.com.ai','al'=>'google.al','am'=>'google.am','ao'=>'google.co.ao','ar'=>'google.com.ar','as'=>'google.as','at'=>'google.at','au'=>'google.com.au','az'=>'google.az','ba'=>'google.ba','bd'=>'google.com.bd','be'=>'google.be','bf'=>'google.bf','bg'=>'google.bg','bh'=>'google.com.bh','bi'=>'google.bi','bj'=>'google.bj','bn'=>'google.com.bn','bo'=>'google.com.bo','br'=>'google.com.br','bs'=>'google.bs','bt'=>'google.bt','bw'=>'google.co.bw','by'=>'google.by','bz'=>'google.com.bz','ca'=>'google.ca','cat'=>'google.cat','cc'=>'google.cc','cd'=>'google.cd','cf'=>'google.cf','cg'=>'google.cg','ch'=>'google.ch','ci'=>'google.ci','ck'=>'google.co.ck','cl'=>'google.cl','cm'=>'google.cm','cn'=>'google.cn','co'=>'google.com.co','cr'=>'google.co.cr','cu'=>'google.com.cu','cv'=>'google.cv','cy'=>'google.com.cy','cz'=>'google.cz','de'=>'google.de','dj'=>'google.dj','dk'=>'google.dk','dm'=>'google.dm','do'=>'google.com.do','dz'=>'google.dz','ec'=>'google.com.ec','ee'=>'google.ee','eg'=>'google.com.eg','es'=>'google.es','et'=>'google.com.et','fi'=>'google.fi','fj'=>'google.com.fj','fm'=>'google.fm','fr'=>'google.fr','ga'=>'google.ga','ge'=>'google.ge','gf'=>'google.gf','gg'=>'google.gg','gh'=>'google.com.gh','gi'=>'google.com.gi','gl'=>'google.gl','gm'=>'google.gm','gp'=>'google.gp','gr'=>'google.gr','gt'=>'google.com.gt','gy'=>'google.gy','hk'=>'google.com.hk','hn'=>'google.hn','hr'=>'google.hr','ht'=>'google.ht','hu'=>'google.hu','id'=>'google.co.id','ie'=>'google.ie','il'=>'google.co.il','im'=>'google.im','in'=>'google.co.in','io'=>'google.io','iq'=>'google.iq','is'=>'google.is','it'=>'google.it','je'=>'google.je','jm'=>'google.com.jm','jo'=>'google.jo','jp'=>'google.co.jp','ke'=>'google.co.ke','kg'=>'google.kg','kh'=>'google.com.kh','ki'=>'google.ki','kr'=>'google.co.kr','kw'=>'google.com.kw','kz'=>'google.kz','la'=>'google.la','lb'=>'google.com.lb','lc'=>'google.com.lc','li'=>'google.li','lk'=>'google.lk','ls'=>'google.co.ls','lt'=>'google.lt','lu'=>'google.lu','lv'=>'google.lv','ly'=>'google.com.ly','ma'=>'google.co.ma','md'=>'google.md','me'=>'google.me','mg'=>'google.mg','mk'=>'google.mk','ml'=>'google.ml','mm'=>'google.com.mm','mn'=>'google.mn','ms'=>'google.ms','mt'=>'google.com.mt','mu'=>'google.mu','mv'=>'google.mv','mw'=>'google.mw','mx'=>'google.com.mx','my'=>'google.com.my','mz'=>'google.co.mz','na'=>'google.com.na','ne'=>'google.ne','nf'=>'google.com.nf','ng'=>'google.com.ng','ni'=>'google.com.ni','nl'=>'google.nl','no'=>'google.no','np'=>'google.com.np','nr'=>'google.nr','nu'=>'google.nu','nz'=>'google.co.nz','om'=>'google.com.om','pa'=>'google.com.pa','pe'=>'google.com.pe','pg'=>'google.com.pg','ph'=>'google.com.ph','pk'=>'google.com.pk','pl'=>'google.pl','pn'=>'google.co.pn','pr'=>'google.com.pr','ps'=>'google.ps','pt'=>'google.pt','py'=>'google.com.py','qa'=>'google.com.qa','ro'=>'google.ro','rs'=>'google.rs','ru'=>'google.ru','rw'=>'google.rw','sa'=>'google.com.sa','sb'=>'google.com.sb','sc'=>'google.sc','se'=>'google.se','sg'=>'google.com.sg','sh'=>'google.sh','si'=>'google.si','sk'=>'google.sk','sl'=>'google.com.sl','sm'=>'google.sm','sn'=>'google.sn','so'=>'google.so','sr'=>'google.sr','st'=>'google.st','sv'=>'google.com.sv','td'=>'google.td','tg'=>'google.tg','th'=>'google.co.th','tj'=>'google.com.tj','tk'=>'google.tk','tl'=>'google.tl','tm'=>'google.tm','tn'=>'google.tn','to'=>'google.to','tr'=>'google.com.tr','tt'=>'google.tt','tw'=>'google.com.tw','tz'=>'google.co.tz','ua'=>'google.com.ua','ug'=>'google.co.ug','uk'=>'google.co.uk','uy'=>'google.com.uy','uz'=>'google.co.uz','vc'=>'google.com.vc','ve'=>'google.co.ve','vg'=>'google.vg','vi'=>'google.co.vi','vn'=>'google.com.vn','vu'=>'google.vu','ws'=>'google.ws','za'=>'google.co.za','zm'=>'google.co.zm','zw'=>'google.co.zw');
    static function getDomainTLD($tld){
        $domain=Process::$arrTLDDomainMap[$tld];
        if(!$domain){
            $domain="google.com";
        }
        return "https://www.$domain";
    }
    public static function search($query,$tld='',$tbm=''){
        $domain=Process::getDomainTLD($tld);
		$q=mb_substr($query, 0, 100, UTF8_CODE);
		$q=urlencode($q);
        $now=time();
        $additionVal1=rand(0,100);
        $additionVal2=rand(0,1000);
        $bvm='bv.'.($now+$additionVal1).',d.dGo';
        $fp='f'.Utils::generateRandomString(15);
        $psi=Utils::generateRandomString(22.).'.'.($now+$additionVal2).'.1';
        // $tbm='' vid -- video; isch -- images; nws --news; bks --books; nothing --all
        $urlInfo = "$domain/s?sclient=psy-ab&biw=1600&bih=769&tbm=$tbm&q=$q&oq=&gs_l=&pbx=1&bav=on.2%2Cor.&bvm=$bvm&fp=$fp&sns=1&pf=p&tch=1&ech=66&psi=$psi";
        $data = file_get_contents($urlInfo);

        $arrData = explode("/*\"\"*/", $data);
        $dom = new Dom;
        $webContent="";
        foreach ($arrData as $item) {
            if(strlen($item)>0) {
                try{
                    $item=Utils::utf8ize($item);
                    $tmp = json_decode($item);
                    $webContent .= $tmp->d;
                }catch (Exception $ex){
                    echo $ex->getMessage();
                }

            }
        }
        $dom->load($webContent);
        $results=$dom->find("div#ires div.g");
          $mainContent=null;
        $titleDom=null;
        $citeDom=null;
        $desDom=null;
        $titleText=null;
        $linkText=null;
		$citeText=null;
        $desText=null;
        $objSearch=null;
		$tmpData=null;
        $arrSearchs= array();
        foreach ($results as $result){
            $mainContent=$result->find("div.s");
            if(count($mainContent)>0){
                $titleDom=$result->find("h3.r a");
                $citeDom=$mainContent[0]->find("cite");
                $desDom=$mainContent[0]->find("span.st");
                if(count($titleDom)>0 && count($citeDom)>0 &&count($desDom)>0){
                    $titleText=$titleDom[0]->innerHtml();
					$linkText=$titleDom[0]->getAttribute('href');
					parse_str($linkText,$tmpData);
					$linkText=$tmpData['/url?q'];
                    $citeText=$citeDom[0]->innerHtml();
                    $desText=$desDom[0]->innerHtml();
                    $objSearch=array('title'=>$titleText,'link'=>$linkText,'cite'=>$citeText,'description'=>$desText);
                    $arrSearchs[]=$objSearch;
                }
            }
        }
        //echo "<pre>";
        //header('Content-Type: application/json');
    echo json_encode(array('items'=> array_values($arrSearchs)));
    }
}