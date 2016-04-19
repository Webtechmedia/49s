window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers', []);


FN.Controllers.controller('FNMainController', [
  '$scope',

  function($scope) {

  }]
);

FN.Controllers.controller('FNHeroController', [
  '$scope',

  function($scope) {

  }]
);

 

/**
 * @module FN
 */

window.FN = window.FN || {};
window.FN = {};


FN.__bind = function(fn, me) {
    return function() {
        return fn.apply(me, arguments);
    };
};

FN.__hasProp = {}.hasOwnProperty;

FN.__extends = function(child, parent) {
    for (var key in parent) {
        if (FN.__hasProp.call(parent, key)) {
            child[key] = parent[key];
        }
    }

    function ctor() {
        this.constructor = child;
    }

    ctor.prototype = parent.prototype;

    child.prototype = new ctor();

    child.__super__ = parent.prototype;

    return child;
};

/**
 * Abstract global "superclass" from which all FN classes should contain at the root of their inheritance hierarchy.
 * @class Class
 * @namespace FN
 * @constructor
 * @example
 * 	FN.__extends(SubClass, FN.Class);
 *
 * 	function SubClass() {
 * 		SubClass.__super__.constructor.call(this, arguments);	// call super
 * 		this.bindAllFunctions(this);							// bind all methods to this subclass
 *
 * 		// rest of constructor, setup etc...
 * 	}
 */
FN.Class = (function() {
    function FNClass() {
        this.bindAllFunctions = FN.__bind(this.bindAllFunctions, this);
        this.setup = FN.__bind(this.setup, this);
        this.setup();
    }

    /**
     * @method setup
     * @private
     */
    FNClass.prototype.setup = function() {

    };

    /**
     * Binds all functions to the object passed. Typically this will be called inside the constructor of a subclass.
     * @method bindAllFunctions
     * @param {Object} obj - object to bind all methods to
     * @example
     * 	function SubClass() {
     * 		this.bindAllFunctions(this);
     * 	}
     */
    FNClass.prototype.bindAllFunctions = function(obj) {
        for (var key in obj) {
            if (FN.__hasProp.call(obj, key) && typeof obj[key] == 'function') {
                obj[key] = FN.__bind(obj[key], obj);
            }
        }
    };

    return FNClass;
})();

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNHomeController', [
    '$scope','$http','$timeout',
    function($scope, $http, $timeout) {

      $scope.setTitle("49's - Latest Results");

      
     
      var ajaxRequest;
      $scope.showShare = false;

      function updateShareResults() {

        $('#share-tw').html('');
        $('#share-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$scope.location.absUrl()+'" data-text="'+resultsShareText()+'" data-size="large" data-count="none">Tweet</a>');
        if ('twttr' in window && window['twttr'] !== null) {
          twttr.widgets.load();
        }

        $('#share-mail').html('');
        $('#share-mail').html('<a href="mailto:%20?subject=49s Website&body='+mailShareText()+'"><img src="../../img/icons/ic_email.png"></a>');

        $scope.$apply(function() {
          $scope.showShare = true;
        });
      }


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// // alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.latest.length>0){
 				$.each(json.body.s49.latest, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.latest.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0 && this.url=='') {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:100px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();}
							else{
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
							}
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}

			//add promo images
			if(json.body.promo.is_promo_49_latest.length>0){
		        var banner='';
				$.each(json.body.promo.is_promo_49_latest, function(i,obj) {
					try{
						if(obj.video_url!=null && obj.video_url.length>0 && obj.url==''){
							banner='<div class="fn-promo-section">';
							banner+='<a class="miss_smil" data-toggle="modal" data-target="#videoModalmiss" ng-click="playMainVideo()">';
							banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
							banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
						$('video#how_to_play_videonew source').attr('src', obj.video_url);
							$("video#how_to_play_videonew")[0].load();
						}
							
							}
						else{
						banner='<div class="fn-promo-section">';
						if(obj.url!=''){
							banner+='<a href="'+obj.url+'">';
						}else{
							banner+='<a href="">';
						}
						banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
						}
						banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
						}
					}catch(e){}
					 $(".fn-promo-container").append(banner);
				});
			}
		}

		/* latest results slider */
		$(document).ready(function(){
			var findLatestFlag=0;
			var currentDate = new Date();

			var currentDay = ("0" + currentDate.getDate()).slice(-2);
		    var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
		    var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

			var firstDay="05";
			var firstMonth="05";
			var firstYear="1996";

			var firstDate = firstYear+'-'+firstMonth+'-'+firstDay;
			var selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
			var currentDate = currentYear+'-'+currentMonth+'-'+currentDay;

			$scope.getBallColor = function(num){
		        var index  = (num-1) % 7;
		        var colors = ["green","red","orange","yellow","brown","purple","blue"];
		        return colors[index];
			}
			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore=$scope.getDateBeforeDate(selectedDate);
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter = $scope.getDateAfterDate(selectedDate);
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}
			function getLotteryData(selectedDate){
        if(!$scope.$$phase) {
          $scope.$apply(function() {
            $scope.showShare = false;
          });
        } else {
          $scope.showShare = false;
        }
        // $scope.$apply();

        if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
					url: $scope.baseURL+'/games/get_previous',
					type: 'post',
					dataType: 'json',
                                        contentType: "application/json; charset=utf-8",
					data:  JSON.stringify({"game":"49","date": selectedDate}),
					beforeSend: function() {
						$( ".no-results-for-date" ).remove();
						$('#main-spinner').css( "display","inline-block" );
						$('.resoults-middle-container').css( "display","none" );
					},
					complete: function() {
						//alert('complete');
					},
					success: handleData,
					error: function(){
						console.log('error');
					}
				});

			}

      function getHotCold() {
        $.ajax({
            url: $scope.baseURL+'/games/get_hot_cold_balls',
            type: 'post',
                                        contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data:  JSON.stringify({"game_type":"49"}),
            beforeSend: function() {

            },
            complete: function() {
              //alert('complete');
            },
            success: handleHotCold,
            error: function(){
              alert('error');
            }
          });

      };


      function handleHotCold(json) {

        if (jQuery.isEmptyObject(json.body)){

        } else {

          $scope.hotBalls = json.body.hot;
          $scope.coldBalls = json.body.cold;
          $scope.$apply();

        }


      }

      function handleData(json) {
			$('#lunchtime').html('');
			$('#teatime').html('');
			$('.fn-booster-container').css('display','none');


			try{
				if((json.body[0].results.actual_draw_time).indexOf(':') === -1)
				{}else{
					$('#lunchtime').html(json.body[0].results.actual_draw_time);
				}
			}catch (e) {}

			try{
				if((json.body[1].results.actual_draw_time).indexOf(':') === -1)
				{}else{
					$('#teatime').html(json.body[1].results.actual_draw_time);
				}
			}catch (e) {}



			if (json.body[0] && (json.body[0].results).length==0 ){
				$( ".no-results-for-date" ).remove();
				$('#main-spinner').css( "display","none" );
        $('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");

	    		  $scope.$apply(function() {
	    			  $scope.showShare = false;
	    		  });


				  //if no results try to get results from previous date
				  if(findLatestFlag==0){
						selectedDate=$scope.getDateBeforeDate(selectedDate);
						getLotteryData(selectedDate);
						$('#activeDate').html('');
	            		$('#previous-day').css( "display","none" );
	            		$('#next-day').css( "display","none" );
				   }



			}else{
				findLatestFlag=1;

				$( ".no-results-for-date" ).remove();
				$('#main-spinner').css( "display","none" );
				$('.resoults-middle-container').css( "display","inline-block" );





				$('#next-event').css( "display","none" );

        var draws = [];

        for (var i=0;i<json.body.length;i++) {
          var draw = {};
          if (json.body[i].status == 0) {
            draw.time = json.body[i].results.actual_draw_time;
            draw.status = json.body[i].status;
            draw.drawName = json.body[i].draw_name.toUpperCase();
            draws.push(draw);
          } else if (json.body[i].results.length == 0) {
            $scope.nextDrawTime = json.body[i].draw_time;
            $('#next-event').css( "display","block" );
          } else {
            draw.time = json.body[i].results.actual_draw_time;
            draw.status = json.body[i].status;
            draw.numbers = json.body[i].results.numbers;
            draw.sortedNumbers = json.body[i].results.numbers.concat().sort($scope.sortNumber);
            draw.displayedNumbers = draw.sortedNumbers;
            if (json.body[i].results.booster != 0) {
              draw.booster =  json.body[i].results.booster;
            }
            draw.drawName = json.body[i].draw_name.toUpperCase();
            draws.push(draw);
          }
        }

        $scope.draws = draws;

        $scope.$apply();

			}


			updateDaySwitchers();
			updateTitleDate();
			resultsShareText();
			updateShareResults();


      }

      $scope.drawSorted = true;
      $scope.toggleDrawOrder = function() {
        $scope.drawSorted = !$scope.drawSorted;

        for (var i=0;i<$scope.draws.length;i++) {
          var draw = $scope.draws[i];
          if ($scope.drawSorted) {
            draw.displayedNumbers = draw.sortedNumbers;
          } else {
            draw.displayedNumbers = draw.numbers;
          }
        }

      };


      function showDraw (numbers, booster, idPrefix) {

        for (var i in numbers) {
          if(numbers[i]){
            var num = parseInt(i)+1;
            $("#"+idPrefix+""+num).html(numbers[i]);
            color=$scope.getBallColor(numbers[i]);
            $("#"+idPrefix+""+num).removeClass();
            $("#"+idPrefix+""+num).addClass('fn-ball-'+color);
            $("#"+idPrefix+""+num).addClass('fn-ball-nb-'+numbers[i]);
          }
        }

        if(booster){
          $("#"+idPrefix+"b").html(booster);
          color=$scope.getBallColor(booster);
          $("#"+idPrefix+"b").removeClass();
          $("#"+idPrefix+"b").addClass('fn-ball-'+color);
          $("#"+idPrefix+"b").addClass('fn-ball-nb-'+booster);
        }

      }
		function updateTitleDate() {
				dayNumber = $scope.getDayNumber(selectedDate);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);

				var d = new Date(selectedDate);
				var month = new Array();
				month[0] = "JANUARY";
				month[1] = "FEBRUARY";
				month[2] = "MARCH";
				month[3] = "APRIL";
				month[4] = "MAY";
				month[5] = "JUNE";
				month[6] = "JULY";
				month[7] = "AUGUST";
				month[8] = "SEPTEMBER";
				month[9] = "OCTOBER";
				month[10] = "NOVEMBER";
				month[11] = "DECEMBER";
				var monthName = month[d.getMonth()];

				$('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+'<sup>'+dayEnd.toLowerCase()+'</sup> '+monthName+' '+d.getFullYear());
			}

			//initiate everything
      getHotCold();
			getLotteryData(selectedDate);
			updateDaySwitchers();
			updateTitleDate();
			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();
				selectedDate = $scope.getDateAfterDate(selectedDate);
				getLotteryData(selectedDate);
				updateDaySwitchers();
				updateTitleDate();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();
				selectedDate=$scope.getDateBeforeDate(selectedDate);
				getLotteryData(selectedDate);
				updateDaySwitchers();
				updateTitleDate();
			});
		});


    function resultsShareText() {
      var resultText='';
      var teaText='';
      var lunchText='';

      if ($scope.draws) {

        if (jQuery.isEmptyObject($scope.draws[0].sortedNumbers)){
        }else{
            var lunchText = "Lunchtime:";
            for (var i in $scope.draws[0].sortedNumbers) {
              lunchText += $scope.draws[0].sortedNumbers[i]+',';
            }
            lunchText += " Booster:"+$scope.draws[0].booster;
        }

        if ($scope.draws.length > 1 && jQuery.isEmptyObject($scope.draws[1].sortedNumbers)){
        }else if ($scope.draws.length > 1) {
  	      if ($scope.draws[1].sortedNumbers.length) {
  	        var teaText = "  Teatime:";
  	        for (var i in $scope.draws[1].sortedNumbers) {
  	          teaText += $scope.draws[1].sortedNumbers[i]+',';
  	        }
  	        teaText += " Booster:"+$scope.draws[1].booster;

  	      }
        }
        if(lunchText!='' && teaText!=''){
      	  resultText = "49's Results: "+ lunchText + " " +  teaText;
        }else if(lunchText!=''){
      	  resultText = "49's Results: "+ lunchText;
        }
      }

      return resultText;
    }

    function mailShareText() {
      var resultText = resultsShareText();
      return resultText + '%0D%0A' + $scope.location.absUrl();
    }


/*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});
		
		$(document).on('show.bs.modal','#videoModalmiss', function () {
         $('#how_to_play_video_miss').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModalmiss', function () {
         $('#how_to_play_video_miss').trigger("pause");
  });


$(document).on('show.bs.modal','#videoModalmiss', function () {
         $('#how_to_play_videonew').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModalmiss', function () {
         $('#how_to_play_videonew').trigger("pause");
  });





  }]


);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNHotColdController', [
    '$scope','$http',
    function($scope,$http) {

      $scope.setTitle("49's - Hot & Cold");

        $scope.totalDrawn;
        $scope.startDate;
        $scope.endDate;

        $scope.hottestNum;
        $scope.coldestNum;


        $scope.headerIndex = 0;

        var sortType;
        var sortAscending = false;

        $scope.getStats = function() {
        	$http.post($scope.baseURL+'/games/get_balls_statistics', { "game_type":"49"}).
                            success(function(data, status, headers, config) {
                                if (data.server_obj.success === true) {
                                    $scope.ballStats = data.body.statistic;
                                    $scope.totalDrawn = data.body.total.counter;

                                    $scope.startDate = Date.parse(data.body.first_draw.date).toString('dd/MM/yyyy');
                                    $scope.endDate = Date.parse(data.body.last_draw.date).toString('dd/MM/yyyy');

                                    $scope.sortByType(3);
                                    $scope.hottestNum = $scope.ballStats[0].number;
                                    $scope.coldestNum = $scope.ballStats[$scope.ballStats.length-1].number;

                                    // $scope.sortByType(0);


                                } else {
                                    console.log('error loading stats');
                                }
                            }).
                            error(function(data, status, headers, config) {
                                console.log('error loading stats');
                            })
        };


	    $scope.getStats();


	    $scope.sortByType = function(headerIndex) {

	        if (!$scope.ballStats.length) return;

	        $scope.headerIndex = headerIndex;

	        var type;

	        switch(headerIndex) {
	            case 0:
	                type='number';
	                break;
	            case 1:
	                type='main';
	                break;
	            case 2:
	                type='bonus';
	                break;
	            case 3:
	                type='number_total';
	                break;
	            default:
	                type='number';
	                break
	            }



	        if (type == sortType) {
	            sortAscending = !sortAscending;
	        } else if (type == 'number') {
	            sortAscending = true;
	        } else {
	            sortAscending = false;
	        }
	        sortType = type;
          $scope.ballStats.sort(sortBy('main', sortAscending, parseInt));
	        $scope.ballStats.sort(sortBy(type, sortAscending, parseInt));
	    };

	    sortBy = function(field, ascending, primer){
	       var key = primer ?
	           function(x) {return primer(x[field])} :
	           function(x) {return x[field]};

	       ascending = !ascending ? -1 : 1;

	       return function (a, b) {
             return a = key(a), b = key(b), ascending * ((a > b) - (b > a));
	         }
	    }

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// // alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.hot_cold.length>0){
 				$.each(json.body.s49.hot_cold, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.hot_cold.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNHowToPlayController', [
    '$scope', '$window',
    function($scope, $window) {

      $scope.setTitle("49's - How to Play");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.s49.how_to_play.length>0){
 				$.each(json.body.s49.how_to_play, function(i,obj) {
					try{
						if(json.body.s49.how_to_play.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0) {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:95px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();
						}else if(this.url!=null && this.url.length > 0){
	 						$(".carousel-inner").append('<div class="item"><a href="'+this.url+'"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></a></div>');
						}else{
							$(".carousel-inner").append('<div class="item"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></div>');
						}
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}



        $scope.navigationClickFn = function(navigationOption) {
            location.href = '49s%2F' + navigationOption;
        };

        $scope.ballAmounts = [
            { label: '1 Number Matched', value: 1 },
            { label: '2 Numbers Matched', value: 2 },
            { label: '3 Numbers Matched', value: 3 },
            { label: '4 Numbers Matched', value: 4 },
            { label: '5 Numbers Matched', value: 5 }

        ];

        $scope.sixWinningAmounts = [7, 54, 601, 7200, 125000];
        $scope.sevenWinningAmounts = [6, 39, 330, 3800, 40000];


        $scope.stakeOptions = {
            stake:"1.00",
            numBalls:$scope.ballAmounts[0]
        };


        $scope.update = function(stakeOptions) {

            //$scope.stakeOptions = angular.copy(stakeOptions);
            $scope.stakeOptions.stake = parseFloat($scope.stakeOptions.stake).toFixed(2);
            if ($scope.stakeOptions.stake < 0.5 || isNaN(parseFloat($scope.stakeOptions.stake))) {
                $scope.stakeOptions.stake = "0.50";
            } 
            //else if ($scope.stakeOptions.stake > 10000000) {
            //  $scope.stakeOptions.stake = "10000000.00";
            //}

            var winningsIndex = $scope.stakeOptions.numBalls.value-1;

            
            
            var sixWinningsCalc= numeral($scope.sixWinningAmounts[winningsIndex] * $scope.stakeOptions.stake).format('0,0.00');
            var sixWinningsFloat = parseFloat(sixWinningsCalc.replace(/[,]/g, ''));
            if(sixWinningsFloat > 1000000.00){
            	sixWinningsCalc='1,000,000.00';
            }
            $scope.sixWinnings = sixWinningsCalc;
            
            
            var sevenWinningsCalc=numeral($scope.sevenWinningAmounts[winningsIndex] * $scope.stakeOptions.stake).format('0,0.00');
            var sevenWinningsFloat = parseFloat(sevenWinningsCalc.replace(/[,]/g, ''));
            if(sevenWinningsFloat > 1000000.00){
            	sevenWinningsCalc = '1,000,000.00';
            }
            $scope.sevenWinnings = sevenWinningsCalc;
            
        };

        $scope.update($scope.stakeOptions);



        $scope.videoSrc = "../media/49s_htp@720x576.mp4";
        $scope.thumbSrc = "../media/49s_htp_thumb.png";



        /*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});
        
        /* Miss Smiley Video */
        $(document).on('show.bs.modal', '#videoModalmiss', function(){
            $('#how_to_play_video_miss').trigger("play");
        });
        $(document).on('hide.bs.modal', '#videoModalmiss', function(){
            $('#how_to_play_video_miss').trigger("pause");
        });
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNLuckyDipController', [
    '$scope',
    function($scope) {
        /* load hero images */

        $scope.setTitle("49's - Lucky Dip");


		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.lucky_dip.length>0){
 				$.each(json.body.s49.lucky_dip, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.lucky_dip.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNMenuController', [
    '$scope','$location',
    function($scope,$location) {

	$scope.navigationOptions = [
            {
                id: "",
                cls: "fn-menu-button-latest",
                txt: "LATEST RESULTS"
            },
            {
                id: "previous",
                cls: "fn-menu-button-previous",
                txt: "PREVIOUS RESULTS"
            },
            {
                id: "lucky-dip",
                cls: "fn-menu-button-lucky",
                txt: "LUCKY DIP"
            },
            {
                id: "syndicates",
                cls: "fn-menu-button-syndicates",
                txt: "SYNDICATES"
            },
            {
                id: "presenters",
                cls: "fn-menu-button-winners",
                txt: "PRESENTERS"
            },
            {
                id: "how-to-play",
                cls: "fn-menu-button-how",
                txt: "HOW TO PLAY"
            }
        ];


        $scope.isActive = function (viewLocation) {
            if (viewLocation === "/49s/" && $location.path() === "/49s") {
                return true;
            } else if (viewLocation === "/49s/how-to-play" && $location.path() === "/49s/rules") {
                return true;
            } else if (viewLocation === "/49s/" && $location.path() === "/49s/hot-cold") {
                return true;
            }
            return viewLocation === $location.path();
        };


        // $scope.menuShown = false;
        //
        // $scope.menuToggleFn = function() {
        //     $scope.menuShown = !$scope.menuShown;
        //     $scope.menuDisplay = $scope.menuShown === true ? {'display':'block'} : {};
        // };

        $scope.bannerURL = function() {
          return "../../img/bg/bg_hot.png";
        }
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNPresentersController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's - Presenters");

      $scope.presenters = [];
      $scope.selectedPresenter = {};


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.winners.length>0){
 				$.each(json.body.s49.winners, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.winners.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}



    //Presenters

    function getPresenters() {
      $.ajax({
        url: $scope.baseURL+'/presenters/get_all',
        type: 'get',
        dataType: 'json',
        beforeSend: function() {
        },
        complete: function() {
        },
        success: parsePresenters,
        error: function(){
          console.log("error");
        }
      });
    }

    getPresenters();

    function parsePresenters(json) {
      if (json.body.length > 0) {
        $.each(json.body, function(i, obj) {
          if (obj.default == true) {
            // if (!obj.main_img_full) {
            //   obj.main_img_full = "";
            // }
            $scope.selectedPresenter = obj;
            $scope.selectedPresenter.hasVideo = ($scope.selectedPresenter.main_video_full.length > 0);
            $('video#presenter_main_video source').attr('src', $scope.selectedPresenter.main_video_full);
            $("video#presenter_main_video")[0].load();
          } else {
            $scope.presenters.push(obj);
          }
        });
        console.log(json);
        $scope.$apply();
      } else {

      }
    }

    $scope.presenterClicked = function(index) {
      $scope.selectedPresenter = $scope.presenters[index];

      $scope.selectedPresenter.hasVideo = ($scope.selectedPresenter.main_video_full.length > 0);

      $('video#presenter_main_video source').attr('src', $scope.selectedPresenter.main_video_full);
      $("video#presenter_main_video")[0].load();
    }



    $(document).on('show.bs.modal','#presenterMainVideoModal', function () {
      $('#presenter_main_video').trigger("play");
    });
    $(document).on('hide.bs.modal','#presenterMainVideoModal', function () {
      $('#presenter_main_video').trigger("pause");
    });

    //
    // $scope.presenterText = "<h3>49's Presenters Coming Soon</h3> \
    // <p>The 49's Draw just keeps getting better and the next improvement doesn't just walk the walk, it will literally talk the talk. We have 8 Presenters lined up to be the new faces and voices of the 49's draw. They will be talking through the 60 second countdown to the draw, pressing the button to release the balls and handing over to the commentator for the usual run down of the winning numbers.</p> \
    // <p>If you want to find out more about the new 49's presenting team then just click on an image below to watch a short video from each one. Follow us @Bet49s and get in touch with our new presenters using their hashtags.</p>";



    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNResultsController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's Previous Results");

      var ajaxRequest;
      $scope.showShare = false;


    	/* twitter share button */
        if (typeof(twttr) != 'undefined') {
            //$timeout = twttr.widgets.load();
        }
        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.previous.length>0){
 				$.each(json.body.s49.previous, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.previous.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

		/* latest results slider */
		$(document).ready(function(){

			var currentDate = new Date();

      var currentDay = ("0" + currentDate.getDate()).slice(-2);
      var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
		  var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

      var firstDay="16";
			var firstMonth="12";
			var firstYear="1996";

      var firstDate = $scope.dateStringFromComponents(firstYear, firstMonth, firstDay);
      var selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
      var currentDate = $scope.dateStringFromComponents(currentYear, currentMonth, currentDay);

			$scope.getBallColor = function(num){
		        var index  = (num-1) % 7;
		        var colors = ["green","red","orange","yellow","brown","purple","blue"];
		        return colors[index];
			}

			function getLotteryData(){
        if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
					url: $scope.baseURL+'/games/get_previous',
					type: 'post',
                                        contentType: "application/json; charset=utf-8",
					dataType: 'json',
					data:  JSON.stringify({"game":"49","date": selectedDate}),
					beforeSend: function() {
						$( ".no-results-for-date" ).remove();
						$('#main-spinner').css( "display","inline-block" );
						$('.resoults-middle-container').css( "display","none" );
					},
					complete: function() {
					},
					success: function(json) {

/*
						$('#lunchtime-49s-prev').html('');
						$('#teatime-49s-prev').html('');
						$('.fn-booster-container').css('display','none');


						try{
							if((json.body[0].results.actual_draw_time).indexOf(':') === -1)
							{}else{
								$('#lunchtime-49s-prev').html(json.body[0].results.actual_draw_time);
							}
						}catch (e) {}

						try{
							if((json.body[1].results.actual_draw_time).indexOf(':') === -1)
							{}else{
								$('#teatime-49s-prev').html(json.body[1].results.actual_draw_time);
							}
						}catch (e) {}
*/


						if (jQuery.isEmptyObject(json.body)){
							$( ".no-results-for-date" ).remove();
							$('#main-spinner').css( "display","none" );
							$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");


						}else{


							$( ".no-results-for-date" ).remove();
							$('#main-spinner').css( "display","none" );
							$('.resoults-middle-container').css( "display","inline-block" );





							$('#next-event').css( "display","none" );


              var draws = [];

              for (var i=0;i<json.body.length;i++) {
                var draw = {};
                if (json.body[i].status == 0) {
                  draw.time = json.body[i].results.actual_draw_time;
                  draw.status = json.body[i].status;
                  draw.drawName = json.body[i].draw_name.toUpperCase();
                  draws.push(draw);
                } else if (json.body[i].results.length == 0) {
                  $scope.nextDrawTime = json.body[i].draw_time;
                  $('#next-event').css( "display","block" );
                } else {
                  draw.time = json.body[i].results.actual_draw_time;
                  draw.status = json.body[i].status;
                  draw.numbers = json.body[i].results.numbers;
                  draw.sortedNumbers = json.body[i].results.numbers.concat().sort($scope.sortNumber);
                  draw.displayedNumbers = draw.sortedNumbers;
                  if (json.body[i].results.booster != 0) {
                    draw.booster =  json.body[i].results.booster;
                  }
                  draw.drawName = json.body[i].draw_name.toUpperCase();
                  draws.push(draw);
                }
              }

              $scope.draws = draws;

              $scope.$apply();


						}

			    		number_1 = $('#check_nb_1').val();
			    		number_2 = $('#check_nb_2').val();
			    		number_3 = $('#check_nb_3').val();
			    		number_4 = $('#check_nb_4').val();
			    		number_5 = $('#check_nb_5').val();

						$( ".ball-selected" ).remove();
			    		$( ".fn-ball-nb-"+number_1 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_2 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_3 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_4 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_5 ).before( "<div class='ball-selected'></div>" );

						//$('.resoults-middle-container').html( JSON.stringify(json) );
						//$('.resoults-middle-container').css( 'color','white');
			    		
						checkNumbers();
						 
			    		
					},
					error: function(){
						// // alert('Connection error! Please try again.');
					}
				});
			}

      $scope.drawSorted = true;
      $scope.toggleDrawOrder = function() {
        $scope.drawSorted = !$scope.drawSorted;
        for (var i=0;i<$scope.draws.length;i++) {
          var draw = $scope.draws[i];
          if ($scope.drawSorted) {
            draw.displayedNumbers = draw.sortedNumbers;
          } else {
            draw.displayedNumbers = draw.numbers;
          }
        }
        setTimeout(function() {checkNumbers();}, 0);
      };


      function showDraw (numbers, booster, idPrefix) {

        for (var i in numbers) {
          if(numbers[i]){
            var num = parseInt(i)+1;
            $("#"+idPrefix+""+num).html(numbers[i]);
            color=$scope.getBallColor(numbers[i]);
            $("#"+idPrefix+""+num).removeClass();
            $("#"+idPrefix+""+num).addClass('fn-ball-'+color);
            $("#"+idPrefix+""+num).addClass('fn-ball-nb-'+numbers[i]);
          }
        }

        if(booster){
          $("#"+idPrefix+"b").html(booster);
          color=$scope.getBallColor(booster);
          $("#"+idPrefix+"b").removeClass();
          $("#"+idPrefix+"b").addClass('fn-ball-'+color);
          $("#"+idPrefix+"b").addClass('fn-ball-nb-'+booster);
        }

      }

			function populateSelectBoxes(){
				//populate months select box and set current month
				$('#month option:eq('+(selectedMonth-1)+')').prop('selected', true);
				//populate years select box and set last as selected
				var yearsArray = new Array();
				for (i=0;(currentYear-i)>=firstYear;i++){
					yearsArray[i]=currentYear-i;
				}
				$("#year").empty();
				$.each(yearsArray, function(val, text) {
		            $('#year').append(
		                $('<option></option>').val(text).html(text)
		            );
				});
				$('#year option[value="'+selectedYear+'"]').prop('selected', true);
			}

			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}

			function disableSelectBoxesOptions(){
				if($( "#year" ).val() == currentYear){
					if(currentMonth<1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(currentMonth<2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(currentMonth<3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(currentMonth<4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(currentMonth<5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(currentMonth<6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(currentMonth<7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(currentMonth<8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(currentMonth<9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(currentMonth<10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(currentMonth<11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(currentMonth<12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else if ($( "#year" ).val() == firstYear){
					if(firstMonth>1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(firstMonth>2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(firstMonth>3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(firstMonth>4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(firstMonth>5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(firstMonth>6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(firstMonth>7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(firstMonth>8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(firstMonth>9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(firstMonth>10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(firstMonth>11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(firstMonth>12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else{
					$("#month option[value='1']").removeAttr('disabled');
					$("#month option[value='2']").removeAttr('disabled');
					$("#month option[value='3']").removeAttr('disabled');
					$("#month option[value='4']").removeAttr('disabled');
					$("#month option[value='5']").removeAttr('disabled');
					$("#month option[value='6']").removeAttr('disabled');
					$("#month option[value='7']").removeAttr('disabled');
					$("#month option[value='8']").removeAttr('disabled');
					$("#month option[value='9']").removeAttr('disabled');
					$("#month option[value='10']").removeAttr('disabled');
					$("#month option[value='11']").removeAttr('disabled');
					$("#month option[value='12']").removeAttr('disabled');
				}

        if ($( "#month" ).val() < parseInt(firstMonth)){
          $("#year option[value='"+firstYear+"']").attr('disabled','disabled');
        } else {
          $("#year option[value='"+firstYear+"']").removeAttr('disabled');
        }
			}

			function setMonthlySwitchers(){
				var previousMonths = new Array();
				previousMonths[1]='December';
				previousMonths[2]='January';
				previousMonths[3]='February';
				previousMonths[4]='March';
				previousMonths[5]='April';
				previousMonths[6]='May';
				previousMonths[7]='June';
				previousMonths[8]='July';
				previousMonths[9]='August';
				previousMonths[10]='September';
				previousMonths[11]='October';
				previousMonths[12]='November';
				previousMonthText=previousMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==1){
            		previousMonthText+=$( "#year" ).val()-1;
            	}else{
            		previousMonthText+=$( "#year" ).val();
            	}
            	$('#previous-month-switch').html(previousMonthText);

				var nextMonths = new Array();
				nextMonths[1]='February';
				nextMonths[2]='March';
				nextMonths[3]='April';
				nextMonths[4]='May';
				nextMonths[5]='June';
				nextMonths[6]='July';
				nextMonths[7]='August';
				nextMonths[8]='September';
				nextMonths[9]='October';
				nextMonths[10]='November';
				nextMonths[11]='December';
				nextMonths[12]='January';

				nextMonthText=nextMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==12){
            		nextMonthText+=(parseInt($( "#year" ).val())+1);
            	}else{
            		nextMonthText+=$( "#year" ).val();
            	}
            	$('#next-month-switch').html(nextMonthText);
            	//disable next month button
            	if(selectedYear == currentYear && selectedMonth >= currentMonth){
            		$('#nextMonthClick').css( "display","none" );
            	}else{
					$('#nextMonthClick').css( "display","inline-block" );
            	}
            	//disable previous month button
            	if(selectedYear == firstYear && selectedMonth <= firstMonth){
            		$('#prevMonthClick').css( "display","none" );
            	}else{
					$('#prevMonthClick').css( "display","inline-block" );
            	}
			}
			function scrollToSelectedPosition(){
				var selectedElement=$( ".days-controls-selected" );
				var position = selectedElement.position();
				//$( "#days-list-49s" ).animate({left: -position.left}, 500, function() { });
				$( "#days-list-49s" ).css("left", -position.left);
			}


			function setDaysSlider(){

				$("#days-list-49s").empty();

				//selected main element
				if(new Date(selectedDate) >= new Date(firstDate) &&  new Date(selectedDate) <= new Date(currentDate) ){
					$("#days-list-49s").append('<li class="days-controls-selected"><a href="#" class="dayselect-49s" data-position="0"  data-date="'+selectedDate+'">'+$scope.getShortDayName(selectedDate)+'<br><span class="dayNum">'+$scope.getDayNumber(selectedDate)+'</span></a></li>');
				}
				//prepened options
				daybefore = $scope.getDateBeforeDate(selectedDate);

				if(new Date(daybefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-1"  data-date="'+daybefore+'">'+$scope.getShortDayName(daybefore)+'<br><span class="dayNum">'+$scope.getDayNumber(daybefore)+'</span></a></li>');
				}

				twodaysbefore = $scope.getDateBeforeDate(daybefore);
				if(new Date(twodaysbefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-3"  data-date="'+twodaysbefore+'">'+$scope.getShortDayName(twodaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysbefore)+'</span></a></li>');
				}

				threedaysbefore = $scope.getDateBeforeDate(twodaysbefore);
				if(new Date(threedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-4"  data-date="'+threedaysbefore+'">'+$scope.getShortDayName(threedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysbefore)+'</span></a></li>');
				}

				fourdaysbefore = $scope.getDateBeforeDate(threedaysbefore);
				if(new Date(fourdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-5"  data-date="'+fourdaysbefore+'">'+$scope.getShortDayName(fourdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysbefore)+'</span></a></li>');
				}

				fivedaysbefore = $scope.getDateBeforeDate(fourdaysbefore);
				if(new Date(fivedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-6"  data-date="'+fivedaysbefore+'">'+$scope.getShortDayName(fivedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysbefore)+'</span></a></li>');
				}

				sixdaysbefore = $scope.getDateBeforeDate(fivedaysbefore);
				if(new Date(sixdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-7"  data-date="'+sixdaysbefore+'">'+$scope.getShortDayName(sixdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysbefore)+'</span></a></li>');
				}

				sevendaysbefore = $scope.getDateBeforeDate(sixdaysbefore);
				if(new Date(sevendaysbefore) >= new Date(firstDate)  ){
					$("#days-list-49s").prepend('<li><a href="#" class="dayselect-49s" data-position="-8"  data-date="'+sevendaysbefore+'">'+$scope.getShortDayName(sevendaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysbefore)+'</span></a></li>');
				}

				//appended options
				dayafter = $scope.getDateAfterDate(selectedDate);
				if(new Date(dayafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="1"  data-date="'+dayafter+'">'+$scope.getShortDayName(dayafter)+'<br><span class="dayNum">'+$scope.getDayNumber(dayafter)+'</span></a></li>');
				}

				twodaysafter = $scope.getDateAfterDate(dayafter);
				if(new Date(twodaysafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="2"  data-date="'+twodaysafter+'">'+$scope.getShortDayName(twodaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysafter)+'</span></a></li>');
				}

				threedaysafter = $scope.getDateAfterDate(twodaysafter);
				if(new Date(threedaysafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="3"  data-date="'+threedaysafter+'">'+$scope.getShortDayName(threedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysafter)+'</span></a></li>');
				}

				fourdaysafter = $scope.getDateAfterDate(threedaysafter);
				if(new Date(fourdaysafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="4"  data-date="'+fourdaysafter+'">'+$scope.getShortDayName(fourdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysafter)+'</span></a></li>');
				}

				fivedaysafter = $scope.getDateAfterDate(fourdaysafter);
				if(new Date(fivedaysafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="5"  data-date="'+fivedaysafter+'">'+$scope.getShortDayName(fivedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysafter)+'</span></a></li>');
				}

				sixdaysafter = $scope.getDateAfterDate(fivedaysafter);
				if(new Date(sixdaysafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="6"  data-date="'+sixdaysafter+'">'+$scope.getShortDayName(sixdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysafter)+'</span></a></li>');
				}

				sevendaysafter = $scope.getDateAfterDate(sixdaysafter);
				if(new Date(sevendaysafter) <= new Date(currentDate)  ){
					$("#days-list-49s").append('<li><a href="#" class="dayselect-49s" data-position="7"  data-date="'+sevendaysafter+'">'+$scope.getShortDayName(sevendaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysafter)+'</span></a></li>');
				}

				scrollToSelectedPosition();
				populateSelectBoxes();
				disableSelectBoxesOptions();
				setMonthlySwitchers();
				updateDaySwitchers();
				getLotteryData();
			}

			//initiate everything
			populateSelectBoxes();
			setDaysSlider();

			$( "#month" ).change(function() {
				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			$( "#year" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on day selector click
			$('#days-list-49s').on('click', ' a.dayselect-49s', function(event) {
				event.preventDefault();
				dateArray=this.getAttribute("data-date").split("-");
				selectedDay = dateArray[2];
				selectedMonth = dateArray[1];
				selectedYear = dateArray[0];
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
				setDaysSlider();
			});

			$("#prevMonthClick").click(function(event){
			    event.preventDefault();

				//set year
				selectedYear=$( "#year" ).val();
				//set month

				selectedMonth = $( "#month" ).val()-1;
				//switch to previous year
				if(selectedMonth==0){
					selectedMonth = 12;
					selectedYear = selectedYear-1;
				}
				if(selectedYear == firstYear && selectedMonth < firstMonth){
					selectedMonth = firstMonth;
				}
				//set day


				if(selectedYear == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();

			});

			$("#nextMonthClick").click(function(event){
			    event.preventDefault();
				//set year
				selectedYear=$( "#year" ).val();
				//set month

				selectedMonth = parseInt($( "#month" ).val())+1;

				//switch to previous year
				if(selectedMonth==13){
					selectedMonth = 1;
					selectedYear = parseInt(selectedYear)+1;
				}
				if(selectedYear == currentYear && selectedMonth > currentMonth){
					selectedMonth = currentMonth;
				}
				//set day
				if(selectedYear == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dateAfterArray=dateAfter.split("-");

				if(new Date(dateAfter) > new Date(currentDate)  ){
				}else{
					selectedDay = dateAfterArray[2];
					selectedMonth = dateAfterArray[1];
					selectedYear = dateAfterArray[0] ;

					selectedDate = dateAfter;
				}
				setDaysSlider();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();

				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dateBeforeArray=dateBefore.split("-");
				if(new Date(dateBefore) < new Date(firstDate)  ){

				}else{
					selectedDay = dateBeforeArray[2];
					selectedMonth = dateBeforeArray[1];
					selectedYear = dateBeforeArray[0] ;

					selectedDate = dateBefore;
				}
				setDaysSlider();
			});

		});

    	$scope.clearNumbers = function(name) {
    		$( ".fn-ball-wrapper" ).css({"opacity":"1"});
    		$scope.check_number_1='';
    		$scope.check_number_2='';
    		$scope.check_number_3='';
    		$scope.check_number_4='';
    		$scope.check_number_5='';
    	}

      function validateNumber(number) {

        var int = parseInt(number);
        if (int > 0 && int <= 49) {
          return int;
        }
        return '';
      }

    	function checkNumbers(){
    		
        $scope.check_number_1 =	validateNumber($scope.check_number_1);
        $scope.check_number_2 =	validateNumber($scope.check_number_2);
        $scope.check_number_3 =	validateNumber($scope.check_number_3);
        $scope.check_number_4 =	validateNumber($scope.check_number_4);
        $scope.check_number_5 =	validateNumber($scope.check_number_5);

    		number_1 =	$scope.check_number_1;
    		number_2 =	$scope.check_number_2;
    		number_3 =	$scope.check_number_3;
    		number_4 =	$scope.check_number_4;
    		number_5 =	$scope.check_number_5;

        if (clearNumbersEnabled()) {
        	$( ".fn-ball-wrapper" ).css({"opacity":"0.3"});
        	$( "#clear_num_btn" ).css({"opacity":"1"});
        } else {
        	$( "#clear_num_btn" ).css({"opacity":"0.5"});
        }

    		$( ".ball-selected" ).remove();
    		
    		$( ".fn-ball-nb-"+number_1 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_1 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_2 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_2 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_3 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_3 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_4 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_4 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_5 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_5 ).parent().parent().css({"opacity":"1.0"});
    	}


      function clearNumbersEnabled() {
    	  
        if ($scope.check_number_1 > 0
          || $scope.check_number_2 > 0
          || $scope.check_number_3 > 0
          || $scope.check_number_4 > 0
          || $scope.check_number_5 > 0) {
            return true;
          }
          return false;
      };

    	$scope.$watch('check_number_1', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_2', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_3', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_4', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_5', function() { checkNumbers(); }, true);

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNRulesController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's - Rules");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.rules.length>0){
 				$.each(json.body.s49.rules, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.rules.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNSyndicatesController', [
    '$scope',
    function($scope) {
        /* load hero images */

        $scope.setTitle("49's - Syndicates");

		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.s49.syndicates.length>0){
 				$.each(json.body.s49.syndicates, function(i,obj) {
 					var slide='';
					try{
						if(json.body.s49.syndicates.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Directives = angular.module('FNApp.FNDirectives', []);

window.FN = window.FN || {};
window.FN = {};

window.FN = window.FN || {};
window.FN = {};

FN.Services = angular.module('FNApp.FNServices', []);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFooterController', [
    '$scope','$location',

    function($scope, $location) {
        $scope.footerLinks = [
            {
                id: "help",
                title: "HELP",
                path: "/help"
            },
            {
                id: "legal",
                title: "LEGAL",
                path: "/legal"
            },
            {
                id: "contact",
                title: "CONTACT",
                path: "/contact"
            }
        ];



        $scope.shareholderClickFn = function(link) {
          window.open(link, '_blank');
        }

        $scope.navigationClickFn = function(path) {
            location.href = path;
        }

        $scope.showDisclaimer = function() {
          return $location.path() === "/legal"
        };
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNMenuController', [
    '$scope','$location',
    function($scope, $location) {
        $scope.applicationName = 'Fourty Nines';

        $scope.navigationOptions = [
            {
                id: "",
                cls: "fn-menu-button-home",
                txt: "HOME"
            },
            {
                id: "findbettingShop",
                cls: "fn-menu-button-find",
                txt: "FIND A BETTING SHOP"
            },
            {
                id: "thefount",
                cls: "fn-menu-button-oracle",
                txt: "THE FOUNT"
            },
            {
                id: "bethere",
                cls: "fn-menu-button-bet",
                txt: "BET HERE"
            },
            {
                id: "stayintouch",
                cls: "fn-menu-button-stay",
                txt: "STAY IN TOUCH"
            },
            {
                id: "responsible",
                cls: "fn-menu-button-responsible",
                txt: "RESPONSIBLE GAMBLING"
            },
            {
                id: "mobileapp",
                cls: "fn-menu-button-mobile",
                txt: "MOBILE APP"
            }
        ];

        // $scope.navigationClickFn = function(navigationOption) {
        //     $location.path('/'+navigationOption);
        //     $scope.menuShown = false;
        //     $scope.menuDisplay = {};
        // };


        $scope.isActive = function (viewLocation) {
            return viewLocation === $location.path();
        };

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNProductNavController', [
    '$scope','$location',
    function($scope, $location) {
        $scope.applicationName = 'Fourty Nines';

        $scope.navigationOptions = [
            {
                id: "49s",
                cls: "fn-header-icon-fourtynines",
                gridCls: "fn-product-grid-49s",
                bgCls: "fn-product-grid-bg-49s",
                titleCls: "fn-product-grid-49s-header",
                title: "49's",
                path:"49s"
            },
            {
                id: "ilb",
                cls: "fn-header-icon-irishlottobet",
                gridCls: "fn-product-grid-irishlotto",
                bgCls: "fn-product-grid-bg-irishlotto",
                titleCls: "fn-product-grid-irishlotto-header",
                title: "IRISH LOTTO BET",
                path:"irishlottobet"
            },
            {
                id: "vhr",
                cls: "fn-header-icon-vhr",
                gridCls: "fn-product-grid-vhr",
                bgCls: "fn-product-grid-bg-vhr",
                titleCls: "fn-product-grid-vhr-header",
                title: "VIRTUAL HORSES",
                path:"virtualhorseracing"
            },
            {
                id: "vgr",
                cls: "fn-header-icon-vgr",
                gridCls: "fn-product-grid-vgr",
                bgCls: "fn-product-grid-bg-vgr",
                titleCls: "fn-product-grid-vgr-header",
                title: "VIRTUAL GREYHOUNDS",
                path:"virtualgreyhoundracing"
            },
            {
                id: "rapido",
                cls: "fn-header-icon-rapido",
                gridCls: "fn-product-grid-rapido",
                bgCls: "fn-product-grid-bg-rapido",
                titleCls: "fn-product-grid-rapido-header",
                title: "RAPIDO",
                path: "rapido"
            }
        ];

        $.ajax({
          url: $scope.baseURL+'/games/get_next_game',
          type: 'post',
                                        contentType: "application/json; charset=utf-8",
          dataType: 'json',
          data:  JSON.stringify({"date": Date.today().toString("yyyy-MM-dd")}),
          beforeSend: function() {
          },
          complete: function() {
          },
          success: showScheduledEvents,
          error: function(){
            // alert('Connection error! Please try again.');
          }
        });


        function showScheduledEvents(json) {


          $scope.scheduledEvents = {};

          if (json.body.next_game_49s === "No scheduled events today") {
            $scope.scheduledEvents["49s"] = "<strong>"+json.body.next_game_49s.toUpperCase()+"</strong>";
          } else {
            $scope.scheduledEvents["49s"] = "<strong>NEXT EVENT</strong><br>" + json.body.next_game_49s;
          }

          if (json.body.next_game_ilb === "No scheduled events today") {
            $scope.scheduledEvents["ilb"] = "<strong>"+json.body.next_game_ilb.toUpperCase()+"</strong>";
          } else {
            $scope.scheduledEvents["ilb"] = "<strong>NEXT EVENT</strong><br>" + json.body.next_game_ilb;
          }

          if (json.body.next_game_vhr === "No scheduled events today") {
            $scope.scheduledEvents["vhr"] = "<strong>"+json.body.next_game_vhr.toUpperCase()+"</strong>";
          } else {
            $scope.scheduledEvents["vhr"] = "<strong>NEXT EVENT</strong><br>" + json.body.next_game_vhr;
          }

          if (json.body.next_game_vgr === "No scheduled events today") {
            $scope.scheduledEvents["vgr"] = "<strong>"+json.body.next_game_vgr.toUpperCase()+"</strong>";
          } else {
            $scope.scheduledEvents["vgr"] = "<strong>NEXT EVENT</strong><br>" + json.body.next_game_vgr;
          }

          if (json.body.next_game_ra === "No scheduled events today") {
            $scope.scheduledEvents["rapido"] = "<strong>NEXT EVENT TOMORROW</strong>";
          } else {
            $scope.scheduledEvents["rapido"] = "<strong>NEXT EVENT</strong><br>" + json.body.next_game_ra;
          }

          $scope.$apply();

        }



    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNTopMenuController', [
    '$scope','$location',
    function($scope, $location) {
        $scope.applicationName = 'Fourty Nines';

        $scope.navigationOptions = [
            {
                id: "49s",
                cls: "fn-header-icon-fourtynines",
                gridCls: "fn-product-grid-49s",
                bgCls: "fn-product-grid-bg-49s",
                titleCls: "fn-product-grid-49s-header",
                title: "49's",
                path:"49s"
            },
            {
                id: "ilb",
                cls: "fn-header-icon-irishlottobet",
                gridCls: "fn-product-grid-irishlotto",
                bgCls: "fn-product-grid-bg-irishlotto",
                titleCls: "fn-product-grid-irishlotto-header",
                title: "IRISH LOTTO BET",
                path:"irishlottobet"
            },
            {
                id: "vhr",
                cls: "fn-header-icon-vhr",
                gridCls: "fn-product-grid-vhr",
                bgCls: "fn-product-grid-bg-vhr",
                titleCls: "fn-product-grid-vhr-header",
                title: "VIRTUAL HORSES",
                path:"virtualhorseracing"
            },
            {
                id: "vgr",
                cls: "fn-header-icon-vgr",
                gridCls: "fn-product-grid-vgr",
                bgCls: "fn-product-grid-bg-vgr",
                titleCls: "fn-product-grid-vgr-header",
                title: "VIRTUAL GREYHOUNDS",
                path:"virtualgreyhoundracing"
            },
            {
                id: "rapido",
                cls: "fn-header-icon-rapido",
                gridCls: "fn-product-grid-rapido",
                bgCls: "fn-product-grid-bg-rapido",
                titleCls: "fn-product-grid-rapido-header",
                title: "RAPIDO",
                path: "rapido"
            }
        ];
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNShareholderController', [
    '$scope',
    function($scope) {


      function getImages() {
        $.ajax({
          url: $scope.baseURL+'/shareholders/shareholders_banner',
          type: 'get',
          dataType: 'json',
          beforeSend: function() {
          },
          complete: function() {
          },
          success: showImages,
          error: function(){
            // // alert('Connection error! Please try again.');
            console.log("error");
          }
        });
      }


      getImages();

      function showImages(json) {

        if (json.body.length > 0) {
          $.each(json.body, function(i,obj) {

            var index = $scope.shareholderNames.indexOf(obj.provider);
            $scope.shareholderBoxes[index].img = obj.img;
            $scope.shareholderBoxes[index].link = obj.link;

  				});
        }

        $scope.$apply();
      }



      $scope.navigationClickFn = function(link) {
        window.open(link, '_blank');
      }

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILHomeController', [
    '$scope','$http','$timeout',
    function($scope, $http, $timeout) {

      $scope.setTitle("Irish Lotto Bet - Latest Results");

      var ajaxRequest;
      var draw1 = {};
      var draw2 = {};
      var draw3 = {};

      $scope.draw1Visible = false;
      $scope.draw2Visible = false;
      $scope.draw3Visible = false;

      $scope.showShare = false;

      function updateShareResults() {
        $('#share-tw').html('');
        $('#share-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$scope.location.absUrl()+'" data-text="'+resultsShareText()+'" data-size="large" data-count="none">Tweet</a>');
        if ('twttr' in window && window['twttr'] !== null) {
          twttr.widgets.load();
        }

        $('#share-mail').html('');
        $('#share-mail').html('<a href="mailto:%20?subject=Irish Lotto Bet&body='+mailShareText()+'"><img src="../../img/icons/ic_email.png"></a>');

        $scope.showShare = true;
        $scope.$apply();
      }


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.il.latest.length>0){
 				$.each(json.body.il.latest, function(i,obj) {
 					var slide='';
					try{
						if(json.body.il.latest.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0 && this.url=='') {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:100px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();}
							else{
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="Irish Lotto Bet" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
							}
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}

			//add promo images
			if(json.body.promo.is_promo_ilb_latest.length>0){
		        var banner='';
				$.each(json.body.promo.is_promo_ilb_latest, function(i,obj) {
					try{
						banner='<div class="fn-promo-section">';
						if(obj.url!=''){
							banner+='<a href="'+obj.url+'">';
						}else{
							banner+='<a href="#">';
						}
						banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
						}
						banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
					}catch(e){}
					 $(".fn-promo-container").append(banner);
				});
			}
		}

		/* latest results slider */
		$(document).ready(function(){
			var findLatestFlag=0;
			var currentDate = new Date();

      var currentDay = ("0" + currentDate.getDate()).slice(-2);
      var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
		  var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

      var firstDay="05";
			var firstMonth="05";
			var firstYear="1996";

			var firstDate = firstYear+'-'+firstMonth+'-'+firstDay;
			var selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
			var currentDate = currentYear+'-'+currentMonth+'-'+currentDay;

			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore = $scope.getDateBeforeDate(selectedDate);
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter=$scope.getDateAfterDate(selectedDate);
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}

      function getHotCold() {
        $.ajax({
            url: $scope.baseURL+'/games/get_hot_cold_balls',
            type: 'post',
                                        contentType: "application/json; charset=utf-8",
            dataType: 'json',
            data:  JSON.stringify({"game_type":"il"}),
            beforeSend: function() {

            },
            complete: function() {
              //alert('complete');
            },
            success: handleHotCold,
            error: function(){
              alert('error');
            }
          });

      };


      function handleHotCold(json) {

        if (jQuery.isEmptyObject(json.body)){

        } else {

          $scope.hotBalls = json.body.hot;
          $scope.coldBalls = json.body.cold;
          $scope.$apply();

        }


      }


			function getLotteryData(selectedDate){

        if(!$scope.$$phase) {
          $scope.$apply(function() {
            $scope.showShare = false;
          });
        } else {
          $scope.showShare = false;
        }


        if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
					url: $scope.baseURL+'/games/get_previous',
					type: 'post',
                                        contentType: "application/json; charset=utf-8",
					dataType: 'json',
					data:  JSON.stringify({"game":"il","date": selectedDate}),
					beforeSend: function() {
						$( ".no-results-for-date" ).remove();
						$('#main-spinner').css( "display","inline-block" );
						$('.resoults-middle-container').css( "display","none" );
					},
					complete: function() {
						//alert('complete');
					},
					success: handleData,
					error: function(){
						console.log('error');
					}
				});
			}

			function handleData(json) {

				$('#main_draw').html('');
				$('#second_draw').html('');
				$('#third_draw').html('');
				$('.resoults-ball-draw:nth-child(2)').css('display','none');
				$('.resoults-ball-draw:nth-child(3)').css('display','none');
				$('.resoults-ball-draw:nth-child(4)').css('display','none');
				$('#ilb-next-event').css( "display","none" );
				draw1 = {};
				draw2 = {};
				draw3 = {};



				if (jQuery.isEmptyObject(json.body)){
					$( ".no-results-for-date" ).remove();
					$('#main-spinner').css( "display","none" );
					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");
					$scope.showShare = false;
					$scope.$apply();
					//if no results try to get results from previous date
					if(findLatestFlag==0){
						selectedDate=$scope.getDateBeforeDate(selectedDate);
						getLotteryData(selectedDate);
						$('#activeDate').html('');
						$('#previous-day').css( "display","none" );
						$('#next-day').css( "display","none" );
					}
				}else{
					findLatestFlag=1;
					$( ".no-results-for-date" ).remove();
					$('#main-spinner').css( "display","none" );
					$('.resoults-middle-container').css( "display","inline-block" );



					if (json.body[0] && (json.body[0].results).length==0 ){
						$('#ilb-next-event').css( "display","block" );
		                $('#ilb-next-event-time').html( json.body[0].draw_time );
					}else{
						$('.resoults-ball-draw:nth-child(2)').css('display','inline-block');
						try{
							if((json.body[0].draw_time).indexOf(':') === -1)
							{}else{
								$('#main_draw').html(json.body[0].draw_time);
							}
						}catch (e) {}

						draw1.numbers = json.body[0].results.numbers;
						draw1.sortedNumbers = json.body[0].results.numbers.concat().sort($scope.sortNumber);
						draw1.booster =  json.body[0].results.booster;
            $scope.draw1Visible = json.body[0].status == 0 ? false : true;
						showDraw(draw1.sortedNumbers, draw1.booster, "mb");
						updateShareResults();
					}




					if (jQuery.isEmptyObject(json.body[1])){
					}else{

						$('.resoults-ball-draw:nth-child(3)').css('display','inline-block');
						try{
							if((json.body[1].draw_time).indexOf(':') === -1)
							{}else{
								$('#second_draw').html(json.body[1].draw_time);
							}
						}catch (e) {}
						draw2.numbers = json.body[1].results.numbers;
						draw2.sortedNumbers = json.body[1].results.numbers.concat().sort($scope.sortNumber);
						draw2.booster =  json.body[1].results.booster;
            $scope.draw2Visible = json.body[1].status == 0 ? false : true;
						showDraw(draw2.sortedNumbers, draw2.booster, "sb");
						updateShareResults();
					}




					if (jQuery.isEmptyObject(json.body[2])){
					}else{
						$('.resoults-ball-draw:nth-child(4)').css('display','inline-block');
						try{
							if((json.body[2].draw_time).indexOf(':') === -1)
							{}else{
								$('#third_draw').html(json.body[2].draw_time);
							}
						}catch (e) {}
						draw3.numbers = json.body[2].results.numbers;
						draw3.sortedNumbers = json.body[2].results.numbers.concat().sort($scope.sortNumber);
						draw3.booster =  json.body[2].results.booster;
            $scope.draw3Visible = json.body[2].status == 0 ? false : true;
						showDraw(draw3.sortedNumbers, draw3.booster, "tb");
						updateShareResults();
					}





					updateDaySwitchers();
					updateTitleDate();
					//updateShareResults();
				}
				//$('.resoults-middle-container').html( JSON.stringify(json) );
				//$('.resoults-middle-container').css( 'color','white');


			}

      $scope.drawSorted = true;
      $scope.toggleDrawOrder = function() {
        $scope.drawSorted = !$scope.drawSorted;
        if ($scope.drawSorted) {
          showDraw(draw1.sortedNumbers, draw1.booster, "mb");
          showDraw(draw2.sortedNumbers, draw2.booster, "sb");
          showDraw(draw3.sortedNumbers, draw3.booster, "tb");
        } else {
          showDraw(draw1.numbers, draw1.booster, "mb");
          showDraw(draw2.numbers, draw2.booster, "sb");
          showDraw(draw3.numbers, draw3.booster, "tb");
        }
      };


      function showDraw (numbers, booster, idPrefix) {

        for (var i in numbers) {
          if(numbers[i]){
            var num = parseInt(i)+1;
            $("#"+idPrefix+""+num).html(numbers[i]);
          }
        }

        if(booster){
          $("#"+idPrefix+"b").html(booster);
        }

      }

			function updateTitleDate() {
				dayNumber = $scope.getDayNumber(selectedDate);
        dayEnd = $scope.ordinalForDayNumber(dayNumber).toUpperCase();

				var d = new Date(selectedDate);
				var month = new Array();
        month[0] = "JANUARY";
				month[1] = "FEBRUARY";
				month[2] = "MARCH";
				month[3] = "APRIL";
				month[4] = "MAY";
				month[5] = "JUNE";
				month[6] = "JULY";
				month[7] = "AUGUST";
				month[8] = "SEPTEMBER";
				month[9] = "OCTOBER";
				month[10] = "NOVEMBER";
				month[11] = "DECEMBER";
				var monthName = month[d.getMonth()];

				// $('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+dayEnd+' '+monthName+' '+d.getFullYear());
        $('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+'<sup>'+dayEnd.toLowerCase()+'</sup> '+monthName+' '+d.getFullYear());
			}

			//initiate everything
      getHotCold();
			getLotteryData(selectedDate);
			updateDaySwitchers();
			updateTitleDate();
			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();
				selectedDate=$scope.getDateAfterDate(selectedDate);
				getLotteryData(selectedDate);
				updateDaySwitchers();
				updateTitleDate();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();
				selectedDate=$scope.getDateBeforeDate(selectedDate);
				getLotteryData(selectedDate);
				updateDaySwitchers();
				updateTitleDate();
			});
		});


    // ILB Results:
    // Main Draw: 12,12,12,12,12,12 Bonus:12
    // 2nd:12,12,12,12,12,12 Bonus:12
    // 3rd:12,12,12,12,12,12 Bonus:12

    function resultsShareText() {
      var resultText;
      var mainText = "Main Draw:";
      for (var i in draw1.sortedNumbers) {
        mainText += draw1.sortedNumbers[i];
        if (i < draw1.sortedNumbers.length -1) {
          mainText += ',';
        }
      }
      mainText += " Bonus:"+draw1.booster;

      if (jQuery.isEmptyObject(draw2.sortedNumbers)){
      }else{
	      if (draw2.sortedNumbers.length > 0) {
	        mainText += " 2nd:";
	        for (var i in draw2.sortedNumbers) {
	          mainText += draw2.sortedNumbers[i];
	          if (i < draw2.sortedNumbers.length -1) {
	            mainText += ',';
	          }
	        }
	        mainText += " Bonus:"+draw2.booster;
	      }
      }
      if (jQuery.isEmptyObject(draw3.sortedNumbers)){
      }else{
	      if (draw3.sortedNumbers.length > 0) {
	        mainText += " 3rd:";
	        for (var i in draw3.sortedNumbers) {
	          mainText += draw3.sortedNumbers[i];
	          if (i < draw3.sortedNumbers.length -1) {
	            mainText += ',';
	          }
	        }
	        mainText += " Bonus:"+draw3.booster;
	      }
      }

        resultText = "ILB Results: "+ mainText;

      return resultText;
    }

    function mailShareText() {
      var resultText = resultsShareText();
      return resultText + '%0D%0A' + $scope.location.absUrl();
    }

 $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		}); 

    }]


);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILHotColdController', [
    '$scope','$http',
    function($scope,$http) {

      $scope.setTitle("Irish Lotto Bet - Hot & Cold");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.il.hot_cold.length>0){
 				$.each(json.body.il.hot_cold, function(i,obj) {
 					var slide='';
					try{
						if(json.body.il.hot_cold.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

		/* hot and cold balls table functions */
        $scope.totalDrawn;
        $scope.startDate;
        $scope.endDate;

        $scope.hottestNum;
        $scope.coldestNum;


        $scope.headerIndex = 0;

        var sortType;
        var sortAscending = false;

        $scope.getStats = function() {
        	$http.post($scope.baseURL+'/games/get_balls_statistics', { "game_type":"il"}).
                            success(function(data, status, headers, config) {
                                if (data.server_obj.success === true) {
                                    $scope.ballStats = data.body.statistic;
                                    $scope.totalDrawn = data.body.total.counter;

                                    $scope.startDate = Date.parse(data.body.first_draw.date).toString('dd/MM/yyyy');
                                    $scope.endDate = Date.parse(data.body.last_draw.date).toString('dd/MM/yyyy');

                                    $scope.sortByType(3);
                                    $scope.hottestNum = $scope.ballStats[0].number;
                                    $scope.coldestNum = $scope.ballStats[$scope.ballStats.length-1].number;

                                    // $scope.sortByType(0);

                                } else {
                                    console.log('error loading stats');
                                }
                            }).
                            error(function(data, status, headers, config) {
                                console.log('error loading stats');
                            })
        };


	    $scope.getStats();

	    $scope.sortByType = function(headerIndex) {

	        if (!$scope.ballStats.length) return;

	        $scope.headerIndex = headerIndex;

	        var type;

	        switch(headerIndex) {
	            case 0:
	                type='number';
	                break;
	            case 1:
	                type='main';
	                break;
	            case 2:
	                type='bonus';
	                break;
	            case 3:
	                type='number_total';
	                break;
	            default:
	                type='number';
	                break
	            }

	        if (type == sortType) {
	            sortAscending = !sortAscending;
	        } else if (type == 'number') {
	            sortAscending = true;
	        } else {
	            sortAscending = false;
	        }
	        sortType = type;
          $scope.ballStats.sort(sortBy('main', sortAscending, parseInt));
	        $scope.ballStats.sort(sortBy(type, sortAscending, parseInt));
	    };

	    sortBy = function(field, ascending, primer){
	       var key = primer ?
	           function(x) {return primer(x[field])} :
	           function(x) {return x[field]};

	       ascending = !ascending ? -1 : 1;

	       return function (a, b) {
	           return a = key(a), b = key(b), ascending * ((a > b) - (b > a));
	         }
	    }

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILHowToPlayController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Irish Lotto Bet - How to Play");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.il.how_to_play.length>0){
 				$.each(json.body.il.how_to_play, function(i,obj) {
					try{
						if(json.body.il.how_to_play.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0) {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:95px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();
						}else if(this.url!=null && this.url.length > 0){
	 						$(".carousel-inner").append('<div class="item"><a href="'+this.url+'"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></a></div>');
						}else{
							$(".carousel-inner").append('<div class="item"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></div>');
						}
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}


        $scope.navigationClickFn = function(navigationOption) {
            location.href = 'irishlotto%2F' + navigationOption;
        };

        $scope.ballAmounts = [
            { label: '1 Number Matched', value: 1 },
            { label: '2 Numbers Matched', value: 2 },
            { label: '3 Numbers Matched', value: 3 },
            { label: '4 Numbers Matched', value: 4 },
            { label: '5 Numbers Matched', value: 5 }

        ];

        $scope.sixWinningAmounts = [7, 54, 601, 7200, 125000];
        $scope.sevenWinningAmounts = [6, 39, 330, 3800, 40000];


        $scope.stakeOptions = {
            stake:"1.00",
            numBalls:$scope.ballAmounts[0]
        };


        $scope.update = function(stakeOptions) {
            $scope.stakeOptions.stake = parseFloat($scope.stakeOptions.stake).toFixed(2);
            if ($scope.stakeOptions.stake < 0.5 || isNaN(parseFloat($scope.stakeOptions.stake))) {
                $scope.stakeOptions.stake = "0.50";
            } else if ($scope.stakeOptions.stake > 10000000) {
              $scope.stakeOptions.stake = "10000000.00";
            }

            var winningsIndex = $scope.stakeOptions.numBalls.value-1;

            var sixWinningsCalc= numeral($scope.sixWinningAmounts[winningsIndex] * $scope.stakeOptions.stake).format('0,0.00');
            var sixWinningsFloat = parseFloat(sixWinningsCalc.replace(/[,]/g, ''));
            if(sixWinningsFloat > 1000000.00){
            	sixWinningsCalc='1,000,000.00';
            }
            $scope.sixWinnings = sixWinningsCalc;
            
            
            var sevenWinningsCalc=numeral($scope.sevenWinningAmounts[winningsIndex] * $scope.stakeOptions.stake).format('0,0.00');
            var sevenWinningsFloat = parseFloat(sevenWinningsCalc.replace(/[,]/g, ''));
            if(sevenWinningsFloat > 1000000.00){
            	sevenWinningsCalc = '1,000,000.00';
            }
            $scope.sevenWinnings = sevenWinningsCalc;
            
        
        
        
        
        };

        $scope.update($scope.stakeOptions);



        $scope.videoSrc = "../media/ILB_htp@720x576.mp4";
        $scope.thumbSrc = "../media/ILB_htp_thumb.png";

        /*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILLuckyDipController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Irish Lotto Bet - Lucky Dip");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.il.lucky_dip.length>0){
 				$.each(json.body.il.lucky_dip, function(i,obj) {
 					var slide='';
					try{
						if(json.body.il.lucky_dip.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILMenuController', [
    '$scope','$location',
    function($scope,$location) {

	$scope.navigationOptions = [
            {
                id: "",
                cls: "fn-il-menu-button-latest",
                txt: "LATEST RESULTS"
            },
            {
                id: "previous",
                cls: "fn-il-menu-button-previous",
                txt: "PREVIOUS RESULTS"
            },
            {
                id: "lucky-dip",
                cls: "fn-il-menu-button-lucky",
                txt: "LUCKY DIP"
            },
            {
                id: "syndicates",
                cls: "fn-il-menu-button-syndicates",
                txt: "SYNDICATES"
            },
            {
                id: "how-to-play",
                cls: "fn-il-menu-button-how",
                txt: "HOW TO PLAY"
            }
        ];

        $scope.isActive = function (viewLocation) {
            if (viewLocation === "/irishlottobet/" && $location.path() === "/irishlottobet") {
                return true;
            } else if (viewLocation === "/irishlottobet/how-to-play" && $location.path() === "/irishlottobet/rules") {
                return true;
            } else if (viewLocation === "/irishlottobet/" && $location.path() === "/irishlottobet/hot-cold") {
                return true;
            }
            return viewLocation === $location.path();
        };



        // $scope.menuShown = false;
        //
        // $scope.menuToggleFn = function() {
        //     $scope.menuShown = !$scope.menuShown;
        //     $scope.menuDisplay = $scope.menuShown === true ? {'display':'block'} : {};
        // };

        $scope.bannerURL = function() {
          return "../../img/bg/bg_cold.png";
        };

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILResultsController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Irish Lotto Bet - Previous Results");
      var ajaxRequest;
      var draw1 = {};
      var draw2 = {};
      var draw3 = {};

      $scope.draw1Visible = false;
      $scope.draw2Visible = false;
      $scope.draw3Visible = false;

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.il.previous.length>0){
 				$.each(json.body.il.previous, function(i,obj) {
 					var slide='';
					try{
						if(json.body.il.previous.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="ILB Previous results" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

		/* Previous results slider */
		$(document).ready(function(){

			var currentDate = new Date();

			var currentDay = ("0" + currentDate.getDate()).slice(-2);
			var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
			var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

			var firstDay="01";
			var firstMonth="01";
			var firstYear="1998";

			var firstDate = $scope.dateStringFromComponents(firstYear, firstMonth, firstDay);
			var selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
			var currentDate = $scope.dateStringFromComponents(currentYear, currentMonth, currentDay);


		function getLotteryDataILB(){
        if (ajaxRequest) {
          ajaxRequest.abort();
        }

        ajaxRequest = $.ajax({
					url: $scope.baseURL+'/games/get_previous',
					type: 'post',
                                        contentType: "application/json; charset=utf-8",
					dataType: 'json',
					data:  JSON.stringify({"game":"il","date": selectedDate}),
					beforeSend: function() {
						$( ".no-results-for-date" ).remove();
						$('#main-spinner').css( "display","inline-block" );
						$('.resoults-middle-container').css( "display","none" );
					},
					complete: function() {
					},
					success: function(json) {
						$( ".no-results-for-date" ).remove();
						
					// alert(JSON.stringify(json.body[0].results));
						
						if (jQuery.isEmptyObject(json.body) || (json.body[0] != 'undefined' && json.body[0].results.numbers==null )){
							 
							$('#main-spinner').css( "display","none" );
							$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");
						}else{
							$('#main-spinner').css( "display","none" );
							$('.resoults-middle-container').css( "display","inline-block" );

							$('#main_draw').html('');
							$('#second_draw').html('');
							$('#third_draw').html('');
							$('.resoults-ball-draw:nth-child(2)').css('display','none');
							$('.resoults-ball-draw:nth-child(3)').css('display','none');
							$('.resoults-ball-draw:nth-child(4)').css('display','none');
							$('#ilb-next-event').css( "display","none" );
							draw1 = {};
							draw2 = {};
							draw3 = {};




							if (json.body[0] && (json.body[0].results).length==0 ){
								$('#ilb-next-event').css( "display","block" );
				                $('#ilb-next-event-time').html( json.body[0].draw_time );
							}else{
								$('.resoults-ball-draw:nth-child(2)').css('display','inline-block');
								try{
									if((json.body[0].draw_time).indexOf(':') === -1)
									{}else{
										$('#main_draw').html(json.body[0].draw_time);
									}
								}catch (e) {}
								draw1.numbers = json.body[0].results.numbers;
								draw1.sortedNumbers = json.body[0].results.numbers.concat().sort($scope.sortNumber);
								draw1.booster =  json.body[0].results.booster;
								$scope.draw1Visible = json.body[0].status == 0 ? false : true;
								showDraw(draw1.sortedNumbers, draw1.booster, "mb");
							}

							if (jQuery.isEmptyObject(json.body[1])){
							}else{
								$('.resoults-ball-draw:nth-child(3)').css('display','inline-block');
								try{
									if((json.body[1].draw_time).indexOf(':') === -1)
									{}else{
										$('#second_draw').html(json.body[1].draw_time);
									}
								}catch (e) {}
								draw2.numbers = json.body[1].results.numbers;
								draw2.sortedNumbers = json.body[1].results.numbers.concat().sort($scope.sortNumber);
								draw2.booster =  json.body[1].results.booster;
								$scope.draw2Visible = json.body[1].status == 0 ? false : true;
								showDraw(draw2.sortedNumbers, draw2.booster, "sb");
							}

							if (jQuery.isEmptyObject(json.body[2])){
							}else{
								$('.resoults-ball-draw:nth-child(4)').css('display','inline-block');
								try{
									if((json.body[2].draw_time).indexOf(':') === -1)
									{}else{
										$('#third_draw').html(json.body[2].draw_time);
									}
								}catch (e) {}
								draw3.numbers = json.body[2].results.numbers;
								draw3.sortedNumbers = json.body[2].results.numbers.concat().sort($scope.sortNumber);
								draw3.booster =  json.body[2].results.booster;
								$scope.draw3Visible = json.body[2].status == 0 ? false : true;
								showDraw(draw3.sortedNumbers, draw3.booster, "tb");
							}

							$scope.$apply();


						}



			    		number_1 = $('#check_nb_1').val();
			    		number_2 = $('#check_nb_2').val();
			    		number_3 = $('#check_nb_3').val();
			    		number_4 = $('#check_nb_4').val();
			    		number_5 = $('#check_nb_5').val();

						$( ".ball-selected" ).remove();
			    		$( ".fn-ball-nb-"+number_1 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_2 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_3 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_4 ).before( "<div class='ball-selected'></div>" );
			    		$( ".fn-ball-nb-"+number_5 ).before( "<div class='ball-selected'></div>" );
			    		checkNumbers();
					},
					error: function(){
						//// alert('Connection error! Please try again.');
					}
				});
			}

		$scope.drawSorted = true;
		$scope.toggleDrawOrder = function() {


        $scope.drawSorted = !$scope.drawSorted;
        if ($scope.drawSorted) {

          showDraw(draw1.sortedNumbers, draw1.booster, "mb");
          showDraw(draw2.sortedNumbers, draw2.booster, "sb");
          showDraw(draw3.sortedNumbers, draw3.booster, "tb");
        } else {
          showDraw(draw1.numbers, draw1.booster, "mb");
          showDraw(draw2.numbers, draw2.booster, "sb");
          showDraw(draw3.numbers, draw3.booster, "tb");
        }
        checkNumbers();
      };


      function showDraw (numbers, booster, idPrefix) {

          for (var i in numbers) {
            if(numbers[i]){
              var num = parseInt(i)+1;
              $("#"+idPrefix+""+num).html(numbers[i]);
              $("#"+idPrefix+""+num).removeClass();
              $("#"+idPrefix+""+num).addClass('fn-ball-green');
              $("#"+idPrefix+""+num).addClass('fn-ball-nb-'+numbers[i]);
            }
          }

          if(booster){
            $("#"+idPrefix+""+"b").html(booster);
            $("#"+idPrefix+""+"b").removeClass();
            $("#"+idPrefix+""+"b").addClass('fn-ball-green');
            $("#"+idPrefix+""+"b").addClass('fn-ball-nb-'+booster);
          }

      }

			function populateSelectBoxes(){
				//populate months select box and set current month
				$('#month option:eq('+(selectedMonth-1)+')').prop('selected', true);
				//populate years select box and set last as selected
				var yearsArray = new Array();
				for (i=0;(currentYear-i)>=firstYear;i++){
					yearsArray[i]=currentYear-i;
				}
				$("#year").empty();
				$.each(yearsArray, function(val, text) {
		            $('#year').append(
		                $('<option></option>').val(text).html(text)
		            );
				});
				$('#year option[value="'+selectedYear+'"]').prop('selected', true);
			}

			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}

			function disableSelectBoxesOptions(){
				if($( "#year" ).val() == currentYear){
					if(currentMonth<1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(currentMonth<2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(currentMonth<3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(currentMonth<4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(currentMonth<5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(currentMonth<6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(currentMonth<7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(currentMonth<8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(currentMonth<9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(currentMonth<10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(currentMonth<11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(currentMonth<12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else if ($( "#year" ).val() == firstYear){
					if(firstMonth>1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(firstMonth>2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(firstMonth>3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(firstMonth>4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(firstMonth>5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(firstMonth>6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(firstMonth>7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(firstMonth>8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(firstMonth>9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(firstMonth>10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(firstMonth>11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(firstMonth>12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else{
					$("#month option[value='1']").removeAttr('disabled');
					$("#month option[value='2']").removeAttr('disabled');
					$("#month option[value='3']").removeAttr('disabled');
					$("#month option[value='4']").removeAttr('disabled');
					$("#month option[value='5']").removeAttr('disabled');
					$("#month option[value='6']").removeAttr('disabled');
					$("#month option[value='7']").removeAttr('disabled');
					$("#month option[value='8']").removeAttr('disabled');
					$("#month option[value='9']").removeAttr('disabled');
					$("#month option[value='10']").removeAttr('disabled');
					$("#month option[value='11']").removeAttr('disabled');
					$("#month option[value='12']").removeAttr('disabled');
				}

        if ($( "#month" ).val() < parseInt(firstMonth)){
          $("#year option[value='"+firstYear+"']").attr('disabled','disabled');
        } else {
          $("#year option[value='"+firstYear+"']").removeAttr('disabled');
        }
			}

			function setMonthlySwitchers(){
				var previousMonths = new Array();
				previousMonths[1]='December';
				previousMonths[2]='January';
				previousMonths[3]='February';
				previousMonths[4]='March';
				previousMonths[5]='April';
				previousMonths[6]='May';
				previousMonths[7]='June';
				previousMonths[8]='July';
				previousMonths[9]='August';
				previousMonths[10]='September';
				previousMonths[11]='October';
				previousMonths[12]='November';
				previousMonthText=previousMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==1){
            		previousMonthText+=$( "#year" ).val()-1;
            	}else{
            		previousMonthText+=$( "#year" ).val();
            	}
            	$('#previous-month-switch').html(previousMonthText);

				var nextMonths = new Array();
				nextMonths[1]='February';
				nextMonths[2]='March';
				nextMonths[3]='April';
				nextMonths[4]='May';
				nextMonths[5]='June';
				nextMonths[6]='July';
				nextMonths[7]='August';
				nextMonths[8]='September';
				nextMonths[9]='October';
				nextMonths[10]='November';
				nextMonths[11]='December';
				nextMonths[12]='January';

				nextMonthText=nextMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==12){
            		nextMonthText+=(parseInt($( "#year" ).val())+1);
            	}else{
            		nextMonthText+=$( "#year" ).val();
            	}
            	$('#next-month-switch').html(nextMonthText);
            	//disable next month button
            	if(selectedYear == currentYear && selectedMonth >= currentMonth){
            		$('#nextMonthClick').css( "display","none" );
            	}else{
					$('#nextMonthClick').css( "display","inline-block" );
            	}
            	//disable previous month button
            	if(selectedYear == firstYear && selectedMonth <= firstMonth){
            		$('#prevMonthClick').css( "display","none" );
            	}else{
					$('#prevMonthClick').css( "display","inline-block" );
            	}
			}
			function scrollToSelectedPosition(){
				var selectedElement=$( ".days-controls-selected" );
				var position = selectedElement.position();
				//$( "#days-list-ilb" ).animate({left: -position.left}, 500, function() { });
				$( "#days-list-ilb" ).css("left", -position.left);
			}





			function setDaysSlider(){
				$("#days-list-ilb").empty();

				//selected main element
				if(new Date(selectedDate) >= new Date(firstDate) &&  new Date(selectedDate) <= new Date(currentDate) ){
					$("#days-list-ilb").append('<li class="days-controls-selected"><a href="#" class="dayselect-ilb" data-position="0"  data-date="'+selectedDate+'">'+$scope.getShortDayName(selectedDate)+'<br><span class="dayNum">'+$scope.getDayNumber(selectedDate)+'</span></a></li>');
				}
				//prepened options
				daybefore = $scope.getDateBeforeDate(selectedDate);

				if(new Date(daybefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-1"  data-date="'+daybefore+'">'+$scope.getShortDayName(daybefore)+'<br><span class="dayNum">'+$scope.getDayNumber(daybefore)+'</span></a></li>');
				}

				twodaysbefore = $scope.getDateBeforeDate(daybefore);
				if(new Date(twodaysbefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-3"  data-date="'+twodaysbefore+'">'+$scope.getShortDayName(twodaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysbefore)+'</span></a></li>');
				}

				threedaysbefore = $scope.getDateBeforeDate(twodaysbefore);
				if(new Date(threedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-4"  data-date="'+threedaysbefore+'">'+$scope.getShortDayName(threedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysbefore)+'</span></a></li>');
				}

				fourdaysbefore = $scope.getDateBeforeDate(threedaysbefore);
				if(new Date(fourdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-5"  data-date="'+fourdaysbefore+'">'+$scope.getShortDayName(fourdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysbefore)+'</span></a></li>');
				}

				fivedaysbefore = $scope.getDateBeforeDate(fourdaysbefore);
				if(new Date(fivedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-6"  data-date="'+fivedaysbefore+'">'+$scope.getShortDayName(fivedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysbefore)+'</span></a></li>');
				}

				sixdaysbefore = $scope.getDateBeforeDate(fivedaysbefore);
				if(new Date(sixdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-7"  data-date="'+sixdaysbefore+'">'+$scope.getShortDayName(sixdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysbefore)+'</span></a></li>');
				}

				sevendaysbefore = $scope.getDateBeforeDate(sixdaysbefore);
				if(new Date(sevendaysbefore) >= new Date(firstDate)  ){
					$("#days-list-ilb").prepend('<li><a href="#" class="dayselect-ilb" data-position="-8"  data-date="'+sevendaysbefore+'">'+$scope.getShortDayName(sevendaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysbefore)+'</span></a></li>');
				}

				//appended options
				dayafter = $scope.getDateAfterDate(selectedDate);
				if(new Date(dayafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="1"  data-date="'+dayafter+'">'+$scope.getShortDayName(dayafter)+'<br><span class="dayNum">'+$scope.getDayNumber(dayafter)+'</span></a></li>');
				}

				twodaysafter = $scope.getDateAfterDate(dayafter);
				if(new Date(twodaysafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="2"  data-date="'+twodaysafter+'">'+$scope.getShortDayName(twodaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysafter)+'</span></a></li>');
				}

				threedaysafter = $scope.getDateAfterDate(twodaysafter);
				if(new Date(threedaysafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="3"  data-date="'+threedaysafter+'">'+$scope.getShortDayName(threedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysafter)+'</span></a></li>');
				}

				fourdaysafter = $scope.getDateAfterDate(threedaysafter);
				if(new Date(fourdaysafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="4"  data-date="'+fourdaysafter+'">'+$scope.getShortDayName(fourdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysafter)+'</span></a></li>');
				}

				fivedaysafter = $scope.getDateAfterDate(fourdaysafter);
				if(new Date(fivedaysafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="5"  data-date="'+fivedaysafter+'">'+$scope.getShortDayName(fivedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysafter)+'</span></a></li>');
				}

				sixdaysafter = $scope.getDateAfterDate(fivedaysafter);
				if(new Date(sixdaysafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="6"  data-date="'+sixdaysafter+'">'+$scope.getShortDayName(sixdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysafter)+'</span></a></li>');
				}

				sevendaysafter = $scope.getDateAfterDate(sixdaysafter);
				if(new Date(sevendaysafter) <= new Date(currentDate)  ){
					$("#days-list-ilb").append('<li><a href="#" class="dayselect-ilb" data-position="7"  data-date="'+sevendaysafter+'">'+$scope.getShortDayName(sevendaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysafter)+'</span></a></li>');
				}

				scrollToSelectedPosition();
				populateSelectBoxes();
				disableSelectBoxesOptions();
				setMonthlySwitchers();
				updateDaySwitchers();
				getLotteryDataILB();
			}

			//initiate everything
			//populateSelectBoxes();
			setDaysSlider();

			$( "#month" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			$( "#year" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
				selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on day selector click
			$('#days-list-ilb').on('click', ' a.dayselect-ilb', function(event) {

				event.preventDefault();
				dateArray=this.getAttribute("data-date").split("-");
				selectedDay = dateArray[2];
				selectedMonth = dateArray[1];
				selectedYear = dateArray[0];
				selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
				setDaysSlider();

			});

			$("#prevMonthClick").click(function(event){
			    event.preventDefault();

				//set year
				selectedYear=$( "#year" ).val();
				//set month

				selectedMonth = $( "#month" ).val()-1;
				//switch to previous year
				if(selectedMonth==0){
					selectedMonth = 12;
					selectedYear = selectedYear-1;
				}
				if(selectedYear == firstYear && selectedMonth < firstMonth){
					selectedMonth = firstMonth;
				}
				//set day
				if(selectedYear == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();

			});

			$("#nextMonthClick").click(function(event){
			    event.preventDefault();
				//set year
				selectedYear=$( "#year" ).val();
				//set month

				selectedMonth = parseInt($( "#month" ).val())+1;

				//switch to previous year
				if(selectedMonth==13){
					selectedMonth = 1;
					selectedYear = parseInt(selectedYear)+1;
				}
				if(selectedYear == currentYear && selectedMonth > currentMonth){
					selectedMonth = currentMonth;
				}
				//set day
				if(selectedYear == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dateAfterArray=dateAfter.split("-");

				if(new Date(dateAfter) > new Date(currentDate)  ){
				}else{
					selectedDay = dateAfterArray[2];
					selectedMonth = dateAfterArray[1];
					selectedYear = dateAfterArray[0] ;

					selectedDate = dateAfter;
				}
				setDaysSlider();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();

				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dateBeforeArray=dateBefore.split("-");
				if(new Date(dateBefore) < new Date(firstDate)  ){

				}else{
					selectedDay = dateBeforeArray[2];
					selectedMonth = dateBeforeArray[1];
					selectedYear = dateBeforeArray[0] ;

					selectedDate = dateBefore;
				}
				setDaysSlider();
			});
		});

    	$scope.clearNumbers = function(name) {
    		$( ".fn-ball-wrapper" ).css({"opacity":"1"});
    		$scope.check_number_1='';
    		$scope.check_number_2='';
    		$scope.check_number_3='';
    		$scope.check_number_4='';
    		$scope.check_number_5='';
    	}

      function validateNumber(number) {

        var int = parseInt(number);
        if (int > 0 && int <= 47) {
          return int;
        }
        return '';
      }


    	function checkNumbers(){

        $scope.check_number_1 =	validateNumber($scope.check_number_1);
        $scope.check_number_2 =	validateNumber($scope.check_number_2);
        $scope.check_number_3 =	validateNumber($scope.check_number_3);
        $scope.check_number_4 =	validateNumber($scope.check_number_4);
        $scope.check_number_5 =	validateNumber($scope.check_number_5);

    		number_1 =	$scope.check_number_1;
    		number_2 =	$scope.check_number_2;
    		number_3 =	$scope.check_number_3;
    		number_4 =	$scope.check_number_4;
    		number_5 =	$scope.check_number_5;

        if (clearNumbersEnabled()) {
        	$( ".fn-ball-wrapper" ).css({"opacity":"0.3"});
        	$( "#clear_num_btn" ).css({"opacity":"1"});
        } else {
        	$( "#clear_num_btn" ).css({"opacity":"0.5"});
        }

    		$( ".ball-selected" ).remove();
    		$( ".fn-ball-nb-"+number_1 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_1 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_2 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_2 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_3 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_3 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_4 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_4 ).parent().parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_5 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_5 ).parent().parent().css({"opacity":"1.0"});
    	}

      function clearNumbersEnabled() {
        if ($scope.check_number_1 > 0
          || $scope.check_number_2 > 0
          || $scope.check_number_3 > 0
          || $scope.check_number_4 > 0
          || $scope.check_number_5 > 0) {
            return true;
          }
          return false;
      };

    	$scope.$watch('check_number_1', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_2', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_3', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_4', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_5', function() { checkNumbers(); }, true);

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILRulesController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Irish Lotto Bet - Rules");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.il.rules.length>0){
 				$.each(json.body.il.rules, function(i,obj) {
 					var slide='';
					try{
						if(json.body.il.rules.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNILSyndicatesController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Irish Lotto Bet - Syndicates");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.il.syndicates.length>0){
 				$.each(json.body.il.syndicates, function(i,obj) {
 					var slide='';
					try{
						if(json.body.il.syndicates.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNRapidoHomeController', [
     '$scope','$http','$timeout',
     function($scope, $http, $timeout) {

       $scope.setTitle("Rapido - Latest Results");
       var ajaxRequest;
       var results = [];

       $scope.showShare = false;

       var selectedResultIndex = 0;
       var shareText;
       var resultHeadings = [];
       var number_of_draws=0;

       function updateShareResults() {
         $('#share-tw').html('');
         $('#share-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$scope.location.absUrl()+'" data-text="'+resultsShareText()+'" data-size="large" data-count="none">Tweet</a>');
         if ('twttr' in window && window['twttr'] !== null) {
           twttr.widgets.load();
         }

         $('#share-mail').html('');
         $('#share-mail').html('<a href="mailto:%20?subject=49s Website&body='+mailShareText()+'"><img src="../../img/icons/ic_email.png"></a>');

         $scope.showShare = true;
         $scope.$apply();
       }

         /* load hero images */
 		$.ajax({
 			url: $scope.baseURL+'/img/get_image_urls',
 			type: 'post',
 			dataType: 'json',
 			beforeSend: function() {
 			},
 			complete: function() {
 			},
 			success: handleSliderData,
 			error: function(){
 				// alert('Connection error! Please try again.');
 			}
 		});
 		function handleSliderData(json) {
 			if(json.body.rapido.latest.length>0){
 				$.each(json.body.rapido.latest, function(i,obj) {
 					var slide='';
					try{
						if(json.body.rapido.latest.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0 && this.url=='') {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:100px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();}
							else{
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
							}
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
			//add promo images
			if(json.body.promo.is_promo_rapido_latest.length>0){
		        var banner='';
				$.each(json.body.promo.is_promo_rapido_latest, function(i,obj) {
					try{
						banner='<div class="fn-promo-section">';
						if(obj.url!=''){
							banner+='<a href="'+obj.url+'">';
						}else{
							banner+='<a href="#">';
						}
						banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
						}
						banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
					}catch(e){}
					 $(".fn-promo-container").append(banner);
				});
			}
 		}
 		/* latest results slider */
 		$(document).ready(function(){
 			var findLatestFlag=0;
 			var currentDate = new Date();

 			var currentDay = ("0" + currentDate.getDate()).slice(-2);
       		var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
       		var currentYear = currentDate.getFullYear();

 			var selectedDay = currentDay;
 			var selectedMonth = currentMonth;
 			var selectedYear = currentYear;

 			var firstDay="05";
 			var firstMonth="05";
 			var firstYear="1996";

 			var firstDate = firstYear+'-'+firstMonth+'-'+firstDay;
 			var selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
 			var currentDate = currentYear+'-'+currentMonth+'-'+currentDay;

 			function getBallColor(num){
 				var colors = '';
 				if (num>40){
 					colors='black';
 				}else{
 					colors='red';
 				}
 		        return colors;
 			}
 			function updateDaySwitchers(){
 				if(new Date(selectedDate) <= new Date(firstDate)  ){
 					$('#previous-day').css( "display","none" );
 				}else{
 					$('#previous-day').css( "display","inline-block" );
 				}

 				if(new Date(selectedDate) >= new Date(currentDate)  ){
 					$('#next-day').css( "display","none" );
 				}else{
 					$('#next-day').css( "display","inline-block" );
 				}

 				//update text on day switchers
 				dateBefore=$scope.getDateBeforeDate(selectedDate);
 				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
 				dayNumber = $scope.getDayNumber(dateBefore);
 				dayEnd = $scope.ordinalForDayNumber(dayNumber);
 				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

 				dateAfter=$scope.getDateAfterDate(selectedDate);
 				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
 				dayNumber = $scope.getDayNumber(dateAfter);
 				dayEnd = $scope.ordinalForDayNumber(dayNumber);
 				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
 			}


       function getHotCold() {
          $.ajax({
              url: $scope.baseURL+'/games/get_hot_cold_balls',
              type: 'post',
                                        contentType: "application/json; charset=utf-8",
              dataType: 'json',
              data:  JSON.stringify({"game_type":"ra"}),
              beforeSend: function() {

              },
              complete: function() {
                //alert('complete');
              },
              success: handleHotCold,
              error: function(){
                alert('error');
              }
            });

        };


        function handleHotCold(json) {

          if (jQuery.isEmptyObject(json.body)){

          } else {

            $scope.hotBalls = json.body.hot;
            $scope.coldBalls = json.body.cold;
            $scope.$apply();

          }


        };


 			function getLotteryData(selectedDate){

         if(!$scope.$$phase) {
           $scope.$apply(function() {
             $scope.showShare = false;
           });
         } else {
           $scope.showShare = false;
         }

         if (ajaxRequest) {
           ajaxRequest.abort();
         }
         ajaxRequest = $.ajax({
 					url: $scope.baseURL+'/games/get_previous',
 					type: 'post',
                                        contentType: "application/json; charset=utf-8",
 					dataType: 'json',
 					data:  JSON.stringify({"game":"ra","date": selectedDate}),
 					beforeSend: function() {
 						$( ".no-results-for-date" ).remove();
 						$('#main-spinner').css( "display","inline-block" );
 						$('.resoults-middle-container').css( "display","none" );
 						$(".resoults-ball-draw").removeClass("active");
 					},
 					complete: function() {
 						//alert('complete');
 					},
 					success: handleData,
 					error: function(){
 						console.log('error');
 					}
 				});
 			}

 			function handleData(json) {
 				if (jQuery.isEmptyObject(json.body)){
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");
           $scope.showShare = false;
           $scope.$apply();
 					//if no results try to get results from previous date
 					if(findLatestFlag==0){
 						selectedDate=$scope.getDateBeforeDate(selectedDate);
 						getLotteryData(selectedDate);
             $('#activeDate').html('');
             $('#previous-day').css( "display","none" );
             $('#next-day').css( "display","none" );
 					}
           results = [];
           resultHeadings = [];
 				}else{
 					findLatestFlag=1;
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('.resoults-middle-container').css( "display","inline-block" );

 					var results_title='HEADS WINS';
 					var heads_count=0;
 					var tails_count=0;
 					var mark_first_selected='';
 					$("#draw-list li").remove();
 					number_of_draws=json.body.length;

 					$(".resoults-ball-draw").removeClass("active");

 					for(x=0;x<json.body.length;x++){
 						//populate draw pagination
 					
 						$("#draw-list").append('<li><span class="pagination-item" style="padding:10px 18px 10px 18px;color:white;"  data-toggle="tab" href="#draw_pagination_'+(x+1)+'" result-index="'+x+'">Draw '+(x+1)+'</span></li>');



 					 

            if (json.body[x].status) {
 						       $(".fn-draw-order").after( '<div class="resoults-ball-draw tab-pane fade in "  id="draw_pagination_'+(x+1)+'">'+
                        '<div class="fn-6-balls">'+
                        '	<div class="resoults-row">'+
	                    '		<div class="draw-title">'+
	                    '			<div class="condensed-bold fn-results-heading" style="color:white;">'+
	                    '        		DRAW '+(x+1)+' - <span class="fn-accent-text" id="draw_'+(x+1)+'"></span>'+
	                    '    		</div>'+
	                    '		</div>'+
	                    '		<div class="draw-results results_bg_'+(x+1)+'">'+
	                    '			<div class="heads-results heads_'+(x+1)+'"></div>'+
	                    '			<div class="results-table results_'+(x+1)+'"></div>'+
	                    '			<div class="tails-results tails_'+(x+1)+'"></div>'+
	                    '		</div>'+
	                    '	</div>'+
                        ' 	<div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_1"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_2"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_3"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_4"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_5"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_6"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_7"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_8"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_9"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_10"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_11"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_12"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_13"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_14"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_15"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_16"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_17"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_18"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_19"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_20"></div></div>'+
                        '</div>'+
                    '</div>');
                  } else {
                     $(".fn-draw-order").after( '<div class="resoults-ball-draw tab-pane fade in "  id="draw_pagination_'+(x+1)+'">'+
                               '			<div class="condensed-bold fn-results-heading fn-results-heading-none" style="color:white;">'+
                               '        		DRAW '+(x+1)+' - <span class="fn-accent-text" id="draw_'+(x+1)+'"></span>'+
                               '    		</div>'+
                               '<div class="no-results-for-draw"><h1>No Results Available</h1></div>'+
                             '</div>');
                   }










 	 					if (jQuery.isEmptyObject(json.body[x])){
 	 					}else{

 	 						try{
 	 							if((json.body[x].draw_time).indexOf(':') === -1)
 	 	 						{
 	 	 						  //alert("no dash found.");
 	 	 						}else{
 	 	 							$('#draw_'+(x+1)).html(json.body[x].draw_time);
 	 	 						}
 	 						}catch (e) {

 	 						}


				              results = json.body;
				              for (var i in results) {
				                var resultData = results[i];
				                resultData.results.sortedNumbers = resultData.results.numbers.concat().sort($scope.sortNumber);
				              }
				              showResults(x);

 	 					}
 					}


 					//set current last race active
 					$('.resoults-middle-container div').first().addClass("active");
					$('.resoults-middle-container div:last-child ul li:last-child').addClass("active");
					

 					updateDaySwitchers();
    				updateTitleDate();
    				formatShareText();
 				}


 				//$('.resoults-middle-container').html( JSON.stringify(json) );
 				//$('.resoults-middle-container').css( 'color','white');

 			}

       $scope.drawSorted = true;
       $scope.toggleDrawOrder = function() {
         $scope.drawSorted = !$scope.drawSorted;
         for(var x=0;x<number_of_draws;x++){
           showResults(x);
         }
       };


       function showResults(index) {

            heads_count=0;
            tails_count=0;
            if ($scope.drawSorted) {
             for (y=0;y<20;y++){
                if(results[index].results.sortedNumbers[y]){
                  $("#d_"+(index+1)+"_"+(y+1)).html(results[index].results.sortedNumbers[y]);
                  color=getBallColor(results[index].results.sortedNumbers[y]);
                  $("#d_"+(index+1)+"_"+(y+1)).removeClass();
                  $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-coin-'+color);
                  $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-ball-nb-'+results[index].results.sortedNumbers[y]);
                  if(results[index].results.sortedNumbers[y]>40){
                    tails_count=tails_count+1;
                  }else{
                    heads_count=heads_count+1;
                  }
                }
              }
            } else {
              for (y=0;y<20;y++){
                 if(results[index].results.numbers[y]){
                   $("#d_"+(index+1)+"_"+(y+1)).html(results[index].results.numbers[y]);
                   color=getBallColor(results[index].results.numbers[y]);
                   $("#d_"+(index+1)+"_"+(y+1)).removeClass();
                   $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-coin-'+color);
                   $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-ball-nb-'+results[index].results.numbers[y]);
                   if(results[index].results.numbers[y]>40){
                     tails_count=tails_count+1;
                   }else{
                     heads_count=heads_count+1;
                   }
                 }
               }
            }
         $('.heads_'+(index+1)).html(heads_count);
         if(heads_count>tails_count){
           resultHeadings.push('HEADS WINS');
           $('.results_'+(index+1)).html('HEADS WINS');
           $('.results_bg_'+(index+1)).css('background','url("../../img/bg/results-red.png")');
         }else if(heads_count<tails_count){
           resultHeadings.push('TAILS WINS');
           $('.results_'+(index+1)).html('TAILS WINS');
           $('.results_bg_'+(index+1)).css('background','url("../../img/bg/results-black.png")');
         }else{
           resultHeadings.push('LEVEL');
           $('.results_'+(index+1)).html('LEVEL');
           $('.results_bg_'+(index+1)).css('background','url("../../img/bg/results-black-red.png")');
         }

         $('.tails_'+(index+1)).html(tails_count);
       }

 			function updateTitleDate() {
 				dayNumber = $scope.getDayNumber(selectedDate);
         dayEnd = $scope.ordinalForDayNumber(dayNumber).toUpperCase();

 				var d = new Date(selectedDate);
 				var month = new Array();
        month[0] = "JANUARY";
 				month[1] = "FEBRUARY";
 				month[2] = "MARCH";
 				month[3] = "APRIL";
 				month[4] = "MAY";
 				month[5] = "JUNE";
 				month[6] = "JULY";
 				month[7] = "AUGUST";
 				month[8] = "SEPTEMBER";
 				month[9] = "OCTOBER";
 				month[10] = "NOVEMBER";
 				month[11] = "DECEMBER";
 				var monthName = month[d.getMonth()];

 			// 	$('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+dayEnd+' '+monthName+' '+d.getFullYear());
       $('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+'<sup>'+dayEnd.toLowerCase()+'</sup> '+monthName+' '+d.getFullYear());
 			}

 			//initiate everything
       getHotCold();
 			getLotteryData(selectedDate);
 			updateDaySwitchers();
 			updateTitleDate();
 			//on previous day click
 			$( "#next-day" ).click(function( event ) {
 				event.preventDefault();
 				selectedDate=$scope.getDateAfterDate(selectedDate);
 				getLotteryData(selectedDate);
 				updateDaySwitchers();
 				updateTitleDate();
 			});
 			//on next day click
 			$( "#previous-day" ).click(function( event ) {
 				event.preventDefault();
 				selectedDate=$scope.getDateBeforeDate(selectedDate);
 				getLotteryData(selectedDate);
 				updateDaySwitchers();
 				updateTitleDate();
 			});
 		});



     $(document).on('click','.rapido-home-pagination span[data-toggle="tab"]',function(e){

       selectedResultIndex =  $(e.currentTarget).attr("result-index");
       console.log(selectedResultIndex);

       formatShareText();

     });



     function formatShareText() {
       var resultText = "Rapido Results: ";
       var result = results[selectedResultIndex];
       var drawNum = parseInt(selectedResultIndex)+1;
       resultText += "Draw "+drawNum+": ";
       resultText +=  resultHeadings[selectedResultIndex]+" ";

       var length = result.results.sortedNumbers.length
       for (var i=0; i<length; i++) {
         var num = result.results.sortedNumbers[i];
         resultText += num;
         if (i < length - 1) {
          resultText += ",";
         }
       }


       shareText = resultText;

       updateShareResults();

     }



      function resultsShareText() {
        return shareText;
      }

      function mailShareText() {
        var resultText = resultsShareText();
        return resultText + '%0D%0A' + $scope.location.absUrl();
      }


/*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		}); 

     }]
 );

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNRapidoHowToPlayController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Rapido - How to Play");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.rapido.how_to_play.length>0){
 				$.each(json.body.rapido.how_to_play, function(i,obj) {
					try{
						if(json.body.rapido.how_to_play.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
            if(this.video_url != null && this.video_url.length > 0) {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:95px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();
						}else if(this.url!=null && this.url.length > 0){
	 						$(".carousel-inner").append('<div class="item"><a href="'+this.url+'"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></a></div>');
						}else{
							$(".carousel-inner").append('<div class="item"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></div>');
						}
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

        $scope.ballAmounts = [
            { label: '0 Numbers Matched', value: 0 },
            { label: '1 Number Matched', value: 1 },
            { label: '2 Numbers Matched', value: 2 },
            { label: '3 Numbers Matched', value: 3 },
            { label: '4 Numbers Matched', value: 4 },
            { label: '5 Numbers Matched', value: 5 },
            { label: '6 Numbers Matched', value: 6 },
            { label: '7 Numbers Matched', value: 7 },
            { label: '8 Numbers Matched', value: 8 },
            { label: '9 Numbers Matched', value: 9 },
            { label: '10 Numbers Matched', value: 10}

        ];

        $scope.chosenAmounts = [
            { label: '1 Number Chosen', value: 1 },
            { label: '2 Numbers Chosen', value: 2 },
            { label: '3 Numbers Chosen', value: 3 },
            { label: '4 Numbers Chosen', value: 4 },
            { label: '5 Numbers Chosen', value: 5 },
            { label: '6 Numbers Chosen', value: 6 },
            { label: '7 Numbers Chosen', value: 7 },
            { label: '8 Numbers Chosen', value: 8 },
            { label: '9 Numbers Chosen', value: 9 },
            { label: '10 Numbers Chosen', value: 10}

        ];

        $scope.winningAmounts =     [[0,     0,      0,      0,      0,      0,      0,      1,      1,      1],
                                     [3.25,  0,      0,      0,      0,      0,      0,      0,      0,      0],
                                     [0,     13,     1,      1,      0,      0,      0,      0,      0,      0],
                                     [0,     0,      45,     8,      2,      1,      0,      0,      0,      0],
                                     [0,     0,      0,      64,     20,     7,      2,      1,      0,      0],
                                     [0,     0,      0,      0,      540,    80,     20,     6,      4,      4],
                                     [0,     0,      0,      0,      0,      1250,   400,    50,     25,     20],
                                     [0,     0,      0,      0,      0,      0,      6400,   1600,   250,    80],
                                     [0,     0,      0,      0,      0,      0,      0,      24000,  6400,   400],
                                     [0,     0,      0,      0,      0,      0,      0,      0,      64000,  8000],
                                     [0,     0,      0,      0,      0,      0,      0,      0,      0,      80000]];

        $scope.stakeOptions = {
            stake:"1.00",
            numChosen:$scope.chosenAmounts[0],
            numBalls:$scope.ballAmounts[1]
        };


        $scope.update = function(stakeOptions) {
            $scope.stakeOptions.stake = parseFloat($scope.stakeOptions.stake).toFixed(2);
            if ($scope.stakeOptions.stake < 0.5 || isNaN(parseFloat($scope.stakeOptions.stake))) {
                $scope.stakeOptions.stake = "0.50";
            } else if ($scope.stakeOptions.stake > 10000000) {
              $scope.stakeOptions.stake = "10000000.00";
            }

            var stake = parseFloat($scope.stakeOptions.stake);
            var winnings = $scope.winningAmounts[$scope.stakeOptions.numBalls.value][$scope.stakeOptions.numChosen.value-1];

            
            
            var winningsCalc=numeral(winnings * stake).format('0,0.00');
            var winningsFloat = parseFloat(winningsCalc.replace(/[,]/g, ''));
            if(winningsFloat > 1000000.00){
            	winningsFloat = '1000000.00';
            }
            $scope.winnings = numeral(winningsFloat).format('0,0.00');
            
            
            
            var headsTailsCalc=numeral(2 * stake).format('0,0.00');
            var headsTailsFloat = parseFloat(headsTailsCalc.replace(/[,]/g, ''));
            if(headsTailsFloat > 1000000.00){
            	headsTailsFloat = '1000000.00';
            }
            $scope.headsTailsWinnings = numeral(headsTailsFloat).format('0,0.00');
            
            
            
            var levelsCalc=numeral(3 * stake + stake).format('0,0.00');
            var levelsFloat = parseFloat(levelsCalc.replace(/[,]/g, ''));
            if(levelsFloat > 1000000.00){
            	levelsFloat = '1000000.00';
            }
            $scope.levelsWinnings = numeral(levelsFloat).format('0,0.00');
             
             
            
            
        };

        $scope.update($scope.stakeOptions);



        $scope.videoSrc = "../media/Rapido_htp@720x576.mp4";
        $scope.thumbSrc = "../media/Rapido_htp_thumb.png";

        /*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});




    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNRapidoMenuController', [
    '$scope','$location',
    function($scope,$location) {

	$scope.navigationOptions = [
            {
                id: "",
                bgCls: "fn-rapido-menu-left-bg",
                cls: "fn-menu-title-latest",
                txt: "LATEST RESULTS"
            },
            {
                id: "previous",
                bgCls: "fn-rapido-menu-center-bg",
                cls: "fn-menu-title-previous",
                txt: "PREVIOUS RESULTS"
            },
            {
                id: "how-to-play",
                bgCls: "fn-rapido-menu-right-bg",
                cls: "fn-menu-title-how",
                txt: "HOW TO PLAY"
            }
        ];

        $scope.isActive = function (viewLocation) {
            if (viewLocation === "/rapido/" && $location.path() === "/rapido") {
                return true;
            }
            return viewLocation === $location.path();
        };


        // $scope.menuShown = false;
        //
        // $scope.menuToggleFn = function() {
        //     $scope.menuShown = !$scope.menuShown;
        //     $scope.menuDisplay = $scope.menuShown === true ? {'display':'block'} : {};
        // };
        $scope.bannerURL = function() {
          return "../../img/bg/bg_cold.png";
        };


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNRapidoResultsController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Rapido - Previous Results");
        /* load hero images */
        var ajaxRequest;
        var results = [];

		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.rapido.previous.length>0){
 				$.each(json.body.rapido.previous, function(i,obj) {
 					var slide='';
					try{
						if(json.body.rapido.previous.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s the fount" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
		/* previous results slider */
		$(document).ready(function(){

			var currentDate = new Date();

      var currentDay = ("0" + currentDate.getDate()).slice(-2);
      var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
		  var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

			var firstDay="20";
			var firstMonth="01";
			var firstYear="2000";

			var firstDate = $scope.dateStringFromComponents(firstYear, firstMonth, firstDay);
			var selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
			var currentDate = $scope.dateStringFromComponents(currentYear, currentMonth, currentDay);
			var number_of_draws=0;

 			function getBallColor(num){
 				var colors = '';
 				if (num>40){
 					colors='black';
 				}else{
 					colors='red';
 				}
 		        return colors;
 			}
			function getLotteryData(){
        if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
					url: $scope.baseURL+'/games/get_previous',
					type: 'post',
                                        contentType: "application/json; charset=utf-8",
					dataType: 'json',
					data:  JSON.stringify({"game":"ra","date": selectedDate}),
					beforeSend: function() {
 						$( ".no-results-for-date" ).remove();
 						$('#main-spinner').css( "display","inline-block" );
 						$('.resoults-middle-container').css( "display","none" );
 						$(".resoults-ball-draw").removeClass("active");
					},
					complete: function() {
						//alert('complete');
					},
					success: handleData,
					error: function(){
						//// alert('Connection error! Please try again.');
					}
				});
			}

 			function handleData(json) {

 				if (jQuery.isEmptyObject(json.body)){
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");

 				}else{

 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('.resoults-middle-container').css( "display","inline-block" );

 					var results_title='HEADS WINS';
 					var heads_count=0;
 					var tails_count=0;
 					var mark_first_selected='';
 					number_of_draws=json.body.length;
 					$("#draw-list li").remove();





 					$(".resoults-ball-draw").removeClass("active");

 					for(x=0;x<json.body.length;x++){

 						//populate draw pagination
 						
 						$("#draw-list").append('<li><span class="pagination-item btn btn-sm" style="padding:10px 18px 10px 18px;color:white;"   data-toggle="tab" href="#draw_pagination_'+(x+1)+'">Draw '+(x+1)+'</span></li>');

            if (json.body[x].status) {

 						$(".fn-draw-order").after( '<div class="resoults-ball-draw tab-pane fade in"  id="draw_pagination_'+(x+1)+'">'+
                        '<div class="fn-6-balls">'+
                        '	<div class="resoults-row">'+
	                    '		<div class="draw-title">'+
	                    '			<div class="condensed-bold fn-results-heading" style="color:white;">'+
	                    '        		DRAW '+(x+1)+' - <span class="fn-accent-text" id="draw_'+(x+1)+'"></span>'+
	                    '    		</div>'+
	                    '		</div>'+
	                    '		<div class="draw-results results_bg_'+(x+1)+'">'+
	                    '			<div class="heads-results heads_'+(x+1)+'"></div>'+
	                    '			<div class="results-table results_'+(x+1)+'"></div>'+
	                    '			<div class="tails-results tails_'+(x+1)+'"></div>'+
	                    '		</div>'+
	                    '	</div>'+
                        ' 	<div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_1"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_2"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_3"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_4"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_5"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_6"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_7"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_8"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_9"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_10"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_11"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_12"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_13"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_14"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_15"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_16"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_17"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_18"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_19"></div></div>'+
                        '    <div class="fn-ball-wrapper ng-scope"><div class="fn-ball-shadow"></div><div id="d_'+(x+1)+'_20"></div></div>'+
                        '</div>'+
                    '</div>');

                  } else {
                    $(".fn-draw-order").after( '<div class="resoults-ball-draw tab-pane fade in"  id="draw_pagination_'+(x+1)+'">'+
                              '			<div class="condensed-bold fn-results-heading fn-results-heading-none" style="color:white;">'+
                              '        		DRAW '+(x+1)+' - <span class="fn-accent-text" id="draw_'+(x+1)+'"></span>'+
                              '    		</div>'+
                              '<div class="no-results-for-draw"><h1>No Results Available</h1></div>'+
                            '</div>');
                  }






 					if (jQuery.isEmptyObject(json.body[x])){
 					}else{

 						try{
 							if((json.body[x].draw_time).indexOf(':') === -1)
 	 						{
 	 						  //alert("no dash found.");
 	 						}else{
 	 							$('#draw_'+(x+1)).html(json.body[x].draw_time);
 	 						}
 						}catch (e) {

 						}




 						results = json.body;
 						for (var i in results) {
			                var resultData = results[i];
			                resultData.results.sortedNumbers = resultData.results.numbers.concat().sort($scope.sortNumber);
 						}
 						showResults(x);
 					}
          }
        }

				//set current last race active
				$('.resoults-middle-container div').first().addClass("active");
				$('.resoults-middle-container div:last-child ul li:last-child').addClass("active");
				
 	    		updateDaySwitchers();
 	    		checkNumbers();

        //
 			// 	number_1 = $('#check_nb_1').val();
	    	// 	number_2 = $('#check_nb_2').val();
	    	// 	number_3 = $('#check_nb_3').val();
	    	// 	number_4 = $('#check_nb_4').val();
	    	// 	number_5 = $('#check_nb_5').val();
 			// 	number_6 = $('#check_nb_6').val();
	    	// 	number_7 = $('#check_nb_7').val();
	    	// 	number_8 = $('#check_nb_8').val();
	    	// 	number_9 = $('#check_nb_9').val();
	    	// 	number_10 = $('#check_nb_10').val();
				// $( ".ball-selected" ).remove();
	    	// 	$( ".fn-ball-nb-"+number_1 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_2 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_3 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_4 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_5 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_6 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_7 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_8 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_9 ).before( "<div class='ball-selected'></div>" );
	    	// 	$( ".fn-ball-nb-"+number_10 ).before( "<div class='ball-selected'></div>" );

 			}



      $scope.drawSorted = true;
      $scope.toggleDrawOrder = function() {
        $scope.drawSorted = !$scope.drawSorted;
        for(var x=0;x<number_of_draws;x++){
          showResults(x);
        }
        checkNumbers();
      };



       function showResults(index) {

            heads_count=0;
            tails_count=0;
            if ($scope.drawSorted) {
             for (y=0;y<20;y++){
                if(results[index].results.sortedNumbers[y]){
                  $("#d_"+(index+1)+"_"+(y+1)).html(results[index].results.sortedNumbers[y]);
                  color=getBallColor(results[index].results.sortedNumbers[y]);
                  $("#d_"+(index+1)+"_"+(y+1)).removeClass();
                  $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-coin-'+color);
                  $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-ball-nb-'+results[index].results.sortedNumbers[y]);
                  if(results[index].results.sortedNumbers[y]>40){
                    tails_count=tails_count+1;
                  }else{
                    heads_count=heads_count+1;
                  }
                }
              }
            } else {
              for (y=0;y<20;y++){
                 if(results[index].results.numbers[y]){
                   $("#d_"+(index+1)+"_"+(y+1)).html(results[index].results.numbers[y]);
                   color=getBallColor(results[index].results.numbers[y]);
                   $("#d_"+(index+1)+"_"+(y+1)).removeClass();
                   $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-coin-'+color);
                   $("#d_"+(index+1)+"_"+(y+1)).addClass('fn-ball-nb-'+results[index].results.numbers[y]);
                   if(results[index].results.numbers[y]>40){
                     tails_count=tails_count+1;
                   }else{
                     heads_count=heads_count+1;
                   }
                 }
               }
            }
         $('.heads_'+(index+1)).html(heads_count);
         if(heads_count>tails_count){
           $('.results_'+(index+1)).html('HEADS WINS');
           $('.results_bg_'+(index+1)).css('background','url("../../img/bg/results-red.png")');
         }else if(heads_count<tails_count){
           $('.results_'+(index+1)).html('TAILS WINS');
           $('.results_bg_'+(index+1)).css('background','url("../../img/bg/results-black.png")');
         }else{
           $('.results_'+(index+1)).html('LEVEL');
           $('.results_bg_'+(index+1)).css('background','url("../../img/bg/results-black-red.png")');
         }

         $('.tails_'+(index+1)).html(tails_count);
       }



			function populateSelectBoxes(){
				//populate months select box and set current month
				$('#month option:eq('+(selectedMonth-1)+')').prop('selected', true);
				//populate years select box and set last as selected
				var yearsArray = new Array();
				for (i=0;(currentYear-i)>=firstYear;i++){
					yearsArray[i]=currentYear-i;
				}
				$("#year").empty();
				$.each(yearsArray, function(val, text) {
		            $('#year').append(
		                $('<option></option>').val(text).html(text)
		            );
				});
				$('#year option[value="'+selectedYear+'"]').prop('selected', true);
			}

			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}

			function disableSelectBoxesOptions(){
				if($( "#year" ).val() == currentYear){
					if(currentMonth<1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(currentMonth<2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(currentMonth<3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(currentMonth<4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(currentMonth<5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(currentMonth<6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(currentMonth<7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(currentMonth<8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(currentMonth<9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(currentMonth<10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(currentMonth<11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(currentMonth<12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else if ($( "#year" ).val() == firstYear){
					if(firstMonth>1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(firstMonth>2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(firstMonth>3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(firstMonth>4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(firstMonth>5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(firstMonth>6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(firstMonth>7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(firstMonth>8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(firstMonth>9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(firstMonth>10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(firstMonth>11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(firstMonth>12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else{
					$("#month option[value='1']").removeAttr('disabled');
					$("#month option[value='2']").removeAttr('disabled');
					$("#month option[value='3']").removeAttr('disabled');
					$("#month option[value='4']").removeAttr('disabled');
					$("#month option[value='5']").removeAttr('disabled');
					$("#month option[value='6']").removeAttr('disabled');
					$("#month option[value='7']").removeAttr('disabled');
					$("#month option[value='8']").removeAttr('disabled');
					$("#month option[value='9']").removeAttr('disabled');
					$("#month option[value='10']").removeAttr('disabled');
					$("#month option[value='11']").removeAttr('disabled');
					$("#month option[value='12']").removeAttr('disabled');
				}

        if ($( "#month" ).val() < parseInt(firstMonth)){
          $("#year option[value='"+firstYear+"']").attr('disabled','disabled');
        } else {
          $("#year option[value='"+firstYear+"']").removeAttr('disabled');
        }
			}

			function setMonthlySwitchers(){
				var previousMonths = new Array();
				previousMonths[1]='December';
				previousMonths[2]='January';
				previousMonths[3]='February';
				previousMonths[4]='March';
				previousMonths[5]='April';
				previousMonths[6]='May';
				previousMonths[7]='June';
				previousMonths[8]='July';
				previousMonths[9]='August';
				previousMonths[10]='September';
				previousMonths[11]='October';
				previousMonths[12]='November';
				previousMonthText=previousMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==1){
            		previousMonthText+=$( "#year" ).val()-1;
            	}else{
            		previousMonthText+=$( "#year" ).val();
            	}
            	$('#previous-month-switch').html(previousMonthText);

				var nextMonths = new Array();
				nextMonths[1]='February';
				nextMonths[2]='March';
				nextMonths[3]='April';
				nextMonths[4]='May';
				nextMonths[5]='June';
				nextMonths[6]='July';
				nextMonths[7]='August';
				nextMonths[8]='September';
				nextMonths[9]='October';
				nextMonths[10]='November';
				nextMonths[11]='December';
				nextMonths[12]='January';

				nextMonthText=nextMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==12){
            		nextMonthText+=(parseInt($( "#year" ).val())+1);
            	}else{
            		nextMonthText+=$( "#year" ).val();
            	}
            	$('#next-month-switch').html(nextMonthText);
            	//disable next month button
            	if(selectedYear == currentYear && selectedMonth >= currentMonth){
            		$('#nextMonthClick').css( "display","none" );
            	}else{
					$('#nextMonthClick').css( "display","inline-block" );
            	}
            	//disable previous month button
            	if(selectedYear == firstYear && selectedMonth <= firstMonth){
            		$('#prevMonthClick').css( "display","none" );
            	}else{
					$('#prevMonthClick').css( "display","inline-block" );
            	}
			}
			function scrollToSelectedPosition(){
				var selectedElement=$( ".days-controls-selected" );
				var position = selectedElement.position();
				//$( "#days-list-rapido" ).animate({left: -position.left}, 500, function() { });
				$( "#days-list-rapido" ).css("left", -position.left);
			}


			function setDaysSlider(){
				$("#days-list-rapido").empty();

				//selected main element
				if(new Date(selectedDate) >= new Date(firstDate) &&  new Date(selectedDate) <= new Date(currentDate) ){
					$("#days-list-rapido").append('<li class="days-controls-selected"><a href="#" class="dayselect-rapido" data-position="0"  data-date="'+selectedDate+'">'+$scope.getShortDayName(selectedDate)+'<br><span class="dayNum">'+$scope.getDayNumber(selectedDate)+'</span></a></li>');
				}
				//prepened options
				daybefore = $scope.getDateBeforeDate(selectedDate);

				if(new Date(daybefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-1"  data-date="'+daybefore+'">'+$scope.getShortDayName(daybefore)+'<br><span class="dayNum">'+$scope.getDayNumber(daybefore)+'</span></a></li>');
				}

				twodaysbefore = $scope.getDateBeforeDate(daybefore);
				if(new Date(twodaysbefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-3"  data-date="'+twodaysbefore+'">'+$scope.getShortDayName(twodaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysbefore)+'</span></a></li>');
				}

				threedaysbefore = $scope.getDateBeforeDate(twodaysbefore);
				if(new Date(threedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-4"  data-date="'+threedaysbefore+'">'+$scope.getShortDayName(threedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysbefore)+'</span></a></li>');
				}

				fourdaysbefore = $scope.getDateBeforeDate(threedaysbefore);
				if(new Date(fourdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-5"  data-date="'+fourdaysbefore+'">'+$scope.getShortDayName(fourdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysbefore)+'</span></a></li>');
				}

				fivedaysbefore = $scope.getDateBeforeDate(fourdaysbefore);
				if(new Date(fivedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-6"  data-date="'+fivedaysbefore+'">'+$scope.getShortDayName(fivedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysbefore)+'</span></a></li>');
				}

				sixdaysbefore = $scope.getDateBeforeDate(fivedaysbefore);
				if(new Date(sixdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-7"  data-date="'+sixdaysbefore+'">'+$scope.getShortDayName(sixdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysbefore)+'</span></a></li>');
				}

				sevendaysbefore = $scope.getDateBeforeDate(sixdaysbefore);
				if(new Date(sevendaysbefore) >= new Date(firstDate)  ){
					$("#days-list-rapido").prepend('<li><a href="#" class="dayselect-rapido" data-position="-8"  data-date="'+sevendaysbefore+'">'+$scope.getShortDayName(sevendaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysbefore)+'</span></a></li>');
				}

				//appended options
				dayafter = $scope.getDateAfterDate(selectedDate);
				if(new Date(dayafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="1"  data-date="'+dayafter+'">'+$scope.getShortDayName(dayafter)+'<br><span class="dayNum">'+$scope.getDayNumber(dayafter)+'</span></a></li>');
				}

				twodaysafter = $scope.getDateAfterDate(dayafter);
				if(new Date(twodaysafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="2"  data-date="'+twodaysafter+'">'+$scope.getShortDayName(twodaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysafter)+'</span></a></li>');
				}

				threedaysafter = $scope.getDateAfterDate(twodaysafter);
				if(new Date(threedaysafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="3"  data-date="'+threedaysafter+'">'+$scope.getShortDayName(threedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysafter)+'</span></a></li>');
				}

				fourdaysafter = $scope.getDateAfterDate(threedaysafter);
				if(new Date(fourdaysafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="4"  data-date="'+fourdaysafter+'">'+$scope.getShortDayName(fourdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysafter)+'</span></a></li>');
				}

				fivedaysafter = $scope.getDateAfterDate(fourdaysafter);
				if(new Date(fivedaysafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="5"  data-date="'+fivedaysafter+'">'+$scope.getShortDayName(fivedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysafter)+'</span></a></li>');
				}

				sixdaysafter = $scope.getDateAfterDate(fivedaysafter);
				if(new Date(sixdaysafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="6"  data-date="'+sixdaysafter+'">'+$scope.getShortDayName(sixdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysafter)+'</span></a></li>');
				}

				sevendaysafter = $scope.getDateAfterDate(sixdaysafter);
				if(new Date(sevendaysafter) <= new Date(currentDate)  ){
					$("#days-list-rapido").append('<li><a href="#" class="dayselect-rapido" data-position="7"  data-date="'+sevendaysafter+'">'+$scope.getShortDayName(sevendaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysafter)+'</span></a></li>');
				}

				//$('#fdate').html(firstYear+'-'+firstMonth+"-"+firstDay);
				//$('#sdate').html(selectedYear+'-'+selectedMonth+"-"+selectedDay);
				//$('#cdate').html(currentYear+'-'+currentMonth+"-"+currentDay);

				scrollToSelectedPosition();
				populateSelectBoxes();
				disableSelectBoxesOptions();
				setMonthlySwitchers();
				updateDaySwitchers();
				getLotteryData();
			}


			//initiate everything
			populateSelectBoxes();
			setDaysSlider();

			$( "#month" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && parseInt(selectedMonth) == parseInt(firstMonth) && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			$( "#year" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on day selector click

			$('#days-list-rapido').on('click', ' a.dayselect-rapido', function(event) {
				event.preventDefault();
				dateArray=this.getAttribute("data-date").split("-");
				selectedDay = dateArray[2];
				selectedMonth = dateArray[1];
				selectedYear = dateArray[0];
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
				setDaysSlider();
			});

			$("#prevMonthClick").click(function(event){
			    event.preventDefault();

				//set year
				selectedYear=$( "#year" ).val();
				//set month

				selectedMonth = $( "#month" ).val()-1;
				//switch to previous year
				if(selectedMonth==0){
					selectedMonth = 12;
					selectedYear = selectedYear-1;
				}
				if(selectedYear == firstYear && selectedMonth < firstMonth){
					selectedMonth = firstMonth;
				}
				//set day


				if(selectedYear == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();

			});

			$("#nextMonthClick").click(function(event){
			    event.preventDefault();
				//set year
				selectedYear=$( "#year" ).val();
				//set month

				selectedMonth = parseInt($( "#month" ).val())+1;

				//switch to previous year
				if(selectedMonth==13){
					selectedMonth = 1;
					selectedYear = parseInt(selectedYear)+1;
				}
				if(selectedYear == currentYear && selectedMonth > currentMonth){
					selectedMonth = currentMonth;
				}
				//set day
				if(selectedYear == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dateAfterArray=dateAfter.split("-");

				if(new Date(dateAfter) > new Date(currentDate)  ){
				}else{
					selectedDay = dateAfterArray[2];
					selectedMonth = dateAfterArray[1];
					selectedYear = dateAfterArray[0] ;

					selectedDate = dateAfter;
				}
				setDaysSlider();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();

				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dateBeforeArray=dateBefore.split("-");
				if(new Date(dateBefore) < new Date(firstDate)  ){

				}else{
					selectedDay = dateBeforeArray[2];
					selectedMonth = dateBeforeArray[1];
					selectedYear = dateBeforeArray[0] ;

					selectedDate = dateBefore;
				}
				setDaysSlider();
			});

		});

    	$scope.clearNumbers = function(name) {
    		$( ".fn-ball-wrapper" ).css({"opacity":"1"});
    		$scope.check_number_1='';
    		$scope.check_number_2='';
    		$scope.check_number_3='';
    		$scope.check_number_4='';
    		$scope.check_number_5='';
    		$scope.check_number_6='';
    		$scope.check_number_7='';
    		$scope.check_number_8='';
    		$scope.check_number_9='';
    		$scope.check_number_10='';
    	}

      function validateNumber(number) {
        var int = parseInt(number);
        if (int > 0 && int <= 80) {
          return int;
        }
        return '';
      }


    	function checkNumbers(){

        $scope.check_number_1 =	validateNumber($scope.check_number_1);
        $scope.check_number_2 =	validateNumber($scope.check_number_2);
        $scope.check_number_3 =	validateNumber($scope.check_number_3);
        $scope.check_number_4 =	validateNumber($scope.check_number_4);
        $scope.check_number_5 =	validateNumber($scope.check_number_5);
        $scope.check_number_6 =	validateNumber($scope.check_number_6);
        $scope.check_number_7 =	validateNumber($scope.check_number_7);
        $scope.check_number_8 =	validateNumber($scope.check_number_8);
        $scope.check_number_9 =	validateNumber($scope.check_number_9);
        $scope.check_number_10 =	validateNumber($scope.check_number_10);

    		number_1 =	$scope.check_number_1;
    		number_2 =	$scope.check_number_2;
    		number_3 =	$scope.check_number_3;
    		number_4 =	$scope.check_number_4;
    		number_5 =	$scope.check_number_5;
    		number_6 =	$scope.check_number_6;
    		number_7 =	$scope.check_number_7;
    		number_8 =	$scope.check_number_8;
    		number_9 =	$scope.check_number_9;
    		number_10 =	$scope.check_number_10;

        if (clearNumbersEnabled()) {
        	$( ".fn-ball-wrapper" ).css({"opacity":"0.3"});
        	$( "#clear_num_btn" ).css({"opacity":"1"});
        } else {
        	$( "#clear_num_btn" ).css({"opacity":"0.5"});
        }


    		$( ".ball-selected" ).remove();
    		$( ".fn-ball-nb-"+number_1 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_1 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_2 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_2 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_3 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_3 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_4 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_4 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_5 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_5 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_6 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_6 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_7 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_7 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_8 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_8 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_9 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_9 ).parent().css({"opacity":"1.0"});
    		$( ".fn-ball-nb-"+number_10 ).before( "<div class='ball-selected'></div>" );
    		$( ".fn-ball-nb-"+number_10 ).parent().css({"opacity":"1.0"});
    	}


      function clearNumbersEnabled() {
    	  
        if ($scope.check_number_1 > 0
          || $scope.check_number_2 > 0
          || $scope.check_number_3 > 0
          || $scope.check_number_4 > 0
          || $scope.check_number_5 > 0
          || $scope.check_number_6 > 0
          || $scope.check_number_7 > 0
          || $scope.check_number_8 > 0
          || $scope.check_number_9 > 0
          || $scope.check_number_10 > 0) {
            return true;
          }
          return false;
      };


    	$scope.$watch('check_number_1', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_2', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_3', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_4', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_5', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_6', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_7', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_8', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_9', function() { checkNumbers(); }, true);
    	$scope.$watch('check_number_10', function() { checkNumbers(); }, true);

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNRapidoRulesController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Rapido - Rules");

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.rapido.rules.length>0){
 				$.each(json.body.rapido.rules, function(i,obj) {
 					var slide='';
					try{
						if(json.body.rapido.rules.length>1){
 							$(".carousel-indicators").append('<li data-target="#myCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNAlertController', [
    '$scope',
    function($scope) {

//        var alertID;
//        $scope.imgURL = 'http://54.194.234.251/admin/uploads_assets/51dd5c90f2a4dd16051668aceff1d9cb.jpg';
//        $scope.linkURL = '../mobileapp';

        $scope.showAlert = false;


        function checkForAlerts() {
          $.ajax({
            url: $scope.baseURL+'/alert/alert_banner',
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
            },
            complete: function() {
            },
            success: showAlert,
            error: function(){
              // // alert('Connection error! Please try again.');
              console.log("error");
            }
          });
        }

        checkForAlerts();

        function showAlert (json) {
          if(json.body) {
            alertID = json.body["id"];
            if (typeof json.body["img"] != 'undefined' && json.body["img"].length > 0) {
              $scope.imgURL = json.body["img"];
              $scope.linkURL = json.body["link"];
              if (supportsHTML5Storage()) {
                var lastAlert = localStorage.getItem("alert");
                if (parseInt(lastAlert) === alertID) {
                  $scope.showAlert = false;
                } else {
                  $scope.showAlert = true;
                }
              } else {
                $scope.showAlert = true;
              }
            } else {
              $scope.showAlert = false;
            }

          }
        };



        $scope.closeAlert = function() {
          $scope.showAlert = false;

          if (supportsHTML5Storage()) {
            localStorage.setItem("alert", alertID);
          } else {
          }
        };





        function supportsHTML5Storage() {
          try {
            return 'localStorage' in window && window['localStorage'] !== null;
          } catch (e) {
            return false;
          }
        }

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNBetHereController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's - Bet Here");

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.home.bet_here.length>0){
 				$.each(json.body.home.bet_here, function(i,obj) {
 					var slide='';
					try{
						if(json.body.home.bet_here.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s the fount" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

        $scope.navigationOptions = [
            {
                id: "williamhill",
                cls: "fn-promo-section1",
            },
            {
                id: "coral",
                cls: "fn-promo-section2",
            },
            {
                id: "ladbrokes",
                cls: "fn-promo-section3",
            }
        ];


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNBettingShopController', [
    '$scope','$http','$timeout',
    function($scope,$http,$timeout) {

      $scope.setTitle("49's - Find a Betting Shop");


		$scope.bookmakerSpots = [];
		//initialize empty map set zoom and center on UK
		$scope.$on('mapInitialized', function(event, map) {
			map.setZoom(6);
			map.setCenter( new google.maps.LatLng(53.4197283, -2.42235));
		    $scope.markers = [];
		    var infoWindow = new google.maps.InfoWindow();
		    $scope.createMarker = function (info){
		        var marker = new google.maps.Marker({
		            map: $scope.map,
		            position: new google.maps.LatLng(info.lat, info.long),
		            title: info.name,
		            address: info.address,
		            postcode: info.postcode,
		            link: info.link
		        });
		        marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
		        google.maps.event.addListener(marker, 'click', function(){
		            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
		            infoWindow.open($scope.map, marker);
		        });
		        /*google.maps.event.addListener(marker, "dblclick", function() {
		            marker.setMap(null);
		        });*/
		        $scope.markers.push(marker);
		    }

		    $scope.deleteMarkers = function (){
		        while($scope.markers.length){
		        	$scope.markers.pop().setMap(null);
		        }
		        $scope.markers=[];
		    	$scope.bookmakers =[];
		    	$scope.bookmakers.pop();
		    	$scope.bookmakerSpots=[];
		    	$scope.bookmakerSpots.pop();
		        google.maps.event.trigger(map, 'resize');//hack to redraw map and
		    }
		    $scope.openInfoWindow = function(e, selectedMarker){
		        e.preventDefault();

		        $scope.listResults=true;
		        $scope.mapResults=false;
		        setTimeout(function(){
			    	google.maps.event.trigger($scope.map, 'resize');//hack to redraw map
			    	//centralize map on new search
			    	$scope.map.setZoom(12);
					$scope.map.setCenter( new google.maps.LatLng($scope.bookmakerSpots[0].lat, $scope.bookmakerSpots[0].long));
					google.maps.event.trigger(selectedMarker, 'click');
					$('html,body').animate({scrollTop: $('#scroll-point').offset().top }, "slow");
			    },500);
		    }
        });

    	$scope.noResults=true;
    	$scope.listResults=true ;
    	$scope.mapResults=true;
    	$scope.searchSection=false;

    	$scope.findBookmakers = function(address) {
    		if(angular.isUndefined(address) ){
    			//alert(JSON.stringify(address));
    			$scope.noResults=false;
		    	$scope.listResults=true;
		    	$scope.mapResults=true;
		    	$scope.searchSection=false;
    		}else{
    			$scope.bookmakerSearch='';
    			if ('postcode' in address && address.postcode.length > 1) { $scope.bookmakerSearch += address.postcode; }
    			if ('postcode' in address && address.postcode.length > 1 && 'town' in address && address.town.length > 1) { $scope.bookmakerSearch += ', '; }
    			if ('town' in address && address.town.length > 1) { $scope.bookmakerSearch += address.town; }

    			var addresString='';

    			if ('postcode' in address && address.postcode.length>1) { addresString += address.postcode; }
					addresString+=',';
    			if ('town' in address) { addresString += address.town; }

    			if('postcode' in address && address.postcode.length > 1 || 'town' in address && address.town.length > 2){
						// On database there are not records for full postcode search, so we have to remove
						// last part of full postcode for matching shops near by the area user is looking for
						var fullPostcode = addresString.split(',');
						var areaPostcode = fullPostcode[0].split(' ');
						areaPostcode = areaPostcode[0].substring(0, 4);
						if (!(parseInt(areaPostcode[3], 10) >= 0 && parseInt(areaPostcode[3], 10) <= 9)) {
							// Ensure numerical(natural) pattern
							areaPostcode = areaPostcode.substring(0, 3)
						}
						addresString = areaPostcode + ',' + fullPostcode[1];
    				console.log(addresString);

    				$http.post($scope.baseURL+'/bookmakers/get_near_bookmakers', { "address":addresString}).
	    			//$http.post('http://54.194.234.251/index.php/bookmakers/get_near_bookmakers', { "address":addresString,"radius": 2}).
	    			//$http.post('http://49s.local/index.php/bookmakers/get_near_bookmakers', { "address":addresString,"radius": 6}).
		    			success(function(data, status, headers, config) {



		    				$scope.noResults=true;
		    				$scope.deleteMarkers();
						 	if ( angular.isArray(data.body)  ) {
						        $scope.bookmakers = data.body;
						        if($scope.listResults==true && $scope.mapResults==true){
						        	$scope.listResults=false;
						        }


						        for (var i=0; i<$scope.bookmakers.length; i++) {

							        //prep description
							        prep_description='';
							        if($scope.bookmakers[i].B_Address1!=null){ prep_description+=$scope.bookmakers[i].B_Address1+'<br/>';}
							        if($scope.bookmakers[i].B_Address2!=null){ prep_description+=$scope.bookmakers[i].B_Address2+'<br/>';}
							        if($scope.bookmakers[i].B_Address3!=null){ prep_description+=$scope.bookmakers[i].B_Address3+'<br/>';}
							        if($scope.bookmakers[i].B_Postcode!=null){ prep_description+=$scope.bookmakers[i].B_Postcode;}

							        //prep address
							        prep_address='';
							        if($scope.bookmakers[i].B_Address1!=null){prep_address+=$scope.bookmakers[i].B_Address1+' ';}
							        if($scope.bookmakers[i].B_Address2!=null){prep_address+=$scope.bookmakers[i].B_Address2+' ';}
							        if($scope.bookmakers[i].B_Address3!=null){prep_address+=$scope.bookmakers[i].B_Address3}

						        	$scope.bookmakerSpots.push({
					    		    	name : $scope.bookmakers[i].B_CompanyName,
					    		        desc : prep_description,
					    		        lat : $scope.bookmakers[i].B_Lat,
					    		        long : $scope.bookmakers[i].B_Long,
					    		        address : prep_address,
					    		        postcode : $scope.bookmakers[i].B_Postcode,
					    		        link :'Map'
					    		    });
					 		    }
						        //create markers
					    		for (i = 0; i < $scope.bookmakerSpots.length; i++){
					    			$scope.createMarker($scope.bookmakerSpots[i]);
				        		}
					    		if($scope.bookmakerSpots.length<1){
					    			$scope.listResults=true;
				    		        $scope.mapResults=true;
				    				$scope.noResults=false;


					    		}
					    		//centralize map on new search
						    	$scope.map.setZoom(12);
						    	if($scope.bookmakerSpots[0] !== undefined && $scope.bookmakerSpots[0].lat !== undefined){
						    		$scope.map.setCenter( new google.maps.LatLng($scope.bookmakerSpots[0].lat, $scope.bookmakerSpots[0].long));
						    		$('html,body').animate({scrollTop: $('#scroll-point').offset().top }, "slow");
						    	}

						    }else{
						    	$scope.listResults=true;
			    		        $scope.mapResults=true;
			    				$scope.noResults=false;
						    }

		    			}).
		    			error(function(data, status, headers, config) {
		    				console.log('error loading bookmakers');
							$scope.noResults=false;
					    	$scope.listResults=true;
					    	$scope.mapResults=true;
		    			});
    			}else{
    				$scope.listResults=true;
    		        $scope.mapResults=true;
    				$scope.noResults=false;//show error if postcode too short
    			}
    		}
    	};
    	$scope.showMap = function() {
			$scope.mapResults=false;
			$scope.listResults=true;
		    setTimeout(function(){
		    	google.maps.event.trigger($scope.map, 'resize');//hack to redraw map
		    	//centralize map on new search
		    	$scope.map.setZoom(12);
				$scope.map.setCenter( new google.maps.LatLng($scope.bookmakerSpots[0].lat, $scope.bookmakerSpots[0].long));

				$('html,body').animate({scrollTop: $('#scroll-point').offset().top }, "slow");
		    },500);
    	};
    	$scope.showList = function() {
			$scope.mapResults=true;
			$scope.listResults=false;
			$('html,body').animate({scrollTop: $('#scroll-point').offset().top }, "slow");
			//google.maps.event.trigger(map, 'resize');//hack to redraw map
    	};

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNCompetitionController', [
    '$scope','$http','$location',
    function($scope, $http,$location) {

      $scope.showCompetition = false;
      $scope.competitionTitle;
      $scope.competitionContent;
      var competitionID;

      $scope.emailNotFound = false;
      $scope.enteredCompetition = false;

      $scope.formData = {};



        $scope.checkForCompetitions = function() {
          $.ajax({
            url: $scope.baseURL+'/competitions/get_competition',
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
            },
            complete: function() {
            },
            success: parseCompetition,
            error: function(){
              // // alert('Connection error! Please try again.');
              console.log("error");
            }
          });
        }


        function parseCompetition(json) {
          if (json.body.length>0) {
            $scope.showCompetition = true;
            $scope.competitionTitle = json.body[0].title;
            $scope.competitionContent = json.body[0].content;
            competitionID = json.body[0].id;
            $scope.$apply();
          } else {
            $scope.showCompetition = false;
          }
        }

        // checkForCompetitions();



        function checkEmail(email) {
          $http.post($scope.baseURL+'/competitions/check_email',
            {'email':$scope.formData.email}).
	    			success(function(data, status, headers, config) {
	    				if(data.server_obj.success){
                if (data.body === true) {
                  //email valid
                  console.log("email valid");
                  submitUserToCompetition();
                } else {
                  $scope.emailNotFound = true;
                }
	    				} else {
                $scope.emailNotFound = true;
	    				}

	    			}).
	    			error(function(data, status, headers, config) {
              console.log(data);
              //fail
	    			});
        }

        $scope.submitEmail = function() {
          if (typeof $scope.formData.email != 'undefined' && $scope.formData.email.length > 0) {
            checkEmail($scope.formData.email);
          }
        }

        $scope.registerClicked = function() {
          $scope.showCompetition = false;
          $scope.emailNotFound = false;
          $scope.enteredCompetition = false;
          $location.path('../stayintouch');
        }

        $scope.closePressed = function() {
          $scope.showCompetition = false;
          $scope.emailNotFound = false;
          $scope.enteredCompetition = false;
        }



        function submitUserToCompetition() {
          $http.post($scope.baseURL+'/competitions/enter_competition',
            {'email':$scope.formData.email, "competition_id":competitionID}).
	    			success(function(data, status, headers, config) {

	    				if(data.server_obj.success){
                if (data.body === true) {
                  //email valid
                  $scope.enteredCompetition = true;
                  console.log("submitted");
                } else {

                }
	    				} else {

	    				}

	    			}).
	    			error(function(data, status, headers, config) {
              console.log(data);
              //fail
	    			});
        }


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNContactController', [
    '$scope','$http',
    function($scope,$http) {

      $scope.setTitle("49's - Contact");

    	$scope.contactThankYou=true;
    	$scope.contactFormElements=false;
    	$scope.submitted = false;

    	$scope.contactForm = function() {
    		if ($scope.contactForm.$valid) {
    	    	alert('invalid form');
    	    } else {

    			//$http.post('http://49s.local/index.php/recaptcha/validate', { 'g-recaptcha-response':$scope.gRecaptchaResponse}).
    	    	//$http.post('http://54.194.234.251/index.php/recaptcha/validate', { 'g-recaptcha-response':$scope.gRecaptchaResponse}).
    	    	$http.post($scope.baseURL+'/recaptcha/validate', { 'g-recaptcha-response':$scope.gRecaptchaResponse}).
	    			success(function(data, status, headers, config) {
	    				if(data=='success'){
	    					//alert('validation confirmed');

    	    				$http.post($scope.baseURL+'/contact/send_email', { "email":$scope.contact.email,"subject": $scope.contact.name,"content":$scope.contact.message}).
			    			success(function(data, status, headers, config) {

			    				$scope.contactThankYou=false;
		    			    	$scope.contactFormElements=true;

			    			}).
			    			error(function(data, status, headers, config) {
			    				alert('there was a problem with sending emails. Please try again.');
			    			});


	    				}else if(data=='failed'){
	    					//alert('Captcha didnt pass backend validation');
	    					$scope.captchaError='Problem with captcha validation';
	    				}
	    			}).
	    			error(function(data, status, headers, config) {
	    				alert('Problem with captcha validation service '+data);
	    			});

    			$scope.contactForm.submitted = true;
    	    }
    	}

    	$scope.captchaControl = {};
    	$scope.resetCaptcha = function(){
            if(captchaControl.reset){
            	captchaControl.reset();
            }
    	};

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNmisssmileyController', [
    '$scope','$http',
    function($scope,$http) {
		
		 
		$scope.Bname = undefined;
		

$http({
 
                method: 'GET',
 
                url: $scope.baseURL+'/shopname/shop_name'
 
            }).success(function (data) {
 
                console.log(data);
 
                $scope.Bname = data;
				
 
            });
      $scope.termsShowing = false;
      var loadedData = false;
      // $scope.feedback = {};

      // $scope.submitForm = function() {
      //
      //   if ($scope.feedback_form.$pristine) {
      //         console.log("form empty");
      // 	    } else if($scope.feedback_form.$invalid){
      //         console.log("form invalid");
      // 	    } else if($scope.feedback_form.$valid){
      //         console.log($scope.feedback);
      //       }
      // };

      $scope.submitForm = function() {

       if ($scope.miss_smiley.$pristine) {
              console.log("form empty");
           } else if($scope.miss_smiley.$invalid){
             console.log("form invalid");
           } else if($scope.miss_smiley.$valid){
             console.log($scope.misssmiley);


         $http.post($scope.baseURL+'/misssmiley/miss_smiley', {
                            "shopname":  $scope.misssmiley.shopname.B_CompanyName,
                            "shopnumber": $scope.misssmiley.shopnumber,
							"emailaddress": $scope.misssmiley.emailaddress,
                            "managername": $scope.misssmiley.managername,
                            "areamanager": $scope.misssmiley.areamanager,
                            "shopaddress1": $scope.misssmiley.shopaddress1,
							"shopaddress2": $scope.misssmiley.shopaddress2,
							"shopaddress3": $scope.misssmiley.shopaddress3,
							"postcode": $scope.misssmiley.postcode,
                            "shopphone": $scope.misssmiley.shopphone,
							"package":$scope.misssmiley.package }).
           success(function(data, status, headers, config) {
			   
			  console.log(JSON.stringify(data));
			$('#modalthanks').trigger('click');
			//alert(JSON.stringify(data));
			//alert('Thank you for entering the competition. Winners will be drawn on xxxxx. We will contact you if your shop is one of the winners.Good luck.');
             if(data.server_obj.success){
              console.log("success");
                $scope.showThanks = true;
                $scope.resetFeedback();
                localStorage.removeItem('misssmileyForm');
             }else{
               alert(JSON.stringify(data));
             }

           }).
           error(function(data, status, headers, config) {
             alert('Problem with connection to webservice:'+data);
           });


           }
     }

     $scope.$watch('misssmiley', function() { saveForm(); }, true);
     $scope.$watch('miss_smiley', function(theForm) {
       if(theForm) {
         if (!loadedData) {
           loadedData = true;
           loadForm();
           $scope.miss_smiley.$setDirty();
        }
       }
     });

     function saveForm() {
       if (supportsHTML5Storage() && loadedData) {
         var formData = JSON.stringify($scope.misssmiley);
         localStorage.setItem("misssmileyForm", formData);
       }
     };

     function loadForm() {
       if (supportsHTML5Storage()) {
         var formData = JSON.parse(localStorage.getItem('misssmileyForm'));
         $scope.misssmiley = formData;
       }
     };

     function supportsHTML5Storage() {
       try {
         return 'localStorage' in window && window['localStorage'] !== null;
       } catch (e) {
         return false;
       }
     }


    }]
);
window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFNshopnameController', [
    '$http','$scope',
    function($http,$scope) {
  
		$scope.Bname = undefined;
$http({
 
                method: 'GET',
 
                url: $scope.baseURL+'/shopname/shop_name'
 
            }).success(function (data) {
 
                console.log(data);
 
                $scope.Bname = data;
 
            });

    }]
);
window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNFeedbackController', [
    '$scope','$http',
    function($scope,$http) {

      $scope.termsShowing = false;
      var loadedData = false;
      // $scope.feedback = {};

      // $scope.submitForm = function() {
      //
      //   if ($scope.feedback_form.$pristine) {
      //         console.log("form empty");
      // 	    } else if($scope.feedback_form.$invalid){
      //         console.log("form invalid");
      // 	    } else if($scope.feedback_form.$valid){
      //         console.log($scope.feedback);
      //       }
      // };

      $scope.submitForm = function() {

       if ($scope.feedback_form.$pristine) {
              console.log("form empty");
           } else if($scope.feedback_form.$invalid){
             console.log("form invalid");
           } else if($scope.feedback_form.$valid){
             console.log($scope.feedback);


         $http.post($scope.baseURL+'/feedback/send_feedback', {
                            "downloadApp":  $scope.feedback.downloadApp,
                            "email": $scope.feedback.email,
                            "improvement": $scope.feedback.improvement,
                            "listClear": $scope.feedback.listClear,
                            "listEasy": $scope.feedback.listEasy,
                            "listEnjoyable": $scope.feedback.listEnjoyable,
                            "listInfo": $scope.feedback.listInfo,
                            "listInteresting": $scope.feedback.listInteresting,
                            "listLayout": $scope.feedback.listLayout,
                            "listUseful": $scope.feedback.listUseful,
                            "looking": $scope.feedback.looking,
                            "name": $scope.feedback.name,
                            "rate49sLD": $scope.feedback.rate49sLD,
                            "rateFount": $scope.feedback.rateFount,
                            "rateILBLD": $scope.feedback.rateILBLD,
                            "rateLayout": $scope.feedback.rateLayout,
                            "rateNew": $scope.feedback.rateNew,
                            "rateOld": $scope.feedback.rateOld,
                            "suggestions": $scope.feedback.suggestions,
                            "twitter": $scope.feedback.twitter
                                       }).
           success(function(data, status, headers, config) {

             if(data.server_obj.success){
              console.log("success");
                $scope.showThanks = true;
                $scope.resetFeedback();
                localStorage.removeItem('feedbackForm');
             }else{
               alert(JSON.stringify(data));
             }

           }).
           error(function(data, status, headers, config) {
             alert('Problem with connection to webservice:'+data);
           });


           }
     }

     $scope.$watch('feedback', function() { saveForm(); }, true);
     $scope.$watch('feedback_form', function(theForm) {
       if(theForm) {
         if (!loadedData) {
           loadedData = true;
           loadForm();
           $scope.feedback_form.$setDirty();
        }
       }
     });

     function saveForm() {
       if (supportsHTML5Storage() && loadedData) {
         var formData = JSON.stringify($scope.feedback);
         localStorage.setItem("feedbackForm", formData);
       }
     };

     function loadForm() {
       if (supportsHTML5Storage()) {
         var formData = JSON.parse(localStorage.getItem('feedbackForm'));
         $scope.feedback = formData;
       }
     };

     function supportsHTML5Storage() {
       try {
         return 'localStorage' in window && window['localStorage'] !== null;
       } catch (e) {
         return false;
       }
     }


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNHelpController', [
    '$scope','$http',
    function($scope, $http) {

      $scope.setTitle("49's - Help");


        $scope.selectedIndex = -1;

        $scope.showIndex = function(index) {
            if (index == $scope.selectedIndex) {
                $scope.selectedIndex = -1;
            } else {
                $scope.selectedIndex = index;
            }
        };


        function getFAQs() {
          $.ajax({
            url: $scope.baseURL+'/help/faqs',
            type: 'get',
            dataType: 'json',
            beforeSend: function() {
            },
            complete: function() {
            },
            success: loadFAQs,
            error: function(){
              // // alert('Connection error! Please try again.');
              console.log("error");
            }
          });
        }

        function loadFAQs(json) {
          if(json.body.faqs.length>0){
            $scope.FAQs = json.body.faqs;
            $scope.$apply();
    				// $.each(json.body.faqs, function(i,obj) {
            //
            // });
          }
        }

        getFAQs();

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNHomeController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's");

 setTimeout(function(){
  		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
    },500);
      
      
     

		function handleData(json) {
			
			
			    
			if(json.body.home.home.length>0){
				$.each(json.body.home.home, function(i,obj) {
					var slide='';
					
					
					
					
					try{
						if(json.body.home.home.length>1){
							$(".carousel-indicators").append('<li data-target="#homeCarousel" data-slide-to="'+i+'"></li>');
						}
						//alert(this.url);
						if(this.video_url != null && this.video_url.length > 0 && this.url=='') {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:159px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();}
							else{
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
							}
						$(".carousel-inner").append(slide);
					}catch(e){}
				});
				$(".carousel-indicators li:first").addClass("active");
				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
				
				$('.carousel').carousel({ interval: 3000 });
			}

			//add promo images
			if(json.body.promo.is_promo_home.length>0){
		        var banner='';
				$.each(json.body.promo.is_promo_home, function(i,obj) {
					try{
						if(obj.video_url!=null && obj.video_url.length>0 && obj.url==''){
							banner='<div class="fn-promo-section">';
							banner+='<a class="miss_smil" data-toggle="modal" data-target="#videoModalmiss" ng-click="playMainVideo()">';
							banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
							banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
						$('video#how_to_play_videonew source').attr('src', obj.video_url);
							$("video#how_to_play_videonew")[0].load();
						}
							
							}
						else{
						banner='<div class="fn-promo-section">';
						if(obj.url!=''){
							banner+='<a href="'+obj.url+'">';
						}else{
							banner+='<a href="">';
						}
						banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
						}
						banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
						}
					}catch(e){}
					 $(".fn-promo-container").append(banner);
				});
			}
		}
		
			 /*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});
		
		$(document).on('show.bs.modal','#videoModalmiss', function () {
         $('#how_to_play_videonew').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModalmiss', function () {
         $('#how_to_play_videonew').trigger("pause");
  });
    }]

);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNLegalController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's - Legal");

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNMobileAppController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's - Mobile App");

      $.ajax({
        url: $scope.baseURL+'/img/get_image_urls',
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
        },
        complete: function() {
        },
        success: handleSliderData,
        error: function(){
          // alert('Connection error! Please try again.');
        }
      });
      function handleSliderData(json) {
			if(json.body.promo.is_mobile.length>0){
 				$.each(json.body.promo.is_mobile, function(i,obj) {
 					var slide='';
					try{
						if(json.body.promo.is_mobile.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s mobile app" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
      }

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNOracleController', [
    '$scope','$http',
    function($scope,$http) {

      $scope.setTitle("49's - The Fount");

      var chosenHorse = false;
      var horseNames = [];

      var chosenDog = false;
      var dogNames = [];


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.home.oracle.length>0){
 				$.each(json.body.home.oracle, function(i,obj) {
 					var slide='';
					try{
						if(json.body.home.oracle.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s the fount" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

		/* oracle top page colors replaceing */
		$('.oracle-product-picker li').on('click', function () {
	        $('#oracle_title').css('background-color',$(this).css("background-color"));
	        $('#oracle_title h2').css('color',$(this).css("color"));

	        var projIndex = $(this).index();

	        if(projIndex==0){ $('#oracle_motto p').html("It's as easy as 1,2,3 to find all the statistics behind the 49's balls.<br/>&nbsp;");}
	        if(projIndex==1){ $('#oracle_motto p').html("It's as easy as 1,2,3 to find all the statistics behind the Irish Lotto Bet balls.<br/>&nbsp;");}
	        if(projIndex==2){ $('#oracle_motto p').html("It's as easy as 1,2,3 to find all the statistics behind the VHR.<br/>&nbsp;");}
	        if(projIndex==3){ $('#oracle_motto p').html("It's as easy as 1,2,3 to find all the statistics behind the VGR.<br/>&nbsp;");}
	        if(projIndex==4){ $('#oracle_motto p').html("It's as easy as 1,2,3 to find all the statistics behind the Rapido numbers.<br/>&nbsp;");}

	    })




		/* 49s oracle scripts */
      $scope.numberArray = new Array(49);

      var selectedBalls = [];

      $scope.selectBall = function(ball_nb) {
    	   if($( 'div[ data=' + ball_nb + ']' ).hasClass( 'fn-ball-fade' )){
    		   $( 'div[ data=' + ball_nb + ']' ).removeClass( 'fn-ball-fade' )
    		   var index = selectedBalls.indexOf(ball_nb);
    		   //alert(index);
    		   if (index > -1) {
    			   selectedBalls.splice(index, 1);
    			}
    	   }else{
    		   	if(selectedBalls.length>=5){
    		   		alert('Limit of max. 5 selected balls reached');
				}else{
					$( 'div[ data=' + ball_nb + ']' ).addClass( 'fn-ball-fade' );
		    		selectedBalls.push(ball_nb);
		    		//alert(selectedBalls);
				}
    	   }
      };

      //set calendars
      $('#fromField49s').datetimepicker({
          format: 'DD/MM/YYYY',
          inline: false,
          viewMode:'days',
          widgetPositioning:{
              		horizontal: 'auto',
              		vertical: 'bottom'
               }
      });

      $('#toField49s').datetimepicker({
          format: 'DD/MM/YYYY',
          inline: false,
          viewMode:'days',
          widgetPositioning:{
              		horizontal: 'auto',
              		vertical: 'bottom'
               }
      });

      //clear dates on quick select change
      $( "#quickSelect49" ).change(function() {
    	  $( "#fromField49s" ).val('');
    	  $( "#toField49s" ).val('');
      });
      //clear quick select on date change
	  $("#fromField49s").on("dp.change",function (e) {
	      $("#quickSelect49").val('');
	      $('#toField49s').data("DateTimePicker").minDate(e.date);
	  });
	  $("#toField49s").on("dp.change",function (e) {
	      $("#quickSelect49").val('');
	      $('#fromField49s').data("DateTimePicker").maxDate(e.date);
	  });

	  function getBallColor(num){
		  var index  = (num-1) % 7;
	      var colors = ["green","red","orange","yellow","brown","purple","blue"];
	      return colors[index];
	  }

      $scope.show49sStats = function() {
    	  var selectedBalls = [];
    	  var ballNumber=0;
    	  

    	  if ($(".fn-ball-fade")[0]){//check if balls selected
    		  //check if dates selected or quick selection
    		  if (  ($( "#fromField49s" ).val()!='' &&  $( "#toField49s" ).val()!='') ||  $( "#quickSelect49" ).val()!='' ){
    			  //check if lunchtime draw or teatime draw is selected
    			  if( $( "#lunchtimeDraw49" ).prop('checked') || $( "#teatimeDraw49" ).prop('checked') ){
      		  		$('.fn-ball-fade').each(function(i, obj) {
      		  			ballNumber= parseInt($(this).html());
    		  			selectedBalls.push(ballNumber);
    		  		});

    		  		$.ajax({
    		  			url: $scope.baseURL+'/oracle/oracle_49s',
    		  			type: 'post',
                                        contentType: "application/json; charset=utf-8",
    		  			dataType: 'json',
    		  			data:  JSON.stringify({"numbers":selectedBalls,"from":$( "#fromField49s" ).val(),"to": $( "#toField49s" ).val(),"quickSelect":$( "#quickSelect49" ).val(),"lunchtime":$( "#lunchtimeDraw49" ).prop('checked'),"teatime":$( "#teatimeDraw49" ).prop('checked')}),
    		  			beforeSend: function() {
    		  				$('#stats-container').css('display','none');
			  				$('.spinner').remove();
			  				$('.ask-oracle-btn').after('<div class="spinner" style="width:100%; text-align:center"><img src="../../img/icons/ajax_loader.gif"   style="width:50px;" id="main-spinner"/></div>');
    		  			},
    		  			complete: function() {
    		  				$('.spinner').remove();
    		  			},
    		  			success: function(json) {
    		  				$('.no-results-shape-49').remove();
    		  				//alert(JSON.stringify(data) );
    		  				if(json.body.numbers.length>0){
        		  				$('#stats-container').css('display','inline-block');
        		  				// try{ $('#total-draws').html(json.body.total_draws); }catch(e){}
        		  				try{ $('#draws-combinations').html(json.body.numbers_draws); }catch(e){}
        		  				try{ $('#possible-combinations').html(json.body.total_combination); }catch(e){}

        		  				$('.results-table-49s ul').css('display','none');
        		  				var list_width=(100/json.body.numbers.length);
        		  				$.each(json.body.numbers, function(i, obj) {
            		  				try{ $('.results-table-49s ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2) ').html(this.number); }catch(e){}
            		  				try{ $('.results-table-49s ul:nth-of-type('+(i+1)+') > li:nth-child(2)').html(this.main); }catch(e){}
            		  				try{ $('.results-table-49s ul:nth-of-type('+(i+1)+') > li:nth-child(3)').html(this.bonus); }catch(e){}
            		  				try{ $('.results-table-49s ul:nth-of-type('+(i+1)+') > li:nth-child(4)').html(this.number_total); }catch(e){}
            		  				$('.results-table-49s ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2) ').removeClass();
            		  				try{ $('.results-table-49s ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2)').addClass( 'fn-ball-'+getBallColor(this.number) ); }catch(e){}
        		  					$('.results-table-49s ul:nth-of-type('+(i+1)+')').css('display','inline-block');
        		  					$('.results-table-49s ul').css('min-width',''+list_width+'%');
        		  				});
        		  				//fill out combination table
        		  				$(".permutations-wrapper .permutations-container table tbody").empty();
        		  				var combinationLine='';
        		  				$.each(json.body.combinations, function(i, obj) {
        		  					combinationLine='<tr>';
        		  					combinationLine+='<td>'+(i+1)+'.</td>';
        		  					combinationLine+='<td>';
        		  					$.each(obj.numbers, function(i, obj) {
        		  						combinationLine+='<div class="fn-ball-permutation fn-ball-'+getBallColor(obj)+'">';
            		  					combinationLine+=obj;
            		  					combinationLine+='</div>';

        		  					});
        		  					combinationLine+='	</td>';
        		  					combinationLine+='	<td>'+obj.count+'</td>';
        		  					combinationLine+='</tr>';
    								$(".permutations-wrapper .permutations-container table tbody").append(combinationLine);
        		  				});
    		  				}else{
    		  					$('.no-results-shape-49').remove();
    		  					//if no results show no results box
    		  					$( "<div class='fn-product-shape container no-results-shape-49'><div class='no-results-notification'><p>NO RESULTS</p></div></div>" ).insertAfter( ".fn-orange-button" );
    		  				}
    		  			},
    		  			error: function(){
    		  				alert('error');
    		  				$('#stats-container').css('display','none');
    		  			}
    		  		});
    			  }else{
    				  alert('Please select at least one draw.');
    			  }
    		  }else{
    			  alert('Please select correct interval between dates or use quick selection tool.')
    		  }
    	  } else {
    		  alert('Please select balls.');
    	  }

    	  $('#show49sPermutations').html('SHOW PERMUTATIONS');
    	  $( ".permutations-wrapper" ).hide();
      }

      $scope.show49sPermutations = function(e) {
    	  $('#show49sPermutations').html($('#show49sPermutations').html() == 'SHOW PERMUTATIONS' ? 'HIDE PERMUTATIONS' : 'SHOW PERMUTATIONS');
    	  $( ".permutations-wrapper" ).toggle();
      }




		/* ILB oracle scripts */
      	$scope.ilbNumberArray = new Array(47);

      	var ilbSelectedBalls = [];

      	$scope.ilbSelectBall = function(ilb_ball_nb) {
      		if($( 'div[ data-ilb=' + ilb_ball_nb + ']' ).hasClass( 'ilb-fn-ball-fade' )){
      			$( 'div[ data-ilb=' + ilb_ball_nb + ']' ).removeClass( 'ilb-fn-ball-fade' )
      			var index = ilbSelectedBalls.indexOf(ilb_ball_nb);
      			//alert(index);
      			if (index > -1) {
      				ilbSelectedBalls.splice(index, 1);
      			}
      		}else{
      			if(ilbSelectedBalls.length>=5){
      				alert('Limit of max. 5 selected balls reached');
      			}else{
      				$( 'div[ data-ilb=' + ilb_ball_nb + ']' ).addClass( 'ilb-fn-ball-fade' );
      				ilbSelectedBalls.push(ilb_ball_nb);
		    		//alert(selectedBalls);
				}
      		}
      	};

      	//set calendars
      	$('#fromFieldILB').datetimepicker({
      		format: 'DD/MM/YYYY',
      		inline: false,
      		viewMode:'days',
      		widgetPositioning:{
              		horizontal: 'auto',
              		vertical: 'bottom'
               }
      	});

      	$('#toFieldILB').datetimepicker({
      		format: 'DD/MM/YYYY',
      		inline: false,
      		viewMode:'days',
      		widgetPositioning:{
              		horizontal: 'auto',
              		vertical: 'bottom'
               }
      	});
      	//clear dates on quick select change
      	$( "#quickSelectILB" ).change(function() {
      		$( "#fromFieldILB" ).val('');
      		$( "#toFieldILB" ).val('');
      	});
      	//clear quick select on date change
      	$("#fromFieldILB").on("dp.change",function (e) {
      		$("#quickSelectILB").val('');
      		$('#toFieldILB').data("DateTimePicker").minDate(e.date);
      	});
      	$("#toFieldILB").on("dp.change",function (e) {
      		$("#quickSelectILB").val('');
      		$('#fromFieldILB').data("DateTimePicker").maxDate(e.date);
      	});



        $scope.showILBStats = function() {
      	  var ilbSelectedBalls = [];
      	  var ilbBallNumber=0;
      	  if ($(".ilb-fn-ball-fade")[0]){//check if balls selected
      		  //check if dates selected or quick selection
      		  if (  ($( "#fromFieldILB" ).val()!='' &&  $( "#toFieldILB" ).val()!='') ||  $( "#quickSelectILB" ).val()!='' ){
      			  //check if lunchtime draw or teatime draw is selected
      			  if( $( "#mainDrawILB" ).prop('checked') || $( "#secondDrawILB" ).prop('checked') || $( "#thirdDrawILB" ).prop('checked') ){
        			$('.ilb-fn-ball-fade').each(function(i, obj) {
        				ilbBallNumber= parseInt($(this).html());
        				ilbSelectedBalls.push(ilbBallNumber);
    		  		});

      		  		$.ajax({
      		  			url: $scope.baseURL+'/oracle/oracle_ILB',
      		  			type: 'post',
                                        contentType: "application/json; charset=utf-8",
      		  			dataType: 'json',
      		  			data:  JSON.stringify({"numbers":ilbSelectedBalls,"from":$( "#fromFieldILB" ).val(),"to": $( "#toFieldILB" ).val(),"quickSelect":$( "#quickSelectILB" ).val(),"main_draw":$( "#mainDrawILB" ).prop('checked'),"second_draw":$( "#secondDrawILB" ).prop('checked'),"third_draw":$( "#thirdDrawILB" ).prop('checked')}),
      		  			beforeSend: function() {
      		  				$('#ilb-stats-container').css('display','none');
			  				$('.spinner').remove();
			  				$('.ask-oracle-btn').after('<div class="spinner" style="width:100%; text-align:center"><img src="../../img/icons/ajax_loader.gif"   style="width:50px;" id="main-spinner"/></div>');
      		  			},
      		  			complete: function() {
      		  				$('.spinner').remove();
      		  			},
      		  			success: function(json) {
	      		  			$('.no-results-shape-ilb').remove();
			  				//alert(JSON.stringify(data) );
			  				if(json.body.numbers.length>0){
	    		  				$('#ilb-stats-container').css('display','inline-block');
	    		  				// $('#ilb-total-draws').html(json.body.total_draws);
	    		  				$('#ilb-draws-combinations').html(json.body.numbers_draws);
	    		  				$('#ilb-possible-combinations').html(json.body.total_combination);
	    		  				$('.results-table-ilb ul').css('display','none');
	    		  				var ilb_list_width=(100/json.body.numbers.length);

	    		  				$.each(json.body.numbers, function(i, obj) {
	    		  					//alert(JSON.stringify(this) );
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2) ').html(this.number);
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+') > li:nth-child(2)').html(this.main);
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+') > li:nth-child(3)').html(this.bonus);
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+') > li:nth-child(4)').html(this.number_total);
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2)').removeClass();
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2)').addClass( 'fn-ball-green' );
	    		  					$('.results-table-ilb ul:nth-of-type('+(i+1)+')').css('display','inline-block');
	    		  					$('.results-table-ilb ul').css('min-width',''+ilb_list_width+'%');
	    		  				});

	    		  				//fill out combination table
	    		  				$(".ilb-permutations-wrapper .permutations-container table tbody").empty();
	    		  				var combinationLine='';
	    		  				$.each(json.body.combinations, function(i, obj) {
	    		  					combinationLine='<tr>';
	    		  					combinationLine+='<td>'+(i+1)+'.</td>';
	    		  					combinationLine+='<td>';
	    		  					$.each(obj.numbers, function(i, obj) {
	    		  						combinationLine+='<div class="fn-ball-permutation fn-ball-green">';
	        		  					combinationLine+=obj;
	        		  					combinationLine+='</div>';
	    		  					});
	    		  					combinationLine+='	</td>';
	    		  					combinationLine+='	<td>'+obj.count+'</td>';
	    		  					combinationLine+='</tr>';
									$(".ilb-permutations-wrapper .permutations-container table tbody").append(combinationLine);
	    		  				});
			  				}else{
    		  					$('.no-results-shape-ilb').remove();
    		  					//if no results show no results box
    		  					$( "<div class='fn-product-shape container no-results-shape-ilb'><div class='no-results-notification'><p>NO RESULTS</p></div></div>" ).insertAfter( ".fn-green-button" );
    		  				}
      		  			},
      		  			error: function(){
      		  				alert('error');
      		  				$('#ilb-stats-container').css('display','none');
      		  			}
      		  		});
      			  }else{
      				  alert('Please select at least one draw');
      			  }
      		  }else{
      			  alert('Please select correct interval between dates or use quick selection tool.')
      		  }
      	  } else {
      		  alert('Please select balls.');
      	  }

      	  $('#showILBPermutations').html('SHOW PERMUTATIONS');
		  $( ".ilb-permutations-wrapper" ).hide();

        }


        $scope.showILBPermutations = function(e) {
        	$('#showILBPermutations').html($('#showILBPermutations').html() == 'SHOW PERMUTATIONS' ? 'HIDE PERMUTATIONS' : 'SHOW PERMUTATIONS');
        	$( ".ilb-permutations-wrapper" ).toggle();
        }








        /* VHR oracle scripts */
        //set calendars
        $('#fromFieldVHR').datetimepicker({
            format: 'DD/MM/YYYY',
            inline: false,
            viewMode:'days',
            widgetPositioning:{
                		horizontal: 'auto',
                		vertical: 'bottom'
                 }
        });
        $('#toFieldVHR').datetimepicker({
            format: 'DD/MM/YYYY',
            inline: false,
            viewMode:'days',
            widgetPositioning:{
                		horizontal: 'auto',
                		vertical: 'bottom'
                 }
        });
        //clear dates on quick select change
        $( "#quickSelectVHR" ).change(function() {
      	  	$( "#fromFieldVHR" ).val('');
      	  	$( "#toFieldVHR" ).val('');
        });
        //clear quick select on date change
        $("#fromFieldVHR").on("dp.change",function (e) {
  	      	$("#quickSelectVHR").val('');
  	      	$('#toFieldVHR').data("DateTimePicker").minDate(e.date);
        });
        $("#toFieldVHR").on("dp.change",function (e) {
  	      	$("#quickSelectVHR").val('');
  	      	$('#fromFieldVHR').data("DateTimePicker").maxDate(e.date);
        });
        $("#horse_names_results").delegate("a", "click", function(e){
            $('#nameVHR').val($(this).html());
            chosenHorse = true;
    		$("#horse_names_results").empty();
    		$("#horse_names_results").css('display','none');
        });

        $scope.getHorseNames = function() {
          chosenHorse = false;
        	if($scope.horse_name!=""){
    	    	$http.post($scope.baseURL+'/oracle/get_names', {"game_type":"vhr","name": $('#nameVHR').val()}).
    			success(function(data, status, headers, config) {
    				if(data.server_obj.success){
    					$("#horse_names_results").empty();
    					$("#horse_names_results").css('display','none');
              horseNames = data.body.names;
    					$.each(data.body.names, function(i,obj) {
    						$("#horse_names_results").append("<li><a class='set_horse_name'>"+obj.name+"</a></li>");
    						$("#horse_names_results").css('display','block');
    					});
    				}
    			}).
    			error(function(data, status, headers, config) {
    				alert('Problem with service '+data);
    			});
        	}else{
        		$("#horse_names_results").empty();
        		$("#horse_names_results").css('display','none');
        	}
        }

        $scope.showVHRStats = function() {
        	if (  ($( "#fromFieldVHR" ).val()!='' &&  $( "#toFieldVHR" ).val()!='') ||  $( "#quickSelectVHR" ).val()!='' ){
        		if($( "#nameVHR" ).val()!='') {
              var horseName = $( "#nameVHR" ).val();
           
              $("#horse_names_results").empty();
              $("#horse_names_results").css('display','none');
					$.ajax({
			  			url: $scope.baseURL+'/oracle/oracle_vhr',
			  			type: 'post',
                                        contentType: "application/json; charset=utf-8",
			  			dataType: 'json',
			  			data:  JSON.stringify({"name":horseName,"from":$( "#fromFieldVHR" ).val(),"to": $( "#toFieldVHR" ).val(),"quickSelect":$( "#quickSelectVHR" ).val()}),
			  			beforeSend: function() {
			  				$('.noRacesFound').remove();
			  				$('#virtual-horse-summary').css('display','none');
			  				$('#virtual-horse-breakdown-container').css('display','none');
			  				$('.spinner').remove();
			  				$('.ask-oracle-btn').after('<div class="spinner" style="width:100%; text-align:center"><img src="../../img/icons/ajax_loader.gif"   style="width:50px;" id="main-spinner"/></div>');
			  			},
			  			complete: function() {
			  				//alert('complete');
			  				$('.spinner').remove();  
			  			},
			  			success: function(json) {
			  				if(json.body.total_races=='0'){
			  					$('.vhr-button').after('<div class="noRacesFound" style="width:100%; text-align:center"><h3>No results found for selected period.</h3></div>');
			  				}else{
			  				
				  				function getPositionAppending(position){
				  					if(position==null){
				  						return '';
				  					}else if(position=='1'){
				  						return position+'<sup>st</sup>';
				  					}else if(position=='2'){
				  						return position+'<sup>nd</sup>';
				  					}else if(position=='3'){
				  						return position+'<sup>rd</sup>';
				  					}else{
				  						return position+'<sup>th</sup>';
				  					}
				  				}
	
				  				try{ $('#horse-title h2').html(json.body.last_race.name); }catch(e){}
				                if (json.body.last_race.location.toUpperCase() === "SPRINTVALLEY") {
				                    json.body.last_race.location = "SPRINT VALLEY";
				                }
				  				try{ $('#last-race-location').html(json.body.last_race.location); }catch(e){}
				  				try{
				  					if(json.body.last_race.position!=null){
				  						$('#last-race-position').html(getPositionAppending(json.body.last_race.position));
				  						$('#vhr-not-placed').hide();
				  						$('#last-race-position').show();
				  					}else{
				  						$('#vhr-not-placed').show();
				  						$('#last-race-position').hide();
				  					}
				  				}catch(e){}
				  				try{
				  					var lastDate = new Date(json.body.last_race.date);
				  					$('.last-race > div > p:nth-of-type(3)').html((json.body.last_race.time).substring(0, (json.body.last_race.time).length - 3)+' - '+("0" + lastDate.getDate()).slice(-2)  + "/" +("0" + (lastDate.getMonth() + 1)).slice(-2) + "/" + lastDate.getFullYear());
				  				}catch(e){}
	
				  				try{ $('.vhr-last-racing-odds span').html(json.body.last_race.fract); }catch(e){}
				  				try{ $('.horse-results ul:nth-of-type(3) li:nth-child(5)').html(json.body.total_races); }catch(e){}
	
				  				var foundPlaces = [];
				  				$.each(json.body.places, function(i, obj) {
				  					if(obj.position != null){
				  						foundPlaces.push(obj.position);
				  						try{ $('.horse-results ul:nth-of-type(3) li:nth-child('+obj.position+')').html(obj.times); }catch(e){}
				  					}
					  			});
	
				                for (var i=1;i<5;i++) {
				                  if($.inArray(i, foundPlaces) === -1) {
				                    try{ $('.horse-results ul:nth-of-type(3) li:nth-child('+i+')').html('0'); }catch(e){}
				                  }
				                }
	
						  		$("#virtual-horse-summary").css('display','block');
						  		$(".vhr-results-table-body table").empty();
						  		var breakdownLine='';
						  		$.each(json.body.races, function(i, obj) {
	
							  		if (obj.location.toUpperCase() === "SPRINTVALLEY") {
							  			obj.location = "SPRINT VALLEY";
							  		}
	
						  			breakdownLine="<tr><td>";
						  			var date = new Date(obj.date);
						  			breakdownLine+= ("0" + date.getDate()).slice(-2)  + "/" +("0" + (date.getMonth() + 1)).slice(-2) + "/" + date.getFullYear();
						  			breakdownLine+="</td><td>"+obj.location.toUpperCase()+"</td><td>";
						  			breakdownLine+=(obj.time).substring(0, (obj.time).length - 3);
						  			breakdownLine+="</td><td>";
						  			if(obj.position != null){
						  				breakdownLine+=obj.position;
						  			} else {
						  				breakdownLine += 'Not Placed';
						  			}
						  			breakdownLine+="</td><td>"+obj.runner_number+"</td><td>";
						  			if(obj.fract != null){
						  				breakdownLine+=obj.fract;
						  			}
						  			breakdownLine+="</td><td>";
						  			if(obj.fav != null){
						  				breakdownLine+=obj.fav;
						  			}
						  			breakdownLine+="</td></tr>";
	
						  			$(".vhr-results-table-body table").append(breakdownLine);
					  			});
						  		$("#virtual-horse-breakdown-container").css('display','block');
			  				}
			  			},
			  			error: function(){
			  				$("#virtual-horse-summary").css('display','none');
			  				$("#virtual-horse-breakdown-container").css('display','none');
			  			}
			  		});
        		}else{
        			alert('Please add horse name.')
        		}
    	  	}else{
    	  		alert('Please select correct interval between dates or use quick selection tool.')
    	  	}
        }




        /* VGR oracle scripts */

        //set calendars
        $('#fromFieldVGR').datetimepicker({
            format: 'DD/MM/YYYY',
            inline: false,
            viewMode:'days',
            widgetPositioning:{
                		horizontal: 'auto',
                		vertical: 'bottom'
                 }
        });

        $('#toFieldVGR').datetimepicker({
            format: 'DD/MM/YYYY',
            inline: false,
            viewMode:'days',
            widgetPositioning:{
                		horizontal: 'auto',
                		vertical: 'bottom'
                 }
        });

        //clear dates on quick select change
        $( "#quickSelectVGR" ).change(function() {
      	  	$( "#fromFieldVGR" ).val('');
      	  	$( "#toFieldVGR" ).val('');
        });
        //clear quick select on date change
        $("#fromFieldVGR").on("dp.change",function (e) {
  	      	$("#quickSelectVGR").val('');
  	      	$('#toFieldVGR').data("DateTimePicker").minDate(e.date);
        });
        $("#toFieldVGR").on("dp.change",function (e) {
  	      	$("#quickSelectVGR").val('');
  	      	$('#fromFieldVGR').data("DateTimePicker").maxDate(e.date);
        });

        $("#dog_names_results").delegate("a", "click", function(e){
            $('#nameVGR').val($(this).html());
            chosenDog = true;
    		$("#dog_names_results").empty();
    		$("#dog_names_results").css('display','none');
        });

        $scope.getDogNames = function() {
          chosenDog = false;
        	if($scope.dog_name!=""){
    	    	$http.post($scope.baseURL+'/oracle/get_names', {"game_type":"vgr","name": $( "#nameVGR" ).val()}).
    			success(function(data, status, headers, config) {
    				if(data.server_obj.success){
    					$("#dog_names_results").empty();
    					$("#dog_names_results").css('display','none');
              dogNames = data.body.names;
    					$.each(data.body.names, function(i,obj) {
    						$("#dog_names_results").append("<li><a class='set_horse_name'>"+obj.name+"</a></li>");
    						$("#dog_names_results").css('display','block');
    					});
    				}
    			}).
    			error(function(data, status, headers, config) {
    				alert('Problem with service '+data);
    			});
        	}else{
        		$("#dog_names_results").empty();
        		$("#dog_names_results").css('display','none');
        	}
        }
        $scope.showVGRStats = function() {
        	if (  ($( "#fromFieldVGR" ).val()!='' &&  $( "#toFieldVGR" ).val()!='') ||  $( "#quickSelectVGR" ).val()!='' ){
        		if($( "#nameVGR" ).val()!=''){
              var dogName = $( "#nameVGR" ).val();
            
              $("#dog_names_results").empty();
          		$("#dog_names_results").css('display','none');
					$.ajax({
			  			url: $scope.baseURL+'/oracle/oracle_vgr',
			  			type: 'post',
                                        contentType: "application/json; charset=utf-8",
			  			dataType: 'json',
			  			data:  JSON.stringify({"name":dogName,"from":$( "#fromFieldVGR" ).val(),"to": $( "#toFieldVGR" ).val(),"quickSelect":$( "#quickSelectVGR" ).val()}),
			  			beforeSend: function() {
			  				$('.noRacesFound').remove();
			  				$('#virtual-dog-summary').css('display','none');
			  				$('#virtual-dog-breakdown-container').css('display','none');
			  				$('.spinner').remove();
			  				$('.ask-oracle-btn').after('<div class="spinner" style="width:100%; text-align:center"><img src="../../img/icons/ajax_loader.gif"   style="width:50px;" id="main-spinner"/></div>');
			  			},
			  			complete: function() {
			  				$('.spinner').remove();
			  			},
			  			success: function(json) {
			  				
			  				if(json.body.total_races=='0'){
			  					$('.vgr-button').after('<div class="noRacesFound" style="width:100%; text-align:center"><h3>No results found for selected period.</h3></div>');
			  				}else{
				  				function getPositionAppending(position){
				  					if(position==null){
				  						return '';
				  					}else if(position=='1'){
				  						return position+'<sup>st</sup>';
				  					}else if(position=='2'){
				  						return position+'<sup>nd</sup>';
				  					}else if(position=='3'){
				  						return position+'<sup>rd</sup>';
				  					}else{
				  						return position+'<sup>th</sup>';
				  					}
				  				}
				  				try{ $('#dog-title h2').html(json.body.last_race.name); }catch(e){}
	
				  				try{ $('#vgr-last-race-location').html(json.body.last_race.location); }catch(e){}
				  				try{
				  					if(json.body.last_race.position!=null){
				  						$('#vgr-last-race-position').html(getPositionAppending(json.body.last_race.position));
				  							$('#vgr-not-placed').hide();
				  						$('#vgr-last-race-position').show();
				  					}else{
				  						$('#vgr-not-placed').show();
				  						$('#vgr-last-race-position').hide();
				  					}
				  				}catch(e){}
				  				try{
				  					var lastDate = new Date(json.body.last_race.date);
				  					$('.last-race > div > p:nth-of-type(3)').html((json.body.last_race.time).substring(0, (json.body.last_race.time).length - 3)+' - '+("0" + lastDate.getDate()).slice(-2)  + "/" +("0" + (lastDate.getMonth() + 1)).slice(-2) + "/" + lastDate.getFullYear());
				  				}catch(e){}
	
				  				var foundPlaces = [];
				  				$.each(json.body.places, function(i, obj) {
				  					if(obj.position != null){
				  						foundPlaces.push(obj.position);
				  						try{ $('.dog-results ul:nth-of-type(3) li:nth-child('+obj.position+')').html(obj.times); }catch(e){}
				  						try{ $('.dog-results ul:nth-of-type(1) li:nth-child('+obj.position+') .fn-vgr-racing-place').html(getPositionAppending(obj.position)); }catch(e){}
				  					}
					  			});
	
				                for (var i=1;i<5;i++) {
				                  if($.inArray(i, foundPlaces) === -1) {
				                    try{ $('.dog-results ul:nth-of-type(3) li:nth-child('+i+')').html('0'); }catch(e){}
				                    try{ $('.dog-results ul:nth-of-type(1) li:nth-child('+i+') .fn-vgr-racing-place').html(getPositionAppending(i)); }catch(e){}
				                  }
				                }
	
				    			try{ $('.vgr-last-racing-odds span').html(json.body.last_race.fract); }catch(e){}
				  				try{ $('.dog-results ul:nth-of-type(3) li:nth-child(4)').html(json.body.total_races);  }catch(e){}
	
	
						  		$("#virtual-dog-summary").css('display','block');
						  		$(".vgr-results-table-body table").empty();
						  		var breakdownLine='';
						  		$.each(json.body.races, function(i, obj) {
						  			breakdownLine="<tr><td>";
						  			var date = new Date(obj.date);
						  			breakdownLine+= ("0" + date.getDate()).slice(-2)  + "/" +("0" + (date.getMonth() + 1)).slice(-2) + "/" + date.getFullYear();
						  			breakdownLine+="</td><td>"+obj.location.toUpperCase()+"</td><td>";
						  			breakdownLine+=(obj.time).substring(0, (obj.time).length - 3);
						  			breakdownLine+="</td><td>";
						  			if(obj.position != null){
						  				breakdownLine+=obj.position;
						  			} else {
						  				breakdownLine+= "Not Placed";
						  			}
						  			breakdownLine+="</td><td>"+obj.runner_number+"</td><td>";
						  			if(obj.fract != null){
						  				breakdownLine+=obj.fract;
						  			}
	
						  			breakdownLine+="</td><td>";
						  			if(obj.fav != null){
						  				breakdownLine+=obj.fav;
						  			}
	
						  			breakdownLine+="</td></tr>";
	
						  			$(".vgr-results-table-body table").append(breakdownLine);
					  			});
						  		$("#virtual-dog-breakdown-container").css('display','block');
			  				}
			  			},
			  			error: function(){
			  				$("#virtual-dog-summary").css('display','none');
			  				$("#virtual-dog-breakdown-container").css('display','none');
			  			}
			  		});
        		}else{
        			alert('Please add greyhound name.')
        		}
    	  	}else{
    	  		alert('Please select correct interval between dates or use quick selection tool.')
    	  	}
        }










		/* rapido oracle scripts */
      	$scope.rapidoNumberArray = new Array(80);
      	var rapidoSelectedBalls = [];
    	$scope.getCoinColor = function(num) {
			var colors = '';
			if (num>40){
				colors='black';
			}else{
				colors='red';
			}
	        return colors;
      	};
      	$scope.rapidoSelectBall = function(rapido_coin_nb) {
      		if($( 'div[ data-rapido=' + rapido_coin_nb + ']' ).hasClass( 'rapido-fn-ball-fade' )){
      			$( 'div[ data-rapido=' + rapido_coin_nb + ']' ).removeClass( 'rapido-fn-ball-fade' )
      			var index = rapidoSelectedBalls.indexOf(rapido_coin_nb);
      			//alert(index);
      			if (index > -1) {
      				rapidoSelectedBalls.splice(index, 1);
      			}
      		}else{
      			if(rapidoSelectedBalls.length>=10){
      				alert('Limit of max. 10 selected numbers reached');
      			}else{
      				$( 'div[ data-rapido=' + rapido_coin_nb + ']' ).addClass( 'rapido-fn-ball-fade' );
      				rapidoSelectedBalls.push(rapido_coin_nb);
		    		//alert(selectedBalls);
				}
      		}
      	};
      	//set calendars
      	$('#fromFieldRapido').datetimepicker({
      		format: 'DD/MM/YYYY',
      		inline: false,
      		viewMode:'days',
      		widgetPositioning:{
              		horizontal: 'auto',
              		vertical: 'bottom'
               }
      	});
      	$('#toFieldRapido').datetimepicker({
      		format: 'DD/MM/YYYY',
      		inline: false,
      		viewMode:'days',
      		widgetPositioning:{
              		horizontal: 'auto',
              		vertical: 'bottom'
               }
      	});
      	//clear dates on quick select change
      	$( "#quickSelectRapido" ).change(function() {
      		$( "#fromFieldRapido" ).val('');
      		$( "#toFieldRapido" ).val('');
      	});
      	//clear quick select on date change
      	$("#fromFieldRapido").on("dp.change",function (e) {
      		$("#quickSelectRapido").val('');
      		$('#toFieldRapido').data("DateTimePicker").minDate(e.date);
      	});
      	$("#toFieldRapido").on("dp.change",function (e) {
      		$("#quickSelectRapido").val('');
      		$('#fromFieldRapido').data("DateTimePicker").maxDate(e.date);
      	});
        $scope.showRapidoStats = function() {
        	  var rapidoSelectedBalls = [];
        	  var rapidoBallNumber=0;
        	  if ($(".rapido-fn-ball-fade")[0]){//check if balls selected
        		  //check if dates selected or quick selection
        		  if (  ($( "#fromFieldRapido" ).val()!='' &&  $( "#toFieldRapido" ).val()!='') ||  $( "#quickSelectRapido" ).val()!='' ){
        			  //check if lunchtime draw or teatime draw is selected
        			  // if( $( "#heads" ).prop('checked') || $( "#tails" ).prop('checked') || $( "#level" ).prop('checked')){
        				  $('.rapido-fn-ball-fade').each(function(i, obj) {
        					  rapidoBallNumber= parseInt($(this).html());
        					  rapidoSelectedBalls.push(rapidoBallNumber);
        				  });

        				  $.ajax({
        		  			url: $scope.baseURL+'/oracle/oracle_rapido',
        		  			type: 'post',
                                        contentType: "application/json; charset=utf-8",
        		  			dataType: 'json',
        		  			data:  JSON.stringify({"numbers":rapidoSelectedBalls,"from":$( "#fromFieldRapido" ).val(),"to": $( "#toFieldRapido" ).val(),"quickSelect":$( "#quickSelectRapido" ).val(),"heads":true,"tails":true ,"level":true  }),
        		  			beforeSend: function() {
        		  				$('#rapido-stats-container').css('display','none');
    			  				$('.spinner').remove();
    			  				$('.ask-oracle-btn').after('<div class="spinner" style="width:100%; text-align:center"><img src="../../img/icons/ajax_loader.gif"   style="width:50px;" id="main-spinner"/></div>');
        		  			},
        		  			complete: function() {
        		  				$('.spinner').remove();
        		  			},
        		  			success: function(json) {
    			  				
    	      		  			$('.no-results-shape-rapido').remove();
    			  				//alert(JSON.stringify(data) );
    			  				if(json.body.numbers.length>0){
		      		  				$('#rapido-stats-container').css('display','inline-block');
		      		  				// $('#rapido-total-draws').html(json.body.total_draws);
		      		  				$('#rapido-draws-combinations').html(json.body.numbers_draws);
		      		  				// $('#rapido-possible-combinations').html(json.body.total_combination);

		      		  				$('.results-table-rapido ul').css('display','none');
		      		  				$('.results-table-rapido2 ul').css('display','none');

		      		  				var list_width=20;
		      		  				var list_width2=20;

		      		  				if(json.body.numbers.length<=5){
		      		  					$('.results-table-rapido2 ul').css('display','none');

		      		  					list_width=(100/json.body.numbers.length);
		      		  				}else{
		      		  					list_width=20;
		      		  					list_width2=(100/(json.body.numbers.length-5));
		      		  				}
		      		  				$.each(json.body.numbers, function(i, obj) {
		      		  					if(i<5){
			      		  					$('.results-table-rapido ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2) ').html(this.number);
			      		  					$('.results-table-rapido ul:nth-of-type('+(i+1)+') > li:nth-child(2)').html(this.number_total);
			      		  					$('.results-table-rapido ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2) ').removeClass();
			      		  					$('.results-table-rapido ul:nth-of-type('+(i+1)+') > li > div > div:nth-of-type(2)').addClass( 'fn-coin-'+$scope.getCoinColor(this.number) );
			      		  					$('.results-table-rapido ul:nth-of-type('+(i+1)+')').css('display','inline-block');
			      		  					$('.results-table-rapido ul').css('min-width',''+list_width+'%');
		      		  					}
		      		  					if(i>=5){
			      		  					//second line
		      		  						$('.rapido-legend-second').css('display','inline-block');
			      		  					$('.results-table-rapido2 ul:nth-of-type('+(i-4)+') > li > div > div:nth-of-type(2) ').html(this.number);
			      		  					$('.results-table-rapido2 ul:nth-of-type('+(i-4)+') > li:nth-child(2)').html(this.number_total);
			      		  					$('.results-table-rapido2 ul:nth-of-type('+(i-4)+') > li > div > div:nth-of-type(2) ').removeClass();
			      		  					$('.results-table-rapido2 ul:nth-of-type('+(i-4)+') > li > div > div:nth-of-type(2)').addClass( 'fn-coin-'+$scope.getCoinColor(this.number) );
			      		  					$('.results-table-rapido2 ul:nth-of-type('+(i-4)+')').css('display','inline-block');
			      		  					$('.results-table-rapido2 ul').css('min-width',''+list_width2+'%');
		      		  					}else{
		      		  						$('.rapido-legend-second').css('display','none');
		      		  					}
		      		  				});
    			  				}else{
	    		  					$('.no-results-shape-rapido').remove();
	    		  					//if no results show no results box
	    		  					$( "<div class='fn-product-shape container no-results-shape-rapido'><div class='no-results-notification'><p>NO RESULTS</p></div></div>" ).insertAfter( ".fn-rapido-red-button" );
	    		  				}
        		  			},
        		  			error: function(){
        		  				alert('error');
        		  				$('#rapido-stats-container').css('display','none');
        		  			}
        		  		});
        			  // }else{
        				//   alert('Please select at least one draw');
        			  // }
        		  }else{
        			  alert('Please select correct interval between dates or use quick selection tool.')
        		  }
        	  } else {
        		  alert('Please select numbers.');
        	  }
          }



    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNResponsibleController', [
    '$scope',
    function($scope) {

      $scope.setTitle("49's - Responsible Gambling");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.home.responsible.length>0){
 				$.each(json.body.home.responsible, function(i,obj) {
 					var slide='';
					try{
						if(json.body.home.responsible.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s the fount" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

        $scope.navigationOptions = [
            {
                id: "williamhill",
                cls: "fn-promo-section1"
            },
            {
                id: "coral",
                cls: "fn-promo-section2"
            },
            {
                id: "ladbrokes",
                cls: "fn-promo-section3"
            }
        ];


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNStayInTouchController', [
    '$scope','$http',
    function($scope,$http) {

      $scope.setTitle("49's - Stay in Touch");

    	$scope.registrationThankYou=true;

        $scope.services = [
   	                    {GenderID: 1, GenderName: 'Male'},
   	                    {GenderID: 2, GenderName: 'Female'}
   	                  ];

        $scope.onCheckBoxSelected=function(){
            var flag=false;
            for(var key in $scope.register.selectedOptions){
                console.log('Key -' +key +' val- '+$scope.register.selectedOptions[key]);
                if($scope.register.selectedOptions[key]){
                    flag=true;
                }
            }
            if(!flag){
            	$scope.register.selectedOptions=false;
            }
        };

     	$scope.registerForm = function() {

    		if ($scope.register_form.$pristine) {
      	    	//alert('Please fill out the form.');
      	    } else if($scope.register_form.$invalid){
      	    	//alert('Please correct form.');
      	    }else if (!$scope.register.selectedOptions){
      	    	alert('At least one played game needs to be selected.');
      	    }else if($scope.register_form.$valid){
      	    	//alert('All good');


	    		//prep gender format
	      	    if($scope.register.gender==1){
	      	    	$scope.prepgender='M';
	      	    }else{
	      	    	$scope.prepgender='F';
	      	    }
	      	    //prep data for games
	      	    if($scope.register.selectedOptions.first){ plays49s="1"; }else{ plays49s="0"; }
	      	    if($scope.register.selectedOptions.second){ playsILB="1"; }else{ playsILB="0"; }
	      	    if($scope.register.selectedOptions.third){ playsVHR="1"; }else{ playsVHR="0"; }
	      	    if($scope.register.selectedOptions.fourth){ playsVGR="1"; }else{ playsVGR="0"; }
	      	    if($scope.register.selectedOptions.fifth){ playsRapido="1"; }else{ playsRapido="0"; }



    			$http.post($scope.baseURL+'/auth/register', {
                                        'firstName':$scope.register.name,
    																		'surname':$scope.register.surname,
    																		'email':$scope.register.email,
    																		'postcode': $scope.register.postcode,
    																		'age':$scope.register.age,
    																		'gender':$scope.prepgender,
    																		'sendPromotions':$scope.register.sendPromotions,
    																		'address1':$scope.register.address1,
    																		'address2':$('#address2Field').val(),
    																		'town':$scope.register.town,
    																		'county':$('#countyField').val(),
    																		'country':$scope.register.country,
    																		'plays49s':plays49s,
    																		'playsILB':playsILB,
																      	'playsVHR':playsVHR,
																      	'playsVGR':playsVGR,
																      	'playsRapido':playsRapido
    																		}).
	    			success(function(data, status, headers, config) {

	    				if(data.server_obj.success){
	    					$scope.registrationThankYou=false;
	    			    	$scope.registrationFormElements=true;
	    				}else{
	    					//alert(JSON.stringify(data));
	    				}

	    			}).
	    			error(function(data, status, headers, config) {
	    				alert('Problem with connection to webservice:'+data);
	    			});


      	    }
    	}



    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVGRHomeController', [
    '$scope','$timeout',
    function($scope, $timeout) {

      $scope.setTitle("Virtual Greyhound Racing - Latest Results");

      var ajaxRequest;

      $scope.showShare = false;

      var selectedLocIndex = 0;
      var selectedRaceIndex = 0;

      var locationData = [];
      var shareText;


      function updateShareResults() {
        $('#share-tw').html('');
        $('#share-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$scope.location.absUrl()+'" data-text="'+resultsShareText()+'" data-size="large" data-count="none">Tweet</a>');
        if ('twttr' in window && window['twttr'] !== null) {
          twttr.widgets.load();
        }

        $('#share-mail').html('');
        $('#share-mail').html('<a href="mailto:%20?subject=49s Website&body='+mailShareText()+'"><img src="../../img/icons/ic_email.png"></a>');

        $scope.showShare = true;
        $scope.$apply();
      }

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.vgr.latest.length>0){
 				$.each(json.body.vgr.latest, function(i,obj) {
 					var slide='';
					try{
						if(json.body.vgr.latest.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0 && this.url=='') {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:100px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();}
							else{
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
							}
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
			//add promo images
			if(json.body.promo.is_promo_vgr_latest.length>0){
		        var banner='';
				$.each(json.body.promo.is_promo_vgr_latest, function(i,obj) {
					try{
						banner='<div class="fn-promo-section">';
						if(obj.url!=''){
							banner+='<a href="'+obj.url+'">';
						}else{
							banner+='<a href="#">';
						}
						banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
						}
						banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
					}catch(e){}
					 $(".fn-promo-container").append(banner);
				});
			}
		}
		/* latest results slider */
 		$(document).ready(function(){
 			var findLatestFlag=0;
 			var currentDate = new Date();

       var currentDay = ("0" + currentDate.getDate()).slice(-2);
       var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
 		  var currentYear = currentDate.getFullYear();

 			var selectedDay = currentDay;
 			var selectedMonth = currentMonth;
 			var selectedYear = currentYear;

       var firstDay="05";
 			var firstMonth="05";
 			var firstYear="1996";

 			var firstDate = firstYear+'-'+firstMonth+'-'+firstDay;
 			var selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
 			var currentDate = currentYear+'-'+currentMonth+'-'+currentDay;

 			function getBallColor(num){
 				var colors = '';
 				if (num>40){
 					colors='black';
 				}else{
 					colors='red';
 				}
 		        return colors;
 			}
 			function updateDaySwitchers(){
 				if(new Date(selectedDate) <= new Date(firstDate)  ){
 					$('#previous-day').css( "display","none" );
 				}else{
 					$('#previous-day').css( "display","inline-block" );
 				}

 				if(new Date(selectedDate) >= new Date(currentDate)  ){
 					$('#next-day').css( "display","none" );
 				}else{
 					$('#next-day').css( "display","inline-block" );
 				}

 				//update text on day switchers
 				dateBefore=$scope.getDateBeforeDate(selectedDate);
 				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
 				dayNumber = $scope.getDayNumber(dateBefore);
         dayEnd = $scope.ordinalForDayNumber(dayNumber);
 				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

 				dateAfter=$scope.getDateAfterDate(selectedDate);
 				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
 				dayNumber = $scope.getDayNumber(dateAfter);
         dayEnd = $scope.ordinalForDayNumber(dayNumber);
 				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
 			}
 			function getLotteryData(selectedDate){

         if(!$scope.$$phase) {
           $scope.$apply(function() {
             $scope.showShare = false;
           });
         } else {
           $scope.showShare = false;
         }

         if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
 					url: $scope.baseURL+'/games/get_previous_results',
 					type: 'post',
                                        contentType: "application/json; charset=utf-8",
 					dataType: 'json',
 					data:  JSON.stringify({"game_type":"vdr","date": selectedDate}),
 					beforeSend: function() {
 						$( ".no-results-for-date" ).remove();
 						$('#main-spinner').css( "display","inline-block" );
 						$('.resoults-middle-container').css( "display","none" );
 					},
 					complete: function() {
 						//alert('complete');
 					},
 					success: handleData,
 					error: function(){
 						console.log('error');
 					}
 				});
 			}

 			function handleData(json) {
 				if (jQuery.isEmptyObject(json.body.locations)){
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");
           $scope.showShare = false;
           $scope.$apply();
 					//if no results try to get results from previous date
 					if(findLatestFlag==0){
 						selectedDate=$scope.getDateBeforeDate(selectedDate);
 						getLotteryData(selectedDate);
             $('#activeDate').html('');
             $('#previous-day').css( "display","none" );
             $('#next-day').css( "display","none" );
 					}
 				}else{
 					findLatestFlag=1;
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('.resoults-middle-container').css( "display","inline-block" );

 					$("#location-list li").remove();
 					$("#location-content li").remove();

           locationData = json.body.locations;

 					var location_nb=0;
 					var race_nb=0;
 					var race_content='';
 					$.each(json.body.locations, function() {
             var locIndex = location_nb;
 						location_nb=location_nb+1;
 						race_nb=0;
 						position_nb=0;
 						position_end='th';
 						$("#location-list").append('<li ><span data-toggle="tab" href="#location_tab_'+location_nb+'" loc-index="'+locIndex+'">'+this.location.toUpperCase()+'</span></li>');//fill out locations tabs menu
 						$("#location-list li").first().addClass("active");// set active location tab menu

 						$("#location-content").append('<li class="tab-pane fade in" id="location_tab_'+location_nb+'"><div class="clearfix" ><ul id="race_content_'+location_nb+'" class="tab-content"> </ul></div><ul class="race_nav dog_home_pagination" id="race_'+location_nb+'"></ul></li>');//fill out locations tabs content
 						$("#location-content li").first().addClass("active");// set active location tab



 						$.each(this.races, function() {
 							position_nb=0;
               var raceIndex = race_nb;
 							race_nb=race_nb+1;
 							$('#race_'+location_nb).append('<li><span href="#race_'+location_nb+'_'+race_nb+'" data-toggle="tab" race-index="'+raceIndex+'" class="btn btn-sm">Race '+race_nb+'</span></li>');

 							$('#race_content_'+location_nb).append('<li class="tab-pane fade in " id="race_'+location_nb+'_'+race_nb+'" ></li>');





 							//adding content
				              if (this.status != 0) {
				   							race_content='<div class="fn-race-info">'
				   										+'<span style="font-size:1.3em">RACE '+race_nb+'</span>'
				   										+'   <br/>'
				   										+'   <span class="fn-result-accent-text">'+this.race_time+'</span>'
				   										+'   <hr>';
				   							if(this.fc!=null && this.fc!=''){
				   								race_content+='  F/C '+numeral(this.fc).format('0,0.00')+'';
				   							}
				   							race_content+='    <br/>';
				   							if(this.tc!=null && this.tc!=''){
				   								race_content+='   T/C '+numeral(this.tc).format('0,0.00')+''
				   							}
				   							race_content+='</div>'
				  								+'<div class="fn-racing-list">'
				  								+'    <ul>'
				  			 							$.each(this.positions, function() {
				  			 								position_nb=this.position;
				  			 								if(position_nb==1){position_end='st';}
				  			 								if(position_nb==2){position_end='nd';}
				  			 								if(position_nb==3){position_end='rd';}
				  			 								if(position_nb==4){position_end='th';}
				  			 								race_content+='        <li>';
				                         if(this.runner_number==3 || this.runner_number==6){
				                           race_content+='            <div class="fn-racing-place" style="color:red;background-image:url(\'img/bg/silk_'+this.runner_number+'.png\')  ">';
				                         }else{
				                           race_content+='            <div class="fn-racing-place" style="background-image:url(\'img/bg/silk_'+this.runner_number+'.png\')  ">';
				                         }
				  			 								race_content+='            '+position_nb+'<sup>'+position_end+'</sup>';
				  			 								race_content+='           </div><div class="fn-racing-stats">';
				  			 								race_content+='           <div class="fn-result-accent-text" style="width:20px;display:inline-block;margin-right:20px;text-align:right;">'+this.runner_number+'</div>'
				                        +'           '+this.name+''
				                        +'           <div class="fn-results-odds-container"><span class="fn-results-odds">'+this.fract+'</span>'
				  			 								+'           <span class="fn-result-fav">'+(this.fav).toUpperCase()+'</span></div>'
				  	 										+'           </div></li>'
				  			 							});
				   							race_content+='   </ul>'
				   										+'</div>';
				   								$('#race_'+location_nb+'_'+race_nb).html(race_content);
				                } else {
				                  $('#race_'+location_nb+'_'+race_nb).html("<div class='no-results-for-num-draw' ng-hide='draw1Visible'><h1>No Results Available</h1></div>");
				                }
 						});

 						//set current last race active
 						$('#location-content li ul li').last().addClass("active");
 						$('#location-content li div ul li:last-child').addClass("active");
 					});
 					updateDaySwitchers();
 					updateTitleDate();
 					formatShareText();
 				}

 			}


 			function updateTitleDate() {
 				dayNumber = $scope.getDayNumber(selectedDate);
         dayEnd = $scope.ordinalForDayNumber(dayNumber).toUpperCase();

 				var d = new Date(selectedDate);
 				var month = new Array();
         month[0] = "JANUARY";
 				month[1] = "FEBRUARY";
 				month[2] = "MARCH";
 				month[3] = "APRIL";
 				month[4] = "MAY";
 				month[5] = "JUNE";
 				month[6] = "JULY";
 				month[7] = "AUGUST";
 				month[8] = "SEPTEMBER";
 				month[9] = "OCTOBER";
 				month[10] = "NOVEMBER";
 				month[11] = "DECEMBER";
 				var monthName = month[d.getMonth()];

       $('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+'<sup>'+dayEnd.toLowerCase()+'</sup> '+monthName+' '+d.getFullYear());
 			}

 			//initiate everything
 			getLotteryData(selectedDate);
 			updateDaySwitchers();
 			updateTitleDate();
 			//on previous day click
 			$( "#next-day" ).click(function( event ) {
 				event.preventDefault();
 				selectedDate=$scope.getDateAfterDate(selectedDate);
 				getLotteryData(selectedDate);
 				updateDaySwitchers();
 				updateTitleDate();
 			});
 			//on next day click
 			$( "#previous-day" ).click(function( event ) {
 				event.preventDefault();
 				selectedDate=$scope.getDateBeforeDate(selectedDate);
 				getLotteryData(selectedDate);
 				updateDaySwitchers();
 				updateTitleDate();
 			});
 		});

     $(document).on('click','.dog_home_pagination span[data-toggle="tab"]',function(e){
       var raceIndex = $(e.currentTarget).attr("race-index");
       if (raceIndex) {
         selectedRaceIndex = raceIndex;
       }

       var locIndex = $(e.currentTarget).attr("loc-index");
       if (locIndex) {
         selectedLocIndex = locIndex;
       }


       formatShareText();

 		});


     function formatShareText() {
       var resultText = "";

       var race = locationData[selectedLocIndex].races[selectedRaceIndex];
       if (race) {
         var resultText = "VGR Results: " +race.name+": ";
         for (var i=0; i<3; i++) {
           var dog = race.positions[i];
           if (dog) {
             var pos = "";
             if(i==0){pos='1st';}
             if(i==1){pos='2nd';}
             if(i==2){pos='3rd';}


             resultText += pos + " " + dog.name + " " + dog.fract;
             if (i < 2) {
               resultText += ", ";
             }
           }
         }
       }

       shareText = resultText;

       updateShareResults();

     }



      function resultsShareText() {
        return shareText;
      }

      function mailShareText() {
        var resultText = resultsShareText();
        return resultText + '%0D%0A' + $scope.location.absUrl();
      }

/*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVGRHowToPlayController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Virtual Greyhound Racing - How to Play");
        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.vgr.how_to_play.length>0){
 				$.each(json.body.vgr.how_to_play, function(i,obj) {
					try{
						if(json.body.vgr.how_to_play.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
            if(this.video_url != null && this.video_url.length > 0) {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:95px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();
						}else if(this.url!=null && this.url.length > 0){
	 						$(".carousel-inner").append('<div class="item"><a href="'+this.url+'"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></a></div>');
						}else{
							$(".carousel-inner").append('<div class="item"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></div>');
						}
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
        $scope.videoSrc = "../media/VGR_htp@720x576.mp4";
        $scope.thumbSrc = "../media/VGR_htp_thumb.png";

        /*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVGRMenuController', [
    '$scope','$location',
    function($scope,$location) {

	$scope.navigationOptions = [
            {
                id: "",
                bgCls: "fn-vgr-menu-left-bg",
                cls: "fn-menu-title-latest",
                txt: "LATEST RESULTS"
            },
            {
                id: "previous",
                bgCls: "fn-vgr-menu-center-bg",
                cls: "fn-menu-title-previous",
                txt: "PREVIOUS RESULTS"
            },
            {
                id: "how-to-play",
                bgCls: "fn-vgr-menu-right-bg",
                cls: "fn-menu-title-how",
                txt: "HOW TO PLAY"
            }
        ];


        $scope.isActive = function (viewLocation) {
            if (viewLocation === "/virtualgreyhoundracing/" && $location.path() === "/virtualgreyhoundracing") {
                return true;
            } else if (viewLocation === "/virtualgreyhoundracing/how-to-play" && $location.path() === "/virtualgreyhoundracing/rules") {
                return true;
            }
            return viewLocation === $location.path();
        };

        // $scope.menuShown = false;
        //
        // $scope.menuToggleFn = function() {
        //     $scope.menuShown = !$scope.menuShown;
        //     $scope.menuDisplay = $scope.menuShown === true ? {'display':'block'} : {};
        // };

        $scope.bannerURL = function() {
          return "../../img/bg/bg_cold.png";
        };

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVGRResultsController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Virtual Greyhound Racing - Previous Results");
      var ajaxRequest;

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.vgr.previous.length>0){
 				$.each(json.body.vgr.previous, function(i,obj) {
 					var slide='';
					try{
						if(json.body.vgr.previous.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
		/* previous results slider */
		$(document).ready(function(){
			var findLatestFlag=0;
			var currentDate = new Date();

      var currentDay = ("0" + currentDate.getDate()).slice(-2);
      var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
		  var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

			var firstDay="27";
			var firstMonth="05";
			var firstYear="2003";

      var firstDate = $scope.dateStringFromComponents(firstYear, firstMonth, firstDay);
      var selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
      var currentDate = $scope.dateStringFromComponents(currentYear, currentMonth, currentDay);

			function getBallColor(num){
		        var index  = (num-1) % 7;
		        var colors = ["green","red","orange","yellow","brown","purple","blue"];
		        return colors[index];
			}



			function getLotteryData(){
        if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
 					url: $scope.baseURL+'/games/get_previous_results',
 					type: 'post',
                                        contentType: "application/json; charset=utf-8",
 					dataType: 'json',
 					data:  JSON.stringify({"game_type":"vdr","date": selectedDate}),
					beforeSend: function() {
						$( ".no-results-for-date" ).remove();
						$('#main-spinner').css( "display","inline-block" );
						$('.resoults-middle-container').css( "display","none" );
					},
					complete: function() {
						//alert('complete');
					},
					success: handleData,
					error: function(){
						// console.log('Connection error! Please try again.');
					}
				});
			}

 			function handleData(json) {
 				if (jQuery.isEmptyObject(json.body.locations)){
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");

 				}else{
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('.resoults-middle-container').css( "display","inline-block" );

 					$("#location-list li").remove();
 					$("#location-content li").remove();

 					var location_nb=0;
 					var race_nb=0;
 					var race_content='';
 					$.each(json.body.locations, function() {
 						location_nb=location_nb+1;
 						race_nb=0;
 						position_nb=0;
 						position_end='th';
 						$("#location-list").append('<li ><span data-toggle="tab" href="#location_tab_'+location_nb+'">'+this.location.toUpperCase()+'</span></li>');//fill out locations tabs menu
 						$("#location-list li").first().addClass("active");// set active location tab menu

 						$("#location-content").append('<li class="tab-pane fade in" id="location_tab_'+location_nb+'"><ul id="race_content_'+location_nb+'" class="tab-content"> </ul><ul class="race_nav" id="race_'+location_nb+'"></ul></li>');//fill out locations tabs content
 						$("#location-content li").first().addClass("active");// set active location tab



 						$.each(this.races, function() {
 							position_nb=0;
 							race_nb=race_nb+1;
 							$('#race_'+location_nb).append('<li><span href="#race_'+location_nb+'_'+race_nb+'" data-toggle="tab" class="btn btn-sm">Race '+race_nb+'</span></li>');


 							$('#race_content_'+location_nb).append('<li class="tab-pane fade in " id="race_'+location_nb+'_'+race_nb+'" ></li>');


 							//adding content
              if (this.status != 0) {
   							race_content='<div class="fn-race-info">'
   										+'<span style="font-size:1.3em">RACE '+race_nb+'</span>'
   										+'   <br/>'
   										+'   <span class="fn-result-accent-text">'+this.race_time+'</span>'
   										+'   <hr>';
   							if(this.fc!=null && this.fc!=''){
   								race_content+='  F/C '+numeral(this.fc).format('0,0.00')+'';
   							}
   							race_content+='    <br/>';
   							if(this.tc!=null && this.tc!=''){
   								race_content+='   T/C '+numeral(this.tc).format('0,0.00')+''
   							}
   							race_content+='</div>'
  								+'<div class="fn-racing-list">'
  								+'    <ul>'
  			 							$.each(this.positions, function() {
  			 								position_nb=this.position;
  			 								if(position_nb==1){position_end='st';}
  			 								if(position_nb==2){position_end='nd';}
  			 								if(position_nb==3){position_end='rd';}
  			 								if(position_nb==4){position_end='th';}
  			 								race_content+='        <li>';
  			 								if(this.runner_number==3 || this.runner_number==6){
  			 									race_content+='            <div class="fn-racing-place" style="color:red;background-image:url(\'img/bg/silk_'+this.runner_number+'.png\')  ">';
  			 								}else{
  			 									race_content+='            <div class="fn-racing-place" style="background-image:url(\'img/bg/silk_'+this.runner_number+'.png\')  ">';
  			 								}
  			 								race_content+='            '+position_nb+'<sup>'+position_end+'</sup>';
  			 								race_content+='           </div><div class="fn-racing-stats">';
  			 								race_content+='           <div class="fn-result-accent-text" style="width:20px;display:inline-block;margin-right:20px;text-align:right;">'+this.runner_number+'</div>'
                        +'           '+this.name+''
                        +'           <div class="fn-results-odds-container"><span class="fn-results-odds">'+this.fract+'</span>'
  			 								+'           <span class="fn-result-fav">'+(this.fav).toUpperCase()+'</span></div>'
  	 										+'           </div></li>'
  			 							});
   							race_content+='   </ul>'
   										+'</div>';
   								$('#race_'+location_nb+'_'+race_nb).html(race_content);
			                } else {
			                  $('#race_'+location_nb+'_'+race_nb).html("<div class='no-results-for-num-draw' ng-hide='draw1Visible'><h1>No Results Available</h1></div>");
			                }
 						});

 						//set current last race active
 						$('#location-content li ul li').last().addClass("active");
 						$('#location-content li ul li:last-child').addClass("active");

 					});
 				}



 				//$('.resoults-middle-container').html( JSON.stringify(json) );
 				//$('.resoults-middle-container').css( 'color','white');

 	    		updateDaySwitchers();

 			}

			function populateSelectBoxes(){
				//populate months select box and set current month
				$('#month option:eq('+(selectedMonth-1)+')').prop('selected', true);
				//populate years select box and set last as selected
				var yearsArray = new Array();
				for (i=0;(currentYear-i)>=firstYear;i++){
					yearsArray[i]=currentYear-i;
				}
				$("#year").empty();
				$.each(yearsArray, function(val, text) {
		            $('#year').append(
		                $('<option></option>').val(text).html(text)
		            );
				});
				$('#year option[value="'+selectedYear+'"]').prop('selected', true);
			}

			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}

			function disableSelectBoxesOptions(){

				if($( "#year" ).val() == currentYear){
					if(currentMonth<1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(currentMonth<2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(currentMonth<3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(currentMonth<4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(currentMonth<5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(currentMonth<6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(currentMonth<7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(currentMonth<8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(currentMonth<9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(currentMonth<10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(currentMonth<11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(currentMonth<12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else if ($( "#year" ).val() == firstYear){
					if(firstMonth>1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(firstMonth>2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(firstMonth>3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(firstMonth>4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(firstMonth>5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(firstMonth>6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(firstMonth>7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(firstMonth>8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(firstMonth>9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(firstMonth>10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(firstMonth>11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(firstMonth>12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else{
					$("#month option[value='1']").removeAttr('disabled');
					$("#month option[value='2']").removeAttr('disabled');
					$("#month option[value='3']").removeAttr('disabled');
					$("#month option[value='4']").removeAttr('disabled');
					$("#month option[value='5']").removeAttr('disabled');
					$("#month option[value='6']").removeAttr('disabled');
					$("#month option[value='7']").removeAttr('disabled');
					$("#month option[value='8']").removeAttr('disabled');
					$("#month option[value='9']").removeAttr('disabled');
					$("#month option[value='10']").removeAttr('disabled');
					$("#month option[value='11']").removeAttr('disabled');
					$("#month option[value='12']").removeAttr('disabled');
				}

        if ($( "#month" ).val() < parseInt(firstMonth)){
          $("#year option[value='"+firstYear+"']").attr('disabled','disabled');
        } else {
          $("#year option[value='"+firstYear+"']").removeAttr('disabled');
        }

			}

			function setMonthlySwitchers(){
				var previousMonths = new Array();
				previousMonths[1]='December';
				previousMonths[2]='January';
				previousMonths[3]='February';
				previousMonths[4]='March';
				previousMonths[5]='April';
				previousMonths[6]='May';
				previousMonths[7]='June';
				previousMonths[8]='July';
				previousMonths[9]='August';
				previousMonths[10]='September';
				previousMonths[11]='October';
				previousMonths[12]='November';
				previousMonthText=previousMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==1){
            		previousMonthText+=$( "#year" ).val()-1;
            	}else{
            		previousMonthText+=$( "#year" ).val();
            	}
            	$('#previous-month-switch').html(previousMonthText);

				var nextMonths = new Array();
				nextMonths[1]='February';
				nextMonths[2]='March';
				nextMonths[3]='April';
				nextMonths[4]='May';
				nextMonths[5]='June';
				nextMonths[6]='July';
				nextMonths[7]='August';
				nextMonths[8]='September';
				nextMonths[9]='October';
				nextMonths[10]='November';
				nextMonths[11]='December';
				nextMonths[12]='January';

				nextMonthText=nextMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==12){
            		nextMonthText+=(parseInt($( "#year" ).val())+1);
            	}else{
            		nextMonthText+=$( "#year" ).val();
            	}
            	$('#next-month-switch').html(nextMonthText);
            	//disable next month button
            	if(selectedYear == currentYear && selectedMonth >= currentMonth){
            		$('#nextMonthClick').css( "display","none" );
            	}else{
					$('#nextMonthClick').css( "display","inline-block" );
            	}
            	//disable previous month button
            	if(selectedYear == firstYear && selectedMonth <= firstMonth){
            		$('#prevMonthClick').css( "display","none" );
            	}else{
					$('#prevMonthClick').css( "display","inline-block" );
            	}
			}
			function scrollToSelectedPosition(){
				var selectedElement=$( ".days-controls-selected" );
				var position = selectedElement.position();
				//$( "#days-list-vgr" ).animate({left: -position.left}, 500, function() { });
				$( "#days-list-vgr" ).css("left", -position.left);
			}



			function setDaysSlider(){
				$("#days-list-vgr").empty();

				//selected main element
				if(new Date(selectedDate) >= new Date(firstDate) &&  new Date(selectedDate) <= new Date(currentDate) ){
					$("#days-list-vgr").append('<li class="days-controls-selected"><a href="#" class="dayselect-vgr" data-position="0"  data-date="'+selectedDate+'">'+$scope.getShortDayName(selectedDate)+'<br><span class="dayNum">'+$scope.getDayNumber(selectedDate)+'</span></a></li>');
				}
				//prepened options
				daybefore = $scope.getDateBeforeDate(selectedDate);

				if(new Date(daybefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-1"  data-date="'+daybefore+'">'+$scope.getShortDayName(daybefore)+'<br><span class="dayNum">'+$scope.getDayNumber(daybefore)+'</span></a></li>');
				}

				twodaysbefore = $scope.getDateBeforeDate(daybefore);
				if(new Date(twodaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-3"  data-date="'+twodaysbefore+'">'+$scope.getShortDayName(twodaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysbefore)+'</span></a></li>');
				}

				threedaysbefore = $scope.getDateBeforeDate(twodaysbefore);
				if(new Date(threedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-4"  data-date="'+threedaysbefore+'">'+$scope.getShortDayName(threedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysbefore)+'</span></a></li>');
				}

				fourdaysbefore = $scope.getDateBeforeDate(threedaysbefore);
				if(new Date(fourdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-5"  data-date="'+fourdaysbefore+'">'+$scope.getShortDayName(fourdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysbefore)+'</span></a></li>');
				}

				fivedaysbefore = $scope.getDateBeforeDate(fourdaysbefore);
				if(new Date(fivedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-6"  data-date="'+fivedaysbefore+'">'+$scope.getShortDayName(fivedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysbefore)+'</span></a></li>');
				}

				sixdaysbefore = $scope.getDateBeforeDate(fivedaysbefore);
				if(new Date(sixdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-7"  data-date="'+sixdaysbefore+'">'+$scope.getShortDayName(sixdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysbefore)+'</span></a></li>');
				}

				sevendaysbefore = $scope.getDateBeforeDate(sixdaysbefore);
				if(new Date(sevendaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vgr").prepend('<li><a href="#" class="dayselect-vgr" data-position="-8"  data-date="'+sevendaysbefore+'">'+$scope.getShortDayName(sevendaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysbefore)+'</span></a></li>');
				}

				//appended options
				dayafter = $scope.getDateAfterDate(selectedDate);
				if(new Date(dayafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="1"  data-date="'+dayafter+'">'+$scope.getShortDayName(dayafter)+'<br><span class="dayNum">'+$scope.getDayNumber(dayafter)+'</span></a></li>');
				}

				twodaysafter = $scope.getDateAfterDate(dayafter);
				if(new Date(twodaysafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="2"  data-date="'+twodaysafter+'">'+$scope.getShortDayName(twodaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysafter)+'</span></a></li>');
				}

				threedaysafter = $scope.getDateAfterDate(twodaysafter);
				if(new Date(threedaysafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="3"  data-date="'+threedaysafter+'">'+$scope.getShortDayName(threedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysafter)+'</span></a></li>');
				}

				fourdaysafter = $scope.getDateAfterDate(threedaysafter);
				if(new Date(fourdaysafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="4"  data-date="'+fourdaysafter+'">'+$scope.getShortDayName(fourdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysafter)+'</span></a></li>');
				}

				fivedaysafter = $scope.getDateAfterDate(fourdaysafter);
				if(new Date(fivedaysafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="5"  data-date="'+fivedaysafter+'">'+$scope.getShortDayName(fivedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysafter)+'</span></a></li>');
				}

				sixdaysafter = $scope.getDateAfterDate(fivedaysafter);
				if(new Date(sixdaysafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="6"  data-date="'+sixdaysafter+'">'+$scope.getShortDayName(sixdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysafter)+'</span></a></li>');
				}

				sevendaysafter = $scope.getDateAfterDate(sixdaysafter);
				if(new Date(sevendaysafter) <= new Date(currentDate)  ){
					$("#days-list-vgr").append('<li><a href="#" class="dayselect-vgr" data-position="7"  data-date="'+sevendaysafter+'">'+$scope.getShortDayName(sevendaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysafter)+'</span></a></li>');
				}

				//$('#fdate').html(firstYear+'-'+firstMonth+"-"+firstDay);
				//$('#sdate').html(selectedYear+'-'+selectedMonth+"-"+selectedDay);
				//$('#cdate').html(currentYear+'-'+currentMonth+"-"+currentDay);

				scrollToSelectedPosition();
				populateSelectBoxes();
				disableSelectBoxesOptions();
				setMonthlySwitchers();
				updateDaySwitchers();
				getLotteryData();
			}


			//initiate everything
			populateSelectBoxes();
			setDaysSlider();

			$( "#month" ).change(function() {

				//set year

				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && parseInt(selectedMonth) == parseInt(firstMonth) && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
				// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			$( "#year" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
				// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on day selector click

			$('#days-list-vgr').on('click', ' a.dayselect-vgr', function(event) {
				event.preventDefault();
					dateArray=this.getAttribute("data-date").split("-");
					selectedDay = dateArray[2];
					selectedMonth = dateArray[1];
					selectedYear = dateArray[0];
					// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
					selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
					setDaysSlider();
			});

			$("#prevMonthClick").click(function(event){
			    event.preventDefault();

				//set year
					selectedYear=$( "#year" ).val();
					//set month

					selectedMonth = $( "#month" ).val()-1;
					//switch to previous year
					if(selectedMonth==0){
						selectedMonth = 12;
						selectedYear = selectedYear-1;
					}
					if(selectedYear == firstYear && selectedMonth < firstMonth){
						selectedMonth = firstMonth;
					}
					//set day


					if(selectedYear == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
						selectedDay = firstDay;
					}
					//make sure selected day isnt hire than days in month
					var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
					if(selectedDay > daysInMonth){
						selectedDay = daysInMonth;
					}
					// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
          selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

					setDaysSlider();

			});

			$("#nextMonthClick").click(function(event){
			    event.preventDefault();
				//set year
					selectedYear=$( "#year" ).val();
					//set month

					selectedMonth = parseInt($( "#month" ).val())+1;

					//switch to previous year
					if(selectedMonth==13){
						selectedMonth = 1;
						selectedYear = parseInt(selectedYear)+1;
					}
					if(selectedYear == currentYear && selectedMonth > currentMonth){
						selectedMonth = currentMonth;
					}
					//set day
					if(selectedYear == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
						selectedDay = currentDay;
					}
					//make sure selected day isnt hire than days in month
					var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
					if(selectedDay > daysInMonth){
						selectedDay = daysInMonth;
					}
					// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
          selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

					setDaysSlider();
			});

			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dateAfterArray=dateAfter.split("-");

				if(new Date(dateAfter) > new Date(currentDate)  ){
				}else{
					selectedDay = dateAfterArray[2];
						selectedMonth = dateAfterArray[1];
 					selectedYear = dateAfterArray[0] ;

 					selectedDate = dateAfter;
				}
					setDaysSlider();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();

				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dateBeforeArray=dateBefore.split("-");
				if(new Date(dateBefore) < new Date(firstDate)  ){

				}else{
					selectedDay = dateBeforeArray[2];
						selectedMonth = dateBeforeArray[1];
 					selectedYear = dateBeforeArray[0] ;

					selectedDate = dateBefore;
				}
					setDaysSlider();
			});

	});


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVGRRulesController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Virtual Greyhound Racing - Rules");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.vgr.rules.length>0){
 				$.each(json.body.vgr.rules, function(i,obj) {
 					var slide='';
					try{
						if(json.body.vgr.rules.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVHRHomeController', [
    '$scope','$timeout',
    function($scope, $timeout) {

      $scope.setTitle("Virtual Horse Racing - Latest Results");

      var ajaxRequest;

      var selectedLocIndex = 0;
      var selectedRaceIndex = 0;

      var locationData = [];
      var shareText;

      $scope.showShare = false;


      function updateShareResults() {
        $('#share-tw').html('');
        $('#share-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$scope.location.absUrl()+'" data-text="'+resultsShareText()+'" data-size="large" data-count="none">Tweet</a>');
        if ('twttr' in window && window['twttr'] !== null) {
          twttr.widgets.load();
        }

        $('#share-mail').html('');
        $('#share-mail').html('<a href="mailto:%20?subject=49s Website&body='+mailShareText()+'"><img src="../../img/icons/ic_email.png"></a>');

        $scope.showShare = true;
        $scope.$apply();
      }


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.vhr.latest.length>0){
 				$.each(json.body.vhr.latest, function(i,obj) {
 					var slide='';
					try{
						if(json.body.vhr.latest.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0 && this.url=='') {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:100px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();}
							else{
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
							}
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
			//add promo images
			if(json.body.promo.is_promo_vhr_latest.length>0){
		        var banner='';
				$.each(json.body.promo.is_promo_vhr_latest, function(i,obj) {
					try{
						banner='<div class="fn-promo-section">';
						if(obj.url!=''){
							banner+='<a href="'+obj.url+'">';
						}else{
							banner+='<a href="#">';
						}
						banner+='<img src="'+obj.image_url+'" />';
						if(obj.overlay_text!=null && obj.overlay_text.length>0){
							banner+='<div class="fn-promo-section-footer">';
							banner+=obj.overlay_text;
							banner+='</div>';
						}
						banner+='<div class="fn-promo-section-cover">';
						banner+='</div>';
						banner+='</a>';
						banner+='</div>';
					}catch(e){}
					 $(".fn-promo-container").append(banner);
				});
			}
		}

		/* latest results slider */
 		$(document).ready(function(){
 			var findLatestFlag=0;
 			var currentDate = new Date();

       var currentDay = ("0" + currentDate.getDate()).slice(-2);
       var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
 		  var currentYear = currentDate.getFullYear();

 			var selectedDay = currentDay;
 			var selectedMonth = currentMonth;
 			var selectedYear = currentYear;

       var firstDay="05";
 			var firstMonth="05";
 			var firstYear="1996";

 			var firstDate = firstYear+'-'+firstMonth+'-'+firstDay;
 			var selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
 			var currentDate = currentYear+'-'+currentMonth+'-'+currentDay;


 			function updateDaySwitchers(){
 				if(new Date(selectedDate) <= new Date(firstDate)  ){
 					$('#previous-day').css( "display","none" );
 				}else{
 					$('#previous-day').css( "display","inline-block" );
 				}

 				if(new Date(selectedDate) >= new Date(currentDate)  ){
 					$('#next-day').css( "display","none" );
 				}else{
 					$('#next-day').css( "display","inline-block" );
 				}

 				//update text on day switchers
 				dateBefore=$scope.getDateBeforeDate(selectedDate);
 				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
 				dayNumber = $scope.getDayNumber(dateBefore);
         dayEnd = $scope.ordinalForDayNumber(dayNumber);
 				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

 				dateAfter=$scope.getDateAfterDate(selectedDate);
 				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
 				dayNumber = $scope.getDayNumber(dateAfter);
         dayEnd = $scope.ordinalForDayNumber(dayNumber);
 				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
 			}
 			function getLotteryData(selectedDate){

         if(!$scope.$$phase) {
           $scope.$apply(function() {
             $scope.showShare = false;
           });
         } else {
           $scope.showShare = false;
         }

         if (ajaxRequest) {
          ajaxRequest.abort();
        }
        ajaxRequest = $.ajax({
 					url: $scope.baseURL+'/games/get_previous_results',
 					type: 'post',
                                        contentType: "application/json; charset=utf-8",
 					dataType: 'json',
 					data:  JSON.stringify({"game_type":"vhr","date": selectedDate}),
 					beforeSend: function() {
 						$( ".no-results-for-date" ).remove();
 						$('#main-spinner').css( "display","inline-block" );
 						$('.resoults-middle-container').css( "display","none" );
 					},
 					complete: function() {
 						//alert('complete');
 					},
 					success: handleData,
 					error: function(){
 						console.log('error');
 					}
 				});
 			}

 			function handleData(json) {
 				if (jQuery.isEmptyObject(json.body.locations)){
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");
           $scope.showShare = false;
           $scope.$apply();
 					//if no results try to get results from previous date
 					if(findLatestFlag==0){
 						selectedDate=$scope.getDateBeforeDate(selectedDate);
 						getLotteryData(selectedDate);
             $('#activeDate').html('');
             $('#previous-day').css( "display","none" );
             $('#next-day').css( "display","none" );
 					}
 				}else{
 					findLatestFlag=1;

 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('.resoults-middle-container').css( "display","inline-block" );

 					$("#location-list li").remove();
 					$("#location-content li").remove();

           locationData = json.body.locations;

 					var location_nb=0;
 					var race_nb=0;
 					var race_content='';
 					$.each(json.body.locations, function() {
             var locIndex = location_nb;
 						location_nb=location_nb+1;
 						race_nb=0;
 						position_nb=0;
 						position_end='th';

             if (this.location.toUpperCase() === "SPRINTVALLEY") {
               this.location = "SPRINT VALLEY";
             }

 						$("#location-list").append('<li ><span data-toggle="tab" href="#location_tab_'+location_nb+'" loc-index="'+locIndex+'">'+this.location.toUpperCase()+'</span></li>');//fill out locations tabs menu
 						$("#location-list li").first().addClass("active");// set active location tab menu

 						$("#location-content").append('<li class="tab-pane fade in" id="location_tab_'+location_nb+'"><div class="clearfix" ><ul id="race_content_'+location_nb+'" class="tab-content"></ul></div> <ul class="race_nav horse_home_pagination" id="race_'+location_nb+'"></ul></li>');//fill out locations tabs content
 						$("#location-content li").first().addClass("active");// set active location tab



 						$.each(this.races, function() {
 							position_nb=0;
              var raceIndex = race_nb;
 							race_nb=race_nb+1;
 							$('#race_'+location_nb).append('<li><span href="#race_'+location_nb+'_'+race_nb+'" data-toggle="tab" race-index="'+raceIndex+'" class="btn btn-sm">Race '+race_nb+'</span></li>');
 							//$('#race_'+location_nb+' li').first().addClass("active");// set active race tab

 							$('#race_content_'+location_nb).append('<li class="tab-pane fade in " id="race_'+location_nb+'_'+race_nb+'" ></li>');
 							//$('#race_content_'+location_nb+' li').first().addClass("active");// set active race tab

 							//adding content
              if (this.status != 0) {
   							race_content='<div class="fn-race-info">'
   										+'<span style="font-size:1.3em">RACE '+race_nb+'</span>'
   										+'   <br/>'
   										+'   <span class="fn-result-accent-text">'+this.race_time+'</span>'
   										+'   <hr>';
  			 							if(this.fc!=null && this.fc!=''){
  			 								race_content+='  F/C '+numeral(this.fc).format('0,0.00')+'';
  			 							}
  			 							race_content+='    <br/>';
  			 							if(this.tc!=null && this.tc!=''){
  			 								race_content+='   T/C '+numeral(this.tc).format('0,0.00')+''
  			 							}
  			 							race_content+='</div>'
   										+'<div class="fn-racing-list">'
   										+'    <ul>'
  			 							$.each(this.positions, function() {
  			 								position_nb=this.position;
  			 								if(position_nb==1){position_end='st';}
  			 								if(position_nb==2){position_end='nd';}
  			 								if(position_nb==3){position_end='rd';}
  			 								if(position_nb==4){position_end='th';}
  			 								race_content+='        <li>'
  	 										+'            <div class="fn-racing-place">'
  	 										+'            '+position_nb+'<sup>'+position_end+'</sup>'
  	 										+'           </div><div class="fn-racing-stats">'
  	 										+'           <div class="fn-result-accent-text" >'+this.runner_number+'</div>'
  			 								+'           '+this.name+''
                        +'           <div class="fn-results-odds-container"><span class="fn-results-odds">'+this.fract+'</span>'
  			 								+'           <span class="fn-result-fav">'+(this.fav).toUpperCase()+'</span></div>'
  	 										+'       </div></li>'
  			 							});
   							race_content+='   </ul>'
   										+'</div>';
   								$('#race_'+location_nb+'_'+race_nb).html(race_content);
			                } else {
			                  $('#race_'+location_nb+'_'+race_nb).html("<div class='no-results-for-num-draw'><h1>No Results Available</h1></div>");
			                }
 						});
 					});

 					//set current last race active
					$('#location-content li ul li:last-child').addClass("active");
					$('#location-content li div ul li:last-child').addClass("active");

 					updateDaySwitchers();
 					updateTitleDate();
 					formatShareText();
 				}

 			}





 			function updateTitleDate() {
 				dayNumber = $scope.getDayNumber(selectedDate);
         dayEnd = $scope.ordinalForDayNumber(dayNumber).toUpperCase();

 				var d = new Date(selectedDate);
 				var month = new Array();
        month[0] = "JANUARY";
 				month[1] = "FEBRUARY";
 				month[2] = "MARCH";
 				month[3] = "APRIL";
 				month[4] = "MAY";
 				month[5] = "JUNE";
 				month[6] = "JULY";
 				month[7] = "AUGUST";
 				month[8] = "SEPTEMBER";
 				month[9] = "OCTOBER";
 				month[10] = "NOVEMBER";
 				month[11] = "DECEMBER";
 				var monthName = month[d.getMonth()];

       $('#activeDate').html($scope.getDayName(selectedDate)+' '+' '+dayNumber+'<sup>'+dayEnd.toLowerCase()+'</sup> '+monthName+' '+d.getFullYear());
 			}

 			//initiate everything
 			getLotteryData(selectedDate);
 			updateDaySwitchers();
 			updateTitleDate();
 			//on previous day click
 			$( "#next-day" ).click(function( event ) {
 				event.preventDefault();
 				selectedDate=$scope.getDateAfterDate(selectedDate);
 				getLotteryData(selectedDate);
 				updateDaySwitchers();
 				updateTitleDate();
 			});
 			//on next day click
 			$( "#previous-day" ).click(function( event ) {
 				event.preventDefault();
 				selectedDate=$scope.getDateBeforeDate(selectedDate);
 				getLotteryData(selectedDate);
 				updateDaySwitchers();
 				updateTitleDate();
 			});



 		});




		$(document).on('click','span[data-toggle="tab"]',function(e){
	      var raceIndex = $(e.currentTarget).attr("race-index");
	      if (raceIndex) {
	        selectedRaceIndex = raceIndex;
	      }

	      var locIndex = $(e.currentTarget).attr("loc-index");
	      if (locIndex) {
	        selectedLocIndex = locIndex;
	      }


	      formatShareText();

		});



    function formatShareText() {
      var resultText = "";

      var race = locationData[selectedLocIndex].races[selectedRaceIndex];
      if (race) {
        var resultText = "VHR Results: " +race.name+": ";
        for (var i=0; i<3; i++) {
          var horse = race.positions[i];
          if (horse) {
            var pos = "";
            if(i==0){pos='1st';}
            if(i==1){pos='2nd';}
            if(i==2){pos='3rd';}


            resultText += pos + " " + horse.name + " " + horse.fract;
            if (i < 2) {
              resultText += ", ";
            }
          }
        }
      }

      shareText = resultText;

      updateShareResults();

    }



     function resultsShareText() {
       return shareText;
     }

     function mailShareText() {
       var resultText = resultsShareText();
       return resultText + '%0D%0A' + $scope.location.absUrl();
     }

 /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});
/*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});  


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVHRHowToPlayController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Virtual Horse Racing - How to Play");

        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.vhr.how_to_play.length>0){
 				$.each(json.body.vhr.how_to_play, function(i,obj) {
					try{
						if(json.body.vhr.how_to_play.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						if(this.video_url != null && this.video_url.length > 0) {
							$(".carousel-inner").append('<div class="item"><a href="#" data-toggle="modal" data-target="#videoModal"  ><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ><div style="width:100%;height:100%;position:absolute;top:0;"><img src="../img/icons/ic_video_play.png" style="margin:95px auto;display:block;"></div></a></div>');
							$('video#how_to_play_video source').attr('src', this.video_url);
							$("video#how_to_play_video")[0].load();
						} else if (this.url!=null && this.url.length > 0){
	 						$(".carousel-inner").append('<div class="item"><a href="'+this.url+'"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></a></div>');
						}else{
							$(".carousel-inner").append('<div class="item"><img class="first-slide" src="'+this.image_url+'" alt="Rapido how to play" ></div>');
						}
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

        $scope.videoSrc = "../media/VHR_htp@720x576.mp4";
        $scope.thumbSrc = "../media/VHR_htp_thumb.png";

        /*  main Video */
        $(document).on('show.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#howToPlayMainVideoModal', function () {
        	$('#how_to_play_main_video').trigger("pause");
		});


        /*  top video from slider*/
        $(document).on('show.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("play");
        });
        $(document).on('hide.bs.modal','#videoModal', function () {
        	$('#how_to_play_video').trigger("pause");
		});


    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVHRMenuController', [
    '$scope','$location',
    function($scope,$location) {

	$scope.navigationOptions = [
            {
                id: "",
                bgCls: "fn-vhr-menu-left-bg",
                cls: "fn-menu-title-latest",
                txt: "LATEST RESULTS"
            },
            {
                id: "previous",
                bgCls: "fn-vhr-menu-center-bg",
                cls: "fn-menu-title-previous",
                txt: "PREVIOUS RESULTS"
            },
            {
                id: "how-to-play",
                bgCls: "fn-vhr-menu-right-bg",
                cls: "fn-menu-title-how",
                txt: "HOW TO PLAY"
            }
        ];


        $scope.isActive = function (viewLocation) {
            if (viewLocation === "/virtualhorseracing/" && $location.path() === "/virtualhorseracing") {
                return true;
            } else if (viewLocation === "/virtualhorseracing/how-to-play" && $location.path() === "/virtualhorseracing/rules") {
                return true;
            }
            return viewLocation === $location.path();
        };


        // $scope.menuShown = false;
        //
        // $scope.menuToggleFn = function() {
        //     $scope.menuShown = !$scope.menuShown;
        //     $scope.menuDisplay = $scope.menuShown === true ? {'display':'block'} : {};
        // };

        $scope.bannerURL = function() {
          return "../../img/bg/bg_cold.png";
        };
    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVHRResultsController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Virtual Horse Racing - Previous Results");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// // alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
 			if(json.body.vhr.previous.length>0){
 				$.each(json.body.vhr.previous, function(i,obj) {
 					var slide='';
					try{
						if(json.body.vhr.previous.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}
		$(document).ready(function(){
			var findLatestFlag=0;
			var currentDate = new Date();

      var currentDay = ("0" + currentDate.getDate()).slice(-2);
      var currentMonth = ("0" + (currentDate.getMonth()+1)).slice(-2);
		  var currentYear = currentDate.getFullYear();

			var selectedDay = currentDay;
			var selectedMonth = currentMonth;
			var selectedYear = currentYear;

			var firstDay="22";
			var firstMonth="05";
			var firstYear="2002";

      var firstDate = $scope.dateStringFromComponents(firstYear, firstMonth, firstDay);
      var selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
      var currentDate = $scope.dateStringFromComponents(currentYear, currentMonth, currentDay);

			function getBallColor(num){
		        var index  = (num-1) % 7;
		        var colors = ["green","red","orange","yellow","brown","purple","blue"];
		        return colors[index];
			}

			function getLotteryData(){
				$.ajax({
					url: $scope.baseURL+'/games/get_previous_results',
					type: 'post',
                                        contentType: "application/json; charset=utf-8",
					dataType: 'json',
					data:  JSON.stringify({"game_type":"vhr","date": selectedDate}),
					beforeSend: function() {
						$( ".no-results-for-date" ).remove();
						$('#main-spinner').css( "display","inline-block" );
						$('.resoults-middle-container').css( "display","none" );
					},
					complete: function() {
						//alert('complete');
					},
					success: handleData,
					error: function(){
						// alert('Connection error! Please try again.');
					}
				});
			}

 			function handleData(json) {
 				if (jQuery.isEmptyObject(json.body.locations)){
 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('#main-spinner').after( "<div class='no-results-for-date'><h1>No Results</h1></div>");

 				}else{


 					$( ".no-results-for-date" ).remove();
 					$('#main-spinner').css( "display","none" );
 					$('.resoults-middle-container').css( "display","inline-block" );

 					$("#location-list li").remove();
 					$("#location-content li").remove();

 					var location_nb=0;
 					var race_nb=0;
 					var race_content='';
 					$.each(json.body.locations, function() {
 						location_nb=location_nb+1;
 						race_nb=0;
 						position_nb=0;
 						position_end='th';

             if (this.location.toUpperCase() === "SPRINTVALLEY") {
               this.location = "SPRINT VALLEY";
             }

 						$("#location-list").append('<li ><span data-toggle="tab" href="#location_tab_'+location_nb+'">'+this.location.toUpperCase()+'</span></li>');//fill out locations tabs menu
 						$("#location-list li").first().addClass("active");// set active location tab menu

 						$("#location-content").append('<li class="tab-pane fade in" id="location_tab_'+location_nb+'"><div class="clearfix" ><ul id="race_content_'+location_nb+'" class="tab-content"> </ul></div><ul class="race_nav" id="race_'+location_nb+'"></ul></li>');//fill out locations tabs content
 						$("#location-content li").first().addClass("active");// set active location tab

 						$.each(this.races, function() {
 							position_nb=0;
 							race_nb=race_nb+1;
 							$('#race_'+location_nb).append('<li><span href="#race_'+location_nb+'_'+race_nb+'" data-toggle="tab" class="btn btn-sm">Race '+race_nb+'</span></li>');
 							//$('#race_'+location_nb+' li').first().addClass("active");// set active race tab

 							$('#race_content_'+location_nb).append('<li class="tab-pane fade in " id="race_'+location_nb+'_'+race_nb+'" ></li>');
 							//$('#race_content_'+location_nb+' li').first().addClass("active");// set active race tab

 							//adding content
              if (this.status != 0) {
   							race_content='<div class="fn-race-info">'
   										+'<span style="font-size:1.3em">RACE '+race_nb+'</span>'
   										+'   <br/>'
   										+'   <span class="fn-result-accent-text">'+this.race_time+'</span>'
   										+'   <hr>';
  			 							if(this.fc!=null && this.fc!=''){
  			 								race_content+='  F/C '+numeral(this.fc).format('0,0.00')+'';
  			 							}
  			 							race_content+='    <br/>';
  			 							if(this.tc!=null && this.tc!=''){
  			 								race_content+='   T/C '+numeral(this.tc).format('0,0.00')+''
  			 							}
  			 							race_content+='</div>'
  											+'<div class="fn-racing-list">'
  											+'    <ul>'
  			 							$.each(this.positions, function() {
  			 								position_nb=this.position;
  			 								if(position_nb==1){position_end='st';}
  			 								if(position_nb==2){position_end='nd';}
  			 								if(position_nb==3){position_end='rd';}
  			 								if(position_nb==4){position_end='th';}
  			 								race_content+='        <li>'
  	 										+'            <div class="fn-racing-place">'
  	 										+'            '+position_nb+'<sup>'+position_end+'</sup>'
  	 										+'           </div><div class="fn-racing-stats">'
  	 										+'           <div class="fn-result-accent-text" >'+this.runner_number+'</div>'
                        +'           '+this.name+''
                        +'           <div class="fn-results-odds-container"><span class="fn-results-odds">'+this.fract+'</span>'
  			 								+'           <span class="fn-result-fav">'+(this.fav).toUpperCase()+'</span></div>'
  	 										+'           </div></li>'
  			 							});
   							race_content+='   </ul>'
   										+'</div>';
   								$('#race_'+location_nb+'_'+race_nb).html(race_content);
			                } else {
			                  $('#race_'+location_nb+'_'+race_nb).html("<div class='no-results-for-num-draw'><h1>No Results Available</h1></div>");
			                }
 						});
 	 					//set current last race active
 						$('#location-content li ul li:last-child').addClass("active");
 						$('#location-content li div ul li:last-child').addClass("active");


 					});
 				}
 	    		updateDaySwitchers();
 			}

			function populateSelectBoxes(){
				//populate months select box and set current month
				$('#month option:eq('+(selectedMonth-1)+')').prop('selected', true);
				//populate years select box and set last as selected
				var yearsArray = new Array();
				for (i=0;(currentYear-i)>=firstYear;i++){
					yearsArray[i]=currentYear-i;
				}
				$("#year").empty();
				$.each(yearsArray, function(val, text) {
		            $('#year').append(
		                $('<option></option>').val(text).html(text)
		            );
				});
				$('#year option[value="'+selectedYear+'"]').prop('selected', true);
			}

			function updateDaySwitchers(){
				if(new Date(selectedDate) <= new Date(firstDate)  ){
					$('#previous-day').css( "display","none" );
				}else{
					$('#previous-day').css( "display","inline-block" );
				}

				if(new Date(selectedDate) >= new Date(currentDate)  ){
					$('#next-day').css( "display","none" );
				}else{
					$('#next-day').css( "display","inline-block" );
				}

				//update text on day switchers
				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateBefore).toLowerCase();
				dayNumber = $scope.getDayNumber(dateBefore);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#previous-day-button').html(dayName+' '+dayNumber+dayEnd);

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dayName = $scope.getShortDayName(dateAfter).toLowerCase();
				dayNumber = $scope.getDayNumber(dateAfter);
        dayEnd = $scope.ordinalForDayNumber(dayNumber);
				$('#next-day-button').html(dayName+' '+dayNumber+dayEnd);
			}

			function disableSelectBoxesOptions(){
				if($( "#year" ).val() == currentYear){
					if(currentMonth<1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(currentMonth<2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(currentMonth<3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(currentMonth<4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(currentMonth<5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(currentMonth<6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(currentMonth<7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(currentMonth<8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(currentMonth<9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(currentMonth<10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(currentMonth<11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(currentMonth<12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else if ($( "#year" ).val() == firstYear){
					if(firstMonth>1){ $("#month option[value='1']").attr('disabled','disabled');}else{$("#month option[value='1']").removeAttr('disabled');}
					if(firstMonth>2){ $("#month option[value='2']").attr('disabled','disabled');}else{$("#month option[value='2']").removeAttr('disabled');}
					if(firstMonth>3){ $("#month option[value='3']").attr('disabled','disabled');}else{$("#month option[value='3']").removeAttr('disabled');}
					if(firstMonth>4){ $("#month option[value='4']").attr('disabled','disabled');}else{$("#month option[value='4']").removeAttr('disabled');}
					if(firstMonth>5){ $("#month option[value='5']").attr('disabled','disabled');}else{$("#month option[value='5']").removeAttr('disabled');}
					if(firstMonth>6){ $("#month option[value='6']").attr('disabled','disabled');}else{$("#month option[value='6']").removeAttr('disabled');}
					if(firstMonth>7){ $("#month option[value='7']").attr('disabled','disabled');}else{$("#month option[value='7']").removeAttr('disabled');}
					if(firstMonth>8){ $("#month option[value='8']").attr('disabled','disabled');}else{$("#month option[value='8']").removeAttr('disabled');}
					if(firstMonth>9){ $("#month option[value='9']").attr('disabled','disabled');}else{$("#month option[value='9']").removeAttr('disabled');}
					if(firstMonth>10){ $("#month option[value='10']").attr('disabled','disabled');}else{$("#month option[value='10']").removeAttr('disabled');}
					if(firstMonth>11){ $("#month option[value='11']").attr('disabled','disabled');}else{$("#month option[value='11']").removeAttr('disabled');}
					if(firstMonth>12){ $("#month option[value='12']").attr('disabled','disabled');}else{$("#month option[value='12']").removeAttr('disabled');}
				}else{
					$("#month option[value='1']").removeAttr('disabled');
					$("#month option[value='2']").removeAttr('disabled');
					$("#month option[value='3']").removeAttr('disabled');
					$("#month option[value='4']").removeAttr('disabled');
					$("#month option[value='5']").removeAttr('disabled');
					$("#month option[value='6']").removeAttr('disabled');
					$("#month option[value='7']").removeAttr('disabled');
					$("#month option[value='8']").removeAttr('disabled');
					$("#month option[value='9']").removeAttr('disabled');
					$("#month option[value='10']").removeAttr('disabled');
					$("#month option[value='11']").removeAttr('disabled');
					$("#month option[value='12']").removeAttr('disabled');
				}

        if ($( "#month" ).val() < parseInt(firstMonth)){
          $("#year option[value='"+firstYear+"']").attr('disabled','disabled');
        } else {
          $("#year option[value='"+firstYear+"']").removeAttr('disabled');
        }
			}

			function setMonthlySwitchers(){
				var previousMonths = new Array();
				previousMonths[1]='December';
				previousMonths[2]='January';
				previousMonths[3]='February';
				previousMonths[4]='March';
				previousMonths[5]='April';
				previousMonths[6]='May';
				previousMonths[7]='June';
				previousMonths[8]='July';
				previousMonths[9]='August';
				previousMonths[10]='September';
				previousMonths[11]='October';
				previousMonths[12]='November';
				previousMonthText=previousMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==1){
            		previousMonthText+=$( "#year" ).val()-1;
            	}else{
            		previousMonthText+=$( "#year" ).val();
            	}
            	$('#previous-month-switch').html(previousMonthText);

				var nextMonths = new Array();
				nextMonths[1]='February';
				nextMonths[2]='March';
				nextMonths[3]='April';
				nextMonths[4]='May';
				nextMonths[5]='June';
				nextMonths[6]='July';
				nextMonths[7]='August';
				nextMonths[8]='September';
				nextMonths[9]='October';
				nextMonths[10]='November';
				nextMonths[11]='December';
				nextMonths[12]='January';

				nextMonthText=nextMonths[$( "#month" ).val()]+' ';
            	if($( "#month" ).val()==12){
            		nextMonthText+=(parseInt($( "#year" ).val())+1);
            	}else{
            		nextMonthText+=$( "#year" ).val();
            	}
            	$('#next-month-switch').html(nextMonthText);
            	//disable next month button
            	if(selectedYear == currentYear && selectedMonth >= currentMonth){
            		$('#nextMonthClick').css( "display","none" );
            	}else{
					$('#nextMonthClick').css( "display","inline-block" );
            	}
            	//disable previous month button
            	if(selectedYear == firstYear && selectedMonth <= firstMonth){
            		$('#prevMonthClick').css( "display","none" );
            	}else{
					$('#prevMonthClick').css( "display","inline-block" );
            	}
			}
			function scrollToSelectedPosition(){
				var selectedElement=$( ".days-controls-selected" );
				var position = selectedElement.position();
				//$( "#days-list-vhr" ).animate({left: -position.left}, 500, function() { });
				$( "#days-list-vhr" ).css("left", -position.left);
			}

			function setDaysSlider(){
				$("#days-list-vhr").empty();

				//selected main element
				if(new Date(selectedDate) >= new Date(firstDate) &&  new Date(selectedDate) <= new Date(currentDate) ){
					$("#days-list-vhr").append('<li class="days-controls-selected"><a href="#" class="dayselect-vhr" data-position="0"  data-date="'+selectedDate+'">'+$scope.getShortDayName(selectedDate)+'<br><span class="dayNum">'+$scope.getDayNumber(selectedDate)+'</span></a></li>');
				}
				//prepened options
				daybefore = $scope.getDateBeforeDate(selectedDate);

				if(new Date(daybefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-1"  data-date="'+daybefore+'">'+$scope.getShortDayName(daybefore)+'<br><span class="dayNum">'+$scope.getDayNumber(daybefore)+'</span></a></li>');
				}

				twodaysbefore = $scope.getDateBeforeDate(daybefore);
				if(new Date(twodaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-3"  data-date="'+twodaysbefore+'">'+$scope.getShortDayName(twodaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysbefore)+'</span></a></li>');
				}

				threedaysbefore = $scope.getDateBeforeDate(twodaysbefore);
				if(new Date(threedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-4"  data-date="'+threedaysbefore+'">'+$scope.getShortDayName(threedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysbefore)+'</span></a></li>');
				}

				fourdaysbefore = $scope.getDateBeforeDate(threedaysbefore);
				if(new Date(fourdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-5"  data-date="'+fourdaysbefore+'">'+$scope.getShortDayName(fourdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysbefore)+'</span></a></li>');
				}

				fivedaysbefore = $scope.getDateBeforeDate(fourdaysbefore);
				if(new Date(fivedaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-6"  data-date="'+fivedaysbefore+'">'+$scope.getShortDayName(fivedaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysbefore)+'</span></a></li>');
				}

				sixdaysbefore = $scope.getDateBeforeDate(fivedaysbefore);
				if(new Date(sixdaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-7"  data-date="'+sixdaysbefore+'">'+$scope.getShortDayName(sixdaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysbefore)+'</span></a></li>');
				}

				sevendaysbefore = $scope.getDateBeforeDate(sixdaysbefore);
				if(new Date(sevendaysbefore) >= new Date(firstDate)  ){
					$("#days-list-vhr").prepend('<li><a href="#" class="dayselect-vhr" data-position="-8"  data-date="'+sevendaysbefore+'">'+$scope.getShortDayName(sevendaysbefore)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysbefore)+'</span></a></li>');
				}

				//appended options
				dayafter = $scope.getDateAfterDate(selectedDate);
				if(new Date(dayafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="1"  data-date="'+dayafter+'">'+$scope.getShortDayName(dayafter)+'<br><span class="dayNum">'+$scope.getDayNumber(dayafter)+'</span></a></li>');
				}

				twodaysafter = $scope.getDateAfterDate(dayafter);
				if(new Date(twodaysafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="2"  data-date="'+twodaysafter+'">'+$scope.getShortDayName(twodaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(twodaysafter)+'</span></a></li>');
				}

				threedaysafter = $scope.getDateAfterDate(twodaysafter);
				if(new Date(threedaysafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="3"  data-date="'+threedaysafter+'">'+$scope.getShortDayName(threedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(threedaysafter)+'</span></a></li>');
				}

				fourdaysafter = $scope.getDateAfterDate(threedaysafter);
				if(new Date(fourdaysafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="4"  data-date="'+fourdaysafter+'">'+$scope.getShortDayName(fourdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fourdaysafter)+'</span></a></li>');
				}

				fivedaysafter = $scope.getDateAfterDate(fourdaysafter);
				if(new Date(fivedaysafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="5"  data-date="'+fivedaysafter+'">'+$scope.getShortDayName(fivedaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(fivedaysafter)+'</span></a></li>');
				}

				sixdaysafter = $scope.getDateAfterDate(fivedaysafter);
				if(new Date(sixdaysafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="6"  data-date="'+sixdaysafter+'">'+$scope.getShortDayName(sixdaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sixdaysafter)+'</span></a></li>');
				}

				sevendaysafter = $scope.getDateAfterDate(sixdaysafter);
				if(new Date(sevendaysafter) <= new Date(currentDate)  ){
					$("#days-list-vhr").append('<li><a href="#" class="dayselect-vhr" data-position="7"  data-date="'+sevendaysafter+'">'+$scope.getShortDayName(sevendaysafter)+'<br><span class="dayNum">'+$scope.getDayNumber(sevendaysafter)+'</span></a></li>');
				}

				//$('#fdate').html(firstYear+'-'+firstMonth+"-"+firstDay);
				//$('#sdate').html(selectedYear+'-'+selectedMonth+"-"+selectedDay);
				//$('#cdate').html(currentYear+'-'+currentMonth+"-"+currentDay);

				scrollToSelectedPosition();
				populateSelectBoxes();
				disableSelectBoxesOptions();
				setMonthlySwitchers();
				updateDaySwitchers();
				getLotteryData();
			}


			//initiate everything
			populateSelectBoxes();
			setDaysSlider();

			$( "#month" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && parseInt(selectedMonth) == parseInt(firstMonth) && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
				// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			$( "#year" ).change(function() {

				//set year
				selectedYear=$( "#year" ).val();
				//set month
				if($( "#year" ).val() == firstYear && $( "#month" ).val() < firstMonth){
					selectedMonth = firstMonth;
				}else if($( "#year" ).val() == currentYear && $( "#month" ).val() > parseInt(currentMonth)){
					selectedMonth = currentMonth;
				}else{
					selectedMonth = $( "#month" ).val();
				}
				//set day
				if($( "#year" ).val() == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
					selectedDay = firstDay;
				}else if($( "#year" ).val() == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
					selectedDay = currentDay;
				}
				//make sure selected day isnt hire than days in month
				var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
				if(selectedDay > daysInMonth){
					selectedDay = daysInMonth;
				}
				// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
        selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

				setDaysSlider();
			});

			//on day selector click

			$('#days-list-vhr').on('click', ' a.dayselect-vhr', function(event) {
				event.preventDefault();
					dateArray=this.getAttribute("data-date").split("-");
					selectedDay = dateArray[2];
					selectedMonth = dateArray[1];
					selectedYear = dateArray[0];
					// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
          selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);
					setDaysSlider();
			});

			$("#prevMonthClick").click(function(event){
			    event.preventDefault();

				//set year
					selectedYear=$( "#year" ).val();
					//set month

					selectedMonth = $( "#month" ).val()-1;
					//switch to previous year
					if(selectedMonth==0){
						selectedMonth = 12;
						selectedYear = selectedYear-1;
					}
					if(selectedYear == firstYear && selectedMonth < firstMonth){
						selectedMonth = firstMonth;
					}
					//set day


					if(selectedYear == firstYear && selectedMonth == firstMonth && selectedDay < firstDay){
						selectedDay = firstDay;
					}
					//make sure selected day isnt hire than days in month
					var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
					if(selectedDay > daysInMonth){
						selectedDay = daysInMonth;
					}
					// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
          selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

					setDaysSlider();

			});

			$("#nextMonthClick").click(function(event){
			    event.preventDefault();
				//set year
					selectedYear=$( "#year" ).val();
					//set month

					selectedMonth = parseInt($( "#month" ).val())+1;

					//switch to previous year
					if(selectedMonth==13){
						selectedMonth = 1;
						selectedYear = parseInt(selectedYear)+1;
					}
					if(selectedYear == currentYear && selectedMonth > currentMonth){
						selectedMonth = currentMonth;
					}
					//set day
					if(selectedYear == currentYear && selectedMonth == currentMonth && selectedDay > currentDay){
						selectedDay = currentDay;
					}
					//make sure selected day isnt hire than days in month
					var daysInMonth = new Date(selectedYear,selectedMonth,1,-1).getDate();
					if(selectedDay > daysInMonth){
						selectedDay = daysInMonth;
					}
					// selectedDate = selectedYear+'-'+selectedMonth+'-'+selectedDay;
          selectedDate = $scope.dateStringFromComponents(selectedYear, selectedMonth, selectedDay);

					setDaysSlider();
			});

			//on previous day click
			$( "#next-day" ).click(function( event ) {
				event.preventDefault();

				dateAfter=$scope.getDateAfterDate($( ".days-controls-selected a" ).attr('data-date'));
				dateAfterArray=dateAfter.split("-");

				if(new Date(dateAfter) > new Date(currentDate)  ){
				}else{
					selectedDay = dateAfterArray[2];
						selectedMonth = dateAfterArray[1];
 					selectedYear = dateAfterArray[0] ;

 					selectedDate = dateAfter;
				}
					setDaysSlider();
			});
			//on next day click
			$( "#previous-day" ).click(function( event ) {
				event.preventDefault();

				dateBefore=$scope.getDateBeforeDate($( ".days-controls-selected a" ).attr('data-date'));
				dateBeforeArray=dateBefore.split("-");
				if(new Date(dateBefore) < new Date(firstDate)  ){

				}else{
					selectedDay = dateBeforeArray[2];
						selectedMonth = dateBeforeArray[1];
 					selectedYear = dateBeforeArray[0] ;

					selectedDate = dateBefore;
				}
					setDaysSlider();
			});
		});

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.Controllers = angular.module('FNApp.FNControllers');

FN.Controllers.controller('FNVHRRulesController', [
    '$scope',
    function($scope) {

      $scope.setTitle("Virtual Horse Racing - Rules");


        /* load hero images */
		$.ajax({
			url: $scope.baseURL+'/img/get_image_urls',
			type: 'post',
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: handleSliderData,
			error: function(){
				// alert('Connection error! Please try again.');
			}
		});
		function handleSliderData(json) {
			if(json.body.vhr.rules.length>0){
 				$.each(json.body.vhr.rules, function(i,obj) {
 					var slide='';
					try{
						if(json.body.vhr.rules.length>1){
 							$(".carousel-indicators").append('<li data-target="#smallCarousel" data-slide-to="'+i+'"></li>');
 						}
						slide+='<div class="item">';
						if(this.url!=null && this.url.length > 0){slide+='<a href="'+this.url+'"> '; }
						slide+='<img class="first-slide" src="'+this.image_url+'" alt="49s promotional image" >';
						if(this.url!=null && this.url.length > 0){slide+='</a>'; }
						slide+='</div>';
 						$(".carousel-inner").append(slide);
					}catch(e){}
 				});
 				$(".carousel-indicators li:first").addClass("active");
 				$(".carousel-inner > div:nth-of-type(1)").addClass("active");
 				$('.carousel').carousel({ interval: 3000 });
 			}
		}

    }]
);

window.FN = window.FN || {};
window.FN = {};

FN.App = angular.module('FNApp', [
  'ngRoute',
  'ngSanitize',
  'ngResource',
  'ngCookies',
  'FNApp.FNControllers',
  'FNApp.FNServices',
  'FNApp.FNDirectives',
  'ngMap',
  'noCAPTCHA'
  ]
);

FN.App.config(['$routeProvider', '$locationProvider','noCAPTCHAProvider',
    function($routeProvider, $locationProvider,noCaptchaProvider) {
		var ip = location.host;
		//49s live server key
		if(ip=='193.41.102.6' || ip=='172.25.70.150' || ip=='49s.co.uk' || ip=='www.49s.co.uk' || ip=='winonnumbers.com' || ip=='www.winonnumbers.com' ){ noCaptchaProvider.setSiteKey('6LchGA0TAAAAAC7453EevLimYoF9nuDfjvkn_4V1');}
		//49s dev server key
		if(ip=='193.41.102.7' || ip=='172.25.70.158' ){ noCaptchaProvider.setSiteKey('6LcLGA0TAAAAAK3UomowzdS__ujiwrlFajhQ9-j6');}
		//amazon dev server key
		if(ip=='54.194.234.251'){ noCaptchaProvider.setSiteKey('6Le2GQ0TAAAAAPbWQO-RiaQnSOQwTIJ1_EHz1Knt');}


		noCaptchaProvider.setTheme('light');




        $routeProvider.
            when('/', {
                templateUrl: 'partials/home/home.html',
                controller: 'FNHomeController'
            }).
            /* 49s */
            when('/49s', {
                templateUrl: 'partials/49s/49s_home.html',
                controller: 'FNFNHomeController'
            }).
            when('/49s/hot-cold', {
                templateUrl: 'partials/49s/49s_hot_cold.html',
                controller: 'FNFNHotColdController'
            }).
            when('/49s/previous', {
                templateUrl: 'partials/49s/49s_previous.html',
                controller: 'FNFNResultsController'
            }).
            when('/49s/lucky-dip', {
                templateUrl: 'partials/49s/49s_lucky-dip.html',
                controller: 'FNFNLuckyDipController'
            }).
            when('/49s/syndicates', {
                templateUrl: 'partials/49s/49s_syndicates.html',
                controller: 'FNFNSyndicatesController'
            }).
            when('/49s/presenters', {
                templateUrl: 'partials/49s/49s_presenters.html',
                controller: 'FNFNPresentersController'
            }).
            when('/49s/how-to-play', {
                templateUrl: 'partials/49s/49s_how-to-play.html',
                controller: 'FNFNHowToPlayController'
            }).
             when('/49s/miss-smiley', {
                templateUrl: 'partials/49s/49s_miss_smiley.html',
                controller: 'FNFNmisssmileyController'
            }).
            when('/49s/rules', {
                templateUrl: 'partials/49s/49s_rules.html',
                controller: 'FNFNRulesController'
            }).

            /* ILB */
            when('/irishlottobet', {
                templateUrl: 'partials/irishlotto/IL_home.html',
                controller: 'FNILHomeController'
            }).
            when('/irishlottobet/hot-cold', {
                templateUrl: 'partials/irishlotto/IL_hot_cold.html',
                controller: 'FNILHotColdController'
            }).
            when('/irishlottobet/previous', {
                templateUrl: 'partials/irishlotto/IL_previous.html',
                controller: 'FNILResultsController'
            }).
            when('/irishlottobet/lucky-dip', {
                templateUrl: 'partials/irishlotto/IL_lucky-dip.html',
                controller: 'FNILLuckyDipController'
            }).
            when('/irishlottobet/syndicates', {
                templateUrl: 'partials/irishlotto/IL_syndicates.html',
                controller: 'FNILSyndicatesController'
            }).
            when('/irishlottobet/winners', {
                templateUrl: 'partials/irishlotto/IL_winners.html',
                controller: 'FNILWinnersController'
            }).
            when('/irishlottobet/how-to-play', {
                templateUrl: 'partials/irishlotto/IL_how-to-play.html',
                controller: 'FNILHowToPlayController'
            }).
            when('/irishlottobet/rules', {
                templateUrl: 'partials/irishlotto/IL_rules.html',
                controller: 'FNILRulesController'
            }).

            /* VHR */
            when('/virtualhorseracing', {
                templateUrl: 'partials/horseracing/VHR_home.html',
                controller: 'FNVHRHomeController'
            }).
            when('/virtualhorseracing/previous', {
                templateUrl: 'partials/horseracing/VHR_previous.html',
                controller: 'FNVHRResultsController'
            }).
            when('/virtualhorseracing/how-to-play', {
                templateUrl: 'partials/horseracing/VHR_how-to-play.html',
                controller: 'FNVHRHowToPlayController'
            }).
            when('/virtualhorseracing/rules', {
                templateUrl: 'partials/horseracing/VHR_rules.html',
                controller: 'FNVHRRulesController'
            }).

            /* VGR */
            when('/virtualgreyhoundracing', {
                templateUrl: 'partials/greyhoundracing/VGR_home.html',
                controller: 'FNVGRHomeController'
            }).
            when('/virtualgreyhoundracing/previous', {
                templateUrl: 'partials/greyhoundracing/VGR_previous.html',
                controller: 'FNVGRResultsController'
            }).
            when('/virtualgreyhoundracing/how-to-play', {
                templateUrl: 'partials/greyhoundracing/VGR_how-to-play.html',
                controller: 'FNVGRHowToPlayController'
            }).
            when('/virtualgreyhoundracing/rules', {
                templateUrl: 'partials/greyhoundracing/VGR_rules.html',
                controller: 'FNVGRRulesController'
            }).

            /* RAPIDO */
            when('/rapido', {
                templateUrl: 'partials/rapido/rapido_home.html',
                controller: 'FNRapidoHomeController'
            }).
            when('/rapido/previous', {
                templateUrl: 'partials/rapido/rapido_previous.html',
                controller: 'FNRapidoResultsController'
            }).
            when('/rapido/how-to-play', {
                templateUrl: 'partials/rapido/rapido_how-to-play.html',
                controller: 'FNRapidoHowToPlayController'
            }).
            when('/rapido/rules', {
                templateUrl: 'partials/rapido/rapido_rules.html',
                controller: 'FNRapidoRulesController'
            }).


            /* OTHER */
            when('/findbettingShop', {
                templateUrl: 'partials/bettingshop/findbettingshop.html',
                controller: 'FNBettingShopController'
            }).
            when('/thefount', {
                templateUrl: 'partials/oracle/oracle.html',
                controller: 'FNOracleController'
            }).
            when('/bethere', {
                templateUrl: 'partials/static/bethere.html',
                controller: 'FNBetHereController'
            }).
            when('/stayintouch', {
                templateUrl: 'partials/stayintouch/stayintouch.html',
                controller: 'FNStayInTouchController'
            }).
            when('/responsible', {
                templateUrl: 'partials/static/responsible.html',
                controller: 'FNResponsibleController'
            }).
            when('/mobileapp', {
                templateUrl: 'partials/static/mobileapp.html',
                controller: 'FNMobileAppController'
            }).
            when('/help', {
                templateUrl: 'partials/static/help.html',
                controller: 'FNHelpController'
            }).
            when('/legal', {
                templateUrl: 'partials/static/legal.html',
                controller: 'FNLegalController'
            }).
            when('/contact', {
                templateUrl: 'partials/contact/contact.html',
                controller: 'FNContactController'
            }).
           /* when('/feedback', {
                templateUrl: 'partials/stayintouch/feedback.html',
                controller: 'FNFeedbackController'
            }).*/
            otherwise({
                redirectTo: '/'
            });
        $locationProvider.html5Mode(true).hashPrefix('!');
    }]
);


FN.App.run(['$rootScope', '$location', '$window', '$timeout', function($rootScope, $location, $window, $timeout){





    $rootScope.showVersion = true;
    $rootScope.versionNum = "v0.8.22";
    $rootScope.location = $location;
    var ip = location.host;
    //49s live
	//if(ip=='193.41.102.6' || ip=='49s.co.uk' || ip=='www.49s.co.uk' ){  $rootScope.baseURL = "https://api.49s.co.uk/index.php";}
	//49s dev 
//	if(ip=='193.41.102.7'){ $rootScope.baseURL = "http://193.41.102.7/index.php";}
	//amazon dev
	//if(ip=='54.194.234.251'){ $rootScope.baseURL = "http://54.194.234.251/index.php";}
	//localhost
//	if(ip=='localhost:3333'){ $rootScope.baseURL = "http://www.webtechmedia.com/index.php"; }
	
	//if(ip=='webtechmedia.com'){ $rootScope.baseURL = "http://www.webtechmedia.com/index.php"; }
     
	//if(ip=='winonnumbers.com'){ $rootScope.baseURL = "https://api.49s.co.uk/index.php"; }
	//if(ip=='www.winonnumbers.com'){ $rootScope.baseURL = "https://api.49s.co.uk/index.php"; }
	
	// $rootScope.baseURL = "http://productionwebelb-1900518919.eu-west-1.elb.amazonaws.com/index.php"; 
	$rootScope.baseURL = "/index.php"; 
	

    $rootScope.online = navigator.onLine;


    $window.addEventListener("offline", function () {
      $rootScope.$apply(function() {
        console.log("offline");
        $rootScope.online = false;
      });
    }, false);
    $window.addEventListener("online", function () {
      $rootScope.$apply(function() {
        console.log("online");
        $rootScope.online = true;
      });
    }, false);

    $rootScope.pageTitle = "49's";
    $rootScope.setTitle = function(title) {
      $rootScope.pageTitle = title;
    }

    $rootScope.colorForNumber = function(num) {
        var index  = (num-1) % 7;
        var colors = ["green","red","orange","yellow","brown","purple","blue"];
        return colors[index];
    };

    $rootScope.colorForCoin = function(num) {
      if (num <= 40) {
        return "red";
      }
      return "black";
    };

    $rootScope.isMobileDevice = function() {
        return /Android|HTC|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
    };



    var shareHolderNames = ["williamhill", "coral", "ladbrokes"];

    var shareholders = {
      "williamhill" : {
        id: "williamhill",
        cls: "fn-operator-willhill",
        link:"http://www.williamhill.com/promos/49s?mobilefriendly"
      },
      "coral" : {
        id: "coral",
        cls: "fn-operator-coral",
        link:"http://sports.coral.co.uk/lotto"
      },
      "ladbrokes" : {
        id: "ladbrokes",
        cls: "fn-operator-ladbrokes",
        link:"http://www.ladbrokes.com/ppc/sports/en/lottery/"
      }
    };


    $rootScope.$on('$locationChangeStart', function(event) {
      //is competition?
      if ($location.url() === "/competition") {
        if (typeof angular.element($('#FNCompetition')).scope() != 'undefined') {
          angular.element($('#FNCompetition')).scope().checkForCompetitions();
          event.preventDefault();
          // $location.hash('');
        }
      }
    });




    $rootScope.$on('$locationChangeSuccess', function() {

		//Google Analytics
        if (!$window.ga){
        	return;
        }else{
        	 $window.ga('send', 'pageview', { page: $location.path() });
        }



      //close menuShown
      $rootScope.mainMenuShown = false;
      $rootScope.menuShown = false;
      $rootScope.updateMenuStyle();

      $window.scrollTo(0,0);
      //update twitter buttons
      setTimeout(function(){
        if ('twttr' in window && window['twttr'] !== null) {
          $('#footer-tw').html('');
          $('#footer-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$rootScope.location.absUrl()+'" data-text="" data-size="large" data-count="none">Tweet</a>');
          // $('#share-tw').html('');
          // $('#share-tw').html('<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+$rootScope.location.absUrl()+'" data-text="" data-size="large" data-count="none">Tweet</a>');
            twttr.widgets.load();
        }
      }, 500);
      $('#footer-mail').html('<a href="mailto:%20?subject=49s Website&body='+$rootScope.location.absUrl()+'"><img src="../../img/icons/ic_email.png"></a>');

      //update shareholder logos
      var uniques = chance.unique(chance.natural, 3, {min: 0, max: 2});
      $rootScope.shareholderNames = [shareHolderNames[uniques[0]], shareHolderNames[uniques[1]], shareHolderNames[uniques[2]]];
      $rootScope.shareholderBoxes = [{"name":shareHolderNames[uniques[0]]}, {"name":shareHolderNames[uniques[1]]}, {"name":shareHolderNames[uniques[2]]}];
      $rootScope.shareholderOptions = [shareholders[$rootScope.shareholderNames[0]], shareholders[$rootScope.shareholderNames[1]],shareholders[$rootScope.shareholderNames[2]]];

    });
/*
    $rootScope.feedback = {};
    $rootScope.resetFeedback = function() {
      $rootScope.feedback = {};
    };
*/
    $rootScope.menuShown = false;
    $rootScope.menuToggleFn = function() {
        $rootScope.menuShown = !$rootScope.menuShown;
        $rootScope.updateMenuStyle();
    };


    $rootScope.mainMenuShown = false;
    $rootScope.mainMenuToggleFn = function() {
        $rootScope.mainMenuShown = !$rootScope.mainMenuShown;
        $rootScope.updateMenuStyle();
    };

    $rootScope.updateMenuStyle = function() {
      $rootScope.menuDisplay = $rootScope.menuShown === true ? {'display':'block'} : {};
      $rootScope.mainMenuDisplay = $rootScope.mainMenuShown === true ? {'display':'block'} : {};
    };


    //DATE STUFF

    $rootScope.ordinalForDayNumber = function(dayNumber) {

      if (dayNumber > 0) {
        var lastDigit = dayNumber % 10;
        var dayEnd = 'th';
        if (dayNumber != 11 && dayNumber != 12 && dayNumber != 13) {
          if(lastDigit == 1){dayEnd = 'st'}
          if(lastDigit == 2){dayEnd = 'nd'}
          if(lastDigit == 3){dayEnd = 'rd'}
        }

        return dayEnd;
      }
      return "";

    }

    $rootScope.getDayName = function(date){
      var dayDate = new Date(date);
      var weekday = new Array(7);
      weekday[0]=  "SUNDAY";
      weekday[1] = "MONDAY";
      weekday[2] = "TUESDAY";
      weekday[3] = "WEDNESDAY";
      weekday[4] = "THURSDAY";
      weekday[5] = "FRIDAY";
      weekday[6] = "SATURDAY";
      var dayName = weekday[dayDate.getDay()];
      return dayName;
    }

    $rootScope.getShortDayName = function(date) {
        var name = $rootScope.getDayName(date);
        return name.substring(0, 3);
    }

    $rootScope.getDayNumber = function(date){
      var dayDate = new Date(date);
      return dayDate.getDate();
    }

    $rootScope.getDateBeforeDate = function(date) {
        var newDate = new Date(date);
        newDate.setDate(newDate.getDate()-1);
        return newDate.getFullYear()+ '-' +("0" + (newDate.getMonth()+1)).slice(-2)+ '-' +("0" + newDate.getDate()).slice(-2);
    }

    $rootScope.getDateAfterDate = function(date) {
        var newDate = new Date(date);
        newDate.setDate(newDate.getDate()+1);
        return newDate.getFullYear()+ '-' +("0" + (newDate.getMonth()+1)).slice(-2)+ '-' +("0" + newDate.getDate()).slice(-2);
    }


    $rootScope.dateForWebService = function(date) {
        return date.getFullYear()+ '-' +date.getMonth()+ '-' +date.getDate();
    }

    $rootScope.dateStringFromComponents = function(year, month, day) {
      return year + '-' +("0" + month).slice(-2)+ '-' +("0" + day).slice(-2);
    }

    //Utilities
    $rootScope.sortNumber = function(a,b) {
      return a - b;
    }


}]);


FN.App.directive("videoOverlay", function(){
    return {
        restrict: "E",
        templateUrl: 'partials/fragment/video_overlay.html'
    }
});


//# sourceMappingURL=FNApp.js.map
