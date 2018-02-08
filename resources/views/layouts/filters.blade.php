
    <div class='col-lg-6 input-group filter'>
<?php
//Get Search Perdiod to provide Active class for css styling
// $searchPeriod = reset($searchPeriod); //convert array to first value string

//Add Date Filter restriction
if ($searchPeriod == null) {
    $searchPeriod = 12; //default view
}
     $url =  "?searchPeriod=";
     //$searchPeriod = 1;

    if ($searchPeriod == '1') {
        echo "<a href='".$url."1'class='btn btn-primary activeFilter' role='button'>
			Month</a>";
    } else {
        echo "<a href='".$url."1'class='btn btn-primary' role='button'>
 			 Month</a>";
    }
    if ($searchPeriod == '3') {
        echo "<a href='".$url."3'class='btn btn-primary activeFilter' role='button'>
				3 Months</a>";
    } else {
        echo "<a href='".$url."3'class='btn btn-primary' role='button'>
 			 3 Months</a>";
    }
    if ($searchPeriod == '6') {
        echo "<a href='".$url."6'class='btn btn-primary activeFilter' role='button'>
			6 Months</a>";
    } else {
        echo "<a href='".$url."6'class='btn btn-primary' role='button'>
			 6 Months</a>";
} ?>
    <!--Input Custom Month Period -->
    <input type="text" class="form-control" placeholder="Number of Months" id='monthsInput'>
        <span class="input-group-btn">
            <?php //Class Go being targeted to append #monthsInput value for P - requires script
                    echo "<a href='".$url."'class='go btn btn-secondary' role='button'>Go</a>"; ?>
        </span>
        <script>
	    //change search results to given month
	    //take user input from #monthsInput field and append it to the Go Link
	    $(document).ready(function() {
		    $('#monthsInput').change(function() {

		    var baseURL = $('a.go').attr('href');
		    var searchTerm = $('#monthsInput').val();
		    var newurl = baseURL + searchTerm;

		    $('a.go').attr('href', newurl);
	    });
	  });
	</script>
</div>

