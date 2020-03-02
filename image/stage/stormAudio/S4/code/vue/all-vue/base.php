<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Card Manager - StormAudio</title>
        <link rel="stylesheet" type="text/css" href="<?php echo mtimePath('css/card-control.css')?>" media="all"/>
        <?php if(rebranding() === 'bryston'): ?>
            <link rel="apple-touch-icon" sizes="180x180" href="/img/bryston-apple-touch-icon.png?v=1">
            <link rel="icon" type="image/png" sizes="32x32" href="/img/bryston-favicon-32x32.png?v=1">
            <link rel="icon" type="image/png" sizes="16x16" href="/img/bryston-favicon-16x16.png?v=1">
            <link rel="manifest" href="/siteBryston.webmanifest">
            <link rel="mask-icon" href="/img/bryston-safari-pinned-tab.svg?v=1" color="#333e48">
            <meta name="msapplication-config" content="/browserconfig.bryston.xml">
            <meta name="apple-mobile-web-app-title" content="Bryston SP4">
            <meta name="application-name" content="Bryston SP4">
            <meta name="msapplication-TileColor" content="#333e48">
            <meta name="theme-color" content="#333e48">
        <?php elseif(rebranding() == 'focal' ): ?>
            <link rel="apple-touch-icon" sizes="180x180" href="/img/focal-apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="/img/focal-favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/img/focal-favicon-16x16.png">
            <link rel="manifest" href="/focal-site.webmanifest">
            <link rel="mask-icon" href="/img/focal-safari-pinned-tab.svg" color="#5bbad5">
            <meta name="msapplication-config" content="/focal-browserconfig.xml">
            <meta name="application-name" content="Focal">
            <meta name="msapplication-TileColor" content="#da532c">
            <meta name="theme-color" content="#ffffff">
        <?php else: ?>
            <link rel="apple-touch-icon" sizes="180x180" href="/img/storm-apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="/img/logo/logo_stormaudio_32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/img/logo/logo_stormaudio_16.png">
            <link rel="manifest" href="/siteStorm.webmanifest">
            <link rel="mask-icon" href="/img/storm-safari-pinned-tab.svg" color="#425459">
            <meta name="msapplication-config" content="/browserconfig.storm.xml">
            <meta name="apple-mobile-web-app-title" content="StormAudio">
            <meta name="application-name" content="StormAudio">
            <meta name="msapplication-TileColor" content="#2b5797">
            <meta name="theme-color" content="#ffffff">
        <?php endif; ?>
    </head>