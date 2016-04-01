var stage = null;
var stageWidth = 900;
var stageHeight = 516;
var framerate = 20;

var introAnimData = {
"framerate":24,
"images":["Intro_0.png", "Intro_1.png", "Intro_2.png", "Intro_3.png"],
"frames":[
    [0, 0, 900, 516, 0, 0, 0],
    [900, 0, 900, 516, 0, 0, 0],
    [0, 516, 900, 516, 0, 0, 0],
    [900, 516, 900, 516, 0, 0, 0],
    [0, 1032, 900, 516, 0, 0, 0],
    [900, 1032, 900, 516, 0, 0, 0],
    [0, 0, 900, 516, 1, 0, 0],
    [900, 0, 900, 516, 1, 0, 0],
    [0, 516, 900, 516, 1, 0, 0],
    [900, 516, 900, 516, 1, 0, 0],
    [0, 1032, 900, 516, 1, 0, 0],
    [900, 1032, 900, 516, 1, 0, 0],
    [0, 0, 900, 516, 2, 0, 0],
    [900, 0, 900, 516, 2, 0, 0],
    [0, 516, 900, 516, 2, 0, 0],
    [900, 516, 900, 516, 2, 0, 0],
    [0, 1032, 900, 516, 2, 0, 0],
    [900, 1032, 900, 516, 2, 0, 0],
    [0, 0, 900, 516, 3, 0, 0],
    [900, 0, 900, 516, 3, 0, 0],
    [0, 516, 900, 516, 3, 0, 0],
    [900, 516, 900, 516, 3, 0, 0],
    [0, 1032, 900, 516, 3, 0, 0]
],
"animations":{
    "explode": {
        "speed": 1,
        "frames": [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]
    },
    "num_select": {"speed": 1, "frames": [10]},
    "Intro": {
        "speed": 1,
        "frames": [0,0,0,0,0,0,0,0,0,0,, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        "next": "num_select"
    }
}
};
var ballFillAnimData = { "framerate":24, "images":["BallFill_0.png", "BallFill_1.png"], "frames":[ [0, 0, 180, 516, 0, 0, 0], [180, 0, 180, 516, 0, 0, 0], [360, 0, 180, 516, 0, 0, 0], [540, 0, 180, 516, 0, 0, 0], [720, 0, 180, 516, 0, 0, 0], [900, 0, 180, 516, 0, 0, 0], [1080, 0, 180, 516, 0, 0, 0], [1260, 0, 180, 516, 0, 0, 0], [1440, 0, 180, 516, 0, 0, 0], [1620, 0, 180, 516, 0, 0, 0], [1800, 0, 180, 516, 0, 0, 0], [0, 516, 180, 516, 0, 0, 0], [180, 516, 180, 516, 0, 0, 0], [360, 516, 180, 516, 0, 0, 0], [540, 516, 180, 516, 0, 0, 0], [720, 516, 180, 516, 0, 0, 0], [900, 516, 180, 516, 0, 0, 0], [1080, 516, 180, 516, 0, 0, 0], [1260, 516, 180, 516, 0, 0, 0], [1440, 516, 180, 516, 0, 0, 0], [1620, 516, 180, 516, 0, 0, 0], [1800, 516, 180, 516, 0, 0, 0], [0, 1032, 180, 516, 0, 0, 0], [180, 1032, 180, 516, 0, 0, 0], [360, 1032, 180, 516, 0, 0, 0], [540, 1032, 180, 516, 0, 0, 0], [720, 1032, 180, 516, 0, 0, 0], [900, 1032, 180, 516, 0, 0, 0], [1080, 1032, 180, 516, 0, 0, 0], [1260, 1032, 180, 516, 0, 0, 0], [1440, 1032, 180, 516, 0, 0, 0], [1620, 1032, 180, 516, 0, 0, 0], [1800, 1032, 180, 516, 0, 0, 0], [0, 0, 180, 516, 1, 0, 0], [180, 0, 180, 516, 1, 0, 0], [360, 0, 180, 516, 1, 0, 0], [540, 0, 180, 516, 1, 0, 0], [720, 0, 180, 516, 1, 0, 0], [900, 0, 180, 516, 1, 0, 0], [1080, 0, 180, 516, 1, 0, 0], [1260, 0, 180, 516, 1, 0, 0], [1440, 0, 180, 516, 1, 0, 0], [1620, 0, 180, 516, 1, 0, 0], [1800, 0, 180, 516, 1, 0, 0], [0, 516, 180, 516, 1, 0, 0], [180, 516, 180, 516, 1, 0, 0], [360, 516, 180, 516, 1, 0, 0], [540, 516, 180, 516, 1, 0, 0], [720, 516, 180, 516, 1, 0, 0], [900, 516, 180, 516, 1, 0, 0], [1080, 516, 180, 516, 1, 0, 0], [1260, 516, 180, 516, 1, 0, 0], [1440, 516, 180, 516, 1, 0, 0], [1620, 516, 180, 516, 1, 0, 0], [1800, 516, 180, 516, 1, 0, 0], [0, 1032, 180, 516, 1, 0, 0], [180, 1032, 180, 516, 1, 0, 0], [360, 1032, 180, 516, 1, 0, 0], [540, 1032, 180, 516, 1, 0, 0] ], "animations":{ "fillBall": {next: false, "speed": 1, "frames": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58] } } };


var introSprite;
var ballFillSprites;
var ballImages;
var amountChosen;
var buttonHelpers = [];
var complete = 0;
var allNumbers;
var chosenNumbers;
var animsComplete;
var balls;

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

      introSprite = new createjs.Sprite(new createjs.SpriteSheet({images: [assets.getResult('intro1'),
      assets.getResult('intro2'),
      assets.getResult('intro3'),
      assets.getResult('intro4'),
      ], frames: introAnimData.frames , animations: introAnimData.animations}), "Intro");
      introSprite.gotoAndStop("Intro");
      stage.addChild(introSprite);

      introSprite.x = 0;
      introSprite.y = 0;

		stage.addChild(introSprite);

		this.intervalId = setInterval(function() {_THIS.update();}, 1000 / framerate);

    // var startButton = new createjs.Shape();
    // startButton.hitArea = new createjs.Shape(new createjs.Graphics().beginFill("#ff0000").drawRect(0,0,stageWidth,stageHeight));
    // startButton.addEventListener("click", handleStartClick);
    // stage.addChild(startButton);
    // var helper = new createjs.ButtonHelper(startButton);
    // buttonHelpers.push(helper);

    resetButton = _THIS.buttonWithText('AGAIN?');
    resetButton.x = 450;
    resetButton.y = 430;
    stage.addChild(resetButton);
    resetButton.visible = false;
    resetButton.addEventListener("click", handleResetClick);
    function handleResetClick(event) {
      _THIS.reset();
    };

    // function handleStartClick(event) {
    //   stage.removeChild(startButton);
    //   _THIS.start();
    // };
    onResize();
    _THIS.start();

};

bug.prototype.start = function() {

  introSprite.gotoAndPlay("Intro");
  introSprite.on("animationend", _THIS.handleIntroAnimationEnd);

};

bug.prototype.reset = function() {
  for (var i in ballImages) {
    stage.removeChild(ballImages[i]);
    stage.removeChild(ballFillSprites[i]);
  }
  ballImages = [];
  resetButton.visible = false;
  stage.addChild(introSprite);
  introSprite.gotoAndPlay("Intro");
};



bug.prototype.handleIntroAnimationEnd = function(event) {
  if (event.name == "num_select") {
    _THIS.addButtons();
  } else if (event.name == "explode") {
		stage.removeChild(introSprite);
    _THIS.fillBalls();
	} else {

	}
}

bug.prototype.addButtons = function() {
	var buttons = [];
	for (var i=0;i<5;i++) {


    function handleClick(event) {

			amountChosen = event.currentTarget.tag+1;
			for (var i in buttons) {
				stage.removeChild(buttons[i]);
			}
      _THIS.setupBallFill();
			 introSprite.gotoAndPlay("explode");
		};

    function handleMouseOver(event) {
      var target = event.currentTarget;
      target.graphics.clear().beginStroke( "#fff" ).setStrokeStyle(4).drawCircle(295 + 81.5*target.tag, 258, 38).endStroke();
    };
    function handleMouseOut(event) {
      var target = event.currentTarget;
      target.graphics.clear();
    };


    var button = new createjs.Shape();
    // button.graphics.beginFill( "red" ).drawCircle(295 + 82*i, 258, 38);
    button.hitArea = new createjs.Shape(new createjs.Graphics().beginFill("#f00").drawCircle(295 + 81.5*i, 258, 38));
 		button.addEventListener("click", handleClick);
     button.addEventListener("mouseover", handleMouseOver);
     button.addEventListener("mouseout", handleMouseOut);
 		button.tag = i;
     buttons.push(button);
     var helper = new createjs.ButtonHelper(button);
     buttonHelpers.push(helper);
    stage.addChild(button);



	}
}

bug.prototype.setupBallFill = function() {
  ballFillSprites = [];
  var startX = stageWidth/2 - amountChosen*90;
  for (var i=0;i<amountChosen;i++) {
    var ballFillSprite = new createjs.Sprite(new createjs.SpriteSheet({images: [assets.getResult('ballFill1'), assets.getResult('ballFill2')], frames: ballFillAnimData.frames , animations: ballFillAnimData.animations}), "fillBall");
    ballFillSprite.x = startX + 180*i;
    stage.addChildAt(ballFillSprite, 0);
    ballFillSprite.tag = i;
    ballFillSprite.gotoAndStop("fillBall");
    ballFillSprite.on("animationend", _THIS.handleFillAnimationEnd);
    ballFillSprites.push(ballFillSprite);
  }
}

bug.prototype.fillBalls = function() {

  ballImages = [];
  _THIS.chooseRandomNumbers();
  animsComplete = 0;

  for (var i in ballFillSprites) {
    var sprite = ballFillSprites[i];
    _THIS.fillBallWithDelay(sprite, i*800);
  }
}

bug.prototype.fillBallWithDelay = function(sprite, delay) {
  setTimeout(function() {
    sprite.gotoAndPlay("fillBall");
  }, delay);
}

bug.prototype.handleFillAnimationEnd = function(event) {
  setTimeout(function() {
  _THIS.revealBallAtIndex(event.currentTarget.tag);
}, 300);
}

bug.prototype.revealBallAtIndex = function(index) {

  var ball = _THIS.ballImageForNumber(chosenNumbers[index]);
  ballImages.push(ball);
  var startX = stageWidth/2 - amountChosen*90;
  ball.x = startX + 180*index + 17;
  ball.y = 227;
  ball.alpha = 0;
  stage.addChild(ball);
  createjs.Tween.get(ball).to({alpha:1}, 600).call(handleComplete);

  function handleComplete() {
    animsComplete++;
    if (animsComplete == amountChosen) {
      setTimeout(function() {
        resetButton.visible = true;
       }, 2000);
    }
  }

}

bug.prototype.ballImageForNumber = function(number) {
  var index  = (number-1) % 7;
  var images = ["ballGreen","ballRed","ballOrange","ballYellow","ballBrown","ballPurple","ballBlue"];
  var ball =  new createjs.Bitmap(assets.getResult(images[index]));

  var label = new createjs.Text(number, "bold 70px Arial", "#000");
  label.textAlign = "center";
  label.x = 73;
  label.y = 35;

  var ballContainer = new createjs.Container();
  ballContainer.addChild(ball);
  ballContainer.addChild(label);



  return ballContainer;
}

bug.prototype.chooseRandomNumbers = function() {

    allNumbers = [];
    for (var i=1;i<=49;i++) {
      allNumbers.push(i);
    }

    chosenNumbers = [];
    for (var i=0;i<5;i++) {
      var nmIndex = Math.floor(Math.random() * allNumbers.length);
      var chosenNum = allNumbers[nmIndex];
      allNumbers.splice(nmIndex, 1);
      chosenNumbers.push(chosenNum);
    }

    // chosenNumbers.sort( function(a,b) { return a - b; } );
}

bug.prototype.buttonWithText = function(text) {
  var data = {
      images: [assets.getResult('btn_blue')],
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

bug.prototype.update = function() {
    	stage.update();
};



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
