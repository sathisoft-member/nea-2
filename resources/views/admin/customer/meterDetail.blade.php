<h2 style="color:blue; text-align: center;">Meter Details</h2>
<div class="row">
    <div class="col-md-6">
        <p><strong>Meter Type: </strong>{{($meter->meter_type==0)?'Whole Current':'Demand Meter'}}</p>
        <p><strong>Meter Phase: </strong>{{($meter->meter_phase==0)?'I':'III'}}</p>
        <p><strong>Meter Voltage: </strong>{{$meter->meter_voltage}}</p>
        <p><strong>Meter Digit: </strong>{{$meter->meter_digit}}</p>
        <p><strong>Meter Decimal: </strong>{{$meter->meter_decimal}}</p>
        <p><strong>Meter MF date: </strong>{{$meter->mfg_date}}</p>
        <p><strong>Meter Serial Number: </strong>{{$meter->meter_serial_number}}</p>
    </div>

<div class=" col-md-1 vl"></div>
    <div class="col-md-5">
        <p><strong>Meter Inital Reading: </strong>{{$meter->initial_reading}}</p>
        <p><strong>Meter Comapny: </strong>{{$meter->meter_company}}</p>
        <p><strong>Meter Revolution: </strong>{{$meter->meter_resulation}}</p>
        <p><strong>Meter Ectro Type: </strong>{{($meter->meter_type_electro==0)?'Electronic':'Electro Mechanical'}}</p>
        <p><strong>Meter Manufacture: </strong>{{$meter->meter_manufacture}}</p>
        <p><strong>Meter Capacity: </strong>{{$meter->meter_capacity}}</p>
    </div>
</div>



           