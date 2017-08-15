<form method="post" action="<?php echo base_url(); ?>index.php/Rechecking/LoadData" name="myform" id="myform">
    <div class="row">
        <div class="pull-right">
            <a href="<?php echo base_url().'assets/downloads/Rechecking_Method.pdf' ?>" class="imglink" target="_blank"><img src="<?php echo base_url(); ?>assets/img/Point1.jpg" class="img-responsive" alt="Terms & Conditions"></a>
        </div>
    </div>
    <div class="row">

        <div class="pull-right">
            <a href="http://www.bisegrw.com/authorized-banks.html" class="imglink" target="_blank"><img src="<?php echo base_url(); ?>assets/img/Point2.jpg" class="img-responsive" alt="Terms & Conditions"></a>
        </div>
    </div>

    <div class="row">

        <div class="pull-right">
            <a href="http://challan.bisegrw.com" class="imglink" target="_blank"><img src="<?php echo base_url(); ?>assets/img/Point3.jpg" class="img-responsive" alt="Terms & Conditions"></a>
        </div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a href="http://challan.bisegrw.com" class="imglink" target="_blank"><img src="<?php echo base_url(); ?>assets/img/Note.jpg" class="img-responsive" alt="Terms & Conditions"></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="button" value="Download Challan Form" id="downloadChallanForm" name="downloadChallanForm" class="btn btn-primary btn-block" onclick="window.open('http://challan.bisegrw.com','_blank');">
        </div>
    </div>

    <br style="display: block; margin: 5px 0;">

    <div class="row">
        <div class="pull-right">
            <img src="<?php echo base_url(); ?>assets/img/terms.jpg" class="img-responsive" alt="Terms & Conditions">
        </div>
    </div>
    <hr class="colorgraph">
    <h3 class="bold"><strong>Apply For Rechecking</strong></h3>  
    <?php
    @$mysg = @$error['error_msg'];
    if(@$mysg != "")
    {
        ?>
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $mysg ?></strong>
        </div>
        <?php
    }
    ?>
    <h4 class="bold">Bank Information</h4>
    <div class="form-group">
        <label for="challan">Challan No:</label>
        <input type="text" class="form-control" id="challan" name="challan" value="<?php echo @$error['data']['challan'] ?>" placeholder="Enter Challan No." required="required">
    </div>
    <div class="form-group">
        <label for="bName">Bank Name:</label>

        <select id="bName" name="bName" required  class="form-control">
            <option value = '0'>NONE</option>
            <optgroup label='GUJRANWALA'>
                <option value='BISE BR - 1993' <?php if(@$error['data']['bName']=='BISE BR - 1993'){echo " selected";} ?>>BISE BR</option>
                <option value='Bank Squair - 109' <?php if(@$error['data']['bName']=='Bank Squair - 109'){echo " selected";} ?>>Bank Squair</option>
                <option value='Kamoke - 178' <?php if(@$error['data']['bName']=='Kamoke - 178'){echo " selected";} ?>>Kamoke</option>
                <option value='Dhilanwali - 263' <?php if(@$error['data']['bName']=='Dhilanwali - 263'){echo " selected";} ?>>Dhilanwali</option>
                <option value='Tufail Shaheed  - 407' <?php if(@$error['data']['bName']=='Tufail Shaheed  - 407'){echo " selected";} ?>>Tufail Shaheed </option>
                <option value='Wazirabad  - 464' <?php if(@$error['data']['bName']=='Wazirabad  - 464'){echo " selected";} ?>>Wazirabad </option>
                <option value='Qila Didar Singh - 493' <?php if(@$error['data']['bName']=='Qila Didar Singh - 493'){echo " selected";} ?>>Qila Didar Singh</option>
                <option value='Rahwali - 518' <?php if(@$error['data']['bName']=='Rahwali - 518'){echo " selected";} ?>>Rahwali</option>
                <option value='Eminabad - 561' <?php if(@$error['data']['bName']=='Eminabad - 561'){echo " selected";} ?>>Eminabad</option>
                <option value='Noshera Wirkan - 582' <?php if(@$error['data']['bName']=='Noshera Wirkan - 582'){echo " selected";} ?>>Noshera Wirkan</option>
                <option value='G.T. Road - 682' <?php if(@$error['data']['bName']=='G.T. Road - 682'){echo " selected";} ?>>G.T. Road</option>
                <option value='College Road - 698' <?php if(@$error['data']['bName']=='College Road - 698'){echo " selected";} ?>>College Road</option>
                <option value='Wandho - 924' <?php if(@$error['data']['bName']=='Wandho - 924'){echo " selected";} ?>>Wandho</option>
                <option value='Satellite Town - 930' <?php if(@$error['data']['bName']=='Satellite Town - 930'){echo " selected";} ?>>Satellite Town</option>
                <option value='Khiali - 952' <?php if(@$error['data']['bName']=='Khiali - 952'){echo " selected";} ?>>Khiali</option>
                <option value='Ghakhar - 1049' <?php if(@$error['data']['bName']=='Ghakhar - 1049'){echo " selected";} ?>>Ghakhar</option>
                <option value='Khokherki - 1061' <?php if(@$error['data']['bName']=='Khokherki - 1061'){echo " selected";} ?>>Khokherki</option>
                <option value='Mandiala Tega - 1095' <?php if(@$error['data']['bName']=='Mandiala Tega - 1095'){echo " selected";} ?>>Mandiala Tega</option>
                <option value='Alipur Chatha - 1349' <?php if(@$error['data']['bName']=='Alipur Chatha - 1349'){echo " selected";} ?>>Alipur Chatha</option>
                <option value='Gondalawala - 1407' <?php if(@$error['data']['bName']=='Gondalawala - 1407'){echo " selected";} ?>>Gondalawala</option>
                <option value='Model Town - 1429' <?php if(@$error['data']['bName']=='Model Town - 1429'){echo " selected";} ?>>Model Town</option>
                <option value='Kalaske - 1719' <?php if(@$error['data']['bName']=='Kalaske - 1719'){echo " selected";} ?>>Kalaske</option>
                <option value='Dilawar Cheema - 1895' <?php if(@$error['data']['bName']=='Dilawar Cheema - 1895'){echo " selected";} ?>>Dilawar Cheema</option>
                <option value="Peoples - 2356" <?php if(@$error['data']['bName']=='Peoples - 2356'){echo " selected";} ?>>Peoples's</option>
                <option value='Tatley Aali - 2371' <?php if(@$error['data']['bName']=='Tatley Aali - 2371'){echo " selected";} ?>>Tatley Aali</option>
            </optgroup>
            <optgroup label='HAFIZABAD'>
                <option value='Hafizabad - 183' <?php if(@$error['data']['bName']=='Hafizabad - 183'){echo " selected";} ?>>Hafizabad</option>
                <option value='Jalalpur Bhattian - 626' <?php if(@$error['data']['bName']=='Jalalpur Bhattian - 626'){echo " selected";} ?>>Jalalpur Bhattian</option>
                <option value='Sukheke Mandi - 1195' <?php if(@$error['data']['bName']=='Sukheke Mandi - 1195'){echo " selected";} ?>>Sukheke Mandi</option>
                <option value='Pindi Bhatian - 1418' <?php if(@$error['data']['bName']=='Pindi Bhatian - 1418'){echo " selected";} ?>>Pindi Bhatian</option>
                <option value='GRW Road HFD - 2333' <?php if(@$error['data']['bName']=='GRW Road HFD - 2333'){echo " selected";} ?>>GRW Road HFD</option>
            </optgroup>
            <optgroup label='GUJRAT'>
                <option value='Circular Road - 111' <?php if(@$error['data']['bName']=='Circular Road - 111'){echo " selected";} ?>>Circular Road</option>
                <option value='Guliana - 257' <?php if(@$error['data']['bName']=='Guliana - 257'){echo " selected";} ?>>Guliana</option>
                <option value='Gharib Pura - 290' <?php if(@$error['data']['bName']=='Gharib Pura - 290'){echo " selected";} ?>>Gharib Pura</option>
                <option value='Kharian - 378' <?php if(@$error['data']['bName']=='Kharian - 378'){echo " selected";} ?>>Kharian</option>
                <option value='Harriawala - 385' <?php if(@$error['data']['bName']=='Harriawala - 385'){echo " selected";} ?>>Harriawala</option>
                <option value='Jalalpur Jattan - 396' <?php if(@$error['data']['bName']=='Jalalpur Jattan - 396'){echo " selected";} ?>>Jalalpur Jattan</option>
                <option value='Lalamusa - 466' <?php if(@$error['data']['bName']=='Lalamusa - 466'){echo " selected";} ?>>Lalamusa</option>
                <option value='Doulat Nagar - 592' <?php if(@$error['data']['bName']=='Doulat Nagar - 592'){echo " selected";} ?>>Doulat Nagar</option>
                <option value='Sara I Alamgir - 658' <?php if(@$error['data']['bName']=='Sara I Alamgir - 658'){echo " selected";} ?>>Sara I Alamgir</option>
                <option value='Mangowal - 823' <?php if(@$error['data']['bName']=='Mangowal - 823'){echo " selected";} ?>>Mangowal</option>
                <option value='Kotla - 957' <?php if(@$error['data']['bName']=='Kotla - 957'){echo " selected";} ?>>Kotla</option>
                <option value='Pero Shah - 1010' <?php if(@$error['data']['bName']=='Pero Shah - 1010'){echo " selected";} ?>>Pero Shah</option>
                <option value='Mandir - 1045' <?php if(@$error['data']['bName']=='Mandir - 1045'){echo " selected";} ?>>Mandir</option>
                <option value='Dinga - 1064' <?php if(@$error['data']['bName']=='Dinga - 1064'){echo " selected";} ?>>Dinga</option>
                <option value='Narowali - 1170' <?php if(@$error['data']['bName']=='Narowali - 1170'){echo " selected";} ?>>Narowali</option>
                <option value='Awan Sharif - 1175' <?php if(@$error['data']['bName']=='Awan Sharif - 1175'){echo " selected";} ?>>Awan Sharif</option>
                <option value='Pakistan Chowk - 1231' <?php if(@$error['data']['bName']=='Pakistan Chowk - 1231'){echo " selected";} ?>>Pakistan Chowk</option>
                <option value='Aadowal - 1370' <?php if(@$error['data']['bName']=='Aadowal - 1370'){echo " selected";} ?>>Aadowal</option>
                <option value='Kalra Khasa - 1420' <?php if(@$error['data']['bName']=='Kalra Khasa - 1420'){echo " selected";} ?>>Kalra Khasa</option>
                <option value='G.T. Road - 1449' <?php if(@$error['data']['bName']=='G.T. Road - 1449'){echo " selected";} ?>>G.T. Road</option>
                <option value='Fasil Gate - 1451' <?php if(@$error['data']['bName']=='Fasil Gate - 1451'){echo " selected";} ?>>Fasil Gate</option>
                <option value='Kunjah - 1622' <?php if(@$error['data']['bName']=='Kunjah - 1622'){echo " selected";} ?>>Kunjah</option>
                <option value='Tanda Mota - 1685' <?php if(@$error['data']['bName']=='Tanda Mota - 1685'){echo " selected";} ?>>Tanda Mota</option>
                <option value='SARAI ALAMGIR-PAKIST - 2222' <?php if(@$error['data']['bName']=='SARAI ALAMGIR-PAKIST - 2222'){echo " selected";} ?>>SARAI ALAMGIR-PAKIST</option>
                <option value='Mahloo Khokhar - 2296' <?php if(@$error['data']['bName']=='Mahloo Khokhar - 2296'){echo " selected";} ?>>Mahloo Khokhar</option>
                <option value='Karianwala - 5011' <?php if(@$error['data']['bName']=='Karianwala - 5011'){echo " selected";} ?>>Karianwala</option>
                <option value='KUTCHERY CHOWK - 290' <?php if(@$error['data']['bName']=='KUTCHERY CHOWK - 290'){echo " selected";} ?>>KUTCHERY CHOWK</option>
            </optgroup>
            <optgroup label='M.B.DIN'>
                <option value='M.B.Din - 177' <?php if(@$error['data']['bName']=='M.B.Din - 177'){echo " selected";} ?>>M.B.Din</option>
                <option value='Mangat - 303' <?php if(@$error['data']['bName']=='Mangat - 303'){echo " selected";} ?>>Mangat</option>
                <option value='Gojra - 560' <?php if(@$error['data']['bName']=='Gojra - 560'){echo " selected";} ?>>Gojra</option>
                <option value='Hellan - 1375' <?php if(@$error['data']['bName']=='Hellan - 1375'){echo " selected";} ?>>Hellan</option>
                <option value='Malakwal - 1623' <?php if(@$error['data']['bName']=='Malakwal - 1623'){echo " selected";} ?>>Malakwal</option>
                <option value='Head Faqerian - 1705' <?php if(@$error['data']['bName']=='Head Faqerian - 1705'){echo " selected";} ?>>Head Faqerian</option>
                <option value='Phalia - 1989' <?php if(@$error['data']['bName']=='Phalia - 1989'){echo " selected";} ?>>Phalia</option>
                <option value='PAHRIANWALI - 2351' <?php if(@$error['data']['bName']=='PAHRIANWALI - 2351'){echo " selected";} ?>>PAHRIANWALI</option>
            </optgroup>
            <optgroup label='NAROWAL'>
                <option value='Shakargarh - 260' <?php if(@$error['data']['bName']=='Shakargarh - 260'){echo " selected";} ?>>Shakargarh</option>
                <option value='Talwandi Bhindran - 637' <?php if(@$error['data']['bName']=='Talwandi Bhindran - 637'){echo " selected";} ?>>Talwandi Bhindran</option>
                <option value='Narowal - 836' <?php if(@$error['data']['bName']=='Narowal - 836'){echo " selected";} ?>>Narowal</option>
                <option value='Ahmad Abad - 852' <?php if(@$error['data']['bName']=='Ahmad Abad - 852'){echo " selected";} ?>>Ahmad Abad</option>
                <option value='Darman - 978' <?php if(@$error['data']['bName']=='Darman - 978'){echo " selected";} ?>>Darman</option>
                <option value='Baddomalhi - 1405' <?php if(@$error['data']['bName']=='Baddomalhi - 1405'){echo " selected";} ?>>Baddomalhi</option>
                <option value='Noor Kot - 1474' <?php if(@$error['data']['bName']=='Noor Kot - 1474'){echo " selected";} ?>>Noor Kot</option>
                <option value='Zafarwal - 1805' <?php if(@$error['data']['bName']=='Zafarwal - 1805'){echo " selected";} ?>>Zafarwal</option>
                <option value='Pindi Bohri - 1842' <?php if(@$error['data']['bName']=='Pindi Bohri - 1842'){echo " selected";} ?>>Pindi Bohri</option>
            </optgroup>
            <optgroup label='SIALKOT'>
                <option value='Mubarik Pura - 291' <?php if(@$error['data']['bName']=='Mubarik Pura - 291'){echo " selected";} ?>>Mubarik Pura</option>
                <option value='Fatehgarh - 308' <?php if(@$error['data']['bName']=='Fatehgarh - 308'){echo " selected";} ?>>Fatehgarh</option>
                <option value='Daska - 406' <?php if(@$error['data']['bName']=='Daska - 406'){echo " selected";} ?>>Daska</option>
                <option value='Sambrial - 425' <?php if(@$error['data']['bName']=='Sambrial - 425'){echo " selected";} ?>>Sambrial</option>
                <option value='Kour Pur - 492' <?php if(@$error['data']['bName']=='Kour Pur - 492'){echo " selected";} ?>>Kour Pur</option>
                <option value='Chawinda - 566' <?php if(@$error['data']['bName']=='Chawinda - 566'){echo " selected";} ?>>Chawinda</option>
                <option value='Siranwali - 808' <?php if(@$error['data']['bName']=='Siranwali - 808'){echo " selected";} ?>>Siranwali</option>
                <option value='Jamke Cheema - 895' <?php if(@$error['data']['bName']=='Jamke Cheema - 895'){echo " selected";} ?>>Jamke Cheema</option>
                <option value='Circular Road - 969' <?php if(@$error['data']['bName']=='Circular Road - 969'){echo " selected";} ?>>Circular Road</option>
                <option value='Pasrur - 1084' <?php if(@$error['data']['bName']=='Pasrur - 1084'){echo " selected";} ?>>Pasrur</option>
                <option value='Head Marala - 1127' <?php if(@$error['data']['bName']=='Head Marala - 1127'){echo " selected";} ?>>Head Marala</option>
                <option value='Small Ind Estate - 1285' <?php if(@$error['data']['bName']=='Small Ind Estate - 1285'){echo " selected";} ?>>Small Ind Estate</option>
                <option value='Rang Pura - 1619' <?php if(@$error['data']['bName']=='Rang Pura - 1619'){echo " selected";} ?>>Rang Pura</option>
                <option value='Ugokee - 1773' <?php if(@$error['data']['bName']=='Ugokee - 1773'){echo " selected";} ?>>Ugokee</option>
                <option value='Data Zaidka - 1943' <?php if(@$error['data']['bName']=='Data Zaidka - 1943'){echo " selected";} ?>>Data Zaidka</option>
                <option value='Chobara - 1002' <?php if(@$error['data']['bName']=='Chobara - 1002'){echo " selected";} ?>>Chobara</option>
                <option value='GOHAD PUR CHOWK BR - 492' <?php if(@$error['data']['bName']=='GOHAD PUR CHOWK BR - 492'){echo " selected";} ?>>GOHAD PUR CHOWK BR</option>
            </optgroup>
        </select>
    </div>

    <div class="pull-right"  id="instruction">
        <img src="<?php echo base_url(); ?>assets/img/instructions.jpg" width="800px" class="img-responsive" alt="instructions.jpg">
    </div>

    <div class="form-group">
        <label for="paidDate">Paid Date:</label>
        <input type="text" class="form-control" id="paidDate" name="paidDate" value="<?php echo @$error['data']['paidDate'] ?>">
    </div>

    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo @$error['data']['amount'] ?>" placeholder="Enter Amount paid in bank">
    </div>
    <?php
    if(CLS == 11 || CLS == 12){

        ?>
        <hr class="colorgraph">
        <h4 class="bold">Exam Information</h4>
        <div class="form-group">
            <label for="matRno">Matric Roll No:</label>
            <input type="text" class="form-control" id="matRno" name="matRno" >
        </div>

        <div class="form-group">
            <label for="interRno">Inter Roll No:</label>
            <input type="text" class="form-control" id="interRno" name="interRno" >
        </div>

        <?php
    }
    else if(CLS == 9 || CLS == 10){

        ?>
        <hr class="colorgraph">

        <h4 class="bold">Exam Information</h4>

        <div class="form-group">
            <label for="matRno">Matric <?php echo '('.CLS.'TH)' ?>  Roll No:</label>
            <input type="text" class="form-control" id="matRno" name="matRno" value="<?php echo @$error['data']['matRno'] ?>">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="text" class="form-control" id="dob" name="dob" value="<?php echo @$error['data']['dob'] ?>">
        </div>

        <?php
    }
    ?>
    <input type="hidden" id="class" name="class" value="<?php echo CLS ?>"> 

    <div class="row">
        <div class="col-md-6">
            <input type="submit" value="Proceed to Next Step" id="proceed" name="proceed" class="btn btn-primary btn-block" onclick="return checksGetInfo()">
        </div>
        <div class="col-md-6">
            <input type="button" value="Cancel" id="cancel" name="cancel" class="btn btn-danger btn-block" onclick="return CancelAlert();">
        </div>
    </div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function() 
        {  
            $.fancybox("#instruction");
    });
</script>