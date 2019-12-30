 <div class="col-md-6" id="customer_view" style="margin-left:4%; margin-top:-2%;">
     <h2 style="color:#2F4F4F; text-align: center;">{{$customer->name}}</h2>
     <div class="row">
         <div class="col-md-6">
             <p><strong>ग्राहकको ठेगाना: </strong>{{$customer->address}}</p>
             <p><strong>ग्राहकको ई-मेल: </strong>{{$customer->customer_email}}</p>
             <p><strong>ग्राहकको फोन नं: </strong>{{$customer->customer_phone}}</p>
             <p><strong>बुझिलिने व्यक्तिको नाम: </strong>{{$customer->submitted}}</p>
             <p><strong>बुझिलिने व्यक्तिको फोन नं: </strong>{{$customer->phone}}</p>
             <p><strong>फिर्ता हुनुको कारण : </strong>{{($customer->return_remarks)?$customer->return_remarks:'No Return Record'}}</p>

         </div>

         <div class=" col-md-1 v2"></div>
         <div class="col-md-5">
             <p><strong>दर्ता गर्ने: </strong><?php $user = App\User::find($customer->add_id);
                                                echo $user->name; ?></p>

             <?php if ($customer->edit_id == 0) { ?>
                 <p><strong>अपडेट भएको छैन</strong></p>
             <?php } else { ?>
                 <p><strong>अपडेट गर्ने : </strong><?php $user = App\User::find($customer->edit_id);
                                                    echo $user->name; ?></p>
             <?php } ?>

             <?php if ($customer->rejected_id == 0) { ?>
                 <p><strong>रद्द भएको छैन </strong></p>
             <?php } else { ?>
                 <p><strong>रद्द गर्ने: </strong><?php $user = App\User::find($customer->rejected_id);
                                                    echo $user->name; ?></p>
             <?php } ?>

             <?php if ($customer->return_by == 0) { ?>
                 <p><strong>फिर्ता भएको छैन </strong></p>
             <?php } else { ?>
                 <p><strong> फिर्ता गर्ने: </strong><?php $user = App\User::find($customer->return_by);
                                                    echo $user->name; ?></p>
             <?php } ?>

             <?php if ($customer->done_id == 0) { ?>
                 <p><strong>सम्पन्न भएको छैन </strong></p>
             <?php } else { ?>
                 <p><strong> सम्पन्न गर्ने: </strong><?php $user = App\User::find($customer->done_id);
                                                        echo $user->name; ?></p>
             <?php } ?>

             <p><strong>रद्द हुनुको कारण : </strong>{{($customer->reject_remarks)?$customer->reject_remarks:'No Reject Record'}}</p>
             <p><strong>बुझिलिएको मिति: </strong><input type="hidden" id="created_date" value="{{$customer->created_at->format('Y-m-d')}}"> <span id="showDate"></span></p>

         </div>
     </div>
 </div>
 <script>
     $(document).ready(function() {
         $('#showDate').html(AD2BS($('#created_date').val()));
     })
 </script>