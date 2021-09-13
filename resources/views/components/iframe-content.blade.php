<html>
    <head>
        <style>
            html, body  {
                overflow: hidden;
            }
            * {
                margin-top: 0!important;
                margin-bottom: 0!important;
            }
        </style>
    </head>
    <body style="margin: 0">
        {!! $html !!}
        <script src="{{ mix('iframeResizer.contentWindow.min.js', '/vendor/embed') }}"></script>
    </body>
</html>
