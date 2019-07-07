// QRCODE reader Copyright 2011 Lazar Laszlo
// http://www.webqr.com
var audio = new Audio('public/audio/no-manners.mp3');
audio.play();

function playAudio() {
    audio.play();
}

var gCtx = null;
var gCanvas = null;
var c=0;
var stype=0;
var gUM=false;
var webkit=false;
var moz=false;
var v=null;
var no=1;
var hasil=null;

var vidhtml = '<video id="v" autoplay></video>';

function load(){
    if (isCanvasSupported() && window.File && window.FileReader){
        initCanvas(800, 600);
        qrcode.callback = read;
        document.getElementById("mainbody").style.display="inline";
        setwebcam();
    }
}

function isCanvasSupported(){
  var elem = document.createElement('canvas');
  return !!(elem.getContext && elem.getContext('2d'));
}

function initCanvas(w,h)
{
    gCanvas = document.getElementById("qr-canvas");
    gCanvas.style.width = w + "px";
    gCanvas.style.height = h + "px";
    gCanvas.width = w;
    gCanvas.height = h;
    gCtx = gCanvas.getContext("2d");
    gCtx.clearRect(0, 0, w, h);
}

function read(a)
{
    var html="<br>";
    if(a.indexOf("http://") === 0 || a.indexOf("https://") === 0)
        html+="<a target='_blank' href='"+a+"'>"+a+"</a><br>";
    html+="<b>"+htmlEntities(a)+"</b><br><br>";
    document.getElementById("result").innerHTML=html;

    entertolist(a);
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function setwebcam()
{
    var options = true;
    if(navigator.mediaDevices && navigator.mediaDevices.enumerateDevices)
    {
        try{
            navigator.mediaDevices.enumerateDevices().then(function(devices) {
              devices.forEach(function(device) {

                if (device.kind === 'videoinput') {

                  if(device.label.toLowerCase().search("back") >-1) options={'deviceId': {'exact':device.deviceId}, 'facingMode':'environment'} ;

                }
                //console.log(device.kind + ": " + device.label +" id = " + device.deviceId);
              });
              setwebcam2(options);
            });
        }
        catch(e){
            console.log(e);
        }
    } else {
        console.log("no navigator.mediaDevices.enumerateDevices" );
        setwebcam2(options);
    }

}

function setwebcam2(options)
{
    console.log(options);
  //  alert(JSON.stringify(options));
    document.getElementById("result").innerHTML="- scanning -";
    if(stype==1){
        setTimeout(captureToCanvas, 500);
        return;
    }

    var n=navigator;
    document.getElementById("outdiv").innerHTML = vidhtml;
    v=document.getElementById("v");

    vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia =    navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia;

    navigator.getMedia({
        video: options,
        audio: false,
    }, function(stream){
        v.src = vendorUrl.createObjectURL(stream);
        v.play();
        gUM=true;
        setTimeout(captureToCanvas, 500);
    }, function(error){
        gUM=false;
        return;
    })

    stype=1;
    setTimeout(captureToCanvas, 500);
}

function captureToCanvas() {

    if(stype!=1)
        return;
    if(gUM)
    {
        try{
            gCtx.drawImage(v,0,0);
            try{
                qrcode.decode();
            }
            catch(e){
                console.log(e);
                setTimeout(captureToCanvas, 500);
            };
        }
        catch(e){
                console.log(e);
                setTimeout(captureToCanvas, 500);
        };
    }
}

function entertolist(a) {
  if (a!=hasil) {
    hasil=a;
    audio.play();
    $("#list").append('<div class="col-xs-2 col-sm-2">'+no+'</div><div class="col-xs-5 col-sm-5">'+hasil+'</div><div class="col-xs-5 col-sm-5">kosong</div>');
    no++;
  }
  setTimeout(load, 500);
}
