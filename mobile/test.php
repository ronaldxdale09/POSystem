
<html>
    <head>
        <title>Simple Barcode Scanner</title>
        <script>
            var barcode = '';
            var interval;
            document.addEventListener('keydown', function(evt) {
                if (interval)
                    clearInterval(interval);
                if (evt.code == 'Enter') {
                    if (barcode)
                        handleBarcode(barcode);
                    barcode = '';
                    return;
                }
                if (evt.key != 'Shift')
                    barcode += evt.key;
                interval = setInterval(() => barcode = '', 20);
            });

            function handleBarcode(scanned_barcode) {
                document.querySelector('#last-barcode').innerHTML = scanned_barcode;
            }
        </script>
    </head>
    <body>
        <h1>Simple Barcode Scanner</h1>
        <strong>Last scanned barcode: </strong>
        <div id="last-barcode"></div>
    </body>
</html>