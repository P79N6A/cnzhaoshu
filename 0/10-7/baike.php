<?php
// qrcode, webpage-redirecting
function baike($qrcodeid)
{
    $baike_urls = array (
        101=>"subview/18258/8271008.htm",
        102=>"view/1199670.htm",
        103=>"view/754694.htm",
        104=>"view/130094.htm",
        105=>"view/1310482.htm",
        106=>"subview/4659/10489389.htm",
        107=>"view/282423.htm",
        108=>"view/48879.htm",
        109=>"view/78774.htm",
        110=>"subview/143388/7812489.htm",
        111=>"view/31047.htm",
        112=>"view/353713.htm",
        113=>"view/56651.htm",
        114=>"view/70940.htm",
        115=>"view/41897.htm",
        116=>"view/992045.htm",
        117=>"view/99293.htm",
        118=>"subview/41637/5143596.htm",
        119=>"view/191239.htm",
        120=>"view/760732.htm",
        121=>"item/%E6%97%B1%E6%9F%B3/7032618",
        122=>"view/13472198.htm",
        123=>"view/1008222.htm",
        124=>"view/59372.htm",
        125=>"view/386986.htm",
        126=>"view/2284244.htm",
        127=>"subview/3987/8076852.htm",
        128=>"subview/1010427/5063016.htm",
        129=>"view/41864.htm",
        130=>"view/114409.htm",
        131=>"view/413000.htm",
        132=>"view/26594.htm",
        133=>"subview/4622/6428617.htm",
        134=>"view/41892.htm",
        135=>"subview/41902/5063979.htm",
        136=>"item/%E9%9B%AA%E6%9D%BE/217424",
        137=>"view/458662.htm",
        138=>"view/70981.htm",
        139=>"view/271059.htm",
        140=>"subview/605756/14157538.htm",
        141=>"subview/41826/4952782.htm",
        142=>"view/44800.htm",
        143=>"view/41905.htm",
        144=>"subview/34466/13150821.htm",
        145=>"subview/99034/5065078.htm",
        146=>"subview/38068/11319463.htm",
        147=>"view/878773.htm",
        148=>"view/31099.htm",
        149=>"view/389170.htm",
        150=>"view/38791.htm"
    );

    $url = "http://baike.baidu.com/".$baike_urls[substr($qrcodeid, 3, 3)];
    header("Location: $url");
}

?>