
<script>

var recognizing = false;


if (!('webkitSpeechRecognition' in window)) {
    //Speech API not supported here…
} else { //Let’s do some cool stuff :)
    var recognition = new webkitSpeechRecognition(); //That is the object that will manage our whole recognition process. 
    recognition.continuous = true;   //Suitable for dictation. 
    recognition.interimResults = true;  //If we want to start receiving results even if they are not final.
    //Define some more additional parameters for the recognition:
    recognition.lang = "es-MX"; 
    recognition.maxAlternatives = 1; //Since from our experience, the highest result is really the best...
}


recognition.onstart = function() {
	recognizing = true;
	
    //Listening (capturing voice from audio input) started.
    //This is a good place to give the user visual feedback about that (i.e. flash a red light, etc.)
};

recognition.onend = function() {
	recognizing = false;
	 start_img.src = 'https://speechlogger.appspot.com/images/micoff2.png'; 
    //Again – give the user feedback that you are not listening anymore. If you wish to achieve continuous recognition – you can write a script to start the recognizer again here.
};

recognition.onresult = function(event) { //the event holds the results
//Yay – we have results! Let’s check if they are defined and if final or not:
    if (typeof(event.results) === 'undefined') { //Something is wrong…
        recognition.stop();
        return;
    }

    for (var i = event.resultIndex; i < event.results.length; ++i) {      
        if (event.results[i].isFinal) { //Final results
            console.log("final results: " + event.results[i][0].transcript);   //Of course – here is the place to do useful things with the results.
        } else {   //i.e. interim...
            console.log("interim results: " + event.results[i][0].transcript);  //You can use these results to give the user near real time experience.
        } 
    } //end for loop
}; 


function startButton(event) {

	 if (recognizing) {
		    recognition.stop();
		    return;
		  }
	
    recognition.start();
    start_img.src = 'https://speechlogger.appspot.com/images/micslash2.png'; //We change the image to a slashed until the user approves the browser to listen and recognition actually starts. Then – we’ll change the image to ‘mic on’.
}
</script>

