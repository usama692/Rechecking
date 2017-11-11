
<hr class="colorgraph">

<div id="footer" class="footer">
    &nbsp; &copy; 2017 BISE Gujranwala, All Rights Reserved. 
</div>  

</div>

<script type="text/javascript">

    jQuery(document).ready(function() 
        {
            $('.mPageloader').hide();
            $(document.getElementById("cellNo")).mask("9999-9999999", { placeholder: "_" });
            $(document.getElementById("phone")).mask("999-9999999", { placeholder: "_" });
            $("#dob").attr( 'readOnly' , 'true' );
            $("#paidDate").attr( 'readOnly' , 'true' );

            $( "#paidDate" ).datepicker(
                {
                    dateFormat: 'yy-mm-dd'
                    ,changeMonth: true,changeYear:true
                    , yearRange: '-1:'
                    //,maxDate: new Date()
                    ,maxDate: '<?php echo date("Y-m-d"); ?>'
            }).val();

            $( "#dob" ).datepicker(
                {
                    dateFormat: 'dd-mm-yy'
                    ,changeMonth: true,changeYear:true
                    , yearRange: '-50:'
                    ,maxDate: '12-07-2004'
            }).val();
    });


    $("#Download").click(function () {
        $("#wrapper").show();
        $("#hidDivForPrint").hide();
        $("#hidDivForPrint1").hide();
        $("#footer").hide();
        window.print();

        $("#hidDivForPrint").show();
        $("#hidDivForPrint1").show();
        $("#footer").show();
    });


    $("#challan").keypress(function (e) {

        var challan = $("#challan").val();    
        if(challan.length >= 8 && (e.which != 13)) {
            alertify.error('You cannot enter more than 8 digits');
            return false;
        }
        else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
            alertify.error('Please Use Numaric Only');
            return false;
        }
    });

    $("#matRno").keypress(function (e) {

        var matRno = $("#matRno").val()    
        if(matRno.length >= 20 && (e.which != 13)) {
            alertify.error('You cannot enter more than 20 digits');
            return false;
        }
        /*  else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
        alertify.error('Please Use Numaric Only');
        return false;
        }*/
    });

    $("#interRno").keypress(function (e) {

        var interRno = $("#interRno").val()    

        if(interRno.length >= 6 && (e.which != 13)) {
            alertify.error('You cannot enter more than 6 digits');
            return false;
        }

        else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
            alertify.error('Please Use Numaric Only');
            return false;
        }
    });

    $("#amount").keypress(function (e) {

        var amount = $("#amount").val()    

        if(amount.length >= 5 && (e.which != 13)) {
            alertify.error('You cannot enter more than 5 digits');
            return false;
        }

        else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
            alertify.error('Please Use Numaric Only');
            return false;
        }
    });

    $( "#amount" ).focusout(function() {
        var amount = $( "#amount" ).val();
        if(amount < 1100 ){
            alertify.error('Minimum Amount is 1100');
            $( "#amount" ).val('1100');
        }
        else if(amount > 19100){
            alertify.error('Amount Limit is Exceeding');
            $( "#amount" ).val('19100');
        }
    });

    function myajax ()
    {
        $.ajax({

            type: "POST",
            url: "<?php  echo site_url('Rechecking/checks'); ?>",
            data: $("#myform").serialize() ,
            datatype : 'html',
            cache:false,

            success: function(data)
            {
                var obj = JSON.parse(data);

                if(obj.excep == 'Success')
                {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/Rechecking/InsertRecheckingForm/",
                        data: $("#myform").serialize(),
                        datatype : 'html',
                        cache:false,

                        beforeSend: function() {  
                            $('#submit').attr('disabled', 'disabled');
                            $('.mPageloader').show();
                        },
                        complete: function() {
                            $('#submit').removeAttr('disabled');
                            $('.mPageloader').hide();
                        },

                        success: function(data){

                            var obj = JSON.parse(data);
                            if(obj.error ==  1)
                            {
                                window.location.href ='<?php echo base_url(); ?>index.php/Rechecking/recheckingStatus/'+obj.AppID+'/'+obj.stClass;
                                alertify.error('Your Application is Submit Successfully');
                                return true;
                            }   
                            else
                            {
                                alertify.error(obj.error);
                                return false; 
                            }
                        },
                        error: function(request, status, error){

                            alertify.error(request.responseText);
                        }
                    });
                    return false
                }
                else
                {
                    alertify.error(obj.excep);
                    return false;     
                }
            }
        });
    }

    function checks()
    {   
        var cellNo =  $('#cellNo').val();
        var addr =  $('#addr').val();
        var amount =  $('#amount').val();
        var totalSubjectsCheckedCount = 0;
        totalSubjectsCheckedCount =  $("input#subList:checked").not(':disabled').length;

        if(cellNo == "" || cellNo == null || cellNo == undefined)
        {
            alertify.error('Please Enter Cell No.');
            $('#cellNo').focus();
            return false;
        }

        else if(cellNo == "0000-0000000")
        {
            alertify.error('Invalid Cell No.');
            $('#cellNo').focus();
            return false;
        }

        else if (cellNo[0] != 0 || cellNo[1] != 3)
        {
            alertify.error('Invalid Cell No.');
            $('#cellNo').focus();
            return false;
        }

        else if(addr == "" || addr == null || addr == undefined)
        {
            alertify.error('Please Enter Address.');
            $('#addr').focus();
            return false;
        }

        else if(totalSubjectsCheckedCount == 0){
            alertify.error('Please select at least one subject.');
            return false;
        }

        else if(parseInt(parseInt(totalSubjectsCheckedCount)*1000+100) > amount)
        {
            var str = "Your Deposited Fee is not enough. You deposit Rs ";
            str += amount + " /-";
            alertify.error(str);
            return false;
        } 

        else if (!$("input[name='terms']")[0].checked) 
        {
            alertify.error('Please Accept the Terms and Condition for Further Process.');
            $('#terms').focus();
            return false;
        } 

        else
        {  
            if(parseInt(parseInt(totalSubjectsCheckedCount)*1000+100) < amount)
            {
                var str;
                str = "You deposited extra fee. ";
                str = str.concat("Are you sure you want to proceed this form ? You Deposited Rs ",amount - parseInt(parseInt(totalSubjectsCheckedCount)*1000+100), "/-  Extra");
                alertify.confirm(str, function (e) {
                    if (e) {
                        myajax();
                        return false;
                    }
                    else
                    {
                        return false;
                    }
                }); 
            }
            else
            {
                myajax();
                return false;
            }
        } 
    }

    function chkRechecking()
    {
        var app = $('#appId').val();
        var stClass = $('#stClass').val();

        if(stClass == 0){
            alertify.error('Please Select Class to check status');
            $('#stClass').focus();
            return false;
        }

        else if(app == ''){
            alertify.error('Please Enter Application ID or Roll No');
            $('#appId').focus();
            return false;
        }
        else {
            // do nothing
        }
    }

    function checksGetInfo()
    {
        var challan = $('#challan').val();
        var bName = $('#bName').val();
        var paidDate = $('#paidDate').val();
        var amount = $('#amount').val();
        var matRno = $('#matRno').val();
        var dob = $('#dob').val();
        var interRno = $('#interRno').val();
        var clas = $('#class').val();

        if(challan == "" || challan == null || challan == undefined)
        {
            alertify.error('Please Enter Challan No');
            $('#challan').focus();
            return false;
        }

        else if(bName == 0 || bName == null || bName == undefined)
        {
            alertify.error('Please Enter Bank Name');
            $('#bName').focus();
            return false;
        }

        else if(paidDate == "" || paidDate == null || paidDate == undefined)
        {
            alertify.error('Please Enter Paid Date');
            $('#paidDate').focus();
            return false;
        }

        else if(amount == "" || amount == null || amount == undefined)
        {
            alertify.error('Please Enter Amount');
            $('#amount').focus();
            return false;
        }

        else if(matRno == "" || matRno == null || matRno == undefined)
        {
            alertify.error('Please Enter Matric Roll No');
            $('#matRno').focus();
            return false;
        }

        else if((clas == 9 || clas == 10) && (dob == '' || dob == undefined || dob == null)){
            alertify.error('Please Enter Date of Birth');
            $('#dob').focus();
            return false;    
        }

        else if((clas == 11 || clas == 12) && (interRno == '' || interRno == undefined || interRno == null)){
            alertify.error('Please Enter Intermediate Roll No');
            $('#dob').focus();
            return false;    
        }

        else
        {
            $.ajax({
                type: "POST",
                url: "<?php  echo site_url('Rechecking/validateForm'); ?>",
                data: $("#myform").serialize() ,
                datatype : 'html',
                cache:false,

                success: function(data)
                {                    
                    var obj = JSON.parse (data);
                    if(obj.excep == 'Success')
                    {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "index.php/Rechecking/LoadData/",
                            data: $("#myform").serialize() ,
                            datatype : 'html',

                            beforeSend: function() {  $('.mPageloader').show(); },
                            complete: function() { $('.mPageloader').hide();},
                            cache:false,

                            success: function(data){

                                var obj = JSON.parse(data) ;
                                if(obj.error ==  1)
                                {
                                    return true; 
                                }   
                                else
                                {
                                    alertify.error(obj.error);
                                    return false; 
                                }
                            },
                            error: function(request, status, error){

                                alertify.error(request.responseText);
                            }
                        });
                        return false
                    }
                    else
                    {
                        alertify.error(obj.excep);
                        return false;     
                    }
                }
            });
        }
    }

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                window.location.href ='<?php echo base_url(); ?>index.php/Rechecking/index';
            } else {
            }
        });
    }
</script>

</body>
</html>