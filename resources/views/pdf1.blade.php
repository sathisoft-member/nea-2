<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table {
            border-collapse: collapse;
            font-size: 12px;
            width: 100%;
        }

        th {
            color: #003088;
            font-weight: 14px;
        }

        td {
            padding-left: 6px;
            padding-right: 5px;
        }

        table,
        th,
        td {
            border: 1px solid #514f4f;
        }

        footer {
            position: fixed;
            bottom: 1cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

            /** Extra personal styles **/
            line-height: 0.5cm;
        }
    </style>

</head>

<body onload="window.print();">
    <div id="myIframe">
        <img src="{{url('admin_image/logo.png')}}" style="height:70px; width:70px;" alt="RN">
        <center style="margin-top:-70px; line-height: 5px;">

            <h1><strong> नेपाल बिधुत प्राधिकरण </strong></h1>
            <h3 style="margin-top: 3%;">तुलसीपुर वितरण केन्द्र, दाङ </h3>
            <h4>मिति : <?php $date = explode('-', $date);
                        $month = $date[1];
                        switch ($month) {
                            case '01':
                                $month = "बैशाख";
                                break;
                            case '02':
                                $month = "जेठ";
                                break;
                            case '03':
                                $month = "असार";
                                break;
                            case '04':
                                $month = "श्रावण";
                                break;
                            case '05':
                                $month = "भदौ";
                                break;
                            case '06':
                                $month = "आश्विन";
                                break;
                            case '07':
                                $month = "कार्तिक";
                                break;
                            case '08':
                                $month = "मंसिर";
                                break;
                            case '09':
                                $month = "पुष";
                                break;
                            case '10':
                                $month = "माघ";
                                break;
                            case '11':
                                $month = "फाल्गुन";
                                break;
                            case '12':
                                $month = "चैत्र";
                                break;

                            default:
                                break;
                        }
                        echo $date[0] . "-" . $month . "-" . $date[2];
                        ?></h4>


        </center>
        <div>
            <h4 style=" float:right; margin-top: -20px;"> भौचर नं.:...........</h4>
            <h4 style="color:#003088; margin-top: -20px;">मिटर खर्च भौचर </h4>
        </div>

        <table style="margin-top: -10px;">
            <tr>
                <th style="border-bottom: 1px solid #fff;"></th>
                <th colspan="11">
                    <center style="padding:3px;">विवरण</center>
                </th>
            </tr>
            <tr>
                <th>S.N</th>
                <th>CUSTOMER ID</th>
                <th colspan="3">NAME OF CUSTOMER</th>
                <th style="padding-right: -30px;">METER S.N.</th>
                <th style="padding-right: -10px;">METER COM.</th>
                <th style="padding-right: -25px;">AMP</th>
                <th style="padding-right: -10px;">PHASE</th>
                <th style="padding-right: -20px;">VOL.</th>
                <th>SURU ANK</th>
                <th style="padding-right: -5px;">RECEIPT DATE</th>
                
            </tr>
            <?php $count = 0; ?>
            @foreach($customers as $customer)
            <?php $meter = App\Meter::find($customer->meter_id); ?>
            <tr>
                <td><?= ++$count; ?></td>
                <td>{{($customer->customer_id!=0)?$customer->customer_id:''}}</td>
                <td colspan="3">{{$customer->name}}</td>
                <td>{{$meter->meter_serial_number}}</td>
                <td>{{$meter->meter_company}}</td>
                <td>{{$meter->meter_capacity}}</td>
                <td>{{($meter->meter_phase==0)?'I':'III' }}</td>
                <td>{{$meter->meter_voltage}}</td>
                <td>{{$meter->initial_reading}}</td>
                <td>{{$customer->take_date}}</td>
                
            </tr>
            @endforeach
            @if($count<20) <?php for ($i = 1; $i <= (25 - $count); $i++) { ?> <tr>
                <td><?php echo $count + $i; ?></td>
                <td></td>
                <td colspan="3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
            <?php } ?>
            @endif
        </table>

        <br>

        <footer class="container">
            <div class="row">

                <div class="col-md-3" style="float:left;  margin-right: 200px; line-height: 3px;">
                    <p>----------------------</p>
                    <p>सिफारिस गर्ने</p>
                </div>

                <div class="col-md-3" style="float:left; line-height: 3px;">
                    <p>----------------------</p>
                    <p style="margin-left: 20px;">खर्च गर्ने</p>
                </div>

                <div class="col-md-3" style="float:right; line-height: 3px;">
                    <p>----------------------</p>
                    <p style="margin-left: 20px;">बुझिलिने</p>
                </div>
                <div class="col-md-3" style="float:right;  margin-right: 200px;  line-height: 3px;">
                    <p>----------------------</p>
                    <p style="margin-left: 20px;">स्वीकृत गर्ने</p>
                </div>


            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>