var stage = null;
var framerate = 12;
var stageWidth = 900;
var stageHeight = 516;
var bugAnim = { "framerate":12, "images":[ "bugAnim_0.png", "bugAnim_1.png", "bugAnim_2.png", "bugAnim_3.png", "bugAnim_4.png" ], "frames":[ [0, 532, 355, 89, 4, -276, -197], [1622, 268, 357, 95, 4, -275, -192], [1250, 268, 372, 184, 4, -272, -148], [854, 268, 396, 244, 4, -270, -118], [913, 0, 430, 330, 3, -267, -75], [765, 912, 442, 384, 0, -266, -48], [1320, 0, 437, 450, 0, -263, -15], [440, 0, 438, 482, 0, -262, 0], [0, 0, 440, 488, 0, -260, 0], [878, 0, 442, 478, 0, -259, 0], [345, 488, 439, 422, 0, -261, -24], [1207, 912, 442, 384, 0, -258, -41], [0, 1300, 443, 372, 0, -256, -47], [443, 1300, 445, 370, 0, -254, -49], [888, 1300, 445, 367, 0, -252, -52], [1341, 1098, 446, 366, 1, -250, -53], [0, 1464, 447, 366, 1, -250, -53], [0, 0, 447, 366, 2, -250, -53], [894, 366, 447, 366, 2, -250, -53], [1341, 366, 447, 366, 2, -250, -53], [0, 732, 447, 366, 2, -250, -53], [447, 732, 447, 366, 2, -250, -53], [894, 1098, 447, 366, 1, -250, -53], [447, 1098, 447, 366, 1, -250, -53], [894, 0, 447, 366, 1, -250, -53], [447, 0, 447, 366, 1, -250, -53], [0, 0, 447, 366, 1, -250, -53], [1341, 1672, 447, 366, 0, -250, -53], [1333, 1300, 447, 367, 0, -249, -52], [1340, 732, 448, 366, 2, -247, -52], [896, 1098, 448, 359, 2, -253, -59], [458, 0, 455, 333, 3, -255, -77], [469, 1576, 469, 285, 3, -261, -105], [978, 0, 475, 266, 4, -272, -115], [903, 972, 483, 304, 3, -293, -98], [1315, 1463, 478, 334, 2, -326, -95], [1343, 0, 506, 329, 3, -328, -101], [967, 660, 515, 310, 3, -344, -114], [434, 972, 469, 305, 3, -429, -135], [445, 1463, 408, 340, 2, -492, -113], [784, 488, 367, 410, 0, -533, -106], [400, 912, 365, 388, 0, -535, -128], [0, 333, 352, 327, 3, -548, -189], [526, 268, 328, 253, 4, -572, -263], [1788, 1464, 250, 230, 1, -650, -286], [1788, 732, 170, 236, 1, -730, -280], [1898, 0, 125, 183, 2, -775, -333], [1788, 732, 113, 65, 2, -787, -451], [2033, 0, 5, 4, 0, -895, -512], [447, 1672, 447, 366, 0, -250, -53], [447, 1464, 447, 366, 1, -250, -53], [894, 1464, 447, 366, 1, -250, -53], [1341, 1464, 447, 366, 1, -250, -53], [894, 1672, 447, 366, 0, -250, -53], [447, 0, 447, 366, 2, -250, -53], [894, 0, 447, 366, 2, -250, -53], [1341, 0, 447, 366, 2, -250, -53], [0, 366, 447, 366, 2, -250, -53], [0, 1672, 447, 366, 0, -250, -53], [447, 366, 447, 366, 2, -250, -53], [894, 732, 446, 366, 2, -249, -53], [0, 1098, 446, 365, 2, -248, -54], [446, 1098, 450, 362, 2, -252, -55], [853, 1463, 462, 338, 2, -252, -71], [902, 1277, 481, 288, 3, -257, -101], [0, 0, 493, 268, 4, -264, -112], [0, 268, 526, 264, 4, -283, -110], [1453, 0, 537, 265, 4, -318, -105], [391, 1277, 511, 297, 3, -386, -82], [487, 660, 480, 310, 3, -414, -76], [0, 972, 434, 305, 3, -466, -60], [352, 333, 440, 321, 3, -460, -41], [0, 1277, 391, 299, 3, -509, -47], [1396, 1576, 328, 279, 3, -572, -66], [1788, 1672, 245, 320, 0, -655, -33], [1831, 488, 191, 345, 0, -709, -3], [1787, 0, 168, 298, 1, -732, 0], [1787, 1098, 172, 232, 1, -728, 0], [1888, 366, 120, 121, 2, -780, -58], [1955, 0, 49, 50, 1, -851, -53], [2038, 0, 1, 1, 0, 0, 0], [0, 1098, 447, 366, 1, -250, -53], [1341, 732, 447, 366, 1, -250, -53], [894, 732, 447, 366, 1, -250, -53], [447, 732, 447, 366, 1, -250, -53], [0, 732, 447, 366, 1, -250, -53], [1341, 366, 447, 366, 1, -250, -53], [894, 366, 447, 366, 1, -250, -53], [447, 366, 447, 366, 1, -250, -53], [0, 366, 447, 366, 1, -250, -53], [1341, 0, 446, 366, 1, -251, -53], [0, 0, 458, 333, 3, -239, -76], [0, 1576, 469, 286, 3, -242, -98], [493, 0, 485, 267, 4, -240, -89], [1482, 660, 479, 307, 3, -232, -58], [1282, 333, 494, 315, 3, -199, -34], [1386, 972, 477, 302, 3, -183, -24], [938, 1576, 458, 280, 3, -189, -25], [792, 333, 490, 316, 3, -122, -9], [1383, 1277, 492, 288, 3, -69, -27], [0, 660, 487, 312, 3, -54, -25], [0, 1463, 445, 343, 2, -43, -9], [1344, 1098, 428, 352, 2, 0, -3], [0, 912, 400, 388, 0, 0, -4], [1447, 488, 384, 406, 0, 0, -42], [0, 488, 345, 424, 0, 0, -70], [1151, 488, 296, 406, 0, 0, -51], [1757, 0, 276, 383, 0, 0, -72], [1780, 1300, 252, 332, 0, 0, -128], [1772, 1098, 268, 291, 2, 0, -178], [1788, 366, 242, 292, 1, 0, -193], [1649, 912, 173, 343, 0, 0, -173], [1822, 912, 143, 317, 0, 0, -197], [1788, 0, 110, 208, 2, 0, -234], [1788, 366, 100, 158, 2, 0, -292], [1965, 912, 41, 134, 0, 0, -315] ], "animations":{ "walk2": { "speed": 1, "frames": [ 16, 16, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80 ], "next": false }, "walk1": { "speed": 1, "frames": [ 16, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48 ], "next": false }, "Intro": { "speed": 1, "frames": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15], "next": false }, "walk3": { "speed": 1, "frames": [ 16, 16, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 48 ], "next": false } } };


var bugSprite = null;
var _THIS;
var clovers = [];
var amountChosen;
var frameFn;
var allNumbers;
var startButton;
var resetButton;
var buttonHelpers = [];

function bug() {

        this.canvas = null;
        this.width = stageWidth;
        this.height = stageHeight;
};

bug.prototype.init = function(div) {

		_THIS = this;

      var canvas = document.createElement('canvas');
      var inputDiv = document.getElementById('animDiv');

      canvas.id               = "anim";
      canvas.width            = stageWidth;
      canvas.height           = stageHeight;
      canvas.style.zIndex     = 100;
      canvas.style.position   = "relative";
      canvas.style.border     = "1px solid #bbb";

      inputDiv.appendChild(canvas);

      stage = new createjs.Stage("anim");
      stage.enableMouseOver();

      bugSprite = new createjs.Sprite(new createjs.SpriteSheet({images: [assets.getResult('bug1'), assets.getResult('bug2'), assets.getResult('bug3'), assets.getResult('bug4'), assets.getResult('bug5')], frames: bugAnim.frames , animations: bugAnim.animations}), "init");
      bugSprite.on("animationend", _THIS.handleAnimationEnd);
      bugSprite.gotoAndStop("Intro");

      bugSprite.x = 0;
      bugSprite.y = 0;

		stage.addChild(bugSprite);

    // startButton = _THIS.buttonWithText('START');
    // startButton.x = 450;
    // startButton.y = 330;
    // stage.addChild(startButton);
    // startButton.addEventListener("click", handleStartClick);
    // function handleStartClick(event) {
    //   startButton.visible = false;
    //   _THIS.start();
    // };


    resetButton = _THIS.buttonWithText('AGAIN?');
    resetButton.x = 450;
    resetButton.y = 330;
    stage.addChild(resetButton);
    resetButton.visible = false;
    resetButton.addEventListener("click", handleResetClick);
    function handleResetClick(event) {
      _THIS.reset();
    };

    this.intervalId = setInterval(function() {_THIS.update();}, 1000 / framerate);

    onResize();

    _THIS.start();
};

bug.prototype.reset = function() {
  _THIS.removeClovers();
  // startButton.visible = true;
  resetButton.visible = false;
  bugSprite.gotoAndStop("Intro");
  _THIS.start();
};

bug.prototype.start = function() {

    bugSprite.gotoAndPlay("Intro");

};

bug.prototype.addButtons = function() {

	var buttons = [];
	for (var i=0;i<5;i++) {

		var data = {
		    images: [assets.getResult('button')],
		    frames: { width: 91, height: 91},
		    animations: { normal: [0], hover: [1], clicked: [1] }
		};
		var spriteSheet = new createjs.SpriteSheet(data);
		var button = new createjs.Sprite(spriteSheet);

    var number = new createjs.Text(i+1, "20px Arial", "#fff");
    number.textAlign = "center";
 		number.x = 46;
	 	number.y = 35;

    var buttonContainer = new createjs.Container();
    buttonContainer.addChild(button);
    buttonContainer.addChild(number);
    buttonContainer.x = 252.3 + 59.3*i;;
    buttonContainer.y = 196.3;


    stage.addChild(buttonContainer);
    buttons.push(buttonContainer);

    function handleClick(event) {

			amountChosen = event.currentTarget.tag+1;
			for (var i in buttons) {
				stage.removeChild(buttons[i]);
			}
			 _THIS.startWalk();
		};

  	var helper = new createjs.ButtonHelper(button, "normal", "hover", "clicked");
 		button.addEventListener("click", handleClick);
 		button.tag = i;

	}
}

bug.prototype.startWalk = function() {

    allNumbers = [];
    for (var i=1;i<=47;i++) {
      allNumbers.push(i);
    }


    var nm = Math.floor(Math.random()*3);

    if (nm === 0){
		    bugSprite.gotoAndPlay("walk1");
    } else if (nm === 1){
		    bugSprite.gotoAndPlay("walk2");
    } else{
		    bugSprite.gotoAndPlay("walk3");
    }


	frameFn = bugSprite.on("change", handleFrame);
	function handleFrame(event) {
		if (event.currentTarget.currentAnimation != "Intro") {

			var keyFrames;
			if (nm == 0) {
				keyFrames = [21,22,24,26,23];
			} else if (nm == 1) {
				keyFrames = [19,21,20,24,23];
			} else if (nm == 2) {
				keyFrames = [15,18,19,23,24];
			}

			switch(event.currentTarget.currentAnimationFrame) {
				case keyFrames[0]:
					if (amountChosen > 0) {
						_THIS.addClover(0, nm);
					}
					break;
				case keyFrames[1]:
					if (amountChosen > 1) {
						_THIS.addClover(1, nm);
					}
					break;
				case keyFrames[2]:
					if (amountChosen > 2) {
						_THIS.addClover(2, nm);
					}
					break;
				case keyFrames[3]:
					if (amountChosen > 3) {
						_THIS.addClover(3, nm);
					}
					break;
				case keyFrames[4]:
					if (amountChosen > 4) {
						_THIS.addClover(4, nm);
					}
					break;
				default:
					break;
			}

		}
	}

};

bug.prototype.handleAnimationEnd = function(event) {
	if (event.name == "Intro") {
		setTimeout(function() {
			_THIS.addButtons();
		}, 50);
	} else {
		bugSprite.off("change", frameFn);
		setTimeout(function() {
 			_THIS.alignClovers();
 		}, 400);
	}
}

bug.prototype.addClover = function(index, walkIndex) {

	var clover =  new createjs.Bitmap(assets.getResult('clover'));
  clover.scaleX = 0.4;
  clover.scaleY = 0.4;

	// var nm = Math.floor(Math.random()*49);
  var nmIndex = Math.floor(Math.random() * allNumbers.length);
  var nm = allNumbers[nmIndex];
  allNumbers.splice(nmIndex, 1);


	var number = new createjs.Text(nm, "bold 20px Arial", "#fff");
	number.textAlign = "center";
	number.x = 25;
	number.y = 12;

	var cloverContainer = new createjs.Container();
	cloverContainer.addChild(clover);
	cloverContainer.addChild(number);
	cloverContainer.regY = 30;
	cloverContainer.regX = 26;
  cloverContainer.number = nm;

	if (walkIndex == 0) {
		switch(index) {
			case 0:
				cloverContainer.x = 340;
				cloverContainer.y = 286;
				cloverContainer.rotation = -20;
				break;
			case 1:
				cloverContainer.x = 506;
				cloverContainer.y = 343;
				cloverContainer.rotation = -20;
				break;
			case 2:
				cloverContainer.x = 484;
				cloverContainer.y = 172;
				cloverContainer.rotation = -60;
				break;
			case 3:
				cloverContainer.x = 754;
				cloverContainer.y = 402;
				cloverContainer.rotation = -100;
				break;
			case 4:
				cloverContainer.x = 677;
				cloverContainer.y = 180;
				cloverContainer.rotation = -30;
				break;
			default:
				break;
		}
	} else if (walkIndex == 1) {
		switch(index) {
			case 0:
				cloverContainer.x = 274;
				cloverContainer.y = 160;
        cloverContainer.rotation = -160;
				break;
			case 1:
				cloverContainer.x = 373;
				cloverContainer.y = 316;
        cloverContainer.rotation = -100;
				break;
			case 2:
				cloverContainer.x = 445;
				cloverContainer.y = 127;
        cloverContainer.rotation = -20;
				break;
			case 3:
				cloverContainer.x = 650;
				cloverContainer.y = 325;
        cloverContainer.rotation = -45;
				break;
			case 4:
				cloverContainer.x = 738;
				cloverContainer.y = 130;
        cloverContainer.rotation = -150;
				break;
			default:
				break;
		}
	} else if (walkIndex == 2) {
		switch(index) {
			case 0:
				cloverContainer.x = 670;
				cloverContainer.y = 310;
        cloverContainer.rotation = -160;
				break;
			case 1:
				cloverContainer.x = 596;
				cloverContainer.y = 150;
        cloverContainer.rotation = -20;
				break;
			case 2:
				cloverContainer.x = 380;
				cloverContainer.y = 68;
        cloverContainer.rotation = -100;
				break;
			case 3:
				cloverContainer.x = 137;
				cloverContainer.y = 140;
        cloverContainer.rotation = -150;
				break;
			case 4:
				cloverContainer.x = 85;
				cloverContainer.y = 317;
        cloverContainer.rotation = -45;
				break;
			default:
				break;
		}
	}

 	stage.addChildAt(cloverContainer, 0);
 	clovers.push(cloverContainer);
}

bug.prototype.alignClovers = function() {

  // clovers.sort( function(a,b) { return a.number - b.number; } );

	var startX = 500 - amountChosen*50;
	for (var i =0;i<clovers.length;i++) {
		createjs.Tween.get(clovers[i]).to({x:startX + i*100, y:240, rotation:0, scaleX:1.5,scaleY:1.5}, 600).call(handleComplete);
	}
	var complete = 1;
	function handleComplete() {
		if (complete == amountChosen) {
			setTimeout(function() {
        resetButton.visible = true;
	 		}, 2000);
		}
		complete++;
	}
}

bug.prototype.removeClovers = function() {
 	for (var i =0;i<clovers.length;i++) {
		 stage.removeChild(clovers[i]);
 	}
	clovers = [];
}

bug.prototype.update = function() {
    	stage.update();
};

bug.prototype.buttonWithText = function(text) {
  var data = {
      images: [assets.getResult('btn_green')],
      frames: { width: 199, height: 62},
      animations: { normal: [0], hover: [1], clicked: [1] }
  };
  var spriteSheet = new createjs.SpriteSheet(data);
  var button = new createjs.Sprite(spriteSheet);
  button.regX = 100;
  var helper = new createjs.ButtonHelper(button, "normal", "hover", "clicked");
  buttonHelpers.push(helper);

  var textLabel = new createjs.Text(text, "bold 25px Arial", "#fff");
  textLabel.textAlign = "center";
  textLabel.x = 0;
  textLabel.y = 18;

  var buttonContainer = new createjs.Container();
  buttonContainer.addChild(button);
  buttonContainer.addChild(textLabel);

  return buttonContainer;
}


window.onresize = function()
{
     onResize();
}

function onResize()
{
  // browser viewport size
  var w = window.innerWidth;
  var h = window.innerHeight;

  // stage dimensions
  var ow = stageWidth; // your stage width
  var oh = stageHeight; // your stage height

    // keep aspect ratio
    var scale = Math.min(w / ow, h / oh);
    stage.scaleX = scale;
    stage.scaleY = scale;

   // adjust canvas size
   stage.canvas.width = ow * scale -4;
  stage.canvas.height = oh * scale -4;
}
