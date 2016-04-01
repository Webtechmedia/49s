$( document ).ready(function() {
    console.log( "ready!" );
    $( "#date_select" )
    .change(function() {
      var str = "";
      $( "#date_select option:selected" ).each(function() {
      	//alert(  $(this).attr('value')  );
      	var id = $(this).attr('value');
      	var url = $( "#date_select" ).attr('url') ;
      	$( "#result" ).load( url + "/" + id );
      });
    })
    .trigger( "change" );

    function getData(){
        var str = "";

        var url = '';
        var get_year = '';
        var get_month = '';
        var get_day = '';

        url = $( "#date_select_year" ).attr('url') ;

        $( "#date_select_year option:selected" ).each(function() {
            //alert(  $(this).attr('value')  );
            get_year = $(this).attr('value');
        });
        $( "#date_select_month option:selected" ).each(function() {
            //alert(  $(this).attr('value')  );
            get_month = $(this).attr('value');
        });
        $( "#date_select_day option:selected" ).each(function() {
            //alert(  $(this).attr('value')  );
            get_day = $(this).attr('value');
        });


        $( "#result" ).load( url + "/" + get_year + "/" + get_month + "/" + get_day );

    };

    $( "#date_select_year" )
        .change(function() {
            getData();

        })
        .trigger( "change" );

    $( "#date_select_month" )
        .change(function() {
            getData();

        })
        .trigger( "change" );

    $( "#date_select_day" )
        .change(function() {
            getData();

        })
        .trigger( "change" );


});
