<?php
$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
$url = "http://cls6.bullhornstaffing.com/JobBoard/Standard/JobOpportunitiesRSS.cfm?privateLabelID=10415&category=";
$xml = file_get_contents($url, false, $context);
$objects = simplexml_load_string($xml);
foreach($objects->channel->item as $object):?>
<div class="item">
        <a href="<?php echo $object->link ?>">
                <h2><?php echo $object->title?></h2>
        </a>
        <date><?php echo $object->pubDate?></date>
        <div class="content">
                <?php echo $object->description?>
        </div>
</div>  
<?php endforeach;?>
