<html>
<head>
 <title>Progamme tv</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>

<?php
date_default_timezone_set('Etc/GMT-2');
$url = "https://xmltv.ch/xmltv/xmltv-tnt.xml";
//$url = "https://discordiptv.com/epg/guide.xml";
//$url = "http://xmltv.remysimpson.fr/xmltv/remysimpson_xmltv.xml";
//$url = "https://xmltv.ch/xmltv/xmltv-complet.xml";
//$url = "https://raw.githubusercontent.com/Catch-up-TV-and-More/xmltv/master/tv_guide_fr.xml";
$xml = simplexml_load_file($url);
$me = "sub-title";
$channels = array();


function time_to_pourcent($Start,$End)
{
    $daate=date('Y-m-d H:i:s');
    $todays_date=strtotime($daate);
    $start_date= strtotime($Start);;
    $end_date = strtotime($End);;
    $total = $end_date - $start_date;
    $part = $todays_date - $start_date;
    $percent = $part/$total * 100;
    return "<progress class='progress-bar' max='100' value='".$percent."'></progress>";
}


function calculate_time_span($d){
  
    $start_date = new DateTime($d);
    $diff = $start_date->diff(new DateTime($daate));
    
    $temps_passer=$diff->h.'h'.$diff->i.'min';

    return "<div class='progress-insight'>Commencé il y a ".$temps_passer."</div>";
    
}

function StringLink($ch)
{
   switch ($ch) {
     case "TF1":
        return "<a href='go:TF1'>";
        break;
     case "France 2":
        return "<a href='go:FRANCE2'>";
        break;
    case "France 24":
        return "<a href='go:FRANCE24'>";
        break;
    case "France 3":
        return "<a href='go:FRANCE3'>";
        break;
     case "France 4":
        return "<a href='go:FRANCE4'>";
        break;
    case "France 5":
        return "<a href='go:FRANCE5'>";
        break;
     case "TF1 Séries Films":
        return "<a href='go:TF1 Series'>";
        break;
    case "LCI":
        return "<a href='go:LCI'>";
        break;
     case "C8":
        return "<a href='go:C8'>";
        break;
    case "TFX":
        return "<a href='go:TFX'>";
        break;
     case "TMC":
        return "<a href='go:TMC'>";
        break;
    case "W9":
        return "<a href='go:W9'>";
        break;
     case "NRJ 12":
        return "<a href='go:NRJ12'>";
        break; 
    case "La Chaîne parlementaire":
        return "<a href='go:LCP'>";
        break;
     case "BFMTV":
        return "<a href='go:BFMTV'>";
        break;
    case "CNEWS":
        return "<a href='go:CNEWS'>";
        break;
     case "RTL9":
        return "<a href='go:RTL9'>";
        break;
    case "CSTAR":
        return "<a href='go:CSTAR'>";
        break;
     case "Gulli":
        return "<a href='go:GULLI'>";
        break;
    case "L'Equipe":
        return "<a href='go:LEQUIPE'>";
        break;
     case "6ter":
        return "<a href='go:6TER'>";
        break; 
    case "RMC Story":
        return "<a href='go:RMC Story'>";
        break;
     case "RMC Découverte":
        return "<a href='go:RMCD'>";
        break;
    case "Chérie 25":
        return "<a href='go:CHERIE25'>";
        break;
     case "LCI":
        return "<a href='go:LCI'>";
        break;
    case "Franceinfo":
        return "<a href='go:FRANCEINFO'>";
        break;
    case "M6":
        return "<a href='go:M6'>";
        break;
    case "Canal+":
        return "<a class='lien' href='go:CANALp'>";
        break;
    case "Arte":
        return "<a href='go:ARTE'>";
        break;
   }
   return "";
}





foreach ($xml->channel as $c) {
    $channels[ $c['id']->__toString() ] = $c->{'display-name'}->__toString();
}

$time = date( "YmdHi" );
echo ("<div class='wrapper'>");
echo ("<img class='search-icon' src='https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/OOjs_UI_icon_search-ltr.svg/1200px-OOjs_UI_icon_search-ltr.svg.png' />");
echo ("<input class='search'  onkeyup=\"filter()\" placeholder='Search...' name='search'type='text' >");
echo ("<img class='clear-icon' src='https://www.pinclipart.com/picdir/middle/181-1816269_delete-icon-png-clipart.png' />");
echo "</div>";

echo ("<div class='flex-container'>");

foreach($xml->programme as $item) {
# search for programmes on a specific channel only:

    $start = substr( (string)$item["start"], 0, -8);
    $end   = substr( (string)$item["stop"], 0, -5);
    $debut = date("d/m/Y H:i:s", strtotime($start));
    $fin = date("d/m/Y H:i:s", strtotime($end));
    # if the time is right...
    if ($time > $start && $time < $end) {
        echo ("<div class='channel-card'>");
        
        //echo "Start : " .$debut. '<br>';
        
        //echo "End : " .$fin . '<br>';
        # the channel has to be converted to a string to use as an array key
        
        $ch = $channels[ $item["channel"]->__toString() ];
        //echo "Channel : ". $channels[ $item["channel"]->__toString() ]. "<br>";
        echo ("<div class='name'>".$channels[ $item["channel"]->__toString() ]."</div>");
        
        
        //echo "icon : ".$item->icon['src']. "<br><br>";
        if($item->icon['src'] == NULL)
        {
            echo ("<img class='program-image' src='https://www.unidivers.fr/wp-content/uploads/2019/01/programme-tv.jpg'>");
        }else
        {
            echo ("<img class='program-image' src='".$item->icon['src']."'>");
        }
        
        
        
        /*echo("<div class='barre'>");
        echo time_to_pourcent($debut,$fin);
        echo calculate_time_span($debut);
        echo("</div>");*/
        
        //echo "Title : ".$item->title. "<br>";
        echo("<div class='info'>");
        echo ("<div class='title'>".$item->title."</div>");
        
        
        //echo "Categorie : ".$item->category. "<br>";
        echo ("<div class='notation'>");
        echo ("<div class='watching-insight'>".$item->category."</div>");
        echo ("</div>");
        echo ("</div>");
        
        
        //echo "Description : ".$item->desc. "<br>";
        echo ("<div class='resume'>".$item->desc."</div>");
        
        
        echo ("<div class='btn btn-style-1'>");
        echo(StringLink($channels[ $item["channel"]->__toString() ]));
        echo ("<div class='btn-content'>En Direct");
        //echo "salut";
        echo ("</div>");
        echo ("</a>");
        echo ("</div>");
        
        
        
        
        /*echo "Duré : ".$item->length. " min<br>";
        # put braces and quotes around element names with a hyphen in them
        echo "Info : ".$item->{'sub-title'}. "<br>";*/
        
        
        
        echo "</div>";
         
    }
}
echo "</div>";

?>
</body>
</html>
