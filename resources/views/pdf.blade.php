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
			border: 1px solid #514F4F;
		}

		footer {
			position: fixed;
			bottom: 0cm;
			left: 0cm;
			right: 0cm;
			height: 1cm;
			/** Extra personal styles **/
			line-height: 0.5cm;
		}
	</style>
</head>

<body>
	<img src="{{url('admin_image/logo.png')}}" style="height:70px; width:70px;" alt="RN">
	<center style="margin-top:-70px; line-height: 5px;">
		<h1><strong> NEPAL ELECTRICITY AUTHORITY </strong></h1>
		<h3>TULSIPUR DISTRIBUTION CENTER,DANG </h3>
		<h4>DATE: <?php $date = explode('-', $date);
					$month = $date[1];
					switch ($month) {
						case '01':
							$month = "Baisakh";
							break;
						case '02':
							$month = "Jeth";
							break;
						case '03':
							$month = "Ashad";
							break;
						case '04':
							$month = "Srawan";
							break;
						case '05':
							$month = "Bhadra";
							break;
						case '06':
							$month = "Asoj";
							break;
						case '07':
							$month = "Kartik";
							break;
						case '08':
							$month = "Manshir";
							break;
						case '09':
							$month = "Paus";
							break;
						case '10':
							$month = "Magh";
							break;
						case '11':
							$month = "Palgun";
							break;
						case '12':
							$month = "Chaitra";
							break;
						default:
							break;
					}
					echo $date[0] . "-" . $month . "-" . $date[2];
					?></h4>
	</center>
	<div>
		<h4 style=" float:right; margin-top: -20px;">Vauchar No. {{$vauchar_number}}</h4>
		<h4 style="color:#003088; margin-top: -20px;">METER KHARCHA VAUCHAR</h4>
	</div>
	<table style="margin-top: -10px;">
		<tr>
			<th style="border-bottom: 1px solid #fff;"></th>
			<th colspan="12">
				<center style="padding:3px;">BIBARAN</center>
			</th>
		</tr>
		<tr>
			<th>S.N</th>
			<th>ID</th>
			<th colspan="3">NAME OF CUSTOMER</th>
			<th style="padding-right: -30px;">METER S.N.</th>
			<th style="padding-right: -10px;">METER COM.</th>
			<th style="padding-right: -25px;">AMP</th>
			<th style="padding-right: -10px;">PHASE</th>
			<th style="padding-right: -20px;">VOL.</th>
			<th>SURU ANK</th>
			<th style="padding-right: -5px;">RECEIPT DATE</th>
			<th>REMARKS</th>
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
			<td></td>
		</tr>
		@endforeach
		@if($count<25) <?php for ($i = 1; $i <= (25 - $count); $i++) { ?> <tr>
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
				<p>Recommended By</p>
			</div>
			<div class="col-md-3" style="float:left; line-height: 3px;">
				<p>----------------------</p>
				<p style="margin-left: 20px;">Spended By</p>
			</div>
			<div class="col-md-3" style="float:right; line-height: 3px;">
				<p>----------------------</p>
				<p style="margin-left: 20px;">Accepted By</p>
			</div>
			<div class="col-md-3" style="float:right;  margin-right: 200px;  line-height: 3px;">
				<p>----------------------</p>
				<p style="margin-left: 20px;">Received By</p>
			</div>
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>