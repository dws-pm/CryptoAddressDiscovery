<?php
return (object) array(
    'regexes' => array(
        'btc'    => '/(?<![\w+\/])(?<BTC>[13]([a-km-zA-HJ-NP-Z1-9]{25,34}))(?![\w+\/])/',
        'dash'   => "(?<![\w+\/])(?<DASH>X[1-9A-HJ-NP-Za-km-z]{33})(?![\w+\/])",
        'doge'   => "(?<![\w+\/])(?<DOGE>D[5-9A-HJ-NP-U]{1}[1-9A-HJ-NP-Za-km-z]{32})(?![\w+\/])",
        'ltc'    => "(?<![\w+\/])(?<LTC>[LM3][a-km-zA-HJ-NP-Z1-9]{26,33})(?![\w+\/])",
        "xmr"    => "(?<![\w+\/])(?<XMR>4[0-9AB][1-9A-HJ-NP-Za-km-z]{93})(?![\w+\/])",
        "eth"    => "(?<![\w+\/])(?<ETH>0x[a-fA-F0-9]{40})(?![\w+\/])",
        "bch"    => "(?<![\w+\/])(?<BCH>(?i)(q|p)[a-z0-9]{41})(?![\w+\/])",
        "neo"    => "(?<![\w+\/])(?<NEO>A[0-9a-zA-Z]{33})(?![\w+\/])",
        "xrp"    => "(?<![\w+\/])(?<XRP>r[rpshnaf39wBUDNEGHJKLM4PQRST7VWXYZ2bcdeCg65jkm8oFqi1tuvAxyz]{27,35})(?![\w+\/])",
        "zec_t"  => "(?<![\w+\/])(?<ZEC_T>t([a-km-zA-HJ-NP-Z1-9]{34}))(?![\w+\/])",
        "zec_zc" => "(?<![\w+\/])(?<ZEC_ZC>zc[a-zA-Z0-9]{93})(?![\w+\/])",
        "zec_zs" => "(?<![\w+\/])(?<ZEC_ZS>zs[a-zA-Z0-9]{75})(?![\w+\/])",
    ),
);
