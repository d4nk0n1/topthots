<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><i class="fa fa-twitter"></i>@topthotsdot</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


        <!-- Styles -->
        <style>
            html, body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #F8B8C8;
                display: table;
                font-weight: bolder;
                font-family: 'Lato', sans-serif;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title"><i style="color: #59fff9;" class="fa fa-twitter"></i>@top<span style="color: #59fff9;font-weight: bolder;">thots</span>dot</div>
                <img style="width:350px;" src="/img/mulaney.jpg" />

                <div id="nanoGallery"></div>


                <div id="chart-example-chart"></div>
                <a class="btn primary" id="toggle-chart-table">Show Table to Sort the Chart Series</a>
                <table id="chart-example" class="table table-bordered">
                    <thead><tr><th>City</th><th>Population</th></tr></thead>
                    <tbody>
                    <tr><td>Tokyo</td><td>34.4</td></tr>
                    <tr><td>Jakarta</td><td>21.8</td></tr>
                    <tr><td>New York</td><td>20.1</td></tr>
                    <tr><td>Seoul</td><td>20</td></tr>
                    <tr><td>Manila</td><td>19.6</td></tr>
                    <tr><td>Mumbai</td><td>19.5</td></tr>
                    <tr><td>Sao Paulo</td><td>19.1</td></tr>
                    <tr><td>Mexico City</td><td>18.4</td></tr>
                    <tr><td>Dehli</td><td>18</td></tr>
                    <tr><td>Osaka</td><td>17.3</td></tr>
                    <tr><td>Cairo</td><td>16.8</td></tr>
                    <tr><td>Kolkata</td><td>15</td></tr>
                    <tr><td>Los Angeles</td><td>14.7</td></tr>
                    <tr><td>Shanghai</td><td>14.5</td></tr>
                    <tr><td>Moscow</td><td>13.3</td></tr>
                    <tr><td>Beijing</td><td>12.8</td></tr>
                    <tr><td>Buenos Aires</td><td>12.4</td></tr>
                    <tr><td>Guangzhou</td><td>11.8</td></tr>
                    <tr><td>Shenzhen</td><td>11.7</td></tr>
                    <tr><td>Istanbul</td><td>11.2</td></tr>
                    </tbody>
                </table>

            </div>
        </div>
    </body>

    <script type="text/javascript" >
        (function() {
            var $table = $('#chart-example'), $chart = $('#chart-example-chart'), chart;

            // Create a button to toggle our table's visibility.
            // We could just hide it completely if we don't need it.
            $('#toggle-chart-table').click(function(e) {
                e.preventDefault();
                $table.toggle();
            });

            // Set up our Highcharts chart
            chart = new Highcharts.Chart({
                chart: {
                    type: 'column',
                    renderTo: 'chart-example-chart'
                },
                title: {
                    text: 'World\'s largest cities per 2008'
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Population (millions)'
                    }
                },
                series: [{
                    name: 'Population',
                    color: '#006A72'
                }]
            });

            // Create a function to update the chart with the current working set
            // of records from dynatable, after all operations have been run.
            function updateChart() {
                var dynatable = $table.data('dynatable'), categories = [], values = [];
                $.each(dynatable.settings.dataset.records, function() {
                    categories.push(this.city);
                    values.push(parseFloat(this.population));
                });

                chart.xAxis[0].setCategories(categories);
                chart.series[0].setData(values);
            };

            // Attach dynatable to our table, hide the table,
            // and trigger our update function whenever we interact with it.
            $table.dynatable({
                inputs: {
                    queryEvent: 'blur change keyup',
                    recordCountTarget: $chart,
                    paginationLinkTarget: $chart,
                    searchTarget: $chart,
                    perPageTarget: $chart
                },
                dataset: {
                    perPageOptions: [5, 10, 20],
                    sortTypes: {
                        'population': 'number'
                    }
                }
            })
            .hide()
            .bind('dynatable:afterProcess', updateChart);

            // Run our updateChart function for the first time.
            updateChart();

        })();

        $.dynatableSetup({
            features: {
                paginate: true,
                sort: true,
                pushState: true,
                search: true,
                recordCount: true,
                perPageSelect: true
            },
            table: {
                defaultColumnIdStyle: 'camelCase',
                columns: null,
                headRowSelector: 'thead tr', // or e.g. tr:first-child
                bodyRowSelector: 'tbody tr',
                headRowClass: null
            },
            inputs: {
                queries: null,
                sorts: null,
                multisort: ['ctrlKey', 'shiftKey', 'metaKey'],
                page: null,
                queryEvent: 'blur change',
                recordCountTarget: null,
                recordCountPlacement: 'after',
                paginationLinkTarget: null,
                paginationLinkPlacement: 'after',
                paginationPrev: 'Previous',
                paginationNext: 'Next',
                paginationGap: [1,2,2,1],
                searchTarget: null,
                searchPlacement: 'before',
                perPageTarget: null,
                perPagePlacement: 'before',
                perPageText: 'Show: ',
                recordCountText: 'Showing ',
                processingText: 'Processing...'
            },
            dataset: {
                ajax: false,
                ajaxUrl: null,
                ajaxCache: null,
                ajaxOnLoad: false,
                ajaxMethod: 'GET',
                ajaxDataType: 'json',
                totalRecordCount: null,
                queries: null,
                queryRecordCount: null,
                page: null,
                perPageDefault: 10,
                perPageOptions: [10,20,50,100],
                sorts: null,
                sortsKeys: null,
                sortTypes: {},
                records: null
            },
            // Built-in writer functions,
            // can be overwritten, any additional functions
            // provided in writers will be merged with
            // this default object.
            writers: {
                _rowWriter: defaultRowWriter,
                _cellWriter: defaultCellWriter,
                _attributeWriter: defaultAttributeWriter
            },
            // Built-in reader functions,
            // can be overwritten, any additional functions
            // provided in readers will be merged with
            // this default object.
            readers: {
                _rowReader: null,
                _attributeReader: defaultAttributeReader
            },
            params: {
                dynatable: 'dynatable',
                queries: 'queries',
                sorts: 'sorts',
                page: 'page',
                perPage: 'perPage',
                offset: 'offset',
                records: 'records',
                record: null,
                queryRecordCount: 'queryRecordCount',
                totalRecordCount: 'totalRecordCount'
            }
        });

        jQuery(document).ready(function () {
            jQuery("#nanoGallery1").nanoGallery({
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                kind: 'json',
                jsonProvider: 'http://topthots.com/nanoPhotosProvider/nanoPhotosProvider.php',
                locationHash: false
            });

            jQuery("#nanoGallery").nanoGallery({
                kind: 'picasa',
                userID: 'cbrisbois@gmail.com',

                // uncomment line to display one specefic album:
                //album: '5852572882905112961',

                thumbnailHoverEffect:'borderLighter,labelAppear75',
                thumbnailLabel: {
                    position: 'overImageOnMiddle',
                    display: true,
                    displayDescription: true,
                    titleMaxLength: 20,
                    hideIcons: true,
                    align: 'center',
                    itemsCount: 'description'
                },
                i18n: {
                    thumbnailLabelItemsCountPart1: '',
                    thumbnailImageDescription: 'click to open'
                }
            });
        });
    </script>
</html>
