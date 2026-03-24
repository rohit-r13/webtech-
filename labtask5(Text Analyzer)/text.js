document.getElementById("sie").innerHTML="Text Analyzer";
document.getElementById("sie2").innerHTML=" Welcome for Text Analyzing";
var bro3=document.getElementById("bro");
bro3.style.color="black";
bro3.style.backgroundColor="green";
bro3.style.fontWeight="bold";
function analyze(){
var text=document.getElementById("text").value;
if(text.trim()==""){
document.getElementById("char").innerHTML=0;
document.getElementById("word").innerHTML=0;
document.getElementById("reverse").innerHTML="no text entered ";
return;
}
var charCount=text.trim().length;
var words=text.trim().split(/\s+/);
var wordCount=words.length;
var reverseText=text.split("").reverse().join("");
document.getElementById("char").innerHTML=charCount;
document.getElementById("word").innerHTML=wordCount;
document.getElementById("reverse").innerHTML=reverseText;
}