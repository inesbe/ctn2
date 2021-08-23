let speech = new SpeechSynthesisUtterance();
speech.lang = "en";


let voices = [];
window.speechSynthesis.onvoiceschanged = () => {
    voices = window.speechSynthesis.getVoices();
    speech.voice = voices[0];
    let voiceSelect = document.querySelector("#voices");
    voices.forEach((voice, i) => ( new Option(voice.name, i)));
};


function play()
{
    var audio = new Audio();
    audio.src ='http://translate.google.com/translate_tts?ie=utf-8&tl=en&q=Hello%20World.';
    audio.play();

    speech.voice = voices[1]
    speech.text = document.getElementById("word").innerHTML;
    window.speechSynthesis.speak(speech);

}

function stop()
{
    window.speechSynthesis.cancel();
}